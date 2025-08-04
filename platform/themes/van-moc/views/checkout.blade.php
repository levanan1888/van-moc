@php
    Theme::layout('default');
    Theme::set('section-name', 'Thanh toán');
@endphp

<div class="container">
    <div class="checkout-page">
        <div class="checkout-content">
            <!-- Checkout Form Section -->
            <div class="checkout-form-section">
                <h2 class="checkout-title">Thông tin giao hàng</h2>
                
                <form class="checkout-form" id="checkoutForm">
                    <!-- Customer Information -->
                    <div class="form-section">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="fullName">Họ và tên</label>
                                <input type="text" id="fullName" name="fullName" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="tel" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" id="address" name="address" placeholder="Số nhà, tên đường..." required>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="form-section">
                        <h3>Phương thức thanh toán</h3>
                        <div class="payment-methods">
                            <label class="payment-option">
                                <input type="radio" name="paymentMethod" value="cod" checked>
                                <span class="payment-label">
                                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/cod-icon.svg') }}" alt="COD">
                                    Thanh toán khi nhận hàng (COD)
                                </span>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="paymentMethod" value="bank">
                                <span class="payment-label">
                                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/bank-icon.svg') }}" alt="Bank">
                                    Chuyển khoản ngân hàng
                                </span>
                            </label>
                            <!-- <label class="payment-option">
                                <input type="radio" name="paymentMethod" value="momo">
                                <span class="payment-label">
                                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/momo-icon.svg') }}" alt="MoMo">
                                    Ví điện tử MoMo
                                </span>
                            </label> -->
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <!-- <div class="form-section">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="ward">Phường/Xã</label>
                                <select id="ward" name="ward" required>
                                    <option value="">Chọn phường/xã</option>
                                    <option value="phuong-1">Phường 1</option>
                                    <option value="phuong-2">Phường 2</option>
                                    <option value="phuong-3">Phường 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="notes">Ghi chú</label>
                                <textarea id="notes" name="notes" placeholder="Ghi chú về đơn hàng..."></textarea>
                            </div>
                        </div>
                    </div> -->


                </form>
            </div>

            <!-- Order Summary Section -->
            <div class="order-summary-section">
                <div class="summary-card">
                    <h3>Đơn hàng của bạn</h3>
                    
                    <div class="order-items">
                        <div class="order-item">
                            <div class="item-info">
                                <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property11.png') }}" alt="Product">
                                <div class="item-details">
                                    <span class="item-name">Combo 3 Kem đánh răng Sudanta</span>
                                    <span class="item-qty">SL:1</span>
                                </div>
                            </div>
                            <div class="item-price">
                                <span class="original-price">179.400₫</span>
                                <span class="current-price">149.400₫</span>
                            </div>
                        </div>
                        
                        <div class="order-item">
                            <div class="item-info">
                                <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property11.png') }}" alt="Product">
                                <div class="item-details">
                                    <span class="item-name">Sữa tắm tinh dầu thảo dược Mộc Hương</span>
                                    <span class="item-qty">SL:1</span>
                                </div>
                            </div>
                            <span class="item-price">284.000₫</span>
                        </div>
                        
                        <div class="order-item">
                            <div class="item-info">
                                <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property11.png') }}" alt="Product">
                                <div class="item-details">
                                    <span class="item-name">Nước cốt gà Brand's</span>
                                    <span class="item-qty">SL:1</span>
                                </div>
                            </div>
                            <span class="item-price">39.500₫</span>
                        </div>
                    </div>
                    
                    <div class="summary-calculations">
                        <div class="summary-row">
                            <span>Tổng tiền hàng</span>
                            <span>503.900₫</span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Giá khuyến mãi sản phẩm</span>
                            <span>30.000₫</span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Phí vận chuyển</span>
                            <span>30.000₫</span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Giảm phí vận chuyển</span>
                            <span>10.000₫</span>
                        </div>
                        
                        <div class="summary-row total">
                            <span>Tổng thanh toán</span>
                            <span>493.900₫</span>
                        </div>
                    </div>
                    
                    <button class="place-order-btn" onclick="placeOrder()">
                        HOÀN TẤT THANH TOÁN
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.checkout-page {
    padding: 40px 0;
    font-family: 'Be Vietnam Pro', sans-serif;
}

.checkout-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 40px;
    align-items: start;
}

.checkout-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 30px;
    color: #333;
}

.checkout-form {
    background: #fff;
    border-radius: 12px;
    padding: 0;
}

