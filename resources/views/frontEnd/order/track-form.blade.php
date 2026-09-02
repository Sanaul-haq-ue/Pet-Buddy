<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Track Order | Radiant Habitat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Be+Vietnam+Pro:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #944c00;
            --primary-dim: #824200;
            --primary-container: #ffaf72;
            --on-primary: #fff7f4;
            --on-primary-container: #602f00;
            --secondary: #006b63;
            --on-surface: #303330;
            --on-surface-variant: #5d605c;
            --surface: #faf9f6;
            --surface-container-low: #f4f4f0;
            --font-headline: 'Plus Jakarta Sans', sans-serif;
            --font-body: 'Be Vietnam Pro', sans-serif;
        }

        html,
        body {
            height: 100%;
        }

        body {
            background-color: var(--surface);
            color: var(--on-surface);
            font-family: var(--font-body);
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        /* ===== Main Canvas ===== */
        main.track-main {
            flex: 1 1 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 20% 30%, rgba(255, 175, 114, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(132, 245, 232, 0.10) 0%, transparent 40%);
        }

        .bg-blob {
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            filter: blur(60px);
            z-index: 0;
        }

        .bg-blob-1 {
            top: -4rem;
            left: -4rem;
            background: rgba(255, 175, 114, 0.2);
        }

        .bg-blob-2 {
            bottom: -4rem;
            right: -4rem;
            background: rgba(132, 245, 232, 0.2);
        }

        .track-wrapper {
            position: relative;
            width: 100%;
            max-width: 480px;
            z-index: 1;
        }

        /* Floating decorative image (desktop only) */
        .float-img {
            position: absolute;
            z-index: 2;
            display: none;
        }

        .float-img-1 {
            top: -2.25rem;
            right: -1.25rem;
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 0.85rem;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
            transform: rotate(12deg);
            border: 3px solid #fff;
            animation: floatBounce 6s ease-in-out infinite;
        }

        @keyframes floatBounce {

            0%,
            100% {
                transform: rotate(12deg) translateY(0);
            }

            50% {
                transform: rotate(12deg) translateY(-10px);
            }
        }

        @media (min-width: 768px) {
            .float-img {
                display: block;
            }
        }

        /* Glass card */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1.5px solid rgba(177, 178, 175, 0.15);
            box-shadow: 0 20px 40px rgba(148, 76, 0, 0.06);
            border-radius: 1.5rem;
            padding: 1.5rem 1.25rem;
            position: relative;
            z-index: 1;
        }

        @media (min-width: 576px) {
            .glass-card {
                padding: 2rem;
            }
        }

        .track-title {
            font-family: var(--font-headline);
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.02em;
            margin-bottom: 0.4rem;
        }

        @media (min-width: 576px) {
            .track-title {
                font-size: 1.85rem;
            }
        }

        .track-subtitle {
            color: var(--on-surface-variant);
            font-size: 0.88rem;
            max-width: 360px;
            margin: 0 auto;
            line-height: 1.5;
        }

        .field-label {
            font-family: var(--font-headline);
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--on-surface-variant);
            display: flex;
            align-items: center;
            gap: 0.35rem;
            margin-bottom: 0.3rem;
        }

        .input-underline {
            border: none;
            border-bottom: 1px solid rgba(177, 178, 175, 0.4);
            background: transparent;
            border-radius: 0;
            padding: 0.5rem 0;
            font-family: var(--font-headline);
            font-size: 1rem;
            width: 100%;
            color: var(--on-surface);
        }

        .input-underline:focus {
            outline: none;
            box-shadow: none;
            border-bottom: 2px solid var(--secondary);
        }

        .btn-track-submit {
            width: 100%;
            background: var(--primary);
            color: var(--on-primary);
            border: none;
            padding: 0.8rem;
            border-radius: 9999px;
            font-family: var(--font-headline);
            font-weight: 700;
            font-size: 0.98rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 8px 18px rgba(148, 76, 0, 0.2);
            transition: transform 0.15s ease, background 0.15s ease;
        }

        .btn-track-submit:hover {
            background: var(--primary-dim);
            color: var(--on-primary);
            transform: scale(1.02);
        }

        .btn-track-submit .material-symbols-outlined {
            transition: transform 0.15s ease;
        }

        .btn-track-submit:hover .material-symbols-outlined {
            transform: translateX(4px);
        }

        .help-text {
            text-align: center;
            margin-top: 1rem;
            color: var(--on-surface-variant);
            font-size: 0.8rem;
        }

        .help-text a {
            color: var(--secondary);
            font-weight: 700;
            text-decoration: none;
        }

        .help-text a:hover {
            text-decoration: underline;
        }

        /* ===== Footer ===== */
        footer.site-footer {
            background: var(--surface-container-low);
            flex-shrink: 0;
        }

        .footer-brand {
            font-family: var(--font-headline);
            font-weight: 800;
            color: var(--primary);
            font-size: 1rem;
        }

        .footer-link {
            color: var(--on-surface-variant);
            text-decoration: none;
            font-size: 0.8rem;
        }

        .footer-link:hover {
            color: var(--secondary);
        }

        /* Short-viewport fallback so nothing gets clipped */
        @media (max-height: 700px) {
            body {
                height: auto;
            }

            main.track-main {
                padding: 2rem 1rem;
            }
        }
    </style>
