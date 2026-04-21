<style>
/* Custom CSS to replace Tailwind specific styles and maintain exact design */
.sidebar-container {
    width: 256px;
    transition: all 0.3s ease;
    z-index: 50;
    overflow-x: hidden;
    overflow-y: auto;
}

.sidebar-container.collapsed {
    width: 80px;
}

.sidebar-container.collapsed .sidebar-text {
    opacity: 0;
    visibility: hidden;
    display: none !important;
}

.sidebar-container.collapsed .nav-link-custom {
    justify-content: center !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
}

.sidebar-container.collapsed .toggle-icon {
    display: none !important;
}

.topbar-container {
    left: 256px;
    height: 64px;
    z-index: 40;
    background-color: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(12px);
    transition: all 0.3s ease;
}

.topbar-container.collapsed {
    left: 80px;
}

.nav-link-custom {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    border-radius: 9999px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    color: #57534e;
    text-decoration: none;
    border: none;
    background: transparent;
    width: 100%;
    text-align: left;
}

.nav-link-custom:hover {
    color: #c2410c;
    background-color: rgba(231, 229, 228, 0.4);
}

.nav-link-active {
    background-color: rgba(254, 215, 170, 0.5) !important;
    color: #9a3412 !important;
    font-weight: bold !important;
}

