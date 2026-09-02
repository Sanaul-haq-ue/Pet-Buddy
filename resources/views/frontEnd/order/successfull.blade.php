<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

<!-- Fonts (used by successfull.css) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be+Vietnam+Pro:wght@300;400;500;600&display=swap"
    rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/successfull.css') }}">


<main class="page-main">
    <!-- Atmospheric Background -->
    <div class="radiant-glow"></div>
    <div class="secondary-glow"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 text-center" id="main-content">

                {{-- <!-- Success Icon -->
                <div class="success-icon-wrapper">
                    <div class="celebratory-ring"></div>
                    <div class="success-icon-circle-outer glass-card">
                        <div class="success-icon-circle-inner">
                            <span class="material-symbols-outlined">check</span>
                        </div>
                    </div>
                </div> --}}
                <div class="info-banner">
                    <i class="fa-solid fa-circle-info"></i>
                    <p class="info-text">
                        Your order is being processed and will be confirmed within the next 24 hours.
                    </p>
                </div>

                <!-- Heading -->
                <h1 class="page-title font-display">
                    Your order has been placed successfully!
                </h1>
                <p class="page-subtitle">
                    Order <span class="order-id">#{{ $order->order_no }}</span> &bull;
                    Confirmation sent to <span style="text-decoration: underline;">{{ $order->shipping_email }}</span>
                </p>


                <!-- Order Summary Card -->
                <div class="glass-card order-card">
                    <div class="order-card-header">
                        <h2 class="order-card-title font-display">Order Summary</h2>
                        <span class="delivery-badge font-label">EST. DELIVERY: {{ $estimatedDelivery }}</span>
                    </div>

                    <!-- Product Items (scrolls internally if the list is long, so totals/buttons stay visible) -->
                    <div class="product-list">
                        @foreach ($order->items as $item)
                            <div class="product-row">
                                <div class="product-image-wrap">
                                    <img src="{{ asset($item->product->image) }}"
                                        alt="{{ $item->product->product_name }}">

                                </div>
                                <div class="flex-grow-1">
                                    <p class="product-name font-display">{{ $item->product->product_name }}</p>
                                    <p class="product-price font-display">৳{{ number_format($item->price, 2) }}</p>
                                </div>
                                <div class="text-end">
                                    <span class="product-qty">Qty: {{ $item->quantity }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr class="card-divider">

                    <!-- Price Breakdown -->
                    <div class="price-row">
                        <span>Subtotal</span>
                        <span>৳{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="price-row">
                        <span>Shipping</span>
                        <span class="free">
                            @if ($order->shipping_charge > 0)
                                ৳{{ number_format($order->shipping_charge, 2) }}
                            @else
                                Free
                            @endif
                        </span>
                    </div>
                    @if ($order->discount_amount > 0)
                        <div class="price-row">
                            <span>Discount</span>
                            <span style="color:#16a34a; font-weight:600;">-
                                ৳{{ number_format($order->discount_amount, 2) }}</span>
                        </div>
                    @endif
                    <div class="price-total-row font-display">
                        <span>Total</span>
                        <span>৳{{ number_format($order->total, 2) }}</span>
                    </div>

                    {{-- Payment details row --}}
                    <div class="payment-row font-display">
                        <span>Payment Details</span>
                        <span>
                            {{ $order->payType?->name ?? 'N/A' }}
                            @if ($order->payMethod)
                                — {{ $order->payMethod->name }}
                            @endif
                        </span>
                    </div>


                </div>

                <!-- Action Buttons -->
                <div class="btn-action-row">

                    <a class="btn-track font-display" href="{{ route('track.order.form') }}">Track Order</a>

                    <a href="{{ route('order.invoice', $order->order_no) }}"
                        class="btn-invoice glass-card font-display">
                        <i class="fa-solid fa-download"></i>
                        Download Invoice
                    </a>
                    <div class="btn-split-row">
                        <a href="{{ route('user.dashboard') }}"
                            class="btn-secondary-action glass-card font-display">View Order Details</a>
                        <a href="{{ route('shop') }}" class="btn-ghost-action glass-card font-display">Continue
                            Shopping</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>




<script>
    document.addEventListener('DOMContentLoaded', () => {
        const mainContent = document.getElementById('main-content');
        mainContent.style.opacity = '0';
        mainContent.style.transform = 'translateY(20px)';
        mainContent.style.transition = 'all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1)';
        setTimeout(() => {
            mainContent.style.opacity = '1';
            mainContent.style.transform = 'translateY(0)';
        }, 100);
    });
</script>
