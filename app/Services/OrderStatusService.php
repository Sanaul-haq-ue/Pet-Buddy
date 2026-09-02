<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderStatusLog;

class OrderStatusService
{
    protected static array $legacyStatusMap = [
        'placed'               => 'pending',
        'confirmation_pending' => 'pending',
        'confirmed'            => 'processing',
        'processing'           => 'processing',
        'shipped'              => 'processing',
        'delivered'            => 'completed',
        'cancelled'            => 'cancelled',
    ];

    public static function setStage(Order $order, string $stage, string $title, ?string $note = null): void
    {
        $order->tracking_stage = $stage;
        $order->status = self::$legacyStatusMap[$stage] ?? $order->status;
        $order->save();

        OrderStatusLog::create([
            'order_id' => $order->id,
            'stage'    => $stage,
            'title'    => $title,
            'note'     => $note,
        ]);
    }

    public static function isCancelled(Order $order): bool
    {
        return $order->tracking_stage === 'cancelled';
    }

    public static function isDelivered(Order $order): bool
    {
        return $order->tracking_stage === 'delivered';
    }

    public static function isCod(Order $order): bool
    {
        // TODO: confirm exact field for COD (pay_method_id / payMethod->slug etc.)
        return $order->payMethod && str_contains(strtolower($order->payMethod->name ?? ''), 'cash');
    }

    /** Full real history, oldest first — this is what the customer page renders. */
    public static function history(Order $order)
    {
        return $order->statusLogs()->orderBy('created_at')->get();
    }
}