.text-orange-800 { color: #9a3412; }
.text-stone-500 { color: #78716c; }
.text-xs { font-size: 0.75rem; }
.font-headline { font-family: 'Plus Jakarta Sans', sans-serif; }
.font-label { font-family: 'Plus Jakarta Sans', sans-serif; }
.font-body { font-family: 'Be Vietnam Pro', sans-serif; }
.tracking-tight { letter-spacing: -0.025em; }
.tracking-widest { letter-spacing: 0.1em; }
.text-10px { font-size: 10px; }

.search-box {
    background-color: #f4f4f0;
    border-radius: 9999px;
    padding: 0.375rem 1rem;
    width: 24rem;
}

.search-input {
    background: transparent;
    border: none;
    outline: none;
    box-shadow: none;
    width: 100%;
    font-size: 0.875rem;
}

.search-input::placeholder {
    color: #b1b2af;
}

/* User Dropdown */
.user-menu-container {
    position: relative;
    cursor: pointer;
}

.user-dropdown {
    position: absolute;
    right: 0;
    top: 100%;
    margin-top: 0.5rem;
    width: 12rem;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 0.75rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.3s ease;
    z-index: 50;
    padding: 0.5rem 0;
}

.user-menu-container:hover .user-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-item-custom {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.625rem 1rem;
    font-size: 0.875rem;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 500;
    color: #303330;
    text-decoration: none;
    transition: background-color 0.3s;
}

.dropdown-item-custom:hover {
    background-color: rgba(148, 76, 0, 0.1);
}

.dropdown-item-danger {
    color: #aa371c;
}
.dropdown-item-danger:hover {
    background-color: rgba(170, 55, 28, 0.05);
}

.menu-btn-custom {
    background: transparent;
    border: none;
    padding: 0.5rem;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: background-color 0.3s;
    color: #303330;
}
.menu-btn-custom:hover {
    background-color: rgba(231, 229, 228, 0.4);
}

/* Submenu collapse animation without Bootstrap JS dependency */
.submenu-collapse {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease, opacity 0.3s ease;
    opacity: 0;
}

.submenu-collapse.show {
    max-height: 200px;
    opacity: 1;
}

.sidebar-container.collapsed .submenu-collapse {
    display: none !important;
}
</style>

<aside id="sidebar" class="sidebar-container position-fixed top-0 start-0 h-100 d-flex flex-column p-4">
    <!-- Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="sidebar-text">
            <h1 class="fs-4 fw-bold text-orange-800 font-headline tracking-tight m-0">
                Radiant Admin
            </h1>
            <p class="text-10px font-label text-uppercase tracking-widest text-stone-500 mt-1 mb-0">
                The Luminous Sanctuary
            </p>
        </div>

        <button onclick="toggleSidebar()" class="menu-btn-custom d-flex align-items-center justify-content-center">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>

    @php
        $activeClass = 'nav-link-active';
    @endphp

    <!-- Menu -->
    <nav class="flex-grow-1 d-flex flex-column gap-2">

        <a href="{{ route('dashboard') ?? '#' }}" 
           class="nav-link-custom {{ request()->routeIs('dashboard') ? $activeClass : '' }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="sidebar-text">Dashboard</span>
        </a>

        <a href="{{ route('appointment') }}" 
           class="nav-link-custom {{ request()->routeIs('appointment') ? $activeClass : '' }}">
            <span class="material-symbols-outlined">calendar_today</span>
            <span class="sidebar-text">Appointments</span>
        </a>

        <a href="{{ route('inventory') }}" 
           class="nav-link-custom {{ request()->routeIs('inventory') ? $activeClass : '' }}">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="sidebar-text">Inventory</span>
        </a>

        <!-- Customers -->
        <div class="d-flex flex-column gap-1">
            <button onclick="toggleMenu('customerMenu')" class="nav-link-custom w-100 {{ request()->routeIs('customer') || request()->routeIs('petManagement') ? $activeClass : '' }}">
                <span class="material-symbols-outlined">group</span>
                <span class="sidebar-text">Pet Owners</span>
                <span class="material-symbols-outlined ms-auto toggle-icon" style="font-size: 0.75rem;">expand_more</span>
            </button>

            <div id="customerMenu" class="submenu-collapse {{ request()->routeIs('customer') || request()->routeIs('petManagement') ? 'show' : '' }}" style="margin-left: 1.5rem;">
                <div class="d-flex flex-column gap-1 mt-1">
                    <a href="{{ route('customer') }}" class="nav-link-custom py-2 {{ request()->routeIs('customer') ? $activeClass : '' }}">
                        <span class="material-symbols-outlined">person</span>
                        <span class="sidebar-text">Customer</span>
                    </a>
                    <a href="{{ route('petManagement') }}" class="nav-link-custom py-2 {{ request()->routeIs('petManagement') ? $activeClass : '' }}">
                        <span class="material-symbols-outlined">pets</span>
                        <span class="sidebar-text">Pet</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Operations -->
        <div class="d-flex flex-column gap-1">
            <button onclick="toggleMenu('companyMenu')" class="nav-link-custom w-100 {{ request()->routeIs('company') || request()->routeIs('serviceManagement') ? $activeClass : '' }}">
                <span class="material-symbols-outlined">business</span>
                <span class="sidebar-text">Operations</span>
                <span class="material-symbols-outlined ms-auto toggle-icon" style="font-size: 0.75rem;">expand_more</span>
            </button>

            <div id="companyMenu" class="submenu-collapse {{ request()->routeIs('company') || request()->routeIs('serviceManagement') ? 'show' : '' }}" style="margin-left: 1.5rem;">
                <div class="d-flex flex-column gap-1 mt-1">
                    <a href="{{ route('company') }}" class="nav-link-custom py-2 {{ request()->routeIs('company') ? $activeClass : '' }}">
                        <span class="material-symbols-outlined">apartment</span>
                        <span class="sidebar-text">Company Management</span>
                    </a>
                    <a href="{{ route('serviceManagement') }}" class="nav-link-custom py-2 {{ request()->routeIs('serviceManagement') ? $activeClass : '' }}">
                        <span class="material-symbols-outlined">handyman</span>
                        <span class="sidebar-text">Service Management</span>
                    </a>
                </div>
            </div>
        </div>

        <a href="#" class="nav-link-custom">
            <span class="material-symbols-outlined">settings</span>
            <span class="sidebar-text">Settings</span>
        </a>

    </nav>
</aside>

<!-- TopNavBar -->
<header id="topbar" class="topbar-container position-fixed top-0 pe-4 pe-md-5 d-flex justify-content-between align-items-center" style="right: 0;">
    <div class="d-flex align-items-center search-box ms-4">
        <span class="material-symbols-outlined" style="font-size: 1.125rem; color: #797b78;">search</span>
        <input class="search-input font-body" placeholder="Search appointments, pets, or stock..." type="text" />
    </div>
    <div class="d-flex align-items-center gap-4">
        <button class="menu-btn-custom p-0 d-flex text-stone-500">
            <span class="material-symbols-outlined">notifications</span>
        </button>
        <button class="menu-btn-custom p-0 d-flex text-stone-500">
            <span class="material-symbols-outlined">help_outline</span>
        </button>
        <div class="user-menu-container d-flex align-items-center gap-3 ps-3 border-start">
            <div class="text-end">
                <p class="mb-0 text-xs font-headline fw-bold" style="color: #303330;">Admin Profile</p>
                <p class="mb-0 text-10px" style="color: #797b78;">Super Admin</p>
            </div>
            <img alt="Admin User Profile" class="rounded-circle object-fit-cover" style="width: 2.5rem; height: 2.5rem;" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD0efH14mVIQ5Ts91_DVq80xvSg5hp-xsQVxi-DeIAn2vmKYfGHciH2v6wFR7Zb28C7s_CJ8nSLbfR31Pci2A4HHwOMydF2xwDrEzGptj4OtregfoxW5Dh3Y0Jk0DfmtdnYpwuoWqD7L36G1M9C4BbStGaFn9GZEOOKuORKrB226KVKTgX1vBC2KkAmwxfzSahc59zR97On8W7_IyxAdF3g3niiEj99KH9NGYOKJZ4XPpUSkvZefuEfHLzMUdHvijC_MCLg2ZxlRcGW" />
            
            <!-- Dropdown Menu -->
            <div class="user-dropdown">
                <a class="dropdown-item-custom" href="#">
                    <span class="material-symbols-outlined text-orange-800" style="font-size: 1.125rem;">person</span>
                    Profile
                </a>
                <hr class="my-1" style="border-color: rgba(177, 178, 175, 0.1);">
                <a class="dropdown-item-custom dropdown-item-danger" href="{{ route('admin.logout') ?? '#' }}">
                    <span class="material-symbols-outlined" style="font-size: 1.125rem;">logout</span>
                    Logout
                </a>
            </div>
        </div>
    </div>
</header>

<script>
    let isPinned = true;

    function toggleSidebar() {
        const $sidebar = $('#sidebar');
        const $main = $('#mainContent');
        const $header = $('#topbar');

        if (isPinned) {
            // COLLAPSE
            $sidebar.addClass('collapsed');
            $header.addClass('collapsed');

            if ($main.length) {
                // Remove tailwind ml-64 and explicitly define width and margin
                $main.removeClass('ml-64').css({
                    'margin-left': '80px',
                    'width': 'calc(100% - 80px)'
                });
            }
        } else {
            // EXPAND
            $sidebar.removeClass('collapsed');
            $header.removeClass('collapsed');

            if ($main.length) {
                // Return to expanded layout proportions
                $main.css({
                    'margin-left': '256px', // or just let CSS handle base width
                    'width': 'calc(100% - 256px)'
                }).addClass('ml-64');
            }
        }

        isPinned = !isPinned;
    }

    function toggleMenu(id) {
        // Prevent toggle if sidebar is collapsed
        if (!isPinned) return;
        
        const $menu = $('#' + id);
        if ($menu.length) {
            $menu.toggleClass('show');
        }
    }
</script>
