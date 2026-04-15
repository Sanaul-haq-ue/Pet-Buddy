@extends('frontEnd.layouts.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @endpush

    <div class="dashboard-layout container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <nav class="sidebar-nav">
                <button type="button" class="nav-tab active" data-tab="dashboard">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="tab-text">Dashboard</span>
                </button>
                <button type="button" class="nav-tab" data-tab="bookings">
                    <span class="material-symbols-outlined">calendar_today</span>
                    <span class="tab-text">Bookings</span>
                </button>
                <button type="button" class="nav-tab" data-tab="food-orders">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span class="tab-text">Food Orders</span>
                </button>
                <button type="button" class="nav-tab" data-tab="profile">
                    <span class="material-symbols-outlined">person</span>
                    <span class="tab-text">Profile</span>
                </button>
                <a href="{{ route('user.logout') }}" class="nav-tab">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="tab-text">Logout</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Dashboard Tab Content -->
            <div id="dashboard" class="tab-content active" style="display:block;">
                <div class="tab-header">
                    <h1 class="page-title">Dashboard</h1>
                    <p class="page-subtitle">Welcome back, {{ Auth::user()->first_name }}!</p>
                </div>

                <!-- Profile Section -->
                <section class="mb-5">
                    <div class="glass-card p-5 mb-4">
                        <div class="row align-items-center g-5">
                            <div class="col-md-auto text-center">
                                <div class="position-relative d-inline-block">
                                    <div class="rounded-circle overflow-hidden"
                                        style="width: 160px; height: 160px; border: 4px solid rgba(255, 175, 114, 0.3);">
                                        <img src="{{ Auth::user()->profile_image ?? 'https://via.placeholder.com/160' }}"
                                            alt="User Profile" class="w-100 h-100 object-fit-cover">
                                    </div>
                                    <button
                                        class="btn btn-light position-absolute bottom-0 end-0 p-2 rounded-circle shadow-sm">
                                        <span class="material-symbols-outlined" style="font-size: 18px;">edit</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="text-md-start text-center">
                                    <span class="badge badge-light headline-font fw-bold text-primary"
                                        style="font-size: 0.65rem; letter-spacing: 0.1em; color: var(--primary-color) !important;">Member
                                        Since 2023</span>
                                    <h1 class="headline-font fw-bold mt-2" style="font-size: 2.5rem;">
                                        {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h1>
                                    <p class="text-muted fw-500 fs-5 mt-2">Proud parent of Luna &amp; Milo</p>
                                    <div
                                        class="mt-3 d-flex gap-2 justify-content-md-start justify-content-center flex-wrap">
                                        <div class="badge-custom badge-success-custom">
                                            <span class="material-symbols-outlined" style="font-size: 18px;">verified</span>
                                            Premium Member
                                        </div>
                                        <div class="badge-custom"
                                            style="background-color: rgba(253, 211, 77, 0.3); color: var(--tertiary-color);">
                                            <span class="material-symbols-outlined" style="font-size: 18px;">star</span>
                                            420 Points
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Quick Actions -->
                <section class="mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <button
                                class="btn btn-primary-custom w-100 d-flex align-items-center justify-content-center gap-2">
                                <span class="material-symbols-outlined">calendar_add_on</span>
                                Book a Service
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button
                                class="btn btn-secondary-custom w-100 d-flex align-items-center justify-content-center gap-2">
                                <span class="material-symbols-outlined">shopping_basket</span>
                                Buy Pet Food
                            </button>
                        </div>
                    </div>
                </section>

                <!-- Pets Section -->
                <section class="mb-5">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h2 class="headline-font fw-bold" style="font-size: 1.5rem;">
                            My Pet Family
                            <span class="badge rounded-pill"
                                style="background-color: rgba(255, 175, 114, 0.2); color: var(--primary-dark); font-size: 0.75rem;">2
                                Pets</span>
                        </h2>
                        <button class="btn btn-link text-primary text-decoration-none fw-semibold">
                            Add Pet <span class="material-symbols-outlined ms-1" style="font-size: 20px;">add_circle</span>
                        </button>
                    </div>
                    <div class="d-flex gap-4 overflow-auto hide-scrollbar pb-3">
                        <!-- Pet 1 -->
                        <div class="flex-shrink-0 text-center" style="min-width: 150px;">
                            <div class="position-relative d-inline-block mb-3">
                                <div class="rounded-circle p-2"
                                    style="width: 150px; height: 150px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-light) 100%);">
                                    <div class="rounded-circle overflow-hidden bg-white border border-3 border-white"
                                        style="width: 100%; height: 100%;">
                                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQtano8XDvwT7ce5zfaw-k_3WvebhTRyGguAyeKTptIFdDs3BqBOyRpz_Gs2iCLK10ky0CZc4T9YxgZwrzGTBxSV3cy1Pdsb-q5NBV6mtnD_vDGvjwzxrgMx1mGNfnIeNP924CyjSV-dpBYyXg9Lzoa0e5blQtIIdy5y248h9v5L5EmQmEpMHEZYbmvqlDc5F4igFlQs_Y1KCRIE_KsyodnlE_hvM71HH1asIBuyFBOKjwqQXrO4a0dkjCsdYjQbfXwMzDNRBdi1Jh"
                                            alt="Luna Dog" class="w-100 h-100 object-fit-cover">
                                    </div>
                                </div>
                                <button class="btn btn-light position-absolute top-0 end-0 p-1 rounded-circle shadow-sm">
                                    <span class="material-symbols-outlined" style="font-size: 18px;">edit</span>
                                </button>
                            </div>
                            <p class="headline-font fw-bold mb-1">Luna</p>
                            <p class="text-muted small">Golden Retriever</p>
                        </div>
                        <!-- Pet 2 -->
                        <div class="flex-shrink-0 text-center" style="min-width: 150px;">
                            <div class="position-relative d-inline-block mb-3">
                                <div class="rounded-circle p-2"
                                    style="width: 150px; height: 150px; background-color: #e9ecef; transition: all 0.3s ease;">
                                    <div class="rounded-circle overflow-hidden bg-white border border-3 border-white"
                                        style="width: 100%; height: 100%;">
                                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBlNrcwW8are9eVHdgpLYPRc7F8CKlEzA1K2PveqJo7jMkAMKoKB1yo6BLegQvbFvAldtkfD_IDf2bZQUEmU7FJRZH-zGxxQEvdXqVjEN9XH_cH6krxgGB9egjw0yKBkk-dta3lcGmxT2Pwl1i_D32PuEQ-R_cY6jEeDilUZO5KzOOwl58ZedffW8C2yxKUOzLHYX_oYrny_Iw5ggNlKmpR3smCUYvxFmRFRqCZu5BEVrVnBSm5X2anvRm4RqRw7SR6ixrBkWRdAuhK"
                                            alt="Milo Cat" class="w-100 h-100 object-fit-cover">
                                    </div>
                                </div>
                                <button class="btn btn-light position-absolute top-0 end-0 p-1 rounded-circle shadow-sm">
                                    <span class="material-symbols-outlined" style="font-size: 18px;">edit</span>
                                </button>
                            </div>
                            <p class="headline-font fw-bold mb-1">Milo</p>
                            <p class="text-muted small">Siberian Cat</p>
                        </div>
                    </div>
                </section>

                <!-- Appointments List -->
                <section class="mb-5">
                    <h2 class="headline-font fw-bold mb-4" style="font-size: 1.5rem;">Upcoming Bookings</h2>
                    <div class="space-y-4">
                        <!-- Appointment 1 -->
                        <div class="glass-card p-4 mb-4">
                            <div class="row align-items-center g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 56px; height: 56px; background-color: rgba(255, 175, 114, 0.15); color: var(--primary-dark);">
                                            <span class="material-symbols-outlined"
                                                style="font-size: 32px;">content_cut</span>
                                        </div>
                                        <div>
                                            <h3 class="headline-font fw-bold mb-1">Full Grooming Session</h3>
                                            <p class="text-muted small mb-0">for Luna • Professional Spa</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                                        <div>
                                            <p class="text-muted small fw-bold mb-1"
                                                style="text-transform: uppercase; letter-spacing: 0.05em;">Date &amp; Time
                                            </p>
                                            <p class="fw-500">Oct 24, 2024 • 10:30 AM</p>
                                        </div>
                                        <div class="badge-custom badge-success-custom">
                                            <span class="material-symbols-outlined"
                                                style="font-size: 18px;">check_circle</span>
                                            Confirmed
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Appointment 2 -->
                        <div class="glass-card p-4 mb-4" style="opacity: 0.8;">
                            <div class="row align-items-center g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 56px; height: 56px; background-color: rgba(132, 245, 232, 0.15); color: var(--secondary-color);">
                                            <span class="material-symbols-outlined"
                                                style="font-size: 32px;">medical_services</span>
                                        </div>
                                        <div>
                                            <h3 class="headline-font fw-bold mb-1">Routine Checkup</h3>
                                            <p class="text-muted small mb-0">for Milo • Dr. Sarah Jenkins</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                                        <div>
                                            <p class="text-muted small fw-bold mb-1"
                                                style="text-transform: uppercase; letter-spacing: 0.05em;">Date &amp; Time
                                            </p>
                                            <p class="fw-500">Oct 28, 2024 • 02:15 PM</p>
                                        </div>
                                        <div class="badge-custom badge-warning-custom">
                                            <span class="material-symbols-outlined"
                                                style="font-size: 18px;">schedule</span>
                                            Pending
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn btn-link text-muted text-decoration-none">
                            View Booking History <span class="material-symbols-outlined ms-1"
                                style="font-size: 20px;">arrow_forward</span>
                        </button>
                    </div>
                </section>
            </div>

            <!-- Bookings Tab Content -->
            <div id="bookings" class="tab-content">
                <main class="bookings-main container pt-28 pb-20">
        <!-- Personalized Greeting -->
        <header class="greeting-header">
            <div>
                <h1 class="greeting-title">Hello, Sarah!</h1>
                <p class="greeting-subtitle">Welcome back to your sanctuary. Everything is ready for Luna and Oliver's next visit.</p>
            </div>
            <!-- Pet Profiles Mini-Carousel -->
            <div class="pet-profiles">
                <div class="pet-profile-avatar group">
                    <div class="avatar-ring primary-ring">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEWo5BoFL7O9edGSiMpAFS9pvtcpj0al-kur8voJa-WF6wHphQURrPBTbPd7EtBScxzS7sovqvfZbEjqHoWlp7GXPgjzqO4PEYBajqDuBCH_7VjCMoE5AxR35Td3R3jJCaUmDc4gVgQN_SEyeGBul9czXAGa-hBlKuwVWIFrhGjpFuAGDCkyfz4hrlkqAb5GP5xFaNbQh0hY8CAEIfSKCcUgwmEgddo7BXpi-9wmuUnuO3FXTP1QMENgi2KVnAs4rPJpny-iJQjX0v" alt="Luna">
                    </div>
                    <span class="pet-name text-primary">Luna</span>
                </div>
                <div class="pet-profile-avatar group">
                    <div class="avatar-ring outline-ring">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBey4u_GFONUGi_E0HbIYvcPltcFwGYmGIiyv_vLSgAyML1D83fLbPlrEwTjLacKRmzqsMOziltvPFUrlllTB_ODIASVFURaNNW_7Db1VXriS_6TSww2qLLAfwo6yweqhigII_lfIF2X9xMMV06bAuO5S5Q2MWU7Q-uuAnPhvO5UYhKi9tTIdBWm4q-Fh0dLTjN89Aerih5HwaO9wkIyW9rIwJXtMotuobU55vnnIziw5zlEAulazD2I2C_uguyEMj92nB_xl2Cl6k2" alt="Oliver">
                    </div>
                    <span class="pet-name text-on-surface-variant">Oliver</span>
                </div>
                <button class="btn-add-pet">
                    <span class="material-symbols-outlined">add</span>
                </button>
            </div>
        </header>

        <!-- Bento Grid Dashboard -->
        <div class="dashboard-grid">
            <!-- Upcoming Bookings Column -->
            <section class="upcoming-bookings">
                <div class="section-header">
                    <h2>Upcoming Bookings</h2>
                    <button class="btn-link text-secondary">View All</button>
                </div>

                <!-- Booking Card 1 (Confirmed) -->
                <div class="glass-card booking-card">
                    <div class="status-badge status-confirmed">Confirmed</div>
                    <div class="booking-img">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDc4r9b6MNRQy7jgkvVfoegUpfvLupFQLCjQu6JgjFz3EsNlZsLav0TLDNwl0yBhnnNuj116cnDDhb8k9qZF7xEGpIm1lts0OeD8UREoGNl_eoPjJkI5NU3aBtU55qi28WMQQBgxpgbLqQvdzB6_cHooNFyN-wDuzpOmsIinY6vBhK48EM2iu3Ms-7MWjP3Nf0VZivkBpP4sckvHO2-BTgwWmh9-JvZzBoYekdl0F1mZiMB09gW3f4rnPufntc_P567dC_4X3B01npo" alt="Grooming">
                    </div>
                    <div class="booking-details">
                        <h3 class="booking-title">Full Grooming Spa</h3>
                        <p class="booking-meta">Luna • Saturday, Oct 12 at 10:30 AM</p>
                        <div class="booking-actions">
                            <button class="btn-secondary">Reschedule</button>
                            <button class="btn-danger">Cancel</button>
                        </div>
                    </div>
                </div>

                <!-- Booking Card 2 (Pending) -->
                <div class="glass-card booking-card">
                    <div class="status-badge status-pending">Pending</div>
                    <div class="booking-img">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjqbwWW323arDkikJeC-QdxDnP7TtY9lLOBFoGrA7bvhFtqxedlnrXFuKcjtTHGFtJPk8W8IS_yEl3zPgziOhF90txF1Zn53XcNdEb-x58VXpwsXPCx6o9a-VMwAJD41oMbTMcHfJ_QwmOLC8lYJJmVmtzV22VH0e1N-i391NnWnbziNdcWyX2oF964QWsjqvp2lx2dVhag8sldUZ6y6Xb2baqChd7Eeb4pO1MocD8dm4HFnv63LpD6Xa3zpyyXsWhXfTpYufBsvXz" alt="Nutrition">
                    </div>
                    <div class="booking-details">
                        <h3 class="booking-title">Nutrition Consultation</h3>
                        <p class="booking-meta">Oliver • Monday, Oct 14 at 2:00 PM</p>
                        <div class="booking-actions">
                            <button class="btn-secondary">Modify Request</button>
                            <button class="btn-danger">Cancel</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Order History & Sidebar Column -->
            {{-- <aside class="dashboard-sidebar">
                <!-- Order History -->
                <div class="order-history-box">
                    <h2 class="section-title">Order History</h2>
                    <div class="order-list">
                        <!-- Order 1 -->
                        <div class="order-item group cursor-pointer">
                            <div class="order-icon-box">
                                <span class="material-symbols-outlined text-primary text-3xl">shopping_bag</span>
                            </div>
                            <div class="order-info">
                                <div class="order-header">
                                    <h4 class="order-title">Premium Grain-Free Kibble</h4>
                                    <span class="order-status text-secondary">Delivered</span>
                                </div>
                                <p class="order-meta">Order #RH-2940 • Sept 28</p>
                            </div>
                            <span class="material-symbols-outlined text-on-surface-variant chevron group-hover:translate-x-1">chevron_right</span>
                        </div>
                        <!-- Order 2 -->
                        <div class="order-item group cursor-pointer border-t">
                            <div class="order-icon-box">
                                <span class="material-symbols-outlined text-primary text-3xl">medical_services</span>
                            </div>
                            <div class="order-info">
                                <div class="order-header">
                                    <h4 class="order-title">Dental Care Kit - Large</h4>
                                    <span class="order-status text-secondary">Delivered</span>
                                </div>
                                <p class="order-meta">Order #RH-2811 • Sept 15</p>
                            </div>
                            <span class="material-symbols-outlined text-on-surface-variant chevron group-hover:translate-x-1">chevron_right</span>
                        </div>
                        <!-- Order 3 -->
                        <div class="order-item group cursor-pointer border-t">
                            <div class="order-icon-box">
                                <span class="material-symbols-outlined text-primary text-3xl">toys</span>
                            </div>
                            <div class="order-info">
                                <div class="order-header">
                                    <h4 class="order-title">Interactive Puzzle Toy</h4>
                                    <span class="order-status text-on-surface-variant">Shipped</span>
                                </div>
                                <p class="order-meta">Order #RH-3012 • Oct 05</p>
                            </div>
                            <span class="material-symbols-outlined text-on-surface-variant chevron group-hover:translate-x-1">chevron_right</span>
                        </div>
                    </div>
                    <button class="btn-outline-full">View All Orders</button>
                </div>

                <!-- Reward Points Promo -->
                <div class="rewards-promo signature-glow">
                    <div class="rewards-content">
                        <h3>Radiant Rewards</h3>
                        <p>You have 1,250 points! Redeem them for a free spa upgrade for Luna.</p>
                        <button class="btn-redeem text-primary text-xs tracking-wider uppercase">Redeem Points</button>
                    </div>
                    <span class="material-symbols-outlined rewards-icon filled">pets</span>
                </div>
            </aside> --}}
        </div>
    </main>
            </div>

            <!-- Food Orders Tab Content -->
            <div id="food-orders" class="tab-content">
                <div class="tab-header">
                    <h1 class="page-title">Food Orders</h1>
                    <p class="page-subtitle">Track your pet food purchases and orders</p>
                </div>

                <!-- Order History -->
                <section>
                    <h2 class="headline-font fw-bold mb-4" style="font-size: 1.5rem;">Order History</h2>
                    <div class="space-y-4">
                        <!-- Order 1 -->
                        <div class="glass-card p-4">
                            <div class="row align-items-center g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 56px; height: 56px; background-color: rgba(255, 175, 114, 0.15); color: var(--primary-dark);">
                                            <span class="material-symbols-outlined"
                                                style="font-size: 32px;">restaurant</span>
                                        </div>
                                        <div>
                                            <h3 class="headline-font fw-bold mb-1">Premium Dog Food - Chicken Flavor</h3>
                                            <p class="text-muted small mb-0">for Luna • 5kg Bag</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                                        <div>
                                            <p class="text-muted small fw-bold mb-1"
                                                style="text-transform: uppercase; letter-spacing: 0.05em;">Order Date</p>
                                            <p class="fw-500">Oct 15, 2024</p>
                                        </div>
                                        <div class="badge-custom badge-success-custom">
                                            <span class="material-symbols-outlined"
                                                style="font-size: 18px;">local_shipping</span>
                                            Delivered
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order 2 -->
                        <div class="glass-card p-4">
                            <div class="row align-items-center g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 56px; height: 56px; background-color: rgba(132, 245, 232, 0.15); color: var(--secondary-color);">
                                            <span class="material-symbols-outlined" style="font-size: 32px;">pets</span>
                                        </div>
                                        <div>
                                            <h3 class="headline-font fw-bold mb-1">Cat Treats - Salmon Flavor</h3>
                                            <p class="text-muted small mb-0">for Milo • 500g Pack</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                                        <div>
                                            <p class="text-muted small fw-bold mb-1"
                                                style="text-transform: uppercase; letter-spacing: 0.05em;">Order Date</p>
                                            <p class="fw-500">Oct 20, 2024</p>
                                        </div>
                                        <div class="badge-custom badge-warning-custom">
                                            <span class="material-symbols-outlined"
                                                style="font-size: 18px;">schedule</span>
                                            In Transit
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order 3 -->
                        <div class="glass-card p-4">
                            <div class="row align-items-center g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 56px; height: 56px; background-color: rgba(253, 211, 77, 0.15); color: var(--tertiary-color);">
                                            <span class="material-symbols-outlined"
                                                style="font-size: 32px;">medication</span>
                                        </div>
                                        <div>
                                            <h3 class="headline-font fw-bold mb-1">Joint Health Supplements</h3>
                                            <p class="text-muted small mb-0">for Luna • 30 Tablets</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                                        <div>
                                            <p class="text-muted small fw-bold mb-1"
                                                style="text-transform: uppercase; letter-spacing: 0.05em;">Order Date</p>
                                            <p class="fw-500">Nov 1, 2024</p>
                                        </div>
                                        <div class="badge-custom badge-success-custom">
                                            <span class="material-symbols-outlined"
                                                style="font-size: 18px;">check_circle</span>
                                            Delivered
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Profile Tab Content -->
            <div id="profile" class="tab-content">
                <div class="tab-header">
                    <h1 class="page-title">Profile Settings</h1>
                    <p class="page-subtitle">Update your personal information and preferences</p>
                </div>

                <div class="row">
                    <!-- Profile Image Section -->
                    <div class="col-lg-4">
                        <div class="glass-card p-4 text-center">
                            <h3 class="headline-font fw-bold mb-4" style="font-size: 1.25rem;">Profile Picture</h3>
                            <div class="profile-image-upload">
                                <div class="profile-image-preview">
                                    <img id="profilePreview"
                                        src="{{ Auth::user()->profile_image ?? 'https://via.placeholder.com/150' }}"
                                        alt="Profile Picture">
                                </div>
                                <input type="file" id="profileImage" name="profile_image" accept="image/*"
                                    style="display: none;">
                                <button type="button" class="btn btn-primary-custom mt-3"
                                    onclick="document.getElementById('profileImage').click()">
                                    <span class="material-symbols-outlined">photo_camera</span>
                                    Change Photo
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Form -->
                    <div class="col-lg-8">
                        <div class="glass-card p-5">
                            <h3 class="headline-font fw-bold mb-4" style="font-size: 1.25rem;">Personal Information</h3>
                            <form id="profileForm" class="profile-form">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name" class="form-label">First Name</label>
                                            <input type="text" id="first_name" name="first_name" class="form-control"
                                                value="{{ Auth::user()->first_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name" class="form-label">Last Name</label>
                                            <input type="text" id="last_name" name="last_name" class="form-control"
                                                value="{{ Auth::user()->last_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                value="{{ Auth::user()->email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input type="tel" id="mobile" name="mobile" class="form-control"
                                                value="{{ Auth::user()->mobile ?? '' }}"
                                                placeholder="Enter mobile number">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr class="my-4">
                                        <h4 class="headline-font fw-bold mb-3" style="font-size: 1.1rem;">Change Password
                                        </h4>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="current_password" class="form-label">Current Password</label>
                                            <input type="password" id="current_password" name="current_password"
                                                class="form-control" placeholder="Enter current password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="new_password" class="form-label">New Password</label>
                                            <input type="password" id="new_password" name="new_password"
                                                class="form-control" placeholder="Enter new password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                                            <input type="password" id="confirm_password" name="confirm_password"
                                                class="form-control" placeholder="Confirm new password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary-custom">
                                            <span class="material-symbols-outlined">save</span>
                                            Save Changes
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @push('scripts')
        <script src="{{ asset('js/dashboard.js') }}"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const tabs = document.querySelectorAll(".nav-tab");
                const contents = document.querySelectorAll(".tab-content");

                tabs.forEach(tab => {
                    tab.addEventListener("click", function() {
                        const target = this.getAttribute("data-tab");

                        // Remove active from all tabs
                        tabs.forEach(t => t.classList.remove("active"));

                        // Hide all content
                        contents.forEach(c => {
                            c.classList.remove("active");
                            c.style.display = "none";
                        });

                        // Activate clicked tab
                        this.classList.add("active");

                        // Show correct content
                        const activeContent = document.getElementById(target);
                        if (activeContent) {
                            activeContent.classList.add("active");
                            activeContent.style.display = "block";
                        }
                    });
                });
            });
        </script>
    @endpush

@endsection