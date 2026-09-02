@php $siteSettings = \App\Models\SiteSetting::current(); @endphp

<!-- Top Navigation -->
<nav class="navbar">
    <div class="nav-container">
        <div class=" hero-title">
            <img src="{{ asset('frontend/img/menu-alt-2-svgrepo-com (1).svg') }}" alt="" class="mobile-menu-bar"
                id="openMenu">
            @if ($siteSettings->brand_logo_path)
                <img src="{{ asset($siteSettings->brand_logo_path) }}" alt="{{ $siteSettings->brand_logo_text }}"
                    class="logo-img">
            @endif
            <a class="italic text-primary logo" href="{{ route('home') }}">{{ $siteSettings->brand_logo_text }}</a>

        </div>
        <div class="nav-links">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
            <a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'active' : '' }}">Pet Food</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            {{-- <a href="{{ route('bookings') }}" class="{{ request()->routeIs('bookings') ? 'active' : '' }}">Bookings</a> --}}
        </div>
        <div class="nav-actions">
            <div class="search-box">
                <span class="material-symbols-outlined">search</span>
                <input type="text" placeholder="Search services...">
            </div>
            @if (Auth::check())
                <a href="{{ route('user.dashboard') }}" class="btn-primary user-menu"> <img
                        src="{{ asset('frontend/img/user-svgrepo-com.svg') }}" alt="" class="user-icon"><span
                        class="user-span">Welcome, {{ Auth::user()->first_name }}</span></a>
            @else
                <a href="{{ route('login') }}" class="btn-primary user-menu"> <img
                        src="{{ asset('frontend/img/user-svgrepo-com.svg') }}" alt="" class="user-icon"><span
                        class="user-span">Login</span></a>
            @endif
        </div>
    </div>
</nav>


<!-- 🔥 Mobile Sidebar -->
<div class="mobile-sidebar" id="mobileSidebar">
    <div class="sidebar-header">
        <span>Menu</span>
        <span class="close-btn" id="closeMenu">&times;</span>
    </div>

    <div class="sidebar-links">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <span>Home</span>
            <i class="ri-arrow-right-s-line"></i>
        </a>

        <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">
            <span>Services</span>
            <i class="ri-arrow-right-s-line"></i>
        </a>

        <a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'active' : '' }}">
            <span>Pet Food</span>
            <i class="ri-arrow-right-s-line"></i>
        </a>

        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
            <span>Contact</span>
            <i class="ri-arrow-right-s-line"></i>
        </a>

        {{-- <a href="{{ route('bookings') }}" class="{{ request()->routeIs('bookings') ? 'active' : '' }}">
            <span>Bookings</span>
            <i class="ri-arrow-right-s-line"></i>
        </a> --}}
    </div>
    <div class="sidebar-social">
        <p>Follow us on</p>

        <div class="social-icons">
            <a href="#"><i class="ri-facebook-fill"></i></a>
            <a href="#"><i class="ri-instagram-line"></i></a>
            <a href="#"><i class="ri-twitter-x-line"></i></a>
            <a href="#"><i class="ri-youtube-fill"></i></a>
        </div>
    </div>
</div>

<!-- overlay -->
<div class="overlay" id="overlay"></div>


<nav class="fixed-bottom-nav glass-body">
    <!-- Home (Active) -->
    <a class="nav-menu {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">home</span>
        <span class="nav-menu-text">Home</span>
    </a>
    <!-- Services -->
    <a class="nav-menu {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">
        <span class="material-symbols-outlined">pets</span>
        <span class="nav-menu-text">Services</span>
    </a>
    <!-- Pet Food -->
    <a class="nav-menu {{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}">
        <span class="material-symbols-outlined">storefront</span>
        <span class="nav-menu-text">Food</span>
    </a>
    <!-- Profile -->
    @if (Auth::check())
        <a class="nav-menu {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
            href="{{ route('user.dashboard') }}">
            <span class="material-symbols-outlined">person</span>
            <span class="nav-menu-text">Dashboard</span>
        </a>
    @else
        <a class="nav-menu {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
            <span class="material-symbols-outlined">person</span>
            <span class="nav-menu-text">Login</span>
        </a>
    @endif
</nav>
