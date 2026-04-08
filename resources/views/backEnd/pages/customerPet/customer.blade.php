@extends('backEnd.layouts.master')

@section('adminContent')
    <!-- Edit Customer Modal -->
    <div id="editUserModal"
        class="fixed inset-0 bg-stone-900/40 backdrop-blur-sm z-[60] flex items-center justify-center p-4 hidden mx-auto">
        <div class="glass-card w-full max-w-lg rounded-3xl overflow-hidden shadow-2xl border border-white/40 mx-auto">
            <div class="p-8 space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-extrabold text-on-surface tracking-tight">Edit Customer Information</h3>
                    <button type="button" id="closeModal"
                        class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-stone-200/50 transition-colors">
                        <span class="material-symbols-outlined text-stone-500">close</span>
                    </button>
                </div>

                <form id="editUserForm" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-wider text-stone-500 ml-1">First Name</label>
                            <input type="text" id="first_name"
                                class="w-full px-4 py-3 rounded-xl border-none bg-stone-100/50 focus:ring-2 focus:ring-primary/20 text-on-surface font-medium">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-wider text-stone-500 ml-1">Last Name</label>
                            <input type="text" id="last_name"
                                class="w-full px-4 py-3 rounded-xl border-none bg-stone-100/50 focus:ring-2 focus:ring-primary/20 text-on-surface font-medium">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-wider text-stone-500 ml-1">Email
                                Address</label>
                            <input type="email" id="email"
                                class="w-full px-4 py-3 rounded-xl border-none bg-stone-100/50 focus:ring-2 focus:ring-primary/20 text-on-surface font-medium">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold uppercase tracking-wider text-stone-500 ml-1">Mobile
                                Number</label>
                            <input type="tel" id="mobile"
                                class="w-full px-4 py-3 rounded-xl border-none bg-stone-100/50 focus:ring-2 focus:ring-primary/20 text-on-surface font-medium">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-stone-500 ml-1">Location</label>
                        <input type="text" id="location"
                            class="w-full px-4 py-3 rounded-xl border-none bg-stone-100/50 focus:ring-2 focus:ring-primary/20 text-on-surface font-medium">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-stone-500 ml-1">Membership
                            Tier</label>
                        <select id="user_type"
                            class="w-full px-4 py-3 rounded-xl border-none bg-stone-100/50 focus:ring-2 focus:ring-primary/20 text-on-surface font-medium appearance-none">
                            <option value="0">VIP Parent</option>
                            <option value="1">Standard</option>
                            <option value="2">New Member</option>
                            <option value="3">Dormant</option>
                        </select>
                    </div>
                </form>

                <div class="flex gap-3 pt-4">
                    <button id="saveUser"
                        class="flex-1 px-6 py-3 bg-primary text-on-primary rounded-full font-bold text-sm hover:bg-primary-dim transition-all shadow-lg shadow-primary/20">
                        Save Changes
                    </button>
                    <button id="cancelUser"
                        class="px-6 py-3 bg-transparent text-stone-500 rounded-full font-bold text-sm hover:bg-stone-200/40 transition-all border border-stone-200">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>





