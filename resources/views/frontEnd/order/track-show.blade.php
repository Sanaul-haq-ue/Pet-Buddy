<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Status | Radiant Habitat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be+Vietnam+Pro:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #944c00;
            --primary-container: #ffaf72;
            --on-primary: #fff7f4;
            --on-primary-container: #602f00;
            --secondary: #006b63;
            --on-surface: #303330;
            --on-surface-variant: #5d605c;
            --outline: #797b78;
            --surface: #faf9f6;
            --surface-container-low: #f4f4f0;
            --surface-variant: #e1e3df;
            --font-headline: 'Plus Jakarta Sans', sans-serif;
            --font-body: 'Be Vietnam Pro', sans-serif;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--surface);
            color: var(--on-surface);
            margin: 0;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1.5px solid rgba(177, 178, 175, 0.15);
            border-radius: 1.5rem;
        }

        .signature-glow {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-container) 100%);
        }

        /* ===== Full viewport wrapper ===== */
        main.status-main {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 1.25rem 1rem;
        }

        /* Allow scroll only if content genuinely can't fit (short screens) */
        @media (max-height: 700px) {
            main.status-main {
                align-items: flex-start;
                overflow-y: auto;
            }
        }

        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            z-index: -1;
        }

        .bg-blob-1 {
            top: -5rem;
            right: -5rem;
            width: 300px;
            height: 300px;
            background: rgba(255, 175, 114, 0.2);
        }

        .bg-blob-2 {
            bottom: -5rem;
            left: -5rem;
            width: 220px;
            height: 220px;
            background: rgba(132, 245, 232, 0.2);
        }

        .status-wrapper {
            width: 100%;
            max-width: 640px;
        }

        .status-eyebrow {
            font-family: var(--font-headline);
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--primary);
        }

        .status-heading {
            font-family: var(--font-headline);
            font-weight: 700;
            font-size: 1.35rem;
            line-height: 1.25;
        }

        @media (min-width: 768px) {
            .status-heading {
                font-size: 1.85rem;
            }
        }

        .status-card {
            padding: 1.25rem 1.1rem;
            position: relative;
            overflow: hidden;
        }

        @media (min-width: 576px) {
            .status-card {
                padding: 1.75rem 2rem;
            }
        }

        .breakout-img {
            position: absolute;
            top: -1.25rem;
            right: -1.25rem;
            width: 90px;
            height: 90px;
            opacity: 0.18;
            pointer-events: none;
        }

        @media (min-width: 576px) {
            .breakout-img {
                width: 130px;
                height: 130px;
            }
        }

        /* ===== Compact Timeline ===== */
        .timeline {
            position: relative;
        }

        .timeline-item {
            display: flex;
            gap: 0.85rem;
            padding-bottom: 1.1rem;
            position: relative;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .step-line {
            position: absolute;
            left: 1rem;
            top: 2.1rem;
            bottom: 0;
            width: 2px;
            background: rgba(177, 178, 175, 0.3);
        }

        .step-line-active {
            background: var(--primary);
        }

        .step-icon {
            z-index: 1;
            flex-shrink: 0;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--on-primary);
        }

        .step-icon .material-symbols-outlined {
            font-size: 18px;
        }

        .step-icon.done {
            background: var(--primary);
            box-shadow: 0 6px 12px rgba(148, 76, 0, 0.2);
        }

        .step-icon.pending {
            background: var(--surface-variant);
            color: var(--outline);
        }

        .step-icon.current {
            box-shadow: 0 0 0 3px rgba(255, 175, 114, 0.3);
        }

        .spin-slow {
            animation: spin-slow 12s linear infinite;
            display: inline-block;
        }

        @keyframes spin-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .step-title {
            font-family: var(--font-headline);
            font-weight: 700;
            font-size: 0.92rem;
            margin-bottom: 0.1rem;
        }

        .step-desc {
            color: var(--on-surface-variant);
            font-size: 0.78rem;
            margin: 0;
            line-height: 1.4;
        }

        .step-pending-wrap {
            opacity: 0.5;
        }

        .current-box {
            background: var(--surface-container-low);
            border: 1px solid rgba(148, 76, 0, 0.1);
            border-radius: 0.85rem;
            padding: 0.75rem 0.9rem;
            flex-grow: 1;
        }

        .current-box .step-title {
            color: var(--primary);
            font-weight: 800;
            margin-bottom: 0;
            font-size: 0.92rem;
        }

        .current-badge {
            background: var(--primary-container);
            color: var(--on-primary-container);
            font-size: 0.6rem;
            font-weight: 700;
            padding: 0.1rem 0.45rem;
            border-radius: 9999px;
            text-transform: uppercase;
            white-space: nowrap;
        }
    </style>
