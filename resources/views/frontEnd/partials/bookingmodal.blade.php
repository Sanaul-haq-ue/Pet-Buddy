<!-- Service Booking Modal -->
<div id="bookingModal" class="booking-modal">
    <div class="booking-modal-overlay"></div>
    <div class="booking-modal-container">
        <!-- Step 1: Service Details & Booking Form -->
        <div class="booking-step booking-step-active" id="step1">
           
            <div class="booking-modal-content">
                <button class="modal-close-btn">&times;</button>

                <!-- Service Details Header -->
                <div class="booking-service-header">
                    <div class="service-detail-image">
                        <img id="serviceImage" src="" alt="Service">
                    </div>
                    <div class="service-detail-info">
                        <h2 id="serviceName" class="service-detail-title">Service Name</h2>
                        <p id="serviceDesc" class="service-detail-desc">Service description</p>
                        <div class="service-detail-price">
                            <span class="price-label">Price:</span>
                            <span id="servicePrice" class="price-value">$45.00</span>
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <form id="bookingForm" class="booking-form">
                    <h3 class="form-section-title">Your Pet Details</h3>

                    <div class="form-group">
                        <label for="bookingDate">Preferred Date</label>
                        <input type="date" id="bookingDate" name="date" required>
                    </div>

                    <div class="form-group">
                        <label for="bookingTime">Preferred Time</label>
                        <input type="time" id="bookingTime" name="time" required>
                    </div>

                    <div class="form-group">
                        <label for="petCount">Number of Pets</label>
                        <input type="number" id="petCount" name="petCount" min="1" max="10"
                            value="1" required>
                    </div>

                    <div id="petsContainer" class="pets-container">
                        <div class="pet-entry">
                            <div class="form-group">
                                <label for="petType_0">Pet Type</label>
                                <select id="petType_0" name="petType[]" class="pet-type-select" required>
                                    <option value="">Select Type</option>
                                    <option value="dog">Dog</option>
                                    <option value="cat">Cat</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="petName_0">Pet Name</label>
                                <input type="text" id="petName_0" name="petName[]" placeholder="e.g., Max" required>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Form Actions -->
                <div class="booking-actions">
                    <button type="button" class="btn-outline booking-cancel-btn">Cancel</button>
                    <button type="button" class="btn-primary booking-next-btn">Next</button>
                </div>
            </div>
        
        </div>

        <!-- Step 2: Payment & Summary -->
        <div class="booking-step" id="step2">
            <div class="booking-modal-content">
                <button class="modal-close-btn">&times;</button>

                <h2 class="step2-title">Booking Summary</h2>

                <!-- Summary Section -->
                <div class="booking-summary">
                    <div class="summary-section">
                        <h3 class="summary-section-title">Service Details</h3>
                        <div class="summary-item">
                            <span class="summary-label">Service:</span>
                            <span id="summaryService" class="summary-value">Artisan Grooming</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Price:</span>
                            <span id="summaryPrice" class="summary-value">$45.00</span>
                        </div>
                    </div>

                    <div class="summary-section">
                        <h3 class="summary-section-title">Booking Details</h3>
                        <div class="summary-item">
                            <span class="summary-label">Date:</span>
                            <span id="summaryDate" class="summary-value">-</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Time:</span>
                            <span id="summaryTime" class="summary-value">-</span>
                        </div>
                    </div>

                    <div class="summary-section">
                        <h3 class="summary-section-title">Pet Information</h3>
                        <div id="summaryPets" class="summary-pets">
                            <!-- Pet summary items will be inserted here -->
                        </div>
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="payment-section">
                    <h3 class="payment-title">Select Payment Method</h3>

                    <div class="payment-methods">
                        <label class="payment-option">
                            <input type="radio" name="paymentMethod" value="bkash" class="payment-radio">
                            <div class="payment-method-box">
                                <span class="payment-method-name">bKash</span>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Bkash_Logo.svg/1200px-Bkash_Logo.svg.png"
                                    alt="bKash" class="payment-logo">
                            </div>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="paymentMethod" value="nagad" class="payment-radio">
                            <div class="payment-method-box">
                                <span class="payment-method-name">Nagad</span>
                                <img src="https://www.nagad.com.bd/assets/img/logo.png" alt="Nagad"
                                    class="payment-logo">
                            </div>
                        </label>
                    </div>

                    <div id="paymentExtra" style="display:none;">
                        <div class="form-group">
                            <label>Account Number</label>
                            <input type="text" id="accountNumber">
                        </div>
                        <div class="form-group">
                            <label>Transaction ID</label>
                            <input type="text" id="transactionId">
                        </div>
                    </div>

                </div>

                <!-- Payment Actions -->
                <div class="booking-actions">
                    <button type="button" class="btn-outline booking-back-btn">Go Back</button>
                    <button type="button" class="btn-primary booking-confirm-btn">Book Now</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Login Required Modal -->
