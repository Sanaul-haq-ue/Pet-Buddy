<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\OrderStatusService;

class TrackOrderController extends Controller
{
    public function trackOrderForm()
    {
        return view('frontEnd.order.track-form');
    }

    public function trackOrderSearch(Request $request)
    {
        $request->validate([
            'order_no' => 'required|string',
            'mobile'   => 'required|string',
        ]);

        $order = Order::where('order_no', $request->order_no)
            ->where('shipping_mobile', $request->mobile)
            ->first();

        if (!$order) {
            return back()->withErrors(['order_no' => 'No matching order found. Please check your Order No and Mobile Number.'])->withInput();
        }

        // Store verified access in session, scoped to this order_no
        session(['tracked_order_' . $order->order_no => true]);

        return redirect()->route('track.order.show', $order->order_no);
    }



    public function trackOrderShow($order_no)
    {
        if (!session('tracked_order_' . $order_no)) {
            return redirect()->route('track.order.form')
                ->withErrors(['order_no' => 'Please search your order first.']);
        }

        $order = Order::with(['items.product', 'payType', 'payMethod', 'statusLogs'])
            ->where('order_no', $order_no)
            ->firstOrFail();

        $history      = OrderStatusService::history($order);      // real dated log, oldest → newest
        $isCancelled  = OrderStatusService::isCancelled($order);
        $isDelivered  = OrderStatusService::isDelivered($order);

        return view('frontEnd.order.track-show', compact('order', 'history', 'isCancelled', 'isDelivered'));
    }

    
}