</head>

<body>

    <main class="status-main">
        <div class="bg-blob bg-blob-1"></div>
        <div class="bg-blob bg-blob-2"></div>

        <div class="status-wrapper">

            <!-- Header -->
            <div class="text-center mb-3 px-2">
                <span class="status-eyebrow d-block mb-1">Tracking Status</span>
                <h1 class="status-heading mb-1">
                    @if ($isCancelled)
                        Order Cancelled
                    @elseif ($isDelivered)
                        Delivered
                    @else
                        Your Sanctuary Box is on its way
                    @endif
                </h1>
                <p class="text-muted mb-0" style="font-size: 0.85rem;">Order ID: <span class="fw-bold"
                        style="color: var(--primary);">#{{ $order->order_no }}</span></p>
            </div>

            <!-- Status Card -->
            <!-- Status Card -->
            <div class="glass-card status-card">
                <img class="breakout-img"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDEoaE2Csh2mpvCaWV38vEpRkGgQ1pqDMrbzz45k9pnwztpwr-5Ki0Y-LzTeQKjnA3dZrC58NIOtPKTJhVELOxBXMRarDQtlEuNfMq29SdbXCoIkHxOBSLYgvW1Yz_txp9gWyCPY8CbwhFYIjrDcedL6lduYKCrnSTLz2EpHW-7noot_1W9qql6EIedG"
                    alt="">

                <div class="timeline">
                    @foreach ($history as $log)
                        @php
                            $isCancelledRow = $log->stage === 'cancelled';
                        @endphp

                        <div class="timeline-item {{ $loop->last ? 'mb-0' : '' }}"
                            @if ($loop->last) style="padding-bottom:0;" @endif>

                            @unless ($loop->last)
                                <div class="step-line step-line-active"></div>
                            @endunless

                            <div class="step-icon {{ $isCancelledRow ? '' : ($loop->last && !$isDelivered ? 'current signature-glow' : 'done') }}"
                                @if ($isCancelledRow) style="background: #aa371c;" @endif>
                                <span
                                    class="material-symbols-outlined {{ $loop->last && !$isDelivered && !$isCancelledRow ? 'spin-slow' : '' }}"
                                    style="font-variation-settings: 'FILL' 1;">
                                    {{ $isCancelledRow ? 'cancel' : 'check_circle' }}
                                </span>
                            </div>

                            @if ($loop->last)
                                <div class="current-box"
                                    @if ($isCancelledRow) style="background: rgba(170,55,28,0.06); border-color: rgba(170,55,28,0.15);" @endif>
                                    <div class="d-flex justify-content-between align-items-start mb-1 gap-2">
                                        <h3 class="step-title mb-0"
                                            @if ($isCancelledRow) style="color:#aa371c;" @endif>
                                            {{ $log->title }}</h3>
                                        @if ($isCancelledRow)
                                            <span class="current-badge"
                                                style="background:#aa371c; color:#fff;">Cancelled</span>
                                        @elseif (!$isDelivered)
                                            <span class="current-badge">Current</span>
                                        @endif
                                    </div>
                                    @if ($log->note)
                                        <p class="step-desc mb-1">{{ $log->note }}</p>
                                    @endif
                                    <p class="step-desc">{{ $log->created_at->format('d M Y') }}</p>
                                </div>
                            @else
                                <div>
                                    <h3 class="step-title">{{ $log->title }}</h3>
                                    @if ($log->note)
                                        <p class="step-desc mb-0">{{ $log->note }}</p>
                                    @endif
                                    <p class="step-desc">{{ $log->created_at->format('d M Y') }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
