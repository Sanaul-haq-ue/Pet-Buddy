<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Radiant Habitat | Premium Pet Care & Nutrition')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/home.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/services.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bookings.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}"> --}}

</head>

<body>

    <main>
        <div class="layout-wrapper bg-mesh">
            <!-- Left Side Image Area -->
            <div class="hero-section">
                <div class="hero-content">
                    <h1 class="hero-title">
                        Welcome to the <span class="text-primary italic">Pet Buddy</span>.
                    </h1>
                    <p class="hero-subtitle">
                        Professional pet care that feels like a warm embrace. Join our community of dedicated pet
                        parents
                        today.
                    </p>
                    <div class="hero-image-wrapper">
                        <div class="hero-image-glow"></div>
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCIfy1pp_bEsMwBikrK8-VymUbLWXA58YHVZCPS5AExv7QwbZEYU1CzfZQvIGs5pov6B2IqbpgYFzMl1jRzGbfBsKxUr8pyU8jLLv7AqgLkZuO90OAdFp1jXnvzhYoWuHP71ZKtk1HD514sCdi6rtV_AwibSXb_Ypt_s-oaYRFrnlg9512Kmvb8RtWgSNc7Aekemq9BiAxGSGAobd5GwN6vVJbemxDIy7wTokpEAeBLKmjoLghy_L7m4lO9ac05HM8RWbThhctpX44E"
                            alt="Happy golden retriever" class="hero-image">

                        <div class="stats-card glass-card ghost-border">
                            <div class="stats-header">
                                <span class="material-symbols-outlined text-primary">pets</span>
                                <span class="stats-title">Active Members</span>
                            </div>
                            <p class="stats-text">Join over 5,000+ pets enjoying premium habitat care.</p>
                        </div>
                    </div>
                </div>
                <!-- Decorative elements -->
                <div class="decor-circle top-right"></div>
                <div class="decor-circle bottom-left"></div>
            </div>

            <!-- Right Side Login Area -->
            <div class="form-section">
                <div class="form-wrapper">
                    <div class="mobile-header">
                        <h2>Pet Buddy</h2>
                    </div>

                    <div class="login-card glass-card ghost-border">
                        <div class="auth-tabs">
                            <button class="tab-btn active">Login</button>
                            <button class="tab-btn inactive">Sign Up</button>
                        </div>

                        <div class="form-content">
                            <header class="form-header">
                                <h3>Hello again!</h3>
                                <p>Enter your credentials to access your sanctuary.</p>
                            </header>

                            <form action="#" method="POST">
                                <div class="input-group">
                                    <label>Email Address</label>
                                    <input type="email" placeholder="hello@radiantpet.com">
                                </div>

                                <div class="input-group mt-4">
                                    <div class="password-header">
                                        <label>Password</label>
                                        <a href="#" class="forgot-link">Forgot?</a>
                                    </div>
                                    <input type="password" placeholder="••••••••">
                                </div>

                                <div class="remember-group">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">Stay logged in for 30 days</label>
                                </div>

                                <button type="submit" class="submit-btn signature-glow">
                                    Login Now 
                                </button>
                            </form>

                            <div class="divider">
                                <div class="line"></div>
                                <span>Or continue with</span>
                                <div class="line"></div>
                            </div>

                            <div class="social-login">
                                <button class="social-btn">
                                    <svg class="social-icon" viewBox="0 0 24 24">
                                        <path
                                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                            fill="#4285F4"></path>
                                        <path
                                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                            fill="#34A853"></path>
                                        <path
                                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                                            fill="#FBBC05"></path>
                                        <path
                                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                            fill="#EA4335"></path>
                                    </svg>
                                    <span>Google</span>
                                </button>
                                <button class="social-btn">
                                    <svg class="social-icon" fill="#1877F2" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z">
                                        </path>
                                    </svg>
                                    <span>Facebook</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="footer-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Support</a>
                    </div>
                </div>
            </div>

            <div class="brand-logo">
                <div class="logo-wrapper">
                    <span class="material-symbols-outlined text-primary logo-icon">colors_spark</span>
                    <span class="logo-text">Radiant Habitat</span>
                </div>
            </div>

            <div class="bg-icon">
                <span class="material-symbols-outlined">pets</span>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const openMenu = document.getElementById('openMenu');
        const closeMenu = document.getElementById('closeMenu');
        const sidebar = document.getElementById('mobileSidebar');
        const overlay = document.getElementById('overlay');

        openMenu.addEventListener('click', () => {
            sidebar.classList.add('active');
            overlay.classList.add('active');
        });

        closeMenu.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>

</body>

</html>
