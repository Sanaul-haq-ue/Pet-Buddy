@extends('backEnd.layouts.master')

@section('adminContent')
    <!-- Add New Payment Method -->
    <div class="modal fade" id="addPaymentMethodModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered align-items-center justify-content-center">
            <div class="modal-content rounded-4 shadow-lg border-0 w-75">
                <!-- Header -->
                <div class="modal-header border-0">
                    <div>
                        <h5 class="mb-0 fw-bold">Add New Payment Method</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Form -->
                <form id="addPaymentMethodForm" class="modal-form">
                    @csrf
                    <div class="modal-body">
                        <!-- Payment Method Name -->
                        <div class="mb-3">
                            <label class="form-label">Payment Method Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Enter payment method name" required />
                            <div class="invalid-feedback text-danger text-xs mt-1" id="add_name_error">
                            </div>
                        </div>
                        <!-- Payment Type -->
                        <div class="mb-3">
                            <label class="form-label">Payment Type <span class="text-danger">*</span></label>
                            <select id="addPayTypeSelect" name="pay_type_id" class="form-select" required>
                                <option value="" selected disabled>Select Payment Type</option>
                                @if ($paymentTypes)
                                    @foreach ($paymentTypes as $paymentType)
                                        <option value="{{ $paymentType->id }}">
                                            {{ $paymentType->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <!-- Mobile Banking Fields -->
                        <div id="mobileBankingFields" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label">Merchant/Personal Number</label>
                                <input type="number" name="mbanking_number" class="form-control">
                            </div>
                        </div>

                        <!-- Bank Fields -->
                        <div id="bankFields" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label">Account Holder Name</label>
                                <input type="text" name="account_holder_name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Account Number</label>
                                <input type="number" name="account_number" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Routing Number</label>
                                <input type="number" name="routing_number" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Branch Name</label>
                                <input type="text" name="branch_name" class="form-control">
                            </div>
                        </div>
                        <!-- Note -->
                        <div class="mb-1">
                            <label class="form-label">Note</label>
                            <textarea name="note" class="form-control" placeholder="Enter note"></textarea>
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
                        <button type="submit" class="btn btn-primary btn-custom">
                            <span class="material-symbols-outlined align-middle">save</span>
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Edit Payment Method -->
    <div class="modal fade" id="editPayMethodModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered align-items-center justify-content-center">
            <div class="modal-content rounded-4 shadow-lg border-0 w-50">
                <!-- Header -->
                <div class="modal-header border-0">
                    <div>
                        <h5 class="mb-0 fw-bold">Edit Payment Method</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Form -->
                <form id="editPayMethodForm" class="modal-form">
                    @csrf
                    <input type="hidden" name="id" id="editPayMethodId">
                    <div class="modal-body">
                        <!-- Payment Method Name -->
                        <div class="mb-3">
                            <label class="form-label">Payment Method Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Enter payment method name" required />
                            <div class="invalid-feedback text-danger text-xs mt-1" id="edit_name_error">
                            </div>
                        </div>
                        <!-- Payment Type -->
                        <div class="mb-1">
                            <label class="form-label">Payment Type <span class="text-danger">*</span></label>
                            <select id="editPayTypeSelect" name="pay_type_id" class="form-select" required>
                                @if ($paymentTypes)
                                    @foreach ($paymentTypes as $paymentType)
                                        <option value="{{ $paymentType->id }}">
                                            {{ $paymentType->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <!-- Mobile Banking Fields -->
                        <div id="editMobileBankingFields" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label">Merchant/Personal Number</label>
                                <input type="number" name="mbanking_number" class="form-control">
                                <div class="invalid-feedback text-danger text-xs mt-1" id="edit_mbanking_number_error"></div>
                            </div>
                        </div>

                        <!-- Bank Fields -->
                        <div id="editBankFields" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label">Account Holder Name</label>
                                <input type="text" name="account_holder_name" class="form-control">
                                <div class="invalid-feedback text-danger text-xs mt-1" id="edit_account_holder_name_error"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Account Number</label>
                                <input type="number" name="account_number" class="form-control">
                                <div class="invalid-feedback text-danger text-xs mt-1" id="edit_account_number_error"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Routing Number</label>
                                <input type="number" name="routing_number" class="form-control">
                                <div class="invalid-feedback text-danger text-xs mt-1" id="edit_routing_number_error"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Branch Name</label>
                                <input type="text" name="branch_name" class="form-control">
                                <div class="invalid-feedback text-danger text-xs mt-1" id="edit_branch_name_error"></div>
                            </div>
                        </div>
                        <!-- Note -->
                        <div class="mb-1">
                            <label class="form-label">Note</label>
                            <textarea name="note" class="form-control" placeholder="Enter note"></textarea>
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
    </div>


    <!-- Delete Product SubCategory Modal -->
    {{-- <div class="modal fade" id="deleteProductSubCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">

                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger md:text-2xl text-lg">Delete Product SubCategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body py-1">
                    <p class="mb-0">
                        Are you sure you want to delete this product subcategory? This action cannot be undone.
                    </p>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteProductSubCategoryBtn">
                        Yes, Delete
                    </button>
                </div>

            </div>
        </div>
    </div> --}}




    <div class="company-canvas">

        <div class="company-header d-flex justify-content-between align-items-end pb-4 mb-3">
            <div>
                <h3 class="fs-1 fw-bold text-on-surface tracking-tighter mb-1">Payment Section</h3>
            </div>
            <div class="d-flex gap-3">
                <button
                    class="btn bg-primary text-on-primary rounded-full fw-bold text-sm d-flex align-items-center gap-2 hover-bg-primary-dim transition custom-active-scale border-0 shadow-sm px-4 py-2"
                    data-bs-toggle="modal" data-bs-target="#addPaymentMethodModal">
                    {{-- <span class="material-symbols-outlined fs-5">Business</span> --}}
                    Add New Payment Method
                </button>
            </div>
        </div>

        <div class="row g-4 align-items-start mt-2">

            <!-- Payment Method List -->
            <div class="col-12 col-md-12 d-flex flex-column gap-8">
                <!-- Product SubCategory Search -->
                <div class="glass-card rounded-2lg overflow-hidden d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center p-4 p-md-5 pb-3">
                        <h4 class="fs-5 font-headline fw-bold tracking-tight mb-0">Payment Method List</h4>
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
                                    <th class="py-1 px-1 px-lg-2">Payment Method</th>
                                    <th class="py-1 px-1 px-lg-2">Payment Type</th>
                                    <th class="py-1 px-1 px-lg-2">M.Banking No.</th>
                                    <th class="py-1 px-1 px-lg-2">Account Holder Name</th>
                                    <th class="py-1 px-1 px-lg-2">Account Number</th>
                                    <th class="py-1 px-1 px-lg-2">Routing Number</th>
                                    <th class="py-1 px-1 px-lg-2">Branch Name</th>
                                    <th class="py-1 px-1 px-lg-2">Note</th>
                                    <th class="py-1 px-1 px-lg-2">Status</th>
                                    <th class="py-1 px-1 px-lg-2 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentMethods as $paymentMethod)
                                    <!-- Payment Method Row -->
                                    <tr class="hover-bg-surface-lowest group">
                                        <td class="py-1 px-1 px-lg-2 align-middle">
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="fw-bold text-on-surface">{{ $paymentMethod->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-1 px-1 px-lg-2 align-middle">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="fw-bold text-on-surface">{{ $paymentMethod->paymentType->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-1 px-1 px-lg-2 align-middle">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="fw-bold text-on-surface">{{ $paymentMethod->mbanking_number }}</span>
                                            </div>
                                        </td>
                                        <td class="py-1 px-1 px-lg-2 align-middle">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="fw-bold text-on-surface">{{ $paymentMethod->account_holder_name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-1 px-1 px-lg-2 align-middle">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="fw-bold text-on-surface">{{ $paymentMethod->account_number }}</span>
                                            </div>
                                        </td>
                                        <td class="py-1 px-1 px-lg-2 align-middle">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="fw-bold text-on-surface">{{ $paymentMethod->routing_number }}</span>
                                            </div>
                                        </td>
                                        <td class="py-1 px-1 px-lg-2 align-middle">
                                            <div class="d-flex align-items-center gap-3">
                                                <span
                                                    class="fw-bold text-on-surface">{{ $paymentMethod->branch_name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-1 px-1 px-lg-2 align-middle">
                                            <p>{{ $paymentMethod->note }}</p>
                                        </td>
                                        <td class="py-1 px-1 px-lg-2 align-middle">
                                            @if ($paymentMethod->status == 1)
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
                                        <td class="py-3 px-4 px-lg-2 align-middle text-end">

                                            <!-- Edit -->
                                            <button
                                                class="btn btn-link p-1 text-stone-400 hover-text-secondary text-decoration-none shadow-none edit-pay-method-btn"
                                                data-id="{{ $paymentMethod->id }}"
                                                data-name="{{ $paymentMethod->name }}"
                                                data-status="{{ $paymentMethod->status }}"
                                                data-type-id="{{ $paymentMethod->pay_type_id }}"
                                                data-note="{{ $paymentMethod->note }}"
                                                data-mbanking-number="{{ $paymentMethod->mbanking_number }}"
                                                data-account-holder-name="{{ $paymentMethod->account_holder_name }}"
                                                data-account-number="{{ $paymentMethod->account_number }}"
                                                data-routing-number="{{ $paymentMethod->routing_number }}"
                                                data-branch-name="{{ $paymentMethod->branch_name }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editPayMethodModal">
                                                <span class="material-symbols-outlined fs-5">edit</span>
                                            </button>

                                            <!-- Delete -->
                                            <button type="button"
                                                class="btn btn-link p-1 text-stone-400 hover-text-error text-decoration-none shadow-none delete-pay-method-btn"
                                                data-id="{{ $paymentMethod->id }}">
                                                <span class="material-symbols-outlined fs-5">delete</span>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="px-4 py-3">
                            {{ $ProductSubCategories->links() }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Add Payment Method Append New Field -->
    <script>
        function toggleFields() {
            let typeId = $('#addPayTypeSelect').val();

            // Reset Mobile Banking fields
            $('#mobileBankingFields input').val('');

            // Reset Bank fields
            $('#bankFields input').val('');

            // Hide all sections
            $('#mobileBankingFields').hide();
            $('#bankFields').hide();

            // Show selected section
            if (typeId == '1') {
                $('#mobileBankingFields').show();
            } else if (typeId == '2') {
                $('#bankFields').show();
            }
        }

        $('#addPayTypeSelect').on('change', function() {
            toggleFields();
        });
    </script>


    <!-- AJAX scripts for Product SubCategory CRUD -->
    <script>
        $(document).ready(function() {

            // Dynamic Table Refresh helper function
            function refreshTable() {
                let currentUrl = window.location.href;
                $.ajax({
                    url: currentUrl,
                    type: 'GET',
                    success: function(response) {
                        let newTbody = $(response).find('tbody').html();
                        $('tbody').html(newTbody);
                    },
                    error: function() {
                        toastr.error('Failed to refresh SubCategory table.');
                    }
                });
            }

            // AJAX submit for Add Payment Method Form
            $('#addPaymentMethodForm').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var submitBtn = form.find('button[type="submit"]');
                var originalText = submitBtn.html();

                form.find('.form-control, .form-select').removeClass('is-invalid');
                form.find('.invalid-feedback').html('');

                submitBtn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...'
                ).prop('disabled', true);

                $.ajax({
                    url: "{{ route('paymentMethod.store') }}",
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#addPaymentMethodModal').modal('hide');
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
                                    feedbackDiv.html(value[0]).show();
                                } else {
                                    toastr.error(value[0]);
                                }
                            });
                        } else {
                            toastr.error('An error occurred during submission.');
                        }
                    },
                    complete: function() {
                        submitBtn.html(originalText).prop('disabled', false);
                    }
                });
            });



            // Populate Edit Payment Method Modal
            $(document).on('click', '.edit-pay-method-btn', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var status = $(this).data('status');
                var typeId = $(this).data('type-id');
                var note = $(this).data('note');
                var mbankingNumber = $(this).data('mbanking-number');
                var accountHolderName = $(this).data('account-holder-name');
                var accountNumber = $(this).data('account-number');
                var routingNumber = $(this).data('routing-number');
                var branchName = $(this).data('branch-name');

                var form = $('#editPayMethodForm');

                form.find('.form-control, .form-select').removeClass('is-invalid');
                form.find('.invalid-feedback').html('');

                $('#editPayMethodId').val(id);
                form.find('input[name="name"]').val(name);
                form.find('input[name="status"][value="' + status + '"]').prop('checked', true);
                $('#editPayTypeSelect').val(typeId);
                form.find('textarea[name="note"]').val(note);
                form.find('input[name="mbanking_number"]').val(mbankingNumber);
                form.find('input[name="account_holder_name"]').val(accountHolderName);
                form.find('input[name="account_number"]').val(accountNumber);
                form.find('input[name="routing_number"]').val(routingNumber);
                form.find('input[name="branch_name"]').val(branchName);

                toggleEditFields(); // ✅ IMPORTANT
            });

            function toggleEditFields() {
                let typeId = $('#editPayTypeSelect').val();

                $('#editPayMethodModal #editMobileBankingFields').hide();
                $('#editPayMethodModal #editBankFields').hide();

                if (typeId == '1') {
                    $('#editPayMethodModal #editMobileBankingFields').show();
                } else if (typeId == '2') {
                    $('#editPayMethodModal #editBankFields').show();
                }
            }

            $('#editPayTypeSelect').on('change', function() {
                toggleEditFields();
            });




            // AJAX submit for Edit Payment Method Form
            $('#editPayMethodForm').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var submitBtn = form.find('button[type="submit"]');
                var originalText = submitBtn.html();

                form.find('.form-control, .form-select').removeClass('is-invalid');
                form.find('.invalid-feedback').html('');

                submitBtn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Updating...'
                ).prop('disabled', true);

                $.ajax({
                    url: "{{ route('paymentMethod.update') }}",
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#editPayMethodModal').modal('hide');
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
                                    feedbackDiv.html(value[0]).show();
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

            // Delete SubCategory
            // let deleteSubCategoryId = null;

            // $(document).on('click', '.delete-subcategory-btn', function() {
            //     deleteSubCategoryId = $(this).data('id');
            //     $('#deleteProductSubCategoryModal').modal('show');
            // });

            // $('#confirmDeleteProductSubCategoryBtn').on('click', function() {
            //     if (!deleteSubCategoryId) {
            //         return;
            //     }

            //     var confirmBtn = $(this);
            //     var originalText = confirmBtn.html();

            //     confirmBtn.html(
            //         '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Deleting...'
            //     ).prop('disabled', true);

            //     $.ajax({
            //         url: "{{ route('productSubCategory.delete', ':id') }}".replace(':id', deleteSubCategoryId),
            //         type: 'DELETE',
            //         headers: {
            //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
            //         },
            //         success: function(response) {
            //             const modalElement = document.getElementById('deleteProductSubCategoryModal');
            //             const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
            //             modal.hide();
            //             toastr.success(response.message);
            //             refreshTable();
            //         },
            //         error: function(xhr) {
            //             console.log(xhr.responseText);
            //             toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
            //         },
            //         complete: function() {
            //             confirmBtn.html(originalText).prop('disabled', false);
            //         }
            //     });
            // });

            // Status Filter
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
