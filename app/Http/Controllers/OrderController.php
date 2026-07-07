<?php

namespace App\Http\Controllers;

use App\Services\OrderStatusService;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mpdf\Mpdf;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        // ── Step 1: Validate inputs ───────────────────────────────────────────
        try {
            $request->validate([
                'shipping_name'      => 'required|string|max:255',
                'shipping_email'     => 'required|email|max:255',
                'shipping_mobile'    => 'required|regex:/^01[3-9]\d{8}$/',
                'shipping_address'   => 'required|string',
                'pay_type_id'        => 'required|integer',
                'pay_method_id'      => 'required|integer',
                'transaction_no'     => 'nullable|string|max:255',
                'payment_screenshot' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
                'coupon_code'        => 'nullable|string|max:100',
                'shipping_charge'    => 'required|numeric|min:0',
                'shipping_zone'      => 'required|string|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = collect($e->errors())->first()[0];
            return response()->json([
                'success' => false,
                'message' => $firstError,
            ], 422);
        }

        // COD (pay_type_id == 3) does not need proof
        $isCOD = (int) $request->pay_type_id === 3;

        if (!$isCOD) {
            if (!$request->filled('transaction_no')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please enter your Transaction / Reference No.',
                ]);
            }
            if (!$request->hasFile('payment_screenshot')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please upload your payment screenshot.',
                ]);
            }
        }

        // ── Step 2: Re-read cart from session ────────────────────────────────
        $cartSession = session()->get('cart', []);
        $cart        = array_values($cartSession);

        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty.',
            ]);
        }

        // Recalculate subtotal server-side — never trust frontend total
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += (float) $item['price'] * (int) $item['quantity'];
        }
        $subtotal = round($subtotal, 2);

        // ── Step 3: Coupon re-validation ──────────────────────────────────────
        $discountAmount = 0;
        $finalTotal     = $subtotal;
        $couponCode     = null;

        if ($request->filled('coupon_code')) {
            $code   = strtoupper(trim($request->coupon_code));
            $now    = Carbon::now();
            $coupon = Coupon::whereRaw('UPPER(code) = ?', [$code])->first();

            // 3.1 Exists
            if (!$coupon) {
                return response()->json([
                    'success' => false,
                    'message' => 'The applied coupon code is invalid.',
                ]);
            }

            // 3.2 Status
            if (!$coupon->status) {
                return response()->json([
                    'success' => false,
                    'message' => 'The applied coupon is currently inactive.',
                ]);
            }

            // 3.3 Date
            if ($now->lt($coupon->start_date)) {
                return response()->json([
                    'success' => false,
                    'message' => 'The applied coupon is not yet valid.',
                ]);
            }
            if ($now->gt($coupon->expiry_date)) {
                return response()->json([
                    'success' => false,
                    'message' => 'The applied coupon has expired.',
                ]);
            }

            // 3.4 Global usage limit
            if ($coupon->usage_limit !== null) {
                $totalUsed = DB::table('orders')
                    ->where('coupon_code', $coupon->code)
                    ->count();
                if ($totalUsed >= $coupon->usage_limit) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This coupon usage limit has been reached.',
                    ]);
                }
            }

            // 3.5 Per customer usage limit
            if ($coupon->usage_per_customer !== null) {
                if (auth()->check()) {
                    $customerUsed = DB::table('orders')
                        ->where('user_id', auth()->id())
                        ->where('coupon_code', $coupon->code)
                        ->count();
                } else {
                    // Guest — check by mobile number
                    $customerUsed = DB::table('orders')
                        ->where('shipping_mobile', $request->shipping_mobile)
                        ->where('coupon_code', $coupon->code)
                        ->count();
                }

                if ($customerUsed >= $coupon->usage_per_customer) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You have already used this coupon.',
                    ]);
                }
            }

            // 3.6 Minimum order amount
            if ($coupon->min_order_amount !== null && $subtotal < (float) $coupon->min_order_amount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Minimum order amount of $' . number_format($coupon->min_order_amount, 2) . ' required for this coupon.',
                ]);
            }

            // 3.7 Calculate discount server-side
            if ($coupon->discount_type === 'percentage') {
                $discountAmount = ($subtotal * (float) $coupon->discount_value) / 100;
            } else {
                $discountAmount = (float) $coupon->discount_value;
            }

            if ($coupon->max_discount_amount !== null) {
                $discountAmount = min($discountAmount, (float) $coupon->max_discount_amount);
            }

            $discountAmount = round(min($discountAmount, $subtotal), 2);
            $finalTotal     = round($subtotal - $discountAmount, 2);
            $couponCode     = $coupon->code;
        }

        // ── Step 3.8: Add shipping charge ────────────────────────────────────
        $shippingCharge = round((float) $request->shipping_charge, 2);
        $finalTotal     = round($finalTotal + $shippingCharge, 2);

        // ── Step 4: Handle screenshot upload ─────────────────────────────────
        $screenshotPath = null;
        if (!$isCOD && $request->hasFile('payment_screenshot')) {
            $file            = $request->file('payment_screenshot');
            $filename        = 'screenshot' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('backAssets/upload/screenshot');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $screenshotPath = 'backAssets/upload/screenshot/' . $filename;
        }

        // ── Step 5: Generate unique order_no ──────────────────────────────────
        do {
            $orderNo = 'ORD' . strtoupper(Str::random(8));
        } while (Order::where('order_no', $orderNo)->exists());

        // ── Step 6: Save order inside transaction ─────────────────────────────
        DB::beginTransaction();

        try {
            $order = Order::create([
                'order_no'           => $orderNo,
                'user_id'            => auth()->check() ? auth()->id() : null,
                'coupon_code'        => $couponCode,
                'subtotal'           => $subtotal,
                'discount_amount'    => $discountAmount,
                'shipping_charge'    => $shippingCharge,
                'total'              => $finalTotal,
                'pay_type_id'        => $request->pay_type_id,
                'pay_method_id'      => $request->pay_method_id,
                'transaction_no'     => $request->transaction_no ?? null,
                'payment_screenshot' => $screenshotPath,
                'shipping_name'      => $request->shipping_name,
                'shipping_email'     => $request->shipping_email,
                'shipping_mobile'    => $request->shipping_mobile,
                'shipping_zone'      => $request->shipping_zone,
                'shipping_address'   => $request->shipping_address,
                'status'             => 'pending',
                'payment_status'     => 'pending',
            ]);

            // NEW — creates the very first history entry so the tracking page isn't empty
            OrderStatusService::setStage($order, 'placed', 'Order Placed');

            // ── Step 7: Save order items ──────────────────────────────────────
            foreach ($cart as $item) {
                // Safety check — product_id must exist in session item
                if (empty($item['product_id'])) {
                    DB::rollBack();
                    if ($screenshotPath && file_exists(public_path($screenshotPath))) {
                        unlink(public_path($screenshotPath));
                    }
                    return response()->json([
                        'success' => false,
                        'message' => 'Your cart has outdated data. Please remove all items and add them again.',
                    ]);
                }

                $product = \App\Models\Product::find($item['product_id']);

                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item['product_id'],
                    'product_name' => $product ? $product->product_name : ($item['name'] ?? 'Unknown Product'),
                    'price'        => (float) $item['price'],
                    'quantity'     => (int) $item['quantity'],
                    'subtotal'     => round((float) $item['price'] * (int) $item['quantity'], 2),
                    'item_status'  => 'pending',
                ]);
            }

            // ── Step 8: Clear cart session ────────────────────────────────────
            session()->forget('cart');

            DB::commit();

            // Send confirmation email
            try {
                \Mail::to($order->shipping_email)
                    ->send(new \App\Mail\OrderPlacedMail($order));
            } catch (\Exception $e) {
                // Don't fail the order if mail fails
                \Log::error('Order confirmation mail failed: ' . $e->getMessage());
            }

            return response()->json([
                'success'      => true,
                'order_no'     => $order->order_no,
                'redirect_url' => route('order.successfull', ['order_no' => $order->order_no]),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            if ($screenshotPath && file_exists(public_path($screenshotPath))) {
                unlink(public_path($screenshotPath));
            }

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ]);
        }
    }


    public function successfull($order_no)
    {
        $order = Order::with(['items.product', 'payType', 'payMethod'])
            ->where('order_no', $order_no)
            ->firstOrFail();

        $estimatedDelivery = \Carbon\Carbon::parse($order->created_at)->addDays(7)->format('M d');

        return view('frontEnd.order.successfull', compact('order', 'estimatedDelivery'));
    }



    public function downloadInvoice($order_no)
    {
        $order = Order::with(['items.product', 'payType', 'payMethod'])
            ->where('order_no', $order_no)
            ->firstOrFail();

        $html = view('frontEnd.order.invoice', compact('order'))->render();

        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            'format'        => 'A4',
            'margin_top'    => 10,
            'margin_bottom' => 10,
            'margin_left'   => 10,
            'margin_right'  => 10,
        ]);

        $mpdf->WriteHTML($html);

        return response($mpdf->Output('Invoice-' . $order->order_no . '.pdf', 'S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Invoice-' . $order->order_no . '.pdf"');
    }

    public function demo($order_no)
    {
        $order = Order::with(['items.product', 'payType', 'payMethod'])
            ->where('order_no', $order_no)
            ->firstOrFail();

        return view('frontEnd.order.invoice', compact('order'));
    }
}
