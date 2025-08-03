@php
    Theme::layout('default');
    Theme::set('section-name', 'Giỏ hàng của bạn');
@endphp

<div class="container">
    <div class="cart-page">
        <div class="cart-content">
            <!-- Cart Items Section -->
            <div class="cart-items-section">
                <h2 class="cart-title">Giỏ hàng của bạn</h2>
                <p class="cart-subtitle">Có 2 sản phẩm trong giỏ</p>
                
                <div class="cart-items">
                    <!-- Cart items will be loaded dynamically from localStorage -->
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="order-summary-section">
                <div class="summary-card">
                    <h3>Tóm tắt đơn hàng</h3>
                    
                    <div class="summary-row">
                        <span>Tạm tính</span>
                        <span>663.000₫</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Phí vận chuyển</span>
                        <span>Miễn phí</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Giảm giá (10%)</span>
                        <span class="discount">-66.300₫</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Thuế VAT (10%)</span>
                        <span>59.670₫</span>
                    </div>
                    
                    <div class="summary-row total">
                        <span>Tổng cộng tiền</span>
                        <span>656.370₫</span>
                    </div>
                    
                    <button class="checkout-btn" onclick="proceedToCheckout()">
                        Tiến hành thanh toán
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.cart-page {
    padding: 40px 0;
    font-family: 'Be Vietnam Pro', sans-serif;
}

.cart-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 40px;
    align-items: start;
}

.cart-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
}

.cart-subtitle {
    color: #666;
    margin-bottom: 30px;
    font-size: 14px;
}

.cart-items {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.cart-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 15px;
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    margin-bottom: 15px;
}

.item-image {
    flex-shrink: 0;
}

.item-image img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
}

.item-details {
    flex: 1;
    min-width: 0;
}

.item-name {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 4px;
    color: #333;
    line-height: 1.3;
}

.item-description {
    font-size: 12px;
    color: #666;
    margin-bottom: 0;
}

.item-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
    min-width: 120px;
}

.quantity-controls {
    display: flex;
    align-items: center;
    border: 1px solid #ddd;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 5px;
}

.qty-btn {
    width: 28px;
    height: 28px;
    border: none;
    background: #f8f9fa;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    transition: background 0.3s;
}

.qty-btn:hover {
    background: #e9ecef;
}

.qty-input {
    width: 40px;
    height: 28px;
    border: none;
    text-align: center;
    font-size: 12px;
    background: #fff;
}

.remove-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: #dc3545;
    padding: 2px 6px;
    border-radius: 3px;
    transition: background 0.3s;
    line-height: 1;
}

.remove-btn:hover {
    background: #f8f9fa;
}

.item-price {
    text-align: right;
}

.price {
    font-size: 14px;
    font-weight: 600;
    color: #28a745;
}

.order-summary-section {
    position: sticky;
    top: 20px;
}

.summary-card {
    background: #fff;
    border: 1px solid #f0f0f0;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.summary-card h3 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    font-size: 14px;
}

.summary-row.total {
    border-top: 1px solid #f0f0f0;
    padding-top: 15px;
    margin-top: 20px;
    font-size: 16px;
    font-weight: 600;
}

.discount {
    color: #28a745;
}

.checkout-btn {
    width: 100%;
    padding: 15px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 20px;
    transition: background 0.3s;
}

.checkout-btn:hover {
    background: #218838;
}

.empty-cart {
    text-align: center;
    padding: 60px 20px;
    background: #fff;
    border: 1px solid #f0f0f0;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
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
    border-radius: 8px;
    font-weight: 600;
    transition: background 0.3s;
}