</head>

<body>

    <!-- Main Content -->
    <main class="track-main">
        <div class="bg-blob bg-blob-1"></div>
        <div class="bg-blob bg-blob-2"></div>

        <div class="track-wrapper">

            <!-- Floating decorative image -->
            <img class="float-img float-img-1"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJZFYAX4-3qIZCL6RDMsT3dsgc92NYZTrv5nBsjbQJY463MEG1WB9Q9iuwDWAKW5Vh62Ye3TBUPcYlgn9Vmp7iZ_pTDUUkxLmeKB8oQHzdwOD-eRzR-RNfv9yDUzkOBsZmF0RPM_LEXcJ54Ve4S_sTAlXBqZ3PQReHLKvFvp3O_AlFOO1nF5xqOM29SdbXCoIkHxOBSLYgvW1Yz_txp9gWyCPY8CbwhFYIjrDcedL6lduYKCrnSTLz2EpHW-7noot_1W9qql6EIedG"
                alt="Happy golden retriever puppy">

            <!-- Glass Card -->
            <div class="glass-card">
                <div class="text-center mb-3">
                    <h1 class="track-title">Track Your Order</h1>
                    <p class="track-subtitle">Enter your details to see real-time updates on your pet's happiness
                        package.</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger py-2 mb-3" style="font-size: 0.85rem;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('track.order.search') }}" method="POST">
                    @csrf

                    <!-- Order Number -->
                    <div class="mb-3">
                        <label class="field-label">
                            <span class="material-symbols-outlined" style="font-size: 14px;">local_shipping</span>
                            Order Number
                        </label>
                        <input type="text" name="order_no" class="input-underline" placeholder="ORD-11111111"
                            value="{{ old('order_no') }}" required>
                    </div>

                    <!-- Mobile Number -->
                    <div class="mb-3">
                        <label class="field-label">
                            <span class="material-symbols-outlined" style="font-size: 14px;">smartphone</span>
                            Mobile Number
                        </label>
                        <input type="tel" name="mobile" class="input-underline" placeholder="010 0000 0000"
                            value="{{ old('mobile') }}" required>
                    </div>

                    <!-- Submit -->
                    <div class="pt-2">
                        <button type="submit" class="btn-track-submit">
                            Track Order
                            <span class="material-symbols-outlined" style="font-size: 20px;">arrow_forward</span>
                        </button>
                    </div>
                </form>

                <p class="help-text">
                    Can't find your order number?
                    <a href="#">Check your email</a> or
                    <a href="#">Contact Support</a>
                </p>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container-xl py-3">
            <div class="row align-items-center gy-2">
                <div class="col-12 col-md-4 text-center text-md-start">
                    <span class="footer-brand">Radiant Habitat.</span>
                    <span class="text-muted d-block d-md-inline ms-md-2" style="font-size: 0.78rem;">© 2024 A Luminous
                        Sanctuary for Pets.</span>
                </div>
                <div class="col-12 col-md-5">
                    <div class="d-flex flex-wrap gap-2 gap-md-3 justify-content-center">
                        <a class="footer-link" href="#">Privacy Policy</a>
                        <a class="footer-link" href="#">Terms of Service</a>
                        <a class="footer-link" href="#">Help Center</a>
                        <a class="footer-link" href="#">Contact Us</a>
                    </div>
                </div>
                <div class="col-12 col-md-3 d-none d-md-block">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <span class="material-symbols-outlined text-muted" style="font-size: 18px;">public</span>
                        <span class="material-symbols-outlined text-muted" style="font-size: 18px;">share</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
