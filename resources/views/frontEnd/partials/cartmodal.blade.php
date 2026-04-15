<!-- Cart Icon & Modal -->
<div id="cartIcon" class="cart-icon" style="display:none;">
    <i class="fa-solid fa-shopping-cart"></i>
    <span id="cartBadge">0</span>
</div>

<div id="cartModal" class="booking-modal">
    <div id="cartOverlay" class="booking-modal-overlay"></div>
    <div class="booking-modal-container">
        <!-- Cart Step 1 -->
        <div class="booking-step booking-step-active" id="cartStep1">
            <div class="booking-modal-content">
                <button class="modal-close-btn" id="cartCloseBtn">&times;</button>
                <h2 class="step2-title">Shopping Cart</h2>
                <div id="cartItemsList" class="booking-summary"></div>
                <div class="summary-item" style="margin-top: 12px; font-size: 18px; font-weight: 700;">
                    <span>Total:</span>
                    <span id="cartTotal">$0.00</span>
                </div>
                <div class="booking-actions" style="margin-top: 20px;">
                    <button type="button" class="btn-outline" id="cartCloseActionBtn">Close</button>
                    <button type="button" class="btn-primary" id="cartCheckoutBtn" disabled>Checkout</button>
                </div>
            </div>
        </div>

        <!-- Cart Step 2 -->
        <div class="booking-step" id="cartStep2">
            <div class="booking-modal-content">
                <button class="modal-close-btn" id="cartCloseBtn2">&times;</button>
                <h2 class="step2-title">Checkout</h2>
                <div class="booking-summary" style="margin-bottom: 20px;">
                    <div id="cartSummaryItems"></div>
                    <div class="summary-item" style="margin-top: 12px; font-size: 18px; font-weight: 700;">
                        <span>Total:</span>
                        <span id="checkoutTotal">$0.00</span>
                    </div>
                </div>
                <div class="payment-section">
                    <h3 class="payment-title">Select Payment Method</h3>
                    <div class="payment-methods">
                        <label class="payment-option">
                            <input type="radio" name="checkoutPaymentMethod" value="bkash" class="payment-radio">
                            <div class="payment-method-box">
                                <span class="payment-method-name">bKash</span>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Bkash_Logo.svg/1200px-Bkash_Logo.svg.png"
                                    alt="bKash" class="payment-logo">
                            </div>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="checkoutPaymentMethod" value="nagad" class="payment-radio">
                            <div class="payment-method-box">
                                <span class="payment-method-name">Nagad</span>
                                <img src="https://www.nagad.com.bd/assets/img/logo.png" alt="Nagad"
                                    class="payment-logo">
                            </div>
                        </label>
                    </div>
                </div>
                <div class="booking-actions" style="margin-top: 20px;">
                    <button type="button" class="btn-outline" id="checkoutBackBtn">Go Back</button>
                    <button type="button" class="btn-primary" id="checkoutPlaceOrderBtn">Place Order</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Cart Modal Script - Manages cart state, item rendering, quantity adjustments, and checkout flow. --}}
