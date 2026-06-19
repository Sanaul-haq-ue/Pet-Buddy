@extends('frontEnd.layouts.app')

@section('content')
    <main class="shop-main container pt-24 pb-20">
        <!-- Hero Section -->
        <header class="shop-header">
            <h1 class="shop-title">
                Luminous <span class="text-primary italic">Nutrition</span> for Every Pet
            </h1>
            <p class="shop-subtitle">
                Premium organic blends designed to elevate your companion's vitality. From crunchy dry feasts to succulent
                wet pâtés.
            </p>
        </header>
        <form id="filterForm" method="GET" action="{{ route('shop') }}">
            <div class="shop-layout">
                <!-- Sidebar Filters -->

                <aside class="shop-sidebar" id="shopFilterSidebar">
                    <div class="filter-group">
                        <h3 class="filter-title">PET TYPE</h3>

                        <div class="filter-list overflow-auto" style="max-height: 180px;">
                            @foreach ($species as $specie)
                                <label class="checkbox-label group mb-1">
                                    <input type="checkbox" name="species[]" value="{{ $specie->id }}"
                                        {{ in_array($specie->id, request('species', [])) ? 'checked' : '' }}>
                                    <span class="checkbox-text group-hover:text-primary">{{ $specie->species_name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-group">
                        <h3 class="filter-title">FOOD TYPE</h3>

                        <div class="filter-list overflow-auto" style="max-height: 180px;">
                            @foreach ($categories as $category)
                                <label class="checkbox-label group mb-1">
                                    <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                        {{ in_array($category->id, request('category', [])) ? 'checked' : '' }}>
                                    <span
                                        class="checkbox-text group-hover:text-primary">{{ $category->productCategory_name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-group">
                        <h3 class="filter-title">Brand</h3>

                        <div class="filter-list overflow-auto" style="max-height: 180px;">
                            @foreach ($brands as $brand)
                                <label class="checkbox-label group mb-1">
                                    <input type="checkbox" name="brand[]" value="{{ $brand->id }}"
                                        {{ in_array($brand->id, request('brand', [])) ? 'checked' : '' }}>
                                    <span
                                        class="checkbox-text group-hover:text-primary">{{ $brand->productBrand_name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>


                    {{-- <div class="rewards-promo-small">
                    <p class="promo-title">Radiant Rewards</p>
                    <p class="promo-text">Join our subscription and save 15% on every auto-ship order.</p>
                </div> --}}
                </aside>


                <button class="filter-toggle" id="openShopFilter">
                    <span class="material-symbols-outlined">tune</span>
                </button>

                <!-- Product Grid -->
                <div class="product-area">
                    <div class="glass-card sunlight-shadow product-area-header">
                        <div class="justify-content-end align-items-center gap-4 flex-nowrap show-sort">
                            <div class="d-flex align-items-center">
                                <span class="me-2 text-nowrap">Show:</span>
                                <select name="show" class="form-select" style="width: 50px;">
                                    <option value="12" {{ request('show') == 12 ? 'selected' : '' }}>12</option>
                                    <option value="24" {{ request('show') == 24 ? 'selected' : '' }}>24</option>
                                    <option value="48" {{ request('show') == 48 ? 'selected' : '' }}>48</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="me-2 text-nowrap">Sort By:</span>
                                <select name="sort" class="form-select" style="width: 150px;">
                                    <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Default
                                    </option>
                                    <option value="low_high" {{ request('sort') == 'low_high' ? 'selected' : '' }}>Price:
                                        Low to High</option>
                                    <option value="high_low" {{ request('sort') == 'high_low' ? 'selected' : '' }}>Price:
                                        High to Low</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="product-grid">
                        @foreach ($products as $product)
                            <!-- Product 1 -->
                            <div class="product-card glass-card sunlight-shadow group">
                                <div class="product-img-wrapper">
                                    <a href="{{ route('shop.single-page', $product->slug) }}">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->product_name }}"
                                        class="product-img">
                                    </a>
                                    
                                    {{-- <div class="badge badge-primary">BEST SELLER</div> --}}
                                </div>
                                <div class="product-header">
                                    <h4 class="product-name"><a href="{{ route('shop.single-page', $product->slug) }}">
                                        {{ $product->product_name }}</a>
                                    </h4>
                                    <div class="product-rating text-tertiary">
                                        {{-- <span class="material-symbols-outlined filled">star</span>
                                <span>4.9</span> --}}
                                    </div>
                                </div>
                                <p class="product-desc flex-grow">{{ Str::words($product->description, 12, '...') }}</p>
                                <div class="product-footer">
                                    <span class="product-price text-primary">
                                        <i class="fa-solid fa-bangladeshi-taka-sign"></i>
                                        {{ number_format($product->selling_price, 2) }}
                                    </span>
                                    <button class="btn-add-cart add-to-cart signature-glow">
                                        <span class="material-symbols-outlined">add_shopping_cart</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination-center">
                        <button class="btn-load-more sunlight-shadow">View All Products</button>
                    </div>
                </div>
            </div>
        </form>
    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('#filterForm input, #filterForm select')
                .forEach(el => {
                    el.addEventListener('change', function() {
                        document.getElementById('filterForm').submit();
                    });
                });
        });
    </script>
@endsection


@push('scripts')
    <script>
        const openShopFilter = document.getElementById('openShopFilter');
        const shopSidebar = document.getElementById('shopFilterSidebar');

        // Toggle
        openShopFilter.addEventListener('click', (e) => {
            e.stopPropagation();
            shopSidebar.classList.toggle('active');
        });

        // Prevent inside click
        shopSidebar.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        // Outside click → close
        document.addEventListener('click', () => {
            shopSidebar.classList.remove('active');
        });
    </script>
@endpush
