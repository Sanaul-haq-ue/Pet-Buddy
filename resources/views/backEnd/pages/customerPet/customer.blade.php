@extends('backEnd.layouts.master')

@section('adminContent')

    <!-- Edit Customer Modal -->
    <div id="editUserModal" class="modal-overlay hidden">
        <div class="modern-modal">

            <!-- HEADER -->
            <div class="modal-header">
                <div>
                    <h4 class="title">Edit Customer</h4>
                    <p class="subtitle">Update customer and pet details</p>
                </div>
                <button id="closeEditUserModal" class="close-btn">✕</button>
            </div>

            <!-- BODY -->
            <div class="modal-body">
                <form id="editParentForm" enctype="multipart/form-data">

                    <!-- USER ID (IMPORTANT) -->
                    <input type="hidden" name="user_id" id="edit_user_id">

                    <!-- PROFILE SECTION -->
                    <div class="profile-section">
                        <div class="profile-box">
                            <img id="editProfilePreview" class="profile-avatar" src="https://via.placeholder.com/80">
                            <input type="file" id="editProfileImageInput" name="profile_image" hidden>
                        </div>

                        <div class="profile-text">
                            <h5>Customer Identity</h5>
                            <button type="button" id="editProfileImageBtn" class="edit-btn">
                                Change Photo
                            </button>
                        </div>
                    </div>

                    <!-- USER FIELDS -->
                    <div class="form-grid">
                        <div class="input-box">
                            <label>First Name *</label>
                            <input type="text" name="first_name" id="edit_first_name">
                        </div>

                        <div class="input-box">
                            <label>Last Name</label>
                            <input type="text" name="last_name" id="edit_last_name">
                        </div>

                        <div class="input-box full">
                            <label>Email *</label>
                            <input type="email" name="email" id="edit_email">
                        </div>

                        <div class="input-box">
                            <label>Phone</label>
                            <input type="text" name="mobile" id="edit_mobile">
                        </div>

                        <div class="input-box">
                            <label>Location</label>
                            <input type="text" name="location" id="edit_location">
                        </div>
                    </div>

                    <!-- PET SECTION -->
                    <div class="section-title">
                        <span>🐾 Pets Information</span>
                    </div>

                    <!-- PET CONTAINER -->
                    <div id="editPetContainer">
                        <!-- Dynamic pets will load here -->
                    </div>

                    <!-- ADD PET -->
                    <button type="button" id="editAddPetBtn" class="add-pet-btn">
                        + Add Another Pet
                    </button>

                </form>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer">
                <button id="cancelEditUserModal" class="btn-cancel">Cancel</button>
                <button id="updateParentBtn" class="btn-save">Update</button>
            </div>

        </div>
    </div>

    <!-- Add Customer Modal -->
    <div id="addNewUserModal" class="modal-overlay hidden">
        <div class="modern-modal">
            <!-- HEADER -->
            <div class="modal-header">
                <div>
                    <h4 class="title">Add Customer</h4>
                    <p class="subtitle">Create a new customer profile with pet details</p>
                </div>
                <button id="closeAddNewUserModal" class="close-btn">✕</button>
            </div>
            <!-- BODY -->
            <div class="modal-body">
                <form id="addParentForm" enctype="multipart/form-data">
                    <!-- PROFILE SECTION -->
                    <div class="profile-section">
                        <div class="profile-box">
                            <div id="profileImagePreview" class="profile-avatar">
                                <span>📷</span>
                            </div>
                            <input type="file" id="profileImageInput" name="profile_image" hidden>
                        </div>
                        <div class="profile-text">
                            <h5>Customer Identity</h5>
                            <button type="button" id="profileImageBtn" class="edit-btn">
                                Upload Photo
                            </button>
                        </div>
                    </div>
                    <!-- USER FIELDS -->
                    <div class="form-grid">
                        <div class="input-box">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" required>
                        </div>
                        <div class="input-box">
                            <label>Last Name</label>
                            <input type="text" name="last_name">
                        </div>
                        <div class="input-box full">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="input-box">
                            <label>Phone</label>
                            <input type="text" name="mobile">
                        </div>
                        <div class="input-box">
                            <label>Location</label>
                            <input type="text" name="location">
                        </div>
                    </div>
                    <!-- PET SECTION HEADER -->
                    <div class="section-title">
                        <span>🐾 Pets Information</span>
                    </div>
                    <!-- PET CONTAINER -->
                    <div id="petContainer">
                        <div class="pet-card">
                            <div class="pet-header">
                                <strong>Add Pet</strong>
                                <button type="button" class="removePetBtn">Remove</button>
                            </div>
                            <div class="pet-top">
                                <img src="https://via.placeholder.com/90" class="pet-preview petImagePreview">
                                <input type="file" class="petImageInput d-none">
                                <button type="button" class="changePetImageBtn">Upload Pet Photo</button>
                            </div>
                            <div class="pet-grid">
                                <input type="text" name="pet_name" placeholder="Pet Name" class="pet_name pet_input">
                                <input type="text" name="pet_age" placeholder="Age" class="pet_age pet_input">
                                <select name="species" class="pet_input species-select">
                                    <option value="">Select Species</option>
                                    @forelse ($species as $specie)
                                        <option value="{{ $specie->id }}">
                                            {{ $specie->species_name }}
                                        </option>
                                    @empty
                                        <option disabled>No species available</option>
                                    @endforelse
                                </select>
                                <select name="breed" class="pet_input breed-select">
                                    <option value="">Select Breed</option>
                                </select>
                            </div>
                            <div class="pet-status">
                                <label><input type="radio" value="1" class="pet_status" checked> Active</label>
                                <label><input type="radio" value="0" class="pet_status"> Inactive</label>
                            </div>
                            <textarea name="pet_description" class="pet_description"placeholder="Pet description..."></textarea>
                        </div>
                    </div>
                    <!-- ADD PET BUTTON -->
                    <button type="button" id="addPetBtn" class="add-pet-btn">
                        + Add Another Pet
                    </button>
                </form>
            </div>
            <!-- FOOTER -->
            <div class="modal-footer">
                <button id="cancelAddNewUserModal" class="btn-cancel">Cancel</button>
                <button id="submitParentBtn" class="btn-save">Save</button>
            </div>
        </div>
    </div>


    <!-- Page Content -->
    <div class="space-y-10">
        <!-- Page Header -->
        <div class="customer-header flex justify-between items-end">
            <div>
                <h3 class="text-4xl font-extrabold text-on-surface tracking-tighter">Customer CRM</h3>
                <p class="text-on-surface-variant font-body mt-2">Managing 1,284 pet parent relationships</p>
            </div>
            <div class="flex gap-3">
                {{-- <button
                    class="px-6 py-2.5 bg-secondary-container text-on-secondary-container rounded-full font-bold text-sm flex items-center gap-2 border border-secondary/10 hover:bg-secondary-fixed-dim transition-all">
                    <span class="material-symbols-outlined text-lg">filter_list</span>
                    Advanced Filters
                </button> --}}
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
        <div x-data="{
            ...crmApp(),
            showSummary: false
        }" class="row g-4 align-items-start">

            <!-- LEFT COLUMN -->
            <div class="col-12 col-lg-7">

                <!-- FILTER -->
                <div class="d-flex justify-content-between align-items-center mb-2 px-2">
                    <h6 class="fw-bold text-muted">Active Pet Parents</h6>

                    <div class="d-flex gap-3 small fw-bold text-secondary flex-wrap">
                        <span @click="filter = 'all'" :class="activeFilter('all')" style="cursor:pointer;">All</span>
                        <span @click="filter = 'new'" :class="activeFilter('new')" style="cursor:pointer;">New</span>
                        <span @click="filter = 'vip'" :class="activeFilter('vip')" style="cursor:pointer;">VIP</span>
                        <span @click="filter = 'standard'" :class="activeFilter('standard')"
                            style="cursor:pointer;">Standard</span>
                        <span @click="filter = 'inactive'" :class="activeFilter('inactive')"
                            style="cursor:pointer;">Inactive</span>
                    </div>
                </div>

                <!-- LIST -->
                <div class="p-3" style="max-height:600px; overflow-y:auto;">
                    @foreach ($users as $user)
                        {{-- @php
                            $userData = [
                                'id' => $user->id,
                                'first_name' => $user->first_name,
                                'last_name' => $user->last_name,
                                'location' => $user->location,
                                'status' => $user->status,
                                'email' => $user->email,
                            ];
                        @endphp --}}
                        <div x-show="checkUser({{ $user->status }}, {{ $user->user_type }})"
                            @click='selectUser(@json($user)); showSummary = true'
                            :class="selectedUser && selectedUser.id === {{ $user->id }} ? 'user-card active' : 'user-card'"
                            class="p-3 mb-3 bg-white">
                            <!-- TOP -->
                            <div class="d-flex justify-content-between">
                                <div class="d-flex gap-3">
                                    <img src="{{ $user->profile_image ? asset($user->profile_image) : asset('default-avatar.png') }}"
                                        class="rounded-circle" style="width:55px;height:55px;object-fit:cover;">
                                    <div>
                                        <h6 class="fw-bold mb-1">
                                            {{ $user->first_name . ' ' . $user->last_name }}
                                        </h6>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            @php
                                                $userTypes = [
                                                    0 => ['label' => 'VIP Parent', 'class' => 'badge-vip'],
                                                    1 => ['label' => 'Standard', 'class' => 'badge-standard'],
                                                    2 => ['label' => 'New Member', 'class' => 'badge-new'],
                                                ];
                                                $type = $userTypes[$user->user_type] ?? [
                                                    'label' => 'Unknown',
                                                    'class' => 'bg-secondary text-white',
                                                ];
                                            @endphp
                                            <span class="badge {{ $type['class'] }}">
                                                {{ $type['label'] }}
                                            </span>
                                            <small class="text-muted">📍 {{ $user->location }}</small>
                                            <small class="text-success fw-bold">
                                                ● {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted">Last Visit</small><br>
                                    <strong>
                                        {{ $user->last_visit ? $user->last_visit->format('M d, Y') : 'Never' }}
                                    </strong>
                                </div>
                            </div>

                            <!-- BOTTOM -->
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                                @php
                                    $pets = $user->pets;
                                    $visiblePets = $pets->take(2);
                                    $remaining = $pets->count() - 2;
                                @endphp
                                <!-- PETS -->
                                <div class="d-flex align-items-center">
                                    @foreach ($visiblePets as $pet)
                                        <img class="pet-avatar"
                                            src="{{ $pet->pet_image ? asset($pet->pet_image) : asset('default-pet.png') }}">
                                    @endforeach
                                    @if ($remaining > 0)
                                        <div
                                            class="pet-avatar d-flex align-items-center justify-content-center bg-light small">
                                            +{{ $remaining }}
                                        </div>
                                    @endif
                                </div>

                                <!-- ACTIONS -->
                                <div class="d-flex gap-2">
                                    <a :href="'mailto:' + (selectedUser?.email || '')" class="btn btn-sm btn-light">✉</a>
                                    <button class="btn btn-sm btn-light">📞</button>
                                    <button type="button" class="editBtn btn btn-sm btn-light"
                                        @click='openEditModal(@json($user))'>
                                        ✎
                                    </button>

                                    <button type="button" class="deleteCustomerBtn btn btn-sm btn-light text-danger"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->first_name }} {{ $user->last_name }}">
                                        🗑
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            </div>

            <div class="col-12 col-lg-5 position-sticky" style="top:90px;">
                <!-- Desktop -->
                <div class="d-none d-lg-block summary-card bg-white p-4">

                    <!-- HEADER -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="fw-bold mb-0">Parent Summary</h5>
                            <button class="btn btn-link fw-bold p-0"
                                x-text="selectedUser 
                                ? selectedUser.first_name + ' ' + selectedUser.last_name 
                                : 'Profile Name'">
                            </button>
                        </div>
                        <!-- PROFILE IMAGE (RIGHT SIDE) -->
                        <img :src="selectedUser?.profile_image ?
                            '{{ url('/') }}/' + selectedUser.profile_image :
                            '{{ asset('backAssets/upload/userImage/default-avatar.png') }}'"
                            style="width:60px; height:60px; border-radius:50%; object-fit:cover;">
                    </div>
                    <!-- LOCATION -->
                    <small class="text-uppercase text-muted fw-bold d-block mb-2"
                        x-text="selectedUser?.location || 'Location'">
                    </small>
                    <!-- EMAIL + PHONE SIDE BY SIDE -->
                    <div class="d-flex gap-3 mb-3">
                        <small class="text-muted">
                            ✉ <span x-text="selectedUser?.email || 'Email'"></span>
                        </small>
                        <small class="text-muted">
                            📞 <span x-text="selectedUser?.mobile || 'Phone'"></span>
                        </small>
                    </div>

                    <!-- PET CARDS -->
                    <div class="d-flex flex-column gap-3">
                        {{-- <pre x-text="JSON.stringify(selectedUser, null, 2)"></pre> --}}

                        <template x-if="selectedUser && selectedUser.pets?.length">
                            <template x-for="pet in selectedUser.pets" :key="pet.id">

                                <div class="pet-box d-flex align-items-center gap-3">

                                    <!-- PET IMAGE -->
                                    <img class="pet-img"
                                        :src="pet.pet_image ?
                                            '{{ url('/') }}/' + pet.pet_image :
                                            'https://via.placeholder.com/50'">

                                    <div class="flex-grow-1">

                                        <!-- NAME + STATUS -->
                                        <div class="d-flex justify-content-between">
                                            <strong x-text="pet.pet_name"></strong>

                                            <!-- ACTIVE / INACTIVE -->
                                            <span class="badge-status"
                                                :class="pet.status == 1 ? 'badge-stable' : 'badge-follow'"
                                                x-text="pet.status == 1 ? 'ACTIVE' : 'INACTIVE'">
                                            </span>
                                        </div>

                                        <!-- SPECIES / BREED -->
                                        <small class="text-muted d-block">
                                            <span x-text="pet.species?.species_name || 'Species'"></span> /
                                            <span x-text="pet.breed?.breed_name || 'Breed'"></span>
                                        </small>

                                        <!-- EXTRA STATUS (YOUR GIVEN CODE) -->
                                        <span class="badge-status badge-stable">STABLE</span>

                                    </div>
                                </div>

                            </template>
                        </template>

                        <!-- EMPTY -->
                        <div x-show="!selectedUser || !selectedUser.pets?.length" class="text-muted text-center">
                            No pets available
                        </div>

                    </div>

                </div>
                <!-- MOBILE OVERLAY -->
                <div x-show="showSummary" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full" class="mobile-summary-overlay d-lg-none">

                    <div class="mobile-summary-content">

                        <!-- SIDE DRAWER HANDLE -->
                        <div class="summary-side-handle" @click="showSummary = false">
                            <span class="material-symbols-outlined">
                                arrow_forward_ios
                            </span>
                        </div>

                        <!-- YOUR OLD CONTENT -->
                        <div class="summary-card bg-white p-4">

                            <!-- HEADER -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h5 class="fw-bold mb-0">Parent Summary</h5>

                                    <button class="btn btn-link fw-bold p-0"
                                        x-text="selectedUser 
                        ? selectedUser.first_name + ' ' + selectedUser.last_name 
                        : 'Profile Name'">
                                    </button>
                                </div>

                                <img :src="selectedUser?.profile_image ?
                                    '{{ url('/') }}/' + selectedUser.profile_image :
                                    '{{ asset('backAssets/upload/userImage/default-avatar.png') }}'"
                                    style="width:60px; height:60px; border-radius:50%; object-fit:cover;">
                            </div>

                            <small class="text-uppercase text-muted fw-bold d-block mb-2"
                                x-text="selectedUser?.location || 'Location'">
                            </small>

                            <div class="d-flex gap-3 mb-3">
                                <small class="text-muted">
                                    ✉ <span x-text="selectedUser?.email || 'Email'"></span>
                                </small>

                                <small class="text-muted">
                                    📞 <span x-text="selectedUser?.mobile || 'Phone'"></span>
                                </small>
                            </div>

                            <!-- PETS -->
                            <div class="d-flex flex-column gap-3">

                                <template x-if="selectedUser && selectedUser.pets?.length">
                                    <template x-for="pet in selectedUser.pets" :key="pet.id">

                                        <div class="pet-box d-flex align-items-center gap-3">

                                            <img class="pet-img"
                                                :src="pet.pet_image ?
                                                    '{{ url('/') }}/' + pet.pet_image :
                                                    'https://via.placeholder.com/50'">

                                            <div class="flex-grow-1">

                                                <div class="d-flex justify-content-between">
                                                    <strong x-text="pet.pet_name"></strong>

                                                    <span class="badge-status"
                                                        :class="pet.status == 1 ? 'badge-stable' : 'badge-follow'"
                                                        x-text="pet.status == 1 ? 'ACTIVE' : 'INACTIVE'">
                                                    </span>
                                                </div>

                                                <small class="text-muted d-block">
                                                    <span x-text="pet.species?.species_name || 'Species'"></span> /
                                                    <span x-text="pet.breed?.breed_name || 'Breed'"></span>
                                                </small>

                                                <span class="badge-status badge-stable">STABLE</span>

                                            </div>

                                        </div>

                                    </template>
                                </template>

                                <div x-show="!selectedUser || !selectedUser.pets?.length" class="text-muted text-center">
                                    No pets available
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Customer Modal -->
    <div class="modal fade" id="deleteCustomerModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">

                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger">Delete Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p id="deleteCustomerText">
                        Are you sure?
                    </p>
                </div>

                <div class="modal-footer border-0">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" id="confirmDeleteCustomerBtn">
                        Yes, Delete
                    </button>
                </div>

            </div>
        </div>
    </div>



    <script type="text/template" id="editPetTemplate">
        <div class="pet-card">
            <input type="hidden" name="pet_id[]" value="__PET_ID__">

            <div class="pet-header">
                <strong>Edit Pet</strong>
                <button type="button" class="removePetBtn">Remove</button>
            </div>

            <div class="pet-top">
                <img src="__PET_IMAGE__" class="pet-preview petImagePreview">
                <input type="file" class="petImageInput d-none" name="pet_image[]">
                <button type="button" class="changePetImageBtn">Change Photo</button>
            </div>

            <div class="pet-grid">
                <input type="text" name="pet_name[]" value="__PET_NAME__" placeholder="Pet Name" class="pet_input">
                <input type="text" name="pet_age[]" value="__PET_AGE__" placeholder="Age" class="pet_input">

                <select name="species[]" class="pet_input species-select">
                    __SPECIES_OPTIONS__
                </select>

                <select name="breed[]" class="pet_input breed-select">
                    __BREED_OPTIONS__
                </select>
            </div>

            <div class="pet-status">
                <label><input type="radio" name="status___INDEX__" value="1" __ACTIVE__> Active</label>
                <label><input type="radio" name="status___INDEX__" value="0" __INACTIVE__> Inactive</label>
            </div>

            <textarea name="pet_description[]">__DESCRIPTION__</textarea>
        </div>
    </script>


    <script id="speciesData" type="application/json">
    @json($species)
