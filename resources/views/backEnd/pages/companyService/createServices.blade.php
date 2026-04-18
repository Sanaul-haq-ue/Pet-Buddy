@extends('backEnd.layouts.master')

@section('adminContent')
    {{-- <header
            class="fixed top-0 right-0 left-64 h-16 bg-stone-50/80 backdrop-blur-xl z-40 shadow-[0_20px_40px_rgba(148,76,0,0.06)] flex justify-between items-center px-8">
            <div class="flex items-center gap-2">
                <span class="text-xl font-bold text-orange-800 font-headline">Radiant Habitat Admin</span>
            </div>
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-4 text-stone-600">
                    <button class="material-symbols-outlined hover:bg-orange-50 p-2 rounded-full transition-colors"
                        data-icon="notifications">notifications</button>
                    <button class="material-symbols-outlined hover:bg-orange-50 p-2 rounded-full transition-colors"
                        data-icon="settings">settings</button>
                </div>
                <div class="h-8 w-8 rounded-full bg-primary-container overflow-hidden">
                    <img alt="Admin Profile"
                        data-alt="professional headshot of a friendly-looking man with short dark hair in a bright office setting, soft lighting"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAlPH07tQR-iNepkQRAc1lzVh3ZQpGFgHk8RVRtgekYX3kYInBvMNZ7FCB3GeLB14p6sy9s1cOfaAruhtKS0hSTfuos7s-xF1TLrTFLqZNIzgYh4_NQimOYiu5zgNa8XTagsCVTCOm6DFa4Nx4lzqHd6Xvxn6gYrYAP-EZRsde4PPFz9r_bKASRFEfAx4MTAoBlxbCjXskmzzLA31tEd5Mu7Y9fLE47yhVP1WFBYk9r0BbasAtpwTRG55ABD1p0LoWDgHQTI4Cf5mBT" />
                </div>
            </div>
        </header> --}}
    <!-- Page Content -->
    <div class="mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 mb-8 text-sm font-label text-outline uppercase tracking-wider">
            <a class="hover:text-primary transition-colors" href="#">Services</a>
            <span class="material-symbols-outlined text-xs" data-icon="chevron_right">chevron_right</span>
            <span class="text-on-surface font-bold">Create New</span>
        </nav>
        <!-- Page Header -->
        <div class="mb-12">
            <h2 class="text-4xl font-headline font-extrabold text-on-surface -tracking-wide mb-2">Configure Your New
                Sanctuary Offering</h2>
            <p class="text-on-surface-variant max-w-2xl text-lg">Define a new service for our animal companions. Ensure
                all details are accurate to maintain the luminous standard of care.</p>
        </div>
        <!-- Form Content -->
        <form id="addServiceForm" class="space-y-10" autocomplete="off">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <!-- Left Column: Service Basics & Operations -->
                <div class="lg:col-span-7 space-y-10">
                    <!-- Section 1: Service Basics -->
                    <section class="glass-card sunlight-shadow rounded-lg p-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div
                                class="w-10 h-10 rounded-full bg-orange-100 text-orange-700 flex items-center justify-center">
                                <span class="material-symbols-outlined" data-icon="info">info</span>
                            </div>
                            <h3 class="text-xl font-headline font-bold text-on-surface">Service Basics</h3>
                        </div>
                        <div class="space-y-8">
                            <div class="group">
                                <label
                                    class="block text-xs font-label font-bold text-outline uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">
                                    Service Name<span class="text-red-500">*</span></label>
                                <input
                                    class="w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg placeholder:text-outline-variant"
                                    placeholder="e.g. Premium Sunset Walk" name="service_name" type="text" />
                            </div>
                            <div class="grid grid-cols-2 gap-8">
                                {{-- <div class="group">
                                    <label
                                        class="block text-xs font-label font-bold text-outline uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">
                                        Category <span class="text-red-500">*</span>
                                    </label>

                                    <select name="category_id[]" multiple
                                        class="w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg cursor-pointer">

                                        <option disabled>Select Category (hold Ctrl / Cmd to select multiple)</option>

                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @empty
                                            <option disabled>No Categories available</option>
                                        @endforelse

                                    </select>
                                </div> --}}

                                <div class="group">
                                    <label
                                        class="block text-xs font-label font-bold text-outline uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">
                                        Category <span class="text-red-500">*</span>
                                    </label>

                                    <div class="relative">

                                        <!-- TAG CONTAINER -->
                                        <div id="categoryBox"
                                            class="flex flex-wrap gap-2 py-2 border-b border-outline-variant/30 min-h-[50px] items-center cursor-text">

                                            <!-- tags will appear here -->

                                            <input id="categoryInput" name="category_id"
                                                class="bg-transparent border-none p-0 focus:ring-0 text-lg placeholder:text-outline-variant/50 flex-1 min-w-[80px]"
                                                placeholder="+ Add category" type="text" />
                                        </div>

                                        <!-- DROPDOWN ICON -->
                                        <span
                                            class="absolute right-0 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline-variant pointer-events-none">
                                            expand_more
                                        </span>

                                        <!-- ✅ DROPDOWN MUST BE INSIDE RELATIVE -->
                                        <div id="categoryDropdown"
                                            class="hidden absolute bg-white shadow-lg w-full mt-1 max-h-60 overflow-auto border rounded-md z-50">

                                            @forelse ($categories as $category)
                                                <div class="px-4 py-2 hover:bg-gray-100 cursor-pointer category-item"
                                                    data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                                                    {{ $category->name }}
                                                </div>
                                            @empty
                                                <div class="px-4 py-2 text-gray-400 cursor-not-allowed">
                                                    No Categories available
                                                </div>
                                            @endforelse

                                        </div>
                                    </div>

                                    <!-- ✅ FIXED: UNIQUE ID -->
                                    <div id="categoryHidden"></div>
                                </div>



                                <div class="group">
                                    <label
                                        class="block text-xs font-label font-bold text-outline uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">
                                        Species <span class="text-red-500">*</span>
                                    </label>

                                    <div class="relative">

                                        <!-- TAG CONTAINER -->
                                        <div id="speciesBox"
                                            class="flex flex-wrap gap-2 py-2 border-b border-outline-variant/30 min-h-[50px] items-center cursor-text">

                                            <input id="speciesInput" name="species_id"
                                                class="bg-transparent border-none p-0 focus:ring-0 text-lg placeholder:text-outline-variant/50 flex-1 min-w-[80px]"
                                                placeholder="+ Add species" type="text" />
                                        </div>

                                        <!-- ICON -->
                                        <span
                                            class="absolute right-0 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline-variant pointer-events-none">
                                            expand_more
                                        </span>

                                        <!-- ✅ DROPDOWN (inside relative) -->
                                        <div id="speciesDropdown"
                                            class="hidden absolute bg-white shadow-lg w-full mt-1 max-h-60 overflow-auto border rounded-md z-50">

                                            @forelse ($species as $specie)
                                                <div class="px-4 py-2 hover:bg-gray-100 cursor-pointer species-item"
                                                    data-id="{{ $specie->id }}" data-name="{{ $specie->species_name }}">
                                                    {{ $specie->species_name }}
                                                </div>
                                            @empty
                                                <div class="px-4 py-2 text-gray-400 cursor-not-allowed">
                                                    No Species available
                                                </div>
                                            @endforelse

                                        </div>
                                    </div>

                                    <!-- ✅ UNIQUE hidden input container -->
                                    <div id="speciesHidden"></div>
                                </div>

                            </div>
                            <div class="grid grid-cols-2 gap-8">
                                <div class="group">
                                    <label
                                        class="block text-xs font-label font-bold text-outline uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">
                                        Company<span class="text-red-500">*</span></label>
                                    <select id="companySelect" name="company_id"
                                        class="w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg cursor-pointer">
                                        <option value="" disabled selected>Select Company</option>
                                        @forelse ($companies as $company)
                                            <option value="{{ $company->id }}"
                                                data-logo="{{ asset($company->brand_logo) }}">
                                                {{ $company->company_name }}
                                            </option>
                                        @empty
                                            <option disabled selected>No companies available</option>
                                        @endforelse
                                    </select>
                                </div>
                                {{-- <div class="group">
                                    <label
                                        class="block text-xs font-label font-bold text-outline uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">Unknown</label>
                                    <select name="species_id"
                                        class="w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg cursor-pointer">

                                        <option value="">Unknown</option>

                                    </select>
                                </div> --}}
                            </div>
                            <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-xl">

                                <!-- TEXT -->
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-on-surface">Publish Immediately</span>
                                    <span class="text-xs text-on-surface-variant">
                                        Make this service visible to all clients upon saving.
                                    </span>
                                </div>

                                <!-- TOGGLE -->
                                <label class="relative inline-flex items-center cursor-pointer">

                                    <!-- ✅ IMPORTANT: Hidden default value -->
                                    <input type="hidden" name="is_published" value="0">

                                    <!-- ✅ Checkbox (actual toggle) -->
                                    <input type="checkbox" name="is_published" value="1" checked class="sr-only peer">

                                    <!-- UI SWITCH -->
                                    <div
                                        class="w-11 h-6 bg-surface-variant rounded-full 
                                            peer-focus:outline-none 
                                            peer-checked:bg-secondary
                                            
                                            after:content-[''] after:absolute 
                                            after:top-[2px] after:left-[2px]
                                            after:bg-white after:border after:border-gray-300
                                            after:rounded-full after:h-5 after:w-5
                                            after:transition-all
                                            
                                            peer-checked:after:translate-x-full 
                                            peer-checked:after:border-white">
                                    </div>
                                </label>

                            </div>
                        </div>
                    </section>
                    <!-- Section 2: Location & Operations -->
                    <section class="glass-card sunlight-shadow rounded-lg p-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 rounded-full bg-teal-50 text-secondary flex items-center justify-center">
                                <span class="material-symbols-outlined" data-icon="location_on">location_on</span>
                            </div>
                            <h3 class="text-xl font-headline font-bold text-on-surface">Location &amp; Pricing</h3>
                        </div>
                        <div class="grid grid-cols-2 gap-x-8 gap-y-10">
                            <div class="group">
                                <label
                                    class="block text-xs font-label font-bold text-outline uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">District</label>
                                <select name="district_id" id="districtSelect"
                                    class="searchable-select w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg cursor-pointer">

                                    <option disabled selected>Select District</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="group">
                                <label
                                    class="block text-xs font-label font-bold text-outline uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">Upazila</label>
                                <select name="upazila_id" id="upazilaSelect"
                                    class="searchable-select w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg cursor-pointer"
                                    disabled>

                                    <option value="" disabled selected>— Select District First —</option>

                                </select>
                            </div>

                            <div class="group">
                                <label
                                    class="block text-xs font-label font-bold text-outline uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">Union</label>
                                <select name="union_id" id="unionSelect"
                                    class="searchable-select w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg cursor-pointer"
                                    disabled>

                                    <option value="" disabled selected>— Select Upazila First —</option>

                                </select>
                            </div>

                            <div class="group col-span-2">
                                <label
                                    class="block text-xs font-label font-bold text-outline uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">Map
                                    Location</label>
                                <div class="relative flex items-center">
                                    <span class="absolute left-0 material-symbols-outlined text-secondary"
                                        data-icon="search_insights">search_insights</span>
                                    <input name="location"
                                        class="w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 pl-8 pr-10 focus:ring-0 focus:border-secondary transition-all text-lg placeholder:text-outline-variant"
                                        placeholder="Enter address or drag pin on map..." type="text" />
                                    <span
                                        class="absolute right-0 material-symbols-outlined text-primary cursor-pointer hover:scale-110 transition-transform"
                                        data-icon="location_on">location_on</span>
                                </div>
                            </div>
                            <div class="space-y-10 col-span-2 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-10">
                                <div class="group">
                                    <label
                                        class="block text-xs font-label font-bold text-outline uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">Base
                                        Price &amp; Timing</label>
                                    <div class="flex items-center gap-4">
                                        <div class="relative flex-1 flex items-center">
                                            <span class="absolute left-0 text-xl font-bold text-primary">$</span>
                                            <input name="base_price"
                                                class="w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 pl-6 pr-0 focus:ring-0 focus:border-secondary transition-all text-2xl font-bold placeholder:text-outline-variant"
                                                placeholder="0.00" type="number" />
                                        </div>
                                        <div class="w-1/3">
                                            <select name="timing"
                                                class="w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg cursor-pointer font-medium">
                                                <option>Hourly</option>
                                                <option>Daily</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="group">
                                    <label
                                        class="block text-xs font-label font-bold text-outline uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">Offer
                                        Price (Optional)</label>
                                    <div class="relative flex items-center">
                                        <span class="absolute left-0 text-xl font-bold text-secondary">$</span>
                                        <input name="offer_price"
                                            class="w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 pl-6 pr-0 focus:ring-0 focus:border-secondary transition-all text-2xl font-bold placeholder:text-outline-variant"
                                            placeholder="0.00" type="number" />
                                    </div>
                                </div>
                            </div>
                            <div class="group col-span-2">
                                <label
                                    class="block text-xs font-label font-bold text-outline uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">Per
                                    Day Available Service (Capacity)</label>
                                <div class="flex items-center gap-4">
                                    <div class="flex-1 relative">
                                        <input name="capacity"
                                            class="w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg placeholder:text-outline-variant"
                                            min="1" placeholder="Enter number of slots" type="number" />
                                        <span
                                            class="absolute right-0 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline-variant/50"
                                            data-icon="groups_3">groups_3</span>
                                    </div>
                                    <span class="text-xs text-on-surface-variant font-medium">Maximum daily clients for
                                        this service.</span>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Right Column: Media & Description -->
                <div class="lg:col-span-5 space-y-10">
                    <!-- Section 3: Media -->
                    <section class="glass-card sunlight-shadow rounded-lg p-8">
                        <div class="flex items-center gap-4 mb-6">
                            <h3 class="text-xl font-headline font-bold text-on-surface">Service Cover</h3>
                        </div>
                        <div
                            class="relative group cursor-pointer overflow-hidden rounded-xl bg-surface-container aspect-video flex flex-col items-center justify-center border-2 border-dashed border-outline-variant/30 hover:border-primary/50 transition-all">
                            <input type="file" id="coverImageInput" name="cover_image"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50" accept="image/*">
                            <img id="coverImagePreview" alt="Service Preview"
                                class="absolute inset-0 w-full h-full object-cover opacity-20 group-hover:scale-105 transition-transform duration-700"
                                data-alt="golden retriever puppy running in a flower meadow at sunset, soft focused warm background with artistic light leaks"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAeEdCLbI1OQVNiMdoC_ZCvI2YAk1KoZSYB8-KYlbXCTxdTMeLUEYEVwAxu6YDftRzna83e5tvV9QSFZRzU1S4eFm6HvehgXtcuZkTmXFYujDWEQ5xs-P3nrPPpsM4kZSPMneIgOhlSeJ8L2qF0r9Eu4gvzG2TzWMxadIaMo2JlxoSbTCYThYd_bdRL0_-Xr6KDwQd1zWabx36KIlzpzDQGXsBg6rYTKTKw-1ErCdOSs5ooJRfgxZiFkBL6LdBvMVUN__3lDWtz6pe" />
                            <div id="uploadTextOverlay"
                                class="z-10 flex flex-col items-center text-center p-6 transition-opacity duration-300">
                                <span class="material-symbols-outlined text-4xl text-primary mb-4"
                                    data-icon="cloud_upload">cloud_upload</span>
                                <p class="font-headline font-bold text-on-surface mb-1">Upload Media</p>
                                <p class="text-xs text-on-surface-variant">Recommended size: 1600x900px</p>
                            </div>
                        </div>
                    </section>
                    <!-- Section 4: Content -->
                    <section
                        class="glass-card sunlight-shadow rounded-lg p-8 flex flex-col h-[calc(100%-24rem)] min-h-[400px]">
                        <div class="flex items-center gap-4 mb-6">
                            <h3 class="text-xl font-headline font-bold text-on-surface">Service Description</h3>
                        </div>
                        <div class="flex-1 group">
                            <textarea
                                class="w-full h-full bg-transparent border-0 border-b border-outline-variant/30 py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-base resize-none leading-relaxed placeholder:text-outline-variant"
                                name="S_description" placeholder="Describe the luxury and care of this service..."></textarea>
                        </div>
                        <div
                            class="mt-4 flex items-center gap-2 text-xs text-outline font-label uppercase tracking-widest">
                            <span class="material-symbols-outlined text-sm" data-icon="auto_awesome">auto_awesome</span>
                            <span>AI Assistant available for drafting</span>
                        </div>
                    </section>
                </div>
            </div>
            
            <!-- Action Footer -->
            <div class="sticky bottom-8 z-30">
                <div
                    class="glass-card sunlight-shadow rounded-full p-4 flex items-center justify-between max-w-2xl mx-auto border-opacity-40">
                    <a href="{{ route('serviceManagement') }}"
                        class="px-8 py-3 text-on-surface-variant font-headline font-bold hover:text-on-surface transition-colors"
                        type="button">
                        Cancel
                    </a>
                    <button
                        class="px-10 py-3 bg-primary text-on-primary rounded-full font-headline font-extrabold shadow-lg shadow-primary/20 hover:bg-primary-dim active:scale-95 transition-all flex items-center gap-3"
                        type="submit">
                        <span>Save Service</span>
                        <span class="material-symbols-outlined text-xl" data-icon="check_circle">check_circle</span>
                    </button>
                </div>
            </div>
        </form>
    </div>


    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    {{-- Save Form --}}
    <script>
        $(document).ready(function() {

            // Image Preview Logic
            $('#coverImageInput').on('change', function(e) {
                var file = e.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#coverImagePreview')
                            .attr('src', e.target.result)
                            .removeClass('opacity-20')
                            .addClass('opacity-100');
                        $('#uploadTextOverlay').hide();
                    }
                    reader.readAsDataURL(file);
                }
            });

            $('#addServiceForm').on('submit', function(e) {
                e.preventDefault();
                var $form = $(this);
                var $submitBtn = $form.find('button[type="submit"]');
                var originalBtnHtml = $submitBtn.html();

                // Disable submit button
                $submitBtn.prop('disabled', true).html(
                    '<span class="material-symbols-outlined" style="font-variation-settings: \'FILL\' 1;">hourglass_empty</span> Saving...'
                );

                // Use FormData so the cover_image file is included
                var formData = new FormData($form[0]);

                // Append CSRF token
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route('saveService') }}',
                    type: 'POST',
                    data: formData,
                    processData: false, // required for FormData
                    contentType: false, // required for FormData
                    success: function(response) {
                        toastr.success('Saved Successfully!', 'Success', {
                            timeOut: 3000,
                            positionClass: 'toast-top-right'
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        var errorMessage = 'Error saving service. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            var errors = [];
                            $.each(xhr.responseJSON.errors, function(key, msgs) {
                                errors.push(msgs.join(' '));
                            });
                            errorMessage = errors.join('<br>');
                        }
                        toastr.error(errorMessage, 'Error', {
                            timeOut: 4000,
                            positionClass: 'toast-top-right'
                        });
                    },
                    complete: function() {
                        $submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
            });

        });
    </script>

    {{-- TomSelect: Company (with logo rendering) --}}
    <script>
        new TomSelect("#companySelect", {
            create: false,
            openOnFocus: true,
            maxOptions: 100,
            render: {
                option: function(data, escape) {
                    return `
                    <div class="flex items-center gap-2 py-2">
                        <img src="${data.logo}"
                             class="w-6 h-6 rounded object-cover"
                             onerror="this.style.display='none'">
                        <span>${escape(data.text)}</span>
                    </div>`;
                },
                item: function(data, escape) {
                    return `
                    <div class="flex items-center gap-2">
                        <img src="${data.logo}"
                             class="w-5 h-5 rounded object-cover"
                             onerror="this.style.display='none'">
                        <span>${escape(data.text)}</span>
                    </div>`;
                }
            }
        });
    </script>

    {{-- TomSelect: District → Upazila → Union cascade (jQuery AJAX) --}}
    <script>
        // ── District searchable select ──────────────────────────────────
        const districtTS = new TomSelect("#districtSelect", {
            create: false,
            openOnFocus: true,
            maxOptions: 500,
            placeholder: "Select District",
            sortField: {
                field: "text",
                direction: "asc"
            },
            onChange: function(districtId) {
                // Reset upazila and union when district changes
                resetSelect(upazilaTS, '— Select District First —');
                resetSelect(unionTS, '— Select Upazila First —');
                if (districtId) loadUpazilas(districtId);
            }
        });

        // ── Upazila searchable select (starts disabled) ─────────────────
        let upazilaTS = new TomSelect("#upazilaSelect", {
            create: false,
            openOnFocus: true,
            maxOptions: 500,
            placeholder: "Select Upazila",
            sortField: {
                field: "text",
                direction: "asc"
            },
            onChange: function(upazilaId) {
                // Reset union when upazila changes
                resetSelect(unionTS, '— Select Upazila First —');
                if (upazilaId) loadUnions(upazilaId);
            }
        });

        // ── Union searchable select (starts disabled) ───────────────────
        let unionTS = new TomSelect("#unionSelect", {
            create: false,
            openOnFocus: true,
            maxOptions: 500,
            placeholder: "Select Union",
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        // ── Helper: reset a TomSelect to disabled placeholder ───────────
        function resetSelect(ts, placeholderText) {
            ts.disable();
            ts.clear();
            ts.clearOptions();
            ts.addOption({
                value: '',
                text: placeholderText
            });
            ts.refreshOptions(false);
        }

        // ── Helper: populate + enable a TomSelect from a jQuery AJAX response ──
        function populateSelect(ts, items, emptyText) {
            ts.clear();
            ts.clearOptions();
            if (items.length === 0) {
                ts.addOption({
                    value: '',
                    text: emptyText
                });
            } else {
                $.each(items, function(i, item) {
                    ts.addOption({
                        value: item.id,
                        text: item.name
                    });
                });
                ts.enable();
            }
            ts.refreshOptions(false);
        }

        // ── AJAX: fetch upazilas for chosen district ────────────────────
        function loadUpazilas(districtId) {
            upazilaTS.disable();
            upazilaTS.clear();
            upazilaTS.clearOptions();
            upazilaTS.addOption({
                value: '',
                text: 'Loading…'
            });
            upazilaTS.refreshOptions(false);

            $.get('{{ url('admin/upazilas-by-district') }}/' + districtId)
                .done(function(data) {
                    populateSelect(upazilaTS, data, 'No upazilas found');
                })
                .fail(function() {
                    populateSelect(upazilaTS, [], 'Error loading upazilas');
                });
        }

        // ── AJAX: fetch unions for chosen upazila ───────────────────────
        function loadUnions(upazilaId) {
            unionTS.disable();
            unionTS.clear();
            unionTS.clearOptions();
            unionTS.addOption({
                value: '',
                text: 'Loading…'
            });
            unionTS.refreshOptions(false);

            $.get('{{ url('admin/unions-by-upazila') }}/' + upazilaId)
                .done(function(data) {
                    populateSelect(unionTS, data, 'No unions found');
                })
                .fail(function() {
                    populateSelect(unionTS, [], 'Error loading unions');
                });
        }
    </script>

    {{-- Multi-select (Category & Species tags) — jQuery style --}}
    <script>
        function initMultiSelect(config) {
            var $input = $('#' + config.input);
            var $dropdown = $('#' + config.dropdown);
            var $box = $('#' + config.box);
            var $hidden = $('#' + config.hidden);
            var $items = $(config.items);

            var selected = [];

            // Open dropdown on focus
            $input.on('focus', function() {
                $dropdown.removeClass('hidden');
            });

            // Filter items as user types
            $input.on('input', function() {
                var value = $(this).val().toLowerCase();
                $items.each(function() {
                    var match = $(this).data('name').toLowerCase().indexOf(value) !== -1;
                    $(this).toggle(match);
                });
            });

            // Select item on click
            $items.on('click', function() {
                var id = $(this).data('id').toString();
                var name = $(this).data('name');

                if (selected.indexOf(id) !== -1) return;
                selected.push(id);

                // Create tag
                var $tag = $('<span>')
                    .addClass(
                        'px-3 py-1 bg-secondary/10 text-secondary text-sm rounded-full flex items-center gap-1')
                    .html(name + ' <span class="cursor-pointer text-xs">✕</span>');

                // Remove tag on ✕ click
                $tag.find('span').on('click', function() {
                    selected = $.grep(selected, function(i) {
                        return i !== id;
                    });
                    $tag.remove();
                    $hidden.find('input[value="' + id + '"]').remove();
                });

                $input.before($tag);

                // Hidden input for Laravel
                $('<input>')
                    .attr({
                        type: 'hidden',
                        name: config.name,
                        value: id
                    })
                    .appendTo($hidden);

                $input.val('');
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$box.is(e.target) && $box.has(e.target).length === 0 &&
                    !$dropdown.is(e.target) && $dropdown.has(e.target).length === 0) {
                    $dropdown.addClass('hidden');
                }
            });
        }

        // INIT BOTH DROPDOWNS
        $(document).ready(function() {

            // Category
            initMultiSelect({
                input: 'categoryInput',
                dropdown: 'categoryDropdown',
                box: 'categoryBox',
                hidden: 'categoryHidden',
                items: '.category-item',
                name: 'category_id[]'
            });

            // Species
            initMultiSelect({
                input: 'speciesInput',
                dropdown: 'speciesDropdown',
                box: 'speciesBox',
                hidden: 'speciesHidden',
                items: '.species-item',
                name: 'species_id[]'
            });

        });
    </script>


@endsection