<div id="loginModal" class="booking-modal">
    <div class="booking-modal-overlay"></div>

    <div class="booking-modal-container" style="max-width:400px;">
        <div class="booking-modal-content text-center">
            
            <button class="modal-close-btn login-close">&times;</button>

            <h2 style="margin-bottom:10px;">Login Required</h2>
            <p style="margin-bottom:20px;">
                Please login first to book a service.
            </p>

            <a href="{{ route('login') }}" class="btn-primary" style="display:inline-block;">
                Login Now
            </a>

        </div>
    </div>
</div>

{{-- Booking Modal Script - Handles opening, closing, form steps, and data collection for service bookings. --}}
<script>
    const isLoggedIn = @json(auth()->check());
</script>
<script>
/* ===============================
   TOASTR SETTINGS
================================*/
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: "toast-top-right",
    timeOut: "3000"
};

/* ===============================
   GLOBAL VARIABLES
================================*/
const bookingModal = document.getElementById('bookingModal');
const bookingForm = document.getElementById('bookingForm');
const petCountInput = document.getElementById('petCount');
const petsContainer = document.getElementById('petsContainer');

const step1 = document.getElementById('step1');
const step2 = document.getElementById('step2');

const bookingNextBtn = document.querySelector('.booking-next-btn');
const bookingBackBtn = document.querySelector('.booking-back-btn');
const bookingCancelBtn = document.querySelector('.booking-cancel-btn');
const bookingConfirmBtn = document.querySelector('.booking-confirm-btn');

const modalCloseBtns = document.querySelectorAll('.modal-close-btn');

let currentServiceData = {};

/* ===============================
   OPEN MODAL WITH DATA
================================*/
document.querySelectorAll('.open-booking-modal').forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();

        // ❌ Not logged in → show login modal
        if (!isLoggedIn) {
            openLoginModal();
            return;
        }

        // ✅ Logged in → open booking modal
        currentServiceData = {
            id: btn.dataset.serviceId,
            name: btn.dataset.serviceName,
            price: btn.dataset.servicePrice,
            timing: btn.dataset.serviceTiming,
            image: btn.dataset.serviceImage,
            location: btn.dataset.serviceLocation
        };

        openModal();
    });
});

const loginModal = document.getElementById('loginModal');

