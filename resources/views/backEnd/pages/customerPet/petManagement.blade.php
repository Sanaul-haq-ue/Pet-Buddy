@extends('backEnd.layouts.master')

@section('adminContent')
    <link rel="stylesheet" href="{{ asset('backAssets/css/petManagement.css') }}" />

    <!-- Add New Species Modal Overlay -->
    <div id="newSpeciesModal" class="modal-overlay hidden">
        <!-- Add New Species Popup (The Glass Modal) -->
        <div class="modal-card">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-header-row">
                    <div>
                        <span class="modal-label">New Registry Entry</span>
                        <h3 class="modal-title">Add New Species</h3>
                    </div>
                    <button id="closeaddBtn" class="modal-close-btn">
                        <span class="material-symbols-outlined icon" data-icon="close">close</span>
                    </button>
                </div>
            </div>
            <!-- Modal Content Form -->
            <form id="speciesForm" class="modal-form">
                <!-- Section 1: Identity -->
                {{-- <div class="form-grid"> --}}
                <!-- Image Upload -->
                {{-- <div class="image-upload-section">
                        <div class="upload-area">
                            <span class="material-symbols-outlined upload-icon" data-icon="add_a_photo">add_a_photo</span>
                            <p class="upload-text">Upload Icon or Photo</p>
                            <img alt="Decorative background of animal paw print"
                                class="upload-bg"
                                data-alt="abstract minimalist graphic of a dog paw print on a clean off-white background with soft shadows"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCrH6Ue9DieYjg7TGAgHheazfsCuSM2vR6fVG6344X-3lR5xm_QMzna67inMcleylOT__RwltxEBeix9zWRVBxHzvt0sh_2a4IQTNcqRseHPajSOaQFQom2hhLH5G3dD0MpQ1QbIWZEDb6lh-uG5G1CGI7f3gQJlbbugGkqUpWTkme88g_t7OonZuIOugAcvI8qZyY8xuyJT6kBDa_ED1F_tl5KJQB-b86T2YyY0V9AovTgEj7TAhKhJW1TM5OCgJGqYk4sfmwB8_cd" />
                        </div>
                        <div class="icon-list">
                            <div class="icon-item">
                                <span class="material-symbols-outlined icon-symbol" data-icon="dog">pets</span>
                            </div>
                            <div class="icon-item">
                                <span class="material-symbols-outlined icon-symbol" data-icon="cat">pets</span>
                            </div>
                            <div class="icon-item">
                                <span class="material-symbols-outlined icon-symbol" data-icon="bug_report">bug_report</span>
                            </div>
                        </div>
                    </div> --}}
                <!-- Inputs -->
                <div class="input-section">
                    <div class="field-group">
                        <label class="field-label">Species Name</label>
                        <input name="species_name" class="input-field" placeholder="e.g. Dog" type="text" />
                    </div>
                    <div class="field-group">
                        <label class="field-label">Scientific Classification</label>
                        <input name="scientific_classification" class="input-field"
                            placeholder="e.g. Canis lupus familiaris" type="text" />
                    </div>
                </div>
                {{-- </div> --}}
                <!-- Section 2: Care Notes -->
                <div class="care-notes-section">
                    <div class="care-notes-header">
                        <span class="material-symbols-outlined care-notes-icon"
                            data-icon="medical_information">medical_information</span>
                        <h4 class="care-notes-title">General Care Notes</h4>
                    </div>
                    <div class="textarea-wrapper">
                        <textarea name="care_notes" class="textarea-field"
                            placeholder="Describe dietary needs, exercise requirements, and common health considerations..." rows="4"></textarea>
                    </div>
                </div>
                <!-- Action Footer -->
                <div class="modal-actions">
                    <button id="canceladdBtn" class="btn-cancel" type="button">
                        Cancel
                    </button>
                    <button class="btn-save-species" type="submit">
                        <span class="material-symbols-outlined" data-icon="save">save</span>
                        Save Species
                    </button>
                </div>
            </form>
            <!-- Decorative Glow Element -->
            <div class="decorative-glow glow-primary"></div>
            <div class="decorative-glow glow-secondary"></div>
        </div>
    </div>




    <!-- Add New Breed Modal Overlay -->
    <div id="addBreedsModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-stone-900/10 backdrop-blur-sm p-4  hidden">
        <!-- Modal Content: Glassmorphic Card (Shaped for Compactness) -->
        <div
            class="glass-panel w-full max-w-xl rounded-xl shadow-[0_20px_40px_rgba(148,76,0,0.06)] overflow-hidden bg-white/90">
            <!-- Modal Header -->
            <div class="px-6 pt-6 pb-4 flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-extrabold text-primary tracking-tight font-headline">Add New Breed</h2>
                    <p class="text-on-surface-variant text-sm font-medium mt-0.5">Define new entry in the habitat library.
                    </p>
                </div>
                <button id="closeaddBreeds" class="p-1.5 hover:bg-orange-50 rounded-full transition-colors text-outline">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>
            <!-- Modal Form Body -->
            <form id="breedForm" class="px-6 pb-8 space-y-5" enctype="multipart/form-data">
                <!-- Top Section: Image & Main Info -->
                <div class="flex gap-6 items-start">
                    <!-- Image Upload -->
                    <div class="w-32">
                        <label
                            class="text-[0.6rem] font-bold font-headline text-on-surface-variant uppercase tracking-[0.1em] mb-2 block">
                            Breed Image
                        </label>

                        <div class="imageUploadBox relative group aspect-square rounded-lg overflow-hidden bg-surface-container-low border-2 border-dashed border-outline-variant/30 flex flex-col items-center justify-center cursor-pointer hover:border-primary/40 transition-all"
                            id="imageUploadBox">

                            <!-- Preview Image -->
                            <img class="imagePreview absolute inset-0 w-full h-full object-cover opacity-20 group-hover:opacity-30 transition-opacity pointer-events-none"
                                id="imagePreview"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuATGdqly1vergDzNk6U9EtpyoBtJNP_lndE4Z_v4ddX4lhNrneSBQbWbsyz_No7-JCKl5shIiW5jrpnjVFPW7BmhLG7_vZ1zevpNWagwf4P1B8Z7YQZN7LRGhLkLNcEv7Fd4SqNZBIvGX7E_iVAI5auxRrCY8gVgGH8RaUlH32Phs6sUVNlFn6zGgekktrzUh38NICBuIsqfc8dRZMGymkiGyxMkqrmPwnFQriSa1E5fxZVZuc6e7V_6-0bgJ_Eq8mJYjeLsyAcNEUI" />

                            <span class="material-symbols-outlined ...">cloud_upload</span>
                            <span class="...">Upload</span>

                            <input type="file" class="imageInput hidden" accept="image/*" id="imageInput" name="image">
                        </div>
                    </div>
                    <div class="flex-1 space-y-4">
                        <!-- Breed Name & Species Row -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="relative group">
                                <label
                                    class="text-[0.6rem] font-bold font-headline text-on-surface-variant uppercase tracking-[0.1em] mb-0.5 block">Breed
                                    Name</label>
                                <input name="breed_name"
                                    class="w-full bg-transparent border-0 border-b border-outline-variant/30 focus:border-secondary focus:ring-0 px-0 py-1.5 text-base font-headline font-semibold text-on-surface placeholder:text-outline-variant/50 transition-all"
                                    placeholder="e.g. Beagle" type="text" />
                            </div>
                            <div class="relative group">
                                <label
                                    class="text-[0.6rem] font-bold font-headline text-on-surface-variant uppercase tracking-[0.1em] mb-0.5 block">Species</label>
                                <select id="addBreedSpeciesSelect" name="species_id"
                                    class="w-full bg-transparent border-0 border-b border-outline-variant/30 focus:border-secondary focus:ring-0 px-0 py-1.5 text-base font-headline font-semibold text-on-surface appearance-none transition-all">
                                    @if ($species)
                                        @foreach ($species as $specie)
                                            <option value="{{ $specie->id }}">{{ $specie->species_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span
                                    class="material-symbols-outlined absolute right-0 bottom-2 pointer-events-none text-outline-variant text-sm">expand_more</span>
                            </div>
                        </div>
                        <!-- Status Selection (Pills) - Smaller -->
                        <div>
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
                                    <input class="text-secondary focus:ring-secondary border-outline-variant pet_status"
                                        name="status" value="0" type="radio" />
                                    <span class="text-sm font-medium">InActive</span>
                                </label>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Description -->
                <div>
                    <label
                        class="text-[0.6rem] font-bold font-headline text-on-surface-variant uppercase tracking-[0.1em] mb-2 block">Description
                        &amp; Care Notes</label>
                    <textarea
                        class="w-full glass-panel rounded-lg border-outline-variant/10 focus:border-secondary/40 focus:ring-0 p-4 text-on-surface text-sm leading-snug placeholder:text-outline-variant/50"
                        name="description" placeholder="Temperament, physical traits, care needs..." rows="3"></textarea>
                </div>
                <!-- Modal Footer Actions -->
                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button"
                        class="px-6 py-2 rounded-full text-on-surface-variant font-headline font-bold text-xs hover:bg-stone-100 transition-all"
                        id="cancelAddBreedBtn">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-8 py-2.5 rounded-full bg-gradient-to-br from-primary to-primary-container text-on-primary font-headline font-extrabold text-xs shadow-md shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                        Save Breed
                    </button>
                </div>
            </form>
        </div>
        <!-- Decorative Floating Accent (The "Glow") -->
        <div class="fixed top-1/4 right-1/4 w-64 h-64 bg-primary/10 rounded-full blur-[100px] -z-10"></div>
        <div class="fixed bottom-1/4 left-1/4 w-80 h-80 bg-secondary/10 rounded-full blur-[120px] -z-10"></div>
    </div>


<!-- Add Edit Breed Modal Overlay -->
    <div id="editBreedsModal" class="fixed inset-0 z-[60] bg-on-background/20 backdrop-blur-sm flex items-center justify-center p-4 hidden">
        <!-- Modal Container -->
        <div
            class="glass-panel w-full max-w-4xl max-h-[921px] rounded-xl overflow-hidden flex flex-col shadow-[0_20px_40px_rgba(148,76,0,0.12)] bg-white/90">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-outline-variant/10">
                <h2 class="text-3xl font-headline font-bold tracking-tight text-on-surface">Edit Breed</h2>
                <button id="closeEditBreedM"
                    class="w-12 h-12 flex items-center justify-center rounded-full hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined text-outline">close</span>
                </button>
            </div>
            <!-- Scrollable Content Section -->
            <form id="editBreedForm" class="flex-1 overflow-y-auto p-10">
                <input type="hidden" id="editBreedId" name="breed_id" value="">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
                    <!-- Breed Image Section -->
                    <div class="md:col-span-5 flex flex-col gap-6">
                        <div class="relative group">
                            <div class="aspect-square rounded-xl overflow-hidden bg-surface-container shadow-inner">
                                <img id="editBreedImagePreview" alt="Breed image" class="w-full h-full object-cover"
                                    data-alt="Breed image preview"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCgih6bq3mACcgSc2MphDkKQkK-MTZjkHSi2pmYqcT4SmHzAc7GBI6D8fg3FL90R4M-7lrYRj4KPdZ1L7rDXYaRSa1H46ncTf7zp-c6Mne_5uhWVoR8Py5j75PSbq3GxGoZ0xUlDKqPTD2m6iG3PUi-a1Z85dYrF-d3SZV9bPPMA-93-NCCh2JY6RsZakQ27sCy7u8jYl8QNimz93Biy8LTZJa7pmkhIjF6BEjpRt3azkzFZjS-o865DtenBGj6-6V_x4btCaI8ACws" />
                                <input type="file" id="editImageInput" name="image" class="hidden" accept="image/*" />
                            </div>
                            <button type="button" id="editImageUploadBtn"
                                class="absolute bottom-4 right-4 bg-primary text-on-primary px-6 py-3 rounded-full flex items-center gap-2 shadow-lg hover:bg-primary-dim transition-all active:scale-95">
                                <span class="material-symbols-outlined text-sm">photo_camera</span>
                                <span class="font-label font-bold text-xs tracking-wider">UPDATE PHOTO</span>
                            </button>
                        </div>
                        {{-- <div class="p-6 rounded-lg bg-surface-container-low border border-outline-variant/5">
                            <p class="text-sm text-outline leading-relaxed">
                                High-quality images increase registry visibility. Recommended: 1080x1080px, natural
                                lighting, centered subject.
                            </p>
                        </div> --}}
                    </div>
                    <!-- Form Section -->
                    <div class="md:col-span-7 flex flex-col gap-8">
                        <!-- Breed Name -->
                        <div class="flex flex-col gap-2">
                            <label class="font-label text-xs font-bold tracking-widest text-primary uppercase">Breed
                                Name</label>
                            <input id="editBreedName"
                                class="w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 px-0 focus:ring-0 focus:border-secondary text-lg font-medium text-on-surface transition-all placeholder:text-outline-variant"
                                type="text" name="breed_name" value="" />
                        </div>
                        <div class="grid grid-cols-2 gap-8">
                            <!-- Species (Read Only) -->
                            <div class="flex flex-col gap-2 opacity-70">
                                <label
                                    class="font-label text-xs font-bold tracking-widest text-outline uppercase">Species</label>
                                <div
                                    class="w-full bg-surface-container-high rounded-full py-3 px-6 flex items-center justify-between cursor-not-allowed">
                                    <span id="editBreedSpecies" class="text-on-surface font-medium">Canine</span>
                                    <span class="material-symbols-outlined text-sm">lock</span>
                                </div>
                            </div>
                            <!-- Status Toggle -->
                            <div class="flex flex-col gap-2">
                                <label
                                    class="font-label text-xs font-bold tracking-widest text-primary uppercase">Status</label>
                                <div
                                    class="flex bg-surface-container-low p-1 rounded-full border border-outline-variant/10">
                                    <label class="flex-1 py-2 px-4 rounded-full text-xs font-bold transition-all shadow-sm cursor-pointer">
                                        <input id="editBreedStatusActive" type="radio" name="status" value="1" class="hidden" />
                                        <span class="block text-center">Active</span>
                                    </label>
                                    <label class="flex-1 py-2 px-4 rounded-full text-xs font-bold transition-all shadow-sm cursor-pointer">
                                        <input id="editBreedStatusInactive" type="radio" name="status" value="0" class="hidden" />
                                        <span class="block text-center">Inactive</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Description & Care Notes -->
                        <div class="flex flex-col gap-2">
                            <label class="font-label text-xs font-bold tracking-widest text-primary uppercase">Description
                                &amp; Care Notes</label>
                            <textarea id="editBreedDescription"
                                class="w-full bg-surface-container-low rounded-lg border border-outline-variant/20 p-4 focus:ring-2 focus:ring-secondary/20 focus:border-secondary text-on-surface leading-relaxed resize-none transition-all"
                                rows="6"></textarea>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Actions Footer -->
            <div
                class="px-6 py-4 border-t border-outline-variant/10 flex justify-end items-center gap-4 bg-surface/40 backdrop-blur-md">
                <button id="cancelEditBreedM"
                    class="px-8 py-3 rounded-full font-label font-bold text-sm tracking-wide text-outline hover:text-primary transition-all active:scale-95">
                    Cancel
                </button>
                <button type="button" id="saveEditBreedBtn"
                    class="px-10 py-3 rounded-full bg-primary text-on-primary font-headline font-bold text-sm shadow-[0_10px_20px_rgba(148,76,0,0.2)] hover:bg-primary-dim transition-all active:scale-95 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]"
                        style="font-variation-settings: 'FILL' 1;">save</span>
                    Save Changes
                </button>
            </div>
        </div>
    </div>







    <!-- Header Section -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12">
        <div class="lg:col-span-8 flex justify-between items-center">
            <div>
                <span class="label-md text-primary font-bold tracking-widest text-xs uppercase">Registry Overview</span>
                <h2 class="font-headline text-4xl font-extrabold text-on-surface mt-2">Pet Management</h2>
                <p class="text-on-surface-variant mt-2 max-w-lg">Manage the global taxonomy of species and breeds within
                    the
                    Radiant Habitat ecosystem.</p>
            </div>
            <button id="addBtn" class="btn-add-new">
                <span class="material-symbols-outlined" data-icon="add">add</span>
                Add New Species
            </button>
        </div>
        <!-- Sidebar / Stats Section -->
        <aside class="lg:col-span-4 space-y-8">
            <div class="bg-secondary/10 rounded-xl p-8 border border-secondary/10">
                <h4 class="font-headline text-lg font-bold mb-6">Population Insights</h4>
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <span class="text-sm opacity-70">Total Species</span>
                        <span class="font-bold text-xl">{{ $totalSpecies }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm opacity-70">Active Breeds</span>
                        <span class="font-bold text-xl">{{ $totalBreeds }}</span>
                    </div>
                </div>
            </div>
        </aside>

    </div>

    <!-- Hierarchical Bento Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Species Section: Canine -->
        @foreach ($species as $specie)
            <section class="lg:col-span-12">
                <div class="glass-card rounded-xl p-8 mb-8 relative overflow-hidden group">
                    <div
                        class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-primary/5 rounded-full blur-3xl transition-all group-hover:bg-primary/10">
                    </div>
                    <div class="flex justify-between items-center mb-10 relative z-10">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-primary-container/20 flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary text-3xl" data-icon="pets">pets</span>
                            </div>
                            <div>
                                <h3 class="font-headline text-2xl font-bold">{{ $specie->species_name }}</h3>
                                <p class="text-on-surface-variant text-sm">42 registered breeds</p>
                            </div>
                        </div>
                        <button id="addBreeds" data-specie-id="{{ $specie->id }}"
                            class="px-6 py-2 rounded-full border-2 border-primary/20 text-primary font-bold text-sm hover:bg-primary/5 transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm" data-icon="add">add</span>
                            Add New Breed
                        </button>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 relative z-10">
                        <!-- Breed Card -->
                        @php $count = 0; @endphp
                        @foreach ($breeds as $breed)
                            @if ($breed->species_id == $specie->id)
                                @php $count++; @endphp
                                <div class="bg-white/40 hover:bg-white rounded-2xl p-4 transition-all hover:shadow-lg hover:shadow-primary/5 cursor-pointer border border-transparent hover:border-primary/10 group/item breed-card {{ $count > 5 ? 'hidden' : '' }}"
                                    data-specie-id="{{ $specie->id }}">
                                    <div class="aspect-square rounded-xl overflow-hidden mb-3 relative">
                                        <img class="w-full h-full object-cover group-hover/item:scale-110 transition-transform duration-500"
                                            alt="{{ $breed->breed_name }} image"
                                            data-alt="{{ $breed->breed_name }} breed image"
                                            src="{{ $breed->image ? asset($breed->image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuB_IkAcim22G1smrkzGfTl4wiP2em21kEY5402THTUNP42RbV2kcnzZk2TvAkj6Ua5sdP62akZ2zbd_6GkfKizf68pEbiEUUATjLM5YJ0M6MxK_reMap0a5TMfpDX5qYtOwfiWr0MaPH9veI7Oos5wqQeGZwhnKC7-Q9tgs84DoXxr66NaocAaOTQ4pQEC_54C-1XZlvBjYqQuAqI3oLsCdDIb2upe0HwItbGUy2Hxc0YBQaFrVkYB-bOyhRjOrTSVOHN5YQClQ15VL' }}" />
                                        <div
                                            class="breed-action-overlay absolute inset-0 flex items-center justify-center gap-3 opacity-0 group-hover/item:opacity-100 transition-opacity duration-300">
                                            <button type="button" class="editBreedBtn p-2 bg-white/90 hover:bg-white text-primary rounded-full shadow-lg transition-transform hover:scale-110"
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
                                                class="deleteBreedBtn p-2 bg-white/90 hover:bg-error text-error hover:text-white rounded-full shadow-lg transition-transform hover:scale-110"
                                                data-breed-id="{{ $breed->id }}" title="Deactivate">
                                                <span class="material-symbols-outlined text-sm">delete</span>
                                            </button>
                                        </div>
                                    </div>
                                    <h4 class="font-bold text-on-surface">{{ $breed->breed_name }}</h4>
                                    <p class="text-xs text-on-surface-variant">Standard / Large</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <button id="viewAllBreeds-{{ $specie->id }}" data-specie-id="{{ $specie->id }}"
                        data-species-name="{{ $specie->species_name }}" data-expanded="false"
                        class="w-full mt-6 py-2 text-primary font-bold text-sm hover:underline flex justify-center items-center gap-1">
                        <span>View all {{ $specie->species_name }} breeds</span>
                        <span class="material-symbols-outlined text-sm" data-icon="arrow_forward">arrow_forward</span>
                    </button>
                </div>
            </section>
        @endforeach

    </div>

    <div id="successOverlay" class="fixed inset-0 z-10 bg-on-surface/5 backdrop-blur-[2px] hidden"></div>
    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center p-6 hidden">
        <div class=" w-full max-w-md rounded-xl p-10 flex flex-col items-center text-center shadow-[0_20px_40px_rgba(148,76,0,0.06)] transform scale-105"
            style="background: beige;"> <!-- Icon Container with Glow -->
            <div class="mb-8 relative">
                <div class="absolute inset-0 bg-primary/20 blur-2xl rounded-full scale-150"></div>
                <div class="relative w-24 h-24 signature-glow rounded-full flex items-center justify-center shadow-lg">
                    <span class="material-symbols-outlined text-on-primary text-5xl"
                        style="font-variation-settings: 'FILL' 1;">check_circle</span>
                </div>
            </div> <!-- Content -->
            <div class="space-y-3 mb-10">
                <h2 class="font-headline text-3xl font-extrabold tracking-tight text-on-surface">Success!</h2>
                <p class="text-body-lg text-on-surface-variant leading-relaxed px-4"> Information has been updated
                    successfully. </p>
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

            // Open Add Species Modal
            $('#addBtn').click(function() {
                $('#newSpeciesModal').removeClass('hidden');
            });

            $(document).on('click', '#closeaddBtn, #canceladdBtn', function() {
                $('#newSpeciesModal').addClass('hidden');
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

                            $('#successOverlay').removeClass('hidden');
                            $('#successModal').removeClass('hidden');


                            $form[0].reset();
                            $('#newSpeciesModal').addClass('hidden');


                            setTimeout(function() {
                                location.reload();
                            }, 1000);

                        } else {
                            alert(response.message || 'Unable to save species.');
                        }
                    },
                    error: function(xhr) {
                        var message = 'An error occurred while saving the form.';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            message = Object.values(xhr.responseJSON.errors).flat().join('\n');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        alert(message);
                    },
                    complete: function() {
                        $button.prop('disabled', false).html(originalText);
                    }
                });
            });




            // Open Add Breed Modal
            $(document).on('click', '#addBreeds', function() {
                var specieId = $(this).data('specie-id');

                $('#addBreedsModal').removeClass('hidden');

                // Just set default value
                $('#addBreedSpeciesSelect').val(specieId.toString());
            });

            // Close modal
            $(document).on('click', '#closeaddBreeds', function() {
                $('#addBreedsModal').addClass('hidden');
            });

            // Optional: close when clicking outside modal
            $(document).on('click', '#addBreedsModal', function(e) {
                if (e.target.id === 'addBreedsModal') {
                    $('#addBreedsModal').addClass('hidden');
                }
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
                var previewSelector = $(this).attr('id') === 'editImageInput' ? '#editBreedImagePreview' : '#imagePreview';

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
                            console.log('SUCCESS HIT');

                            // ✅ SHOW modal first
                            $('#successOverlay').removeClass('hidden').hide().fadeIn(200);
                            $('#successModal').removeClass('hidden').hide().fadeIn(200);

                            // Reset form
                            $('#addBreedsModal').addClass('hidden');
                            $form[0].reset();

                            $('#imagePreview')
                                .attr('src',
                                    'https://lh3.googleusercontent.com/aida-public/AB6AXuATGdqly1vergDzNk6U9EtpyoBtJNP_lndE4Z_v4ddX4lhNrneSBQbWbsyz_No7-JCKl5shIiW5jrpnjVFPW7BmhLG7_vZ1zevpNWagwf4P1B8Z7YQZN7LRGhLkLNcEv7Fd4SqNZBIvGX7E_iVAI5auxRrCY8gVgGH8RaUlH32Phs6sUVNlFn6zGgekktrzUh38NICBuIsqfc8dRZMGymkiGyxMkqrmPwnFQriSa1E5fxZVZuc6e7V_6-0bgJ_Eq8mJYjeLsyAcNEUI'
                                )
                                .removeClass('opacity-100')
                                .addClass('opacity-20');

                            // ✅ Hide after 1s → then reload
                            setTimeout(function() {
                                $('#successModal').fadeOut(300);
                                $('#successOverlay').fadeOut(300);

                                setTimeout(() => location.reload(), 300);
                            }, 1000);

                        } else {
                            alert(response.message || 'Unable to save breed.');
                        }
                    },
                    error: function(xhr) {
                        var message = 'An error occurred while saving the breed.';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            message = Object.values(xhr.responseJSON.errors).flat().join('\n');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        alert(message);
                    },
                    complete: function() {
                        $submitButton.prop('disabled', false).html(originalText);
                    }
                });
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
                            $('#successOverlay').removeClass('hidden').hide().fadeIn(200);
                            $('#successModal').removeClass('hidden').hide().fadeIn(200);

                            $('#editBreedsModal').addClass('hidden');

                            setTimeout(function() {
                                $('#successModal').fadeOut(300);
                                $('#successOverlay').fadeOut(300);
                                setTimeout(function() {
                                    location.reload();
                                }, 300);
                            }, 1000);
                        } else {
                            alert(response.message || 'Unable to update breed.');
                        }
                    },
                    error: function(xhr) {
                        var message = 'An error occurred while updating the breed.';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            message = Object.values(xhr.responseJSON.errors).flat().join('\n');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        alert(message);
                    },
                    complete: function() {
                        $submitButton.prop('disabled', false).html(originalText);
                    }
                });
            });

            // Delete breed button (now deactivates)
            $(document).on('click', '.deleteBreedBtn', function() {
                var $button = $(this);
                var breedId = $button.data('breed-id');
                if (!confirm('Deactivate this breed?')) {
                    return;
                }

                $.ajax({
                    url: "{{ url('admin/toggleBreedStatus') }}/" + breedId,
                    method: 'POST',
                    data: {
                        _method: 'PATCH'
                    },
                    success: function(response) {
                        if (response.success) {
                            $button.closest('.breed-card').fadeOut(300, function() {
                                $(this).remove();
                            });
                        } else {
                            alert(response.message || 'Unable to deactivate breed.');
                        }
                    },
                    error: function(xhr) {
                        var message = 'An error occurred while deactivating the breed.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        alert(message);
                    }
                });
            });

            // View all breeds toggle
            $(document).on('click', '[id^="viewAllBreeds-"]', function() {
                var $button = $(this);
                var specieId = $button.data('specie-id');
                var speciesName = $button.data('species-name');
                var isExpanded = $button.data('expanded');
                if (isExpanded) {
                    // Hide extra breeds with fade out
                    $('.breed-card[data-specie-id="' + specieId + '"]:gt(4)').fadeOut(300);
                    $button.find('span:first').text('View all ' + speciesName + ' breeds');
                    $button.data('expanded', false);
                } else {
                    // Show all breeds with fade in
                    $('.breed-card[data-specie-id="' + specieId + '"]:gt(4)').fadeIn(300);
                    $button.find('span:first').text('Show less');
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
                var imageUrl = $button.data('breed-image') || 'https://lh3.googleusercontent.com/aida-public/AB6AXuCgih6bq3mACcgSc2MphDkKQkK-MTZjkHSi2pmYqcT4SmHzAc7GBI6D8fg3FL90R4M-7lrYRj4KPdZ1L7rDXYaRSa1H46ncTf7zp-c6Mne_5uhWVoR8Py5j75PSbq3GxGoZ0xUlDKqPTD2m6iG3PUi-a1Z85dYrF-d3SZV9bPPMA-93-NCCh2JY6RsZakQ27sCy7u8jYl8QNimz93Biy8LTZJa7pmkhIjF6BEjpRt3azkzFZjS-o865DtenBGj6-6V_x4btCaI8ACws';

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
                $('#editBreedsModal').removeClass('hidden');
            });

            function updateEditBreedStatusPills() {
                var isActive = $('#editBreedStatusActive').is(':checked');
                var $activeLabel = $('#editBreedStatusActive').closest('label');
                var $inactiveLabel = $('#editBreedStatusInactive').closest('label');

                if (isActive) {
                    $activeLabel.addClass('bg-secondary text-on-secondary').removeClass('bg-transparent text-outline');
                    $inactiveLabel.addClass('bg-transparent text-outline').removeClass('bg-secondary text-on-secondary');
                } else {
                    $inactiveLabel.addClass('bg-secondary text-on-secondary').removeClass('bg-transparent text-outline');
                    $activeLabel.addClass('bg-transparent text-outline').removeClass('bg-secondary text-on-secondary');
                }
            }

            $(document).on('change', '#editBreedStatusActive, #editBreedStatusInactive', function() {
                updateEditBreedStatusPills();
            });

            $(document).on('click', '#closeEditBreedM, #cancelEditBreedM', function() {
                $('#editBreedsModal').addClass('hidden');
            });

            // Close modal when clicking outside
            $(document).on('click', '#editBreedsModal', function(e) {
                if (e.target.id === 'editBreedsModal') {
                    $('#editBreedsModal').addClass('hidden');
                }
            });

            $(document).on('click', '#saveEditBreedBtn', function() {
                $('#editBreedForm').submit();
            });




        });
    </script>
@endsection
