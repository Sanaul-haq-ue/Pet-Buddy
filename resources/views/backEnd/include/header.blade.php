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
            <button onclick="toggleMenu('customerMenu')"
                class="nav-link-custom w-100 {{ request()->routeIs('customer') || request()->routeIs('petManagement') ? $activeClass : '' }}">
                <span class="material-symbols-outlined">group</span>
                <span class="sidebar-text">Pet Owners</span>
                <span class="material-symbols-outlined ms-auto toggle-icon"
                    style="font-size: 0.75rem;">expand_more</span>
            </button>

            <div id="customerMenu"
                class="submenu-collapse {{ request()->routeIs('customer') || request()->routeIs('petManagement') ? 'show' : '' }}"
                style="margin-left: 1.5rem;">
                <div class="d-flex flex-column gap-1 mt-1">
                    <a href="{{ route('customer') }}"
                        class="nav-link-custom py-2 {{ request()->routeIs('customer') ? $activeClass : '' }}">
                        <span class="material-symbols-outlined">person</span>
                        <span class="sidebar-text">Customer</span>
                    </a>
                    <a href="{{ route('petManagement') }}"
                        class="nav-link-custom py-2 {{ request()->routeIs('petManagement') ? $activeClass : '' }}">
                        <span class="material-symbols-outlined">pets</span>
                        <span class="sidebar-text">Pet</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Operations -->
        <div class="d-flex flex-column gap-1">
            <button onclick="toggleMenu('companyMenu')"
                class="nav-link-custom w-100 {{ request()->routeIs('company') || request()->routeIs('serviceManagement') ? $activeClass : '' }}">
                <span class="material-symbols-outlined">business</span>
                <span class="sidebar-text">Operations</span>
                <span class="material-symbols-outlined ms-auto toggle-icon"
                    style="font-size: 0.75rem;">expand_more</span>
            </button>

            <div id="companyMenu"
                class="submenu-collapse {{ request()->routeIs('company') || request()->routeIs('serviceManagement') ? 'show' : '' }}"
                style="margin-left: 1.5rem;">
                <div class="d-flex flex-column gap-1 mt-1">
                    <a href="{{ route('company') }}"
                        class="nav-link-custom py-2 {{ request()->routeIs('company') ? $activeClass : '' }}">
                        <span class="material-symbols-outlined">apartment</span>
                        <span class="sidebar-text">Company</span>
                    </a>
                    <a href="{{ route('serviceManagement') }}"
                        class="nav-link-custom py-2 {{ request()->routeIs('serviceManagement') ? $activeClass : '' }}">
                        <span class="material-symbols-outlined">handyman</span>
                        <span class="sidebar-text">Service</span>
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
<header id="topbar"
    class="topbar-container position-fixed top-0 pe-4 pe-md-5 d-flex justify-content-between align-items-center"
    style="right: 0;">

    <button onclick="mobileToggleSidebar()" class="mobile-toggle-btn d-flex align-items-center justify-content-center">
        <span class="material-symbols-outlined">menu</span>
    </button>

    <button onclick="toggleSidebar()"
        class="menu-btn-custom d-flex align-items-center justify-content-center ms-4 d-none d-md-flex">
        <span class="material-symbols-outlined">menu</span>
    </button>

    <div class="d-flex align-items-center search-box ms-4">
        <div class="d-flex align-items-center search-box ms-4 d-none d-md-flex">
            <span class="material-symbols-outlined" style="font-size: 1.125rem; color: #797b78;">search</span>
            <input class="search-input font-body" placeholder="Search appointments, pets, or stock..." type="text" />
        </div>

        {{-- <span class="material-symbols-outlined" style="font-size: 1.125rem; color: #797b78;">search</span> --}}
        {{-- <input class="search-input font-body" placeholder="Search appointments, pets, or stock..." type="text" /> --}}
    </div>
    <div class="d-flex align-items-center gap-4">
        <button id="mobileSearchToggle" class="menu-btn-custom d-flex d-md-none">
            <span class="material-symbols-outlined">search</span>
        </button>
        <button class="menu-btn-custom p-0 d-flex text-stone-500">
            <span class="material-symbols-outlined">notifications</span>
        </button>
        <button id="mode" class="menu-btn-custom p-0 d-flex text-stone-500">
            <span class="material-symbols-outlined">dark_mode</span>
        </button>
        <button class="menu-btn-custom p-0 d-flex text-stone-500">
            <span class="material-symbols-outlined">help_outline</span>
        </button>
        <div class="user-menu-container d-flex align-items-center gap-3 ps-3 border-start">
            <div class="text-end ms-4 d-none d-md-flex flex-column">
                <p class="mb-0 text-xs font-headline fw-bold" style="color: #303330;">Admin Profile</p>
                <p class="mb-0 text-10px" style="color: #797b78;">Super Admin</p>
            </div>
            <img alt="Admin User Profile" class="rounded-circle object-fit-cover" style="width: 2.5rem; height: 2.5rem;"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuD0efH14mVIQ5Ts91_DVq80xvSg5hp-xsQVxi-DeIAn2vmKYfGHciH2v6wFR7Zb28C7s_CJ8nSLbfR31Pci2A4HHwOMydF2xwDrEzGptj4OtregfoxW5Dh3Y0Jk0DfmtdnYpwuoWqD7L36G1M9C4BbStGaFn9GZEOOKuORKrB226KVKTgX1vBC2KkAmwxfzSahc59zR97On8W7_IyxAdF3g3niiEj99KH9NGYOKJZ4XPpUSkvZefuEfHLzMUdHvijC_MCLg2ZxlRcGW" />

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



<!-- MOBILE SEARCH BOX -->
<div id="mobileSearchBox" class="mobile-search-box d-md-none">
    <input type="text" placeholder="Search..." class="search-input w-100">
</div>



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
                $main.removeClass('collapsedMain').addClass('expandedMain');
            }
        } else {
            // EXPAND
            $sidebar.removeClass('collapsed');
            $header.removeClass('collapsed');

            if ($main.length) {
                $main.removeClass('expandedMain').addClass('collapsedMain');
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

    $(document).on('click', '#mobileSearchToggle', function() {
        $('#mobileSearchBox').toggleClass('active');
    });



    $(document).on('click', '.mobile-toggle-btn', function() {
        const $sidebar = $('#sidebar');

        $sidebar.toggleClass('sidebar-container');

        if ($sidebar.hasClass('sidebar-container')) {
            $sidebar.css({
                background: '',
                'z-index': ''
            });
        } else {
            $sidebar.css({
                background: 'white',
                'z-index': 1,
                'transition': 'all 0.3s ease'
            });
        }
    });
</script>
