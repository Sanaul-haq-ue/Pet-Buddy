<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Validate and apply a coupon code to the current cart total.
     */
    public function apply(Request $request)
    {
        $request->validate([
            'code'        => 'required|string|max:100',
            'cart_total'  => 'required|numeric|min:0',
        ]);

        $code      = strtoupper(trim($request->code));
        $cartTotal = (float) $request->cart_total;
        $now       = Carbon::now();

        // 1. Find the coupon
        $coupon = Coupon::where('code', $code)->first();

        if (! $coupon) {
            return response()->json([
                'success' => false,
                'message' => 'This is an invalid coupon.',
            ]);
        }

        // 2. Status check
        if (! $coupon->status) {
            return response()->json([
                'success' => false,
                'message' => 'This coupon is currently inactive.',
            ]);
        }

        // 3. Date validation
        if ($now->lt($coupon->start_date)) {
            return response()->json([
                'success' => false,
                'message' => 'This coupon is not yet valid.',
            ]);
        }

        if ($now->gt($coupon->expiry_date)) {
            return response()->json([
                'success' => false,
                'message' => 'This coupon has expired.',
            ]);
        }

        // 4. Global usage limit
        if ($coupon->usage_limit !== null) {
            // Count how many times this coupon was used across all orders
            $timesUsed = \DB::table('orders')
                ->where('coupon_code', $code)
                ->count();

            if ($timesUsed >= $coupon->usage_limit) {
                return response()->json([
                    'success' => false,
                    'message' => 'This coupon usage limit has been reached.',
                ]);
            }
        }

        // 5. Minimum order amount
        if ($coupon->min_order_amount !== null && $cartTotal < (float) $coupon->min_order_amount) {
            return response()->json([
                'success' => false,
                'message' => 'Minimum order amount of $' . number_format($coupon->min_order_amount, 2) . ' required for this coupon.',
            ]);
        }

        // 6. Calculate discount
        $discount = 0;

        if ($coupon->discount_type === 'percentage') {
            $discount = ($cartTotal * (float) $coupon->discount_value) / 100;
        } else {
            // fixed
            $discount = (float) $coupon->discount_value;
        }

        // 7. Cap by max_discount_amount
        if ($coupon->max_discount_amount !== null) {
            $discount = min($discount, (float) $coupon->max_discount_amount);
        }

        // Discount cannot exceed cart total
        $discount   = min($discount, $cartTotal);
        $finalTotal = $cartTotal - $discount;

        return response()->json([
            'success'        => true,
            'message'        => 'Coupon applied successfully!',
            'coupon_code'    => $coupon->code,
            'coupon_name'    => $coupon->name,
            'discount_type'  => $coupon->discount_type,
            'discount_value' => (float) $coupon->discount_value,
            'discount_amount'=> round($discount, 2),
            'final_total'    => round($finalTotal, 2),
        ]);
    }
}
