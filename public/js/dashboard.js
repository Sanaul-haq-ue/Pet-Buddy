// Dashboard Interactive Functionality

document.addEventListener('DOMContentLoaded', function() {
    // Initialize dashboard
    initializeDashboard();
});

function initializeDashboard() {
    // Initialize tab switching
    initializeTabSwitching();

    // Initialize forms
    initializeForms();

    // Initialize profile image upload
    initializeProfileImageUpload();

    // Add fade-in animations
    initializeAnimations();

    // Initialize responsive sidebar
    initializeResponsiveSidebar();
}

/**
 * Initialize tab switching functionality
 */
function initializeTabSwitching() {
    const navTabs = document.querySelectorAll('.nav-tab');
    const tabContents = document.querySelectorAll('.tab-content');

    console.log('Initializing tab switching...');
    console.log('Found nav tabs:', navTabs.length);
    console.log('Found tab contents:', tabContents.length);

    // Initially hide all tab contents except the active one
    tabContents.forEach(content => {
        if (!content.classList.contains('active')) {
            content.style.display = 'none';
        }
    });

    navTabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            const tabId = this.getAttribute('data-tab');
            console.log('Switching to tab:', tabId);

            // Remove active class from all tabs
            navTabs.forEach(t => {
                t.classList.remove('active');
            });

            // Add active class to clicked tab
            this.classList.add('active');

            // Hide all tab contents
            tabContents.forEach(content => {
                content.classList.remove('active');
                content.style.display = 'none';
            });

            // Show the corresponding tab content
            const targetContent = document.getElementById(tabId);
            if (targetContent) {
                targetContent.classList.add('active');
                targetContent.style.display = 'block';
                console.log('Successfully switched to tab:', tabId);

                // Update URL hash
                window.location.hash = tabId;
            } else {
                console.error('Tab content not found for:', tabId);
            }
        });
    });

    // Make sure the default active tab is visible
    const activeTab = document.querySelector('.nav-tab.active');
    if (activeTab) {
        const tabId = activeTab.getAttribute('data-tab');
        const targetContent = document.getElementById(tabId);
        if (targetContent) {
            targetContent.classList.add('active');
            targetContent.style.display = 'block';
        }
    }
}

/**
 * Initialize form submissions and validations
 */
function initializeForms() {
    // Booking form
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleBookingSubmission(this);
        });
    }

    // Food order form
    const foodOrderForm = document.getElementById('foodOrderForm');
    if (foodOrderForm) {
        foodOrderForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleFoodOrderSubmission(this);
        });
    }

    // Profile form
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleProfileSubmission(this);
        });
    }
}

/**
 * Handle booking form submission
 */
function handleBookingSubmission(form) {
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span class="material-symbols-outlined">hourglass_empty</span> Booking...';
    submitBtn.disabled = true;

    // Simulate API call
    setTimeout(() => {
        // Reset form
        form.reset();
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;

        // Show success message
        showNotification('Booking submitted successfully!', 'success');

        // Refresh bookings tab
        refreshBookingsTab();
    }, 2000);
}

/**
 * Handle food order form submission
 */
function handleFoodOrderSubmission(form) {
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span class="material-symbols-outlined">hourglass_empty</span> Ordering...';
    submitBtn.disabled = true;

    // Simulate API call
    setTimeout(() => {
        // Reset form
        form.reset();
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;

        // Show success message
        showNotification('Order placed successfully!', 'success');

        // Refresh food orders tab
        refreshFoodOrdersTab();
    }, 2000);
}

/**
 * Handle profile form submission
 */
function handleProfileSubmission(form) {
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    // Validate password confirmation
    if (data.new_password && data.new_password !== data.confirm_password) {
        showNotification('Passwords do not match!', 'error');
        return;
    }

    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span class="material-symbols-outlined">hourglass_empty</span> Saving...';
    submitBtn.disabled = true;

    // Simulate API call
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;

        // Show success message
        showNotification('Profile updated successfully!', 'success');

        // Update user info in sidebar
        updateSidebarUserInfo(data);
    }, 2000);
}

/**
 * Initialize profile image upload
 */
function initializeProfileImageUpload() {
    const profileImageInput = document.getElementById('profileImage');
    const profilePreview = document.getElementById('profilePreview');

    if (profileImageInput && profilePreview) {
        profileImageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
}

/**
 * Initialize animations
 */
function initializeAnimations() {
    const elements = document.querySelectorAll('.glass-card, .tab-content.active section');
    elements.forEach((el, index) => {
        setTimeout(() => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease';

            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 100);
        }, index * 100);
    });
}

/**
 * Initialize responsive sidebar
 */
function initializeResponsiveSidebar() {
    // Create mobile menu toggle for small screens
    if (window.innerWidth <= 768) {
        createMobileMenuToggle();
    }

    window.addEventListener('resize', function() {
        if (window.innerWidth <= 768) {
            if (!document.querySelector('.mobile-menu-toggle')) {
                createMobileMenuToggle();
            }
        } else {
            const toggle = document.querySelector('.mobile-menu-toggle');
            if (toggle) {
                toggle.remove();
            }
            // Reset sidebar position for desktop
            const sidebar = document.querySelector('.sidebar');
            if (sidebar) {
                sidebar.style.transform = '';
                sidebar.classList.remove('open');
            }
        }
    });
}

/**
 * Create mobile menu toggle button
 */
function createMobileMenuToggle() {
    const toggle = document.createElement('button');
    toggle.className = 'mobile-menu-toggle';
    toggle.innerHTML = '<span class="material-symbols-outlined">menu</span>';
    toggle.style.cssText = `
        position: fixed;
        top: 1rem;
        left: 1rem;
        z-index: 1001;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.75rem;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    `;

    toggle.addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('open');
    });

    document.body.appendChild(toggle);
}

/**
 * Show notification messages
 */
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notification => notification.remove());

    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <span class="material-symbols-outlined">${type === 'success' ? 'check_circle' : type === 'error' ? 'error' : 'info'}</span>
            <span>${message}</span>
        </div>
    `;

    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 2rem;
        right: 2rem;
        z-index: 10000;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: slideInRight 0.3s ease;
    `;

    // Set colors based on type
    if (type === 'success') {
        notification.style.backgroundColor = 'rgba(5, 150, 105, 0.9)';
        notification.style.color = 'white';
    } else if (type === 'error') {
        notification.style.backgroundColor = 'rgba(220, 38, 38, 0.9)';
        notification.style.color = 'white';
    } else {
        notification.style.backgroundColor = 'rgba(255, 255, 255, 0.9)';
        notification.style.color = 'var(--on-surface)';
    }

    document.body.appendChild(notification);

    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 5000);
}

/**
 * Update sidebar user info
 */
function updateSidebarUserInfo(data) {
    const userName = document.querySelector('.user-name');
    const userEmail = document.querySelector('.user-email');

    if (userName && data.first_name && data.last_name) {
        userName.textContent = `${data.first_name} ${data.last_name}`;
    }

    if (userEmail && data.email) {
        userEmail.textContent = data.email;
    }
}

/**
 * Refresh bookings tab (simulate data update)
 */
function refreshBookingsTab() {
    // This would normally fetch new data from the server
    console.log('Refreshing bookings tab...');
}

/**
 * Refresh food orders tab (simulate data update)
 */
function refreshFoodOrdersTab() {
    // This would normally fetch new data from the server
    console.log('Refreshing food orders tab...');
}

// Add notification animations to CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    .notification-content {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .notification-content .material-symbols-outlined {
        font-size: 1.25rem;
    }
`;
document.head.appendChild(style);

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