</script>




    <script>
        // User show and filter logic with Alpine.js
        function crmApp() {
            return {
                selectedUser: null,
                filter: 'all',
                selectUser(user) {
                    this.selectedUser = user;
                },
                activeFilter(type) {
                    return this.filter === type ?
                        'text-primary border-bottom border-2 border-primary' :
                        '';
                },
                checkUser(status, type) {
                    if (this.filter === 'all') return status === 1;
                    if (this.filter === 'vip') return type === 0;
                    if (this.filter === 'standard') return type === 1;
                    if (this.filter === 'new') return type === 2;
                    if (this.filter === 'inactive') return status === 0;
                    return true;
                }
            }
        }



        // Save User Section 

        // Show the modal
        $('.addBtn').click(function() {
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
        // add anothr pet section
        $(document).on('click', '#addPetBtn', function(e) {
            e.preventDefault();

            let $lastPet = $('.pet-card').last(); // FIXED
            let $newPet = $lastPet.clone(false, false);

            // reset inputs
            $newPet.find('input[type="text"], textarea').val('');
            $newPet.find('input[type="file"]').val('');
            $newPet.find('select').prop('selectedIndex', 0);

            // reset radio
            $newPet.find('input[type="radio"]').prop('checked', false);
            $newPet.find('input[value="1"]').prop('checked', true);

            // reset image
            $newPet.find('.petImagePreview').attr('src', 'https://via.placeholder.com/90');

            $('#petContainer').append($newPet);
        });
        // Remove pet section
        $(document).on('click', '.removePetBtn', function(e) {
            e.preventDefault();
            let $card = $(this).closest('.pet-card');
            if ($('.pet-card').length > 1) {
                $card.remove();
                return;
            }
            // If only 1 pet → CLEAN instead of removing
            $card.find('input[type="text"], textarea').val('');
            $card.find('select').prop('selectedIndex', 0);
            // reset radio properly (IMPORTANT FIX)
            $card.find('input[type="radio"]').prop('checked', false);
            $card.find('input[value="1"]').prop('checked', true);
            // reset image
            $card.find('.petImagePreview').attr('src', 'https://via.placeholder.com/90');
            // reset file input (VERY IMPORTANT)
            $card.find('.petImageInput').val('');
        });

        // Profile Image Upload — ADD modal
        $(document).on('click', '#profileImagePreview, #profileImageBtn', function(e) {
            e.stopPropagation();
            $('#profileImageInput').click();
        });
        // When image is selected, display it instantly — ADD modal
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
        // Profile Image Upload — EDIT modal
        $(document).on('click', '#editProfileImageBtn, #editProfilePreview', function(e) {
            e.stopPropagation();
            $('#editProfileImageInput').click();
        });
        // When edit profile image is selected, display it instantly
        $(document).on('change', '#editProfileImageInput', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    $('#editProfilePreview').attr('src', event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
        // Pet Image Upload
        $(document).on('click', '.changePetImageBtn', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).closest('.pet-card').find('.petImageInput').trigger('click');
        });
        // When pet image is selected, display it instantly
        $(document).on('change', '.petImageInput', function() {
            let file = this.files[0];
            if (!file) return;
            let reader = new FileReader();
            let img = $(this).siblings('.petImagePreview'); // safer
            reader.onload = function(e) {
                img.attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        });
        // Select Species → Load Breeds
        const BREED_URL = "{{ url('admin/get-breeds') }}";

        $(document).on('change', '.species-select', function() {
            let speciesID = $(this).val();
            let breedSelect = $(this).closest('.pet-card').find('.breed-select');

            breedSelect.empty();
            breedSelect.append('<option value="">Select Breed</option>');
            if (!speciesID) {
                return;
            }
            $.ajax({
                url: BREED_URL + '/' + speciesID,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data.length === 0) {
                        breedSelect.append('<option disabled>No breed found</option>');
                        return;
                    }
                    $.each(data, function(key, value) {
                        breedSelect.append(
                            `<option value="${value.id}">${value.breed_name}</option>`
                        );
                    });
                },
                error: function() {
                    breedSelect.empty();
                    breedSelect.append('<option disabled>Error loading breeds</option>');
                }
            });
        });

        // formData.append('_token', '{{ csrf_token() }}');
        // formData.append('first_name', $('input[name="first_name"]').val());
        // formData.append('last_name', $('input[name="last_name"]').val());
        // formData.append('email', $('input[name="email"]').val());
        // formData.append('mobile', $('input[name="mobile"]').val());
        // formData.append('location', $('input[name="location"]').val());
        // formData.append('profile_image', $('#profileImageInput')[0].files[0]);

        // Save User
        $(document).on('click', '#submitParentBtn', function() {

            let $btn = $(this);
            let originalText = $btn.html();
            $btn.prop('disabled', true).html('Saving...');

            let form = document.getElementById('addParentForm');
            let formData = new FormData(form);


            $('.pet-card').each(function(index) {

                let $pet = $(this);

                formData.append(`pets[${index}][pet_name]`,
                    $pet.find('.pet_name').val()
                );

                formData.append(`pets[${index}][pet_age]`,
                    $pet.find('.pet_age').val()
                );

                formData.append(`pets[${index}][species]`,
                    $pet.find('.species-select').val()
                );

                formData.append(`pets[${index}][breed]`,
                    $pet.find('.breed-select').val()
                );

                formData.append(`pets[${index}][status]`,
                    $pet.find('.pet_status:checked').val() || 1
                );

                formData.append(`pets[${index}][pet_description]`,
                    $pet.find('.pet_description').val()
                );

                let fileInput = $pet.find('.petImageInput')[0];

                if (fileInput && fileInput.files[0]) {
                    formData.append(`pets[${index}][image]`, fileInput.files[0]);
                }
            });

            $.ajax({
                url: '{{ route('customer.store') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,

                success: function(response) {

                    toastr.success('Success! Parent and pets saved successfully.');
                    $('#addNewUserModal').addClass('hidden');

                    // Reset form
                    $('#addParentForm')[0].reset();
                    $('#profileImagePreview').html('<span>📷</span>');

                    // Reset pets
                    $('.pet-card:not(:first)').remove();

                    let $firstPet = $('.pet-card').first();

                    $firstPet.find('.pet_name').val('');
                    $firstPet.find('.pet_age').val('');
                    $firstPet.find('.pet_description').val('');

                    $firstPet.find('.breed-select')
                        .empty()
                        .append('<option value="">Select Breed</option>');

                    $firstPet.find('.petImagePreview')
                        .attr('src', 'https://via.placeholder.com/90');

                    $firstPet.find('.pet_status').prop('checked', false);
                    $firstPet.find('.pet_status[value="1"]').prop('checked', true);

                    setTimeout(() => location.reload(), 1500);
                },

                error: function(xhr) {

                    console.log(xhr.responseText);

                    let message = 'Something went wrong.';

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON?.errors;
                        if (errors) {
                            message = Object.values(errors).flat().join('<br>');
                        }
                    } else if (xhr.responseJSON?.message) {
                        message = xhr.responseJSON.message;
                    }

                    toastr.error(message);
                },

                complete: function() {
                    $btn.prop('disabled', false).html(originalText);
                }
            });
        });




        // Update User Section

        var selectedUser = null;
        // Edit Modal show data
        function openEditModal(user) {
            // OPEN MODAL
            document.getElementById('editUserModal').classList.remove('hidden');
            // USER INFO
            document.getElementById('edit_user_id').value = user.id || '';
            document.getElementById('edit_first_name').value = user.first_name || '';
            document.getElementById('edit_last_name').value = user.last_name || '';
            document.getElementById('edit_email').value = user.email || '';
            document.getElementById('edit_mobile').value = user.mobile || '';
            document.getElementById('edit_location').value = user.location || '';
            // PROFILE IMAGE
            const baseUrl = '{{ url('/') }}';
            document.getElementById('editProfilePreview').src =
                user.profile_image ?
                baseUrl + '/' + user.profile_image :
                baseUrl + '/backAssets/upload/userImage/default-avatar.png';
            // LOAD SPECIES DATA FROM BLADE
            const speciesList = JSON.parse(document.getElementById('speciesData').textContent);

            function buildSpeciesOptions(selectedId = null) {
                let options = '<option value="">Select Species</option>';

                speciesList.forEach(s => {
                    options += `
                <option value="${s.id}" ${selectedId == s.id ? 'selected' : ''}>
                    ${s.species_name}
                </option>
            `;
                });
                return options;
            }
            // PETS
            let container = document.getElementById('editPetContainer');
            container.innerHTML = '';

            if (user.pets && user.pets.length > 0) {
                // Build all pet cards synchronously, queue breed fetches
                let breedFetches = [];
                user.pets.forEach((pet, index) => {
                    // pet.species & pet.breed are eager-loaded OBJECTS {id, species_name, ...}
                    // Extract just the numeric ID for comparison
                    let speciesId = (pet.species && typeof pet.species === 'object') ? pet.species.id : pet.species;
                    let breedId = (pet.breed && typeof pet.breed === 'object') ? pet.breed.id : pet.breed;

                    let template = document.getElementById('editPetTemplate').innerHTML;

                    template = template
                        .replace('__PET_ID__', pet.id || '')
                        .replace('__PET_NAME__', pet.pet_name || '')
                        .replace('__PET_AGE__', pet.pet_age || '')
                        .replace('__PET_IMAGE__',
                            pet.pet_image ?
                            '{{ url('/') }}' + '/' + pet.pet_image :
                            'https://via.placeholder.com/90'
                        )
                        .replace('__DESCRIPTION__', pet.pet_description ?? '')
                        .replace('__ACTIVE__', pet.status == 1 ? 'checked' : '')
                        .replace('__INACTIVE__', pet.status == 0 ? 'checked' : '')
                        .replace('__SPECIES_OPTIONS__', buildSpeciesOptions(speciesId))
                        .replace('__BREED_OPTIONS__', '<option value="">Loading breeds...</option>')
                        .replace(/__INDEX__/g, index);

                    container.insertAdjacentHTML('beforeend', template);
                    // Queue an async breed fetch for each pet that has a species
                    if (speciesId) {
                        breedFetches.push({
                            index,
                            speciesId,
                            breedId
                        });
                    } else {
                        // No species → just reset the breed dropdown
                        let cards = container.querySelectorAll('.pet-card');
                        if (cards[index]) {
                            cards[index].querySelector('.breed-select').innerHTML =
                                '<option value="">Select Breed</option>';
                        }
                    }
                });

                // Now fetch breeds for each pet asynchronously
                let petCards = container.querySelectorAll('.pet-card');
                breedFetches.forEach(function(item) {
                    let breedSelect = petCards[item.index] ? petCards[item.index].querySelector('.breed-select') :
                        null;
                    if (!breedSelect) return;

                    fetch('{{ url('admin/get-breeds') }}/' + item.speciesId)
                        .then(function(r) {
                            return r.json();
                        })
                        .then(function(breeds) {
                            let html = '<option value="">Select Breed</option>';
                            if (breeds.length === 0) {
                                html += '<option disabled>No breed found</option>';
                            } else {
                                breeds.forEach(function(b) {
                                    // Pre-select if breedId matches
                                    let sel = (item.breedId && String(item.breedId) === String(b.id)) ?
                                        'selected' : '';
                                    html += `<option value="${b.id}" ${sel}>${b.breed_name}</option>`;
                                });
                            }
                            breedSelect.innerHTML = html;
                        })
                        .catch(function() {
                            breedSelect.innerHTML =
                                '<option value="">Select Breed</option><option disabled>Error loading breeds</option>';
                        });
                });

            } else {
                container.innerHTML = `<p class="text-muted">No pets available</p>`;
            }
        }
        // Close modal
        $('#closeEditUserModal, #cancelEditUserModal').click(function() {
            $('#editUserModal').addClass('hidden');
        });

        // Update user + pets
        $(document).on('click', '#updateParentBtn', function(e) {
            e.preventDefault();

            let $btn = $(this);
            let originalText = $btn.html();
            $btn.prop('disabled', true).html('Updating...');

            let formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'POST');
            formData.append('user_id', $('#edit_user_id').val());
            formData.append('first_name', $('#edit_first_name').val());
            formData.append('last_name', $('#edit_last_name').val());
            formData.append('email', $('#edit_email').val());
            formData.append('mobile', $('#edit_mobile').val());
            formData.append('location', $('#edit_location').val());

            // Profile image (only if a new file was chosen)
            let profileFile = $('#editProfileImageInput')[0].files[0];
            if (profileFile) {
                formData.append('profile_image', profileFile);
            }

            // Pets
            $('#editPetContainer .pet-card').each(function(index) {
                let $card = $(this);

                formData.append('pet_id[]', $card.find('input[name="pet_id[]"]').val() || '');
                formData.append('pet_name[]', $card.find('input[name="pet_name[]"]').val() || '');
                formData.append('pet_age[]', $card.find('input[name="pet_age[]"]').val() || '');
                formData.append('species[]', $card.find('select[name="species[]"]').val() || '');
                formData.append('breed[]', $card.find('select[name="breed[]"]').val() || '');
                formData.append('pet_description[]', $card.find('textarea[name="pet_description[]"]')
                    .val() || '');

                // Radio status — each pet uses name="status_INDEX"
                let statusVal = $card.find('input[type="radio"]:checked').val() ?? '1';
                formData.append('status_' + index, statusVal);

                // Pet image (only if a new file was chosen)
                let petFile = $card.find('.petImageInput')[0].files[0];
                if (petFile) {
                    formData.append('pet_image[' + index + ']', petFile);
                }
            });

            $.ajax({
                url: '{{ route('customer.update') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#editUserModal').addClass('hidden');
                    toastr.success(response.message || 'Customer updated successfully!');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                },
                error: function(xhr) {
                    let msg = 'Something went wrong. Please try again.';
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON?.errors;
                        if (errors) msg = Object.values(errors).flat().join('<br>');
                    } else if (xhr.responseJSON?.message) {
                        msg = xhr.responseJSON.message;
                    }
                    toastr.error(msg);
                },
                complete: function() {
                    $btn.prop('disabled', false).html(originalText);
                }
            });
        });

        // ── Delete Customer ──────────────────────────────────────────────
        let deleteUserId = null;

        // OPEN MODAL
        $(document).on('click', '.deleteCustomerBtn', function() {

            deleteUserId = $(this).data('id');
            let name = $(this).data('name');

            $('#deleteCustomerText').html(
                `Are you sure you want to delete <strong>${name}</strong>?<br>
        <small class="text-muted">All associated pets will also be deleted.</small>`
            );

            $('#deleteCustomerModal').modal('show');
        });


        // ROUTE TEMPLATE (IMPORTANT FIX)
        let deleteUrlTemplate = "{{ route('customer.delete', ':id') }}";


        // CONFIRM DELETE
        $('#confirmDeleteCustomerBtn').on('click', function() {

            if (!deleteUserId) return;

            $.ajax({
                url: deleteUrlTemplate.replace(':id', deleteUserId),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success: function(response) {

                    $('#deleteCustomerModal').modal('hide');

                    toastr.success(response.message || 'Deleted successfully');

                    setTimeout(() => location.reload(), 1000);
                },
                error: function(xhr) {

                    console.log(xhr.responseText);

                    toastr.error(
                        xhr.responseJSON?.message || 'Something went wrong'
                    );
                }
            });

        });
    </script>
@endsection
