@extends('frontEnd.layouts.app')

@push('styles')
    <style>
        @media (max-width: 768px) {
            .cart-icon {
                bottom: 70px;
                right: 10px;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="home hero-section">
        <div class="hero-bg-glow top-right"></div>
        <div class="hero-bg-glow bottom-left"></div>

        <div class="hero-container">
            <div class="hero-content text-column">
                <span class="badge">ESTABLISHED 2024</span>
                <h1 class="hero-title">
                    A Luminous <br>
                    <span class="italic text-primary">Sanctuary</span> For <br>
                    Your Companions.
                </h1>
                <p class="hero-subtitle">
                    Elevating pet care through transparent professional services and nutrition tailored to the rhythmic soul
                    of your beloved animals.
                </p>
                <div class="hero-buttons">
                    <button class="btn-primary btn-large signature-glow sunlight-shadow">Explore Services</button>
                    <button class="btn-outline btn-large">View Nutrition</button>
                </div>
            </div>
            <div class="hero-image-column">
                <div class="hero-image-wrapper sunlight-shadow">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBurp5El2Avw_m0_a2mjYaThksrwdg50h7TJBQwazt4Aj8i4lv-I0HlurTz5m9asC6aYk7YhXK1tQUsJ4sdWpuPzj0A72nfuVK_zP-t2sbjlXfBRuxLJxg8uxB-Dln6lhnyzpr7dqSpCangZp31u1EPps7vzi983HHbTIvPvXYLLMNYuKgv6Yc3nz_r8O0nQTqCMaLRNKrWshJrRtBEjPhEPCWHqFsLOPKGswXIWTM-SRITyTcSNQ5WZFBbtrzsRn1PTWksrSP_wXdP"
                        alt="Happy golden retriever">
                    <h1 class="hero-title title-mb">
                        A Luminous <br>
                        <span class="italic text-primary">Sanctuary</span> For <br>
                        Your Companions.
                    </h1>
                </div>
                <div class="floating-testimonial glass-card sunlight-shadow">
                    <div class="testimonial-header">
                        <div class="icon-circle">
                            <span class="material-symbols-outlined">verified_user</span>
                        </div>
                        <div>
                            <p class="test-title">Certified Care</p>
                            <p class="test-subtitle">Vetted Professionals</p>
                        </div>
                    </div>
                    <p class="test-quote">"The best grooming experience Max has ever had. Truly radiant!"</p>
                </div>
                <div class="relative -mt-16 search-bar-wrapper">
                    <div
                        class="glass-card rounded-2xl p-1.5 flex items-center signature-glow border border-white/50 animate-fade-in stagger-1">
                        <div class="flex-1 flex items-center pl-4 pr-2">
                            <span class="material-symbols-outlined text-primary text-2xl">search</span>
                            <input
                                class="bg-transparent border-none focus:ring-0 text-body text-base py-3 w-full placeholder:text-outline font-medium"
                                placeholder="Find grooming, food or vets..." type="text" />
                        </div>
                        <button
                            class="btn-primary rounded-xl px-6 py-3 font-headline font-bold shadow-lg shadow-primary/20 hover:shadow-primary/40 active:scale-95 transition-all duration-200">
                            Search
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services-section section-padding bg-surface-container-low">
        <div class="container layout-grid">
            <div class="text-column">
                <span class="section-badge text-secondary">OUR SERVICES</span>
                <h2 class="section-title">Tailored Care For <br>Unique Personalities</h2>
                <p class="section-desc">
                    We don't believe in one-size-fits-all. Every pet at Radiant Habitat receives a personalized care plan
                    that respects their boundaries.
                </p>
                <ul class="feature-list">
                    <li>
                        <span class="material-symbols-outlined text-primary">check_circle</span>
                        <span>1-on-1 Personalized Attention</span>
                    </li>
                    <li>
                        <span class="material-symbols-outlined text-primary">check_circle</span>
                        <span>Certified Animal Ethologists</span>
                    </li>
                </ul>
                <div class="carousel-nav">
                    <button class="nav-btn swiper-prev-1"><span class="material-symbols-outlined">arrow_back</span></button>
                    <button class="nav-btn swiper-next-1"><span
                            class="material-symbols-outlined">arrow_forward</span></button>
                </div>
            </div>
            <div class="carousel-container swiper">
                <div class="service-mb">
                    <div class="">
                        <p class="service-topheader">SERVICES</p>
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="service-headline">Care &amp; Grooming</h3>
                            <button class="view-all-btn">View all</button>
                        </div>
                    </div>
                </div>
                <div class="swiper-wrapper">
                    @if($services->isNotEmpty())
                        @foreach($services->take(5) as $service)
                             <!-- Service Card -->
                            {{-- <div class="carousel-card swiper-slide glass-card ">
                                <div class="card-image bg-tinted">
                                    <img src="{{ $service->image }}" alt="{{ $service->name }}">
                                </div>
                                <div class="p-2">
                                    <div class="mb-2 d-flex gap-2 align-items-center">
                                        <span class="badge ">{{ $service->company->company_name }}</span>
                                        @foreach($service->species_list as $species)
                                            <span class="badge ">{{ $species->species_name }}</span>
                                        @endforeach
                                    </div>
                                    <h3 class="card-title text-primary">{{ $service->name }}</h3>
                                    <p class="card-location">{{ $service->union->name ?? 'N/A' }} , {{ $service->district->name ?? 'N/A' }}</p>
                                    <div class="product-actions">
                                        @if($service->_price)
                                            <p class="price text-secondary"><del>${{ number_format($service->base_price, 2) }}</del> ${{ number_format($service->offer_price, 2) }}/{{ $service->timing == 'Hourly' ? 'h' : 'd' }}</p>
                                            @php
                                                $discount = (($service->base_price - $service->offer_price) / $service->base_price) * 100;
                                                $discountPercent = round($discount);
                                            @endphp
                                            <span class="badge badge-danger sale-per">{{ $discountPercent }}% Off</span>
                                        @else
                                            <p class="price text-secondary">${{ number_format($service->base_price, 2) }}/{{ $service->timing == 'Hourly' ? 'h' : 'day' }} </p>
                                        @endif
                                        <button 
                                            class="add-to-cart service primary open-booking-modal"
                                            data-service-name="{{ $service->service_name }}"
                                            data-service-price="{{ $service->offer_price ?? $service->base_price }}"
                                            data-service-timing="{{ $service->timing == 'Hourly' ? '/h' : '/d' }}"
                                            data-service-image="{{ $service->cover_image }}"
                                            data-service-location="{{ $service->union->name ?? 'N/A' }}, {{ $service->district->name ?? 'N/A' }}"
                                            data-service-id="{{ $service->id }}"
                                            >
                                            <span class="material-symbols-outlined">
                                                <i class="fa-solid fa-plus"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div> --}}
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Nutrition Section -->
    <section class="nutrition-section section-padding bg-surface">
        <div class="container layout-grid">
            <div class="carousel-container swiper">
                <div class="service-mb">
                    <div class="">
                        <p class="service-topheader">NUTRITION</p>
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="service-headline">Pet Foods</h3>
                            <button class="view-all-btn">Shop</button>
                        </div>
                    </div>
                </div>
                <div class="swiper-wrapper">
                    <!-- Product 1 -->
                    <div class="carousel-card swiper-slide product-card glass-card">
                        <div class="card-image-bg">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwKQj3qAo0lUOzMMhNeMb7pjcLf_pfpvIc0mTkfjJzV2G8DQ1SiIHvJnNLCtNlmc9sOAk0jBqycB6WyuTwiZJQZs9te2fRiU2gchSGK0vnO-Hrt5ojwoIc9GpC92G72MPkjHphIbzaG7MYpVcODuVqzZjwOt5qsqvVuVV4d0ElJHsmCeDkN0tsrNfzZB2SaOhcg5AdLVIrRy4jza3_ZFvEFGs-oGXG7kmKEZ82dIvpt7c8RVakaGD_NJw-RJI2VurQWSWboVmx3HQx"
                                alt="Dog Food" class="product-img">
                        </div>
                        <div class="p-2">
                            <h3 class="card-title text-primary">Wild Harvest Blend</h3>
                            <div class="product-actions">
                                <p class="price text-secondary">$45.00</p>
                                <button class="add-to-cart primary"><span
                                        class="material-symbols-outlined">add_shopping_cart</span></button>
                            </div>
                        </div>
                    </div>
                    <!-- Product 2 -->
                    <div class="carousel-card swiper-slide product-card glass-card">
                        <div class="card-image-bg">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjUxVStxXIY-vNfw8QpVuge0MQ_8uP8wVYEdCZq1Xkd7JgG-574sixuZfyqxtp5z-gIP0y7s01OTMsAz_M7IqQGaf-r0AWsEFG6KT7SCC55Su2Xeazb0tdFxwunz41593eJ6cYer4lL0xYIrUpHkMkm9kyepehgvzdjvjwB3rT7M1Z1viUN6349vtP9JCf36_5tDfbTd95MfX32UiIAsK5yo9a_AlDBpAQfTY4vGF4RslmmUjQAv18Ia3FANTkW9nop-nKeRfoRs0r"
                                alt="Cat Food" class="product-img">
                        </div>
                        <div class="p-2">
                            <h3 class="card-title text-primary">Wild Harvest Blend</h3>
                            <div class="product-actions">
                                <p class="price text-secondary">$45.00</p>
                                <button class="add-to-cart primary"><span
                                        class="material-symbols-outlined">add_shopping_cart</span></button>
                            </div>
                        </div>
                    </div>
                    <!-- Product 3 -->
                    <div class="carousel-card swiper-slide product-card glass-card">
                        <div class="card-image-bg">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_gUryut3eYaHmmVZgpk17CM7Ml90nr39W8FGbNxE9vZyU-uctNSZG6BGqO80roUeoWdKZ-q-Xpmvbl1fgLveWnXEccaiSoW3IUTn9QPZDZ4AjftkPTeqTWhm5IbRkzElp_rPxkU_k8DREDypwxMGZKg78oPiTljUHh95N2r5HQnLb4kpn752N3lQ8Iy1Mz9FGk6LQ3dd8vJEarGrTCiVgHVYou-crk4zj_cDTDhybH0XSb-bXHKYi0vsb_ka7wK1bbjiDkOjZKegU"
                                alt="Treats" class="product-img">
                        </div>
                        <div class="p-2">
                            <h3 class="card-title text-primary">Wild Harvest Blend</h3>
                            <div class="product-actions">
                                <p class="price text-secondary">$45.00</p>
                                <button class="add-to-cart primary"><span
                                        class="material-symbols-outlined">add_shopping_cart</span></button>
                            </div>
                        </div>
                    </div>
                    <!-- Product 4 -->
                    <div class="carousel-card swiper-slide product-card glass-card">
                        <div class="card-image-bg">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwKQj3qAo0lUOzMMhNeMb7pjcLf_pfpvIc0mTkfjJzV2G8DQ1SiIHvJnNLCtNlmc9sOAk0jBqycB6WyuTwiZJQZs9te2fRiU2gchSGK0vnO-Hrt5ojwoIc9GpC92G72MPkjHphIbzaG7MYpVcODuVqzZjwOt5qsqvVuVV4d0ElJHsmCeDkN0tsrNfzZB2SaOhcg5AdLVIrRy4jza3_ZFvEFGs-oGXG7kmKEZ82dIvpt7c8RVakaGD_NJw-RJI2VurQWSWboVmx3HQx"
                                alt="Dog Food 2" class="product-img">
                        </div>
                        <div class="p-2">
                            <h3 class="card-title text-primary">Wild Harvest Blend</h3>
                            <div class="product-actions">
                                <p class="price text-secondary">$45.00</p>
                                <button class="add-to-cart primary"><span
                                        class="material-symbols-outlined">add_shopping_cart</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-column">
                <span class="section-badge text-primary">NUTRITION FIRST</span>
                <h2 class="section-title">Glow From The Inside Out</h2>
                <p class="section-desc">
                    Curated by leading animal nutritionists. We prioritize human-grade ingredients and transparent sourcing
                    for your pet's vitality.
                </p>
                <ul class="feature-list">
                    <li>
                        <span class="material-symbols-outlined text-secondary">eco</span>
                        <span>100% Organic Ingredients</span>
                    </li>
                    <li>
                        <span class="material-symbols-outlined text-secondary">health_and_safety</span>
                        <span>Vet-Approved Recipes</span>
                    </li>
                </ul>
                <div class="action-buttons pt-4">
                    <button class="btn-primary btn-large signature-glow sunlight-shadow">Shop All Products</button>
                    <div class="carousel-nav mt-4">
                        <button class="nav-btn swiper-prev-2"><span
                                class="material-symbols-outlined">arrow_back</span></button>
                        <button class="nav-btn swiper-next-2"><span
                                class="material-symbols-outlined">arrow_forward</span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    {{-- <section class="testimonials-section section-padding bg-surface-container">
        <div class="container">
            <div class="center-header">
                <span class="section-badge text-secondary">COMMUNITY STORIES</span>
                <h2 class="section-title">Loved By Pets, Trusted By Humans</h2>
            </div>
            <div class="testimonials-grid">
                <!-- Testimonial 1 -->
                <div class="testimonial-card glass-card sunlight-shadow">
                    <span class="quote-icon material-symbols-outlined">format_quote</span>
                    <div class="testimonial-author">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBG5hSBWi9h5M-tiDQLJKIJnY4TMrIkcAuMuC1ALaNoXTQLeiqgG4b-c5z9iJREO5CJuBbdI5yEDJ3X6RPkLAoX_d0PrMN_g_DL8Um3J88PJ7_sDmcOFN4p8znFtcIhqQZfo4SdEtPLH2hQYOJmGAfFe4tsxeDL4fHClqIAWwJvKOKdUlNDoQHU5JtAVHNfJwEanA5ivkz7TB2yrevinmv6nc6Ka_Hx7VePCZn5z0EZ_nr4aY6z-Y_JglO8Tkv0a75Nm9iupM43DllZ" alt="Sarah">
                        <div class="author-details">
                            <h4>Sarah Jenkins</h4>
                            <p>Owner of Luna</p>
                        </div>
                    </div>
                    <p class="testimonial-text">"Finding a place that understands a Husky's energy level was hard. Radiant Habitat engages her soul."</p>
                </div>
                <!-- Testimonial 2 -->
                <div class="testimonial-card glass-card sunlight-shadow bg-tinted">
                    <span class="quote-icon material-symbols-outlined">format_quote</span>
                    <div class="testimonial-author">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuA7sgze3M028IkWsFPrQe3n8h9RMNF4WTVVHDp2Z6ESBYkVq_O_t5xMo2-MYK1RV3Y29b9esESBRw-7Z6dSxwqB46UVe8noftdpyEBsHPs5Zr_4y3qLXXoCEjLlSF6yJ6y4T8PmYxnURdQEAn5ojOMMw4yWotnaNH3z-5-UI51TJo9x-Obbf9zA6d_BPE5jYJVN1PAo3uUaAHdXftD8L1UOXhqfTRE8d4v6UKkkLS5a0uFZnPOf0QOkZ1QVX0G4-t_YDN7Z2Ads7Gh1" alt="Mark">
                        <div class="author-details">
                            <h4>Mark Thompson</h4>
                            <p>Owner of Oliver</p>
                        </div>
                    </div>
                    <p class="testimonial-text">"The nutrition consultation changed Oliver's life. His coat is shinier than ever, and energy levels stabilized."</p>
                </div>
                <!-- Testimonial 3 -->
                <div class="testimonial-card glass-card sunlight-shadow">
                    <span class="quote-icon material-symbols-outlined">format_quote</span>
                    <div class="testimonial-author">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAjyZIZpoR6-6wqAbJyR4Gf1QYhP6_DjTiYDzO-k_YSFnPZOy_-3HRM9NWxDpihS0wUAWtaDa-O_zEUy5-unPCiEe7jRm4uNn17VoKic4qzR-A4XR47njhh-wCYuxjVSg23R7FQdJajdH8LGMVaIC3B6oJx_5S0jewJJjmWtOaKkVFmyGflik_9mwZglXnW5IL1oRyu-SYHtFJD94jN59rAkUJlb4Qqf6ht7dlDor8vZEQGuoi8efO0QFf4MteRa_jrKq2z3q0iHt97" alt="Elena">
                        <div class="author-details">
                            <h4>Elena Rodriguez</h4>
                            <p>Owner of Bella</p>
                        </div>
                    </div>
                    <p class="testimonial-text">"Transparent, professional, and incredibly kind. It's the only place I trust with Bella."</p>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="testimonials-section section-padding bg-surface-container pb-0">
        <div class="container">

            <div class="center-header">
                <span class="section-badge text-secondary">COMMUNITY STORIES</span>
                <h2 class="section-title">Loved By Pets, Trusted By Humans</h2>
            </div>

            <div class="position-relative">

                <!-- Navigation Buttons -->
                <button class="btn btn-primary swiper-btn-prev position-absolute top-50 start-0 translate-middle-y z-3">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <button class="btn btn-primary swiper-btn-next position-absolute top-50 end-0 translate-middle-y z-3">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>

                <!-- Swiper -->
                <div class="swiper testimonialSwiper">
                    <div class="swiper-wrapper">

                        <!-- Slide 1 -->
                        <div class="swiper-slide">
                            <div class="testimonial-card glass-card">
                                <span class="quote-icon material-symbols-outlined">format_quote</span>
                                <div class="testimonial-author">
                                    <img
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBG5hSBWi9h5M-tiDQLJKIJnY4TMrIkcAuMuC1ALaNoXTQLeiqgG4b-c5z9iJREO5CJuBbdI5yEDJ3X6RPkLAoX_d0PrMN_g_DL8Um3J88PJ7_sDmcOFN4p8znFtcIhqQZfo4SdEtPLH2hQYOJmGAfFe4tsxeDL4fHClqIAWwJvKOKdUlNDoQHU5JtAVHNfJwEanA5ivkz7TB2yrevinmv6nc6Ka_Hx7VePCZn5z0EZ_nr4aY6z-Y_JglO8Tkv0a75Nm9iupM43DllZ">
                                    <div class="author-details">
                                        <h4>Sarah Jenkins</h4>
                                        <p>Owner of Luna</p>
                                    </div>
                                </div>
                                <p class="testimonial-text">"Finding a place that understands a Husky's energy level was
                                    hard."</p>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="swiper-slide">
                            <div class="testimonial-card glass-card bg-tinted">
                                <span class="quote-icon material-symbols-outlined">format_quote</span>
                                <div class="testimonial-author">
                                    <img
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuA7sgze3M028IkWsFPrQe3n8h9RMNF4WTVVHDp2Z6ESBYkVq_O_t5xMo2-MYK1RV3Y29b9esESBRw-7Z6dSxwqB46UVe8noftdpyEBsHPs5Zr_4y3qLXXoCEjLlSF6yJ6y4T8PmYxnURdQEAn5ojOMMw4yWotnaNH3z-5-UI51TJo9x-Obbf9zA6d_BPE5jYJVN1PAo3uUaAHdXftD8L1UOXhqfTRE8d4v6UKkkLS5a0uFZnPOf0QOkZ1QVX0G4-t_YDN7Z2Ads7Gh1">
                                    <div class="author-details">
                                        <h4>Mark Thompson</h4>
                                        <p>Owner of Oliver</p>
                                    </div>
                                </div>
                                <p class="testimonial-text">"The nutrition consultation changed Oliver's life."</p>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="swiper-slide">
                            <div class="testimonial-card glass-card">
                                <span class="quote-icon material-symbols-outlined">format_quote</span>
                                <div class="testimonial-author">
                                    <img
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAjyZIZpoR6-6wqAbJyR4Gf1QYhP6_DjTiYDzO-k_YSFnPZOy_-3HRM9NWxDpihS0wUAWtaDa-O_zEUy5-unPCiEe7jRm4uNn17VoKic4qzR-A4XR47njhh-wCYuxjVSg23R7FQdJajdH8LGMVaIC3B6oJx_5S0jewJJjmWtOaKkVFmyGflik_9mwZglXnW5IL1oRyu-SYHtFJD94jN59rAkUJlb4Qqf6ht7dlDor8vZEQGuoi8efO0QFf4MteRa_jrKq2z3q0iHt97">
                                    <div class="author-details">
                                        <h4>Elena Rodriguez</h4>
                                        <p>Owner of Bella</p>
                                    </div>
                                </div>
                                <p class="testimonial-text">"Transparent, professional, and incredibly kind."</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="testimonials-section bg-surface-container community-invite-div">
        <div class="container ">
            <div class="community-invite">
                <div class="relative community-content">
                    <h3 class="community-title">Join the
                        Habitat</h3>
                    <p class="community-text">Connect with 5,000+ pet
                        parents in your neighborhood. Share tips, playdates, and more.</p>
                    <button
                        class="community-btn btn-primary">
                        Join Community
                    </button>
                </div>
                <!-- Asymmetric Floating Image -->
                <div class="community-image-wrapper">
                    <img alt="Community Dogs"
                        class="community-image"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBuhJhfGc6HgG-DHlcCV7R-pOoeo3lHjXQSJeHfJeuvq6jYwU8ru3h61YaHhywSen5b2pu3Qsv4EsYiz3MECm0BjabqJU0J9rNxktq4_NnUVkLLTqF1slanDQkAyqiEp88FQutRwJTdfCyK6RtM9t05HEmDqau9kJorWfyzpAz7ZyE2gBb9m8hnV2sNsFiZLJkdDtm6KRjIjtodLH5uLgnulfD5bBNQy0PB7OkTywvoL0qtYnlhGsXgmBkHHReFrkt-n8WmOgMHm_ZU" />
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                // SECTION 1
                new Swiper(".services-section .swiper", {
                    loop: true,

                    slidesPerView: 2.1, // 👈 2 slides + little of next
                    centeredSlides: false,

                    navigation: {
                        nextEl: ".swiper-next-1",
                        prevEl: ".swiper-prev-1",
                    },

                    // autoplay: {
                    //     delay: 5000,
                    //     disableOnInteraction: false,
                    // },

                    autoplay: false,

                    breakpoints: {
                        0: {
                            slidesPerView: 1.2,
                            spaceBetween: 15,
                        },
                        768: {
                            slidesPerView: 2.1,
                            spaceBetween: 24,
                        }
                    }
                });

                // SECTION 2
                new Swiper(".nutrition-section .swiper", {
                    loop: true,
                    slidesPerView: 2.1,

                    navigation: {
                        nextEl: ".swiper-next-2",
                        prevEl: ".swiper-prev-2",
                    },

                    // autoplay: {
                    //     delay: 5000,
                    //     disableOnInteraction: false,
                    // },
                    autoplay: false,

                    breakpoints: {
                        0: {
                            slidesPerView: 1.2,
                            spaceBetween: 15,
                        },
                        768: {
                            slidesPerView: 2.1,
                            spaceBetween: 24,
                        }
                    }
                });

            });
        </script>

        <script>
            var swiper = new Swiper(".testimonialSwiper", {
                slidesPerView: 3,
                spaceBetween: 20,
                loop: true,
                grabCursor: true,

                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },

                navigation: {
                    nextEl: ".swiper-btn-next",
                    prevEl: ".swiper-btn-prev",
                },

                breakpoints: {
                    0: {
                        slidesPerView: 1
                    },
                    768: {
                        slidesPerView: 3
                    }
                }
            });
        </script>
        
    @endpush
@endsection
