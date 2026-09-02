@extends('backEnd.layouts.master')

@section('adminContent')
    {{-- Add Category Modal --}}
    <div id="addCategoryModal" class="fixed inset-0 z-50 flex items-center justify-center px-4 py-10 hidden">
        <div class="absolute inset-0 bg-on-surface/10 backdrop-blur-sm"></div>
        <div
            class="glass-panel w-full max-w-md rounded-xl shadow-[0_40px_80px_rgba(148,76,0,0.12)] relative flex flex-col overflow-hidden">
            <!-- Modal Header -->
            <div class="px-10 pt-10 pb-6 flex justify-between items-start">
                <div>
                    <span
                        class="text-xs font-bold tracking-[0.1em] text-primary uppercase mb-2 block font-headline">ADMINISTRATION</span>
                    <h2 class="text-3xl font-bold text-on-surface font-headline leading-tight">Add Category</h2>
                </div>
                <button id="closeCategoryModal"
                    class="w-12 h-12 rounded-full flex items-center justify-center text-on-surface-variant hover:bg-surface-variant/40 transition-colors">
                    <span class="material-symbols-outlined" data-icon="close">close</span>
                </button>
            </div>
            <!-- Modal Body / Form -->
            <form id="addCategoryForm" class="px-10 pb-10 flex flex-col gap-8" method="POST">
                @csrf
                <div id="alertMessage" class="hidden rounded-lg px-4 py-3 text-sm font-medium mb-4"></div>
                <!-- Form Fields -->
                <div class="grid grid-cols-1 gap-y-4">
                    <!-- Category Name -->
                    <div>
                        <label
                            class="block text-sm font-bold text-on-surface-variant mb-2 font-headline uppercase tracking-wider">Category
                            Name</label>
                        <input
                            class="w-full bg-transparent border-b border-outline-variant/30 py-3 text-lg text-on-surface focus:outline-none focus:border-secondary transition-all placeholder:text-outline-variant/50"
                            placeholder="e.g., Grooming Services" name="name" type="text" required />
                    </div>
                    <!-- Status Dropdown -->
                    <div>
                        <label
                            class="block text-sm font-bold text-on-surface-variant mb-2 font-headline uppercase tracking-wider">Status</label>
                        <div class="relative">
                            <select name="status"
                                class="appearance-none w-full bg-transparent border-b border-outline-variant/30 py-3 pr-8 text-on-surface focus:outline-none focus:border-secondary transition-all cursor-pointer"
                                required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-0 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant"
                                data-icon="expand_more">expand_more</span>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer / Actions -->
                <div class="flex items-center justify-end gap-6 pt-2">
                    <button id="cancelCategoryModal" type="button"
                        class="px-8 py-3 rounded-full text-on-surface-variant font-bold hover:bg-surface-variant/20 transition-all active:scale-95">
                        Cancel
                    </button>
                    <button type="submit"
                        class="bg-gradient-to-r from-primary to-primary-container px-6 py-2 rounded-full text-on-primary font-bold shadow-lg shadow-primary/30 hover:brightness-110 transition-all active:scale-95 flex items-center gap-2">
                        <span class="material-symbols-outlined" data-icon="add"
                            style="font-variation-settings: 'FILL' 1;">Save</span>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Category Modal --}}
    <div id="editCategoryModal" class="fixed inset-0 z-50 flex items-center justify-center px-4 py-10 hidden">
        <div class="absolute inset-0 bg-on-surface/10 backdrop-blur-sm"></div>
        <div
            class="glass-panel w-full max-w-md rounded-xl shadow-[0_40px_80px_rgba(148,76,0,0.12)] relative flex flex-col overflow-hidden">
            <!-- Modal Header -->
            <div class="px-10 pt-10 pb-6 flex justify-between items-start">
                <div>
                    <span
                        class="text-xs font-bold tracking-[0.1em] text-primary uppercase mb-2 block font-headline">ADMINISTRATION</span>
                    <h2 class="text-3xl font-bold text-on-surface font-headline leading-tight">Edit Category</h2>
                </div>
                <button id="closeEditCategoryModal"
                    class="w-12 h-12 rounded-full flex items-center justify-center text-on-surface-variant hover:bg-surface-variant/40 transition-colors">
                    <span class="material-symbols-outlined" data-icon="close">close</span>
                </button>
            </div>
            <!-- Modal Body / Form -->
            <form id="editCategoryForm" class="px-10 pb-10 flex flex-col gap-8" method="POST">
                @csrf
                <input type="hidden" id="editCategoryId" name="category_id" value="">
                <div id="alertMessage" class="hidden rounded-lg px-4 py-3 text-sm font-medium mb-4"></div>
                <!-- Form Fields -->
                <div class="grid grid-cols-1 gap-y-4">
                    <!-- Category Name -->
                    <div>
                        <label
                            class="block text-sm font-bold text-on-surface-variant mb-2 font-headline uppercase tracking-wider">Category
                            Name</label>
                        <input
                            class="w-full bg-transparent border-b border-outline-variant/30 py-3 text-lg text-on-surface focus:outline-none focus:border-secondary transition-all placeholder:text-outline-variant/50"
                            placeholder="e.g., Grooming Services" id="editCategoryName" name="name" type="text"
                            value="" required />
                    </div>
                    <!-- Status Dropdown -->
                    <div>
                        <label
                            class="block text-sm font-bold text-on-surface-variant mb-2 font-headline uppercase tracking-wider">Status</label>
                        <div class="relative">
                            <select name="status"
                                class="appearance-none w-full bg-transparent border-b border-outline-variant/30 py-3 pr-8 text-on-surface focus:outline-none focus:border-secondary transition-all cursor-pointer"
                                required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-0 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant"
                                data-icon="expand_more">expand_more</span>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer / Actions -->
                <div class="flex items-center justify-end gap-4 pt-2">
                    <button id="cancelEditCategoryModal" type="button"
                        class="px-8 py-3 rounded-full text-on-surface-variant font-bold hover:bg-surface-variant/20 transition-all active:scale-95">
                        Cancel
                    </button>
                    <button type="submit"
                        class="bg-gradient-to-r from-primary to-primary-container px-6 py-2 rounded-full text-on-primary font-bold shadow-lg shadow-primary/30 hover:brightness-110 transition-all active:scale-95 flex items-center gap-2">
                        <span class="material-symbols-outlined" data-icon="add"
                            style="font-variation-settings: 'FILL' 1;">Save</span>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- View Pop up Modal --}}
    <div id="serviceModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">

        <!-- MODAL BOX -->
        <div class="w-full max-w-3xl mx-4 bg-surface rounded-2xl shadow-2xl overflow-hidden animate-fadeIn">

            <!-- HEADER -->
            <div
                class="flex items-center justify-between px-6 py-4 border-b border-outline-variant/20 bg-surface-container-low">
                <div class="flex items-center gap-3">
                    <span class="w-10 h-10 flex items-center justify-center rounded-full bg-primary/10 text-primary">
                        <span class="material-symbols-outlined">visibility</span>
                    </span>
                    <h2 class="text-lg font-headline font-bold text-on-surface">
                        Service Details
                    </h2>
                </div>

                <button id="closeModal" class="p-2 rounded-full hover:bg-surface-container-lowest transition">
                    <span class="material-symbols-outlined text-on-surface-variant">close</span>
                </button>
            </div>

            <!-- BODY -->
            <div class="p-6 space-y-6 max-h-[70vh] overflow-y-auto">

                <!-- TOP INFO -->
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-on-surface">Premium Grooming Service</h3>
                        <p class="text-sm text-on-surface-variant">Luxury care for your pets</p>
                    </div>

                    <span class="px-3 py-1 text-xs rounded-full bg-secondary/10 text-secondary font-semibold">
                        Active
                    </span>
                </div>

                <!-- 🖼️ IMAGE SECTION (NEW) -->
                <div
                    class="w-full h-52 rounded-xl overflow-hidden bg-surface-container-low border border-outline-variant/20">
                    <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e" alt="Service Image"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
                </div>

                <!-- GRID INFO -->
                <div class="grid grid-cols-2 gap-4">

                    <div class="p-4 rounded-xl bg-surface-container-low">
                        <p class="text-xs text-outline">Category</p>
                        <p class="font-semibold text-on-surface">Grooming, Care</p>
                    </div>

                    <div class="p-4 rounded-xl bg-surface-container-low">
                        <p class="text-xs text-outline">Species</p>
                        <p class="font-semibold text-on-surface">Dog, Cat</p>
                    </div>

                    <div class="p-4 rounded-xl bg-surface-container-low">
                        <p class="text-xs text-outline">Company</p>
                        <p class="font-semibold text-on-surface">PetBuddy Ltd</p>
                    </div>

                    <div class="p-4 rounded-xl bg-surface-container-low">
                        <p class="text-xs text-outline">Capacity</p>
                        <p class="font-semibold text-on-surface">20 / Day</p>
                    </div>

                    <div class="p-4 rounded-xl bg-surface-container-low col-span-2">
                        <p class="text-xs text-outline">Location</p>
                        <p class="font-semibold text-on-surface">Dhaka, Bangladesh</p>
                    </div>

                </div>

                <!-- PRICING -->
                <div class="flex items-center justify-between p-5 rounded-xl bg-primary/5 border border-primary/10">

                    <div>
                        <p class="text-xs text-outline">Base Price</p>
                        <p class="text-2xl font-bold text-primary">$300</p>
                    </div>

                    <div class="text-right">
                        <p class="text-xs text-outline">Timing</p>
                        <p class="font-semibold text-on-surface">Hourly</p>
                    </div>

                    <div class="text-right">
                        <p class="text-xs text-outline">Offer</p>
                        <p class="font-semibold text-secondary">$250</p>
                    </div>

                </div>

                <!-- DESCRIPTION -->
                <div class="p-5 rounded-xl bg-surface-container-low">
                    <p class="text-xs text-outline mb-2">Description</p>
                    <p class="text-sm text-on-surface leading-relaxed">
                        This is a premium grooming service designed for full pet care including bathing,
                        styling, nail trimming, and health checkups in a calm environment.
                    </p>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="px-6 py-4 border-t border-outline-variant/20 flex justify-end">
                <button id="closeModal"
                    class="px-5 py-2 rounded-full bg-surface-container-low hover:bg-surface-container transition font-semibold text-on-surface">
                    Close
                </button>
            </div>

        </div>
    </div>


    <div class="space-y-16">
        <!-- Header Section -->
        <section class="max-w-4xl">
            <h1 class="fs-1 font-extrabold tracking-tight text-on-surface mb-1">Service Registry</h1>
        </section>

        <div class="ca-po grid grid-cols-6 gap-8">
            <!-- Category List -->
            <div class="col-span-4 glass-card rounded-lg overflow-hidden flex flex-col">
                <div class="p-4 pb-4 flex justify-between items-center">
                    <h4 class="text-xl font-headline font-bold tracking-tight">Category</h4>
                    <button id="addCategoryBtn" class="font-label">Add
                        Category</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left overflow-y-auto">
                        <thead
                            class="bg-surface-container-low text-on-surface-variant font-label text-[10px] tracking-widest uppercase">
                            <tr>
                                <th class="px-6 py-4">Category Name</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-8 py-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/10">
                            @if ($categories->isEmpty())
                                <tr>
                                    <td colspan="3" class="p-3 text-center text-sm text-on-surface-variant">
                                        No categories found.
                                    </td>
                                </tr>
                            @else
                                @foreach ($categories as $category)
                                    <tr class="hover:bg-surface-container-lowest/50 transition-colors group">
                                        <td class="p-2 text-sm">{{ $category->name }}</td>
                                        <td class="p-2">
                                            @if ($category->status == 1)
                                                <div class="flex items-center gap-1.5 text-secondary">
                                                    <span class="w-2 h-2 rounded-full bg-secondary"></span>
                                                    <span class="text-xs font-bold">Active</span>
                                                </div>
                                            @else
                                                <div class="flex items-center gap-1.5 text-primary">
                                                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                                                    <span class="text-xs font-bold">Inactive</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="p-2 text-right">
                                            <button type="button"
                                                class="editCategoryBtn p-2 text-stone-400 hover:text-secondary transition-colors"
                                                data-category-id="{{ $category->id }}"
                                                data-category-name="{{ $category->name }}"
                                                data-category-status="{{ $category->status }}"><span
                                                    class="material-symbols-outlined">edit</span></button>

                                            <button class=" p-2 text-stone-400 hover:text-error transition-colors"><span
                                                    class="material-symbols-outlined">delete</span></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>

            <!-- Population Insights -->
            <aside class="col-span-2 space-y-8">
                <div class="bg-secondary/10 rounded-xl p-8 border border-secondary/10">
                    <h4 class="font-headline text-lg font-bold mb-6">Population Insights</h4>
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <span class="text-sm opacity-70">Total Species</span>
                            <span class="font-bold text-xl">45</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm opacity-70">Active Breeds</span>
                            <span class="font-bold text-xl">28</span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>


        <!-- Services Section -->
        <section>
            <div class="service-header flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-on-surface">Available Services</h2>
                    <p class="text-stone-500 text-sm">Tailored care programs for every resident.</p>
                </div>
                <a href="{{ route('addService') }}"
                    class="bg-primary text-on-primary px-8 py-2 rounded-full font-bold flex items-center gap-2 hover:bg-primary-dim active:scale-95 transition-all">
                    <span class="material-symbols-outlined" data-icon="add_circle">add_circle</span>
                    Create New Service
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                @if ($services->isNotEmpty())
                    @foreach ($services as $service )
                        <div
                            class="glass-card p-8 rounded-lg flex flex-col gap-6 group hover:translate-y-[-4px] transition-all duration-500">
                            
                                <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center text-primary">
                                    <img src="{{ asset($service->image) }}" alt="">
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2">{{ $service->name }}</h3>
                                    <p class="text-sm text-stone-500 line-clamp-2">Category : {{ $service->category?->name }}</p>
                                    <p class="text-sm text-stone-500 line-clamp-2">{{ $service->service_type }}</p>
                                </div>
                                <div class="mt-auto flex items-center justify-between border-t border-stone-200/30 pt-6">
                                   
                                    <div class="flex gap-2">
                                        <a class="px-4 py-2 h-full rounded-full border border-outline-variant/30 text-stone-600 text-sm font-semibold hover:bg-stone-50 transition-colors" href="{{ route('editService', $service->id) }}">Manage</a>
                                        <button class="p-2 text-error hover:bg-error-container/20 rounded-full transition-colors">
                                            <span class="material-symbols-outlined" data-icon="delete">delete</span>
                                        </button>
                                    </div>
                                </div>
                            
                        </div>
                    @endforeach
                @endif
                
                
            </div>
        </section>
    </div>


    <script>
        $(document).ready(function() {
            // Show modal when Add Category button is clicked
            $('#addCategoryBtn').on('click', function() {
                $('#addCategoryModal').removeClass('hidden');
                $('#alertMessage').addClass('hidden').text('');
                $('#addCategoryForm')[0].reset();
            });

            // Close modal
            $('#closeCategoryModal, #cancelCategoryModal').on('click', function() {
                $('#addCategoryModal').addClass('hidden');
            });

            // Handle form submission
            $('#addCategoryForm').on('submit', function(e) {
                e.preventDefault();
                let $form = $(this);
                let $submitBtn = $form.find('button[type="submit"]');
                let originalBtnHtml = $submitBtn.html();

                // Disable submit button and change text to Saving...
                $submitBtn.prop('disabled', true).html(
                    '<span class="material-symbols-outlined" style="font-variation-settings: \'FILL\' 1;">hourglass_empty</span> Saving...'
                );

                $.ajax({
                    url: '{{ route('saveCategory') }}',
                    type: 'POST',
                    data: $form.serialize(),
                    success: function(response) {
                        // Show success toastr notification
                        toastr.success('Saved Successfully!', 'Success', {
                            timeOut: 3000,
                            positionClass: 'toast-top-right'
                        });

                        // Reload page after 1.5 seconds
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        let errorMessage = 'Error saving category. Please try again.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = Object.values(xhr.responseJSON.errors).flat();
                            errorMessage = errors.join(' ');
                        }

                        // Show error toastr notification
                        toastr.error(errorMessage, 'Error', {
                            timeOut: 4000,
                            positionClass: 'toast-top-right'
                        });
                    },
                    complete: function() {
                        // Re-enable submit button and restore original text
                        $submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
            });



            // Edit modal show
            $(document).on('click', '.editCategoryBtn', function() {
                let button = $(this);

                let categoryId = button.data('category-id');
                let categoryName = button.data('category-name');
                let categoryStatus = button.data('category-status');


                $('#editCategoryId').val(categoryId);
                $('#editCategoryName').val(categoryName);
                $('#editCategoryForm select[name="status"]').val(categoryStatus);

                $('#editCategoryModal').removeClass('hidden');

            });

            // Close modal
            $(document).on('click', '#closeEditCategoryModal, #cancelEditCategoryModal', function() {
                $('#editCategoryModal').addClass('hidden');
            });


            // Handle edit form submission
            $('#editCategoryForm').on('submit', function(e) {
                e.preventDefault();
                let $form = $(this);
                let $submitBtn = $form.find('button[type="submit"]');
                let originalBtnHtml = $submitBtn.html();

                // Disable submit button and change text to Saving...
                $submitBtn.prop('disabled', true).html(
                    '<span class="material-symbols-outlined" style="font-variation-settings: \'FILL\' 1;">hourglass_empty</span> Saving...'
                );

                $.ajax({
                    url: '{{ route('updateCategory') }}',
                    type: 'POST',
                    data: $form.serialize(),
                    success: function(response) {
                        // Show success toastr notification
                        toastr.success('Updated Successfully!', 'Success', {
                            timeOut: 3000,
                            positionClass: 'toast-top-right'
                        });

                        // Reload page after 1.5 seconds
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        let errorMessage = 'Error updating category. Please try again.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = Object.values(xhr.responseJSON.errors).flat();
                            errorMessage = errors.join(' ');
                        }

                        // Show error toastr notification
                        toastr.error(errorMessage, 'Error', {
                            timeOut: 4000,
                            positionClass: 'toast-top-right'
                        });
                    },
                    complete: function() {
                        // Re-enable submit button and restore original text
                        $submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });



            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $(document).on('click', '.viewServiceBtn', function() {

                let btn = $(this);

                // Fill modal data
                $('#serviceModal .title').text(btn.data('name'));
                $('#serviceModal .category').text(btn.data('category'));
                $('#serviceModal .species').text(btn.data('species'));
                $('#serviceModal .company').text(btn.data('company'));
                $('#serviceModal .price').text(btn.data('price'));
                $('#serviceModal .timing').text(btn.data('timing'));
                $('#serviceModal .capacity').text(btn.data('capacity'));
                $('#serviceModal .description').text(btn.data('description'));
                $('#serviceModal .status').text(btn.data('status'));

                // open modal
                $('#serviceModal').removeClass('hidden');
            });

            // close modal
            $(document).on('click', '#closeModal', function() {
                $('#serviceModal').addClass('hidden');
            });

        });
    </script>
@endsection
