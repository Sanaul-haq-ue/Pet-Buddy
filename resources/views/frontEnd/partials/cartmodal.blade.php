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


                {{-- Shipping Address Section --}}
                <div style="margin-top: 28px;margin-bottom: 28px;">
                    <h3 class="payment-title" style="margin-bottom: 14px;">Shipping Address</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div class="checkout-field-group">
                            <label class="checkout-field-label">Full Name <span class="req-star">*</span></label>
                            <input type="text" id="shippingName" class="checkout-input" placeholder="Full name"
                                value="@auth{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} @endauth" />
                        </div>
                        <div class="checkout-field-group">
                            <label class="checkout-field-label">Email <span class="req-star">*</span></label>
                            <input type="email" id="shippingEmail" class="checkout-input" placeholder="Email address"
                                value="@auth{{ auth()->user()->email }} @endauth" />
                        </div>
                        <div class="checkout-field-group">
                            <label class="checkout-field-label">Mobile Number <span class="req-star">*</span></label>
                            <input type="tel" id="shippingMobile" class="checkout-input" placeholder="Mobile number"
                                value="@auth{{ auth()->user()->mobile }} @endauth" />
                        </div>
                        <div class="checkout-field-group">
                            <label class="checkout-field-label">Shipping Zone <span class="req-star">*</span></label>
                            @php $shippings = \App\Models\Shipping::where('status', 1)->get(); @endphp
                            <select id="shippingZoneSelect" class="checkout-input" style="cursor: pointer;">
                                <option value="" disabled selected>— Select a zone —</option>
                                @foreach ($shippings as $zone)
                                    <option value="{{ $zone->amount }}">
                                        {{ $zone->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="checkout-field-group" style="grid-column: 1 / -1;">
                            <label class="checkout-field-label">Full Address <span class="req-star">*</span></label>
                            <textarea id="shippingAddress" class="checkout-input" rows="2" placeholder="House no., road, area..."
                                style="resize: vertical; min-height: 60px;">@auth{{ auth()->user()->location }}@endauth </textarea>
                        </div>
                    </div>
                </div>


                <div class="booking-summary" style="margin-bottom: 20px;">
                    <div id="cartSummaryItems"></div>

                    {{-- Coupon Section --}}
                    <div id="couponSection" style="margin-top: 14px;">

                        <!-- Step 1: Toggle link -->
                        <div id="couponToggleWrap">
                            <button type="button" id="couponToggleBtn"
                                style="background: none; border: none; color: #7c3aed; font-size: 13px; font-weight: 600; cursor: pointer; padding: 0; text-decoration: underline;text-underline-offset: 3px;">
                                🏷️Do you have a coupon code?
                            </button>
                        </div>

                        <!-- Step 2: Input + Apply (hidden by default) -->
                        <div id="couponInputWrap" style="display:none; margin-top: 10px;">
                            <div style="display:flex; gap:8px; align-items:center;">
                                <input type="text" id="couponCodeInput" placeholder="Enter coupon code"
                                    style="flex:1; padding: 9px 13px; border: 1.5px solid #d1c4e9; border-radius: 8px; font-size: 13px; outline: none; transition: border-color .2s;text-transform: uppercase;" />
                                <button type="button" id="couponApplyBtn"
                                    style="background: linear-gradient(135deg,#7c3aed,#a855f7); color:#fff; border:none; border-radius:8px; padding:9px 18px; font-size:13px; font-weight:600; cursor:pointer; white-space:nowrap; transition: opacity .2s;">
                                    Apply
                                </button>
                            </div>
                            <!-- Error/info message shown inside input wrap -->
                            <p id="couponMessage" style="margin: 6px 0 0; font-size: 12px; font-weight: 600;"></p>
                        </div>

                        <!-- Step 3: Applied badge (shown after success, replaces toggle) -->
                        <div id="couponAppliedBadge" style="display:none; margin-top: 6px;">
                            <span
                                style="display: inline-flex; align-items: center; gap: 6px; background: #f0fdf4; border: 1.5px solid #bbf7d0; color: #16a34a; font-size: 12px; font-weight: 700; padding: 5px 10px; border-radius: 20px;">
                                <span id="appliedBadgeCode"></span>
                                <span style="color:#16a34a;">✓ Applied</span>
                            </span>
                            <button type="button" id="removeCouponBtn"
                                style="background:none; border:none; font-size:11px; color:#ef4444; cursor:pointer; padding: 0 0 0 6px; font-weight:600; vertical-align: middle;">
                                ✕Remove
                            </button>
                        </div>

                    </div>

                    {{-- Shipping Charge Display --}}
                    <div id="shippingChargeSection" style="margin-top: 14px;">
                        <div class="summary-item" style="font-size: 13px; color: #555; font-weight: 600;">
                            <span>🚚 Shipping Charge:</span>
                            <strong style="color: #1a1a1a;">৳<span id="shippingChargeValue">0</span></strong>
                        </div>
                    </div>

                    {{-- Breakdown: subtotal + shipping + discount rows --}}
                    <div id="couponBreakdown"
                        style="display:none; margin-top: 14px; border-top: 1px solid #ede9fe; padding-top: 12px;">
                        <div class="summary-item" style="font-size:14px; color:#555;">
                            <span>Subtotal:</span>
                            <span id="checkoutSubtotal">$0.00</span>
                        </div>
                        <div class="summary-item" style="font-size:14px; color:#16a34a; font-weight:600;">
                            <span>Discount (<span id="appliedCouponCode"></span>):</span>
                            <span>- $<span id="couponDiscountAmount">0.00</span></span>
                        </div>
                    </div>

                    <div class="summary-item" style="margin-top: 12px; font-size: 18px; font-weight: 700;">
                        <span>Total:</span>
                        <span id="checkoutTotal">$0.00</span>
                    </div>
                </div>



                <div class="payment-section">
                    @php
                        $payTypes = \App\Models\PayType::where('status', 1)->get();
                        $payMethods = \App\Models\PayMethod::where('status', 1)->get();
                    @endphp

                    @if ($payTypes->isEmpty())
                        <p style="color: #666; font-size: 14px;">No payment methods available right now.</p>
                    @else
                        <h3 class="payment-title">Select Payment Type</h3>
                        <div class="payment-methods" style="margin-bottom: 20px;">
                            @foreach ($payTypes as $payType)
                                <label class="payment-option">
                                    <input type="radio" name="checkoutPaymentType" value="{{ $payType->id }}"
                                        class="payment-radio checkout-pay-type-radio">
                                    <div class="payment-method-box">
                                        <span class="payment-method-name">{{ $payType->name }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <div id="checkoutPaymentMethodsContainer" style="display: none; margin-top: 20px;">
                            <h3 class="payment-title">Select Payment Method</h3>
                            <div class="checkout-pay-methods-list"
                                style="display: flex; flex-direction: column; gap: 12px;">
                                @foreach ($payMethods as $payMethod)
                                    <label
                                        class="payment-option checkout-pay-method-item pay-method-type-{{ $payMethod->pay_type_id }}"
                                        style="display: none; width: 100%;">
                                        <input type="radio" name="checkoutPaymentMethod"
                                            value="{{ $payMethod->id }}" class="payment-radio">
                                        <div class="payment-method-box"
                                            style="align-items: flex-start; gap: 6px; padding: 16px; width: 100%; display: flex; flex-direction: column;">
                                            <div
                                                style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
                                                <span class="payment-method-name"
                                                    style="font-size: 16px; font-weight: 700; color: #1a1a1a;">{{ $payMethod->name }}</span>
                                                @if ($payMethod->pay_type_id == 1)
                                                    <span
                                                        style="font-size: 11px; font-weight: 600; padding: 2px 8px; background: rgba(124, 58, 237, 0.1); color: #7c3aed; border-radius: 6px;">Mobile
                                                        Banking</span>
                                                @elseif($payMethod->pay_type_id == 2)
                                                    <span
                                                        style="font-size: 11px; font-weight: 600; padding: 2px 8px; background: rgba(16, 185, 129, 0.1); color: #10b981; border-radius: 6px;">Bank
                                                        Transfer</span>
                                                @endif
                                            </div>

                                            @if ($payMethod->pay_type_id == 1 && $payMethod->mbanking_number)
                                                <div style="font-size: 13px; color: #555; margin-top: 4px;">
                                                    <strong>Number:</strong> {{ $payMethod->mbanking_number }}
                                                </div>
                                            @elseif($payMethod->pay_type_id == 2)
                                                <div
                                                    style="font-size: 13px; color: #555; margin-top: 4px; display: grid; grid-template-columns: auto 1fr; gap: 4px 10px; width: 100%;">
                                                    <strong>Account Holder:</strong>
                                                    <span>{{ $payMethod->account_holder_name }}</span>
                                                    <strong>Account Number:</strong>
                                                    <span>{{ $payMethod->account_number }}</span>
                                                    @if ($payMethod->routing_number)
                                                        <strong>Routing Number:</strong>
                                                        <span>{{ $payMethod->routing_number }}</span>
                                                    @endif
                                                    @if ($payMethod->branch_name)
                                                        <strong>Branch Name:</strong>
                                                        <span>{{ $payMethod->branch_name }}</span>
                                                    @endif
                                                </div>
                                            @endif

                                            @if ($payMethod->note)
                                                <div
                                                    style="font-size: 12px; color: #777; font-style: italic; border-top: 1px solid #eee; padding-top: 6px; margin-top: 6px; width: 100%;">
                                                    <strong>Note:</strong> {{ $payMethod->note }}
                                                </div>
                                            @endif
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Payment Proof Section: shown after a payment method is selected --}}
                        <div id="paymentProofSection" style="display:none; margin-top: 24px;">
                            <h3 class="payment-title" style="margin-bottom: 14px;">Payment Confirmation</h3>
                            <div class="checkout-field-group">
                                <label class="checkout-field-label">
                                    Transaction / Reference No. <span class="req-star">*</span>
                                </label>
                                <input type="text" id="transactionNo" class="checkout-input"
                                    placeholder="Enter your transaction or reference number" />
                            </div>
                            <div class="checkout-field-group" style="margin-top: 14px;">
                                <label class="checkout-field-label">
                                    Payment Screenshot <span class="req-star">*</span>
                                </label>
                                <div class="upload-area" id="uploadArea">
                                    <input type="file" id="paymentScreenshot" accept="image/*"
                                        style="display:none;" />
                                    <div id="uploadPlaceholder"
                                        onclick="document.getElementById('paymentScreenshot').click()"
                                        style="cursor:pointer;">
                                        <span class="material-symbols-outlined"
                                            style="font-size:32px; color:#a78bfa;">upload_file</span>
                                        <p style="margin:6px 0 0; font-size:13px; color:#666;">Click to upload
                                            screenshot <br><small style="color:#aaa;">(JPG, PNG, WEBP)</small></p>
                                    </div>
                                    <div id="uploadPreview" style="display:none; text-align:center;">
                                        <img id="previewImg" src="" alt="Preview"
                                            style="max-height:120px; max-width:100%; border-radius:8px; margin-bottom:6px;" />
                                        <p id="previewName" style="font-size:12px; color:#555; margin:0;"></p>
                                        <button type="button" onclick="clearUpload()"
                                            style="margin-top:6px; font-size:12px; color:#ef4444; background:none; border:none; cursor:pointer;">&#x2715;
                                            Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    @endif
                </div>
                <div class="booking-actions" style="margin-top: 24px;">
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

    let cart = @json(array_values(session()->get('cart', [])));

    // ─── Coupon state ─────────────────────────────────────────────────────────
    let appliedCoupon = null;

    // ─── Shipping state ───────────────────────────────────────────────────────
    const shippingSelect = document.getElementById('shippingZoneSelect');
    let shippingCharge = shippingSelect ?
        (parseFloat(shippingSelect.options[0]?.value) || 0) :
        0;

    if (shippingSelect && shippingSelect.options.length > 0) {
        document.getElementById('shippingChargeValue').textContent = shippingCharge;
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────
    function getPriceFromText(text) {
        return parseFloat(text.replace(/[^0-9.]/g, '')) || 0;
    }

    function calculateCartTotal() {
        return cart.reduce((sum, item) => sum + item.price * item.quantity, 0).toFixed(2);
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

    function renderCartItems() {
        cartItemsList.innerHTML = '';
        if (cart.length === 0) {
            cartItemsList.innerHTML =
                '<p class="cart-modal-summary-note">Your cart is currently empty. Add products to begin.</p>';
            cartCheckoutBtn.disabled = true;
            cartTotal.textContent = '৳0.00';
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
                    <p>Price: ৳${product.price.toFixed(2)}</p>
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

        cartTotal.textContent = '৳' + calculateCartTotal();
    }

    function resetCoupon() {
        appliedCoupon = null;
        document.getElementById('couponToggleWrap').style.display = 'block';
        document.getElementById('couponInputWrap').style.display = 'none';
        document.getElementById('couponAppliedBadge').style.display = 'none';
        document.getElementById('couponBreakdown').style.display = 'none';
        document.getElementById('couponCodeInput').value = '';
        document.getElementById('couponMessage').textContent = '';
        document.getElementById('couponMessage').style.color = '';
    }

    function showCouponApplied(data, cartSubtotal) {
        document.getElementById('couponToggleWrap').style.display = 'none';
        document.getElementById('couponInputWrap').style.display = 'none';
        document.getElementById('couponAppliedBadge').style.display = 'block';
        document.getElementById('appliedBadgeCode').textContent = data.coupon_code || appliedCoupon.code;

        const discount = appliedCoupon.discount_amount;
        const finalTotal = appliedCoupon.final_total + shippingCharge;

        document.getElementById('checkoutSubtotal').textContent = '৳' + cartSubtotal.toFixed(2);
        document.getElementById('appliedCouponCode').textContent = appliedCoupon.code;
        document.getElementById('couponDiscountAmount').textContent = discount.toFixed(2);
        document.getElementById('couponBreakdown').style.display = 'block';
        document.getElementById('checkoutTotal').textContent = '৳' + finalTotal.toFixed(2);
    }

    function renderCheckoutSummary() {
        cartSummaryItems.innerHTML = '';
        cart.forEach(item => {
            const row = document.createElement('div');
            row.className = 'summary-item';
            row.innerHTML = `
                <span>${item.name} x${item.quantity}</span>
                <span>৳${(item.price * item.quantity).toFixed(2)}</span>
            `;
            cartSummaryItems.appendChild(row);
        });

        // Sync shipping display
        document.getElementById('shippingChargeValue').textContent = shippingCharge;

        const rawTotal = parseFloat(calculateCartTotal());

        if (appliedCoupon) {
            const discount = Math.min(appliedCoupon.discount_amount, rawTotal);
            appliedCoupon.discount_amount = discount;
            appliedCoupon.final_total = rawTotal - discount;
            showCouponApplied({}, rawTotal);
        } else {
            document.getElementById('couponToggleWrap').style.display = 'block';
            document.getElementById('couponInputWrap').style.display = 'none';
            document.getElementById('couponAppliedBadge').style.display = 'none';
            document.getElementById('couponBreakdown').style.display = 'none';
            document.getElementById('checkoutTotal').textContent = '৳' + (rawTotal + shippingCharge).toFixed(2);
        }
    }

    // ─── Shipping zone listeners ───────────────────────────────────────────────
    if (shippingSelect) {
        shippingSelect.addEventListener('change', function() {
            shippingCharge = parseFloat(this.value) || 0;
            document.getElementById('shippingChargeValue').textContent = shippingCharge;
            renderCheckoutSummary();
        });
    }

    // ─── Coupon listeners ─────────────────────────────────────────────────────
    document.getElementById('couponToggleBtn').addEventListener('click', () => {
        document.getElementById('couponToggleWrap').style.display = 'none';
        document.getElementById('couponInputWrap').style.display = 'block';
        document.getElementById('couponCodeInput').focus();
    });

    document.getElementById('couponApplyBtn').addEventListener('click', () => {
        const code = document.getElementById('couponCodeInput').value.trim().toUpperCase();
        const msgEl = document.getElementById('couponMessage');
        const applyBtn = document.getElementById('couponApplyBtn');

        msgEl.textContent = '';
        msgEl.style.color = '';

        if (!code) {
            msgEl.textContent = 'Please enter a coupon code.';
            msgEl.style.color = '#ef4444';
            return;
        }

        const rawTotal = parseFloat(calculateCartTotal());

        applyBtn.disabled = true;
        applyBtn.textContent = 'Checking…';

        fetch("{{ route('coupon.apply') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    code,
                    cart_total: rawTotal
                })
            })
            .then(res => res.json())
            .then(data => {
                applyBtn.disabled = false;
                applyBtn.textContent = 'Apply';

                if (data.success) {
                    appliedCoupon = {
                        code: data.coupon_code,
                        discount_amount: data.discount_amount,
                        final_total: data.final_total,
                    };
                    showCouponApplied(data, rawTotal);
                    toastr.success(data.message, 'Coupon Applied!');
                } else {
                    msgEl.textContent = '✗ ' + data.message;
                    msgEl.style.color = '#ef4444';
                    toastr.warning(data.message, 'Coupon Invalid');
                }
            })
            .catch(() => {
                applyBtn.disabled = false;
                applyBtn.textContent = 'Apply';
                msgEl.textContent = 'Something went wrong. Please try again.';
                msgEl.style.color = '#ef4444';
                toastr.error('Something went wrong. Please try again.', 'Error');
            });
    });

    document.getElementById('couponCodeInput').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('couponApplyBtn').click();
        }
    });

    document.getElementById('removeCouponBtn').addEventListener('click', () => {
        resetCoupon();
        renderCheckoutSummary();
    });

    // ─── Modal open/close ─────────────────────────────────────────────────────
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

    // ─── Cart AJAX helpers ────────────────────────────────────────────────────
    function addToCartAJAX(slug, name, price, image, quantity = 1) {
        fetch("{{ route('cart.add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    slug,
                    name,
                    price,
                    image,
                    quantity
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    cart = data.cart;
                    updateCartIcon();
                    openCartModal();
                }
            })
            .catch(err => console.error('Error adding to cart:', err));
    }

    function updateCartQtyAJAX(slug, quantity) {
        fetch("{{ route('cart.update') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    slug,
                    quantity
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    cart = data.cart;
                    updateCartIcon();
                    renderCartItems();
                }
            })
            .catch(err => console.error('Error updating cart:', err));
    }

    function removeFromCartAJAX(slug) {
        fetch("{{ route('cart.remove') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    slug
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    cart = data.cart;
                    updateCartIcon();
                    renderCartItems();
                }
            })
            .catch(err => console.error('Error removing from cart:', err));
    }

    window.addToCartAJAX = addToCartAJAX;

    document.addEventListener('click', (e) => {
        const target = e.target.closest('button');
        if (!target) return;
        const action = target.dataset.action;
        const index = parseInt(target.dataset.index, 10);

        if (action && !isNaN(index)) {
            const item = cart[index];
            if (!item) return;

            if (action === 'increase') updateCartQtyAJAX(item.slug, item.quantity + 1);
            if (action === 'decrease' && item.quantity > 1) updateCartQtyAJAX(item.slug, item.quantity - 1);
            if (action === 'remove') removeFromCartAJAX(item.slug);
        }
    });

    document.querySelectorAll('.add-to-cart:not(.open-booking-modal)').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            let slug = btn.dataset.slug;
            let name = btn.dataset.name;
            let price = btn.dataset.price ? parseFloat(btn.dataset.price) : null;
            let image = btn.dataset.image;

            if (!name || price === null || !image) {
                const card = btn.closest('.carousel-card, .product-card, .glass-card');
                if (card) {
                    const nameEl = card.querySelector('.card-title, .product-name');
                    const priceEl = card.querySelector('.price, .product-price');
                    const imgEl = card.querySelector('img');

                    if (!name) name = nameEl ? nameEl.textContent.trim() : 'Item';
                    if (price === null) price = priceEl ? getPriceFromText(priceEl.textContent) : 0;
                    if (!image) image = imgEl ? imgEl.src : 'https://via.placeholder.com/100';
                }
            }

            if (!slug) {
                slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
            }

            addToCartAJAX(slug, name, price, image, 1);
        });
    });

    // ─── Checkout flow ────────────────────────────────────────────────────────
    cartCheckoutBtn.addEventListener('click', () => {
        if (cart.length === 0) return;
        renderCheckoutSummary();

        document.querySelectorAll('input[name="checkoutPaymentType"]').forEach(el => el.checked = false);
        document.querySelectorAll('input[name="checkoutPaymentMethod"]').forEach(el => el.checked = false);
        const container = document.getElementById('checkoutPaymentMethodsContainer');
        if (container) container.style.display = 'none';

        updateStep(2);
    });

    cartBackBtn.addEventListener('click', () => {
        updateStep(1);
    });

    cartCheckoutConfirmBtn.addEventListener('click', () => {
        const paymentType = document.querySelector('input[name="checkoutPaymentType"]:checked');
        const paymentMethod = document.querySelector('input[name="checkoutPaymentMethod"]:checked');

        if (!paymentType) {
            toastr.warning('Please select a payment type.');
            return;
        }
        if (!paymentMethod) {
            toastr.warning('Please select a payment method.');
            return;
        }

        const isCOD = paymentType.value === '3';
        const txNo = document.getElementById('transactionNo').value.trim();
        const screenshot = document.getElementById('paymentScreenshot').files[0];

        if (!isCOD) {
            if (!txNo) {
                toastr.warning('Please enter your Transaction / Reference No.');
                document.getElementById('transactionNo').focus();
                return;
            }
            if (!screenshot) {
                toastr.warning('Please upload your payment screenshot.');
                return;
            }
        }

        const shippingName = document.getElementById('shippingName').value.trim();
        const shippingEmail = document.getElementById('shippingEmail').value.trim();
        const shippingMobile = document.getElementById('shippingMobile').value.trim();
        const shippingAddress = document.getElementById('shippingAddress').value.trim();

        if (!shippingName) {
            toastr.warning('Please enter your Full Name.');
            document.getElementById('shippingName').focus();
            return;
        }
        if (!shippingEmail) {
            toastr.warning('Please enter your Email address.');
            document.getElementById('shippingEmail').focus();
            return;
        }
        if (!shippingMobile) {
            toastr.warning('Please enter your Mobile Number.');
            document.getElementById('shippingMobile').focus();
            return;
        }
        if (!shippingAddress) {
            toastr.warning('Please enter your Full Address.');
            document.getElementById('shippingAddress').focus();
            return;
        }

        const zoneSelect = document.getElementById('shippingZoneSelect');
        if (!zoneSelect || zoneSelect.value === '0' || zoneSelect.value === '') {
            toastr.warning('Please select a Shipping Zone.');
            zoneSelect.focus();
            return;
        }

        const formData = new FormData();
        formData.append('shipping_name', shippingName);
        formData.append('shipping_email', shippingEmail);
        formData.append('shipping_mobile', shippingMobile);
        formData.append('shipping_address', shippingAddress);
        formData.append('pay_type_id', paymentType.value);
        formData.append('pay_method_id', paymentMethod.value);
        formData.append('shipping_charge', shippingCharge);
        const selectedZoneOption = document.getElementById('shippingZoneSelect');
        formData.append('shipping_zone', selectedZoneOption?.value !== '0' ? selectedZoneOption.options[
            selectedZoneOption.selectedIndex].text.trim() : '');
        formData.append('_token', '{{ csrf_token() }}');

        if (appliedCoupon) formData.append('coupon_code', appliedCoupon.code);
        if (!isCOD) {
            formData.append('transaction_no', txNo);
            formData.append('payment_screenshot', screenshot);
        }

        cartCheckoutConfirmBtn.disabled = true;
        cartCheckoutConfirmBtn.textContent = 'Placing Order…';

        fetch("{{ route('order.place') }}", {
                method: 'POST',
                body: formData
            })
            .then(res => res.json().then(data => ({
                status: res.status,
                data
            })))
            .then(({
                data
            }) => {
                cartCheckoutConfirmBtn.disabled = false;
                cartCheckoutConfirmBtn.textContent = 'Place Order';

                if (data.success) {
                    window.location.href = data.redirect_url;
                } else {
                    toastr.error(data.message, 'Order Failed');
                }
            })
            .catch(() => {
                cartCheckoutConfirmBtn.disabled = false;
                cartCheckoutConfirmBtn.textContent = 'Place Order';
                toastr.error(
                    'Network issue detected. Your order was NOT placed. Please check your connection and try again.',
                    'Order Failed'
                );
            });
    });

    // ─── Payment type/method change ───────────────────────────────────────────
    document.addEventListener('change', function(e) {
        if (e.target && e.target.classList.contains('checkout-pay-type-radio')) {
            const selectedTypeId = e.target.value;

            document.querySelectorAll('input[name="checkoutPaymentMethod"]').forEach(el => el.checked = false);
            const proofSection = document.getElementById('paymentProofSection');
            if (proofSection) proofSection.style.display = 'none';

            document.querySelectorAll('.checkout-pay-method-item').forEach(el => el.style.display = 'none');

            const container = document.getElementById('checkoutPaymentMethodsContainer');
            if (container) container.style.display = 'block';

            document.querySelectorAll(`.checkout-pay-method-item.pay-method-type-${selectedTypeId}`)
                .forEach(el => el.style.display = 'block');
        }

        if (e.target && e.target.name === 'checkoutPaymentMethod') {
            const activeType = document.querySelector('input[name="checkoutPaymentType"]:checked');
            const proofSection = document.getElementById('paymentProofSection');
            if (proofSection) {
                proofSection.style.display = (activeType && activeType.value === '3') ? 'none' : 'block';
            }
        }
    });

    // ─── File upload preview ──────────────────────────────────────────────────
    const paymentScreenshotInput = document.getElementById('paymentScreenshot');
    if (paymentScreenshotInput) {
        paymentScreenshotInput.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('previewImg').src = ev.target.result;
                document.getElementById('previewName').textContent = file.name;
                document.getElementById('uploadPlaceholder').style.display = 'none';
                document.getElementById('uploadPreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
    }

    function clearUpload() {
        const input = document.getElementById('paymentScreenshot');
        if (input) input.value = '';
        document.getElementById('previewImg').src = '';
        document.getElementById('previewName').textContent = '';
        document.getElementById('uploadPlaceholder').style.display = 'block';
        document.getElementById('uploadPreview').style.display = 'none';
    }

    // ─── Init ─────────────────────────────────────────────────────────────────
    updateCartIcon();
</script>
