<aside
    class="fixed left-0 top-0 h-full flex flex-col p-6 h-screen w-64 border-r border-stone-200/20 dark:border-stone-800/20 bg-stone-50/80 dark:bg-stone-900/80 backdrop-blur-xl shadow-[0_20px_40px_rgba(148,76,0,0.06)] z-50">
    <div class="mb-10">
        <h1 class="text-2xl font-bold text-orange-800 dark:text-orange-300 font-headline tracking-tight">Radiant Admin
        </h1>
        <p class="text-[10px] font-label uppercase tracking-widest text-stone-500 mt-1">The Luminous Sanctuary</p>
    </div>
    @php
        $active = 'bg-orange-100/50 dark:bg-orange-900/30 text-orange-800 dark:text-orange-200 font-bold';
        $normal =
            'text-stone-600 dark:text-stone-400 hover:text-orange-700 dark:hover:text-orange-300 hover:bg-stone-200/40 dark:hover:bg-stone-800/40';
    @endphp
    <nav class="flex-1 space-y-2">
        {{-- <a class="flex items-center gap-3 px-4 py-3 bg-orange-100/50 dark:bg-orange-900/30 text-orange-800 dark:text-orange-200 rounded-full font-bold transition-all duration-300 scale-95 active:scale-90 font-headline text-sm tracking-tight"
            href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span>Dashboard</span>
        </a> --}}
        <a class="flex items-center gap-3 px-4 py-3 rounded-full font-headline text-sm tracking-tight transition-all duration-300
            {{ request()->routeIs('dashboard') ? $active : $normal }}"
            {{-- // ? 'bg-orange-100/50 dark:bg-orange-900/30 text-orange-800 dark:text-orange-200 font-bold'
                // : 'text-stone-600 dark:text-stone-400 hover:text-orange-700 dark:hover:text-orange-300 hover:bg-stone-200/40 dark:hover:bg-stone-800/40' }}" --}} href="{{ route('dashboard') }}">

            <span class="material-symbols-outlined">dashboard</span>
            <span>Dashboard</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-full font-headline text-sm tracking-tight transition-all duration-300
            {{ request()->routeIs('appointment') ? $active : $normal }}"
            href="{{ route('appointment') }}">

            <span class="material-symbols-outlined">calendar_today</span>
            <span>Appointments</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-full font-headline text-sm tracking-tight transition-all duration-300
            {{ request()->routeIs('inventory') ? $active : $normal }}"
            href="{{ route('inventory') }}">

            <span class="material-symbols-outlined">inventory_2</span>
            <span>Inventory</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-full font-headline text-sm tracking-tight transition-all duration-300
            {{ request()->routeIs('customer') ? $active : $normal }}"
            href="{{ route('customer') }}">
            <span class="material-symbols-outlined">group</span>
            <span>Customers</span>
        </a>

        <a class="flex items-center gap-3 px-4 py-3 rounded-full font-headline text-sm tracking-tight transition-all duration-300
            {{ request()->routeIs('company') ? $active : $normal }}"
            href="{{ route('company') }}">
            <span class="material-symbols-outlined">group</span>
            <span>Companies</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 text-stone-600 dark:text-stone-400 hover:text-orange-700 dark:hover:text-orange-300 hover:bg-stone-200/40 dark:hover:bg-stone-800/40 transition-all duration-300 rounded-full font-headline text-sm tracking-tight"
            href="#">
            <span class="material-symbols-outlined">settings</span>
            <span>Settings</span>
        </a>
    </nav>
    <button
        class="mt-auto signature-glow text-on-primary py-4 px-6 rounded-full font-headline font-bold text-sm tracking-wide shadow-lg shadow-primary/20 hover:primary-dim transition-all active:scale-95">
        New Appointment
    </button>
</aside>
<!-- TopNavBar -->
<header
    class="flex justify-between items-center w-full h-16 px-8 ml-64 max-w-[calc(100%-16rem)] sticky top-0 z-40 bg-white/70 dark:bg-stone-950/70 backdrop-blur-md">
    <div class="flex items-center bg-surface-container-low rounded-full px-4 py-1.5 w-96">
        <span class="material-symbols-outlined text-outline text-lg">search</span>
        <input class="bg-transparent border-none focus:ring-0 text-sm w-full font-body placeholder:text-outline-variant"
            placeholder="Search appointments, pets, or stock..." type="text" />
    </div>
    <div class="flex items-center gap-6">
        <button class="text-stone-500 hover:text-orange-600 transition-colors">
            <span class="material-symbols-outlined">notifications</span>
        </button>
        <button class="text-stone-500 hover:text-orange-600 transition-colors">
            <span class="material-symbols-outlined">help_outline</span>
        </button>
        <div class="relative group">
            <div class="flex items-center gap-3 pl-4 border-l border-outline-variant/20 cursor-pointer">
                <div class="text-right">
                    <p class="text-xs font-headline font-bold text-on-surface">Admin Profile</p>
                    <p class="text-[10px] text-outline">Super Admin</p>
                </div>
                <img alt="Admin User Profile" class="w-10 h-10 rounded-full object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuD0efH14mVIQ5Ts91_DVq80xvSg5hp-xsQVxi-DeIAn2vmKYfGHciH2v6wFR7Zb28C7s_CJ8nSLbfR31Pci2A4HHwOMydF2xwDrEzGptj4OtregfoxW5Dh3Y0Jk0DfmtdnYpwuoWqD7L36G1M9C4BbStGaFn9GZEOOKuORKrB226KVKTgX1vBC2KkAmwxfzSahc59zR97On8W7_IyxAdF3g3niiEj99KH9NGYOKJZ4XPpUSkvZefuEfHLzMUdHvijC_MCLg2ZxlRcGW" />
            </div>
            <!-- Dropdown Menu -->
            <div
                class="absolute right-0 mt-2 w-48 glass-card rounded-xl shadow-2xl py-2 z-50 invisible group-hover:visible opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 origin-top-right border border-white/20">
                <a class="flex items-center gap-3 px-4 py-2.5 text-sm font-headline font-medium text-on-surface hover:bg-primary/10 transition-colors"
                    href="#">
                    <span class="material-symbols-outlined text-lg text-primary">person</span>
                    Profile
                </a>
                <div class="h-px bg-outline-variant/10 my-1"></div>
                <a class="flex items-center gap-3 px-4 py-2.5 text-sm font-headline font-medium text-error hover:bg-error/5 transition-colors"
                    href="{{ route('admin.logout') }}">
                    <span class="material-symbols-outlined text-lg">logout</span>
                    Logout
                </a>
            </div>
        </div>
    </div>
</header>
