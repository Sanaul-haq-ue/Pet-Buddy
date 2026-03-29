<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Admin Portal | Radiant Habitat</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Be+Vietnam+Pro:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet" />
    <!-- Icons -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "error-container": "#fa7150",
                        "on-primary-container": "#602f00",
                        "surface-container-highest": "#e1e3df",
                        "on-primary": "#fff7f4",
                        "on-secondary-fixed-variant": "#00675f",
                        "on-primary-fixed-variant": "#6e3700",
                        "tertiary-fixed": "#fdd34d",
                        "primary-fixed": "#ffaf72",
                        "error-dim": "#821a01",
                        "on-surface-variant": "#5d605c",
                        "error": "#aa371c",
                        "surface-container-high": "#e8e8e4",
                        "on-primary-fixed": "#421e00",
                        "surface-dim": "#d9dbd6",
                        "on-secondary": "#e2fff9",
                        "surface-container": "#eeeeea",
                        "primary": "#944c00",
                        "on-tertiary": "#fff8ee",
                        "primary-fixed-dim": "#ff9b48",
                        "on-surface": "#303330",
                        "inverse-on-surface": "#9d9d9a",
                        "on-secondary-fixed": "#004842",
                        "surface": "#faf9f6",
                        "surface-container-lowest": "#ffffff",
                        "secondary-fixed-dim": "#75e7da",
                        "surface-variant": "#e1e3df",
                        "surface-tint": "#944c00",
                        "tertiary-dim": "#665100",
                        "secondary-fixed": "#84f5e8",
                        "on-tertiary-fixed": "#463600",
                        "primary-dim": "#824200",
                        "surface-container-low": "#f4f4f0",
                        "secondary-dim": "#005e56",
                        "tertiary-container": "#fdd34d",
                        "inverse-primary": "#f99138",
                        "on-tertiary-container": "#5c4900",
                        "tertiary": "#745c00",
                        "secondary-container": "#84f5e8",
                        "on-error-container": "#671200",
                        "surface-bright": "#faf9f6",
                        "on-tertiary-fixed-variant": "#675200",
                        "inverse-surface": "#0d0f0d",
                        "primary-container": "#ffaf72",
                        "on-secondary-container": "#005c55",
                        "on-background": "#303330",
                        "tertiary-fixed-dim": "#eec540",
                        "secondary": "#006b63",
                        "background": "#faf9f6",
                        "outline": "#797b78",
                        "outline-variant": "#b1b2af",
                        "on-error": "#fff7f6"
                    },
                    fontFamily: {
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Be Vietnam Pro"],
                        "label": ["Plus Jakarta Sans"]
                    },
                    borderRadius: {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
            vertical-align: middle
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1.5px solid rgba(177, 178, 175, 0.15)
        }

        .bg-sanctuary {
            background-image: linear-gradient(rgba(250, 249, 246, 0.4), rgba(250, 249, 246, 0.4)), url(https://lh3.googleusercontent.com/aida-public/AB6AXuBwUFE6EOyk7AmbhTc5AOt-YYM3DIkPfUEaYjRBcWVXiOrSTQ3bPdBiZI_9FhodTrdUpZUmYIP4sLKkdTuvZzgxRF_PaSd2_es4cuSZmDPBHib3YrzQOIMQDNLrNn0a3CITRAwsX2E3dvlMehEM96ZZkR2y7HvnqsF64KovzlbP8XolC-DxUmbY4mJJOmL157c0_lA_A_V4eh3KaSy1t33DKqELmiyNrv0ohwhWhbBUZn8pSNxDtMyYRJG1UukKXgX7q8R3UhHF9pBw);
            background-size: cover;
            background-position: center
        }
    </style>
</head>

<body
    class="bg-surface text-on-surface font-body min-h-screen flex flex-col selection:bg-primary-container selection:text-on-primary-container">
    <!-- Hero Background Layer -->
    <div class="fixed inset-0 z-[-1] bg-sanctuary"
        data-alt="blurred interior of a high-end modern sunlit office sanctuary with soft architectural lines and warm glowing atmosphere">
    </div>
    <!-- Main Content Canvas -->
    <main class="flex-grow flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">
            <!-- Login Card Container -->
            <div
                class="glass-card rounded-xl p-8 md:p-12 shadow-[0_20px_40px_rgba(148,76,0,0.06)] animate-in fade-in slide-in-from-bottom-4 duration-700">
                <!-- Brand Header -->
                <div class="text-center mb-10">
                    <div class="inline-flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-primary text-4xl mr-2"
                            data-icon="nest_eco_leaf">nest_eco_leaf</span>
                        <h1 class="font-headline text-2xl font-bold tracking-tight text-on-surface">Radiant Habitat</h1>
                    </div>
                    <h2
                        class="font-headline text-lg font-semibold text-on-surface-variant tracking-wide uppercase text-[0.75rem] mb-2">
                        Admin Portal</h2>
                    <p class="text-on-surface-variant/80 text-sm">Please enter your credentials to access the dashboard.
                    </p>
                </div>

                @if (session('error'))
                    <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Form -->
                <form class="space-y-6" method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    <div>
                        <label
                            class="block font-label text-[0.7rem] font-bold tracking-widest text-on-surface-variant mb-2"
                            for="email">EMAIL ADDRESS</label>
                        <input
                            class="w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-on-surface placeholder:text-outline-variant/60 font-medium"
                            id="email" name="email" placeholder="admin@radianthabitat.com" type="email" />
                    </div>
                    <div>
                        <div class="flex justify-between items-end mb-2">
                            <label
                                class="block font-label text-[0.7rem] font-bold tracking-widest text-on-surface-variant"
                                for="password">PASSWORD</label>
                            <a class="text-[0.7rem] font-semibold text-primary hover:text-primary-dim transition-colors"
                                href="#">Forgot password?</a>
                        </div>
                        <input
                            class="w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-on-surface placeholder:text-outline-variant/60 font-medium"
                            id="password" name="password" placeholder="••••••••" type="password" />
                    </div>
                    <div class="pt-4 space-y-4">
                        <!-- Primary Action -->
                        <button
                            class="w-full py-4 bg-primary text-on-primary rounded-full font-headline font-bold text-sm hover:bg-primary-dim active:scale-95 transition-all shadow-md flex items-center justify-center gap-2"
                            type="submit">
                            Sign In
                            <span class="material-symbols-outlined text-lg" data-icon="login">login</span>
                        </button>
                        <!-- Secondary Action -->
                        <div class="pt-2 text-center">
                            <a class="inline-flex items-center gap-2 text-sm font-medium text-on-surface-variant hover:text-primary transition-colors py-2 px-4 rounded-full hover:bg-surface-container-low"
                                href="/">
                                <span class="material-symbols-outlined text-lg" data-icon="arrow_back">arrow_back</span>
                                Return to Main Site
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Security Trust Badge -->
            <div class="mt-8 flex items-center justify-center gap-3 opacity-60">
                <span class="material-symbols-outlined text-secondary" data-icon="encrypted">encrypted</span>
                <span class="text-[0.7rem] font-bold tracking-widest uppercase text-on-surface-variant">Secure AES-256
                    Encrypted Connection</span>
            </div>
        </div>
    </main>
    <!-- Footer Component (From JSON) -->
    <footer class="w-full">
        <div class="flex flex-col md:flex-row justify-center items-center gap-6 py-8 w-full bg-transparent">
            <p class="font-['Be_Vietnam_Pro'] text-sm tracking-wide text-[#303330]/50 dark:text-stone-500">
                © 2024 Radiant Habitat. Secure Admin Portal.
            </p>
            <div class="flex gap-6">
                <a class="font-['Be_Vietnam_Pro'] text-sm tracking-wide text-[#303330]/50 dark:text-stone-500 hover:text-[#F28C33] dark:hover:text-[#ffaf72] transition-colors opacity-80 hover:opacity-100"
                    href="#">Privacy Policy</a>
                <a class="font-['Be_Vietnam_Pro'] text-sm tracking-wide text-[#303330]/50 dark:text-stone-500 hover:text-[#F28C33] dark:hover:text-[#ffaf72] transition-colors opacity-80 hover:opacity-100"
                    href="#">Terms of Service</a>
                <a class="font-['Be_Vietnam_Pro'] text-sm tracking-wide text-[#303330]/50 dark:text-stone-500 hover:text-[#F28C33] dark:hover:text-[#ffaf72] transition-colors opacity-80 hover:opacity-100"
                    href="#">Support</a>
            </div>
        </div>
    </footer>
</body>

</html>
