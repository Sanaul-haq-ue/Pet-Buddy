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
                <div class="grid grid-cols-1 gap-y-8">
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
                <div class="flex items-center justify-end gap-6 mt-4 pt-6">
                    <button id="cancelCategoryModal" type="button"
                        class="px-8 py-3 rounded-full text-on-surface-variant font-bold hover:bg-surface-variant/20 transition-all active:scale-95">
                        Cancel
                    </button>
                    <button type="submit"
                        class="bg-gradient-to-r from-primary to-primary-container px-10 py-4 rounded-full text-on-primary font-bold shadow-lg shadow-primary/30 hover:brightness-110 transition-all active:scale-95 flex items-center gap-2">
                        <span class="material-symbols-outlined" data-icon="add"
                            style="font-variation-settings: 'FILL' 1;">add</span>
                        Add Category
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
                <div class="grid grid-cols-1 gap-y-8">
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
                <div class="flex items-center justify-end gap-6 mt-4 pt-6">
                    <button id="cancelEditCategoryModal" type="button"
                        class="px-8 py-3 rounded-full text-on-surface-variant font-bold hover:bg-surface-variant/20 transition-all active:scale-95">
                        Cancel
                    </button>
                    <button type="submit"
                        class="bg-gradient-to-r from-primary to-primary-container px-10 py-4 rounded-full text-on-primary font-bold shadow-lg shadow-primary/30 hover:brightness-110 transition-all active:scale-95 flex items-center gap-2">
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
            <h1 class="text-5xl font-extrabold tracking-tight text-on-surface mb-4">Service Registry</h1>

        </section>


        <div class="grid grid-cols-6 gap-8">
            <!-- Recent Appointments Table -->
            <div class="col-span-4 glass-card rounded-lg overflow-hidden flex flex-col">
                <div class="p-8 pb-4 flex justify-between items-center">
                    <h4 class="text-xl font-headline font-bold tracking-tight">Category</h4>
                    <button id="addCategoryBtn" class="text-sm font-label text-primary hover:underline">Add
                        Category</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left p-4 max-h-[50px] overflow-y-auto">
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
                                    <td colspan="3" class="px-6 py-5 text-center text-sm text-on-surface-variant">
                                        No categories found.
                                    </td>
                                </tr>
                            @else
                                @foreach ($categories as $category)
                                    <tr class="hover:bg-surface-container-lowest/50 transition-colors group">
                                        <td class="px-6 py-5 text-sm">{{ $category->name }}</td>
                                        <td class="px-6 py-5">
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
                                        <td class="px-8 py-5 text-right">
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
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-on-surface">Available Services</h2>
                    <p class="text-stone-500 text-sm">Tailored care programs for every resident.</p>
                </div>
                <a href="{{ route('addService') }}"
                    class="bg-primary text-on-primary px-8 py-3 rounded-full font-bold flex items-center gap-2 hover:bg-primary-dim active:scale-95 transition-all">
                    <span class="material-symbols-outlined" data-icon="add_circle">add_circle</span>
                    Create New Service
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-16">
                <!-- Recent Appointments Table -->
                <div class="col-span-4 glass-card rounded-lg overflow-hidden flex flex-col">

                    <div class="p-8 pb-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                        <!-- LEFT TITLE -->
                        <h4 class="text-xl font-headline font-bold tracking-tight">
                            Services
                        </h4>

                        <!-- RIGHT FILTER AREA -->
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">

                            <!-- 🔍 SEARCH -->
                            <div class="relative w-full sm:w-64">
                                <span
                                    class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline-variant text-lg">
                                    search
                                </span>

                                <input type="text" id="searchService" placeholder="Search services..."
                                    class="w-full pl-10 pr-4 py-2.5 rounded-full bg-surface border border-outline-variant/30 
                                        focus:border-secondary focus:ring-0 text-sm placeholder:text-outline-variant transition-all">
                            </div>

                            <!-- 🏢 COMPANY -->
                            <div class="relative w-full sm:w-44 select-wrapper">

                                <select id="filterCompany"
                                    class="w-full appearance-none pl-4 pr-10 py-2.5 rounded-full bg-surface border border-outline-variant/30 
                                        focus:border-secondary text-sm cursor-pointer">

                                    <option value="">All Companies</option>
                                    <option value="1">Company A</option>
                                    <option value="2">Company B</option>

                                </select>

                                <!-- ONLY CUSTOM ICON -->
                                <span
                                    class="absolute right-3 top-1/2 -translate-y-1/2 
                                        material-symbols-outlined text-outline-variant pointer-events-none">
                                    expand_more
                                </span>

                            </div>

                            <!-- 📂 CATEGORY -->
                            <div class="relative w-full sm:w-44">

                                <select name="category_id" id="filterCategory"
                                    class="w-full appearance-none pl-4 pr-10 py-2.5 rounded-full bg-surface border border-outline-variant/30 
                                        focus:border-secondary text-sm cursor-pointer">

                                    <option value="">All Categories</option>
                                    <option value="1">Grooming</option>
                                    <option value="2">Walking</option>

                                </select>

                                <span
                                    class="absolute right-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline-variant pointer-events-none">
                                    expand_more
                                </span>

                            </div>

                            <!-- 🔄 STATUS -->
                            <div class="relative w-full sm:w-36">

                                <select name="status" id="filterStatus"
                                    class="w-full appearance-none pl-4 pr-10 py-2.5 rounded-full bg-surface border border-outline-variant/30 
                                        focus:border-secondary text-sm cursor-pointer">

                                    <option value="">All Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>

                                </select>

                                <span
                                    class="absolute right-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline-variant pointer-events-none">
                                    expand_more
                                </span>

                            </div>

                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left p-4 max-h-[50px] overflow-y-auto">
                            <thead
                                class="bg-surface-container-low text-on-surface-variant font-label text-[10px] tracking-widest uppercase">
                                <tr>
                                    <th class="px-6 py-4">Service Name</th>
                                    <th class="px-6 py-4">Category</th>
                                    <th class="px-6 py-4">Species</th>
                                    <th class="px-6 py-4">Company Name</th>
                                    <th class="px-6 py-4">Price/Timing</th>
                                    <th class="px-6 py-4">Capacity</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-8 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/10">

                                @foreach ($services as $service)
                                    <tr class="hover:bg-surface-container-lowest/50 transition-colors group"
                                        data-id="{{ $service->id }}">

                                        <td class="px-6 py-5 text-sm">{{ $service->name }}</td>
                                        <td class="px-6 py-5 text-sm">{{ $service->category->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-5 text-sm">{{ $service->species->species_name ?? 'N/A' }}</td>

                                        <td class="px-6 py-5 text-sm">{{ $service->company->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-5 text-sm">{{ $service->base_price ?? 'N/A' }} /
                                            {{ $service->timing ?? 'N/A' }}</td>
                                        <td class="px-6 py-5 text-sm">{{ $service->capacity ?? 'N/A' }}</td>
                                        <td class="px-6 py-5">

                                            <div class="flex items-center gap-1.5 text-secondary">
                                                <span class="w-2 h-2 rounded-full bg-secondary"></span>
                                                <span class="text-xs font-bold">Active</span>
                                            </div>

                                            <div class="flex items-center gap-1.5 text-primary">
                                                <span class="w-2 h-2 rounded-full bg-primary"></span>
                                                <span class="text-xs font-bold">Inactive</span>
                                            </div>

                                        </td>
                                        <td class="px-8 py-5 text-right">

                                            <button type="button"
                                                class="viewServiceBtn p-2 text-stone-400 hover:text-primary transition-colors"
                                                data-id="{{ $service->id }}" data-name="{{ $service->name }}"
                                                data-category="{{ $service->category->name ?? 'N/A' }}"
                                                data-species="{{ $service->species->species_name ?? 'N/A' }}"
                                                data-company="{{ $service->company->company_name ?? 'N/A' }}"
                                                data-price="{{ $service->base_price }}"
                                                data-timing="{{ $service->timing }}"
                                                data-capacity="{{ $service->capacity }}"
                                                data-description="{{ $service->description }}"
                                                data-status="{{ $service->is_published ? 'Active' : 'Inactive' }}">

                                                <span class="material-symbols-outlined">visibility</span>
                                            </button>

                                            <button type="button"
                                                class="p-2 text-stone-400 hover:text-secondary transition-colors">
                                                <span class="material-symbols-outlined">edit</span>
                                            </button>

                                            <button class=" p-2 text-stone-400 hover:text-error transition-colors">
                                                <span class="material-symbols-outlined">delete</span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="mt-4">
                            {{ $categories->links() }}
                        </div> --}}
                    </div>
                </div>
            </div>
            {{-- <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
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
            </div> --}}
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
