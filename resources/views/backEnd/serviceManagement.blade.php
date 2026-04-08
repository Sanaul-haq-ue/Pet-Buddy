@extends('backEnd.layouts.master')

@section('adminContent')
    <div class="fixed inset-0 z-50 flex items-center justify-center px-4 py-10 hidden">
        <div class="absolute inset-0 bg-on-surface/10 backdrop-blur-sm"></div>
        <div
            class="glass-panel w-full max-w-2xl rounded-xl shadow-[0_40px_80px_rgba(148,76,0,0.12)] relative flex flex-col overflow-hidden">
            <!-- Modal Header -->
            <div class="px-10 pt-10 pb-6 flex justify-between items-start">
                <div>
                    <span
                        class="text-xs font-bold tracking-[0.1em] text-primary uppercase mb-2 block font-headline">ADMINISTRATION</span>
                    <h2 class="text-3xl font-bold text-on-surface font-headline leading-tight">Configure Service</h2>
                </div>
                <button
                    class="w-12 h-12 rounded-full flex items-center justify-center text-on-surface-variant hover:bg-surface-variant/40 transition-colors">
                    <span class="material-symbols-outlined" data-icon="close">close</span>
                </button>
            </div>
            <!-- Modal Body / Form -->
            <div class="px-10 pb-10 flex flex-col gap-8">
                <!-- Service Image Mock -->
                <div class="h-48 rounded-lg overflow-hidden relative group">
                    <img class="w-full h-full object-cover"
                        data-alt="serene spa setting with warm wooden textures and soft ambient lighting for a pet grooming service"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuA2VTDp1yO6SU5-YeYvcEaLQvjIxNoTtNZDr2bZJuTb-XwsYBVQm3b59XEOAVQH6I6gwFdvqitVQkrmSHGoo88kWe1Cbkv_rTOdmnji9BZoPnU_AXs8RiaAtwDXzjYDDsHvbLacAcosahKX9_-BmstEyJvFEYs8xyAsHZ1oKQR18o_GUdt46fZgbUWKr_Uh9P-9wPBavefZi0TlQ0J44SHCTl4-0eF1yHRF0lPiJX3-9hjQ84tqOmQ845KED5Dy7YYmUHr5ZKQKzyzy" />
                    <div class="absolute inset-0 bg-gradient-to-t from-on-surface/60 to-transparent flex items-end p-6">
                        <button
                            class="flex items-center gap-2 text-white bg-white/20 backdrop-blur-md px-4 py-2 rounded-full text-sm font-medium hover:bg-white/30 transition-all">
                            <span class="material-symbols-outlined text-sm" data-icon="photo_camera">photo_camera</span>
                            Update Cover Photo
                        </button>
                    </div>
                </div>
                <!-- Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                    <!-- Service Name -->
                    <div class="md:col-span-2">
                        <label
                            class="block text-sm font-bold text-on-surface-variant mb-2 font-headline uppercase tracking-wider">Service
                            Name</label>
                        <input
                            class="w-full bg-transparent border-b border-outline-variant/30 py-3 text-lg text-on-surface focus:outline-none focus:border-secondary transition-all placeholder:text-outline-variant/50"
                            placeholder="e.g., Luxury Golden Grooming" type="text" />
                    </div>
                    <!-- Status Dropdown (Custom UI style) -->
                    <div class="relative">
                        <label
                            class="block text-sm font-bold text-on-surface-variant mb-2 font-headline uppercase tracking-wider">Status</label>
                        <div class="relative">
                            <select
                                class="appearance-none w-full bg-transparent border-b border-outline-variant/30 py-3 pr-8 text-on-surface focus:outline-none focus:border-secondary transition-all cursor-pointer">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="pending">Maintenance</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-0 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant"
                                data-icon="expand_more">expand_more</span>
                        </div>
                    </div>
                    <!-- Category / Species Selection -->
                    <div class="relative">
                        <label
                            class="block text-sm font-bold text-on-surface-variant mb-2 font-headline uppercase tracking-wider">Primary
                            Species</label>
                        <div class="relative">
                            <select
                                class="appearance-none w-full bg-transparent border-b border-outline-variant/30 py-3 pr-8 text-on-surface focus:outline-none focus:border-secondary transition-all cursor-pointer">
                                <option value="dogs">Canine (Dogs)</option>
                                <option value="cats">Feline (Cats)</option>
                                <option value="birds">Avian (Birds)</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-0 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant"
                                data-icon="category">category</span>
                        </div>
                    </div>
                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label
                            class="block text-sm font-bold text-on-surface-variant mb-2 font-headline uppercase tracking-wider">Description</label>
                        <textarea
                            class="w-full bg-transparent border-b border-outline-variant/30 py-3 text-on-surface focus:outline-none focus:border-secondary transition-all placeholder:text-outline-variant/50 resize-none"
                            placeholder="Describe the therapeutic benefits and process..." rows="3"></textarea>
                    </div>
                </div>
                <!-- Modal Footer / Actions -->
                <div class="flex items-center justify-end gap-6 mt-4 pt-6">
                    <button
                        class="px-8 py-3 rounded-full text-on-surface-variant font-bold hover:bg-surface-variant/20 transition-all active:scale-95">
                        Cancel
                    </button>
                    <button
                        class="bg-gradient-to-r from-primary to-primary-container px-10 py-4 rounded-full text-on-primary font-bold shadow-lg shadow-primary/30 hover:brightness-110 transition-all active:scale-95 flex items-center gap-2">
                        <span class="material-symbols-outlined" data-icon="save"
                            style="font-variation-settings: 'FILL' 1;">save</span>
                        Save Service
                    </button>
                </div>
            </div>
        </div>
    </div>











    <div class="px-12 py-10 space-y-16">
        <!-- Header Section -->
        <section class="max-w-4xl">
            <h1 class="text-5xl font-extrabold tracking-tight text-on-surface mb-4">Service &amp; Species Registry</h1>
            <p class="text-lg text-on-surface-variant leading-relaxed max-w-2xl font-body">
                Manage the core offerings of Radiant Sanctuary and maintain accurate biological data for our diverse
                clientele. Configure pricing, duration, and specific breed variations.
            </p>
        </section>
        <!-- Services Section -->
        <section>
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-on-surface">Available Services</h2>
                    <p class="text-stone-500 text-sm">Tailored care programs for every resident.</p>
                </div>
                <button
                    class="bg-primary text-on-primary px-8 py-3 rounded-full font-bold flex items-center gap-2 hover:bg-primary-dim active:scale-95 transition-all">
                    <span class="material-symbols-outlined" data-icon="add_circle">add_circle</span>
                    Create New Service
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                <!-- Full Grooming Card -->
                <div
                    class="glass-card p-8 rounded-lg flex flex-col gap-6 group hover:translate-y-[-4px] transition-all duration-500">
                    <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined text-3xl" data-icon="content_cut">content_cut</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-2">Full Grooming</h3>
                        <p class="text-sm text-stone-500 line-clamp-2">Complete spa treatment including bath, hair trim,
                            nail clipping, and ear cleaning for all small mammals.</p>
                    </div>
                    <div class="mt-auto flex items-center justify-between border-t border-stone-200/30 pt-6">
                        <span class="text-primary font-bold">$65.00+</span>
                        <div class="flex gap-2">
                            <button
                                class="px-4 py-2 rounded-full border border-outline-variant/30 text-stone-600 text-sm font-semibold hover:bg-stone-50 transition-colors">Manage</button>
                            <button class="p-2 text-error hover:bg-error-container/20 rounded-full transition-colors">
                                <span class="material-symbols-outlined" data-icon="delete">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Routine Checkup Card -->
                <div
                    class="glass-card p-8 rounded-lg flex flex-col gap-6 group hover:translate-y-[-4px] transition-all duration-500">
                    <div
                        class="w-14 h-14 bg-secondary-container/30 rounded-2xl flex items-center justify-center text-secondary">
                        <span class="material-symbols-outlined text-3xl" data-icon="stethoscope">stethoscope</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-2">Routine Checkup</h3>
                        <p class="text-sm text-stone-500 line-clamp-2">Bi-annual health evaluation, vital checks, and
                            preventative care consultations for pets of all sizes.</p>
                    </div>
                    <div class="mt-auto flex items-center justify-between border-t border-stone-200/30 pt-6">
                        <span class="text-primary font-bold">$120.00</span>
                        <div class="flex gap-2">
                            <button
                                class="px-4 py-2 rounded-full border border-outline-variant/30 text-stone-600 text-sm font-semibold hover:bg-stone-50 transition-colors">Manage</button>
                            <button class="p-2 text-error hover:bg-error-container/20 rounded-full transition-colors">
                                <span class="material-symbols-outlined" data-icon="delete">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Behavioral Training Card -->
                <div
                    class="glass-card p-8 rounded-lg flex flex-col gap-6 group hover:translate-y-[-4px] transition-all duration-500">
                    <div
                        class="w-14 h-14 bg-tertiary-container/30 rounded-2xl flex items-center justify-center text-tertiary">
                        <span class="material-symbols-outlined text-3xl" data-icon="psychology">psychology</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-2">Behavioral Training</h3>
                        <p class="text-sm text-stone-500 line-clamp-2">Positive reinforcement-based sessions focusing on
                            social skills, anxiety reduction, and basic commands.</p>
                    </div>
                    <div class="mt-auto flex items-center justify-between border-t border-stone-200/30 pt-6">
                        <span class="text-primary font-bold">$85.00 / hr</span>
                        <div class="flex gap-2">
                            <button
                                class="px-4 py-2 rounded-full border border-outline-variant/30 text-stone-600 text-sm font-semibold hover:bg-stone-50 transition-colors">Manage</button>
                            <button class="p-2 text-error hover:bg-error-container/20 rounded-full transition-colors">
                                <span class="material-symbols-outlined" data-icon="delete">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </div>


    <script>
        $('.saveBtn').click(function() {
            // Show the modal
            $('#addNewUserModal').removeClass('hidden');
        });

        // Close modal
        $(document).on('click', '#closeAddNewUserModal, #cancelAddNewUserModal', function() {
            $('#addNewUserModal').addClass('hidden');
        });
    </script>
@endsection