<!-- Add Customer Modal -->

    <div id="addNewUserModal"
        class="fixed inset-0 bg-stone-900/20 backdrop-blur-md z-[100] flex items-center justify-center p-4 hidden">
        <!-- Glassmorphic Modal Content -->
        <div
            class="glass-card w-full max-w-2xl max-h-[921px] overflow-y-auto rounded-xl shadow-[0_20px_40px_rgba(148,76,0,0.06)] flex flex-col h-[90vh]">
            <!-- Header -->
            <div class="flex justify-between items-center px-8 py-6 border-b border-outline-variant/10">
                <h2 class="text-2xl font-headline font-bold text-on-surface tracking-tight">Add New Parent</h2>
                <button id="closeAddNewUserModal"
                    class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-surface-variant/40 transition-colors">
                    <span class="material-symbols-outlined text-on-surface-variant">close</span>
                </button>
            </div>
            <div class="p-8 flex flex-col gap-10">
                <form id="addParentForm" enctype="multipart/form-data">
                    <!-- Parent Info Section -->
                    <section class="flex flex-col gap-6">
                        <div class="flex items-center gap-6">
                            <div class="relative group">
                                <div class="w-24 h-24 rounded-full bg-surface-container-high border-2 border-dashed border-outline-variant/50 flex items-center justify-center overflow-hidden cursor-pointer profileImagePreview"
                                    id="profileImagePreview">
                                    <span class="material-symbols-outlined text-outline text-3xl">add_a_photo</span>
                                </div>
                                <button type="button"
                                    class="absolute bottom-0 right-0 bg-primary text-on-primary w-8 h-8 rounded-full flex items-center justify-center shadow-lg transform translate-x-1 translate-y-1 profileImageBtn"
                                    id="profileImageBtn">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                </button>
                                <input type="file" id="profileImageInput" name="profile_image" class="hidden"
                                    accept="image/*">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-headline font-bold text-lg text-on-surface mb-1">Parent Identity</h3>
                                <p class="text-on-surface-variant text-sm">Upload a profile picture for easier recognition
                                    in
                                    the directory.</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-x-6 gap-y-8">
                            <div class="relative">
                                <label
                                    class="block text-xs font-headline font-bold text-primary tracking-widest uppercase mb-1 ml-1">First
                                    Name</label>
                                <input
                                    class="w-full bg-transparent border-b-2 border-outline-variant/30 focus:border-secondary focus:ring-0 transition-all py-2 font-body text-on-surface placeholder:text-outline-variant/60"
                                    placeholder="e.g. Julianne" type="text" name="first_name" />
                            </div>
                            <div class="relative">
                                <label
                                    class="block text-xs font-headline font-bold text-primary tracking-widest uppercase mb-1 ml-1">Last
                                    Name</label>
                                <input
                                    class="w-full bg-transparent border-b-2 border-outline-variant/30 focus:border-secondary focus:ring-0 transition-all py-2 font-body text-on-surface placeholder:text-outline-variant/60"
                                    placeholder="e.g. Moore" type="text" name="last_name" />
                            </div>
                            <div class="relative col-span-2">
                                <label
                                    class="block text-xs font-headline font-bold text-primary tracking-widest uppercase mb-1 ml-1">Email
                                    Address</label>
                                <input
                                    class="w-full bg-transparent border-b-2 border-outline-variant/30 focus:border-secondary focus:ring-0 transition-all py-2 font-body text-on-surface placeholder:text-outline-variant/60"
                                    placeholder="julianne.moore@example.com" type="email" name="email" />
                            </div>
                            <div class="relative">
                                <label
                                    class="block text-xs font-headline font-bold text-primary tracking-widest uppercase mb-1 ml-1">Phone</label>
                                <input
                                    class="w-full bg-transparent border-b-2 border-outline-variant/30 focus:border-secondary focus:ring-0 transition-all py-2 font-body text-on-surface placeholder:text-outline-variant/60"
                                    placeholder="+1 (555) 000-0000" type="tel" name="mobile" />
                            </div>
                            <div class="relative">
                                <label
                                    class="block text-xs font-headline font-bold text-primary tracking-widest uppercase mb-1 ml-1">Location</label>
                                <input
                                    class="w-full bg-transparent border-b-2 border-outline-variant/30 focus:border-secondary focus:ring-0 transition-all py-2 font-body text-on-surface placeholder:text-outline-variant/60"
                                    placeholder="San Francisco, CA" type="text" name="location" />
                            </div>
                        </div>
                    </section>
                    <!-- Add Pet Section (Expanded) -->
                    <div id="petContainer">
                        <section class="pet-section bg-primary-container/20 rounded-lg p-6 border border-primary/10 mb-2">
                            <div class="flex justify-between items-center mb-6">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="bg-primary text-on-primary w-8 h-8 rounded-full flex items-center justify-center">
                                        <span class="material-symbols-outlined text-sm"
                                            style="font-variation-settings: 'FILL' 1;">pets</span>
                                    </div>
                                    <h3 class="font-headline font-bold text-lg text-on-primary-container">Add Pet</h3>
                                </div>
                                <button type="button"
                                    class="removePetBtn text-primary hover:bg-primary/10 px-3 py-1 rounded-full transition-colors text-sm font-bold">
                                    Remove
                                </button>
                            </div>
                            <div class="grid grid-cols-2 gap-x-6 gap-y-8">
                                <div class="col-span-2 flex items-center gap-6 mb-2">
                                    <img alt="Pet Preview"
                                        class="w-20 h-20 rounded-xl object-cover shadow-sm border-2 border-white petImagePreview"
                                        data-alt="Close-up of a friendly golden retriever dog sitting in a sun-drenched living room with warm lighting"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAMXq-WcOTtW864pcIyxB5535rlFZ207H0RuuZz1NnX-nFUnGjksxaTRcua4dtbLKU_t4G0Kn87ezff7x8TMbN4d7QLWPAODlhT8GPytzhZZVyNxbvd-lqRLtAheiFYohYu3eM4oC1FSooMixAdIRvg3uyaXIh-MPLtlhB3GWV8t4LLAocZcuZrrFSKQvmnJoxWGTqS7U0hEXoxA9ixxtt3gFACFNW7C-e6Kvhll5zQc5kv4r1NINygfSCGH3lOERBTWk78PXXZx-yW" />
                                    <input type="file" name="pet_image" class="petImageInput hidden"
                                        accept="image/*">
                                    <div>
                                        <button type="button"
                                            class="changePetImageBtn bg-surface-container-lowest text-primary px-4 py-2 rounded-full text-xs font-bold border border-primary/20 shadow-sm hover:shadow-md transition-all">
                                            Change Pet Image
                                        </button>
                                    </div>
                                </div>
                                <div class="relative">
                                    <label
                                        class="block text-xs font-headline font-bold text-primary tracking-widest uppercase mb-1 ml-1">Pet
                                        Name</label>
                                    <input
                                        class="w-full bg-transparent border-b-2 border-primary/20 focus:border-primary focus:ring-0 transition-all py-2 font-body text-on-surface placeholder:text-outline-variant/60 pet_name"
                                        placeholder="e.g. Cooper" type="text" name="pet_name" />
                                </div>
                                <div class="relative">
                                    <label
                                        class="block text-xs font-headline font-bold text-primary tracking-widest uppercase mb-1 ml-1">Pet
                                        Age</label>
                                    <input
                                        class="w-full bg-transparent border-b-2 border-primary/20 focus:border-primary focus:ring-0 transition-all py-2 font-body text-on-surface placeholder:text-outline-variant/60 pet_age"
                                        placeholder="e.g. 3 years" type="text" name="pet_age" />
                                </div>
                                <div class="relative">
                                    <label
                                        class="block text-xs font-headline font-bold text-primary tracking-widest uppercase mb-1 ml-1">Category</label>
                                    <select
                                        class="w-full bg-transparent border-b-2 border-primary/20 focus:border-primary focus:ring-0 transition-all py-2 font-body text-on-surface appearance-none pet_category"
                                        name="species">
                                        <option value="Dog">Dog</option>
                                        <option value="Cat">Cat</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="relative">
                                    <label
                                        class="block text-xs font-headline font-bold text-primary tracking-widest uppercase mb-1 ml-1">Sub-Category</label>
                                    <input
                                        class="w-full bg-transparent border-b-2 border-primary/20 focus:border-primary focus:ring-0 transition-all py-2 font-body text-on-surface placeholder:text-outline-variant/60 pet_subcategory"
                                        placeholder="e.g. Golden Retriever" type="text" name="breed" />
                                </div>
                                <div class="relative col-span-2">
                                    <label
                                        class="block text-xs font-headline font-bold text-primary tracking-widest uppercase mb-1 ml-1">Status</label>
                                    <div class="flex gap-4 mt-2">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input checked=""
                                                class="text-secondary focus:ring-secondary border-outline-variant pet_status"
                                                name="status" value="1" type="radio" />
                                            <span class="text-sm font-medium">Active</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input
                                                class="text-secondary focus:ring-secondary border-outline-variant pet_status"
                                                name="status" value="0" type="radio" />
                                            <span class="text-sm font-medium">InActive</span>
                                        </label>
                                        {{-- <label class="flex items-center gap-2 cursor-pointer">
                                        <input class="text-secondary focus:ring-secondary border-outline-variant pet_status"
                                            name="pet_status_0" value="emergency" type="radio" />
                                        <span class="text-sm font-medium">Emergency Lead</span>
                                    </label> --}}
                                    </div>
                                </div>
                                <div class="relative col-span-2">
                                    <label
                                        class="block text-xs font-headline font-bold text-primary tracking-widest uppercase mb-1 ml-1">Description</label>
                                    <textarea
                                        class="w-full bg-transparent border-b-2 border-primary/20 focus:border-primary focus:ring-0 transition-all py-2 font-body text-on-surface placeholder:text-outline-variant/60 resize-none pet_description"
                                        placeholder="Any special requirements, allergies, or temperament notes..." rows="2" name="pet_description"></textarea>
                                </div>
                            </div>
                        </section>
                    </div>
                    <button type="button" id="addPetBtn"
                        class="flex items-center justify-center gap-2 py-4 border-2 border-dashed border-outline-variant/30 rounded-xl text-outline-variant hover:text-primary hover:border-primary/50 hover:bg-primary/5 transition-all group">
                        <span
                            class="material-symbols-outlined group-hover:scale-110 transition-transform">add_circle</span>
                        <span class="font-headline font-bold tracking-tight">Add Another Pet</span>
                    </button>
                </form>
            </div>
            <!-- Action Bar -->
            <div class="px-8 py-6 border-t border-outline-variant/10 flex justify-end gap-4 bg-surface-container-low/50">
                <button id="cancelAddNewUserModal"
                    class="px-8 py-3 rounded-full font-headline font-bold text-on-surface-variant hover:bg-surface-variant/30 transition-all">
                    Cancel
                </button>
                <button type="button" id="submitParentBtn"
                    class="px-10 py-3 rounded-full font-headline font-bold bg-gradient-to-br from-primary to-primary-container text-on-primary shadow-lg hover:shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                    Create Parent
                </button>
            </div>
        </div>
    </div>






    <!-- Page Content -->
    <div class="space-y-10">
        <!-- Page Header -->
        <div class="flex justify-between items-end">
            <div>
                <h3 class="text-4xl font-extrabold text-on-surface tracking-tighter">Customer CRM</h3>
                <p class="text-on-surface-variant font-body mt-2">Managing 1,284 pet parent relationships</p>
            </div>
            <div class="flex gap-3">
                <button
                    class="px-6 py-2.5 bg-secondary-container text-on-secondary-container rounded-full font-bold text-sm flex items-center gap-2 border border-secondary/10 hover:bg-secondary-fixed-dim transition-all">
                    <span class="material-symbols-outlined text-lg">filter_list</span>
                    Advanced Filters
                </button>
                {{-- <button
                    class="addBtn px-6 py-2.5 bg-primary text-on-primary rounded-full font-bold text-sm flex items-center gap-2 hover:bg-primary-dim transition-all shadow-md">
                    <span class="material-symbols-outlined text-lg">person_add</span>
                    Add New Parent
                </button> --}}
                <button class="addBtn btn-add-new">
                    <span class="material-symbols-outlined text-lg">person_add</span>
                    Add New Parent
                </button>
            </div>
        </div>
        <!-- Bento Grid Stats Section -->
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 md:col-span-4 glass-card p-6 rounded-lg relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:scale-110 transition-transform duration-500">
                    <span class="material-symbols-outlined text-8xl text-primary">pets</span>
                </div>
                <p class="text-label-md text-stone-500 font-bold tracking-widest uppercase text-xs">Total Pets</p>
                <h4 class="text-4xl font-black text-on-surface mt-2">2,412</h4>
                <div class="mt-4 flex items-center gap-2 text-secondary font-bold text-sm">
                    <span class="material-symbols-outlined">trending_up</span>
                    <span>+12% from last month</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-4 glass-card p-6 rounded-lg border-l-4 border-secondary">
                <p class="text-label-md text-stone-500 font-bold tracking-widest uppercase text-xs">Active
                    Subscriptions</p>
                <h4 class="text-4xl font-black text-on-surface mt-2">842</h4>
                <div class="mt-4 flex items-center gap-2 text-stone-400 font-bold text-sm">
                    <span class="material-symbols-outlined">info</span>
                    <span>Tier: Premium Care</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-4 glass-card p-6 rounded-lg">
                <p class="text-label-md text-stone-500 font-bold tracking-widest uppercase text-xs">Avg. Visit
                    Frequency</p>
                <h4 class="text-4xl font-black text-on-surface mt-2">14 Days</h4>
                <div class="mt-4 flex items-center gap-2 text-primary font-bold text-sm">
                    <span class="material-symbols-outlined">event_repeat</span>
                    <span>Next cycle begins Monday</span>
                </div>
            </div>
        </div>
        <!-- Main CRM Area: Two-Column Layout -->
        <div x-data="{ selectedUser: null, filter: 'all' }" class="grid grid-cols-12 gap-10 items-start">
            <!-- Left Column: Searchable List -->
            <div class="col-span-12 lg:col-span-7 space-y-4">
                <div class="flex items-center justify-between mb-2 px-2">
                    <h5 class="font-bold text-on-surface-variant">Active Pet Parents</h5>
                    <div class="flex gap-4 text-xs font-bold text-stone-400">
                        <span @click="filter = 'all'"
                            :class="filter === 'all' ? 'text-primary border-b-2 border-primary' : ''"
                            class="cursor-pointer pb-1">
                            All
                        </span>

                        <span @click="filter = 'new'"
                            :class="filter === 'new' ? 'text-primary border-b-2 border-primary' : ''"
                            class="cursor-pointer pb-1">
                            New
                        </span>

                        <span @click="filter = 'vip'"
                            :class="filter === 'vip' ? 'text-primary border-b-2 border-primary' : ''"
                            class="cursor-pointer pb-1">
                            VIP
                        </span>

                        <span @click="filter = 'standard'"
                            :class="filter === 'standard' ? 'text-primary border-b-2 border-primary' : ''"
                            class="cursor-pointer pb-1">
                            Standard
                        </span>

                        <span @click="filter = 'inactive'"
                            :class="filter === 'inactive' ? 'text-primary border-b-2 border-primary' : ''"
                            class="cursor-pointer pb-1">
                            Inactive
                        </span>
                    </div>
                </div>
                <!-- Customer Entries -->
                <div class="space-y-4 p-4 max-h-[600px] overflow-y-auto">

                    <!-- Card 2 -->
                    @foreach ($users as $user)
                        @php
                            $userData = [
                                'id' => $user->id,
                                'first_name' => $user->first_name,
                                'last_name' => $user->last_name,
                                'location' => $user->location,
                                'status' => $user->status,
                                'email' => $user->email,
                            ];
                        @endphp
                        <div x-show=" (filter === 'all' && {{ $user->status }} === 1) ||
                            (filter === 'vip' && {{ $user->user_type }} === 0)
