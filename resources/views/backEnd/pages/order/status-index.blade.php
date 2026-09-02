{{-- status-index.blade.php --}}

@extends('backEnd.layouts.master')

@section('adminContent')
    <link href="{{ asset('backAssets/css/status-index.css') }}" rel="stylesheet">



    <!-- Header -->
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
        <div>
            <h1 class="fw-800 mb-1" style="font-size:1.85rem;">Order Management</h1>
            {{-- <p class="text-muted mb-0">Review and manage habitat service requests and product sales.</p> --}}
        </div>
        {{-- <button class="btn text-white rounded-pill px-4 py-2 fw-semibold d-flex align-items-center gap-2"
            style="background: var(--primary);">
            <span class="material-symbols-outlined">add</span> Create New Service
        </button> --}}
    </div>

    <!-- Stats -->
    <div class="row row-cols-2 row-cols-md-5 g-3 mb-4">
        <div class="col">
            <div class="glass-card stat-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon" style="background: var(--primary-container); color: var(--on-primary-container);">
                        <span class="material-symbols-outlined">shopping_cart</span>
                    </div>
                    <span class="badge-soft"
                        style="background: var(--secondary-container); color: var(--on-secondary-container);">+12%</span>
                </div>
                <p class="stat-label mb-0">Total Orders</p>
                <h3 class="stat-value">{{ number_format($totalOrders) }}</h3>
            </div>
        </div>
        <div class="col">
            <div class="glass-card stat-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon"
                        style="background: var(--tertiary-container); color: var(--on-tertiary-container);">
                        <span class="material-symbols-outlined">pending_actions</span>
                    </div>
                    <span class="badge-soft"
                        style="background: var(--tertiary-container); color: var(--tertiary);">Urgent</span>
                </div>
                <p class="stat-label mb-0">Pending Confirmations</p>
                <h3 class="stat-value">{{ number_format($pendingConfirmations) }}</h3>
            </div>
        </div>
        <div class="col">
            <div class="glass-card stat-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon"
                        style="background: var(--secondary-container); color: var(--on-secondary-container);">
                        <span class="material-symbols-outlined">diversity_3</span>
                    </div>
                </div>
                <p class="stat-label mb-0">In-Progress</p>
                <h3 class="stat-value">{{ number_format($inProgress) }}</h3>
            </div>
        </div>
        <div class="col">
            <div class="glass-card stat-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon" style="background: var(--surface-container-highest); color: #57534e;">
                        <span class="material-symbols-outlined">task_alt</span>
                    </div>
                    <span class="badge-soft" style="color: var(--primary);">Daily Goal</span>
                </div>
                <p class="stat-label mb-0">Completed Today</p>
                <h3 class="stat-value">{{ number_format($completedToday) }}</h3>
            </div>
        </div>
        <div class="col">
            <div class="glass-card stat-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon" style="background: red; color: #57534e;">
                        <span class="material-symbols-outlined" style="color: white;">
                            cancel_presentation
                        </span>
                    </div>
                </div>
                <p class="stat-label mb-0">Cancelled Orders</p>
                <h3 class="stat-value">{{ number_format($cancelledOrders) }}</h3>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="glass-card overflow-hidden">

        <!-- Filter bar -->
        <div class="row p-3 p-md-4 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-3"
            style="border-color: rgba(177,178,175,0.1) !important;">

            <div class="col-md-8 d-flex align-items-center gap-2">

                <div class="position-relative">
                    <input type="text" id="orderSearch" class="filter-select ps-4" style="min-width:170px;"
                        placeholder="Search Order No." value="{{ request('order_no') }}">
                </div>

                <select name="status_filter" id="statusFilter" class="filter-select">
                    <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>All Statuses</option>
                    <option value="placed" {{ request('status') === 'placed' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmation_pending"
                        {{ request('status') === 'confirmation_pending' ? 'selected' : '' }}>Confirmation Pending</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing
                    </option>
                    <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Out for Delivery
                    </option>
                    <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>

                <select name="payment_status_filter" id="paymentStatusFilter" class="filter-select">
                    <option value="all" {{ request('payment_status', 'all') === 'all' ? 'selected' : '' }}>All Payments
                    </option>
                    <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Pending
                    </option>
                    <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ request('payment_status') === 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ request('payment_status') === 'refunded' ? 'selected' : '' }}>Refunded
                    </option>
                </select>

                <select class="filter-select">
                    <option>Last 30 Days</option>
                    <option>Today</option>
                    <option>This Week</option>
                    <option>Custom Range</option>
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-center">
                <button class="btn topbar-icon-btn"><span class="material-symbols-outlined">print</span></button>
                <button class="btn topbar-icon-btn"><span class="material-symbols-outlined">download</span></button>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table order-table mb-0">
                <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date &amp; Time</th>
                        <th>Total Amount</th>
                        <th>Transaction No.</th>
                        <th>Payment</th>
                        <th>Manual Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $stageBadgeMap = [
                            'placed' => ['class' => 'status-pending', 'label' => 'Pending'],
                            'confirmation_pending' => [
                                'class' => 'status-pending',
                                'label' => 'Confirmation Pending',
                            ],
                            'confirmed' => ['class' => 'status-confirmed', 'label' => 'Confirmed'],
                            'processing' => ['class' => 'status-processing', 'label' => 'Processing'],
                            'shipped' => ['class' => 'status-outfordelivery', 'label' => 'Out for Delivery'],
                            'delivered' => ['class' => 'status-delivered', 'label' => 'Delivered'],
                            'cancelled' => ['class' => 'status-cancelled', 'label' => 'Cancelled'],
                        ];

                        $paymentStyles = [
                            'pending' =>
                                'background: var(--secondary-container); color: var(--on-secondary-container);',
                            'paid' => 'background: #15803d; color: #ffffff;',
                            'failed' => 'background: var(--error-container); color: var(--on-error-container);',
                            'refunded' => 'background: #fbbe10; color: #585555;',
                        ];
                    @endphp

                    @foreach ($orders as $order)
                        @php
                            $badge = $stageBadgeMap[$order->tracking_stage] ?? [
                                'class' => 'status-pending',
                                'label' => ucfirst($order->tracking_stage),
                            ];
                        @endphp

                        <tr class="order-row">
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="fw-bold" style="color: var(--primary);">#{{ $order->order_no }}</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-circle" style="background:#ffedd5; color: var(--primary);">
                                        {{ strtoupper(substr($order->shipping_name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-bold" style="font-size:0.85rem;">{{ $order->shipping_name }}
                                        </p>
                                        <p class="mb-0 text-muted" style="font-size:0.72rem;">
                                            {{ $order->shipping_email }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0" style="font-size:0.85rem;">{{ $order->created_at->format('M j, Y') }}
                                </p>
                                <p class="mb-0 text-muted" style="font-size:0.72rem;">
                                    {{ $order->created_at->format('g:i A') }}</p>
                            </td>
                            <td><span class="fw-bold"
                                    style="font-size:0.85rem;">${{ number_format($order->total, 2) }}</span>
                            </td>

                            <td>
                                <span class="pay-badge">{{ $order->transaction_no ?? '' }}</span>
                            </td>


                            <td>
                                <span class="pay-badge" style="{{ $paymentStyles[$order->payment_status] ?? '' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td>
                                <button class="btn-status-change {{ $badge['class'] }}" data-bs-toggle="offcanvas"
                                    data-bs-target="#statusDrawer{{ $order->id }}">
                                    <span class="material-symbols-outlined" style="font-size:13px;">edit</span>
                                    {{ $badge['label'] }}
                                </button>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm rounded-pill border d-inline-flex align-items-center gap-1"
                                    style="font-size:0.72rem; font-weight:700;" data-bs-toggle="offcanvas"
                                    data-bs-target="#orderDrawer{{ $order->id }}">
                                    <span class="material-symbols-outlined" style="font-size:14px;">visibility</span> View
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-3 p-md-4 border-top d-flex flex-wrap align-items-center justify-content-between gap-2"
            style="border-color: rgba(177,178,175,0.1) !important;">
            <p class="mb-0 text-muted" style="font-size:0.75rem;">
                Showing
                <span class="fw-bold text-dark">{{ $orders->firstItem() ?? 0 }} - {{ $orders->lastItem() ?? 0 }}</span>
                of
                <span class="fw-bold text-dark">{{ $orders->total() }}</span>
                orders
            </p>
            <div class="d-flex align-items-center gap-2">
                {{-- Previous --}}
                @if ($orders->onFirstPage())
                    <button class="page-btn" disabled>
                        <span class="material-symbols-outlined" style="font-size:16px;">chevron_left</span>
                    </button>
                @else
                    <a href="{{ $orders->previousPageUrl() }}" class="page-btn">
                        <span class="material-symbols-outlined" style="font-size:16px;">chevron_left</span>
                    </a>
                @endif

                {{-- Page Numbers --}}
                @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                    <a href="{{ $url }}"
                        class="page-btn {{ $page == $orders->currentPage() ? 'active' : '' }}">
                        {{ $page }}
                    </a>
                @endforeach

                {{-- Next --}}
                @if ($orders->hasMorePages())
                    <a href="{{ $orders->nextPageUrl() }}" class="page-btn">
                        <span class="material-symbols-outlined" style="font-size:16px;">chevron_right</span>
                    </a>
                @else
                    <button class="page-btn" disabled>
                        <span class="material-symbols-outlined" style="font-size:16px;">chevron_right</span>
                    </button>
                @endif
            </div>
        </div>
    </div>




    <!-- Status Change Offcanvas Drawer -->
    @foreach ($orders as $order)
        <div class="offcanvas offcanvas-end offcanvas-order" tabindex="-1" id="statusDrawer{{ $order->id }}">
            <div class="offcanvas-header">
                <div>
                    <span class="fw-bold"
                        style="font-size:0.7rem; letter-spacing:0.08em; text-transform:uppercase; color: var(--primary);">Manage
                        Status</span>
                    <h2 class="mb-0 fw-bold" style="font-size:1.3rem;">#{{ $order->order_no }}</h2>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column gap-4">

                @if (session('success'))
                    <div class="alert alert-success py-2">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger py-2">{{ session('error') }}</div>
                @endif

                <div class="status-manage-box">
                    <p class="drawer-section-title mb-2">Current Stage</p>
                    <span class="status-btn {{ $stageBadgeMap[$order->tracking_stage]['class'] ?? 'status-pending' }}"
                        style="width:auto;">
                        {{ $stageBadgeMap[$order->tracking_stage]['label'] ?? ucfirst($order->tracking_stage) }}
                    </span>
                    <p class="text-muted mt-2 mb-0" style="font-size:0.8rem;">Customer: {{ $order->shipping_name }}</p>
                </div>

                @if ($order->tracking_stage === 'placed' && !\App\Services\OrderStatusService::isCod($order))
                    <div>
                        <h4 class="drawer-section-title mb-2">Confirm Order</h4>
                        <form action="{{ route('admin.orders.confirm', $order) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-action btn-action-primary w-100">Mark as Confirmed (Paid
                                Online)</button>
                        </form>
                    </div>
                @endif

                @if (in_array($order->tracking_stage, ['placed', 'confirmation_pending']) &&
                        \App\Services\OrderStatusService::isCod($order))
                    <div>
                        <h4 class="drawer-section-title mb-2">Confirmation Call</h4>
                        <p class="text-muted mb-2" style="font-size:0.8rem;">Call attempts:
                            <strong>{{ $order->call_attempts }}</strong>
                        </p>
                        <div class="d-flex flex-column gap-2">
                            <form action="{{ route('admin.orders.call-attempt', $order) }}" method="POST">
                                @csrf
                                <input type="hidden" name="result" value="confirmed">
                                <button type="submit" class="btn-action btn-action-soft-success w-100">Customer
                                    Confirmed</button>
                            </form>
                            <form action="{{ route('admin.orders.call-attempt', $order) }}" method="POST">
                                @csrf
                                <input type="hidden" name="result" value="no_response">
                                <button type="submit" class="btn-action btn-action-soft-warning w-100">No
                                    Response</button>
                            </form>
                        </div>
                    </div>
                @endif

                @if ($order->tracking_stage === 'confirmed')
                    <div>
                        <h4 class="drawer-section-title mb-2">Move Order Forward</h4>
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="processing">
                            <button type="submit" class="btn-action btn-action-primary w-100">Move to Processing</button>
                        </form>
                    </div>
                @endif

                @if ($order->tracking_stage === 'processing')
                    <div>
                        <h4 class="drawer-section-title mb-2">Move Order Forward</h4>
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="shipped">
                            <button type="submit" class="btn-action btn-action-primary w-100">Hand Over to Logistics
                                Partner</button>
                        </form>
                    </div>
                @endif

                @if ($order->tracking_stage === 'shipped')
                    <div>
                        <h4 class="drawer-section-title mb-2">Complete Delivery</h4>
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="delivered">
                            <button type="submit" class="btn-action btn-action-soft-success w-100">Mark as
                                Delivered</button>
                        </form>
                    </div>
                @endif

                @if (in_array($order->tracking_stage, ['delivered', 'cancelled']))
                    <div class="text-center py-3">
                        <span class="material-symbols-outlined"
                            style="font-size:36px; color: var(--secondary);">task_alt</span>
                        <p class="text-muted mt-2 mb-0" style="font-size:0.82rem;">This order is closed. No further
                            actions available.</p>
                    </div>
                @else
                    <div>
                        <h4 class="drawer-section-title mb-2">Cancel Order</h4>
                        <form action="{{ route('admin.orders.cancel', $order) }}" method="POST"
                            onsubmit="return confirm('Cancel this order?')">
                            @csrf
                            <textarea name="reason" class="drawer-note mb-2" style="height:80px;" placeholder="Cancellation reason..."
                                required></textarea>
                            <button type="submit" class="btn-action btn-action-outline-danger w-100">Cancel
                                Order</button>
                        </form>
                    </div>
                @endif

            </div>
        </div>


        <!-- Order Details Offcanvas Drawer -->
        <div class="offcanvas offcanvas-end offcanvas-order" tabindex="-1" id="orderDrawer{{ $order->id }}">
            <div class="offcanvas-header">
                <div>
                    <span class="fw-bold"
                        style="font-size:0.7rem; letter-spacing:0.08em; text-transform:uppercase; color: var(--primary);">Order
                        Details</span>
                    <h2 class="mb-0 fw-bold" style="font-size:1.3rem;">#{{ $order->order_no }}</h2>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column gap-4">

                <div class="drawer-customer-block d-flex align-items-center gap-3">
                    <div class="drawer-avatar">{{ strtoupper(substr($order->shipping_name, 0, 2)) }}</div>
                    <div>
                        <p class="mb-0 fw-bold">{{ $order->shipping_name }}</p>
                        <p class="mb-0 text-muted" style="font-size:0.85rem;">{{ $order->shipping_mobile }}</p>
                        <p class="mb-0 text-muted" style="font-size:0.85rem;">{{ $order->shipping_email }}</p>
                        <div class="d-flex gap-2 mt-2">
                            <span class="pay-badge"
                                style="{{ $paymentStyles[$order->payment_status] ?? '' }}">{{ ucfirst($order->payment_status) }}</span>
                            <span class="pay-badge status-pending"
                                style="border-width:1px; border-style:solid;">{{ ucfirst($order->status) }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="drawer-section-title mb-2">
                        <span class="material-symbols-outlined" style="font-size:16px;">location_on</span> Delivery
                        Address
                    </h4>
                    <div class="p-3 rounded-3"
                        style="background: var(--surface-container-low); border: 1px solid rgba(177,178,175,0.1);">
                        <p class="mb-0" style="font-size:0.85rem; line-height:1.6;">
                            {!! nl2br(e($order->shipping_address)) !!}
                            @if ($order->shipping_zone)
                                <br>
                                <span class="text-muted" style="font-size:0.75rem;">{{ $order->shipping_zone }}</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div>
                    <h4 class="drawer-section-title mb-3">Order Summary</h4>
                    <div class="d-flex flex-column gap-3">
                        @if ($order->items->isNotEmpty())
                            @foreach ($order->items as $item)
                                <div class="d-flex align-items-center gap-3">
                                    <div class="item-thumb">
                                        <span
                                            class="fw-bold text-muted">{{ strtoupper(substr($item->product_name, 0, 2)) }}</span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0 fw-bold" style="font-size:0.85rem;">{{ $item->product_name }}</p>
                                        <p class="mb-0 text-muted" style="font-size:0.75rem;">Qty: {{ $item->quantity }}
                                        </p>
                                    </div>
                                    <p class="mb-0 fw-bold" style="font-size:0.85rem;">
                                        ${{ number_format($item->subtotal, 2) }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="mb-0 text-muted" style="font-size:0.85rem;">No items found for this order.</p>
                        @endif
                    </div>
                </div>

                <div class="summary-box">
                    <div class="d-flex justify-content-between text-muted mb-2" style="font-size:0.78rem;">
                        <span>Subtotal</span><span>${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between text-muted mb-2" style="font-size:0.78rem;">
                        <span>Discount</span><span>${{ number_format($order->discount_amount, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between text-muted mb-2" style="font-size:0.78rem;">
                        <span>Shipping</span><span>${{ number_format($order->shipping_charge, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold pt-2"
                        style="font-size:0.9rem; border-top: 1px solid rgba(177,178,175,0.15);">
                        <span>Total Amount</span><span>${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>

                <div>
                    <h4 class="drawer-section-title mb-2">Internal Notes</h4>
                    <textarea class="drawer-note" placeholder="Add a note for the team...">{{ $order->cancelled_reason ?: 'No internal notes yet.' }}</textarea>
                </div>

                <div class="drawer-customer-block d-flex flex-column align-items-center gap-3">
                    <div class="">
                        <p class="mb-0 text-muted" style="font-size:0.85rem;">Transaction ID:
                            {{ $order->transaction_no ?: 'N/A' }}</p>
                    </div>
                    @if ($order->payment_screenshot)
                        <img class="justify-content-center rounded-2xl" src="{{ asset($order->payment_screenshot) }}"
                            alt="Transaction Image" style="width: 100%; height: 200px; object-fit: cover;">
                    @else
                        <img class="justify-content-center rounded-2xl"
                            src="https://upload.wikimedia.org/wikipedia/commons/b/b6/Image_created_with_a_mobile_phone.png"
                            alt="Transaction Image" style="width: 100%; height: 200px; object-fit: cover;">
                    @endif
                </div>

            </div>
        </div>
    @endforeach



    <script>
        // Mobile sidebar open/close
        const sidebar = document.querySelector('.sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        const menuBtn = document.getElementById('mobileMenuBtn');
        const closeBtn = document.getElementById('sidebarCloseBtn');

        function openSidebar() {
            sidebar.classList.add('show-mobile');
            backdrop.classList.add('show');
        }

        function closeSidebar() {
            sidebar.classList.remove('show-mobile');
            backdrop.classList.remove('show');
        }

        menuBtn.addEventListener('click', openSidebar);
        closeBtn.addEventListener('click', closeSidebar);
        backdrop.addEventListener('click', closeSidebar);

        // Auto-close sidebar if resized back to desktop width
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) closeSidebar();
        });

    </script>


    <script>
        // Shared helper: update one URL query param without wiping the others
        function updateFilterParam(key, value) {
            var url = new URL(window.location.href);
            url.searchParams.set(key, value);
            window.history.pushState({}, '', url.toString());
            refreshOrderTable();
        }

        // Status dropdown
        $('#statusFilter').change(function() {
            updateFilterParam('status', $(this).val());
        });

        // Payment status dropdown
        $('#paymentStatusFilter').change(function() {
            updateFilterParam('payment_status', $(this).val());
        });

        // Order No. search — debounced so it doesn't fire on every keystroke
        let orderSearchTimer;
        $('#orderSearch').on('keyup', function() {
            clearTimeout(orderSearchTimer);
            var value = $(this).val();
            orderSearchTimer = setTimeout(function() {
                updateFilterParam('order_no', value);
            }, 400); // waits 400ms after typing stops before searching
        });

        // Dynamic Table Refresh helper function
        function refreshOrderTable() {
            let currentUrl = window.location.href;
            $.ajax({
                url: currentUrl,
                type: 'GET',
                success: function(response) {
                    let newTbody = $(response).find('.order-table tbody').html();
                    $('.order-table tbody').html(newTbody);
                },
                error: function() {
                    toastr.error('Failed to refresh order table.');
                }
            });
        }
    </script>
@endsection
