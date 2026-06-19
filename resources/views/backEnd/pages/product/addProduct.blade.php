@extends('backEnd.layouts.master')

@section('adminContent')
    <link rel="stylesheet" href="{{ asset('backAssets/css/addProduct.css') }}" />

    <form id="productForm" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid px-0 mb-3">
            <div class="row g-5">
                <!-- Left Column: Primary Information -->
                <div class="col-12 col-lg-8">
                    <div class="d-flex flex-column gap-5">
                        <!-- Section: General Information -->
                        <section class="glass-card">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div class="section-divider primary"></div>
                                <h2 class="font-headline fs-4 fw-bold text-slate-800" style="color: #1e293b;">General
                                    Information</h2>
                            </div>
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="label-text">PRODUCT NAME <span class="text-danger">*</span></label>
                                    <input class="input-underline sm" name="product_name"
                                        placeholder="e.g. Organic Hemp Calming Chews" type="text" required />
                                </div>
                                <div class="col-md-4">
                                    <label class="label-text">BRAND <span class="text-danger">*</span></label>
                                    <select name="brand_id" id="brandSelect" class="form-control" required>
                                        <option selected disabled>Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">
                                                {{ $brand->productBrand_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <label class="label-text">CATEGORY <span class="text-danger">*</span></label>
                                            <select name="category_id" id="categorySelect" class="form-control" required>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->productCategory_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label class="label-text">SUB-CATEGORY</label>
                                            <select name="sub_category_id" id="subCategorySelect" class="form-control"
                                                disabled>
                                                <option value="">Select Category First</option>
                                                @foreach ($subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}"
                                                        data-category="{{ $subCategory->productCategory_id }}">
                                                        {{ $subCategory->productSubCategory_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="label-text">DESCRIPTION</label>
                                    <textarea class="input-underline sm" name="description"
                                        placeholder="Describe the benefits, ingredients, and usage instructions..." rows="4" style="resize: none;"></textarea>
                                </div>
                            </div>
                        </section>

                        <!-- Add Additional Information Button Section -->
                        <section class="glass-card" id="addInfoSection">
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-primary" id="showDetailsBtn">
                                    Add Additional Information
                                </button>
                            </div>
                        </section>

                        <!-- Additional Details Section -->
                        <section class="glass-card d-none" id="detailsSection">
                            <div class="d-flex align-items-center gap-3 mb-4 justify-content-between">
                                <div class="d-flex gap-3">
                                    <div class="section-divider secondary"></div>

                                    <h2 class="font-headline fs-4 fw-bold text-slate-800">
                                        Additional Details
                                    </h2>
                                </div>

                                <div class="d-flex gap-3">
                                    <button type="button" class="btn btn-success" id="addNewRowBtn">Add New</button>
                                    <button type="button" class="btn btn-danger" id="closeDetailsBtn">Close Tab</button>
                                </div>
                            </div>

                            <div class="row g-4" id="detailsContainer">
                                <div class="col-lg-12">
                                    <div class="row g-1">
                                        <div class="col-5">
                                            <input type="text" name="detail_title[]" class="input-underline sm"
                                                placeholder="Title">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="detail_description[]" class="input-underline sm"
                                                placeholder="Description">
                                        </div>
                                        <div class="col-1">
                                            {{-- <button class="btn-add-detail">
                                            Close
                                        </button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Section: Pricing & Stock -->
                        <section class="glass-card">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div class="section-divider secondary"></div>
                                <h2 class="font-headline fs-4 fw-bold text-slate-800" style="color: #1e293b;">Pricing &amp;
                                    Stock</h2>
                            </div>
                            <div class="row g-4">
                                <div class="col-lg-12 col-lg-6">
                                    <div class="row g-4">
                                        <div class="col-4">
                                            <label class="label-text">REGULAR PRICE</label>
                                            <div class="position-relative">
                                                <input class="input-underline bold sm" name="regular_price"
                                                    placeholder="0.00" type="number" min="0"
                                                    style="padding-left: 16px;" />
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="label-text">SELLING PRICE <span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input class="input-underline bold sm" name="selling_price"
                                                    placeholder="0.00" type="number" min="0"
                                                    style="padding-left: 16px; color: #944c00;" required />
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="label-text">Buying PRICE</label>
                                            <div class="position-relative">
                                                <input class="input-underline bold sm" name="buying_price"
                                                    placeholder="0.00" type="number" min="0"
                                                    style="padding-left: 16px; color: #944c00;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <label class="label-text">UNIT <span class="text-danger">*</span></label>
                                    <input class="input-underline sm" name="unit" placeholder="e.g. 250g bag"
                                        type="text" required />
                                </div>
                                <div class="col-6 col-lg-3">
                                    <label class="label-text">QUANTITY <span class="text-danger">*</span></label>
                                    <input class="input-underline sm" name="quantity" placeholder="50" type="number"
                                        min="0" required />
                                </div>
                                <div class="col-12">
                                    <label class="label-text">SKU ID</label>
                                    <input class="input-underline mono" name="sku_id" placeholder="AM-WC-001"
                                        type="text" />
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <!-- Right Column: Media & Meta -->
                <div class="col-12 col-lg-4">
                    <div class="d-flex flex-column gap-5">
                        <!-- Section: Media -->
                        <section class="glass-card" style="padding: 2rem;">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h2 class="font-headline fs-5 fw-bold text-slate-800" style="color: #1e293b;">Product
                                    Media
                                </h2>
                                <span class="text-slate-400" style="color: #94a3b8; font-size: 24px;">&#9729;</span>
                            </div>
                            <div class="upload-area" id="uploadArea">
                                <img id="previewImage"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDfaKwcxLSdf4Kuzp5sN9lwLYcHAcavBBu3DPPR4sg-c9lwGe7hkRUk1vOzq7Wzun3JDAtr1Ue90UpFucuxN1V6AI-wqycGMdWO96-8oqGShFc_HcBUV9UHcibybnEs66SzjDTmpBLEU1UdX0OgDHvLyAUFQcbrfiihok-YpXI8220N-z0O4uIppOecQDJmFq7k9-g0-BDJVlie2OKE2Ln6rb0aplBZJ10u1Pfv3VtgUz99CAX2yFF12vbq-rjB-nCUfbVemHD17-h3"
                                    alt="Preview">

                                <div class="position-relative z-1 d-flex flex-column align-items-center text-center p-4">
                                    <p class="font-headline fw-semibold mb-0" style="color: #1e293b;">Upload</p>
                                    <p class="text-xs mt-2 mb-0" style="color: #64748b; font-size: 0.75rem;">
                                        PNG or JPG (min. 1200x1200px)
                                    </p>
                                </div>
                            </div>

                            <input type="file" id="imageInput" name="image" accept="image/*" hidden>
                        </section>

                        <!-- Section: Organization/Tags -->
                        <section class="glass-card" style="padding: 2rem;">
                            <h2 class="font-headline fs-5 fw-bold mb-4 text-slate-800" style="color: #1e293b;">Discovery
                                Tags
                            </h2>
                            <div class="d-flex flex-column gap-4">
                                <div class="mb-3">
                                    <label class="label-text mb-2">SPECIES</label>
                                    <select id="speciesDropdown" class="form-select">
                                        <option value="">Select Species</option>
                                        @foreach ($species as $specie)
                                            <option value="{{ $specie->id }}">{{ $specie->species_name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="selectedSpecies" class="d-flex flex-wrap gap-2 mt-2"></div>
                                </div>
                                <div>
                                    <label class="label-text">BREEDS (OPTIONAL)</label>
                                    <input class="input-bordered sm" placeholder="e.g. Golden Retriever"
                                        type="text" />
                                </div>
                            </div>
                        </section>

                        <!-- Status Card -->
                        <section class="status-card">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <label class="font-headline fw-bold fs-5" style="color: #1e293b;">Product
                                    Visibility</label>
                                <div class="toggle-switch" id="visibilityToggle">
                                    <div class="toggle-track"></div>
                                    <div class="toggle-thumb"></div>
                                </div>
                                <input type="hidden" name="is_visible" id="isVisibleInput" value="0">
                            </div>
                            <p class="mb-0" style="color: #64748b; font-size: 0.875rem; line-height: 1.6;">Publish this
                                product to the public storefront immediately upon saving.</p>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bar -->
        <div class="p-3">
            <div class="d-flex align-items-center justify-content-center w-100">
                <button type="button" class="btn-cancel" onclick="window.history.back();">Back</button>
                <button type="submit" class="btn-save signature-glow" id="saveProductBtn">Save</button>
            </div>
        </div>

        <!-- Visual Polish: Floating Shapes -->
        <div class="floating-blob primary"></div>
        <div class="floating-blob secondary"></div>

    </form>




    {{-- // Additional Information Tab Logic --}}
    <script>
        document.getElementById('showDetailsBtn').addEventListener('click', function() {
            document.getElementById('addInfoSection').classList.add('d-none');
            document.getElementById('detailsSection').classList.remove('d-none');
        });
        document.getElementById('closeDetailsBtn').addEventListener('click', function() {
            // Keep only the first row
            const container = document.getElementById('detailsContainer');
            const firstRow = container.querySelector('.col-lg-12');
            container.innerHTML = '';
            container.appendChild(firstRow);
            // Clear inputs
            firstRow.querySelectorAll('input').forEach(input => {
                input.value = '';
            });
            document.getElementById('detailsSection').classList.add('d-none');
            document.getElementById('addInfoSection').classList.remove('d-none');
        });
    </script>

    {{-- // Additional Information append field --}}
    <script>
        document.getElementById('addNewRowBtn').addEventListener('click', function() {

            const html = `
                <div class="col-lg-12">
                    <div class="row g-1">
                        <div class="col-5">
                            <input type="text" name="detail_title[]" class="input-underline sm" placeholder="Title">
                        </div>
                        <div class="col-6">
                            <input type="text" name="detail_description[]" class="input-underline sm" placeholder="Description">
                        </div>
                        <div class="col-1 clos-icon">
                            <button type="button" class="btn-add-detail remove-row-btn">
                                close
                            </button>
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('detailsContainer')
                .insertAdjacentHTML('beforeend', html);
        });

        // Remove a row when Close is clicked
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row-btn')) {
                e.target.closest('.col-lg-12').remove();
            }
        });
    </script>

    {{-- Image Upload Script --}}
    <script>
        const uploadArea = document.getElementById('uploadArea');
        const imageInput = document.getElementById('imageInput');
        const previewImage = document.getElementById('previewImage');
        uploadArea.addEventListener('click', function() {
            imageInput.click();
        });
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                previewImage.src = URL.createObjectURL(file);
            }
        });
    </script>

    {{-- Category Subcategory Logic --}}
    <script>
        document.getElementById('categorySelect').addEventListener('change', function() {
            const categoryId = this.value;
            const subCategorySelect = document.getElementById('subCategorySelect');
            const options = subCategorySelect.querySelectorAll('option');
            subCategorySelect.disabled = false;
            options.forEach(option => {
                if (option.value === '') {
                    option.hidden = false;
                    return;
                }
                if (option.dataset.category == categoryId) {
                    option.hidden = false;
                } else {
                    option.hidden = true;
                }
            });
            subCategorySelect.value = '';
        });
    </script>

    {{-- Species Selection --}}
    <script>
        const dropdown = document.getElementById('speciesDropdown');
        const container = document.getElementById('selectedSpecies');
        let selected = [];

        dropdown.addEventListener('change', function() {
            const id = this.value;
            const name = this.options[this.selectedIndex].text;

            if (!id) return;

            if (selected.find(item => item.id === id)) {
                this.value = "";
                return;
            }
            selected.push({
                id: id,
                name: name
            });
            render();
            this.value = "";
        });

        function render() {
            container.innerHTML = "";
            selected.forEach(item => {
                const div = document.createElement('div');
                div.className = "species-pill";

                div.innerHTML = `
            ${item.name}
            <input type="hidden" name="species_ids[]" value="${item.id}">
            <button type="button" onclick="removeItem('${item.id}')">×</button>
        `;
                container.appendChild(div);
            });
        }

        function removeItem(id) {
            selected = selected.filter(item => item.id !== id);
            render();
        }
    </script>

    {{-- Product Visibility Toggle --}}
    <script>
        const toggle = document.getElementById('visibilityToggle');
        const input = document.getElementById('isVisibleInput');
        let isOn = false;

        toggle.addEventListener('click', function() {
            isOn = !isOn;

            if (isOn) {
                input.value = 1;
                toggle.classList.add('active');
            } else {
                input.value = 0;
                toggle.classList.remove('active');
            }
        });
    </script>



    {{-- AJAX Form Submission --}}
    <script>
        $(document).ready(function() {
            $('#productForm').on('submit', function(e) {
                e.preventDefault();

                // Save button loading state
                const saveBtn = $('#saveProductBtn');
                const originalBtnText = saveBtn.html();
                saveBtn.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...'
                    );

                // Create FormData object
                const formData = new FormData(this);

                $.ajax({
                    url: "{{ route('product.store') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            toastr.success(response.message || 'Product saved successfully.');

                            // Reset Form
                            $('#productForm')[0].reset();

                            // Clear image preview (reset to default placeholder)
                            $('#previewImage').attr('src',
                                'https://lh3.googleusercontent.com/aida-public/AB6AXuDfaKwcxLSdf4Kuzp5sN9lwLYcHAcavBBu3DPPR4sg-c9lwGe7hkRUk1vOzq7Wzun3JDAtr1Ue90UpFucuxN1V6AI-wqycGMdWO96-8oqGShFc_HcBUV9UHcibybnEs66SzjDTmpBLEU1UdX0OgDHvLyAUFQcbrfiihok-YpXI8220N-z0O4uIppOecQDJmFq7k9-g0-BDJVlie2OKE2Ln6rb0aplBZJ10u1Pfv3VtgUz99CAX2yFF12vbq-rjB-nCUfbVemHD17-h3'
                                );

                            // Reset Visibility switch toggle
                            isOn = false;
                            $('#visibilityToggle').removeClass('active');
                            $('#isVisibleInput').val(0);

                            // Clear dynamic product detail rows & close details section
                            const container = document.getElementById('detailsContainer');
                            const firstRow = container.querySelector('.col-lg-12');
                            container.innerHTML = '';
                            container.appendChild(firstRow);
                            firstRow.querySelectorAll('input').forEach(input => {
                                input.value = '';
                            });
                            document.getElementById('detailsSection').classList.add('d-none');
                            document.getElementById('addInfoSection').classList.remove(
                            'd-none');

                            // Clear selected species tags
                            selected = [];
                            render();

                            // Disable subCategorySelect since category selection is cleared
                            $('#subCategorySelect').prop('disabled', true).val('');

                        } else {
                            toastr.error(response.message || 'Something went wrong.');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const response = xhr.responseJSON;
                            if (response.errors) {
                                $.each(response.errors, function(key, errors) {
                                    $.each(errors, function(index, val) {
                                        toastr.error(val);
                                    });
                                });
                            } else {
                                toastr.error('Validation failed.');
                            }
                        } else {
                            const response = xhr.responseJSON;
                            const message = (response && response.message) ? response.message :
                                'Something went wrong.';
                            toastr.error(message);
                        }
                    },
                    complete: function() {
                        // Restore button state
                        saveBtn.prop('disabled', false).html(originalBtnText);
                    }
                });
            });
        });
    </script>
@endsection