||
                            (filter === 'standard' && {{ $user->user_type }} === 1) ||
                            (filter === 'new' && {{ $user->user_type }} === 2) ||
                            (filter === 'inactive' && {{ $user->status }} === 0)"
                            @click='selectedUser = @json($userData)'
                            :class="selectedUser && selectedUser.id === {{ $user->id }} ? 'ring-2 ring-primary shadow-xl' :
                                ''"
                            class="glass-card p-6 rounded-lg hover:bg-surface-container-lowest/80 cursor-pointer transition-all border border-transparent hover:border-stone-200">
                            <div class="flex items-start justify-between">
                                <div class="flex gap-4">
                                    <img src="{{ $user->profile_image ? asset($user->profile_image) : asset('default-avatar.png') }}"
                                        class="w-14 h-14 rounded-full object-cover border-2 border-transparent"
                                        alt="{{ $user->first_name }}" />
                                    <div>
                                        <h6 class="text-lg font-bold text-on-surface">
                                            {{ $user->first_name . ' ' . $user->last_name }}</h6>
                                        <div class="flex items-center gap-2 mt-1">
                                            @php
                                                $userTypes = [
                                                    0 => [
                                                        'label' => 'VIP Parent',
                                                        'classes' => 'bg-secondary-container/30 text-secondary',
                                                    ],
                                                    1 => [
                                                        'label' => 'Standard',
                                                        'classes' => 'bg-stone-100 text-stone-500',
                                                    ],
                                                    2 => [
                                                        'label' => 'New Member',
                                                        'classes' => 'bg-primary-container/30 text-primary',
                                                    ],
                                                ];
                                                $type = $userTypes[$user->user_type] ?? [
                                                    'label' => 'Unknown',
                                                    'classes' => 'bg-gray-200 text-gray-800',
                                                ];
                                            @endphp
                                            <span
                                                class="px-2 py-0.5 {{ $type['classes'] }} text-[10px] font-black rounded-full tracking-wider uppercase">
                                                {{ $type['label'] }}
                                            </span>
                                            <span class="text-xs text-stone-500 flex items-center gap-1">
                                                <span class="material-symbols-outlined text-sm">location_on</span>
                                                {{ $user->location }}
                                            </span>
                                            <div class="flex items-center gap-1.5 text-secondary">
                                                <span class="w-2 h-2 rounded-full bg-secondary"></span>
                                                <span
                                                    class="text-xs font-bold">{{ $user->status == 1 ? 'Active' : 'Inactive' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-stone-400 font-bold uppercase tracking-wider">Last Visit</p>
                                    <p class="text-sm font-bold text-on-surface mt-0.5">
                                        {{ $user->last_visit ? $user->last_visit->format('M d, Y') : 'Never' }}</p>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-between pt-4 border-t border-stone-100">
                                @php
                                    $pets = $user->pets;
                                    $totalPets = $pets->count();
                                    $visiblePets = $pets->take(2);
                                    $remaining = $totalPets - 2;
                                @endphp

                                <div class="flex -space-x-3 overflow-hidden">

                                    {{-- Show first 2 pet images --}}
                                    @foreach ($visiblePets as $pet)
                                        <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white object-cover"
                                            src="{{ $pet->pet_image ? asset($pet->pet_image) : asset('default-pet.png') }}"
                                            alt="pet" />
                                    @endforeach

                                    {{-- Show +X only if more than 2 --}}
                                    @if ($remaining > 0)
                                        <div
                                            class="flex items-center justify-center h-10 w-10 rounded-full ring-2 ring-white bg-stone-100 text-[10px] font-bold text-stone-500">
                                            +{{ $remaining }}
                                        </div>
                                    @endif

                                </div>
                                <div class="flex items-center gap-3">
                                    <a :href="'mailto:' + (selectedUser?.email || '')"
                                        class="p-2 text-stone-400 hover:text-secondary transition-colors">
                                        <span class="material-symbols-outlined">mail</span>
                                    </a>
                                    <button class="p-2 text-stone-400 hover:text-secondary transition-colors"><span
                                            class="material-symbols-outlined">call</span></button>


                                    {{-- <button class="p-2 text-stone-400 hover:text-secondary transition-colors"><span
                                            class="material-symbols-outlined">edit</span></button> --}}
                                    <button class="editBtn p-2 text-stone-400 hover:text-secondary transition-colors"
                                        data-user='@json($user)'>
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>

                                    <button class="p-2 text-stone-400 hover:text-error transition-colors"><span
                                            class="material-symbols-outlined">delete</span></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
            <!-- Right Column: Summary Detail Panel -->
            <div class="col-span-12 lg:col-span-5 sticky top-24">
                <div class="glass-card p-8 rounded-lg shadow-2xl overflow-hidden relative border-t-8 border-primary">
                    <div class="flex items-center justify-between mb-8">
                        <h5 class="text-xl font-black text-on-surface tracking-tight">Parent Summary</h5>
                        <button class="text-sm font-bold text-primary hover:underline"
                            x-text="selectedUser 
                                ? [selectedUser.first_name, selectedUser.last_name].filter(Boolean).join(' ') 
                                : 'Profile Name'">
                            Profile Name</button>
                    </div>
                    <!-- Pet Health Notes Section -->
                    <div class="space-y-6">
                        <div>
                            <h6 class="text-[10px] font-black uppercase tracking-[0.2em] text-stone-400 mb-4"
                                x-text="selectedUser.location">
                                Pets &amp; Health Status</h6>
                            <div class="space-y-4">
                                <!-- Pet 1 -->
                                <div
                                    class="p-4 bg-surface-container rounded-xl flex items-center gap-4 border-l-4 border-secondary">
                                    <div class="w-12 h-12 rounded-full overflow-hidden shrink-0">
                                        <img class="w-full h-full object-cover"
                                            data-alt="close up of a happy golden retriever puppy outdoors"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuB7M0SKKCdI5h2T_nVVVFXuejxwlsbMjjdbOwLxOHXZ4T5zzf1NuNljlwRAyK5JuI_PG_wib-1tiniBy3IKcvsClmeRijPxAHOiH2jtcaK1y4KJZEHu-7fesuO4OZw8fLBig9L-YF9CduIq-Yz_L5V8Ey4AjKBv1VSnSxNalbmwDV2Dlj_uBsSzlIBfd7Z40llPIDwpo_DZyUimBykvoWk5y5E8fXA1e0-hmdc5871jpUTu0ISv5Nf8crOOb_0pv7Hjw6dru1FzlR1M" />
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <p class="font-bold text-on-surface">Buddy</p>
                                            <span
                                                class="text-[10px] bg-secondary text-on-secondary px-2 rounded-full font-black">STABLE</span>
                                        </div>
                                        <p class="text-xs text-on-surface-variant mt-1">Weight monitoring (74lbs).
                                            Allergic to chicken-based treats.</p>
                                    </div>
                                </div>
                                <!-- Pet 2 -->
                                <div
                                    class="p-4 bg-surface-container rounded-xl flex items-center gap-4 border-l-4 border-primary-fixed">
                                    <div class="w-12 h-12 rounded-full overflow-hidden shrink-0">
                                        <img class="w-full h-full object-cover" data-alt="beautiful ginger cat portrait"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDDufkK06e0ypwE-AM0o_QPKFBzwbHXM6Jlw_BjE4VYZ7iFaoxR9-UP6Xl_F0pEt_NZvcfp_-G_2KlWko2jluFI_KO_bPfsCWyzYvkrtFWhbg5zGHeFHyFFvV4z1kvYBSJvtkjZe63IYUT12LANEzIpCxI6c21Huuuh0_ObVVPmP7hkqUh_Aisx0DuF3qRlJCHCEiuGgJEV2Q_2DZKnwIRk8VOCTK-cY60V1Ks-2UMwXM9E18aCj-xPIljUy7HqMQBLSoLGbVJnGY2m" />
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <p class="font-bold text-on-surface">Miso</p>
                                            <span
                                                class="text-[10px] bg-primary-fixed text-on-primary-fixed px-2 rounded-full font-black">FOLLOW
                                                UP</span>
                                        </div>
                                        <p class="text-xs text-on-surface-variant mt-1">Dental cleaning scheduled
                                            for Oct 24th. Prefers high-moisture diet.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Purchase History Section -->
                        <div>
                            <h6 class="text-[10px] font-black uppercase tracking-[0.2em] text-stone-400 mb-4">
                                Recent Purchase History</h6>
                            <div class="glass-card rounded-xl overflow-hidden border border-stone-100">
                                <table class="w-full text-left text-sm">
                                    <thead class="bg-stone-50 border-b border-stone-100">
                                        <tr>
                                            <th class="px-4 py-2 font-black text-stone-500 text-[10px] uppercase">
                                                Date</th>
                                            <th class="px-4 py-2 font-black text-stone-500 text-[10px] uppercase">
                                                Item</th>
                                            <th
                                                class="px-4 py-2 font-black text-stone-500 text-[10px] uppercase text-right">
                                                Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-stone-50">
                                        <tr>
                                            <td class="px-4 py-3 text-stone-500 font-medium">Oct 12</td>
                                            <td class="px-4 py-3 font-bold text-on-surface">Royal Canine Dry (15kg)
                                            </td>
                                            <td class="px-4 py-3 text-right font-black">$84.50</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-stone-500 font-medium">Sep 28</td>
                                            <td class="px-4 py-3 font-bold text-on-surface">CBD Calming Chews</td>
                                            <td class="px-4 py-3 text-right font-black">$42.00</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-stone-500 font-medium">Sep 14</td>
                                            <td class="px-4 py-3 font-bold text-on-surface">Grooming &amp; Spa
                                                (Buddy)</td>
                                            <td class="px-4 py-3 text-right font-black">$120.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Quick Actions -->
                        <div class="pt-4 grid grid-cols-2 gap-4">
                            <button
                                class="flex items-center justify-center gap-2 py-3 bg-surface-container-high rounded-full font-bold text-xs hover:bg-stone-200 transition-colors">
                                <span class="material-symbols-outlined text-sm">edit_note</span>
                                Add Health Note
                            </button>
                            <button
                                class="flex items-center justify-center gap-2 py-3 bg-surface-container-high rounded-full font-bold text-xs hover:bg-stone-200 transition-colors">
                                <span class="material-symbols-outlined text-sm">receipt_long</span>
                                Create Invoice
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <div id="successOverlay" class="fixed inset-0 z-10 bg-on-surface/5 backdrop-blur-[2px] hidden"></div>
    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center p-6 hidden">
        <div class=" w-full max-w-md rounded-xl p-10 flex flex-col items-center text-center shadow-[0_20px_40px_rgba(148,76,0,0.06)] transform scale-105"
            style="background: beige;">
            <!-- Icon Container with Glow -->
            <div class="mb-8 relative">
                <div class="absolute inset-0 bg-primary/20 blur-2xl rounded-full scale-150"></div>
                <div class="relative w-24 h-24 signature-glow rounded-full flex items-center justify-center shadow-lg">
                    <span class="material-symbols-outlined text-on-primary text-5xl"
                        style="font-variation-settings: 'FILL' 1;">check_circle</span>
                </div>
            </div>
            <!-- Content -->
            <div class="space-y-3 mb-10">
                <h2 class="font-headline text-3xl font-extrabold tracking-tight text-on-surface">Success!</h2>
                <p class="text-body-lg text-on-surface-variant leading-relaxed px-4">
                    Customer information has been updated successfully.
                </p>
            </div>
            <!-- Button -->
            <button
                class="w-full py-4 px-8 signature-glow text-on-primary font-headline font-bold text-lg rounded-full shadow-md active:scale-95 transition-all duration-300 hover:brightness-110">
                Done
            </button>
        </div>
    </div>



    <!-- Pagination (Implicit for "Data-Heavy" feeling) -->
    {{-- <div class="px-10 pb-12 mt-4 flex justify-between items-center text-stone-400">
        <span class="text-xs font-bold uppercase tracking-widest">Showing 1-10 of 1,284 parents</span>
        <button
                class="w-10 h-10 rounded-full border border-stone-200 flex items-center justify-center hover:bg-stone-100 transition-all"><span
                    class="material-symbols-outlined">chevron_left</span></button>
            <span class="px-4 text-sm font-black text-on-surface">1</span>
            <button
                class="w-10 h-10 rounded-full border border-stone-200 flex items-center justify-center hover:bg-stone-100 transition-all text-stone-800"><span
                    class="material-symbols-outlined">chevron_right</span></button>
        <div class="flex items-center gap-2">
            <button
                class="w-10 h-10 rounded-full border border-stone-200 flex items-center justify-center hover:bg-stone-100 transition-all"><span
                    class="material-symbols-outlined">chevron_left</span></button>
            <span class="px-4 text-sm font-black text-on-surface">1</span>
            <button
                class="w-10 h-10 rounded-full border border-stone-200 flex items-center justify-center hover:bg-stone-100 transition-all text-stone-800"><span
                    class="material-symbols-outlined">chevron_right</span></button>
        </div>
    </div> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var selectedUser = null;

        // When edit button is clicked
        $(document).on('click', '.editBtn', function() {
            selectedUser = $(this).data('user'); // Get user data from data-user

            // Fill the form fields with user data
            $('#first_name').val(selectedUser.first_name);
            $('#last_name').val(selectedUser.last_name);
            $('#email').val(selectedUser.email);
            $('#mobile').val(selectedUser.mobile);
            $('#location').val(selectedUser.location);
            $('#user_type').val(selectedUser.user_type);

            // Show the modal
            $('#editUserModal').removeClass('hidden');
        });

        // Close modal
        $('#closeModal, #cancelUser').click(function() {
            $('#editUserModal').addClass('hidden');
        });

        // Save changes AJAX
        $('#saveUser').click(function(e) {
            e.preventDefault();

            if (!selectedUser) return;

            let $btn = $(this); // button reference
            let originalText = $btn.html(); // store original text

            // 👉 Set loading state
            $btn.prop('disabled', true);
            $btn.html('Saving...');

            let formData = {
                id: selectedUser.id,
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                email: $('#email').val(),
                mobile: $('#mobile').val(),
                location: $('#location').val(),
                user_type: $('#user_type').val(),
                _token: '{{ csrf_token() }}',
            };

            $.ajax({
                url: '{{ route('customer.update') }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    $('#editUserModal').addClass('hidden');

                    $('#successOverlay').removeClass('hidden');
                    $('#successModal').removeClass('hidden');

                    setTimeout(function() {
                        $('#successOverlay').addClass('hidden');
                        $('#successModal').addClass('hidden');
                        location.reload();
                    }, 1000);
                },
                error: function(xhr) {
                    alert('Something went wrong!');
                    console.log(xhr.responseText);
                },
                complete: function() {
                    // 👉 Restore button state (runs on both success & error)
                    $btn.prop('disabled', false);
                    $btn.html(originalText);
                }
            });
        });


        $('.addBtn').click(function() {
            // Show the modal
            $('#addNewUserModal').removeClass('hidden');
        });

        // Close modal
        $(document).on('click', '#closeAddNewUserModal, #cancelAddNewUserModal', function() {
            $('#addNewUserModal').addClass('hidden');
        });

        // Close modal only when clicking on the backdrop (not the content)
        $(document).on('click', '#addNewUserModal', function(e) {
            if ($(e.target).is('#addNewUserModal')) {
                $('#addNewUserModal').addClass('hidden');
            }
        });


        $(document).on('click', '#addPetBtn', function(e) {
            e.stopPropagation();
            let $lastPet = $('.pet-section').last();
            let $newPet = $lastPet.clone();
            let newIndex = $('.pet-section').length;

            $newPet.find('input[type="text"], input[type="email"], input[type="tel"], textarea').val('');
            $newPet.find('input[type="radio"]').prop('checked', false);
            $newPet.find('input[type="radio"][value="active"]').prop('checked', true);

            $newPet.find('input[name^="pet_status_"]').each(function() {
                $(this).attr('name', 'pet_status_' + newIndex);
            });

            $newPet.find('.petImagePreview').attr('src',
                'https://lh3.googleusercontent.com/aida-public/AB6AXuAMXq-WcOTtW864pcIyxB5535rlFZ207H0RuuZz1NnX-nFUnGjksxaTRcua4dtbLKU_t4G0Kn87ezff7x8TMbN4d7QLWPAODlhT8GPytzhZZVyNxbvd-lqRLtAheiFYohYu3eM4oC1FSooMixAdIRvg3uyaXIh-MPLtlhB3GWV8t4LLAocZcuZrrFSKQvmnJoxWGTqS7U0hEXoxA9ixxtt3gFACFNW7C-e6Kvhll5zQc5kv4r1NINygfSCGH3lOERBTWk78PXXZx-yW'
            );

            $('#petContainer').append($newPet);
        });

        $(document).on('click', '.removePetBtn', function(e) {
            e.stopPropagation();
            let $section = $(this).closest('.pet-section');

            if ($('.pet-section').length > 1) {
                $section.remove();
            } else {
                $section.find('input[type="text"], input[type="email"], input[type="tel"], textarea').val('');
                $section.find('input[type="radio"]').prop('checked', false);
                $section.find('input[type="radio"][value="active"]').prop('checked', true);
                $section.find('select').prop('selectedIndex', 0);
                $section.find('.petImagePreview').attr('src',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuAMXq-WcOTtW864pcIyxB5535rlFZ207H0RuuZz1NnX-nFUnGjksxaTRcua4dtbLKU_t4G0Kn87ezff7x8TMbN4d7QLWPAODlhT8GPytzhZZVyNxbvd-lqRLtAheiFYohYu3eM4oC1FSooMixAdIRvg3uyaXIh-MPLtlhB3GWV8t4LLAocZcuZrrFSKQvmnJoxWGTqS7U0hEXoxA9ixxtt3gFACFNW7C-e6Kvhll5zQc5kv4r1NINygfSCGH3lOERBTWk78PXXZx-yW'
                );
            }
        });

        // Profile Image Upload - Click on preview or edit button to select image
        $(document).on('click', '#profileImagePreview, #profileImageBtn', function(e) {
            e.stopPropagation();
            $('#profileImageInput').click();
        });

        // When image is selected, display it instantly
        $(document).on('change', '#profileImageInput', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    $('#profileImagePreview').html('<img src="' + event.target.result +
                        '" class="w-full h-full object-cover" alt="Profile">');
                };
                reader.readAsDataURL(file);
            }
        });

        // Pet Image Upload - Click on change button to select image
        $(document).on('click', '.changePetImageBtn', function(e) {
            e.stopPropagation();
            $(this).closest('.pet-section').find('.petImageInput').click();
        });

        // When pet image is selected, display it instantly
        $(document).on('change', '.petImageInput', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                const $petImage = $(this).closest('.pet-section').find('.petImagePreview');
                reader.onload = function(event) {
                    $petImage.attr('src', event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        // Submit Parent Form with AJAX
        $(document).on('click', '#submitParentBtn', function() {
            let $btn = $(this);
            let originalText = $btn.html();
            $btn.prop('disabled', true).html('Saving...');

            let formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('first_name', $('input[name="first_name"]').val());
            formData.append('last_name', $('input[name="last_name"]').val());
            formData.append('email', $('input[name="email"]').val());
            formData.append('mobile', $('input[name="mobile"]').val());
            formData.append('location', $('input[name="location"]').val());
            formData.append('profile_image', $('#profileImageInput')[0].files[0]);

            $('.pet-section').each(function(index) {
                let $pet = $(this);
                let petIndex = index;
                formData.append('pets[' + petIndex + '][pet_name]', $pet.find('input[name="pet_name"]')
                    .val());
                formData.append('pets[' + petIndex + '][pet_age]', $pet.find('input[name="pet_age"]')
                    .val());
                formData.append('pets[' + petIndex + '][species]', $pet.find('select[name="species"]')
                    .val());
                formData.append('pets[' + petIndex + '][breed]', $pet.find('input[name="breed"]').val());
                formData.append(
                    'pets[' + petIndex + '][status]',
                    $pet.find('.pet_status:checked').val() || 1
                );
                formData.append('pets[' + petIndex + '][pet_description]', $pet.find(
                    'textarea[name="pet_description"]').val());
                formData.append('pets[' + petIndex + '][image]', $pet.find('.petImageInput')[0].files[0]);
            });

            $.ajax({
                url: '{{ route('customer.store') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Success! Parent and pets saved successfully.');
                    $('#addNewUserModal').addClass('hidden');
                    location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert(xhr.responseText);
                },
                complete: function() {
                    $btn.prop('disabled', false).html(originalText);
                }
            });
        });
    </script>
@endsection
