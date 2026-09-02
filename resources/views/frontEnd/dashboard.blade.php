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
                <button type="button" class="nav-tab" data-tab="pro-orders">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span class="tab-text">Orders</span>
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
                                        <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : 'https://via.placeholder.com/150' }}"
                                            alt="User Profile" class="w-100 h-100 object-fit-cover">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="text-md-start text-center">
                                    <span class="badge badge-light headline-font fw-bold text-primary"
                                        style="font-size: 0.65rem; letter-spacing: 0.1em; color: var(--primary-color) !important;">
                                        Member Since {{ Auth::user()->created_at->format('Y') }}
                                    </span>
                                    <h1 class="headline-font fw-bold mt-2" style="font-size: 2.5rem;">
                                        {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h1>
                                    <div
                                        class="mt-3 d-flex gap-2 justify-content-md-start justify-content-center flex-wrap">
                                        <div class="badge-custom badge-success-custom">
                                            <span class="material-symbols-outlined" style="font-size: 18px;">verified</span>
                                            {{ Auth::user()->user_type == 0 ? 'VIP' : (Auth::user()->user_type == 1 ? 'Standard' : 'New Member') }}
                                        </div>
                                        {{-- <div class="badge-custom"
                                            style="background-color: rgba(253, 211, 77, 0.3); color: var(--tertiary-color);">
                                            <span class="material-symbols-outlined" style="font-size: 18px;">star</span>
                                            420 Points
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Quick Actions -->
                {{-- <section class="mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary-custom quick-btn w-100">
                                <span class="material-symbols-outlined">calendar_add_on</span>
                                Book a Service
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-secondary-custom quick-btn w-100">
                                <span class="material-symbols-outlined">shopping_basket</span>
                                Buy Pet Food
                            </button>
                        </div>
                    </div>
                </section> --}}

                <!-- Pets Section -->
                <section class="mb-5">
                    <div class="imp-very d-flex align-items-center justify-content-between mb-4">
                        <h2 class="headline-font fw-bold" style="font-size: 1.5rem;">
                            My Pet Family
                            <span class="badge rounded-pill"
                                style="background-color: rgba(255, 175, 114, 0.2); color: var(--primary-dark); font-size: 0.75rem;">
                                {{ $pets->count() }} {{ Str::plural('Pet', $pets->count()) }}
                            </span>
                        </h2>
                        <button type="button" class="btn btn-link text-primary text-decoration-none fw-semibold addBtn">
                            Add Pet <span class="material-symbols-outlined ms-1" style="font-size: 20px;">add_circle</span>
                        </button>
                    </div>

                    @if ($pets->count() > 0)
                        <div class="imp-very d-flex gap-4 overflow-auto hide-scrollbar pb-3">
                            @foreach ($pets as $pet)
                                <div class="flex-shrink-0 text-center" style="min-width: 150px;">
                                    <div class="position-relative d-inline-block mb-3">
                                        <div class="rounded-circle p-2"
                                            style="width: 150px; height: 150px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-light) 100%);">
                                            <div class="rounded-circle overflow-hidden bg-white border border-3 border-white"
                                                style="width: 100%; height: 100%;">
                                                <img src="{{ $pet->pet_image ? asset($pet->pet_image) : 'https://via.placeholder.com/150' }}"
                                                    alt="{{ $pet->pet_name }}" class="w-100 h-100 object-fit-cover">
                                            </div>
                                        </div>
                                        <button type="button"
                                            class="btn btn-light position-absolute top-0 end-0 p-1 rounded-circle shadow-sm editPetBtn"
                                            data-id="{{ $pet->id }}" data-name="{{ $pet->pet_name }}"
                                            data-age="{{ $pet->pet_age }}" data-species="{{ $pet->species }}"
                                            data-breed="{{ $pet->breed?->id ?? $pet->getRawOriginal('breed') }}"
                                            data-description="{{ $pet->pet_description }}"
                                            data-image="{{ $pet->pet_image ? asset($pet->pet_image) : 'https://via.placeholder.com/90' }}">
                                            <span class="material-symbols-outlined" style="font-size: 18px;">edit</span>
                                        </button>
                                        <button type="button"
                                            class="btn btn-light position-absolute bottom-0 end-0 p-1 rounded-circle shadow-sm delete-pet-btn"
                                            data-pet-id="{{ $pet->id }}">
                                            <span class="material-symbols-outlined text-danger"
                                                style="font-size: 18px;">delete</span>
                                        </button>
                                    </div>
                                    <p class="headline-font fw-bold mb-1">{{ $pet->pet_name }}</p>
                                    <p class="headline-font fw-bold mb-1">{{ $pet->pet_age }} years old</p>
                                    <p class="text-muted small">{{ $pet->breed->breed_name ?? 'Unknown breed' }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="glass-card p-4 text-center text-muted">
                            <span class="material-symbols-outlined" style="font-size: 32px;">pets</span>
                            <p class="mb-0 mt-2">You don't have any pets yet.</p>
                        </div>
                    @endif
                </section>

                <!-- Appointments List -->
                {{-- <section class="mb-5">
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
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn btn-link text-muted text-decoration-none">
                            View Booking History <span class="material-symbols-outlined ms-1"
                                style="font-size: 20px;">arrow_forward</span>
                        </button>
                    </div>
                </section> --}}
            </div>

            <!-- Bookings Tab Content -->
            <div id="bookings" class="tab-content">
                <main class="bookings-main container pt-28 pb-20">
                    <!-- Personalized Greeting -->
                    {{-- <header class="greeting-header">
                        <div>
                            <h1 class="greeting-title">Hello, Sarah!</h1>
                            <p class="greeting-subtitle">Welcome back to your sanctuary. Everything is ready for Luna and
                                Oliver's next visit.</p>
                        </div>
                        <!-- Pet Profiles Mini-Carousel -->
                        <div class="pet-profiles">
                            <div class="pet-profile-avatar group">
                                <div class="avatar-ring primary-ring">
                                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEWo5BoFL7O9edGSiMpAFS9pvtcpj0al-kur8voJa-WF6wHphQURrPBTbPd7EtBScxzS7sovqvfZbEjqHoWlp7GXPgjzqO4PEYBajqDuBCH_7VjCMoE5AxR35Td3R3jJCaUmDc4gVgQN_SEyeGBul9czXAGa-hBlKuwVWIFrhGjpFuAGDCkyfz4hrlkqAb5GP5xFaNbQh0hY8CAEIfSKCcUgwmEgddo7BXpi-9wmuUnuO3FXTP1QMENgi2KVnAs4rPJpny-iJQjX0v"
                                        alt="Luna">
                                </div>
                                <span class="pet-name text-primary">Luna</span>
                            </div>
                            <div class="pet-profile-avatar group">
                                <div class="avatar-ring outline-ring">
                                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBey4u_GFONUGi_E0HbIYvcPltcFwGYmGIiyv_vLSgAyML1D83fLbPlrEwTjLacKRmzqsMOziltvPFUrlllTB_ODIASVFURaNNW_7Db1VXriS_6TSww2qLLAfwo6yweqhigII_lfIF2X9xMMV06bAuO5S5Q2MWU7Q-uuAnPhvO5UYhKi9tTIdBWm4q-Fh0dLTjN89Aerih5HwaO9wkIyW9rIwJXtMotuobU55vnnIziw5zlEAulazD2I2C_uguyEMj92nB_xl2Cl6k2"
                                        alt="Oliver">
                                </div>
                                <span class="pet-name text-on-surface-variant">Oliver</span>
                            </div>
                            <button class="btn-add-pet">
                                <span class="material-symbols-outlined">add</span>
                            </button>
                        </div>
                    </header> --}}

                    <!-- Bento Grid Dashboard -->
                    {{-- <div class="dashboard-grid">
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
                                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDc4r9b6MNRQy7jgkvVfoegUpfvLupFQLCjQu6JgjFz3EsNlZsLav0TLDNwl0yBhnnNuj116cnDDhb8k9qZF7xEGpIm1lts0OeD8UREoGNl_eoPjJkI5NU3aBtU55qi28WMQQBgxpgbLqQvdzB6_cHooNFyN-wDuzpOmsIinY6vBhK48EM2iu3Ms-7MWjP3Nf0VZivkBpP4sckvHO2-BTgwWmh9-JvZzBoYekdl0F1mZiMB09gW3f4rnPufntc_P567dC_4X3B01npo"
                                        alt="Grooming">
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
                                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjqbwWW323arDkikJeC-QdxDnP7TtY9lLOBFoGrA7bvhFtqxedlnrXFuKcjtTHGFtJPk8W8IS_yEl3zPgziOhF90txF1Zn53XcNdEb-x58VXpwsXPCx6o9a-VMwAJD41oMbTMcHfJ_QwmOLC8lYJJmVmtzV22VH0e1N-i391NnWnbziNdcWyX2oF964QWsjqvp2lx2dVhag8sldUZ6y6Xb2baqChd7Eeb4pO1MocD8dm4HFnv63LpD6Xa3zpyyXsWhXfTpYufBsvXz"
                                        alt="Nutrition">
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
                        <aside class="dashboard-sidebar">
                            <!-- Order History -->
                            <div class="order-history-box">
                                <h2 class="section-title">Order History</h2>
                                <div class="order-list">
                                    <!-- Order 1 -->
                                    <div class="order-item group cursor-pointer">
                                        <div class="order-icon-box">
                                            <span
                                                class="material-symbols-outlined text-primary text-3xl">shopping_bag</span>
                                        </div>
                                        <div class="order-info">
                                            <div class="order-header">
                                                <h4 class="order-title">Premium Grain-Free Kibble</h4>
                                                <span class="order-status text-secondary">Delivered</span>
                                            </div>
                                            <p class="order-meta">Order #RH-2940 • Sept 28</p>
                                        </div>
                                        <span
                                            class="material-symbols-outlined text-on-surface-variant chevron group-hover:translate-x-1">chevron_right</span>
                                    </div>
                                    <!-- Order 2 -->
                                    <div class="order-item group cursor-pointer border-t">
                                        <div class="order-icon-box">
                                            <span
                                                class="material-symbols-outlined text-primary text-3xl">medical_services</span>
                                        </div>
                                        <div class="order-info">
                                            <div class="order-header">
                                                <h4 class="order-title">Dental Care Kit - Large</h4>
                                                <span class="order-status text-secondary">Delivered</span>
                                            </div>
                                            <p class="order-meta">Order #RH-2811 • Sept 15</p>
                                        </div>
                                        <span
                                            class="material-symbols-outlined text-on-surface-variant chevron group-hover:translate-x-1">chevron_right</span>
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
                                        <span
                                            class="material-symbols-outlined text-on-surface-variant chevron group-hover:translate-x-1">chevron_right</span>
                                    </div>
                                </div>
                                <button class="btn-outline-full">View All Orders</button>
                            </div>

                            <!-- Reward Points Promo -->
                            <div class="rewards-promo signature-glow">
                                <div class="rewards-content">
                                    <h3>Radiant Rewards</h3>
                                    <p>You have 1,250 points! Redeem them for a free spa upgrade for Luna.</p>
                                    <button class="btn-redeem text-primary text-xs tracking-wider uppercase">Redeem
                                        Points</button>
                                </div>
                                <span class="material-symbols-outlined rewards-icon filled">pets</span>
                            </div>
                        </aside>
                    </div> --}}

                    <div class="glass-card p-4 text-center text-muted">
                        {{-- <span class="material-symbols-outlined" style="font-size: 32px;">local_shipping</span> --}}
                        <span class="material-symbols-outlined" style="font-size: 32px;">event_upcoming</span>
                        <p class="mb-0 mt-2">Comming Soon</p>
                    </div>
                </main>
            </div>

            <!-- Orders Tab Content -->
            <div id="pro-orders" class="tab-content">
                <div class="tab-header">
                    <h1 class="page-title">Orders History</h1>
                </div>

                <!-- Order History -->
                <section>
                    <div class="space-y-4">

                        <p>Ongoing Orders</p>
                        @forelse ($ongoingOrders as $order)
                            <div class="glass-card p-4">
                                <div class="row align-items-center g-4">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-3">
                                            <div>
                                                <h3 class="headline-font fw-bold mb-1">Order No: #{{ $order->order_no }}
                                                </h3>
                                                <p class="text-muted small mb-0">Placed on
                                                    {{ $order->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                                            <div class="hoi">
                                                <div class="badge-custom badge-warning-custom">
                                                    <span class="material-symbols-outlined"
                                                        style="font-size: 18px;">local_shipping</span>
                                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                                </div>
                                                <a href="{{ route('user.track-order', $order->order_no) }}"
                                                    class="badge-custom badge-success-custom text-decoration-none">
                                                    <span class="material-symbols-outlined"
                                                        style="font-size: 18px;">local_shipping</span>
                                                    Track Order
                                                </a>
                                                <button type="button"
                                                    class="badge-custom badge-success-custom border-0 order-details-open-btn"
                                                    data-drawer-id="orderDetailsDrawer{{ $order->id }}">
                                                    <span class="material-symbols-outlined"
                                                        style="font-size: 18px;">receipt_long</span>
                                                    Details
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="glass-card p-4 text-center text-muted">
                                <span class="material-symbols-outlined" style="font-size: 32px;">local_shipping</span>
                                <p class="mb-0 mt-2">You don't have any ongoing orders yet.</p>
                            </div>
                        @endforelse

                        <p>Orders</p>
                        @forelse ($completedOrders as $order)
                            <div class="glass-card p-4">
                                <div class="row align-items-center g-4">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-3">
                                            <div>
                                                <h3 class="headline-font fw-bold mb-1">Order No: #{{ $order->order_no }}
                                                </h3>
                                                <p class="text-muted small mb-0">Placed on
                                                    {{ $order->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                                            <div class="hoi">
                                                <div
                                                    class="badge-custom {{ $order->tracking_stage === 'cancelled' ? 'badge-warning-custom' : 'badge-success-custom' }}">
                                                    <span class="material-symbols-outlined"
                                                        style="font-size: 18px;">local_shipping</span>
                                                    {{ ucfirst($order->tracking_stage) }}
                                                </div>
                                                <button type="button"
                                                    class="badge-custom badge-success-custom border-0 order-details-open-btn"
                                                    data-drawer-id="orderDetailsDrawer{{ $order->id }}">
                                                    <span class="material-symbols-outlined"
                                                        style="font-size: 18px;">receipt_long</span>
                                                    Details
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="glass-card p-4 text-center text-muted">
                                <span class="material-symbols-outlined" style="font-size: 32px;">inventory_2</span>
                                <p class="mb-0 mt-2">You don't have any completed orders yet.</p>
                            </div>
                        @endforelse

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
                                @csrf
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
                                                value="{{ Auth::user()->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input type="tel" id="mobile" name="mobile" class="form-control"
                                                value="{{ Auth::user()->mobile ?? '' }}"
                                                placeholder="Enter mobile number" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="location" class="form-label">Address</label>
                                            <input type="text" id="location" name="location" class="form-control"
                                                value="{{ Auth::user()->location ?? '' }}"
                                                placeholder="Enter Your Address">
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

    {{-- Order Details --}}
    @php $allOrders = $ongoingOrders->concat($completedOrders); @endphp

    @foreach ($allOrders as $order)
        <div class="order-drawer-backdrop" id="orderDetailsDrawer{{ $order->id }}Backdrop"
            style="display:none; position:fixed; inset:0; background:rgba(15,23,42,0.45); z-index:1040;">
        </div>
        <div class="order-drawer-panel" id="orderDetailsDrawer{{ $order->id }}">
            <div class="drawer-header">
                <div>
                    <p class="fw-bold mb-1 text-uppercase"
                        style="font-size: 0.72rem; letter-spacing: 0.08em; color: var(--primary-color);">
                        Order Details
                    </p>
                    <h5 class="mb-0 fw-bold">#{{ $order->order_no }}</h5>
                </div>
                <button type="button" class="btn-close order-drawer-close"></button>
            </div>

            <div class="p-4 d-flex flex-column gap-4">

                <div class="drawer-customer-block">
                    <div class="drawer-avatar">{{ strtoupper(substr($order->shipping_name, 0, 2)) }}</div>
                    <div>
                        <p class="mb-0 fw-bold">{{ $order->shipping_name }}</p>
                        <p class="mb-0 text-muted small">{{ $order->shipping_email }}</p>
                        <div class="Customer-status-badges">
                            <div class="badge-custom badge-success-custom">{{ ucfirst($order->status) }}</div>
                        </div>
                    </div>
                </div>

                <div>
                    <p class="drawer-section-title mb-2">
                        <span class="material-symbols-outlined" style="font-size:16px;">location_on</span>
                        Delivery Address
                    </p>
                    <div class="drawer-info-box">
                        <p class="mb-0">{!! nl2br(e($order->shipping_address)) !!}</p>
                    </div>
                </div>

                <div>
                    <p class="drawer-section-title mb-3">Order Summary</p>
                    <div class="d-flex flex-column gap-3">
                        @foreach ($order->items as $item)
                            <div class="itemm">
                                <div class="item-thumb">{{ strtoupper(substr($item->product_name, 0, 2)) }}</div>
                                <div class="flex-grow-1">
                                    <p class="mb-0 fw-bold" style="font-size:0.85rem;">{{ $item->product_name }}</p>
                                    <p class="mb-0 text-muted" style="font-size:0.75rem;">Qty: {{ $item->quantity }}</p>
                                </div>
                                <p class="mb-0 fw-bold" style="font-size:0.85rem;">
                                    ${{ number_format($item->subtotal, 2) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="summary-box">
                    <div class="pri text-muted mb-2" style="font-size:0.78rem;">
                        <span>Subtotal</span><span>${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="pri text-muted mb-2" style="font-size:0.78rem;">
                        <span>Discount</span><span>-${{ number_format($order->discount_amount, 2) }}</span>
                    </div>
                    <div class="pri text-muted mb-2" style="font-size:0.78rem;">
                        <span>Shipping</span><span>${{ number_format($order->shipping_charge, 2) }}</span>
                    </div>
                    <div class="pri text-muted mb-2 fw-bold pt-2"
                        style="font-size:0.9rem; border-top: 1px solid rgba(15,23,42,0.08);">
                        <span>Total Amount</span><span>${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>

            </div>
        </div>
    @endforeach


    <!-- Add Pet Modal -->
    <div id="addNewpetModal" class="modal-overlay hidden">
        <div class="modern-modal">
            <!-- HEADER -->
            <div class="modal-header">
                <div>
                    <h4 class="title">Add Pet</h4>
                    <p class="subtitle">Create a new pet profile</p>
                </div>
                <button id="closeAddNewpetModalTop" class="close-btn closeAddNewpetModalBtn">✕</button>
            </div>
            <!-- BODY -->
            <div class="modal-body">
                <form id="addPetForm" enctype="multipart/form-data">
                    @csrf
                    <!-- PET SECTION HEADER -->
                    <div class="section-title">
                        <span>🐾 Pets Information</span>
                    </div>
                    <!-- PET CONTAINER -->
                    <div id="petContainer">
                        <div class="pet-card">
                            <div class="pet-header">
                                <strong>Add Pet</strong>
                                <button type="button" class="removePetBtn">Remove</button>
                            </div>
                            <div class="pet-top">
                                <img src="https://via.placeholder.com/90" class="pet-preview petImagePreview">
                                <input type="file" class="petImageInput d-none" style="display:none;"
                                    accept="image/*">
                                <button type="button" class="changePetImageBtn">Upload Pet Photo</button>
                            </div>
                            <div class="pet-grid">
                                <input type="text" name="pet_name" placeholder="Pet Name" class="pet_name pet_input">
                                <input type="text" name="pet_age" placeholder="Age" class="pet_age pet_input">
                                <select name="species" class="pet_input species-select">
                                    <option value="">Select Species</option>
                                    @forelse ($species as $specie)
                                        <option value="{{ $specie->id }}">
                                            {{ $specie->species_name }}
                                        </option>
                                    @empty
                                        <option disabled>No species available</option>
                                    @endforelse
                                </select>
                                <select name="breed" class="pet_input breed-select">
                                    <option value="">Select Breed</option>
                                </select>
                            </div>
                            {{-- <div class="pet-status">
                                <label><input type="radio" name="pet_status_0" value="1" class="pet_status"
                                        checked> Active</label>
                                <label><input type="radio" name="pet_status_0" value="0" class="pet_status">
                                    Inactive</label>
                            </div> --}}
                            <textarea name="pet_description" class="pet_description"placeholder="Pet description..."></textarea>
                        </div>
                    </div>
                    <!-- ADD PET BUTTON -->
                    <button type="button" id="addPetBtn" class="add-pet-btn">
                        + Add Another Pet
                    </button>
                </form>
            </div>
            <!-- FOOTER -->
            <div class="modal-footer">
                <button id="closeAddNewpetModalBottom" class="btn-cancel closeAddNewpetModalBtn">Cancel</button>
                <button id="submitParentBtn" class="btn-save">Save</button>
            </div>
        </div>
    </div>

    <!-- Edit Pet Modal -->
    <div id="editPetModal" class="modal-overlay hidden">
        <div class="modern-modal">
            <!-- HEADER -->
            <div class="modal-header">
                <div>
                    <h4 class="title">Edit Pet</h4>
                    <p class="subtitle">Update pet profile</p>
                </div>
                <button id="closeEditPetModalTop" class="close-btn closeEditPetModalBtn">✕</button>
            </div>
            <!-- BODY -->
            <div class="modal-body">
                <form id="editPetForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pet_id" id="edit_pet_id">

                    <div class="section-title">
                        <span>🐾 Pet Information</span>
                    </div>

                    <div class="pet-card">
                        <div class="pet-top">
                            <img src="https://via.placeholder.com/90" class="pet-preview" id="editPetImagePreview">
                            <input type="file" id="editPetImageInput" class="d-none" style="display:none;"
                                accept="image/*">
                            <button type="button" id="editChangePetImageBtn">Upload Pet Photo</button>
                        </div>
                        <div class="pet-grid">
                            <input type="text" name="pet_name" id="edit_pet_name" placeholder="Pet Name"
                                class="pet_input">
                            <input type="text" name="pet_age" id="edit_pet_age" placeholder="Age" class="pet_input">
                            <select name="species" id="edit_species" class="pet_input">
                                <option value="">Select Species</option>
                                @forelse ($species as $specie)
                                    <option value="{{ $specie->id }}">{{ $specie->species_name }}</option>
                                @empty
                                    <option disabled>No species available</option>
                                @endforelse
                            </select>
                            <select name="breed" id="edit_breed" class="pet_input">
                                <option value="">Select Breed</option>
                            </select>
                        </div>
                        <textarea name="pet_description" id="edit_pet_description" class="pet_description" placeholder="Pet description..."></textarea>
                    </div>
                </form>
            </div>
            <!-- FOOTER -->
            <div class="modal-footer">
                <button id="closeEditPetModalBottom" class="btn-cancel closeEditPetModalBtn">Cancel</button>
                <button id="submitEditPetBtn" class="btn-save">Save Changes</button>
            </div>
        </div>
    </div>




    @push('scripts')
        <script src="{{ asset('js/dashboard.js') }}"></script>

        {{-- Add New Pet Modal Scripts --}}
        <script>
            $('.addBtn').click(function() {
                $('#addNewpetModal').removeClass('hidden');
                $('body').addClass('modal-open');
            });

            $(document).on('click', '.closeAddNewpetModalBtn', function() {
                $('#addNewpetModal').addClass('hidden');
                $('body').removeClass('modal-open');
            });

            $(document).on('click', '#addNewpetModal', function(e) {
                if ($(e.target).is('#addNewpetModal')) {
                    $('#addNewpetModal').addClass('hidden');
                }
            });

            // Counter to keep each pet-card's radio group unique
            let petIndex = 0;

            // add another pet section
            $(document).on('click', '#addPetBtn', function(e) {
                e.preventDefault();

                let $lastPet = $('.pet-card').last();
                let $newPet = $lastPet.clone(false, false);

                petIndex++;
                $newPet.attr('data-index', petIndex);

                // reset text/textarea inputs
                $newPet.find('input[type="text"], textarea').val('');
                $newPet.find('input[type="file"]').val('');

                // reset species select
                $newPet.find('.species-select').prop('selectedIndex', 0);

                // fully clear breed select (remove stale options, not just reset index)
                $newPet.find('.breed-select').empty().append('<option value="">Select Breed</option>');

                // give this card's radios a unique name so groups don't clash across cards
                // $newPet.find('input[type="radio"]').attr('name', 'pet_status_' + petIndex);
                // $newPet.find('input[type="radio"]').prop('checked', false);
                // $newPet.find('input[value="1"]').prop('checked', true);

                // reset image preview
                $newPet.find('.petImagePreview').attr('src', 'https://via.placeholder.com/90');

                $('#petContainer').append($newPet);
            });

            // Remove pet section
            $(document).on('click', '.removePetBtn', function(e) {
                e.preventDefault();
                let $card = $(this).closest('.pet-card');
                if ($('.pet-card').length > 1) {
                    $card.remove();
                    return;
                }
                // If only 1 pet → CLEAN instead of removing
                $card.find('input[type="text"], textarea').val('');
                $card.find('.species-select').prop('selectedIndex', 0);
                $card.find('.breed-select').empty().append('<option value="">Select Breed</option>');
                // $card.find('input[type="radio"]').prop('checked', false);
                // $card.find('input[value="1"]').prop('checked', true);
                $card.find('.petImagePreview').attr('src', 'https://via.placeholder.com/90');
                $card.find('.petImageInput').val('');
            });

            // Select Species → Load Breeds
            const BREED_URL = "{{ url('user/get-breeds') }}";

            $(document).on('change', '.species-select', function() {
                let speciesID = $(this).val();
                let breedSelect = $(this).closest('.pet-card').find('.breed-select');

                breedSelect.empty();
                breedSelect.append('<option value="">Select Breed</option>');
                if (!speciesID) {
                    return;
                }
                $.ajax({
                    url: BREED_URL + '/' + speciesID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data.length === 0) {
                            breedSelect.append('<option disabled>No breed found</option>');
                            return;
                        }
                        $.each(data, function(key, value) {
                            breedSelect.append(
                                `<option value="${value.id}">${value.breed_name}</option>`
                            );
                        });
                    },
                    error: function() {
                        breedSelect.empty();
                        breedSelect.append('<option disabled>Error loading breeds</option>');
                    }
                });
            });
        </script>

        {{-- Pet Modal Images Upload and Preview --}}
        <script>
            // Trigger hidden file input when "Upload Pet Photo" is clicked
            $(document).on('click', '.changePetImageBtn', function() {
                $(this).closest('.pet-top').find('.petImageInput').trigger('click');
            });

            // Preview selected image
            $(document).on('change', '.petImageInput', function() {
                let file = this.files[0];
                if (!file) return;

                let $preview = $(this).closest('.pet-top').find('.petImagePreview');

                let reader = new FileReader();
                reader.onload = function(e) {
                    $preview.attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            });
        </script>

        {{-- Save Pet Scripts --}}
        <script>
            $(document).on('click', '#submitParentBtn', function() {

                let $btn = $(this);
                let originalText = $btn.html();
                $btn.prop('disabled', true).html('Saving...');

                let form = document.getElementById('addPetForm');
                let formData = new FormData(form);


                $('.pet-card').each(function(index) {

                    let $pet = $(this);

                    formData.append(`pets[${index}][pet_name]`,
                        $pet.find('.pet_name').val()
                    );

                    formData.append(`pets[${index}][pet_age]`,
                        $pet.find('.pet_age').val()
                    );

                    formData.append(`pets[${index}][species]`,
                        $pet.find('.species-select').val()
                    );

                    formData.append(`pets[${index}][breed]`,
                        $pet.find('.breed-select').val()
                    );

                    // formData.append(`pets[${index}][status]`,
                    //     $pet.find('.pet_status:checked').val() || 1
                    // );
                    formData.append(`pets[${index}][status]`, 1);

                    formData.append(`pets[${index}][pet_description]`,
                        $pet.find('.pet_description').val()
                    );

                    let fileInput = $pet.find('.petImageInput')[0];

                    if (fileInput && fileInput.files[0]) {
                        formData.append(`pets[${index}][image]`, fileInput.files[0]);
                    }
                });

                $.ajax({
                    url: '{{ route('pet.store') }}', // was customer.store
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        toastr.success('Success! Parent and pets saved successfully.');
                        $('#addNewpetModal').addClass('hidden');
                        $('body').removeClass('modal-open');

                        $('#addPetForm')[0].reset();

                        $('.pet-card:not(:first)').remove();

                        let $firstPet = $('.pet-card').first();

                        $firstPet.find('.pet_name').val('');
                        $firstPet.find('.pet_age').val('');
                        $firstPet.find('.pet_description').val('');
                        $firstPet.find('.species-select').prop('selectedIndex', 0); // added

                        $firstPet.find('.breed-select')
                            .empty()
                            .append('<option value="">Select Breed</option>');

                        $firstPet.find('.petImagePreview')
                            .attr('src', 'https://via.placeholder.com/90');

                        // $firstPet.find('.pet_status').prop('checked', false);
                        // $firstPet.find('.pet_status[value="1"]').prop('checked', true);

                        setTimeout(() => location.reload(), 1500);
                    },

                    error: function(xhr) {

                        console.log(xhr.responseText);

                        let message = 'Something went wrong.';

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON?.errors;
                            if (errors) {
                                message = Object.values(errors).flat().join('<br>');
                            }
                        } else if (xhr.responseJSON?.message) {
                            message = xhr.responseJSON.message;
                        }

                        toastr.error(message);
                    },

                    complete: function() {
                        $btn.prop('disabled', false).html(originalText);
                    }
                });
            });
        </script>

        {{-- Edit Pet Scripts --}}
        <script>
            // Open Edit Modal and populate data
            $(document).on('click', '.editPetBtn', function() {
                let $btn = $(this);

                $('#edit_pet_id').val($btn.data('id'));
                $('#edit_pet_name').val($btn.data('name'));
                $('#edit_pet_age').val($btn.data('age'));
                $('#edit_pet_description').val($btn.data('description'));
                $('#editPetImagePreview').attr('src', $btn.data('image'));
                $('#edit_species').val($btn.data('species'));

                // Load breeds for this species, then select the current breed
                let selectedBreedId = $btn.data('breed');
                let breedSelect = $('#edit_breed');
                breedSelect.empty().append('<option value="">Select Breed</option>');

                if ($btn.data('species')) {
                    $.ajax({
                        url: BREED_URL + '/' + $btn.data('species'),
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $.each(data, function(key, value) {
                                breedSelect.append(
                                    `<option value="${value.id}">${value.breed_name}</option>`
                                );
                            });
                            breedSelect.val(selectedBreedId);
                        },
                        error: function() {
                            breedSelect.append('<option disabled>Error loading breeds</option>');
                        }
                    });
                }

                $('#editPetModal').removeClass('hidden');
                $('body').addClass('modal-open');
            });

            // Close Edit Modal
            $(document).on('click', '.closeEditPetModalBtn', function() {
                $('#editPetModal').addClass('hidden');
                $('body').removeClass('modal-open');
            });

            $(document).on('click', '#editPetModal', function(e) {
                if ($(e.target).is('#editPetModal')) {
                    $('#editPetModal').addClass('hidden');
                    $('body').removeClass('modal-open');
                }
            });

            // Species change inside Edit modal reloads breeds
            $(document).on('change', '#edit_species', function() {
                let speciesID = $(this).val();
                let breedSelect = $('#edit_breed');

                breedSelect.empty().append('<option value="">Select Breed</option>');
                if (!speciesID) return;

                $.ajax({
                    url: BREED_URL + '/' + speciesID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $.each(data, function(key, value) {
                            breedSelect.append(
                                `<option value="${value.id}">${value.breed_name}</option>`
                            );
                        });
                    },
                    error: function() {
                        breedSelect.append('<option disabled>Error loading breeds</option>');
                    }
                });
            });

            // Trigger hidden file input for edit image
            $(document).on('click', '#editChangePetImageBtn', function() {
                $('#editPetImageInput').trigger('click');
            });

            // Preview new image
            $(document).on('change', '#editPetImageInput', function() {
                let file = this.files[0];
                if (!file) return;
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#editPetImagePreview').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            });

            // Submit edit form
            $(document).on('click', '#submitEditPetBtn', function() {
                let $btn = $(this);
                let originalText = $btn.html();
                $btn.prop('disabled', true).html('Saving...');

                let petId = $('#edit_pet_id').val();
                let formData = new FormData(document.getElementById('editPetForm'));
                formData.append('_method', 'PUT');

                let fileInput = document.getElementById('editPetImageInput');
                if (fileInput.files[0]) {
                    formData.append('image', fileInput.files[0]);
                }

                $.ajax({
                    url: `{{ route('pet.update', ':id') }}`.replace(':id', petId),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success('Pet updated successfully.');
                        $('#editPetModal').addClass('hidden');
                        $('body').removeClass('modal-open');
                        setTimeout(() => location.reload(), 1000);
                    },
                    error: function(xhr) {
                        let message = 'Something went wrong.';
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON?.errors;
                            if (errors) message = Object.values(errors).flat().join('<br>');
                        } else if (xhr.responseJSON?.message) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message);
                    },
                    complete: function() {
                        $btn.prop('disabled', false).html(originalText);
                    }
                });
            });
        </script>

        {{-- Delete Pet Scripts --}}
        <script>
            $(document).on('click', '.delete-pet-btn', function() {
                let petId = $(this).data('pet-id');
                let $card = $(this).closest('.flex-shrink-0'); // the whole pet card wrapper

                if (!confirm('Are you sure you want to delete this pet?')) {
                    return;
                }

                $.ajax({
                    url: `{{ route('pet.softDelete', ':id') }}`.replace(':id', petId),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT'
                    },
                    success: function(response) {
                        toastr.success('Pet deleted successfully');
                        $card.fadeOut(300, function() {
                            $(this).remove();
                        });
                    },
                    error: function(xhr) {
                        let message = 'Something went wrong.';
                        if (xhr.responseJSON?.message) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message);
                    }
                });
            });
        </script>


        {{-- profile image preview --}}
        <script>
            document.getElementById('profileImage').addEventListener('change', function(e) {
                let file = e.target.files[0];
                if (!file) return;

                let reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('profilePreview').src = event.target.result;
                };
                reader.readAsDataURL(file);
            });
        </script>

        {{-- profile update Script --}}
        <script>
            // Image preview (from before)
            $(document).on('change', '#profileImage', function() {
                let file = this.files[0];
                if (!file) return;

                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#profilePreview').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            });

            // Submit profile form
            $(document).on('submit', '#profileForm', function(e) {
                e.preventDefault();

                let $btn = $(this).find('button[type="submit"]');
                let originalText = $btn.html();

                // Client-side password check before sending
                let currentPass = $('#current_password').val();
                let newPass = $('#new_password').val();
                let confirmPass = $('#confirm_password').val();

                let anyPasswordFilled = currentPass || newPass || confirmPass;

                if (anyPasswordFilled) {
                    if (!currentPass || !newPass || !confirmPass) {
                        toastr.error('Please fill all three password fields to change your password.');
                        return;
                    }
                    if (newPass !== confirmPass) {
                        toastr.error('New password and confirmation do not match.');
                        return;
                    }
                }

                $btn.prop('disabled', true).html('Saving...');

                let formData = new FormData(this);

                // Don't send email/mobile at all — extra safety on top of readonly
                formData.delete('email');
                formData.delete('mobile');

                let fileInput = document.getElementById('profileImage');
                if (fileInput.files[0]) {
                    formData.append('profile_image', fileInput.files[0]);
                }

                $.ajax({
                    url: '{{ route('profile.update') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success(response.message || 'Profile updated successfully.');
                        $('#current_password').val('');
                        $('#new_password').val('');
                        $('#confirm_password').val('');
                    },
                    error: function(xhr) {
                        let message = 'Something went wrong.';
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON?.errors;
                            if (errors) {
                                message = Object.values(errors).flat().join('<br>');
                            }
                        } else if (xhr.responseJSON?.message) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message);
                    },
                    complete: function() {
                        $btn.prop('disabled', false).html(originalText);
                    }
                });
            });
        </script>



        <script>
            (function() {
                const tabs = document.querySelectorAll('.nav-tab[data-tab]');
                const contents = document.querySelectorAll('.tab-content');

                function activateTab(target, updateHistory = true) {
                    if (!target) {
                        target = 'dashboard';
                    }

                    tabs.forEach(tab => {
                        tab.classList.toggle('active', tab.getAttribute('data-tab') === target);
                    });

                    contents.forEach(content => {
                        const isActive = content.id === target;
                        content.classList.toggle('active', isActive);
                        content.style.display = isActive ? 'block' : 'none';
                    });

                    if (updateHistory) {
                        const url = new URL(window.location.href);
                        url.searchParams.set('tab', target);
                        window.history.replaceState({}, '', url.toString());
                    }
                }

                tabs.forEach(tab => {
                    tab.addEventListener('click', function() {
                        const target = this.getAttribute('data-tab');
                        activateTab(target, true);
                    });
                });

                window.addEventListener('popstate', function() {
                    const params = new URLSearchParams(window.location.search);
                    activateTab(params.get('tab') || 'dashboard', false);
                });

                const initialTab = new URLSearchParams(window.location.search).get('tab') || 'dashboard';
                activateTab(initialTab, false);

                document.querySelectorAll('.order-details-open-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const drawerId = this.getAttribute('data-drawer-id');
                        const drawer = document.getElementById(drawerId);
                        const backdrop = document.getElementById(drawerId + 'Backdrop');

                        if (drawer && backdrop) {
                            drawer.style.right = '0';
                            backdrop.style.display = 'block';
                        }
                    });
                });

                function closeOrderDrawer(drawerId) {
                    const drawer = document.getElementById(drawerId);
                    const backdrop = document.getElementById(drawerId + 'Backdrop');

                    if (drawer && backdrop) {
                        drawer.style.right = '-100%';
                        backdrop.style.display = 'none';
                    }
                }

                document.querySelectorAll('.order-drawer-close').forEach(button => {
                    button.addEventListener('click', function() {
                        const drawerId = this.closest('.order-drawer-panel').id;
                        closeOrderDrawer(drawerId);
                    });
                });

                document.querySelectorAll('.order-drawer-backdrop').forEach(backdrop => {
                    backdrop.addEventListener('click', function() {
                        const drawerId = this.id.replace('Backdrop', '');
                        closeOrderDrawer(drawerId);
                    });
                });
            })();
        </script>
    @endpush
@endsection
