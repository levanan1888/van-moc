@php
    Theme::layout('default');
    Theme::set('section-name', 'Giỏ hàng');
@endphp

<div class="container">
    <h2 class="cart-title">Giỏ hàng của bạn</h2>
    <div class="cart-page">
        <div class="cart-content">
            <!-- Left Column: Cart Items -->
            <div class="cart-items-section">
                <h3 class="cart-section-title">Có 0 sản phẩm trong giỏ hàng</h3>
                
                <div class="cart-items" id="cartItems">
                    <!-- Cart items will be dynamically loaded here by JavaScript -->
                </div>

                <div class="empty-cart-container" style="display: none;">
                    <div class="empty-cart">
                        <p>Giỏ hàng của bạn đang trống</p>
                        <a href="{{ route('public.products') }}" class="continue-shopping-btn">Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="order-summary-section">
                <div class="summary-card">
                    <h3 class="summary-title">Tóm tắt đơn hàng</h3>
                    
                    <div class="summary-details">
                        <div class="summary-row">
                            <span>Tạm tính</span>
                            <span class="amount" id="subtotal">0đ</span>
                        </div>
                        
                        <div class="shipping-note">
                            <div class="note-item">
                                <span class="note-icon">🕒</span>
                                <span>Thời gian giao hàng từ 3-5 ngày tuỳ khu vực (hoặc chậm hơn nếu chưa mở tuyến)</span>
                            </div>
                            <div class="note-item">
                                <span class="note-icon">🚚</span>
                                <span>Free ship cho đơn hàng từ 1.000.000đ</span>
                            </div>
                        </div>
                    </div>
                    
                    <button class="checkout-btn" onclick="proceedToCheckout()">
                        Tiến hành thanh toán
                    </button>
                </div>
            </div>
    </div>
</div>

<style>
.cart-page {
    padding-top: 0; /* Adjust spacing */
    font-family: 'Be Vietnam Pro', sans-serif;
    background: #fff;
}



.cart-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 30px;
    align-items: flex-start;
}

