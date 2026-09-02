@extends('backEnd.layouts.master')

@section('adminContent')
    <div class="mx-auto">

        <h1 class="mb-4">Create New Service</h1>

        <form method="POST" action="{{ route('saveService') }}" enctype="multipart/form-data">
            @csrf

            <!-- BASIC INFO -->
            <div class="card">
                <h3>Service Info</h3>

                <div class="grid">
                    <input type="text" name="name" placeholder="Service Name">

                    <select name="category_id">
                        <option>Select Category</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>

                    <select name="company_id">
                        <option>Select Company</option>
                        @foreach ($companies as $c)
                            <option value="{{ $c->id }}">{{ $c->company_name }}</option>
                        @endforeach
                    </select>

                    <select name="service_type" id="serviceType">
                        <option value="">Select Service Type</option>
                        <option value="Appointments">Appointments</option>
                        <option value="Duration">Duration</option>
                        <option value="Package">Package</option>
                    </select>

                    <input type="file" name="image" accept="image/*">
                </div>

                <textarea name="description" class="mt-2" placeholder="Description"></textarea>
            </div>

            <!-- LOCATION -->
            <div class="card">
                <h3>Location</h3>

                <div class="grid">
                    <select id="district" name="district_id">
                        <option>Select District</option>
                        @foreach ($districts as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>

                    <select id="upazila" name="upazila_id">
                        <option value="">Select Upazila</option>
                    </select>

                    <select id="union" name="union_id">
                        <option value="">Select Union</option>
                    </select>

                    <input type="text" name="location" placeholder="Detailed Location">
                </div>
            </div>


            <div class="card">
                <div id="appointmentPricing">

                    <h3>Appointment Pricing</h3>

                    <div class="pricing-type-card mt-2" data-index="0">

                        <div class="defaultPricing grid">
                            <input type="text" name="pricing_types[0][type]" value="Session" readonly>
                            <input type="number" name="pricing_types[0][price]" placeholder="Price">
                            <input type="number" name="pricing_types[0][sale_price]" placeholder="Sale Price">
                        </div>

                        <div class="rulesContainer"></div>
                        <button type="button" class="addRule btn-primary mt-2">+ Add Rule</button>
                    </div>

                </div>

                <!-- PRICING -->
                <div id="durationPricing" style="display:none;">

                    <div id="pricingTypesContainer">
                        
                    </div>
                    <button type="button" id="addPricingType" class="btn-primary">
                        + New Pricing Type
                    </button>
                </div>
            </div>

            <div class="card">
                <h3>Service Schedule</h3>

                <div class="grid">

                    <!-- DAYS -->
                    <select name="day_of_week[]" class="select2" multiple>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>

                    <!-- START TIME -->
                    <input type="text" id="start_time" name="start_time" placeholder="Start Time">

                    <!-- END TIME -->
                    <input type="text" id="end_time" name="end_time" placeholder="End Time">

                    <!-- OFF DATES -->
                    <input type="text" id="off_dates" name="off_dates" placeholder="Off Dates (select multiple)">
                </div>
            </div>

            <button class="btn-primary" type="submit">Save Service</button>

        </form>
    </div>

    <div id="globalLoader">
        <div class="loader"></div>
    </div>

    <script>
        let pricingTypeIndex = 0;

        /* =========================
           SERVICE TYPE SWITCH
        ========================= */
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

                // reset pricing types when switching
                document.getElementById('pricingTypesContainer').innerHTML = '';
                pricingTypeIndex = 0;

                // create first pricing type
                document.getElementById('addPricingType').click();
            } else {
                appointment.style.display = 'none';
                duration.style.display = 'none';
            }
        });


        /* =========================
           ADD PRICING TYPE
        ========================= */
        document.getElementById('addPricingType').addEventListener('click', function() {

            let container = document.getElementById('pricingTypesContainer');
            let index = pricingTypeIndex;

            let serviceType = document.getElementById('serviceType').value;

            let typeField = '';
            let extraFields = '';

            /* ===== Duration ===== */
            if (serviceType === 'Duration') {

                typeField = `
                    <select name="pricing_types[${index}][type]" class="pricingTypeSelect">
                        <option value="">Select Type</option>
                    </select>
                `;
            }

            /* ===== Package ===== */
            else if (serviceType === 'Package') {

                typeField = `
                    <input type="text" name="pricing_types[${index}][type]" value="Package" readonly>
                    
                `;

                extraFields = `
                    <input type="number" name="pricing_types[${index}][qty]" placeholder="Quantity">

                    <input type="text" name="pricing_types[${index}][time]" placeholder="Time (e.g. 7 days)">

                    <input type="text" name="pricing_types[${index}][label]" placeholder="Label (e.g. Premium)">
                `;
            }

            let div = document.createElement('div');
            div.classList.add('pricing-type-card');
            div.setAttribute('data-index', index);

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

                <button type="button" class="btn-danger removePricingType mt-2">✕</button>
            `;

            container.appendChild(div);

            pricingTypeIndex++;
            updatePricingTypeOptions();
            updatePricingHeaders();
        });

        function updatePricingHeaders() {

            let serviceType = document.getElementById('serviceType').value;

            let cards = document.querySelectorAll('#pricingTypesContainer .pricing-type-card');

            cards.forEach((card, i) => {

                let header = card.querySelector('.pricing-header');

                if (!header) return;

                if (serviceType === 'Duration') {
                    header.innerText = `Pricing Type ${i + 1}`;
                } else if (serviceType === 'Package') {
                    header.innerText = `Package ${i + 1}`;
                }
            });
        }


        /* =========================
           ADD RULE (ALL TYPES)
        ========================= */
        document.addEventListener('click', function(e) {

            if (e.target.classList.contains('addRule')) {

                let card = e.target.closest('.pricing-type-card');
                let priceInput = card.querySelector('input[name*="[price]"]:not(.rule-group input)');
                let saleInput = card.querySelector('input[name*="[sale_price]"]:not(.rule-group input)');

                /* clear + disable default pricing */
                if (priceInput) {
                    priceInput.value = '';
                    priceInput.disabled = true;
                }

                if (saleInput) {
                    saleInput.value = '';
                    saleInput.disabled = true;
                }
                let index = card.getAttribute('data-index');
                let container = card.querySelector('.rulesContainer');

                let ruleCount = container.children.length;

                let div = document.createElement('div');
                div.classList.add('card');

                div.innerHTML = `
                    <div style="display:flex; align-items:center; gap:10px;">
                        
                        <div class="rule-group" style ="    width: stretch; position:relative;">
                            <h4 style="margin-bottom:10px;">Rule ${ruleCount + 1}</h4>
                            <div class="grid">
                                <select name="pricing_types[${index}][rules][${ruleCount}][species_id]" class="species">
                                    <option value="">Any Species</option>
                                    @foreach ($species as $sp)
                                        <option value="{{ $sp->id }}">{{ $sp->species_name }}</option>
                                    @endforeach
                                </select>

                                <select name="pricing_types[${index}][rules][${ruleCount}][breed_id]" class="breed">
                                    <option value="">Any Breed</option>
                                </select>

                                <select name="pricing_types[${index}][rules][${ruleCount}][size_id]" class="size">
                                    <option value="">Any Size</option>
                                </select>

                                <input type="number" name="pricing_types[${index}][rules][${ruleCount}][price]" placeholder="Price">
                                <input type="number" name="pricing_types[${index}][rules][${ruleCount}][sale_price]" placeholder="Sale Price">
                            </div>
                        </div>
                        <button type="button" class="removeRule btn-danger">✕</button>
                    </div>
                `;

                container.appendChild(div);
            }
        });


        /* =========================
           REMOVE RULE
        ========================= */
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeRule')) {

                let card = e.target.closest('.pricing-type-card');
                e.target.closest('.card').remove();

                let remainingRules = card.querySelectorAll('.rule-group').length;

                if (remainingRules === 0) {

                    let priceInput = card.querySelector('input[name*="[price]"]:not(.rule-group input)');
                    let saleInput = card.querySelector('input[name*="[sale_price]"]:not(.rule-group input)');

                    if (priceInput) priceInput.disabled = false;
                    if (saleInput) saleInput.disabled = false;
                }
            }
        });


        /* =========================
           REMOVE PRICING TYPE
        ========================= */
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('removePricingType')) {
                e.target.closest('.pricing-type-card').remove();
                updatePricingTypeOptions();
                updatePricingHeaders();
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

        /* SPECIES -> BREED */
        document.addEventListener('change', function(e) {

            if (e.target.classList.contains('species')) {

                let speciesId = e.target.value;
                let breedSelect = e.target.closest('.rule-group').querySelector('.breed');

                // loading
                breedSelect.innerHTML = `<option>Loading...</option>`;

                fetch(`/admin/get-breeds/${speciesId}`)
                    .then(res => res.json())
                    .then(data => {

                        breedSelect.innerHTML = `<option value="0">Any Breed</option>`;

                        data.forEach(b => {
                            breedSelect.innerHTML += `<option value="${b.id}">${b.name}</option>`;
                        });

                    })
                    .catch(() => {
                        breedSelect.innerHTML = `<option>Error loading</option>`;
                    });
            }
        });

        /* BREED -> SIZE */
        document.addEventListener('change', function(e) {

            if (e.target.classList.contains('breed')) {

                let breedId = e.target.value;
                let sizeSelect = e.target.closest('.rule-group').querySelector('.size');

                // loading
                sizeSelect.innerHTML = `<option>Loading...</option>`;

                fetch(`/get-sizes/${breedId}`)
                    .then(res => res.json())
                    .then(data => {

                        sizeSelect.innerHTML = `<option value="0">Any Size</option>`;

                        data.forEach(s => {
                            sizeSelect.innerHTML += `<option value="${s.id}">${s.name}</option>`;
                        });

                    })
                    .catch(() => {
                        sizeSelect.innerHTML = `<option>Error loading</option>`;
                    });
            }
        });

        /* DISTRICT -> UPAZILA */
        document.getElementById('district').addEventListener('change', function() {

            let id = this.value;
            let upazila = document.getElementById('upazila');

            // show loading
            upazila.innerHTML = `<option>Loading...</option>`;

            fetch(`/admin/get-upazilas/${id}`)
                .then(res => res.json())
                .then(data => {

                    upazila.innerHTML = `<option value="">Select Upazila</option>`;

                    data.forEach(u => {
                        upazila.innerHTML += `<option value="${u.id}">${u.name}</option>`;
                    });

                })
                .catch(() => {
                    upazila.innerHTML = `<option>Error loading data</option>`;
                });
        });

        /* UPAZILA -> UNION */
        document.getElementById('upazila').addEventListener('change', function() {

            let id = this.value;
            let union = document.getElementById('union');

            // loading
            union.innerHTML = `<option>Loading...</option>`;

            fetch(`/admin/get-unions/${id}`)
                .then(res => res.json())
                .then(data => {

                    union.innerHTML = `<option value="">Select Union</option>`;

                    data.forEach(u => {
                        union.innerHTML += `<option value="${u.id}">${u.name}</option>`;
                    });

                })
                .catch(() => {
                    union.innerHTML = `<option>Error loading data</option>`;
                });
        });

        $(document).ready(function() {

            /* =====================
               SELECT2 DAYS
            ===================== */
            $('.select2').select2({
                placeholder: "Select working days"
            });

            /* =====================
               TIME PICKER
            ===================== */
            flatpickr("#start_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "h:i K",
                time_24hr: false,
            });

            flatpickr("#end_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "h:i K",
                time_24hr: false,
            });

            /* =====================
               MULTI DATE PICKER
            ===================== */
            flatpickr("#off_dates", {
                mode: "multiple",
                dateFormat: "Y-m-d"
            });

        });
    </script>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);

            let submitBtn = form.querySelector('button[type="submit"]');

            // =========================
            // DISABLE BUTTON + LOADER
            // =========================
            submitBtn.disabled = true;
            let originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Processing...';

            let loader = document.getElementById('globalLoader');
            loader.style.display = 'flex';

            fetch(form.action, {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                })
                .then(async res => {

                    let data = await res.json();

                    if (!res.ok) {

                        // =========================
                        // VALIDATION ERRORS
                        // =========================
                        if (data.errors) {
                            Object.values(data.errors).forEach(errArr => {
                                errArr.forEach(msg => {
                                    toastr.error(msg);
                                });
                            });
                        } else {
                            toastr.error(data.message || 'Something went wrong');
                        }

                        // restore button + loader
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                        loader.style.display = 'none';

                    } else {

                        toastr.success(data.message);

                        // =========================
                        // REDIRECT AFTER SUCCESS
                        // =========================
                        setTimeout(() => {
                            window.location.href = "{{ route('serviceManagement') }}";
                        }, 1000);
                    }

                })
                .catch(err => {
                    console.error(err);
                    toastr.error('Server error!');

                    // restore button + loader
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                    loader.style.display = 'none';
                });
        });
    </script>

@endsection
