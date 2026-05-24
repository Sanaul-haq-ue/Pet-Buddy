@extends('backEnd.layouts.master')

@section('adminContent')
    <!-- Add New Product Category -->
    <div class="modal fade" id="addProductCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered align-items-center justify-content-center">
            <div class="modal-content rounded-4 shadow-lg border-0 w-50">
                <!-- Header -->
                <div class="modal-header border-0">
                    <div>
                        <h5 class="mb-0 fw-bold">Add New Product Category</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Form -->
                <form id="addProductCategoryForm" class="modal-form">
                    @csrf
                    <div class="modal-body">
                        <!-- Product Category Name -->
                        <div class="mb-3">
                            <label class="form-label">Product Category Name</label>
                            <input type="text" name="productCategory_name" class="form-control"
                                placeholder="Enter product category name" />
                            <div class="invalid-feedback text-danger text-xs mt-1" id="add_productCategory_name_error">
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="mb-1">
                            <label class="form-label">Status</label>
                            <div class="d-flex gap-3">
                                <label class="d-flex align-items-center gap-2">
                                    <input checked type="radio" class="pet_status" name="status" value="1" />
                                    <span>Active</span>
                                </label>
                                <label class="d-flex align-items-center gap-2">
                                    <input type="radio" class="pet_status" name="status" value="0" />
                                    <span>Inactive</span>
                                </label>
                            </div>
                            <div class="invalid-feedback text-danger text-xs mt-1" id="add_status_error"></div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="material-symbols-outlined align-middle">save</span>
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Edit Product Category -->
    <div class="modal fade" id="editProductCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered align-items-center justify-content-center">
            <div class="modal-content rounded-4 shadow-lg border-0 w-50">
                <!-- Header -->
                <div class="modal-header border-0">
                    <div>
                        <h5 class="mb-0 fw-bold">Edit Product Category</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Form -->
                <form id="editProductCategoryForm" class="modal-form">
                    @csrf
                    <input type="hidden" name="id" id="editCategoryId">
                    <div class="modal-body">
                        <!-- Product Category Name -->
                        <div class="mb-3">
                            <label class="form-label">Product Category Name</label>
                            <input type="text" name="productCategory_name" class="form-control"
                                placeholder="Enter product category name" />
                            <div class="invalid-feedback text-danger text-xs mt-1" id="edit_productCategory_name_error">
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="mb-1">
                            <label class="form-label">Status</label>
                            <div class="d-flex gap-3">
                                <label class="d-flex align-items-center gap-2">
                                    <input checked type="radio" class="pet_status" name="status" value="1" />
                                    <span>Active</span>
                                </label>
                                <label class="d-flex align-items-center gap-2">
                                    <input type="radio" class="pet_status" name="status" value="0" />
                                    <span>Inactive</span>
                                </label>
                            </div>
                            <div class="invalid-feedback text-danger text-xs mt-1" id="edit_status_error"></div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="material-symbols-outlined align-middle">update</span>
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Delete Product Category Modal -->
    <div class="modal fade" id="deleteProductCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">

                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger md:text-2xl text-lg">Delete Product Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body py-1">
                    <p class="mb-0">
                        Are you sure you want to delete this product category? This action cannot be undone.
                    </p>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteProductCategoryBtn">
                        Yes, Delete
                    </button>
                </div>

            </div>
        </div>
    </div>




    <div class="company-canvas">

        <div class="company-header d-flex justify-content-between align-items-end pb-4 mb-3">
            <div>
                <h3 class="fs-1 fw-bold text-on-surface tracking-tighter mb-1">Product Category</h3>
            </div>
            <div class="d-flex gap-3">
                <button
                    class="btn bg-primary text-on-primary rounded-full fw-bold text-sm d-flex align-items-center gap-2 hover-bg-primary-dim transition custom-active-scale border-0 shadow-sm px-4 py-2"
                    data-bs-toggle="modal" data-bs-target="#addProductCategoryModal">
                    <span class="material-symbols-outlined fs-5">Business</span>
                    Add New Product Category
                </button>
            </div>
        </div>

        <div class="row g-4 align-items-start mt-2">

            <!-- Product Category List -->
            <div class="col-12 col-md-12 d-flex flex-column gap-8">
                <!-- Product Category Search -->
                <div class="glass-card rounded-lg overflow-hidden d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center p-4 p-md-5 pb-3">
                        <h4 class="fs-5 font-headline fw-bold tracking-tight mb-0">Product Category List</h4>
                        <select name="status_filter" id="statusFilter"
                            class="form-select form-select-sm border-0 shadow-none bg-surface-container-low text-xs fw-bold text-primary rounded-full px-3 py-1 custom-focus-ring"
                            style="width: 130px; cursor: pointer;">
                            <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>All Status</option>
                            <option value="1" {{ request('status', '1') === '1' ? 'selected' : '' }}
                                class="text-primary">
                                Active</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}
                                class="text-zinc-500">
                                Inactive</option>
                        </select>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless table-divider text-start mb-0"
                            style="max-height: 50px; overflow-y: auto;">
                            <thead class="font-label text-10px tracking-widest text-uppercase">
                                <tr id="table-header">
                                    <th class="py-3 px-4 px-lg-5">Product Category</th>
                                    <th class="py-3 px-3 px-lg-4">Status</th>
                                    <th class="py-3 px-4 px-lg-5 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ProductCategories as $ProductCategory)
                                    <!-- Product Category Row -->
                                    <tr class="hover-bg-surface-lowest group">
                                        <td class="py-3 px-4 px-lg-5 align-middle">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="fw-bold text-on-surface">{{ $ProductCategory->productCategory_name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 px-lg-4 align-middle">
                                            @if ($ProductCategory->status == 1)
                                                <div class="d-flex align-items-center gap-2 text-primary">
                                                    <span
                                                        class="w-2 h-2 rounded-full bg-primary animate-pulse d-inline-block"></span>
                                                    <span class="text-xs fw-bold">Active</span>
                                                </div>
                                            @else
                                                <div class="d-flex align-items-center gap-2 text-zinc-500">
                                                    <span class="w-2 h-2 rounded-full bg-zinc-500 d-inline-block"></span>
                                                    <span class="text-xs fw-bold">Inactive</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 px-lg-5 align-middle text-end">

                                            <!-- Edit -->
                                            <button
                                                class="btn btn-link p-1 text-stone-400 hover-text-secondary text-decoration-none shadow-none edit-category-btn"
                                                data-id="{{ $ProductCategory->id }}"
                                                data-name="{{ $ProductCategory->productCategory_name }}"
                                                data-status="{{ $ProductCategory->status }}" data-bs-toggle="modal"
                                                data-bs-target="#editProductCategoryModal">
                                                <span class="material-symbols-outlined fs-5">edit</span>
                                            </button>

                                            <!-- Delete -->
                                            <button type="button"
                                                class="btn btn-link p-1 text-stone-400 hover-text-error text-decoration-none shadow-none delete-category-btn"
                                                data-id="{{ $ProductCategory->id }}">
                                                <span class="material-symbols-outlined fs-5">delete</span>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="px-4 py-3">
                            {{ $ProductCategories->links() }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- AJAX scripts for Product Category CRUD -->
    <script>
        $(document).ready(function() {
            // Setup CSRF token for jQuery AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Dynamic Table Refresh helper function
            function refreshTable() {
                let currentUrl = window.location.href;
                $.ajax({
                    url: currentUrl,
                    type: 'GET',
                    success: function(response) {
                        // Extract and replace tbody content
                        let newTbody = $(response).find('tbody').html();
                        $('tbody').html(newTbody);
                    },
                    error: function() {
                        toastr.error('Failed to refresh category table.');
                    }
                });
            }

            // AJAX submit for Add Category Form
            $('#addProductCategoryForm').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var submitBtn = form.find('button[type="submit"]');
                var originalText = submitBtn.html();

                // Clear any previous error styling
                form.find('.form-control').removeClass('is-invalid');
                form.find('.invalid-feedback').html('');

                // Set loading state
                submitBtn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...'
                ).prop('disabled', true);

                $.ajax({
                    url: "{{ route('productCategory.store') }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#addProductCategoryModal').modal('hide');
                            toastr.success(response.message);
                            form[0].reset();
                            refreshTable();
                        } else {
                            toastr.error(response.message || 'Something went wrong.');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                let input = form.find('[name="' + key + '"]');
                                input.addClass('is-invalid');
                                let feedbackDiv = $('#add_' + key + '_error');
                                if (feedbackDiv.length) {
                                    feedbackDiv.html(value[0]);
                                    feedbackDiv.show();
                                } else {
                                    toastr.error(value[0]);
                                }
                            });
                        } else {
                            toastr.error('An error occurred during submission.');
                        }
                    },
                    complete: function() {
                        // Reset button state
                        submitBtn.html(originalText).prop('disabled', false);
                    }
                });
            });

            // Populate Edit Category Modal
            $(document).on('click', '.edit-category-btn', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var status = $(this).data('status');

                var form = $('#editProductCategoryForm');

                // Clear any previous error styling
                form.find('.form-control').removeClass('is-invalid');
                form.find('.invalid-feedback').html('');

                // Populate fields
                $('#editCategoryId').val(id);
                form.find('input[name="productCategory_name"]').val(name);
                form.find('input[name="status"][value="' + status + '"]').prop('checked', true);
            });

            // AJAX submit for Edit Category Form
            $('#editProductCategoryForm').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var submitBtn = form.find('button[type="submit"]');
                var originalText = submitBtn.html();

                // Clear any previous error styling
                form.find('.form-control').removeClass('is-invalid');
                form.find('.invalid-feedback').html('');

                // Set loading state
                submitBtn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Updating...'
                ).prop('disabled', true);

                $.ajax({
                    url: "{{ route('productCategory.update') }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#editProductCategoryModal').modal('hide');
                            toastr.success(response.message);
                            refreshTable();
                        } else {
                            toastr.error(response.message || 'Something went wrong.');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                let input = form.find('[name="' + key + '"]');
                                input.addClass('is-invalid');
                                let feedbackDiv = $('#edit_' + key + '_error');
                                if (feedbackDiv.length) {
                                    feedbackDiv.html(value[0]);
                                    feedbackDiv.show();
                                } else {
                                    toastr.error(value[0]);
                                }
                            });
                        } else {
                            toastr.error('An error occurred during update.');
                        }
                    },
                    complete: function() {
                        // Reset button state
                        submitBtn.html(originalText).prop('disabled', false);
                    }
                });
            });

            // Define deleteCategoryId scoped variable
            let deleteCategoryId = null;

            // Open Delete Modal
            $(document).on('click', '.delete-category-btn', function() {
                deleteCategoryId = $(this).data('id');
                $('#deleteProductCategoryModal').modal('show');
            });

            // Confirm Delete
            $('#confirmDeleteProductCategoryBtn').on('click', function() {
                if (!deleteCategoryId) {
                    return;
                }

                var confirmBtn = $(this);
                var originalText = confirmBtn.html();

                // Set loading state
                confirmBtn.html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Deleting...').prop('disabled', true);

                $.ajax({
                    url: "{{ route('productCategory.delete', ':id') }}".replace(':id', deleteCategoryId),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        const modalElement = document.getElementById('deleteProductCategoryModal');
                        const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
                        modal.hide();

                        toastr.success(response.message);
                        refreshTable();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
                    },
                    complete: function() {
                        confirmBtn.html(originalText).prop('disabled', false);
                    }
                });
            });

            // AJAX-based Status Filtering without reloading the page
            $('#statusFilter').change(function() {
                var status = $(this).val();
                var url = new URL(window.location.href);
                url.searchParams.set('status', status);
                window.history.pushState({}, '', url.toString());
                refreshTable();
            });
        });
    </script>
@endsection
