<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Radiant Habitat Admin | Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Be+Vietnam+Pro:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-secondary-fixed": "#004842",
                        "on-primary-fixed-variant": "#6e3700",
                        "error": "#aa371c",
                        "primary-fixed": "#ffaf72",
                        "tertiary-dim": "#665100",
                        "inverse-on-surface": "#9d9d9a",
                        "surface-container-high": "#e8e8e4",
                        "on-secondary-fixed-variant": "#00675f",
                        "on-primary": "#fff7f4",
                        "surface-dim": "#d9dbd6",
                        "tertiary-fixed-dim": "#eec540",
                        "secondary": "#006b63",
                        "tertiary": "#745c00",
                        "on-primary-fixed": "#421e00",
                        "error-container": "#fa7150",
                        "on-tertiary-container": "#5c4900",
                        "surface-bright": "#faf9f6",
                        "on-tertiary-fixed": "#463600",
                        "surface": "#faf9f6",
                        "secondary-dim": "#005e56",
                        "secondary-fixed": "#84f5e8",
                        "on-tertiary": "#fff8ee",
                        "on-secondary": "#e2fff9",
                        "error-dim": "#821a01",
                        "surface-container-highest": "#e1e3df",
                        "inverse-primary": "#f99138",
                        "on-tertiary-fixed-variant": "#675200",
                        "surface-container": "#eeeeea",
                        "tertiary-container": "#fdd34d",
                        "surface-variant": "#e1e3df",
                        "on-primary-container": "#602f00",
                        "on-error": "#fff7f6",
                        "secondary-fixed-dim": "#75e7da",
                        "on-surface-variant": "#5d605c",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-container": "#005c55",
                        "surface-tint": "#944c00",
                        "on-background": "#303330",
                        "primary-container": "#ffaf72",
                        "primary-dim": "#824200",
                        "outline": "#797b78",
                        "primary-fixed-dim": "#ff9b48",
                        "tertiary-fixed": "#fdd34d",
                        "on-surface": "#303330",
                        "secondary-container": "#84f5e8",
                        "on-error-container": "#671200",
                        "background": "#faf9f6",
                        "outline-variant": "#b1b2af",
                        "surface-container-low": "#f4f4f0",
                        "primary": "#944c00",
                        "inverse-surface": "#0d0f0d"
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
    <script src="//unpkg.com/alpinejs" defer></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Add in your layout head -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('backAssets/css/petManagement.css') }}">
    <link rel="stylesheet" href="{{ asset('backAssets/css/company.css') }}">
    <link rel="stylesheet" href="{{ asset('backAssets/css/style.css') }}">

</head>

<body class="bg-surface font-body text-on-surface overflow-x-hidden">
    <!-- SideNavBar -->
    @include('backEnd/include/header')


    <main id="mainContent" class="ml-64 pt-20 p-10 min-h-screen transition-all duration-300">
        @yield('adminContent')
    </main>


    <!-- Floating Action Action Hint (FAB Suppression logic would apply on Detail screens, not Dashboard) -->
    {{-- <button
            class="fixed bottom-10 right-10 w-16 h-16 rounded-full signature-glow text-on-primary shadow-2xl flex items-center justify-center transition-transform hover:scale-110 active:scale-95 z-50">
            <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">add</span>
        </button> --}}


    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    </script>



</body>

</html>