.continue-shopping-btn:hover {
    background: #218838;
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .cart-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .cart-item {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .item-details {
        text-align: center;
    }
    
    .item-actions {
        justify-content: center;
    }
}
</style>

<script>
// Load cart from localStorage and render
function loadCart() {
    const cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
    const cartItemsContainer = document.querySelector('.cart-items');
    const cartSubtitle = document.querySelector('.cart-subtitle');
    
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = `
            <div class="empty-cart">
                <p>Giỏ hàng của bạn đang trống</p>
                <a href="{{ route('public.products') }}" class="continue-shopping-btn">Tiếp tục mua sắm</a>
            </div>
        `;
        cartSubtitle.textContent = 'Không có sản phẩm nào trong giỏ';
        return;
    }
    
    cartSubtitle.textContent = `Có ${cart.length} sản phẩm trong giỏ`;
    
    cartItemsContainer.innerHTML = cart.map((item, index) => `
        <div class="cart-item" data-id="${item.id}">
            <div class="item-image">
                <img src="${item.image}" alt="${item.name}">
            </div>
            <div class="item-details">
                <h3 class="item-name">${item.name}</h3>
                <p class="item-description">Sản phẩm chăm sóc da</p>
            </div>
            <div class="item-actions">
                <div class="quantity-controls">
                    <button class="qty-btn minus" onclick="updateQuantity('${item.id}', -1)">-</button>
                    <input type="number" value="${item.quantity}" min="1" class="qty-input" id="qty-${item.id}" readonly>
                    <button class="qty-btn plus" onclick="updateQuantity('${item.id}', 1)">+</button>
                </div>
                <div class="item-price">
                    <span class="price">${item.price}</span>
                </div>
                <button class="remove-btn" onclick="removeItem('${item.id}')" title="Xóa sản phẩm">×</button>
            </div>
        </div>
    `).join('');
    
    updateCartTotal();
}

function updateQuantity(itemId, delta) {
    let cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
    const itemIndex = cart.findIndex(item => item.id === itemId);
    
    if (itemIndex > -1) {
        cart[itemIndex].quantity += delta;
        
        if (cart[itemIndex].quantity <= 0) {
            cart.splice(itemIndex, 1);
        }
        
        localStorage.setItem('vanmoc_cart', JSON.stringify(cart));
        loadCart();
        updateCartCounter();
    }
}

function removeItem(itemId) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
        let cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
        cart = cart.filter(item => item.id !== itemId);
        localStorage.setItem('vanmoc_cart', JSON.stringify(cart));
        
        loadCart();
        updateCartCounter();
        
        showNotification('Đã xóa sản phẩm khỏi giỏ hàng', 'success');
    }
}

function updateCartTotal() {
    const cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
    let subtotal = 0;
    
    cart.forEach(item => {
        const price = parseInt(item.price.replace(/[^\d]/g, ''));
        subtotal += price * item.quantity;
    });
    
    const discount = subtotal * 0.1; // 10% discount
    const vat = (subtotal - discount) * 0.1; // 10% VAT
    const total = subtotal - discount + vat;
    
    // Update summary
    document.querySelector('.summary-row:nth-child(1) span:last-child').textContent = formatPrice(subtotal);
    document.querySelector('.summary-row:nth-child(3) span:last-child').textContent = '-' + formatPrice(discount);
    document.querySelector('.summary-row:nth-child(4) span:last-child').textContent = formatPrice(vat);
    document.querySelector('.summary-row.total span:last-child').textContent = formatPrice(total);
}

function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price) + '₫';
}

function updateCartCounter() {
    const cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    let cartCounter = document.querySelector('.cart-counter');
    if (!cartCounter && totalItems > 0) {
        const cartIcon = document.querySelector('.cart-link');
        if (cartIcon) {
            cartCounter = document.createElement('span');
            cartCounter.className = 'cart-counter';
            cartCounter.style.cssText = `
                position: absolute;
                top: -8px;
                right: -8px;
                background: #dc3545;
                color: white;
                border-radius: 50%;
                width: 20px;
                height: 20px;
                font-size: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
            `;
            cartIcon.style.position = 'relative';
            cartIcon.appendChild(cartCounter);
        }
    }
    
    if (cartCounter) {
        cartCounter.textContent = totalItems;
        cartCounter.style.display = totalItems > 0 ? 'flex' : 'none';
    }
}

function showNotification(message, type = 'success') {
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#28a745' : '#dc3545'};
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        z-index: 10000;
        font-family: 'Be Vietnam Pro', sans-serif;
        font-size: 14px;
        max-width: 300px;
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
    `;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

function proceedToCheckout() {
    const cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
    if (cart.length === 0) {
        showNotification('Giỏ hàng của bạn đang trống', 'error');
        return;
    }
    window.location.href = '{{ route("public.checkout") }}';
}

// Initialize cart on page load
document.addEventListener('DOMContentLoaded', function() {
    loadCart();
    updateCartCounter();
});
</script>
