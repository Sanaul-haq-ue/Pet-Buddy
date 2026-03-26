<!-- Top Navigation -->
<nav class="navbar">
    <div class="nav-container">
        <div class="brand-logo">Radiant Habitat</div>
        <div class="nav-links">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
            <a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'active' : '' }}">Pet Food</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            <a href="{{ route('bookings') }}" class="{{ request()->routeIs('bookings') ? 'active' : '' }}">Bookings</a>
        </div>
        <div class="nav-actions">
            <div class="search-box">
                <span class="material-symbols-outlined">search</span>
                <input type="text" placeholder="Search services...">
            </div>
            <a href="{{ route('login') }}" class="btn-primary" style="text-decoration: none; padding: 0.5rem 1rem; border-radius: 4px;">Login</a>
        </div>
    </div>
</nav>
