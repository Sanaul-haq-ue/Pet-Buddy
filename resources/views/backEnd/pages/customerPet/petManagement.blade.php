@extends('backEnd.layouts.master')

@section('adminContent')

    <!-- Add New Species Modal Overlay -->
    <div class="modal fade" id="newSpeciesModal" tabindex="-1" aria-hidden="true">
        <div class="species-dialog modal-dialog modal-lg modal-dialog-centered">
            <div class="species-content modal-content rounded-4 shadow-lg border-0">

                <!-- Header -->
                <div class="modal-header border-0">
                    <div>
                        <small class="text-muted fw-semibold text-uppercase"
                            style="font-size: 0.7rem; letter-spacing: 0.08em;">New Registry Entry</small>
                        <h5 class="mb-0 fw-bold">Add New Species</h5>
                    </div>
                    <button id="closeaddBtn" type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Form -->
                <form id="speciesForm" class="modal-form">

                    <div class="modal-body">

                        <!-- Species Name -->
                        <div class="mb-3">
                            <label class="form-label">Species Name</label>
                            <input type="text" name="species_name" class="form-control" placeholder="e.g. Dog" />
                        </div>

                        <!-- Scientific Classification -->
                        <div class="mb-3">
                            <label class="form-label">Scientific Classification</label>
                            <input type="text" name="scientific_classification" class="form-control"
                                placeholder="e.g. Canis lupus familiaris" />
                        </div>

                        <!-- Care Notes -->
                        <div class="mb-1">
                            <label class="form-label">
                                <span class="material-symbols-outlined align-middle me-1" style="font-size: 1rem;"
                                    data-icon="medical_information">medical_information</span>
                                Description &amp; Care Notes
                            </label>
                            <textarea name="care_notes" class="form-control" rows="4"
                                placeholder="Describe dietary needs, exercise requirements, and common health considerations..."></textarea>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="modal-footer border-0">
                        <button id="canceladdBtn" type="button" class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="material-symbols-outlined align-middle">save</span>
                            Save
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>



    <!-- Add New Breed Modal -->
    <div id="addBreedsModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="species-dialog modal-dialog modal-lg modal-dialog-centered">
            <div class="species-content modal-content rounded-4 shadow-lg border-0">

                <!-- Header -->
                <div class="modal-header border-0">
                    <div>
                        <small class="text-muted fw-semibold text-uppercase"
                            style="font-size: 0.7rem; letter-spacing: 0.08em;">New Registry Entry</small>
                        <h5 class="mb-0 fw-bold">Add New Breed</h5>
                    </div>
                    <button id="closeaddBreeds" type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Form -->
                <form id="breedForm" class="modal-form" enctype="multipart/form-data">
                    <div class="modal-body row w-100">

                        <!-- Image Upload -->
                        <div class="col-md-4">
                            <label class="form-label">Breed Image</label>
                            <div class="imageUploadBox position-relative rounded-3 overflow-hidden border border-2 border-dashed d-flex flex-column align-items-center justify-content-center cursor-pointer"
                                id="imageUploadBox" style="height: 140px; background: #f8f9fa;">
                                <img class="imagePreview position-absolute top-0 start-0 w-100 h-100 object-fit-cover opacity-25"
                                    id="imagePreview"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuATGdqly1vergDzNk6U9EtpyoBtJNP_lndE4Z_v4ddX4lhNrneSBQbWbsyz_No7-JCKl5shIiW5jrpnjVFPW7BmhLG7_vZ1zevpNWagwf4P1B8Z7YQZN7LRGhLkLNcEv7Fd4SqNZBIvGX7E_iVAI5auxRrCY8gVgGH8RaUlH32Phs6sUVNlFn6zGgekktrzUh38NICBuIsqfc8dRZMGymkiGyxMkqrmPwnFQriSa1E5fxZVZuc6e7V_6-0bgJ_Eq8mJYjeLsyAcNEUI" />
                                <span class="material-symbols-outlined mb-1">cloud_upload</span>
                                <span class="small text-muted">Upload</span>
                                <input type="file"
                                    class="imageInput position-absolute top-0 start-0 w-100 h-100 opacity-0"
                                    style="cursor: pointer;" accept="image/*" id="imageInput" name="image">
                            </div>
                        </div>

                        <div class="col-md-8 mb-3">
                            <!-- Breed Name -->
                            <div class="mb-1">
                                <label class="form-label">Breed Name</label>
                                <input type="text" name="breed_name" class="form-control" placeholder="e.g. Beagle" />
                            </div>

                            <!-- Species -->
                            <div class="mb-1">
                                <label class="form-label">Species</label>
                                <select id="addBreedSpeciesSelect" name="species_id" class="form-select">
                                    @if ($species)
                                        @foreach ($species as $specie)
                                            <option value="{{ $specie->id }}">{{ $specie->species_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
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
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-1">
                            <label class="form-label">Description &amp; Care Notes</label>
                            <textarea name="description" class="form-control" rows="3"
                                placeholder="Temperament, physical traits, care needs..."></textarea>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" id="cancelAddBreedBtn"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="add-breed-saveBtn btn btn-primary">
                            <span class="material-symbols-outlined align-middle">save</span>
                            Save
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <!-- Edit Breed Modal -->
    <div id="editBreedsModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="species-dialog modal-dialog modal-lg modal-dialog-centered">
            <div class="species-content modal-content rounded-4 shadow-lg border-0">

                <!-- Header -->
                <div class="modal-header border-0">
                    <div>
                        <small class="text-muted fw-semibold text-uppercase"
                            style="font-size: 0.7rem; letter-spacing: 0.08em;">Registry Entry</small>
                        <h5 class="mb-0 fw-bold">Edit Breed</h5>
                    </div>
                    <button id="closeEditBreedM" type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Form -->
                <form id="editBreedForm" class="modal-form" enctype="multipart/form-data">
                    <input type="hidden" id="editBreedId" name="breed_id" value="">

                    <div class="modal-body row w-100">

                        <!-- Image Upload -->
                        <div class="col-md-4">
                            <label class="form-label">Breed Image</label>
                            <div class="imageUploadBox position-relative rounded-3 overflow-hidden border border-2 border-dashed d-flex flex-column align-items-center justify-content-center cursor-pointer"
                                id="editImageUploadBox" style="height: 140px; background: #f8f9fa;">
                                <img class="imagePreview position-absolute top-0 start-0 w-100 h-100 object-fit-cover opacity-25"
                                    id="editBreedImagePreview" alt="Breed image preview"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCgih6bq3mACcgSc2MphDkKQkK-MTZjkHSi2pmYqcT4SmHzAc7GBI6D8fg3FL90R4M-7lrYRj4KPdZ1L7rDXYaRSa1H46ncTf7zp-c6Mne_5uhWVoR8Py5j75PSbq3GxGoZ0xUlDKqPTD2m6iG3PUi-a1Z85dYrF-d3SZV9bPPMA-93-NCCh2JY6RsZakQ27sCy7u8jYl8QNimz93Biy8LTJa7pmkhIjF6BEjpRt3azkzFZjS-o865DtenBGj6-6V_x4btCaI8ACws" />
                                <span class="material-symbols-outlined mb-1">photo_camera</span>
                                <span class="small text-muted">Update Photo</span>
                                <input type="file" class="position-absolute top-0 start-0 w-100 h-100 opacity-0"
                                    style="cursor: pointer;" accept="image/*" id="editImageInput" name="image">
                            </div>
                        </div>

                        <div class="col-md-8 mb-3">
                            <!-- Breed Name -->
                            <div class="mb-1">
                                <label class="form-label">Breed Name</label>
                                <input type="text" id="editBreedName" name="breed_name" class="form-control"
                                    placeholder="e.g. Beagle" value="" />
                            </div>

                            <!-- Species (Read Only) -->
                            <div class="mb-1">
                                <label class="form-label">Species</label>
                                <div class="form-control d-flex align-items-center justify-content-between bg-light"
                                    style="cursor: not-allowed;">
                                    <span id="editBreedSpecies" class="text-muted">—</span>
                                    <span class="material-symbols-outlined text-muted"
                                        style="font-size: 1rem;">lock</span>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="mb-1">
                                <label class="form-label">Status</label>
                                <div class="d-flex gap-3">
                                    <label class="d-flex align-items-center gap-2">
                                        <input type="radio" id="editBreedStatusActive" class="pet_status"
                                            name="status" value="1" />
                                        <span>Active</span>
                                    </label>
                                    <label class="d-flex align-items-center gap-2">
                                        <input type="radio" id="editBreedStatusInactive" class="pet_status"
                                            name="status" value="0" />
                                        <span>Inactive</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-1">
                            <label class="form-label">Description &amp; Care Notes</label>
                            <textarea id="editBreedDescription" name="description" class="form-control" rows="3"
                                placeholder="Temperament, physical traits, care needs..."></textarea>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" id="cancelEditBreedM"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="saveEditBreedBtn" class="btn btn-primary">
                            <span class="material-symbols-outlined align-middle">update</span>
                            update
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>




    <!-- Header Section -->
    <div class="row g-4 mb-5">
        <div class="col-lg-8 registry d-flex justify-content-between align-items-center">
            <div>
                <span class="text-primary fw-bold tracking-widest fs-6 text-uppercase">Registry Overview</span>
                <h2 class="font-headline fs-2 font-headline fw-bolder text-on-surface mt-2">Pet Management</h2>
                <p class="text-on-surface-variant mt-2">Manage the global taxonomy of species and breeds within
                    the
                    Radiant Habitat ecosystem.</p>
            </div>
            <button id="addBtn" class="btn-add-new" type="button" data-bs-toggle="modal"
                data-bs-target="#newSpeciesModal">
                <span class="material-symbols-outlined" data-icon="add">add</span>
                Add New Species
            </button>
        </div>
        <!-- Sidebar / Stats Section -->
        <aside class="registry-sidebar col-lg-4 d-flex flex-column gap-4">
            <div class="bg-secondary-10 rounded-2xl md:rounded-xl p-4 border border-secondary-10">
                <h4 class="font-headline fs-5 fw-bold mb-4">Population Insights</h4>
                <div class="count d-flex flex-column gap-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-sm opacity-70">Total Species</span>
                        <span class="fw-bold fs-4">{{ $totalSpecies }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-sm opacity-70">Total Breeds</span>
                        <span class="fw-bold fs-4">{{ $totalBreeds }}</span>
                    </div>
                </div>
            </div>
        </aside>

    </div>

    <!-- Hierarchical Bento Grid -->
    <div class="row g-4">
        <!-- Species Section: Canine -->
        @foreach ($species as $specie)
            <section class="col-12">

                <!-- Edit Species Modal -->
                <div class="editSpeciesForm modal fade" id="editSpeciesModal{{ $specie->id }}" tabindex="-1"
                    aria-hidden="true">
                    <div class="species-dialog modal-dialog modal-lg modal-dialog-centered">
                        <div class="species-content modal-content rounded-4 shadow-lg border-0">

                            <!-- Header -->
                            <div class="modal-header border-0">
                                <div>
                                    <h5 class="mb-0 fw-bold">Edit Species</h5>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Form -->
                            <form class="editSpeciesForm" action="{{ route('species.update', $specie->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="modal-body">

                                    <!-- Name -->
                                    <div class="mb-3">
                                        <label class="form-label">Species Name</label>
                                        <input type="text" name="species_name" class="form-control"
                                            value="{{ $specie->species_name }}">
                                    </div>

                                    <!-- Scientific -->
                                    <div class="mb-3">
                                        <label class="form-label">Scientific Classification</label>
                                        <input type="text" name="scientific_classification" class="form-control"
                                            value="{{ $specie->scientific_classification }}">
                                    </div>

                                    <!-- Care Notes -->
                                    <div class="mb-3">
                                        <label class="form-label">Care Notes</label>
                                        <textarea name="care_notes" class="form-control" rows="4">{{ $specie->care_notes }}</textarea>
                                    </div>

                                </div>

                                <!-- Footer -->
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="material-symbols-outlined align-middle">save</span>
                                        Update
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <div class="glass-card rounded-4xl p-2 mb-2 position-relative overflow-hidden group">
                    <div
                        class="position-absolute top-0 end-0 translate-middle-y translate-middle-x rounded-circle bg-primary-5">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2 position-relative z-10">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-2xl bg-primary-10 d-flex align-items-center justify-content-center p-3">
                                <span class="material-symbols-outlined text-primary text-xl md:text-3xl"
                                    data-icon="pets">pets</span>
                            </div>
                            <div class="speciesModify d-flex align-items-center justify-content-between w-100">

                                <!-- Left: Title -->
                                <h3 class="font-headline fs-3 fw-bold mb-0">
                                    {{ $specie->species_name }}
                                </h3>

                                <!-- Right: Actions -->
                                <div class="pl-4 pt-2 d-flex align-items-center gap-2">

                                    <!-- Edit -->
                                    <button
                                        class="btn btn-light btn-sm rounded-circle shadow-sm text-primary hover-scale-110"
                                        data-bs-toggle="modal" data-bs-target="#editSpeciesModal{{ $specie->id }}"
                                        title="Edit">
                                        <span class="material-symbols-outlined fs-6">edit</span>
                                    </button>

                                    <!-- Delete -->
                                    <button type="button"
                                        class="btn btn-light btn-sm rounded-circle shadow-sm text-danger hover-scale-110 delete-species-btn"
                                        data-id="{{ $specie->id }}" title="Delete">
                                        <span class="material-symbols-outlined fs-6">delete</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button id="addBreeds" data-specie-id="{{ $specie->id }}" data-bs-toggle="modal"
                            data-bs-target="#addBreedsModal"
                            class="btn rounded-pill border border-2 border-primary-20 text-primary fw-bold hover-bg-primary-5 d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined text-sm" data-icon="add">add</span>
                            <span class="d-none d-md-inline">Add New Breed</span>
                        </button>
                    </div>
                    <div class="breed-main-card row g-2 row-cols-2 row-cols-md-5 relative z-10">
                        <!-- Breed Card -->
                        @php $count = 0; @endphp
                        @foreach ($breeds as $breed)
                            @if ($breed->species_id == $specie->id)
                                @php $count++; @endphp
                                <div class="col bg-white-40 rounded-2xl g-2 cursor-pointer border border-transparent group-item breed-card {{ $count > 5 ? 'hidden' : '' }}"
                                    data-specie-id="{{ $specie->id }}">
                                    <div
                                        class="breed-height ratio ratio-1x1 rounded-2xl overflow-hidden mb-2 position-relative breed-img">
                                        <img class="w-100 h-100 object-fit-cover group-hover/item:scale-110 transition-transform duration-500"
                                            alt="{{ $breed->breed_name }} image"
                                            data-alt="{{ $breed->breed_name }} breed image"
                                            src="{{ $breed->image ? asset($breed->image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuB_IkAcim22G1smrkzGfTl4wiP2em21kEY5402THTUNP42RbV2kcnzZk2TvAkj6Ua5sdP62akZ2zbd_6GkfKizf68pEbiEUUATjLM5YJ0M6MxK_reMap0a5TMfpDX5qYtOwfiWr0MaPH9veI7Oos5wqQeGZwhnKC7-Q9tgs84DoXxr66NaocAaOTQ4pQEC_54C-1XZlvBjYqQuAqI3oLsCdDIb2upe0HwItbGUy2Hxc0YBQaFrVkYB-bOyhRjOrTSVOHN5YQClQ15VL' }}" />
                                        <div
                                            class="breed-action-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center gap-2">
                                            <button type="button"
                                                class="btn editBreedBtn p-2 bg-white-90 text-primary rounded-circle shadow hover-scale-110"
                                                data-breed-id="{{ $breed->id }}"
                                                data-breed-name="{{ $breed->breed_name }}"
                                                data-species-name="{{ $specie->species_name }}"
                                                data-breed-description="{{ e($breed->description) }}"
                                                data-breed-status="{{ $breed->status }}"
                                                data-breed-image="{{ $breed->image ? asset($breed->image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuB_IkAcim22G1smrkzGfTl4wiP2em21kEY5402THTUNP42RbV2kcnzZk2TvAkj6Ua5sdP62akZ2zbd_6GkfKizf68pEbiEUUATjLM5YJ0M6MxK_reMap0a5TMfpDX5qYtOwfiWr0MaPH9veI7Oos5wqQeGZwhnKC7-Q9tgs84DoXxr66NaocAaOTQ4pQEC_54C-1XZlvBjYqQuAqI3oLsCdDIb2upe0HwItbGUy2Hxc0YBQaFrVkYB-bOyhRjOrTSVOHN5YQClQ15VL' }}"
                                                title="Edit">
                                                <span class="material-symbols-outlined text-sm">edit</span>
                                            </button>

                                            <button type="button"
                                                class="btn deleteBreedBtn p-2 bg-white-90 text-error rounded-circle shadow hover-scale-110"
                                                data-breed-id="{{ $breed->id }}" title="Delete">
                                                <span class="material-symbols-outlined text-sm">delete</span>
                                            </button>
                                        </div>
                                    </div>
                                    <h4 class="fw-bold text-on-surface pb-2 px-2">{{ $breed->breed_name }}</h4>
                                    {{-- <p class="fs-6 text-on-surface-variant">Standard / Large</p> --}}
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <button id="viewAllBreeds-{{ $specie->id }}" data-specie-id="{{ $specie->id }}"
                        data-species-name="{{ $specie->species_name }}" data-expanded="false"
                        class="w-100 mt-2 py-2 text-primary fw-bold btn d-flex justify-content-center align-items-center gap-1">
                        <span class="text-sm md:text-xs">View all {{ $specie->species_name }} breeds</span>
                        <span class="material-symbols-outlined text-sm md:text-xs"
                            data-icon="arrow_forward">arrow_forward</span>
                    </button>
                </div>
            </section>
        @endforeach
    </div>


    <!-- Delete Species Modal -->
    <div class="modal fade" id="deleteSpeciesModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">

                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger md:text-2xl text-lg">Delete Species</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-1">
                    <p class="mb-0">
                        Are you sure you want to delete this species? This action cannot be undone.
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        Yes, Delete
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Delete Breed Modal -->
    <div class="modal fade" id="deleteBreedModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">

                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger md:text-2xl text-lg">Delete Breed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body py-1">
                    <p class="mb-0">
                        Are you sure you want to delete this breed? This action cannot be undone.
                    </p>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBreedBtn">
                        Yes, Delete
                    </button>
                </div>

            </div>
        </div>
    </div>








    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            /////////// Save Species
            $('#speciesForm').on('submit', function(event) {
                event.preventDefault();

                var $form = $(this);
                var $button = $form.find('.btn-save-species');
                var originalText = $button.html();

                $button.prop('disabled', true).html('Saving...');

                $.ajax({
                    url: '{{ route('petManagement.saveSpecies') }}',
                    method: 'POST',
                    data: $form.serialize(),

                    success: function(response) {
                        if (response.success) {

                            // ✅ Toastr Success Message
                            toastr.success(response.message || 'Species saved successfully!');

                            $form[0].reset();
                            $('#newSpeciesModal').addClass('hidden');

                            setTimeout(function() {
                                location.reload();
                            }, 1000);

                        } else {
                            // ❌ Toastr Warning/Error
                            toastr.warning(response.message || 'Unable to save species.');
                        }
                    },

                    error: function(xhr) {
                        var message = 'An error occurred while saving the form.';

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            message = Object.values(xhr.responseJSON.errors).flat().join(
                                '<br>');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        // ❌ Toastr Error
                        toastr.error(message);
                    },

                    complete: function() {
                        $button.prop('disabled', false).html(originalText);
                    }
                });
            });

            /////////// Update Species
            $(document).on('submit', '.editSpeciesForm', function(event) {
                event.preventDefault();
                event.stopPropagation();

                var $form = $(this);
                var $button = $form.find('button[type="submit"]');
                var originalText = $button.html();
                $button.prop('disabled', true).html('Updating...');
                var actionUrl = $form.attr('action');

                $.ajax({
                    url: actionUrl,
                    method: 'POST', // Laravel uses POST + PUT spoofing
                    data: $form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message || 'Updated successfully!');
                            $form.closest('.modal').modal('hide');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);

                        } else {
                            toastr.warning(response.message || 'Update failed!');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        var message = 'Something went wrong.';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            message = Object.values(xhr.responseJSON.errors).flat().join(
                                '<br>');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message);
                    },
                    complete: function() {
                        $button.prop('disabled', false).html(originalText);
                    }
                });
            });

            /////////// Delete Species
            let deleteId = null;
            // Open modal & store ID
            $(document).on('click', '.delete-species-btn', function() {
                deleteId = $(this).data('id');
                $('#deleteSpeciesModal').modal('show');
            });

            // Confirm delete
            $('#confirmDeleteBtn').on('click', function() {

                $.ajax({
                    url: `{{ url('admin/species') }}/${deleteId}`,
                    type: 'POST', // 👈 IMPORTANT (not DELETE)
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE' // 👈 THIS tells Laravel it's DELETE
                    },

                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message || 'Species deleted successfully!');
                            $('#deleteSpeciesModal').modal('hide');
                            $(`button.delete-species-btn[data-id="${deleteId}"]`).closest(
                                'section').fadeOut(300,
                                function() {
                                    $(this).remove();
                                });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);

                        } else {
                            toastr.warning(response.message || 'Delete failed!');
                        }
                    },

                    error: function(xhr) {
                        console.log(xhr.responseText); // 👈 ADD THIS FOR DEBUG
                        let message = 'Something went wrong';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        toastr.error(message);
                    }
                });
            });




            /////////// Save/ Edit Breed image upload & preview
            $(document).on('click', '#imageUploadBox', function() {
                $('#imageInput')[0].click();
            });

            $(document).on('click', '#editImageUploadBtn', function() {
                $('#editImageInput')[0].click();
            });

            $(document).on('change', '#imageInput, #editImageInput', function(e) {
                var file = e.target.files[0];
                var previewSelector = $(this).attr('id') === 'editImageInput' ? '#editBreedImagePreview' :
                    '#imagePreview';

                if (file) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $(previewSelector)
                            .attr('src', e.target.result)
                            .removeClass('opacity-20')
                            .addClass('opacity-100');
                    };

                    reader.readAsDataURL(file);
                }
            });

            /////////// Save breed
            $('#breedForm').on('submit', function(event) {
                event.preventDefault();

                var $form = $(this);
                var formData = new FormData(this);
                formData.append('_token', '{{ csrf_token() }}');

                var $submitButton = $form.find('button[type="submit"]');
                var originalText = $submitButton.html();
                $submitButton.prop('disabled', true).html('Saving...');

                $.ajax({
                    url: '{{ route('petManagement.saveBreed') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        if (response.success) {

                            // ✅ Toastr Success
                            toastr.success(response.message || 'Breed saved successfully!');

                            // Reset form
                            $('#addBreedsModal').addClass('hidden');
                            $form[0].reset();

                            $('#imagePreview')
                                .attr('src',
                                    'https://lh3.googleusercontent.com/aida-public/AB6AXuATGdqly1vergDzNk6U9EtpyoBtJNP_lndE4Z_v4ddX4lhNrneSBQbWbsyz_No7-JCKl5shIiW5jrpnjVFPW7BmhLG7_vZ1zevpNWagwf4P1B8Z7YQZN7LRGhLkLNcEv7Fd4SqNZBIvGX7E_iVAI5auxRrCY8gVgGH8RaUlH32Phs6sUVNlFn6zGgekktrzUh38NICBuIsqfc8dRZMGymkiGyxMkqrmPwnFQriSa1E5fxZVZuc6e7V_6-0bgJ_Eq8mJYjeLsyAcNEUI'
                                )
                                .removeClass('opacity-100')
                                .addClass('opacity-20');

                            setTimeout(function() {
                                location.reload();
                            }, 1000);

                        } else {
                            // ❌ Toastr Warning
                            toastr.warning(response.message || 'Unable to save breed.');
                        }
                    },

                    error: function(xhr) {
                        var message = 'An error occurred while saving the breed.';

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            message = Object.values(xhr.responseJSON.errors).flat().join(
                                '<br>');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        // ❌ Toastr Error
                        toastr.error(message);
                    },

                    complete: function() {
                        $submitButton.prop('disabled', false).html(originalText);
                    }
                });
            });

            // Auto-select species when Add New Breed modal opens
            $('#addBreedsModal').on('show.bs.modal', function(event) {
                var specieId = $(event.relatedTarget).data('specie-id');
                if (specieId) {
                    $('#addBreedSpeciesSelect').val(specieId);
                }
            });



            /////////// Update breed
            $('#editBreedForm').on('submit', function(event) {
                event.preventDefault();

                var $form = $(this);
                var breedId = $('#editBreedId').val();
                var formData = new FormData(this);
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('_method', 'PATCH');

                var $submitButton = $form.find('button[type="submit"]');
                var originalText = $submitButton.html();
                $submitButton.prop('disabled', true).html('Saving...');

                $.ajax({
                    url: "{{ url('admin/updateBreed') }}/" + breedId,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        if (response.success) {

                            // ✅ Toastr Success
                            toastr.success(response.message || 'Breed updated successfully!');

                            $('#editBreedsModal').addClass('hidden');

                            setTimeout(function() {
                                location.reload();
                            }, 1000);

                        } else {
                            // ❌ Toastr Warning
                            toastr.warning(response.message || 'Unable to update breed.');
                        }
                    },

                    error: function(xhr) {
                        var message = 'An error occurred while updating the breed.';

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            message = Object.values(xhr.responseJSON.errors).flat().join(
                                '<br>');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        // ❌ Toastr Error
                        toastr.error(message);
                    },

                    complete: function() {
                        $submitButton.prop('disabled', false).html(originalText);
                    }
                });
            });




            // View all breeds toggle
            $(document).on('click', '[id^="viewAllBreeds-"]', function() {
                var $button = $(this);
                var specieId = $button.data('specie-id');
                var speciesName = $button.data('species-name');
                var isExpanded = $button.data('expanded');
                var $extraBreeds = $('.breed-card[data-specie-id="' + specieId + '"]:gt(4)');

                if (isExpanded) {
                    // Fade out then re-add the 'hidden' class
                    $extraBreeds.fadeOut(300, function() {
                        $(this).addClass('hidden');
                    });
                    $button.find('span:first').text('View all ' + speciesName + ' breeds');
                    $button.find('[data-icon="arrow_forward"]').text('arrow_forward');
                    $button.data('expanded', false);
                } else {
                    // Remove 'hidden' class first, then fade in
                    $extraBreeds.removeClass('hidden').hide().fadeIn(300);
                    $button.find('span:first').text('Show less');
                    $button.find('[data-icon="arrow_forward"]').text('arrow_drop_up');
                    $button.data('expanded', true);
                }
            });



            // Open Edit Breed Modal and populate data
            $(document).on('click', '.editBreedBtn', function() {
                var $button = $(this);
                var breedId = $button.data('breed-id');
                var breedName = $button.data('breed-name') || '';
                var speciesName = $button.data('species-name') || '';
                var description = $button.data('breed-description') || '';
                var status = $button.data('breed-status');
                var imageUrl = $button.data('breed-image') ||
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuCgih6bq3mACcgSc2MphDkKQkK-MTZjkHSi2pmYqcT4SmHzAc7GBI6D8fg3FL90R4M-7lrYRj4KPdZ1L7rDXYaRSa1H46ncTf7zp-c6Mne_5uhWVoR8Py5j75PSbq3GxGoZ0xUlDKqPTD2m6iG3PUi-a1Z85dYrF-d3SZV9bPPMA-93-NCCh2JY6RsZakQ27sCy7u8jYl8QNimz93Biy8LTZJa7pmkhIjF6BEjpRt3azkzFZjS-o865DtenBGj6-6V_x4btCaI8ACws';

                $('#editBreedId').val(breedId);
                $('#editBreedName').val(breedName);
                $('#editBreedSpecies').text(speciesName);
                $('#editBreedDescription').val(description);
                $('#editBreedImagePreview').attr('src', imageUrl);

                if (String(status) === '1') {
                    $('#editBreedStatusActive').prop('checked', true);
                } else {
                    $('#editBreedStatusInactive').prop('checked', true);
                }

                updateEditBreedStatusPills();
                // ✅ Replace the old removeClass('hidden') with this
                var editModal = new bootstrap.Modal(document.getElementById('editBreedsModal'));
                editModal.show();
            });

            function updateEditBreedStatusPills() {
                var isActive = $('#editBreedStatusActive').is(':checked');
                var $activeLabel = $('#editBreedStatusActive').closest('label');
                var $inactiveLabel = $('#editBreedStatusInactive').closest('label');

                if (isActive) {
                    $activeLabel.addClass('bg-secondary text-on-secondary').removeClass(
                        'bg-transparent text-outline');
                    $inactiveLabel.addClass('bg-transparent text-outline').removeClass(
                        'bg-secondary text-on-secondary');
                } else {
                    $inactiveLabel.addClass('bg-secondary text-on-secondary').removeClass(
                        'bg-transparent text-outline');
                    $activeLabel.addClass('bg-transparent text-outline').removeClass(
                        'bg-secondary text-on-secondary');
                }
            }

            $(document).on('change', '#editBreedStatusActive, #editBreedStatusInactive', function() {
                updateEditBreedStatusPills();
            });


            $(document).on('click', '#saveEditBreedBtn', function() {
                $('#editBreedForm').submit();
            });



            // Delete breed button
            // =======================
            // DELETE BREED WITH MODAL
            // =======================

            // Store selected breed
            let deleteBreedId = null;
            let $breedCard = null;

            // Open delete modal
            $(document).on('click', '.deleteBreedBtn', function() {
                deleteBreedId = $(this).data('breed-id');
                $breedCard = $(this).closest('.breed-card');

                $('#deleteBreedModal').modal('show');
            });


            // Confirm delete button click
            $('#confirmDeleteBreedBtn').on('click', function() {

                // Safety check (avoid accidental empty delete)
                if (!deleteBreedId) {
                    toastr.error('Invalid breed selected.');
                    return;
                }

                $.ajax({
                    url: "{{ url('admin/deleteBreed') }}/" + deleteBreedId,
                    method: 'DELETE',

                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message || 'Breed deleted successfully!');

                            // Hide modal
                            $('#deleteBreedModal').modal('hide');

                            // Remove UI card smoothly
                            if ($breedCard) {
                                $breedCard.fadeOut(300, function() {
                                    $(this).remove();
                                });
                            }

                            // Reset variables
                            deleteBreedId = null;
                            $breedCard = null;

                        } else {
                            toastr.warning(response.message || 'Unable to delete breed.');
                        }
                    },

                    error: function(xhr) {
                        console.log(xhr.responseText);

                        let message = 'An error occurred while deleting the breed.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        toastr.error(message);
                    }
                });

            });



        });
    </script>
@endsection
