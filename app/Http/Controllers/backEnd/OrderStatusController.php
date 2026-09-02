<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderStatusService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderStatusController extends Controller
{

    public function order_status_Index(Request $request)
    {
        $query = Order::with(['user', 'payType', 'payMethod', 'statusLogs', 'items'])
            ->orderByDesc('created_at');

        $status = $request->input('status', 'all');
        if ($status !== 'all') {
            $query->where('tracking_stage', $status);
        }

        $paymentStatus = $request->input('payment_status', 'all');
        if ($paymentStatus !== 'all') {
            $query->where('payment_status', $paymentStatus);
        }

        if ($request->filled('order_no')) {
            $query->where('order_no', 'like', '%' . $request->input('order_no') . '%');
        }

        $orders = $query->paginate(20);

        $totalOrders = Order::count();
        $pendingConfirmations = Order::where('tracking_stage', 'confirmation_pending')->count();
        $inProgress = Order::whereIn('tracking_stage', ['confirmed', 'processing', 'shipped'])->count();
        $completedToday = Order::where('tracking_stage', 'delivered')
            ->whereDate('updated_at', Carbon::today())
            ->count();
        $cancelledOrders = Order::where('tracking_stage', 'cancelled')->count();

        return view('backEnd.pages.order.status-index', compact(
            'orders',
            'totalOrders',
            'pendingConfirmations',
            'inProgress',
            'completedToday',
            'cancelledOrders'
        ));
    }

    // public function manage($order_no)
    // {
    //     $order = Order::with(['user', 'payType', 'payMethod', 'statusLogs'])
    //         ->where('order_no', $order_no)
    //         ->firstOrFail();

    //     return view('backEnd.pages.order.status-actions', compact('order')); // ← unchanged, back to original file
    // }


    public function confirm(Order $order)
    {
        abort_if(in_array($order->tracking_stage, ['cancelled', 'delivered']), 400, 'Order is already closed.');

        OrderStatusService::setStage($order, 'confirmed', 'Order Confirmed', 'Payment verified online.');
        $order->update(['confirmed_at' => now()]);

        return back()->with('success', 'Order marked as Confirmed.');
    }

    public function callAttempt(Request $request, Order $order)
    {
        $request->validate(['result' => 'required|in:no_response,confirmed']);
        abort_if(in_array($order->tracking_stage, ['cancelled', 'delivered']), 400, 'Order is already closed.');

        if ($request->result === 'confirmed') {
            OrderStatusService::setStage($order, 'confirmed', 'Order Confirmed', 'Customer confirmed by phone.');
            $order->update(['confirmed_at' => now()]);

            return back()->with('success', 'Customer confirmed by phone. Order moved to Confirmed.');
        }

        // no_response — just log it, no auto-cancel, admin decides when to stop
        $order->increment('call_attempts');
        $attempt = $order->call_attempts;

        OrderStatusService::setStage(
            $order,
            'confirmation_pending',
            "Didn't Response ({$attempt})",
            'Unreachable'
        );

        return back()->with('success', "No response logged. Attempt {$attempt}.");
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:processing,shipped,delivered']);

        abort_if(in_array($order->tracking_stage, ['cancelled', 'delivered']), 400, 'Order is already closed.');
        abort_if(in_array($order->tracking_stage, ['placed', 'confirmation_pending']), 400, 'Confirm the order first.');

        $labels = [
            'processing' => 'processing',
            'shipped'    => 'Hand over Logistic Partner',
            'delivered'  => 'Delivered',
        ];

        OrderStatusService::setStage($order, $request->status, $labels[$request->status]);

        if ($request->status === 'shipped') {
            $order->update(['shipped_at' => now()]);
        }
        if ($request->status === 'delivered') {
            $order->update(['delivered_at' => now()]);
        }

        return back()->with('success', 'Order status updated to ' . ucfirst($request->status) . '.');
    }

    public function cancel(Request $request, Order $order)
    {
        $request->validate(['reason' => 'required|string|max:255']); // now required — admin must type a reason
        abort_if($order->tracking_stage === 'delivered', 400, 'Cannot cancel a delivered order.');

        OrderStatusService::setStage($order, 'cancelled', 'Order Cancelled', $request->reason);
        $order->update(['cancelled_reason' => $request->reason]);

        return back()->with('success', 'Order cancelled.');
    }
}
