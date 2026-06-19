@extends('frontEnd.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/singlepage.css') }}">
@endpush

@section('content')
    <main class="single-product-main container">
        <!-- Breadcrumb Navigation -->
        {{-- <nav class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="breadcrumb-separator">/</span>
            <a href="{{ route('shop') }}">Shop</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">{{ $product->product_name }}</span>
        </nav> --}}

        <!-- Product Details Columns -->
        <div class="product-detail-layout">
            <!-- Left Column: Gallery -->
            <div class="gallery-container">
                <div class="main-image-wrapper">
                    {{-- <span class="bestseller-badge">Best Seller</span> --}}
                    <img id="main-product-image" src="{{ asset($product->image) }}" alt="{{ $product->product_name }}"
                        class="product-main-img">
                </div>
                {{-- <div class="thumbnails-strip">
                    <div class="thumbnail-item active" onclick="changeImage(this, '{{ asset($product->image) }}')">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->product_name }}">
                    </div>
                    <div class="thumbnail-item" onclick="changeImage(this, 'https://lh3.googleusercontent.com/aida-public/AB6AXuCwKQj3qAo0lUOzMMhNeMb7pjcLf_pfpvIc0mTkfjJzV2G8DQ1SiIHvJnNLCtNlmc9sOAk0jBqycB6WyuTwiZJQZs9te2fRiU2gchSGK0vnO-Hrt5ojwoIc9GpC92G72MPkjHphIbzaG7MYpVcODuVqzZjwOt5qsqvVuVV4d0ElJHsmCeDkN0tsrNfzZB2SaOhcg5AdLVIrRy4jza3_ZFvEFGs-oGXG7kmKEZ82dIvpt7c8RVakaGD_NJw-RJI2VurQWSWboVmx3HQx')">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwKQj3qAo0lUOzMMhNeMb7pjcLf_pfpvIc0mTkfjJzV2G8DQ1SiIHvJnNLCtNlmc9sOAk0jBqycB6WyuTwiZJQZs9te2fRiU2gchSGK0vnO-Hrt5ojwoIc9GpC92G72MPkjHphIbzaG7MYpVcODuVqzZjwOt5qsqvVuVV4d0ElJHsmCeDkN0tsrNfzZB2SaOhcg5AdLVIrRy4jza3_ZFvEFGs-oGXG7kmKEZ82dIvpt7c8RVakaGD_NJw-RJI2VurQWSWboVmx3HQx" alt="Pouring kibble">
                    </div>
                    <div class="thumbnail-item" onclick="changeImage(this, 'https://lh3.googleusercontent.com/aida-public/AB6AXuBurp5El2Avw_m0_a2mjYaThksrwdg50h7TJBQwazt4Aj8i4lv-I0HlurTz5m9asC6aYk7YhXK1tQUsJ4sdWpuPzj0A72nfuVK_zP-t2sbjlXfBRuxLJxg8uxB-Dln6lhnyzpr7dqSpCangZp31u1EPps7vzi983HHbTIvPvXYLLMNYuKgv6Yc3nz_r8O0nQTqCMaLRNKrWshJrRtBEjPhEPCWHqFsLOPKGswXIWTM-SRITyTcSNQ5WZFBbtrzsRn1PTWksrSP_wXdP')">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBurp5El2Avw_m0_a2mjYaThksrwdg50h7TJBQwazt4Aj8i4lv-I0HlurTz5m9asC6aYk7YhXK1tQUsJ4sdWpuPzj0A72nfuVK_zP-t2sbjlXfBRuxLJxg8uxB-Dln6lhnyzpr7dqSpCangZp31u1EPps7vzi983HHbTIvPvXYLLMNYuKgv6Yc3nz_r8O0nQTqCMaLRNKrWshJrRtBEjPhEPCWHqFsLOPKGswXIWTM-SRITyTcSNQ5WZFBbtrzsRn1PTWksrSP_wXdP" alt="Golden retriever dog">
                    </div>
                    <div class="thumbnail-item" onclick="changeImage(this, 'https://lh3.googleusercontent.com/aida-public/AB6AXuD_gUryut3eYaHmmVZgpk17CM7Ml90nr39W8FGbNxE9vZyU-uctNSZG6BGqO80roUeoWdKZ-q-Xpmvbl1fgLveWnXEccaiSoW3IUTn9QPZDZ4AjftkPTeqTWhm5IbRkzElp_rPxkU_k8DREDypwxMGZKg78oPiTljUHh95N2r5HQnLb4kpn752N3lQ8Iy1Mz9FGk6LQ3dd8vJEarGrTCiVgHVYou-crk4zj_cDTDhybH0XSb-bXHKYi0vsb_ka7wK1bbjiDkOjZKegU')">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_gUryut3eYaHmmVZgpk17CM7Ml90nr39W8FGbNxE9vZyU-uctNSZG6BGqO80roUeoWdKZ-q-Xpmvbl1fgLveWnXEccaiSoW3IUTn9QPZDZ4AjftkPTeqTWhm5IbRkzElp_rPxkU_k8DREDypwxMGZKg78oPiTljUHh95N2r5HQnLb4kpn752N3lQ8Iy1Mz9FGk6LQ3dd8vJEarGrTCiVgHVYou-crk4zj_cDTDhybH0XSb-bXHKYi0vsb_ka7wK1bbjiDkOjZKegU" alt="Ingredients flatlay">
                    </div>
                </div> --}}
            </div>

            <!-- Right Column: Product details -->
            <div class="product-info-panel">
                <span class="brand-label">{{ $product->brand->productBrand_name ?? 'Heritage Premium' }}</span>
                <h1 class="product-title">{{ $product->product_name }}</h1>

                {{-- <div class="rating-container">
                    <div class="stars-row">
                        <span class="material-symbols-outlined">star</span>
                        <span class="material-symbols-outlined">star</span>
                        <span class="material-symbols-outlined">star</span>
                        <span class="material-symbols-outlined">star</span>
                        <span class="material-symbols-outlined">star</span>
                    </div>
                    <span class="reviews-count">4.9 (128 Reviews)</span>
                </div> --}}

                <div class="price-box">
                    <span class="price-selling">${{ number_format($product->selling_price, 2) }}</span>
                    @if ($product->regular_price && $product->regular_price > $product->selling_price)
                        <span class="price-regular">${{ number_format($product->regular_price, 2) }}</span>
                        @php
                            $discount =
                                (($product->regular_price - $product->selling_price) / $product->regular_price) * 100;
                        @endphp
                        <span class="save-badge">Save {{ round($discount) }}%</span>
                    @endif
                </div>

                <!-- Sizes -->
                {{-- <div class="size-section">
                    <span class="section-label">Bag Size</span>
                    <div class="size-buttons">
                        <button class="btn-size active" onclick="selectSize(this)">{{ $product->unit ?? '5kg' }}</button>
                        @if (($product->unit ?? '') !== '12kg')
                            <button class="btn-size" onclick="selectSize(this)">12kg</button>
                        @else
                            <button class="btn-size" onclick="selectSize(this)">20kg</button>
                        @endif
                    </div>
                </div> --}}

                <!-- Quantity -->
                <div class="quantity-section">
                    <span class="section-label">Quantity</span>
                    <div class="quantity-selector">
                        <button class="qty-btn" id="qty-minus" onclick="adjustQty(-1)">—</button>
                        <input type="text" class="qty-value" id="qty-val" value="1" readonly>
                        <button class="qty-btn" id="qty-plus" onclick="adjustQty(1)">+</button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="btn-add-to-cart" id="btnAddToCart">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        Add to Cart
                    </button>
                    {{-- <button class="btn-subscribe">
                        <span class="material-symbols-outlined">calendar_today</span>
                        Subscribe & Save 15%
                    </button> --}}
                </div>

                <!-- Micro Benefits -->
                {{-- <div class="benefits-list">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <span class="material-symbols-outlined">auto_awesome</span>
                        </div>
                        <span class="benefit-text">Shiny Coat</span>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon secondary">
                            <span class="material-symbols-outlined">favorite</span>
                        </div>
                        <span class="benefit-text">Digestive Health</span>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <span class="material-symbols-outlined">fitness_center</span>
                        </div>
                        <span class="benefit-text">High Protein</span>
                    </div>
                </div> --}}
            </div>
        </div>

        <!-- Tabs Section -->
        <div class="product-tabs-section">
            <div class="tabs-nav">
                <button class="tab-trigger active" onclick="switchTab(event, 'tab-description')">Description</button>
                {{-- <button class="tab-trigger" onclick="switchTab(event, 'tab-ingredients')">Ingredients</button> --}}
                <button class="tab-trigger" onclick="switchTab(event, 'specification')">Specification</button>
            </div>

            <!-- Tab Content Panel: Description -->
            <div id="tab-description" class="tab-content-panel active">
                <div class="tab-pane-description">
                    {{-- <h3>Nourish Their Potential with Nature's Bounty</h3> --}}
                    <p>{{ $product->description }}</p>
                    {{-- <p>Infused with heritage poultry and slow-roasted autumn vegetables, this recipe provides a balanced macro-nutrient profile. The inclusion of ancient grains ensures steady energy levels throughout the day without the sugar spikes associated with filler-heavy alternatives.</p> --}}
                </div>
            </div>

            <!-- Tab Content Panel: Ingredients -->
            {{-- <div id="tab-ingredients" class="tab-content-panel">
                <div class="tab-pane-description">
                    <h3>Carefully Sourced Ingredients</h3>
                    <p>
                        {{ $product->details->where('title', 'Ingredients')->first()->description ?? 'Organic chicken, deboned salmon, heritage turkey, sweet potatoes, raw carrots, peas, blueberries, organic flaxseed, wild salmon oil, ancient grains, rosemary extract, vitamin E supplement, and essential minerals.' }}
                    </p>
                </div>
            </div> --}}

            <!-- Tab Content Panel: Specification -->
            <div id="specification" class="tab-content-panel">
                <div class="tab-pane-table-wrapper">
                    <table class="tab-pane-table">
                        <tbody>
                            @forelse($product->details as $detail)
                                <tr>
                                    <th>{{ $detail->title }}</th>
                                    <td>{{ $detail->description }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">
                                        There is no Specification information available for this product.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <!-- Related Products Section: "Complete the Experience" -->
        <div class="related-products-section">
            <div class="related-header">
                <div class="related-title-box">
                    <h2 class="related-title">Complete the Experience</h2>
                    <p class="related-subtitle">Often bought with {{ $product->product_name }}</p>
                </div>
                <div class="carousel-nav-arrows">
                    <button class="arrow-nav-btn swiper-prev-related">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </button>
                    <button class="arrow-nav-btn swiper-next-related">
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </div>
            </div>

            <!-- Swiper Carousel -->
            <div class="swiper related-carousel">
                <div class="swiper-wrapper">
                    @foreach ($relatedProducts as $relProduct)
                        <div class="swiper-slide">
                            <div class="related-product-card glass-card">

                                <div class="related-img-box">
                                    <a href="{{ route('shop.single-page', $relProduct->slug) }}">
                                        <img src="{{ asset($relProduct->image) }}" alt="{{ $relProduct->product_name }}">
                                    </a>
                                </div>

                                <span class="related-cat">
                                    {{ $relProduct->category?->category_name }}
                                </span>

                                <h4 class="related-name">
                                    <a href="{{ route('shop.single-page', $relProduct->slug) }}">
                                        {{ $relProduct->product_name }}
                                    </a>
                                </h4>

                                <span class="related-price">
                                    ৳{{ number_format($relProduct->selling_price, 2) }}
                                </span>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        // Gallery selection script
        function changeImage(element, src) {
            document.getElementById('main-product-image').src = src;
            document.querySelectorAll('.thumbnail-item').forEach(item => {
                item.classList.remove('active');
            });
            element.classList.add('active');
        }

        // Size selection script
        function selectSize(element) {
            document.querySelectorAll('.btn-size').forEach(btn => {
                btn.classList.remove('active');
            });
            element.classList.add('active');
        }

        // Quantity selector script
        function adjustQty(amount) {
            const qtyVal = document.getElementById('qty-val');
            let current = parseInt(qtyVal.value) || 1;
            current += amount;
            if (current < 1) current = 1;
            qtyVal.value = current;
        }

        // Tabs script
        function switchTab(evt, tabId) {
            document.querySelectorAll('.tab-content-panel').forEach(panel => {
                panel.classList.remove('active');
            });
            document.querySelectorAll('.tab-trigger').forEach(trigger => {
                trigger.classList.remove('active');
            });
            document.getElementById(tabId).classList.add('active');
            evt.currentTarget.classList.add('active');
        }

        // Initialize Swiper and Cart Integration
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Swiper for Related Products
            new Swiper('.related-carousel', {
                slidesPerView: 4,
                spaceBetween: 24,
                navigation: {
                    nextEl: '.swiper-next-related',
                    prevEl: '.swiper-prev-related',
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1.2,
                        spaceBetween: 16
                    },
                    640: {
                        slidesPerView: 2.2,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 24
                    }
                }
            });

            // Custom Add to Cart button handler for singlePage to support quantity inputs and bind correctly
            const btnAddToCart = document.getElementById('btnAddToCart');
            if (btnAddToCart) {
                btnAddToCart.addEventListener('click', function(e) {
                    e.preventDefault();
                    const name = "{{ $product->product_name }}";
                    const price = parseFloat("{{ $product->selling_price }}") || 0;
                    const image = "{{ asset($product->image) }}";
                    const quantity = parseInt(document.getElementById('qty-val').value) || 1;

                    if (typeof cart !== 'undefined') {
                        const existing = cart.find(item => item.name === name);
                        if (existing) {
                            existing.quantity += quantity;
                        } else {
                            cart.push({
                                name: name,
                                price: price,
                                quantity: quantity,
                                image: image
                            });
                        }
                        if (typeof updateCartIcon === 'function') updateCartIcon();
                        if (typeof openCartModal === 'function') openCartModal();
                    } else {
                        console.error(
                            'Cart script not loaded. Make sure frontend.partials.cartmodal is included in the base layout.'
                        );
                    }
                });
            }
        });
    </script>
@endpush
