@extends('backEnd.layouts.master')

@section('adminContent')
    <div class="mx-auto">

        <h1 class="mb-4">Edit Service ( {{ $service->name }} )</h1>

        <form method="POST" action="{{ route('updateService', $service->id) }}" enctype="multipart/form-data">
            @csrf

            <!-- BASIC INFO -->
            <div class="card">
                <h3>Service Info</h3>

                <div class="grid">
                    <input type="text" name="name" placeholder="Service Name" value="{{ $service->name }}">

                    <select name="category_id">
                        <option>Select Category</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $service->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}</option>
                        @endforeach
                    </select>

                    <select name="company_id">
                        <option>Select Company</option>
                        @foreach ($companies as $c)
                            <option value="{{ $c->id }}" {{ $service->company_id == $c->id ? 'selected' : '' }}>
                                {{ $c->company_name }}</option>
                        @endforeach
                    </select>

                    <select name="service_type" id="serviceType">
                        <option value="">Select Service Type</option>
                        <option value="Appointments" {{ $service->service_type == 'Appointments' ? 'selected' : '' }}>
                            Appointments</option>
                        <option value="Duration" {{ $service->service_type == 'Duration' ? 'selected' : '' }}>Duration
                        </option>
                        <option value="Package" {{ $service->service_type == 'Package' ? 'selected' : '' }}>Package
                        </option>
                    </select>

                    <input type="file" name="image" accept="image/*">
                    <p>Previous Image: <img src="{{ asset($service->image) }}" alt="Previous Image"
                            class="w-16 h-16 object-cover rounded"></p>

                    <textarea name="description" placeholder="Description">{{ $service->description }}</textarea>

                    <select name="status" id="status">
                        <option value="1" {{ $service->status == '1' ? 'selected' : '' }}>Active</option>
                        <option value="2" {{ $service->status == '2' ? 'selected' : '' }}>InActive</option>
                    </select>
                </div>

                
            </div>

            <!-- LOCATION -->
            <div class="card">
                <h3>Location</h3>

                <div class="grid">
                    <select id="district" name="district_id">
                        <option>Select District</option>
                        @foreach ($districts as $d)
                            <option value="{{ $d->id }}" {{ $service->district_id == $d->id ? 'selected' : '' }}>
                                {{ $d->name }}</option>
                        @endforeach
                    </select>

                    <select id="upazila" name="upazila_id" data-selected="{{ $service->upazila_id }}">
                        <option value="">Select Upazila</option>
                    </select>

                    <select id="union" name="union_id" data-selected="{{ $service->union_id }}">
                        <option value="">Select Union</option>
                    </select>

                    <input type="text" name="location" placeholder="Detailed Location" value="{{ $service->location }}">
                </div>
            </div>


            <div class="card">
                @if($service->service_type == 'Appointments')
                <div id="appointmentPricing" style="{{ $service->service_type == 'Appointments' ? '' : 'display:none;' }}">

                    <h3>Appointment Pricing</h3>

                    @foreach ($servicePricings as $index => $pricing)
                        <div class="pricing-type-card mt-2" data-index="{{ $index }}" data-id="{{ $pricing->id }}">

                            <div class="defaultPricing grid">
                                <input type="hidden" name="pricing_types[{{ $index }}][id]" value="{{ $pricing->id }}">

                                <input type="text" name="pricing_types[{{ $index }}][type]" value="Session"
                                    readonly>

                                <input type="number" name="pricing_types[{{ $index }}][price]"
                                    value="{{ $pricing->price }}" placeholder="Price">

                                <input type="number" name="pricing_types[{{ $index }}][sale_price]"
                                    value="{{ $pricing->sale_price }}" placeholder="Sale Price">
                            </div>

                            <div class="rulesContainer">

                                @foreach ($pricing->rules as $rIndex => $rule)
                                    <div class="card">
                                        <div style="display:flex; align-items:center; gap:10px;">
                                            <div class="rule-group" style ="width: stretch; position:relative;">
                                                <div class="grid">
                                                    <input type="hidden" name="pricing_types[{{ $index }}][rules][{{ $rIndex }}][id]" value="{{ $rule->id }}">
                                                    <select
                                                        name="pricing_types[{{ $index }}][rules][{{ $rIndex }}][species_id]"
                                                        class="species">
                                                        <option value="">Any Species</option>

                                                        @foreach ($species as $sp)
                                                            <option value="{{ $sp->id }}"
                                                                {{ $rule->species_id == $sp->id ? 'selected' : '' }}>
                                                                {{ $sp->species_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <select
                                                        name="pricing_types[{{ $index }}][rules][{{ $rIndex }}][breed_id]"
                                                        class="breed">
                                                        <option value="">Any Breed</option>
                                                    </select>

                                                    <select
                                                        name="pricing_types[{{ $index }}][rules][{{ $rIndex }}][size_id]"
                                                        class="size">
                                                        <option value="">Any Size</option>
                                                    </select>

                                                    <input type="number"
                                                        name="pricing_types[{{ $index }}][rules][{{ $rIndex }}][price]"
                                                        value="{{ $rule->price }}" placeholder="Price">

                                                    <input type="number"
                                                        name="pricing_types[{{ $index }}][rules][{{ $rIndex }}][sale_price]"
                                                        value="{{ $rule->sale_price }}" placeholder="Sale Price">

                                                </div>
                                            </div>
                                            <button type="button" class="removeRule btn-danger">✕</button>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <button type="button" class="addRule btn-primary mt-2">+ Add Rule</button>

                        </div>
                    @endforeach
                </div>
                @else
                <!-- PRICING -->
                <div id="durationPricing"
                    style="{{ in_array($service->service_type, ['Duration', 'Package']) ? '' : 'display:none;' }}">

                    <div id="pricingTypesContainer">

                        @foreach ($servicePricings as $index => $pricing)
                            <div class="pricing-type-card" data-index="{{ $index }}" data-id="{{ $pricing->id }}">

                                <h3 class="pricing-header">
                                    {{ $service->service_type == 'Package' ? 'Package ' . ($index + 1) : 'Pricing ' . ($index + 1) }}
                                </h3>

                                <div class="defaultPricing grid">
                                    <input type="hidden" name="pricing_types[{{ $index }}][id]" value="{{ $pricing->id }}">
                                    @if ($service->service_type == 'Duration')
                                        <select name="pricing_types[{{ $index }}][type]" class="pricingTypeSelect">
                                            <option value="Hourly" {{ $pricing->pricing_type == 'Hourly' ? 'selected' : '' }}>
                                                Hourly</option>
                                            <option value="Daily" {{ $pricing->pricing_type == 'Daily' ? 'selected' : '' }}>Daily
                                            </option>
                                            <option value="Weekly" {{ $pricing->pricing_type == 'Weekly' ? 'selected' : '' }}>
                                                Weekly</option>
                                        </select>
                                    @else
                                        <input type="text" name="pricing_types[{{ $index }}][type]"
                                            value="Package" readonly>
                                    @endif

                                    <input type="number" name="pricing_types[{{ $index }}][price]"
                                        value="{{ $pricing->price }}" placeholder="Price">

                                    <input type="number" name="pricing_types[{{ $index }}][sale_price]"
                                        value="{{ $pricing->sale_price }}" placeholder="Sale Price">

                                        @if($service->service_type == 'Package')

                                        <input type="number" name="pricing_types[{{ $index }}][qty]"
                                        value="{{ $pricing->qty }}" placeholder="Quantity">

                                        <input type="text" name="pricing_types[{{ $index }}][time]"
                                        value="{{ $pricing->time }}" placeholder="Time">
                                        <input type="text" name="pricing_types[{{ $index }}][label]"
                                        value="{{ $pricing->label }}" placeholder="Label">

                                        @endif
                                </div>

                                <div class="rulesContainer">

                                    @foreach ($pricing->rules as $rIndex => $rule)
                                        <div class="card">
                                            <div style="display:flex; align-items:center; gap:10px;">
                                            <div class="rule-group" style ="width: stretch; position:relative;">

                                                <div class="grid">
                                                    <input type="hidden" name="pricing_types[{{ $index }}][rules][{{ $rIndex }}][id]" value="{{ $rule->id }}">
                                                    <select
                                                        name="pricing_types[{{ $index }}][rules][{{ $rIndex }}][species_id]"
                                                        class="species">
                                                        <option value="">Any Species</option>

                                                        @foreach ($species as $sp)
                                                            <option value="{{ $sp->id }}"
                                                                {{ $rule->species_id == $sp->id ? 'selected' : '' }}>
                                                                {{ $sp->species_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <select
                                                        name="pricing_types[{{ $index }}][rules][{{ $rIndex }}][breed_id]"
                                                        class="breed" data-selected="{{ $rule->breed_id }}">
                                                        <option value="">Any Breed</option>
                                                    </select>

                                                    <select
                                                        name="pricing_types[{{ $index }}][rules][{{ $rIndex }}][size_id]"
                                                        class="size" data-selected="{{ $rule->size_id }}">
                                                        <option value="">Any Size</option>
                                                    </select>

                                                    <input type="number"
                                                        name="pricing_types[{{ $index }}][rules][{{ $rIndex }}][price]"
                                                        value="{{ $rule->price }}" placeholder="Price">

                                                    <input type="number"
                                                        name="pricing_types[{{ $index }}][rules][{{ $rIndex }}][sale_price]"
                                                        value="{{ $rule->sale_price }}" placeholder="Sale Price">

                                                </div>

                                            </div>
                                            <button type="button" class="removeRule btn-danger">✕</button>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                <button type="button" class="addRule btn-primary mt-2">+ Add Rule</button>
                                <button type="button" class="removePricingType btn-danger mt-2">✕</button>

                            </div>
                        @endforeach

                    </div>

                    <button type="button" id="addPricingType" class="btn-primary">
                        + New Pricing Type
                    </button>

                </div>
                @endif
            </div>

            <div class="card">
                <h3>Service Schedule</h3>

                <div class="grid">

                    @php
                        $days = explode(',', $serviceAvailability->day_of_week ?? '');
                        $offDates = !empty($serviceAvailability->off_dates)
                                    ? explode(',', $serviceAvailability->off_dates)
                                    : [];
                    @endphp

                    <select name="day_of_week[]" class="select2" multiple>
                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <option value="{{ $day }}" {{ in_array($day, $days) ? 'selected' : '' }}>
                                {{ $day }}
                            </option>
                        @endforeach
                    </select>

                    <input type="text" id="start_time" name="start_time"
                        value="{{ date('h:i A', strtotime($serviceAvailability->start_time)) }}">

                    <input type="text" id="end_time" name="end_time"
                        value="{{ date('h:i A', strtotime($serviceAvailability->end_time)) }}">

                    <input type="text" id="off_dates" name="off_dates" placeholder="Off Dates">
                </div>
            </div>
            <input type="hidden" name="deleted_rules" id="deleted_rules">
            <button class="btn-primary" type="submit">Save Service</button>

        </form>

        <div id="globalLoader">
            <div class="loader"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() { initExistingPricingState(); });

        let pricingTypeIndex = 0;
        let deletedRules = [];
        /* =========================
           INIT ON LOAD
        ========================= */
        document.addEventListener('DOMContentLoaded', function() {

            initServiceTypeUI();
            initSelect2();
            initFlatpickr();
            initLocationCascade();
            
            initExistingPricingState();
        });


        /* =========================
           SERVICE TYPE SWITCH
        ========================= */
        function initServiceTypeUI() {

            let type = document.getElementById('serviceType');

            type.addEventListener('change', function() {

                let val = this.value;

                let appointment = document.getElementById('appointmentPricing');
                let duration = document.getElementById('durationPricing');

                if (val === 'Appointments') {
                    appointment.style.display = 'block';
                    duration.style.display = 'none';
                } else if (val === 'Duration' || val === 'Package') {

                    appointment.style.display = 'none';
                    duration.style.display = 'block';

                    document.getElementById('pricingTypesContainer').innerHTML = '';
                    pricingTypeIndex = 0;

                    document.getElementById('addPricingType').click();
                } else {
                    appointment.style.display = 'none';
                    duration.style.display = 'none';
                }
            });
        }


        /* =========================
           INIT SELECT2
        ========================= */
        function initSelect2() {
            $('.select2').select2({
                placeholder: "Select working days"
            });
        }


        /* =========================
           INIT FLATPICKR (12H FORMAT SAFE)
        ========================= */
        function initFlatpickr() {

            flatpickr("#start_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "h:i K",
                time_24hr: false
            });

            flatpickr("#end_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "h:i K",
                time_24hr: false
            });

            flatpickr("#off_dates", {
                mode: "multiple",
                dateFormat: "Y-m-d",
                defaultDate: @json($offDates)
            });
        }


        /* =========================
           LOCATION INIT (EDIT MODE FIX)
        ========================= */
        function initLocationCascade() {

            let district = document.getElementById('district');
            let upazila = document.getElementById('upazila');
            let union = document.getElementById('union');

            if (!district) return;

            let selectedUpazila = upazila.dataset.selected;
            let selectedUnion = union.dataset.selected;

            /* =========================
               LOAD UPAZILAS
            ========================= */
            function loadUpazilas(districtId, selectedUpazila = null) {

                // show loading instantly
                upazila.innerHTML = `<option>Loading...</option>`;
                union.innerHTML = `<option>Select Union</option>`;

                return fetch(`/admin/get-upazilas/${districtId}`)
                    .then(res => res.json())
                    .then(data => {

                        upazila.innerHTML = `<option value="">Select Upazila</option>`;

                        data.forEach(u => {
                            upazila.innerHTML += `<option value="${u.id}">${u.name}</option>`;
                        });

                        if (selectedUpazila) {
                            upazila.value = selectedUpazila;
                        }

                        return selectedUpazila;
                    })
                    .catch(() => {
                        upazila.innerHTML = `<option>Error loading</option>`;
                    });
            }

            /* =========================
               LOAD UNIONS
            ========================= */
            function loadUnions(upazilaId, selectedUnion = null) {

                // show loading instantly
                union.innerHTML = `<option>Loading...</option>`;

                return fetch(`/admin/get-unions/${upazilaId}`)
                    .then(res => res.json())
                    .then(data => {

                        union.innerHTML = `<option value="">Select Union</option>`;

                        data.forEach(u => {
                            union.innerHTML += `<option value="${u.id}">${u.name}</option>`;
                        });

                        if (selectedUnion) {
                            union.value = selectedUnion;
                        }
                    })
                    .catch(() => {
                        union.innerHTML = `<option>Error loading</option>`;
                    });
            }

            /* =========================
               EVENTS
            ========================= */
            district.addEventListener('change', function() {

                let districtId = this.value;

                if (!districtId) return;

                loadUpazilas(districtId);
            });

            upazila.addEventListener('change', function() {

                let upazilaId = this.value;

                if (!upazilaId) return;

                loadUnions(upazilaId);
            });

            /* =========================
               AUTO LOAD (EDIT MODE)
            ========================= */
            if (district.value) {

                loadUpazilas(district.value, selectedUpazila)
                    .then(() => {
                        if (selectedUpazila) {
                            return loadUnions(selectedUpazila, selectedUnion);
                        }
                    });
            }
        }


        /* =========================
           ADD PRICING TYPE
        ========================= */
        @if($service->service_type == 'Duration' || $service->service_type == 'Package'  )

        document.getElementById('addPricingType').addEventListener('click', function() {

            let container = document.getElementById('pricingTypesContainer');
            let index = pricingTypeIndex;

            let serviceType = document.getElementById('serviceType').value;

            let typeField = '';
            let extraFields = '';

            if (serviceType === 'Duration') {

                typeField = `
            <select name="pricing_types[${index}][type]" class="pricingTypeSelect">
                <option value="">Select Type</option>
            </select>`;
            } else if (serviceType === 'Package') {

                typeField = `
            <input type="text" name="pricing_types[${index}][type]" value="Package" readonly>
        `;

                extraFields = `
            <input type="number" name="pricing_types[${index}][qty]" placeholder="Quantity">
            <input type="text" name="pricing_types[${index}][time]" placeholder="Time">
            <input type="text" name="pricing_types[${index}][label]" placeholder="Label">
        `;
            }

            let div = document.createElement('div');
            div.classList.add('pricing-type-card');
            div.dataset.index = index;

            div.innerHTML = `
        <h3 class="pricing-header"></h3>

        <div class="defaultPricing grid">
            ${typeField}
            <input type="number" name="pricing_types[${index}][price]" placeholder="Price">
            <input type="number" name="pricing_types[${index}][sale_price]" placeholder="Sale Price">
            ${extraFields}
        </div>

        <div class="rulesContainer"></div>

        <button type="button" class="addRule btn-primary mt-2">+ Add Rule</button>
        <button type="button" class="removePricingType btn-danger mt-2">✕</button>
    `;

            container.appendChild(div);

            pricingTypeIndex++;
            updateHeaders();
            updatePricingTypeOptions();
        });
        @endif

        /* =========================
           RULE ADD (WORKS FOR EDIT TOO)
        ========================= */
        document.addEventListener('click', function(e) {

    if (e.target.classList.contains('addRule')) {

        let card = e.target.closest('.pricing-type-card');
        let pricingId = card.dataset.id;

        let container = card.querySelector('.rulesContainer');

        let ruleId = crypto.randomUUID();

        let div = document.createElement('div');
        div.classList.add('card');

        div.innerHTML = `
            <div style="display:flex; align-items:center; gap:10px;">
                <div class="rule-group" style="width:stretch; position:relative;">

                    <input type="hidden" name="pricing_types[${pricingId}][rules][${ruleId}][id]" value="${ruleId}">

                    <div class="grid">

                        <select name="pricing_types[${pricingId}][rules][${ruleId}][species_id]" class="species">
                            <option value="">Any Species</option>
                            @foreach ($species as $sp)
                                <option value="{{ $sp->id }}">{{ $sp->species_name }}</option>
                            @endforeach
                        </select>

                        <select name="pricing_types[${pricingId}][rules][${ruleId}][breed_id]" class="breed">
                            <option value="">Any Breed</option>
                        </select>

                        <select name="pricing_types[${pricingId}][rules][${ruleId}][size_id]" class="size">
                            <option value="">Any Size</option>
                        </select>

                        <input type="number" name="pricing_types[${pricingId}][rules][${ruleId}][price]" placeholder="Price">
                        <input type="number" name="pricing_types[${pricingId}][rules][${ruleId}][sale_price]" placeholder="Sale Price">

                    </div>
                </div>

                <button type="button" class="removeRule btn-danger">✕</button>
            </div>
        `;

        container.appendChild(div);

        togglePricingInputs(card);
    }
});


        /* =========================
           RULE REMOVE
        ========================= */
        document.addEventListener('click', function(e) {

    // REMOVE RULE
    if (e.target.classList.contains('removeRule')) {

        let ruleCard = e.target.closest('.card');
        let card = e.target.closest('.pricing-type-card');

        let hiddenId = ruleCard.querySelector('input[type="hidden"]');

        if (hiddenId && hiddenId.value && !isNaN(hiddenId.value)) {
            deletedRules.push(hiddenId.value);
        }

        ruleCard.remove();
        reindexRules(card);
        togglePricingInputs(card);
    }

    // REMOVE PRICING TYPE
    if (e.target.classList.contains('removePricingType')) {
        e.target.closest('.pricing-type-card').remove();
        updateHeaders();
        updatePricingTypeOptions();
    }
});

/* =========================
           PREVENT DUPLICATE TYPES (Duration only)
        ========================= */
        function updatePricingTypeOptions() {

            let serviceType = document.getElementById('serviceType').value;

            // only apply for Duration
            if (serviceType !== 'Duration') return;

            let selected = [];

            document.querySelectorAll('.pricingTypeSelect').forEach(select => {
                if (select.value) selected.push(select.value);
            });

            document.querySelectorAll('.pricingTypeSelect').forEach(select => {

                let current = select.value;

                select.innerHTML = `
                    <option value="">Select Type</option>
                    <option value="Hourly" ${current === 'Hourly' ? 'selected' : ''}>Hourly</option>
                    <option value="Daily" ${current === 'Daily' ? 'selected' : ''}>Daily</option>
                    <option value="Weekly" ${current === 'Weekly' ? 'selected' : ''}>Weekly</option>
                `;

                Array.from(select.options).forEach(opt => {
                    if (selected.includes(opt.value) && opt.value !== current) {
                        opt.disabled = true;
                    }
                });

            });
        }


        /* =========================
           TRIGGER SELECT UPDATE
        ========================= */
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('pricingTypeSelect')) {
                updatePricingTypeOptions();
            }
        });

        function togglePricingInputs(card) {

            let rulesCount = card.querySelectorAll('.rule-group').length;

            let priceInput = [...card.querySelectorAll('input[name*="[price]"]')]
    .find(i => !i.closest('.rule-group'));

let saleInput = [...card.querySelectorAll('input[name*="[sale_price]"]')]
    .find(i => !i.closest('.rule-group'));

            if (!priceInput || !saleInput) return;

            if (rulesCount > 0) {
                // disable + clear
                priceInput.value = '';
                saleInput.value = '';

                priceInput.disabled = true;
                saleInput.disabled = true;
            } else {
                // enable
                priceInput.disabled = false;
                saleInput.disabled = false;
            }
        }

        function initExistingPricingState() {

            document.querySelectorAll('.pricing-type-card').forEach(card => {
                togglePricingInputs(card);
            });

        }


        /* =========================
           SPECIES -> BREED
        ========================= */
        /* =========================
       LOAD BREEDS
    ========================= */
        function loadBreeds(speciesSelect, selectedBreed = null) {

            let breed = speciesSelect.closest('.rule-group').querySelector('.breed');

            breed.innerHTML = `<option>Loading...</option>`;

            return fetch(`/admin/get-breeds/${speciesSelect.value}`)
                .then(r => r.json())
                .then(data => {

                    breed.innerHTML = `<option value="">Any Breed</option>`;

                    data.forEach(b => {
                        breed.innerHTML += `<option value="${b.id}">${b.name}</option>`;
                    });

                    if (selectedBreed) {
                        breed.value = selectedBreed;
                    }

                    return selectedBreed;
                })
                .catch(() => {
                    breed.innerHTML = `<option>Error loading</option>`;
                });
        }


        /* =========================
           LOAD SIZES
        ========================= */
        function loadSizes(breedSelect, selectedSize = null) {

            let size = breedSelect.closest('.rule-group').querySelector('.size');

            size.innerHTML = `<option>Loading...</option>`;

            return fetch(`/get-sizes/${breedSelect.value}`)
                .then(r => r.json())
                .then(data => {

                    size.innerHTML = `<option value="">Any Size</option>`;

                    data.forEach(s => {
                        size.innerHTML += `<option value="${s.id}">${s.name}</option>`;
                    });

                    if (selectedSize) {
                        size.value = selectedSize;
                    }
                })
                .catch(() => {
                    size.innerHTML = `<option>Error loading</option>`;
                });
        }


        /* =========================
           HEADER UPDATE
        ========================= */
        function updateHeaders() {

            document.querySelectorAll('.pricing-type-card').forEach((card, i) => {

                let h = card.querySelector('.pricing-header');
                if (h) h.innerText = `Pricing ${i + 1}`;

                togglePricingInputs(card);
            });
        }

        function reindexRules(card) {

    let ruleCards = card.querySelectorAll('.rulesContainer .card');

    ruleCards.forEach((el, i) => {

        el.querySelectorAll('input, select').forEach(input => {

            input.name = input.name.replace(/rules\[\d+\]/, `rules[${i}]`);
        });
    });
}   
    </script>

    <script>
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    document.getElementById('deleted_rules').value = JSON.stringify(deletedRules);
    let form = this;
    let formData = new FormData(form);
    let submitBtn = form.querySelector('button[type="submit"]');

    submitBtn.disabled = true;
    let originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = 'Updating...';

    let loader = document.getElementById('globalLoader');
    loader.style.display = 'flex';

    fetch(form.action, {
        method: "POST", // Laravel uses POST + _method=PUT
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: formData
    })
    .then(async res => {

        let data = await res.json();

        if (!res.ok) {

            if (data.errors) {
                Object.values(data.errors).forEach(errArr => {
                    errArr.forEach(msg => toastr.error(msg));
                });
            } else {
                toastr.error(data.message || 'Update failed');
            }

            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
            loader.style.display = 'none';

        } else {

            toastr.success(data.message);

            setTimeout(() => {
                window.location.href = "{{ route('serviceManagement') }}";
            }, 1000);
        }

    })
    .catch(err => {

        console.error(err);
        toastr.error('Server error!');

        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        loader.style.display = 'none';
    });
});
</script>
@endsection
