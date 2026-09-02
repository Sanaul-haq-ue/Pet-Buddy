@extends('backEnd.layouts.master')

@section('adminContent')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    <!-- Edit Payment Type -->
    {{-- <div class="modal fade" id="editCouponModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered align-items-center justify-content-center">
            <div class="modal-content rounded-4 shadow-lg border-0">
                <!-- Header -->
                <div class="modal-header border-0">
                    <div>
                        <h5 class="mb-0 fw-bold">Edit Payment Type</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Form -->
                <form id="editCouponForm" class="modal-form">
                    @csrf
                    <input type="hidden" name="id" id="editCouponId">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <!-- Payment Type Name -->
                            <div class="col-md-6">
                                <label class="form-label">Coupon Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Enter Coupon name" />
                                <div class="invalid-feedback text-danger text-xs mt-1" id="add_name_error">
                                </div>
                            </div>
                            <!-- Coupon Code -->
                            <div class="col-md-6">
                                <label class="form-label">Coupon Code<span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control"
                                    placeholder="Enter Coupon Code" />
                                <div class="invalid-feedback text-danger text-xs mt-1" id="add_name_error">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <!-- Discount Type -->
                            <div class="col-md-6">
                                <label class="form-label">Discount Type<span class="text-danger">*</span></label>
                                {{-- <input type="text" name="discount_type" class="form-control"
                                placeholder="Enter Discount Type" /> --}}
                                <select name="discount_type" id="" class="form-control">
                                    <option value="" selected disabled>Select Discount Type</option>
                                    <option value="percentage">Percentage</option>
                                    <option value="fixed">Fixed Amount</option>
                                </select>
                                <div class="invalid-feedback text-danger text-xs mt-1" id="add_name_error">
                                </div>
                            </div>
                            <!-- Discount Value -->
                            <div class="col-md-6">
                                <label class="form-label">Discount Value<span class="text-danger">*</span></label>
                                <input type="text" name="discount_value" class="form-control"
                                    placeholder="Enter Discount Value" />
                                <div class="invalid-feedback text-danger text-xs mt-1" id="add_name_error">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <!-- Minimum Order Amount -->
                            <div class="col-md-6">
                                <label class="form-label">Minimum Order Amount<span class="text-danger">*</span></label>
                                <input type="text" name="min_order_amount" class="form-control"
                                    placeholder="Enter Minimum Order Amount" />
                                <div class="invalid-feedback text-danger text-xs mt-1" id="add_name_error">
                                </div>
                            </div>
                            <!-- Maximum Discount Amount -->
                            <div class="col-md-6">
                                <label class="form-label">Maximum Discount Amount<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="max_discount_amount" class="form-control"
                                    placeholder="Enter Maximum Discount Amount" />
                                <div class="invalid-feedback text-danger text-xs mt-1" id="add_name_error">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <!-- Start Date -->
                            <div class="col-md-6">
                                <label class="form-label">Start Date<span class="text-danger">*</span></label>
                                <input type="text" name="start_date" id="start_date" class="form-control"
                                    placeholder="dd/mm/yyyy">
                                <div class="invalid-feedback text-danger text-xs mt-1" id="add_name_error">
                                </div>
                            </div>
                            <!-- Expiry Date -->
                            <div class="col-md-6">
                                <label class="form-label">Expiry Date<span class="text-danger">*</span></label>
                                <input type="text" name="expiry_date" id="expiry_date" class="form-control"
                                    placeholder="dd/mm/yyyy">
                                <div class="invalid-feedback text-danger text-xs mt-1" id="add_name_error">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <!-- Usage Limit -->
                            <div class="col-md-6">
                                <label class="form-label">Usage Limit<span class="text-danger">*</span></label>
                                <input type="text" name="usage_limit" class="form-control"
                                    placeholder="Enter Usage Limit" />
                                <div class="invalid-feedback text-danger text-xs mt-1" id="add_name_error">
                                </div>
                            </div>
                            <!-- Usage Per Customer -->
                            <div class="col-md-6">
                                <label class="form-label">Usage Per Customer<span class="text-danger">*</span></label>
                                <input type="text" name="usage_per_customer" class="form-control"
                                    placeholder="Enter Usage Per Customer" />
                                <div class="invalid-feedback text-danger text-xs mt-1" id="add_name_error">
                                </div>
                            </div>
                        </div>

                        <!-- Note -->
                        <div class="mb-3">
                            <label class="form-label">Note<span class="text-danger">*</span></label>
                            <input type="text" name="note" class="form-control" placeholder="Enter Note" />
                            <div class="invalid-feedback text-danger text-xs mt-1" id="add_name_error">
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
                        <button type="submit" class="btn btn-primary btn-custom">
                            <span class="material-symbols-outlined align-middle">update</span>
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}



    <div class="company-canvas">

        <div class="company-header d-flex justify-content-between align-items-end pb-4 mb-3">
            <div>
                <h3 class="fs-1 fw-bold text-on-surface tracking-tighter mb-1">Coupon Section</h3>
            </div>
            <div class="d-flex gap-3">
            </div>
        </div>

        <div class="row g-4 align-items-start mt-2">

            <!-- Product Unit List -->
            <div class="col-12 col-md-12 d-flex flex-column gap-8">
                <!-- Product Unit Search -->
                <div class="glass-card rounded-lg overflow-hidden d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center p-4 p-md-5 pb-3">
                        <h4 class="fs-5 font-headline fw-bold tracking-tight mb-0">Coupon List</h4>
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
                                    <th class="py-3 px-4 px-lg-5">Name</th>
                                    <th class="py-3 px-3 px-lg-4">Amount</th>
                                    <th class="py-3 px-3 px-lg-4">Status</th>
                                    <th class="py-3 px-4 px-lg-5 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shippings as $shipping)
                                    <!-- Payment Type Row -->
                                    <tr class="hover-bg-surface-lowest group">
                                        <td class="py-3 px-4 px-lg-5 align-middle">
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="fw-bold text-on-surface">{{ $shipping->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 px-lg-5 align-middle">
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="fw-bold text-on-surface">{{ $shipping->amount }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 px-lg-4 align-middle">
                                            @if ($shipping->status == 1)
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
                                                class="btn btn-link p-1 text-stone-400 hover-text-secondary text-decoration-none shadow-none edit-coupon-btn"
                                                data-id="{{ $coupon->id }}" data-name="{{ $coupon->name }}"
                                                data-code="{{ $coupon->code }}"
                                                data-discount_type="{{ $coupon->discount_type }}"
                                                data-discount_value="{{ $coupon->discount_value }}"
                                                data-min_order_amount="{{ $coupon->min_order_amount }}"
                                                data-max_discount_amount="{{ $coupon->max_discount_amount }}"
                                                data-usage_limit="{{ $coupon->usage_limit }}"
                                                data-usage_per_customer="{{ $coupon->usage_per_customer }}"
                                                data-start_date="{{ \Carbon\Carbon::parse($coupon->start_date)->format('d/m/Y') }}"
                                                data-expiry_date="{{ \Carbon\Carbon::parse($coupon->expiry_date)->format('d/m/Y') }}"
                                                data-note="{{ $coupon->note }}" data-status="{{ $coupon->status }}"
                                                data-bs-toggle="modal" data-bs-target="#editCouponModal">
                                                <span class="material-symbols-outlined fs-5">edit</span>
                                            </button>

                                            <!-- Delete -->
                                            <button type="button"
                                                class="btn btn-link p-1 text-stone-400 hover-text-error text-decoration-none shadow-none delete-unit-btn"
                                                data-id="{{ $coupon->id }}">
                                                <span class="material-symbols-outlined fs-5">delete</span>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- AJAX scripts for Product Unit CRUD -->
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

           
            $(document).on('click', '.edit-coupon-btn', function() {

                var form = $('#editCouponForm');

                // Clear errors
                form.find('.form-control, .form-select').removeClass('is-invalid');
                form.find('.invalid-feedback').html('');

                // Populate fields
                $('#editCouponId').val($(this).data('id'));

                form.find('[name="name"]').val($(this).data('name'));
                form.find('[name="code"]').val($(this).data('code'));
                form.find('[name="discount_type"]').val($(this).data('discount_type'));
                form.find('[name="discount_value"]').val($(this).data('discount_value'));
                form.find('[name="min_order_amount"]').val($(this).data('min_order_amount'));
                form.find('[name="max_discount_amount"]').val($(this).data('max_discount_amount'));
                form.find('[name="usage_limit"]').val($(this).data('usage_limit'));
                form.find('[name="usage_per_customer"]').val($(this).data('usage_per_customer'));
                form.find('[name="start_date"]').val($(this).data('start_date'));
                form.find('[name="expiry_date"]').val($(this).data('expiry_date'));
                form.find('[name="note"]').val($(this).data('note'));

                form.find('[name="status"][value="' + $(this).data('status') + '"]').prop('checked', true);
            });



            // AJAX submit for Edit Unit Form
            $('#editCouponForm').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var submitBtn = form.find('button[type="submit"]');
                var originalText = submitBtn.html();

                form.find('.form-control').removeClass('is-invalid');
                form.find('.invalid-feedback').html('');

                submitBtn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Updating...'
                ).prop('disabled', true);

                $.ajax({
                    url: "{{ route('payCoupon.update') }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#editCouponModal').modal('hide');
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
                        submitBtn.html(originalText).prop('disabled', false);
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
