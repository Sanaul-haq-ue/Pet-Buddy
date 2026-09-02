@extends('backEnd.layouts.master')

@section('adminContent')
    <link rel="stylesheet" href="{{ asset('backAssets/css/product.css') }}" />

    <!-- Header Section -->
    <div class="product-header d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">
        <div>
            <h2 class="header-title font-display">Product Management</h2>
            <p class="header-subtitle font-body">High-density administrative view of sanctuary supplies and products.</p>
        </div>
        <a class="btn-add-product mt-3 mt-md-0" href="{{ route('productAdd') }}">
            <span style="font-size: 20px; line-height: 1;">&#8617;</span>
            Add New Product
        </a>
    </div>

    <!-- Advanced Filter Bar -->
    <section class="glass-card p-4 mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-12 col-md-6 col-lg">
                <div class="d-flex flex-column gap-1">
                    <label class="font-label text-uppercase"
                        style="font-size: 0.625rem; font-weight: 700; letter-spacing: 0.1em; color: #6b5e55; margin-left: 4px;">Category</label>
                    <select class="filter-select" id="categoryFilter">
                        <option value="all">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->productCategory_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg">
                <div class="d-flex flex-column gap-1">
                    <label class="font-label text-uppercase"
                        style="font-size: 0.625rem; font-weight: 700; letter-spacing: 0.1em; color: #6b5e55; margin-left: 4px;">Brand</label>
                    <select class="filter-select" id="brandFilter">
                        <option value="all">All Brands</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->productBrand_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg">
                <div class="d-flex flex-column gap-1">
                    <label class="font-label text-uppercase"
                        style="font-size: 0.625rem; font-weight: 700; letter-spacing: 0.1em; color: #6b5e55; margin-left: 4px;">Stock
                        Status</label>
                    <select class="filter-select" id="stockFilter">
                        <option value="all">All Statuses</option>
                        <option value="in_stock">In Stock</option>
                        <option value="low_stock">Low Stock</option>
                        <option value="out_of_stock">Out of Stock</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg">
                <div class="d-flex flex-column gap-1">
                    <label class="font-label text-uppercase"
                        style="font-size: 0.625rem; font-weight: 700; letter-spacing: 0.1em; color: #6b5e55; margin-left: 4px;">
                        Species</label>
                    <select class="filter-select" id="speciesFilter">
                        <option value="all">All Species</option>
                        @foreach ($species as $specie)
                            <option value="{{ $specie->id }}">{{ $specie->species_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-auto">
                <button class="btn-reset-filters" id="resetFiltersBtn">
                    <span style="font-size: 16px; line-height: 1;">&#8635;</span>
                    Reset Filters
                </button>
            </div>
        </div>
        <div class="row g-3 align-items-end mt-2">
            <div class="col-12 col-md-6 col-lg">
                <div class="d-flex flex-column gap-1">
                    <label class="font-label text-uppercase"
                        style="font-size: 0.625rem; font-weight: 700; letter-spacing: 0.1em; color: #6b5e55; margin-left: 4px;">
                        Sku </label>
                    <input type="text" id="searchInput" class="filter-input"
                        placeholder="Search by product name or SKU..." />
                </div>
            </div>
        </div>

    </section>

    <!-- Product Inventory Grid -->
    <div class="row g-4">
        <!-- Item 1 -->
        @foreach ($products as $product)
            <div class="col-12 col-md-6 col-xxl-4 product-item" data-category-id="{{ $product->category_id }}"
                data-brand-id="{{ $product->brand_id }}" data-quantity="{{ $product->quantity }}"
                data-species-ids="{{ json_encode($product->species_ids ?? []) }}"
                data-name="{{ strtolower($product->product_name) }}" data-sku="{{ strtolower($product->sku_id ?? '') }}">
                <div
                    class="product-card
                    @if ($product->quantity == 0) border-left-outline
                    @elseif($product->quantity < 10)
                        border-left-error
                    @else
                        border-left-secondary @endif">
                    <div class="d-flex gap-3">
                        <div class="product-thumb">
                            <img alt="{{ $product->product_name }}"
                                src="{{ $product->image ? asset($product->image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuAlVS5kzmOVhbl1tPVqSZLIFjh0YPo6PLaVSlcajHKuNUEdph5TO2h0mlaiA92k4jheCAvg2_1gUxsJcARXL8X2EzHsthVBm1hm3U_jf1FRF6jbJOnGoRB3NEuh_L-wI1Xn7cHoccvOiOthWxxZ0whYuFKR2szDAt53LbVqNP2dhdWCKr4P9iOUGAU01-6XqlpUJwOIKA-8KyQsJ_bYgOO_-0V9Jjy-ycuo5R-RdPEFkOhKq4YHWYCMhvrM1NlmVZFb-XG7c8gQXQ3L' }}" />
                        </div>
                        <div class="flex-grow-1 d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="font-label text-uppercase"
                                        style="font-size: 0.625rem; font-weight: 700; letter-spacing: 0.1em; color: #b06e3a;">
                                        {{ $product->category->productCategory_name }} •
                                        {{ $product->subCategory->productSubCategory_name ?? 'No Subcategory' }}</p>
                                    <h4 class="font-display fw-bold"
                                        style="font-size: 1.125rem; color: #1e293b; line-height: 1.25;">
                                        {{ $product->product_name }}
                                    </h4>
                                    <p class="text-uppercase"
                                        style="font-size: 0.625rem; font-weight: 700; color: #6b5e55; margin-top: 2px;">
                                        Brand: <span
                                            style="color: #944c00;">{{ $product->brand->productBrand_name }}</span>
                                    </p>
                                </div>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('productEdit', $product->slug) }}"
                                        class="icon-btn-round d-flex align-items-center justify-content-center text-decoration-none">
                                        <span style="font-size: 16px;">&#9998;</span>
                                    </a>
                                    <button class="icon-btn-round danger delete-product-btn"
                                        data-slug="{{ $product->slug }}">
                                        <span style="font-size: 16px;">&#128465;</span>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex align-items-baseline gap-2 mt-2">
                                <span class="fw-bold"
                                    style="font-size: 1.25rem; color: #944c00;"><i class="fa-solid fa-bangladeshi-taka-sign"></i>{{ number_format($product->selling_price, 2) }}</span>
                                <span
                                    style="font-size: 0.75rem; color: #6b5e55; text-decoration: line-through;"><i class="fa-solid fa-bangladeshi-taka-sign"></i>{{ number_format($product->regular_price, 2) ?? 'N/A' }}</span>
                                <span class="ms-auto text-uppercase"
                                    style="font-size: 0.625rem; font-weight: 700; color: #6b5e55;">{{ $product->unit }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="divider-line">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-2">
                                @foreach ($product->species_ids ?? [] as $id)
                                    @if (isset($species[$id]))
                                        <span class="tag-pill-sm">
                                            {{ $species[$id]->species_name }}
                                        </span>
                                    @endif
                                @endforeach
                                {{-- <span class="tag-pill-sm">Small-Medium Breeds</span> --}}
                            </div>
                            <span
                                class="
                                @if ($product->quantity == 0) status-badge out-of-stock
                                @elseif($product->quantity < 10)
                                    status-badge low-stock
                                @else
                                    status-badge in-stock @endif">
                                In Stock ({{ $product->quantity }})
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Add SKU Card -->
        {{-- <div class="col-12 col-md-6 col-xxl-4">
            <div class="add-sku-card">
                <div class="add-sku-icon">
                    <span style="font-size: 24px;">+</span>
                </div>
                <p class="font-headline fw-bold" style="font-size: 0.875rem;">Register New SKU</p>
                <p style="font-size: 0.625rem; text-align: center; margin-top: 4px; padding: 0 16px; opacity: 0.7;">Add a
                    high-density entry to your inventory database.</p>
            </div>
        </div>
    </div> --}}

        <!-- Pagination -->
        <footer class="mt-5">
            <div class="glass-card rounded-pill p-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-4 ps-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="status-dot in-stock"></span>
                            <span class="font-label text-uppercase"
                                style="font-size: 0.625rem; font-weight: 700; letter-spacing: 0.1em; color: #6b5e55;">In
                                Stock:
                                42</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="status-dot alerts"></span>
                            <span class="font-label text-uppercase"
                                style="font-size: 0.625rem; font-weight: 700; letter-spacing: 0.1em; color: #6b5e55;">Alerts:
                                12</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <button class="page-nav-btn"><span style="font-size: 12px;">&#8249;</span></button>
                        <div class="d-flex gap-1">
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                        </div>
                        <button class="page-nav-btn"><span style="font-size: 12px;">&#8250;</span></button>
                    </div>
                    <div class="pe-3">
                        <span class="font-label text-uppercase"
                            style="font-size: 0.625rem; font-weight: 700; letter-spacing: 0.1em; color: #6b5e55;">1-12 of
                            156
                            Products</span>
                    </div>
                </div>
            </div>
        </footer>



        <!-- Delete Product Modal -->
        <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow-lg">

                    <div class="modal-header border-0">
                        <h5 class="modal-title text-danger md:text-2xl text-lg">Delete Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body py-1">
                        <p class="mb-0">
                            Are you sure you want to delete this product? This action cannot be undone.
                        </p>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteProductBtn">
                            Yes, Delete
                        </button>
                    </div>

                </div>
            </div>
        </div>



        {{-- Dynamic Realtime Filter Script --}}
        <script>
            $(document).ready(function() {
                function filterProducts() {
                    const categoryId = $('#categoryFilter').val();
                    const brandId = $('#brandFilter').val();
                    const stockStatus = $('#stockFilter').val();
                    const speciesId = $('#speciesFilter').val();
                    const searchText = $('#searchInput').val().toLowerCase().trim();

                    $('.product-item').each(function() {
                        const item = $(this);

                        // Category filter
                        const itemCatId = item.attr('data-category-id');
                        const matchCategory = (categoryId === 'all' || itemCatId === categoryId);

                        // Brand filter
                        const itemBrandId = item.attr('data-brand-id');
                        const matchBrand = (brandId === 'all' || itemBrandId === brandId);

                        // Stock filter: out of stock = 0, low stock < 10, in stock >= 10
                        const qty = parseInt(item.attr('data-quantity')) || 0;
                        let matchStock = true;
                        if (stockStatus === 'out_of_stock') {
                            matchStock = (qty === 0);
                        } else if (stockStatus === 'low_stock') {
                            matchStock = (qty > 0 && qty < 10);
                        } else if (stockStatus === 'in_stock') {
                            matchStock = (qty >= 10);
                        }

                        // Species filter
                        let matchSpecies = true;
                        if (speciesId !== 'all') {
                            let itemSpeciesIds = item.attr('data-species-ids');
                            if (itemSpeciesIds) {
                                try {
                                    itemSpeciesIds = JSON.parse(itemSpeciesIds);
                                } catch (e) {
                                    itemSpeciesIds = [];
                                }
                            } else {
                                itemSpeciesIds = [];
                            }
                            const targetId = parseInt(speciesId);
                            const parsedIds = itemSpeciesIds.map(id => parseInt(id));
                            matchSpecies = parsedIds.includes(targetId);
                        }

                        // Search filter (Product name or SKU)
                        const itemName = item.attr('data-name');
                        const itemSku = item.attr('data-sku');
                        const matchSearch = (!searchText || itemName.includes(searchText) || itemSku.includes(
                            searchText));

                        // Show/Hide
                        if (matchCategory && matchBrand && matchStock && matchSpecies && matchSearch) {
                            item.show();
                        } else {
                            item.hide();
                        }
                    });

                    updatePaginationStats();
                }

                function updatePaginationStats() {
                    const total = $('.product-item').length;
                    const visible = $('.product-item:visible').length;

                    let inStockCount = 0;
                    let alertsCount = 0; // low stock + out of stock

                    $('.product-item:visible').each(function() {
                        const qty = parseInt($(this).attr('data-quantity')) || 0;
                        if (qty >= 10) {
                            inStockCount++;
                        } else {
                            alertsCount++;
                        }
                    });

                    $('.status-dot.in-stock').next().text('In Stock: ' + inStockCount);
                    $('.status-dot.alerts').next().text('Alerts: ' + alertsCount);

                    if (visible === total) {
                        $('footer .pe-3 span').text('1-' + total + ' of ' + total + ' Products');
                    } else {
                        $('footer .pe-3 span').text('Showing ' + visible + ' of ' + total + ' Products');
                    }
                }

                // Bind change and keyup inputs
                $('#categoryFilter, #brandFilter, #stockFilter, #speciesFilter').on('change', filterProducts);
                $('#searchInput').on('keyup input', filterProducts);

                // Reset
                $('#resetFiltersBtn').on('click', function() {
                    $('#categoryFilter').val('all');
                    $('#brandFilter').val('all');
                    $('#stockFilter').val('all');
                    $('#speciesFilter').val('all');
                    $('#searchInput').val('');
                    filterProducts();
                });

                // Initial call to set stats
                updatePaginationStats();
            });
        </script>


        <script>
            let deleteProductSlug = null;

            $(document).on('click', '.delete-product-btn', function() {
                deleteProductSlug = $(this).data('slug');
                $('#deleteProductModal').modal('show');
            });

            $('#confirmDeleteProductBtn').on('click', function() {
                if (!deleteProductSlug) return;

                var confirmBtn = $(this);
                var originalText = confirmBtn.html();

                confirmBtn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Deleting...'
                ).prop('disabled', true);

                $.ajax({
                    url: "{{ route('product.delete', ':slug') }}".replace(':slug', deleteProductSlug),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        const modalElement = document.getElementById('deleteProductModal');
                        const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(
                            modalElement);
                        modal.hide();
                        toastr.success(response.message);
                        refreshTable();
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
                    },
                    complete: function() {
                        confirmBtn.html(originalText).prop('disabled', false);
                    }
                });
            });
        </script>
    @endsection