.form-section {
    margin-bottom: 35px;
    padding: 25px;
    background: #fff;
    border: 1px solid #f0f0f0;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}

.form-section h3 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-row:last-child {
    margin-bottom: 0;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 8px;
    color: #333;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
    transition: border-color 0.3s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #28a745;
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 80px;
}

.payment-methods {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.payment-option {
    display: flex;
    align-items: center;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s;
}

.payment-option:hover {
    border-color: #28a745;
    background: #f8fff9;
}

.payment-option input[type="radio"] {
    margin-right: 12px;
}

.payment-label {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    font-weight: 500;
}

.payment-label img {
    width: 24px;
    height: 24px;
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

.order-items {
    margin-bottom: 25px;
}

.order-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.order-item:last-child {
    border-bottom: none;
}

.item-info {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
}

.item-info img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 6px;
}

.item-details {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.item-name {
    font-size: 14px;
    font-weight: 500;
    color: #333;
}

.item-qty {
    font-size: 12px;
    color: #666;
}

.item-price {
    font-size: 14px;
    font-weight: 600;
    color: #28a745;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.original-price {
    text-decoration: line-through;
    color: #999;
    font-size: 12px;
}

.current-price {
    color: #28a745;
    font-weight: 600;
}

.summary-calculations {
    border-top: 1px solid #f0f0f0;
    padding-top: 20px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    font-size: 14px;
}

.summary-row.total {
    border-top: 1px solid #f0f0f0;
    padding-top: 15px;
    margin-top: 15px;
    font-size: 16px;
    font-weight: 600;
}

.discount {
    color: #28a745;
}

.place-order-btn {
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

.place-order-btn:hover {
    background: #218838;
}

/* Responsive Design */
@media (max-width: 768px) {
    .checkout-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .payment-option {
        padding: 12px;
    }
    
    .payment-label {
        font-size: 13px;
    }
}
</style>
<script>
// Load cart items and update checkout summary
function loadCheckoutSummary() {
    const cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
    const orderItemsContainer = document.querySelector('.order-items');
    const summaryCalculations = document.querySelector('.summary-calculations');
    
    if (cart.length === 0) {
        window.location.href = '{{ route("public.cart") }}';
        return;
    }
    
    // Render order items
    orderItemsContainer.innerHTML = cart.map(item => `
        <div class="order-item">
            <div class="item-info">
                <img src="${item.image}" alt="${item.name}">
                <div class="item-details">
                    <span class="item-name">${item.name}</span>
                    <span class="item-qty">x${item.quantity}</span>
                </div>
            </div>
            <span class="item-price">${item.price}</span>
        </div>
    `).join('');
    
    // Calculate totals
    let subtotal = 0;
    cart.forEach(item => {
        const price = parseInt(item.price.replace(/[^\d]/g, ''));
        subtotal += price * item.quantity;
    });
    
    const discount = subtotal * 0.1; // 10% discount
    const vat = (subtotal - discount) * 0.1; // 10% VAT
    const total = subtotal - discount + vat;
    
    // Update summary calculations
    const summaryRows = summaryCalculations.querySelectorAll('.summary-row');
    summaryRows[0].querySelector('span:last-child').textContent = formatPrice(subtotal);
    summaryRows[2].querySelector('span:last-child').textContent = '-' + formatPrice(discount);
    summaryRows[3].querySelector('span:last-child').textContent = formatPrice(vat);
    summaryRows[4].querySelector('span:last-child').textContent = formatPrice(total);
}

function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price) + '₫';
}

function placeOrder() {
    const form = document.getElementById('checkoutForm');
    const cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
    
    if (cart.length === 0) {
        showNotification('Giỏ hàng của bạn đang trống', 'error');
        return;
    }
    
    if (form.checkValidity()) {
        // Show loading state
        const placeOrderBtn = document.querySelector('.place-order-btn');
        const originalText = placeOrderBtn.textContent;
        placeOrderBtn.textContent = 'ĐANG XỬ LÝ...';
        placeOrderBtn.disabled = true;
        
        // Simulate order processing
        setTimeout(() => {
            // Clear cart after successful order
            localStorage.removeItem('vanmoc_cart');
            
            // Show success message
            showNotification('Đơn hàng của bạn đã được đặt thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.', 'success');
            
            // Redirect to home page after 2 seconds
            setTimeout(() => {
                window.location.href = '{{ route("public.index") }}';
            }, 2000);
        }, 2000);
    } else {
        form.reportValidity();
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



// Initialize checkout page
document.addEventListener('DOMContentLoaded', function() {
    loadCheckoutSummary();
});
</script>