/* Left Column - Cart Items */
.cart-items-section {
    background: #fff;
    padding: 20px 25px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.cart-title {
    font-size: 32px;
    font-weight: 700;
    color: #333;
    text-align: left;
    margin-top: 20px;
    margin-bottom: 30px;
}

.cart-section-title {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
}

.cart-items {
    border-top: 1px solid #e9ecef;
}

.cart-item {
    display: grid;
    grid-template-columns: 100px 1fr auto;
    gap: 20px;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #e9ecef;
}

.item-image {
    width: 80px;
    height: 80px;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
}

.item-details {
    flex: 1;
}

.item-name {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 5px;
    color: #333;
    line-height: 1.3;
}

.item-description {
    font-size: 13px;
    color: #6c757d;
    margin-bottom: 10px;
    text-transform: uppercase;
}

.remove-btn {
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    font-size: 13px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.remove-btn:hover {
    color: #dc3545;
}

.item-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 15px;
}

.quantity-controls {
    display: flex;
    align-items: center;
    border: 1px solid #dee2e6;
    border-radius: 4px;
}

.qty-btn {
    background-color: #fff;
    border: none;
    cursor: pointer;
    font-size: 18px;
    width: 35px;
    height: 35px;
    color: #495057;
}

.qty-display {
    font-size: 16px;
    font-weight: 500;
    padding: 0 10px;
    min-width: 20px;
    text-align: center;
}

.item-price {
    font-size: 16px;
    font-weight: 600;
    color: #212529;
}

/* Right Column - Order Summary */
.order-summary-section {
    position: sticky;
    top: 20px;
}

.summary-card {
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.summary-title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
    text-align: left;
    padding-bottom: 10px;
    border-bottom: 1px solid #e9ecef;
}

.summary-details {
    margin-bottom: 20px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    font-size: 16px;
}

.summary-row span:first-child {
    color: #333;
    font-weight: 500;
}

.amount {
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

.shipping-note {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #e9ecef;
}

.note-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 12px;
    font-size: 13px;
    line-height: 1.5;
    color: #666;
}

.note-icon {
    flex-shrink: 0;
    font-size: 16px;
    margin-top: 2px;
}

.checkout-btn {
    width: 100%;
    padding: 12px 20px;
    background: #6c8b51;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
    text-transform: uppercase;
}

.checkout-btn:hover {
    background: #5a7543;
}

.empty-cart {
    text-align: center;
    padding: 60px 20px;
    background: #fff;
    border: 1px solid #f0f0f0;
    border-radius: 8px;
}

.empty-cart p {
    font-size: 18px;
    color: #666;
    margin-bottom: 20px;
}

.continue-shopping-btn {
    display: inline-block;
    padding: 12px 30px;
    background: #28a745;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 600;
    transition: background 0.3s;
}

.continue-shopping-btn:hover {
    background: #218838;
    color: white;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .cart-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .order-summary-section {
        position: static;
    }
}

@media (max-width: 768px) {
    .cart-page {
        padding: 20px 0;
    }
    
    .cart-title {
        font-size: 24px;
        margin-bottom: 20px;
    }
    
    .cart-items-section {
        padding: 15px;
    }
    
    .cart-item {
        grid-template-columns: 80px 1fr;
        gap: 15px;
        padding: 15px 0;
    }
    
    .item-image {
        width: 70px;
        height: 70px;
    }
    
    .item-name {
        font-size: 14px;
        margin-bottom: 8px;
    }
    
    .item-description {
        font-size: 12px;
        margin-bottom: 8px;
    }
    
    .remove-btn {
        font-size: 12px;
        gap: 3px;
    }
    
    .remove-btn svg {
        width: 14px;
        height: 14px;
    }
    
    .item-actions {
        grid-column: 2;
        justify-self: end;
        gap: 10px;
    }
    
    .quantity-controls {
        border-radius: 6px;
    }
    
    .qty-btn {
        width: 30px;
        height: 30px;
        font-size: 16px;
    }
    
    .qty-display {
        font-size: 14px;
        padding: 0 8px;
    }
    
    .item-price {
        font-size: 14px;
    }
    
    .summary-card {
        padding: 15px;
    }
    
    .summary-title {
        font-size: 16px;
    }
    
    .summary-row {
        font-size: 14px;
    }
    
    .checkout-btn {
        padding: 15px 20px;
        font-size: 16px;
    }
}
</style>

<script>
    // Function to format price to VND currency
    function formatPrice(price) {
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
    }

    // Load cart from localStorage and render the UI
    function loadCart() {
        const cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
        const cartItemsContainer = document.getElementById('cartItems');
        const cartSubtitle = document.querySelector('.cart-section-title');
        const emptyCartContainer = document.querySelector('.empty-cart-container');
        const cartContent = document.querySelector('.cart-content');

        // Ensure containers exist before manipulating them
        if (!cartItemsContainer || !cartSubtitle || !emptyCartContainer || !cartContent) {
            console.error('Cart elements not found in the DOM.');
            return;
        }

        // Clear previous content
        cartItemsContainer.innerHTML = '';

        if (cart.length === 0) {
            emptyCartContainer.style.display = 'block';
            cartItemsContainer.style.display = 'none';
            cartSubtitle.textContent = 'Giỏ hàng của bạn đang trống';
        } else {
            emptyCartContainer.style.display = 'none';
            cartItemsContainer.style.display = 'block';
            cartSubtitle.textContent = `Có ${cart.length} loại sản phẩm trong giỏ hàng`;

            cart.forEach(item => {
                const itemElement = document.createElement('div');
                itemElement.classList.add('cart-item');
                itemElement.dataset.id = item.id;
                const itemTotalPrice = (parseFloat(item.price) || 0) * item.quantity;

                itemElement.innerHTML = `
                    <div class="item-image">
                        <img src="${item.image}" alt="${item.name}">
                    </div>
                    <div class="item-details">
                        <p class="item-name">${item.name}</p>
                        ${item.attributes ? `<p class="item-description">TÁC DỤNG: ${item.attributes}</p>` : ''}
                        <button class="remove-btn" onclick="removeFromCart('${item.id}')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>
                            XOÁ SẢN PHẨM
                        </button>
                    </div>
                    <div class="item-actions">
                        <div class="quantity-controls">
                            <button class="qty-btn" onclick="changeQuantity('${item.id}', -1)">−</button>
                            <span class="qty-display">${item.quantity}</span>
                            <button class="qty-btn" onclick="changeQuantity('${item.id}', 1)">+</button>
                        </div>
                        <div class="item-price">
                             <span class="price">${formatPrice(itemTotalPrice)}</span>
                        </div>
                    </div>
                `;
                cartItemsContainer.appendChild(itemElement);
            });
        }
        updateSummary(cart);
    }

    // Update order summary
    function updateSummary(cart) {
        const subtotalEl = document.getElementById('subtotal');
        const freeShipNote = document.querySelector('.shipping-note .note-item:last-child');
        const subtotal = cart.reduce((sum, item) => sum + (parseFloat(item.price) || 0) * item.quantity, 0);

        if (subtotalEl) {
            subtotalEl.textContent = formatPrice(subtotal);
        }

        if (freeShipNote) {
            if (subtotal >= 1000000) {
                freeShipNote.style.display = 'flex';
            } else {
                freeShipNote.style.display = 'none';
            }
        }
    }

    // Change item quantity
    function changeQuantity(itemId, delta) {
        let cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
        const itemIndex = cart.findIndex(i => i.id === itemId);

        if (itemIndex > -1) {
            const newQuantity = cart[itemIndex].quantity + delta;
            // Prevent quantity from going below 1
            if (newQuantity >= 1) {
                cart[itemIndex].quantity = newQuantity;
            }
        }

        localStorage.setItem('vanmoc_cart', JSON.stringify(cart));
        loadCart(); // Reload the cart to reflect changes
    }

    // Remove item from cart
    function removeFromCart(itemId) {
        let cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
        cart = cart.filter(i => i.id !== itemId);
        localStorage.setItem('vanmoc_cart', JSON.stringify(cart));
        loadCart(); // Reload the cart
    }

    // Proceed to checkout
    function proceedToCheckout() {
        const cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
        if (cart.length === 0) {
            alert('Giỏ hàng của bạn đang trống.');
            return;
        }
        window.location.href = '{{ route("public.checkout") }}';
    }

    // Initial load
    document.addEventListener('DOMContentLoaded', loadCart);
</script>
