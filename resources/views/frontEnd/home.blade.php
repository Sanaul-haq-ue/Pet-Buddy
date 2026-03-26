@extends('frontEnd.layouts.app')

@section('content')
<!-- Hero Section -->
    <section class="hero-section">
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
                    Elevating pet care through transparent professional services and nutrition tailored to the rhythmic soul of your beloved animals.
                </p>
                <div class="hero-buttons">
                    <button class="btn-primary btn-large signature-glow sunlight-shadow">Explore Services</button>
                    <button class="btn-outline btn-large">View Nutrition</button>
                </div>
            </div>
            <div class="hero-image-column">
                <div class="hero-image-wrapper sunlight-shadow">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBurp5El2Avw_m0_a2mjYaThksrwdg50h7TJBQwazt4Aj8i4lv-I0HlurTz5m9asC6aYk7YhXK1tQUsJ4sdWpuPzj0A72nfuVK_zP-t2sbjlXfBRuxLJxg8uxB-Dln6lhnyzpr7dqSpCangZp31u1EPps7vzi983HHbTIvPvXYLLMNYuKgv6Yc3nz_r8O0nQTqCMaLRNKrWshJrRtBEjPhEPCWHqFsLOPKGswXIWTM-SRITyTcSNQ5WZFBbtrzsRn1PTWksrSP_wXdP" alt="Happy golden retriever">
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
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section section-padding bg-surface-container-low">
        <div class="container layout-grid">
            <div class="text-column">
                <span class="section-badge text-secondary">OUR SERVICES</span>
                <h2 class="section-title">Tailored Care For <br>Unique Personalities</h2>
                <p class="section-desc">
                    We don't believe in one-size-fits-all. Every pet at Radiant Habitat receives a personalized care plan that respects their boundaries.
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
                    <button class="nav-btn"><span class="material-symbols-outlined">arrow_back</span></button>
                    <button class="nav-btn"><span class="material-symbols-outlined">arrow_forward</span></button>
                </div>
            </div>
            <div class="carousel-container">
                <div class="carousel-track">
                    <!-- Service 1 -->
                    <div class="carousel-card glass-card sunlight-shadow">
                        <div class="card-image">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAn3ZfnJkt-50wYcLntoQYrdWX68D_EbQa0bCMgWbqnnTGHwEz-YOWd6Jnbgg4Vq823BMmRxn5WmjqQdgOCI_xRhPwF8TudN99rKFbSa_bkKcE-ViNHOWhFrviO8pS0op12NBg4o9skDQ5gXJ-Qb5fqLXpMNxTpgSMuQQir6sXpiO4-oQU--cRhN0S2-vabKaCrtoakyBdu5QTBCfypS6Yh9MqM4hwsuMKfbZPJ0jw24ftSTpJpJsC6Cq8WIGa43SlFid7xlREJ4o7T" alt="Grooming">
                        </div>
                        <h3 class="card-title text-primary">Artisan Grooming</h3>
                        <p class="card-desc">Full-service spa treatments designed for aesthetic excellence.</p>
                    </div>
                    <!-- Service 2 -->
                    <div class="carousel-card glass-card sunlight-shadow">
                        <div class="card-image">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDI8VKIF5Dv0mrUTcSY0uGvR78w854ZExEJjdfeH-nHeXwfVV4_74gccUbWFuTwAnatTChMqT9rRoF2LUtByCGyGhdTWSZuZjPwARvWovmo-loPN5sfMRZihhwjXEi6qLEMHcV6oLDhFx4TNJ78HoNeXDExnXC2RfEaR3DoWn8D9I4z8YIqzpV_U-73-HnxJ73SmjRmIXZnGAHxjzwVIWAlY38YdSu8hRUUATo7nSKRBns169e8AXA9N_598SiYRt99Q6Mmuzo6lMgm" alt="Daycare">
                        </div>
                        <h3 class="card-title text-secondary">Social Daycare</h3>
                        <p class="card-desc">Supervised play and enrichment in a temperature-controlled environment.</p>
                    </div>
                    <!-- Service 3 -->
                    <div class="carousel-card glass-card sunlight-shadow">
                        <div class="card-image">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBRHSMqtmp-tkEqR7puXMsj_NFlbFwkdS5-oxTJuT6ul_tJuoXtr8APQdfe-VT8llK478HoGUvwz_DPMZqFJe0psVUW0rq61SIegchF1l9tkAXv0SHK84gB5E7JVS5jKFLgHYys6z8tNE-ykGiWnnaTMNJPe8bp5oSeFlksGUf9cDzC45v9HTqWbLZx0UnQaIKeh8Vm9JzDJu_Mvsst1YZ310VhqPKIuy6tLR1cbX-AA0UP__mUglDYx23L_uxi572-X4qhjChv4w4X" alt="Wellness">
                        </div>
                        <h3 class="card-title text-primary">Wellness Clinic</h3>
                        <p class="card-desc">Comprehensive health checkups and preventative care for all ages.</p>
                    </div>
                    <!-- Service 4 -->
                    <div class="carousel-card glass-card sunlight-shadow">
                        <div class="card-image">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAn3ZfnJkt-50wYcLntoQYrdWX68D_EbQa0bCMgWbqnnTGHwEz-YOWd6Jnbgg4Vq823BMmRxn5WmjqQdgOCI_xRhPwF8TudN99rKFbSa_bkKcE-ViNHOWhFrviO8pS0op12NBg4o9skDQ5gXJ-Qb5fqLXpMNxTpgSMuQQir6sXpiO4-oQU--cRhN0S2-vabKaCrtoakyBdu5QTBCfypS6Yh9MqM4hwsuMKfbZPJ0jw24ftSTpJpJsC6Cq8WIGa43SlFid7xlREJ4o7T" alt="Training">
                        </div>
                        <h3 class="card-title text-secondary">Behavioral Training</h3>
                        <p class="card-desc">Positive reinforcement methods that build confidence and connection.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nutrition Section -->
    <section class="nutrition-section section-padding bg-surface">
        <div class="container layout-grid reverse-mobile">
            <div class="carousel-container">
                <div class="carousel-track">
                    <!-- Product 1 -->
                    <div class="carousel-card product-card glass-card sunlight-shadow">
                        <div class="card-image-bg">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwKQj3qAo0lUOzMMhNeMb7pjcLf_pfpvIc0mTkfjJzV2G8DQ1SiIHvJnNLCtNlmc9sOAk0jBqycB6WyuTwiZJQZs9te2fRiU2gchSGK0vnO-Hrt5ojwoIc9GpC92G72MPkjHphIbzaG7MYpVcODuVqzZjwOt5qsqvVuVV4d0ElJHsmCeDkN0tsrNfzZB2SaOhcg5AdLVIrRy4jza3_ZFvEFGs-oGXG7kmKEZ82dIvpt7c8RVakaGD_NJw-RJI2VurQWSWboVmx3HQx" alt="Dog Food" class="product-img">
                        </div>
                        <h3 class="card-title text-primary">Wild Harvest Blend</h3>
                        <div class="product-actions">
                            <p class="price text-secondary">$45.00</p>
                            <button class="add-to-cart primary"><span class="material-symbols-outlined">add_shopping_cart</span></button>
                        </div>
                    </div>
                    <!-- Product 2 -->
                    <div class="carousel-card product-card glass-card sunlight-shadow">
                        <div class="card-image-bg">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjUxVStxXIY-vNfw8QpVuge0MQ_8uP8wVYEdCZq1Xkd7JgG-574sixuZfyqxtp5z-gIP0y7s01OTMsAz_M7IqQGaf-r0AWsEFG6KT7SCC55Su2Xeazb0tdFxwunz41593eJ6cYer4lL0xYIrUpHkMkm9kyepehgvzdjvjwB3rT7M1Z1viUN6349vtP9JCf36_5tDfbTd95MfX32UiIAsK5yo9a_AlDBpAQfTY4vGF4RslmmUjQAv18Ia3FANTkW9nop-nKeRfoRs0r" alt="Cat Food" class="product-img">
                        </div>
                        <h3 class="card-title text-secondary">Pure Atlantic Vitality</h3>
                        <div class="product-actions">
                            <p class="price text-secondary">$38.00</p>
                            <button class="add-to-cart secondary"><span class="material-symbols-outlined">add_shopping_cart</span></button>
                        </div>
                    </div>
                    <!-- Product 3 -->
                    <div class="carousel-card product-card glass-card sunlight-shadow">
                        <div class="card-image-bg">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_gUryut3eYaHmmVZgpk17CM7Ml90nr39W8FGbNxE9vZyU-uctNSZG6BGqO80roUeoWdKZ-q-Xpmvbl1fgLveWnXEccaiSoW3IUTn9QPZDZ4AjftkPTeqTWhm5IbRkzElp_rPxkU_k8DREDypwxMGZKg78oPiTljUHh95N2r5HQnLb4kpn752N3lQ8Iy1Mz9FGk6LQ3dd8vJEarGrTCiVgHVYou-crk4zj_cDTDhybH0XSb-bXHKYi0vsb_ka7wK1bbjiDkOjZKegU" alt="Treats" class="product-img">
                        </div>
                        <h3 class="card-title text-primary">Artisan Treat Trio</h3>
                        <div class="product-actions">
                            <p class="price text-secondary">$22.00</p>
                            <button class="add-to-cart primary"><span class="material-symbols-outlined">add_shopping_cart</span></button>
                        </div>
                    </div>
                    <!-- Product 4 -->
                    <div class="carousel-card product-card glass-card sunlight-shadow">
                        <div class="card-image-bg">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwKQj3qAo0lUOzMMhNeMb7pjcLf_pfpvIc0mTkfjJzV2G8DQ1SiIHvJnNLCtNlmc9sOAk0jBqycB6WyuTwiZJQZs9te2fRiU2gchSGK0vnO-Hrt5ojwoIc9GpC92G72MPkjHphIbzaG7MYpVcODuVqzZjwOt5qsqvVuVV4d0ElJHsmCeDkN0tsrNfzZB2SaOhcg5AdLVIrRy4jza3_ZFvEFGs-oGXG7kmKEZ82dIvpt7c8RVakaGD_NJw-RJI2VurQWSWboVmx3HQx" alt="Dog Food 2" class="product-img">
                        </div>
                        <h3 class="card-title text-secondary">Oceanic Fish Flakes</h3>
                        <div class="product-actions">
                            <p class="price text-secondary">$28.00</p>
                            <button class="add-to-cart secondary"><span class="material-symbols-outlined">add_shopping_cart</span></button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-column">
                <span class="section-badge text-primary">NUTRITION FIRST</span>
                <h2 class="section-title">Glow From The Inside Out</h2>
                <p class="section-desc">
                    Curated by leading animal nutritionists. We prioritize human-grade ingredients and transparent sourcing for your pet's vitality.
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
                        <button class="nav-btn"><span class="material-symbols-outlined">arrow_back</span></button>
                        <button class="nav-btn"><span class="material-symbols-outlined">arrow_forward</span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section section-padding bg-surface-container">
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
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sections = document.querySelectorAll('section');
            
            sections.forEach(section => {
                const track = section.querySelector('.carousel-track');
                const nav = section.querySelector('.carousel-nav');
                
                if (track && nav && track.querySelector('.carousel-card')) {
                    const originalItems = Array.from(track.querySelectorAll('.carousel-card'));
                    if (!originalItems.length) return;

                    // Clone items twice to create 3 identical sets for seamless infinite scrolling
                    // Set 1 (clones) | Set 2 (originals) | Set 3 (clones)
                    originalItems.forEach(item => track.appendChild(item.cloneNode(true)));
                    originalItems.forEach(item => track.appendChild(item.cloneNode(true)));

                    const prevBtn = nav.querySelectorAll('.nav-btn')[0];
                    const nextBtn = nav.querySelectorAll('.nav-btn')[1];

                    // Give the browser a moment to render the clones and calculate widths
                    setTimeout(() => {
                        const firstCard = originalItems[0];
                        const gap = parseFloat(window.getComputedStyle(track).gap) || 24; 
                        const scrollAmount = firstCard.offsetWidth + gap;
                        const period = originalItems.length * scrollAmount;

                        // Start position right in the middle set (Set 2)
                        track.scrollLeft = period;

                        const slideNext = () => {
                            // If we've scrolled past the middle buffer, jump back by one full period
                            if (track.scrollLeft >= period * 1.5) {
                                track.scrollLeft -= period;
                            }
                            
                            // Immediately smooth scroll to the next slide
                            setTimeout(() => {
                                track.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                            }, 10);
                        };

                        const slidePrev = () => {
                            // If we've scrolled backward into the first buffer, jump forward by one full period
                            if (track.scrollLeft <= period * 0.5) {
                                track.scrollLeft += period;
                            }
                            
                            setTimeout(() => {
                                track.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                            }, 10);
                        };

                        // Auto scroll interval
                        let autoScroll = setInterval(slideNext, 5000);

                        // Attach click handlers
                        if (prevBtn) {
                            prevBtn.addEventListener('click', () => {
                                slidePrev();
                                clearInterval(autoScroll);
                                autoScroll = setInterval(slideNext, 5000);
                            });
                        }

                        if (nextBtn) {
                            nextBtn.addEventListener('click', () => {
                                slideNext();
                                clearInterval(autoScroll);
                                autoScroll = setInterval(slideNext, 5000);
                            });
                        }
                        
                        // Pause auto-sliding when holding mouse over the carousel
                        track.addEventListener('mouseenter', () => clearInterval(autoScroll));
                        track.addEventListener('mouseleave', () => {
                            autoScroll = setInterval(slideNext, 5000);
                        });
                    }, 100);
                }
            });
        });
    </script>
    @endpush
@endsection

