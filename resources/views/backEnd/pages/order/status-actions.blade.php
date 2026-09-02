{{-- status-actions.blade.php --}}

{{-- @extends('backEnd.layouts.master')

@section('adminContent')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Order #{{ $order->order_no }}</h4>
            <p class="text-muted">Customer: {{ $order->shipping_name }} — Stage:
                <strong>{{ ucfirst(str_replace('_', ' ', $order->tracking_stage)) }}</strong>
            </p>

            @if (session('success'))
                <div class="alert alert-success py-2">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger py-2">{{ session('error') }}</div>
            @endif

            @if ($order->tracking_stage === 'placed' && !\App\Services\OrderStatusService::isCod($order))
                <form action="{{ route('admin.orders.confirm', $order) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Mark as Confirmed (Paid Online)</button>
                </form>
            @endif

            @if (in_array($order->tracking_stage, ['placed', 'confirmation_pending']) &&
                    \App\Services\OrderStatusService::isCod($order))
                <div class="border rounded p-2 mb-2">
                    <p class="mb-2 small">Call attempts: <strong>{{ $order->call_attempts }} / 3</strong></p>
                    <form action="{{ route('admin.orders.call-attempt', $order) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="result" value="confirmed">
                        <button type="submit" class="btn btn-success btn-sm">Customer Confirmed</button>
                    </form>
                    <form action="{{ route('admin.orders.call-attempt', $order) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="result" value="no_response">
                        <button type="submit" class="btn btn-warning btn-sm">No Response</button>
                    </form>
                </div>
            @endif

            @if ($order->tracking_stage === 'confirmed')
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="status" value="processing">
                    <button type="submit" class="btn btn-primary btn-sm">Move to Processing</button>
                </form>
            @endif

            @if ($order->tracking_stage === 'processing')
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="status" value="shipped">
                    <button type="submit" class="btn btn-primary btn-sm">Mark as Shipped</button>
                </form>
            @endif

            @if ($order->tracking_stage === 'shipped')
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="status" value="delivered">
                    <button type="submit" class="btn btn-success btn-sm">Mark as Delivered</button>
                </form>
            @endif

            @if (!in_array($order->tracking_stage, ['cancelled', 'delivered']))
                <div class="border rounded p-2 mt-2">
                    <form action="{{ route('admin.orders.cancel', $order) }}" method="POST"
                        onsubmit="return confirm('Cancel this order?')">
                        @csrf
                        <label class="form-label small mb-1">Cancellation reason</label>
                        <textarea name="reason" class="form-control form-control-sm mb-2" rows="2" required
                            placeholder="e.g. No response after 3 call attempts."></textarea>
                        <button type="submit" class="btn btn-outline-danger btn-sm">Cancel Order</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection --}}
