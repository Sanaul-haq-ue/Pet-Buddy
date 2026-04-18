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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
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
                        <div class="auth-tabs" id="authTabs">
                            <button class="tab-btn active" data-target="loginPanel">Login</button>
                            <button class="tab-btn" data-target="signupPanel">Sign Up</button>
                        </div>

                        <div class="form-content">
                            <div class="form-panel form-panel-active" id="loginPanel">
                                <header class="form-header">
                                    <h3>Hello again!</h3>
                                    <p>Enter your credentials to access your sanctuary.</p>
                                </header>

                                <form id="loginForm" action="{{ route('user.login.submit') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <label>Email Address</label>
                                        <input type="email" name="email" placeholder="hello@radiantpet.com" required>
                                        <span class="error-message" style="color: red; display: none;"></span>
                                    </div>

                                    <div class="input-group mt-4">
                                        <div class="password-header">
                                            <label>Password</label>
                                            <a href="#" class="forgot-link" id="forgotLink">Forgot?</a>
                                        </div>
                                        <div class="password-input-wrapper">
                                            <input type="password" name="password" placeholder="••••••••" required>
                                            <button type="button" class="password-toggle" id="passwordToggle">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <span class="error-message" style="color: red; display: none;"></span>
                                    </div>

                                    <div class="remember-group">
                                        <input type="checkbox" id="remember">
                                        <label for="remember">remember me</label>
                                    </div>

                                    <button type="submit" class="submit-btn signature-glow">Login Now</button>
                                </form>

                                <div class="divider">
                                    <div class="line"></div>
                                    <span>Or continue with</span>
                                    <div class="line"></div>
                                </div>

                                <div class="social-login">
                                    <button class="social-btn"><span>Google</span></button>
                                    <button class="social-btn"><span>Facebook</span></button>
                                </div>
                            </div>

                            <div class="form-panel" id="signupPanel">
                                <header class="form-header">
                                    <h3>Join us!</h3>
                                    <p>Create your account and start your pet journey.</p>
                                </header>

                                <form id="signupForm" action="{{ route('user.register.submit') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" placeholder="John" required>
                                        <span class="error-message" style="color: red; display: none;"></span>
                                    </div>

                                    <div class="input-group mt-4">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" placeholder="Doe" required>
                                        <span class="error-message" style="color: red; display: none;"></span>
                                    </div>

                                    <div class="input-group mt-4">
                                        <label>Email Address</label>
                                        <input type="email" name="email" placeholder="hello@radiantpet.com" required>
                                        <span class="error-message" style="color: red; display: none;"></span>
                                    </div>

                                    <div class="input-group mt-4">
                                        <label>Phone Number</label>
                                        <input type="tel" name="mobile" placeholder="+880 1XXXXXXXXX" required>
                                        <span class="error-message" style="color: red; display: none;"></span>
                                    </div>

                                    <div class="input-group mt-4">
                                        <label>Password</label>
                                        <div class="password-input-wrapper">
                                            <input type="password" name="password" placeholder="••••••••" required>
                                            <button type="button" class="password-toggle">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <span class="error-message" style="color: red; display: none;"></span>
                                    </div>

                                    <div class="input-group mt-4">
                                        <label>Confirm Password</label>
                                        <div class="password-input-wrapper">
                                            <input type="password" name="password_confirmation" placeholder="••••••••" required>
                                            <button type="button" class="password-toggle">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <span class="error-message" style="color: red; display: none;"></span>
                                    </div>

                                    <button type="submit" class="submit-btn signature-glow">Sign Up</button>
                                </form>

                                <div class="divider">
                                    <div class="line"></div>
                                    <span>Or continue with</span>
                                    <div class="line"></div>
                                </div>

                                <div class="social-login">
                                    <button class="social-btn"><span>Google</span></button>
                                    <button class="social-btn"><span>Facebook</span></button>
                                </div>
                            </div>

                            <div class="form-panel" id="forgotPanel">
                                <header class="form-header">
                                    <h3>Forgot Password</h3>
                                    <p>Enter your email to receive verification code.</p>
                                </header>

                                <form id="forgotForm" action="#" method="POST">
                                    <div class="input-group">
                                        <label>Email Address</label>
                                        <input type="email" placeholder="hello@radiantpet.com" required>
                                    </div>

                                    <button type="submit" class="submit-btn signature-glow">Send Reset Code</button>
                                </form>

                                <div class="text-center" style="margin-top: 14px;">
                                    <button id="forgotBackBtn" class="btn-text">Back to Login</button>
                                </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        const openMenu = document.getElementById('openMenu');
        const closeMenu = document.getElementById('closeMenu');
        const sidebar = document.getElementById('mobileSidebar');
        const overlay = document.getElementById('overlay');

        if (openMenu && closeMenu && sidebar && overlay) {
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
        }

        // Auth UI Switching
        const tabs = document.querySelectorAll('#authTabs .tab-btn');
        const loginPanel = document.getElementById('loginPanel');
        const signupPanel = document.getElementById('signupPanel');
        const forgotPanel = document.getElementById('forgotPanel');
        const authTabs = document.getElementById('authTabs');
        const forgotLink = document.getElementById('forgotLink');
        const forgotBackBtn = document.getElementById('forgotBackBtn');

        function setActivePanel(panel) {
            [loginPanel, signupPanel, forgotPanel].forEach(p => {
                p.classList.remove('form-panel-active');
            });
            panel.classList.add('form-panel-active');
        }

        function setActiveTab(tab) {
            tabs.forEach(t => {
                t.classList.toggle('active', t === tab);
            });
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.dataset.target;
                setActiveTab(tab);
                if (target === 'loginPanel') {
                    setActivePanel(loginPanel);
                } else if (target === 'signupPanel') {
                    setActivePanel(signupPanel);
                }
                authTabs.classList.remove('hidden');
            });
        });

        if (forgotLink) {
            forgotLink.addEventListener('click', (e) => {
                e.preventDefault();
                authTabs.classList.add('hidden');
                setActivePanel(forgotPanel);
            });
        }

        if (forgotBackBtn) {
            forgotBackBtn.addEventListener('click', () => {
                authTabs.classList.remove('hidden');
                setActiveTab(tabs[0]);
                setActivePanel(loginPanel);
            });
        }

        // Optional: Form animation on submit
        const loginForm = document.getElementById('loginForm');
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = this.querySelector('.submit-btn');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Logging in...';
            submitBtn.disabled = true;

            // Clear previous errors
            this.querySelectorAll('.error-message').forEach(span => {
                span.style.display = 'none';
                span.textContent = '';
            });

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success(data.message);
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    if (data.errors) {
                        for (const field in data.errors) {
                            const input = this.querySelector(`[name="${field}"]`);
                            if (input) {
                                const errorSpan = input.closest('.input-group').querySelector('.error-message');
                                if (errorSpan) {
                                    errorSpan.textContent = data.errors[field][0];
                                    errorSpan.style.display = 'block';
                                }
                            }
                        }
                    }
                }
            })
            .catch(error => {
                toastr.error('An error occurred. Please try again.');
            })
            .finally(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        });

        // Password toggle functionality
        const passwordToggle = document.getElementById('passwordToggle');
        const passwordInput = document.querySelector('input[name="password"]');

        if (passwordToggle && passwordInput) {
            passwordToggle.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.querySelector('i').className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
            });
        }

        // Signup form submission
        const signupForm = document.getElementById('signupForm');
        signupForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = this.querySelector('.submit-btn');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Signing up...';
            submitBtn.disabled = true;

            // Clear previous errors
            this.querySelectorAll('.error-message').forEach(span => {
                span.style.display = 'none';
                span.textContent = '';
            });

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success(data.message);
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    if (data.errors) {
                        for (const field in data.errors) {
                            const input = this.querySelector(`[name="${field}"]`);
                            if (input) {
                                const errorSpan = input.closest('.input-group').querySelector('.error-message');
                                if (errorSpan) {
                                    errorSpan.textContent = data.errors[field][0];
                                    errorSpan.style.display = 'block';
                                }
                            }
                        }
                    }
                }
            })
            .catch(error => {
                toastr.error('An error occurred. Please try again.');
            })
            .finally(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        });

        // Password toggles for signup
        const passwordToggles = document.querySelectorAll('#signupForm .password-toggle');
        passwordToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const wrapper = this.parentElement;
                const input = wrapper.querySelector('input');
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.querySelector('i').className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
            });
        });
    </script>

</body>

</html>