function openLoginModal() {
    loginModal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLoginModal() {
    loginModal.classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Close button
document.querySelector('.login-close')
    .addEventListener('click', closeLoginModal);

// Overlay click
loginModal.querySelector('.booking-modal-overlay')
    .addEventListener('click', closeLoginModal);

function openModal() {
    document.getElementById('serviceName').textContent = currentServiceData.name;
    document.getElementById('servicePrice').textContent =
        '$' + currentServiceData.price + currentServiceData.timing;

    document.getElementById('serviceDesc').textContent =
        currentServiceData.location;

    document.getElementById('serviceImage').src =
        currentServiceData.image;

    bookingModal.classList.add('active');
    document.body.style.overflow = 'hidden';

    generatePetInputs(1);
}

/* ===============================
   CLOSE MODAL
================================*/
function closeModal() {
    bookingModal.classList.remove('active');
    document.body.style.overflow = 'auto';
    resetForm();
    showStep(1);
}

modalCloseBtns.forEach(btn => btn.addEventListener('click', closeModal));
bookingCancelBtn.addEventListener('click', closeModal);

document.querySelector('.booking-modal-overlay')
    .addEventListener('click', closeModal);

/* ===============================
   PET INPUT GENERATOR
================================*/
petCountInput.addEventListener('change', (e) => {
    generatePetInputs(parseInt(e.target.value));
});

function generatePetInputs(count) {
    petsContainer.innerHTML = '';

    for (let i = 0; i < count; i++) {
        const petEntry = document.createElement('div');
        petEntry.className = 'pet-entry';

        petEntry.innerHTML = `
            <div class="form-group">
                <label>Pet ${i + 1} Type</label>
                <select name="petType[]" class="pet-type-select" required>
                    <option value="">Select Type</option>
                    <option value="dog">Dog</option>
                    <option value="cat">Cat</option>
                </select>
            </div>

            <div class="form-group">
                <label>Pet ${i + 1} Name</label>
                <input type="text" name="petName[]" required>
            </div>
        `;

        petsContainer.appendChild(petEntry);
    }
}

/* ===============================
   STEP HANDLING
================================*/
bookingNextBtn.addEventListener('click', () => {
    if (bookingForm.checkValidity()) {
        populateSummary();
        showStep(2);
    } else {
        bookingForm.reportValidity();
    }
});

bookingBackBtn.addEventListener('click', () => {
    showStep(1);
});

function showStep(step) {
    if (step === 1) {
        step2.classList.remove('booking-step-active');
        step1.classList.add('booking-step-active');
    } else {
        step1.classList.remove('booking-step-active');
        step2.classList.add('booking-step-active');
    }
}

/* ===============================
   SUMMARY
================================*/
function populateSummary() {
    const date = document.getElementById('bookingDate').value;
    const time = document.getElementById('bookingTime').value;

    const formattedDate = new Date(date).toLocaleDateString('en-US', {
        weekday: 'short',
        month: 'short',
        day: 'numeric'
    });

    document.getElementById('summaryService').textContent = currentServiceData.name;
    document.getElementById('summaryPrice').textContent =
        '$' + currentServiceData.price + currentServiceData.timing;

    document.getElementById('summaryDate').textContent = formattedDate;
    document.getElementById('summaryTime').textContent = time;

    const summaryPets = document.getElementById('summaryPets');
    summaryPets.innerHTML = '';

    document.querySelectorAll('.pet-entry').forEach(entry => {
        const type = entry.querySelector('select').value;
        const name = entry.querySelector('input').value;

        const div = document.createElement('div');
        div.textContent = `${name} (${type})`;

        summaryPets.appendChild(div);
    });
}

/* ===============================
   PAYMENT EXTRA FIELD SHOW
================================*/
document.querySelectorAll('.payment-radio').forEach(radio => {
    radio.addEventListener('change', () => {
        document.getElementById('paymentExtra').style.display = 'block';
    });
});

/* ===============================
   SUBMIT BOOKING (AJAX)
================================*/
bookingConfirmBtn.addEventListener('click', () => {

    const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');

    if (!paymentMethod) {
        toastr.error('Select payment method');
        return;
    }

    const accountNumber = document.getElementById('accountNumber').value;
    const transactionId = document.getElementById('transactionId').value;

    if (!accountNumber || !transactionId) {
        toastr.error('Payment details required');
        return;
    }

    const bookingData = {
        service_id: currentServiceData.id,
        date: document.getElementById('bookingDate').value,
        time: document.getElementById('bookingTime').value,
        pet_count: document.getElementById('petCount').value,
        payment_method: paymentMethod.value,
        account_number: accountNumber,
        transaction_id: transactionId,
        pets: []
    };

    document.querySelectorAll('.pet-entry').forEach(entry => {
        bookingData.pets.push({
            type: entry.querySelector('select').value,
            name: entry.querySelector('input').value
        });
    });

    fetch("{{ route('user.booking.store') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify(bookingData)
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            toastr.success(res.message);
            closeModal();
        } else {
            toastr.error(res.message);
        }
    })
    .catch(() => {
        toastr.error('Server error');
    });
});

/* ===============================
   RESET FORM
================================*/
function resetForm() {
    bookingForm.reset();
    petCountInput.value = 1;
    generatePetInputs(1);

    document.getElementById('paymentExtra').style.display = 'none';

    document.querySelectorAll('input[name="paymentMethod"]')
        .forEach(r => r.checked = false);
}
</script>