<script>
    const cartIcon = document.getElementById('cartIcon');
    const cartBadge = document.getElementById('cartBadge');
    const cartModal = document.getElementById('cartModal');
    const cartOverlay = document.getElementById('cartOverlay');
    const cartItemsList = document.getElementById('cartItemsList');
    const cartTotal = document.getElementById('cartTotal');
    const cartCheckoutBtn = document.getElementById('cartCheckoutBtn');
    const cartCloseBtn = document.getElementById('cartCloseBtn');
    const cartCloseBtn2 = document.getElementById('cartCloseBtn2');
    const cartCloseActionBtn = document.getElementById('cartCloseActionBtn');
    const cartStep1 = document.getElementById('cartStep1');
    const cartStep2 = document.getElementById('cartStep2');
    const cartSummaryItems = document.getElementById('cartSummaryItems');
    const checkoutTotal = document.getElementById('checkoutTotal');
    const cartCheckoutConfirmBtn = document.getElementById('checkoutPlaceOrderBtn');
    const cartBackBtn = document.getElementById('checkoutBackBtn');

    let cart = [];

    function getPriceFromText(text) {
        return parseFloat(text.replace(/[^0-9.]/g, '')) || 0;
    }

    function updateCartIcon() {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        if (totalItems > 0) {
            cartIcon.style.display = 'flex';
            cartBadge.textContent = totalItems;
        } else {
            cartIcon.style.display = 'none';
        }
    }

    function calculateCartTotal() {
        return cart.reduce((sum, item) => sum + item.price * item.quantity, 0).toFixed(2);
    }

    function renderCartItems() {
        cartItemsList.innerHTML = '';
        if (cart.length === 0) {
            cartItemsList.innerHTML =
                '<p class="cart-modal-summary-note">Your cart is currently empty. Add products to begin.</p>';
            cartCheckoutBtn.disabled = true;
            cartTotal.textContent = '$0.00';
            return;
        }

        cartCheckoutBtn.disabled = false;

        cart.forEach((product, index) => {
            const card = document.createElement('div');
            card.className = 'cart-item-card';
            card.innerHTML = `
                        <img src="${product.image}" alt="${product.name}" class="cart-item-img" />
                        <div class="cart-item-info">
                            <h4>${product.name}</h4>
                            <p>Price: $${product.price.toFixed(2)}</p>
                            <div class="cart-qty-controls">
                                <button data-action="decrease" data-index="${index}">-</button>
                                <span>${product.quantity}</span>
                                <button data-action="increase" data-index="${index}">+</button>
                            </div>
                            <button class="cart-remove" data-action="remove" data-index="${index}">Remove</button>
                        </div>
                    `;
            cartItemsList.appendChild(card);
        });

        cartTotal.textContent = '$' + calculateCartTotal();
    }

    function renderCheckoutSummary() {
        cartSummaryItems.innerHTML = '';
        cart.forEach(item => {
            const row = document.createElement('div');
            row.className = 'summary-item';
            row.innerHTML = `
                        <span>${item.name} x${item.quantity}</span>
                        <span>$${(item.price * item.quantity).toFixed(2)}</span>
                    `;
            cartSummaryItems.appendChild(row);
        });
        checkoutTotal.textContent = '$' + calculateCartTotal();
    }

    function updateStep(step) {
        if (step === 1) {
            cartStep1.classList.add('booking-step-active');
            cartStep2.classList.remove('booking-step-active');
        } else {
            cartStep1.classList.remove('booking-step-active');
            cartStep2.classList.add('booking-step-active');
        }
    }

    function openCartModal() {
        cartModal.classList.add('active');
        document.body.style.overflow = 'hidden';
        renderCartItems();
        cartOverlay.addEventListener('click', closeCartModal);
        updateStep(1);
    }

    function closeCartModal() {
        cartModal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    cartIcon.addEventListener('click', openCartModal);
    cartCloseBtn.addEventListener('click', closeCartModal);
    cartCloseBtn2.addEventListener('click', closeCartModal);
    cartCloseActionBtn.addEventListener('click', closeCartModal);

    document.addEventListener('click', (e) => {
        const target = e.target.closest('button');
        if (!target) return;
        const action = target.dataset.action;
        const index = parseInt(target.dataset.index, 10);

        if (action && !isNaN(index)) {
            if (action === 'increase') {
                cart[index].quantity += 1;
            }
            if (action === 'decrease' && cart[index].quantity > 1) {
                cart[index].quantity -= 1;
            }
            if (action === 'remove') {
                cart.splice(index, 1);
            }
            updateCartIcon();
            renderCartItems();
        }
    });

    document.querySelectorAll('.add-to-cart:not(.open-booking-modal)').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const card = btn.closest('.carousel-card, .product-card, .glass-card');
            if (!card) return;

            const nameEl = card.querySelector('.card-title');
            const priceEl = card.querySelector('.price');
            const imgEl = card.querySelector('img');

            const name = nameEl ? nameEl.textContent.trim() : 'Item';
            const price = priceEl ? getPriceFromText(priceEl.textContent) : 0;
            const image = imgEl ? imgEl.src : 'https://via.placeholder.com/100';

            const existing = cart.find(item => item.name === name);
            if (existing) {
                existing.quantity += 1;
            } else {
                cart.push({
                    name,
                    price,
                    quantity: 1,
                    image
                });
            }

            updateCartIcon();
            openCartModal();
        });
    });

    cartCheckoutBtn.addEventListener('click', () => {
        if (cart.length === 0) return;
        renderCheckoutSummary();
        updateStep(2);
    });

    cartBackBtn.addEventListener('click', () => {
        updateStep(1);
    });

    cartCheckoutConfirmBtn.addEventListener('click', () => {
        const paymentMethod = document.querySelector('input[name="checkoutPaymentMethod"]:checked');
        if (!paymentMethod) {
            alert('Please select a payment method');
            return;
        }

        alert(
            `Order placed! Payment method: ${paymentMethod.value.toUpperCase()}, amount: $${calculateCartTotal()}`
            );
        cart = [];
        updateCartIcon();
        closeCartModal();
    });

    // init
    updateCartIcon();
</script>
