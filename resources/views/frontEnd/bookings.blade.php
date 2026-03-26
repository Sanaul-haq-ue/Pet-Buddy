@extends('frontEnd.layouts.app')

@section('content')
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
            <aside class="dashboard-sidebar">
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
            </aside>
        </div>
    </main>
@endsection
