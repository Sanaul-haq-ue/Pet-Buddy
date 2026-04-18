// Dashboard Interactive Functionality

document.addEventListener('DOMContentLoaded', function() {
    // Initialize
    initializeDashboard();
});

function initializeDashboard() {
    // Add fade-in-up animation to elements
    const elements = document.querySelectorAll('.glass-card, section');
    elements.forEach((el, index) => {
        setTimeout(() => {
            el.classList.add('fade-in-up');
        }, index * 50);
    });

    // Pet card interactions
    initializePetCards();

    // Appointment card interactions
    initializeAppointmentCards();

    // Button interactions
    initializeButtons();

    // Navbar active state
    initializeNavbar();
}

/**
 * Initialize pet card hover effects and interactions
 */
function initializePetCards() {
    const petCards = document.querySelectorAll('.pet-card');
    
    petCards.forEach(card => {
        const petImage = card.querySelector('.pet-image');
        
        card.addEventListener('mouseenter', () => {
            if (petImage) {
                petImage.style.transform = 'scale(1.1)';
            }
        });
        
        card.addEventListener('mouseleave', () => {
            if (petImage) {
                petImage.style.transform = 'scale(1)';
            }
        });

        card.addEventListener('click', () => {
            console.log('Pet clicked');
            // Can add navigation or modal functionality here
        });
    });
}

/**
 * Initialize appointment card interactions
 */
function initializeAppointmentCards() {
    const appointmentCards = document.querySelectorAll('.appointment-card');
    
    appointmentCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateX(10px)';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateX(0)';
        });

        card.addEventListener('click', () => {
            console.log('Appointment clicked');
            // Can add appointment details modal here
        });
    });
}

/**
 * Initialize button interactions
 */
function initializeButtons() {
    const bookServiceBtn = document.querySelector('[data-action="book-service"]');
    const buyFoodBtn = document.querySelector('[data-action="buy-food"]');
    const addPetBtn = document.querySelector('[data-action="add-pet"]');
    const viewHistoryBtn = document.querySelector('[data-action="view-history"]');

    // Book Service
    if (bookServiceBtn) {
        bookServiceBtn.addEventListener('click', () => {
            handleBookService();
        });
    }

    // Buy Food
    if (buyFoodBtn) {
        buyFoodBtn.addEventListener('click', () => {
            handleBuyFood();
        });
    }

    // Add Pet
    if (addPetBtn) {
        addPetBtn.addEventListener('click', () => {
            handleAddPet();
        });
    }

    // View History
    if (viewHistoryBtn) {
        viewHistoryBtn.addEventListener('click', () => {
            handleViewHistory();
        });
    }

    // Edit buttons
    const editButtons = document.querySelectorAll('[data-action="edit-profile"], [data-action="edit-pet"]');
    editButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            handleEdit(btn);
        });
    });
}

/**
 * Initialize navbar active state
 */
function initializeNavbar() {
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });
}

/**
 * Handle book service action
 */
function handleBookService() {
    console.log('Book Service clicked');
    // Add your booking logic here
    // Example: window.location.href = '/user/bookings';
}

/**
 * Handle buy food action
 */
function handleBuyFood() {
    console.log('Buy Pet Food clicked');
    // Add your shop navigation logic here
    // Example: window.location.href = '/shop';
}

/**
 * Handle add pet action
 */
function handleAddPet() {
    console.log('Add Pet clicked');
    // Add your add pet modal or navigation logic here
}

/**
 * Handle view history action
 */
function handleViewHistory() {
    console.log('View Booking History clicked');
    // Add your booking history navigation logic here
}

/**
 * Handle edit action
 */
function handleEdit(button) {
    console.log('Edit clicked');
    // Add your edit modal or navigation logic here
}

/**
 * Smooth scroll to section
 */
function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

/**
 * Toast notification helper
 */
function showNotification(message, type = 'info') {
    // This can be integrated with toastr or a custom notification system
    console.log(`[${type.toUpperCase()}] ${message}`);
}

/**
 * Format date helper
 */
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date(dateString).toLocaleDateString('en-US', options);
}

/**
 * Handle responsive behavior
 */
function handleResponsive() {
    const isMobile = window.innerWidth < 768;
    
    if (isMobile) {
        // Add mobile-specific behaviors
        console.log('Mobile view detected');
    }
}

// Handle window resize
window.addEventListener('resize', handleResponsive);

// Initial responsive check
handleResponsive();

// Export functions for use in other files if needed
window.dashboardFunctions = {
    scrollToSection,
    showNotification,
    formatDate,
    handleEdit
};
