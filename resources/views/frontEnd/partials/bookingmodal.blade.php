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


{{-- Booking Modal Script - Handles opening, closing, form steps, and data collection for service bookings. --}}
<script>
    // Booking Modal Functionality
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
    const modalCloseBtn = document.querySelectorAll('.modal-close-btn');

    let currentServiceData = {};

    // Open modal when plus button clicked
    document.querySelectorAll('.open-booking-modal').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            currentServiceData = {
                name: btn.dataset.serviceName,
                price: btn.dataset.servicePrice,
                image: btn.dataset.serviceImage,
                desc: btn.dataset.serviceDesc
            };
            openModal();
        });
    });

    function openModal() {
        document.getElementById('serviceName').textContent = currentServiceData.name;
        document.getElementById('servicePrice').textContent = '$' + currentServiceData.price;
        document.getElementById('serviceDesc').textContent = currentServiceData.desc;
        document.getElementById('serviceImage').src = currentServiceData.image;

        bookingModal.classList.add('active');
        document.body.style.overflow = 'hidden';
        generatePetInputs(1);
    }

    function closeModal() {
        bookingModal.classList.remove('active');
        document.body.style.overflow = 'auto';
        resetForm();
        showStep(1);
    }

    // Close modal handlers
    modalCloseBtn.forEach(btn => {
        btn.addEventListener('click', closeModal);
    });

    bookingCancelBtn.addEventListener('click', closeModal);

    // Close on overlay click
    document.querySelector('.booking-modal-overlay').addEventListener('click', closeModal);

    // Pet count handler
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
                            <label for="petType_${i}">Pet ${i + 1} Type</label>
                            <select id="petType_${i}" name="petType[]" class="pet-type-select" required>
                                <option value="">Select Type</option>
                                <option value="dog">Dog</option>
                                <option value="cat">Cat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="petName_${i}">Pet ${i + 1} Name</label>
                            <input type="text" id="petName_${i}" name="petName[]" placeholder="e.g., Max" required>
                        </div>
                    `;
            petsContainer.appendChild(petEntry);
        }
    }

    // Next button handler
    bookingNextBtn.addEventListener('click', () => {
        if (bookingForm.checkValidity()) {
            populateSummary();
            showStep(2);
        } else {
            bookingForm.reportValidity();
        }
    });

    // Back button handler
    bookingBackBtn.addEventListener('click', () => {
        showStep(1);
    });

    function showStep(stepNumber) {
        if (stepNumber === 1) {
            step2.classList.remove('booking-step-active');
            step2.classList.add('booking-step-prev');
            step1.classList.remove('booking-step-prev');
            step1.classList.add('booking-step-active');
        } else {
            step1.classList.remove('booking-step-active');
            step1.classList.add('booking-step-prev');
            step2.classList.remove('booking-step-prev');
            step2.classList.add('booking-step-active');
        }
    }

    function populateSummary() {
        const date = document.getElementById('bookingDate').value;
        const time = document.getElementById('bookingTime').value;
        const petCount = parseInt(document.getElementById('petCount').value);

        // Format date
        const dateObj = new Date(date + 'T00:00:00');
        const formattedDate = dateObj.toLocaleDateString('en-US', {
            weekday: 'short',
            month: 'short',
            day: 'numeric'
        });

        document.getElementById('summaryService').textContent = currentServiceData.name;
        document.getElementById('summaryPrice').textContent = '$' + currentServiceData.price;
        document.getElementById('summaryDate').textContent = formattedDate;
        document.getElementById('summaryTime').textContent = time;

        // Build pet summary
        const petTypeSelects = document.querySelectorAll('.pet-type-select');
        const petNameInputs = document.querySelectorAll('input[name="petName[]"]');
        const summaryPetsDiv = document.getElementById('summaryPets');
        summaryPetsDiv.innerHTML = '';

        for (let i = 0; i < petCount; i++) {
            const petType = petTypeSelects[i].value;
            const petName = petNameInputs[i].value;
            const petSummary = document.createElement('div');
            petSummary.className = 'summary-pet-item';
            petSummary.textContent = `${petName} (${petType.charAt(0).toUpperCase() + petType.slice(1)})`;
            summaryPetsDiv.appendChild(petSummary);
        }
    }

    // Confirm booking handler
    bookingConfirmBtn.addEventListener('click', () => {
        const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');

        if (!paymentMethod) {
            alert('Please select a payment method');
            return;
        }

        // Collect form data
        const bookingData = {
            service: currentServiceData.name,
            price: currentServiceData.price,
            date: document.getElementById('bookingDate').value,
            time: document.getElementById('bookingTime').value,
            petCount: document.getElementById('petCount').value,
            pets: [],
            paymentMethod: paymentMethod.value
        };

        document.querySelectorAll('.pet-entry').forEach((entry, index) => {
            const type = entry.querySelector('select').value;
            const name = entry.querySelector('input').value;
            bookingData.pets.push({
                type,
                name
            });
        });

        console.log('Booking Data:', bookingData);
        alert(`Booking confirmed! Payment method: ${paymentMethod.value.toUpperCase()}`);
        closeModal();
    });

    function resetForm() {
        bookingForm.reset();
        document.getElementById('petCount').value = 1;
        generatePetInputs(1);
        document.querySelectorAll('input[name="paymentMethod"]')[0].checked = false;
    }
</script>
