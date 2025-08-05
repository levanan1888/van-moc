@php Theme::layout('default'); Theme::set('section-name', $product->name); if ($product->categories->count()) { Theme::set('breadcrumb_category', $product->categories->first()->name); Theme::set('breadcrumb_category_url', $product->categories->first()->url); } @endphp

<script>
// Tab switching functionality - Define first
function switchTab(tabName) {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    // Remove active class from all buttons and panes
    tabButtons.forEach(btn => btn.classList.remove('active'));
    tabPanes.forEach(pane => pane.classList.remove('active'));
    
    // Add active class to clicked button and corresponding pane
    const activeButton = document.querySelector(`[data-tab="${tabName}"]`);
    const activePane = document.getElementById(tabName);
    
    if (activeButton && activePane) {
        activeButton.classList.add('active');
        activePane.classList.add('active');
        console.log('Switched to tab:', tabName);
    } else {
        console.error('Tab not found:', tabName);
    }
}

// Change main image when clicking thumbnails
function changeMainImage(src) {
    document.getElementById('mainProductImage').src = src;
    
    // Update active thumbnail
    document.querySelectorAll('.thumbnail-item').forEach(item => {
        item.classList.remove('active');
    });
    event.target.closest('.thumbnail-item').classList.add('active');
}

// Quantity selector
function changeQuantity(delta) {
    const quantityInput = document.getElementById('quantity');
    let currentValue = parseInt(quantityInput.value);
    let newValue = currentValue + delta;
    
    if (newValue >= 1 && newValue <= 99) {
        quantityInput.value = newValue;
    }
}

// Add to cart functionality with animation
function addToCart() {
    const quantity = document.getElementById('quantity').value;
    const productName = document.querySelector('.product-title').textContent;
    const productPrice = document.querySelector('.price-current').textContent;
    const productImage = document.getElementById('mainProductImage').src;
    
    // Create cart item object
    const cartItem = {
        id: '{{ $product->id }}',
        name: productName,
        price: productPrice,
        image: productImage,
        quantity: parseInt(quantity)
    };
    
    // Add to cart with animation
    addToCartWithAnimation(cartItem);
    
    // Update cart counter
    updateCartCounter();
    
    // Show subtle success message
    showNotification(`Đã thêm ${quantity} sản phẩm vào giỏ hàng!`, 'success');
}

// Buy now functionality
function buyNow() {
    const quantity = document.getElementById('quantity').value;
    const productName = document.querySelector('.product-title').textContent;
    const productPrice = document.querySelector('.price-current').textContent;
    const productImage = document.getElementById('mainProductImage').src;
    
    // Create cart item object
    const cartItem = {
        id: '{{ $product->id }}',
        name: productName,
        price: productPrice,
        image: productImage,
        quantity: parseInt(quantity)
    };
    
    // Add to cart first
    addToCartWithAnimation(cartItem);
    
    // Show loading state
    const buyBtn = document.querySelector('.btn-buy-now');
    const originalText = buyBtn.textContent;
    buyBtn.textContent = 'ĐANG XỬ LÝ...';
    buyBtn.disabled = true;
    
    // Redirect to checkout after animation
    setTimeout(() => {
        window.location.href = '{{ route("public.checkout") }}';
    }, 1000);
}

// Cart animation and notification functions
function addToCartWithAnimation(cartItem) {
    // Get the product image for animation
    const productImg = document.getElementById('mainProductImage');
    const cartIcon = document.querySelector('.cart-link') || document.querySelector('.header-icons a:last-child');
    
    if (productImg && cartIcon) {
        // Create flying image animation
        const flyingImg = productImg.cloneNode(true);
        flyingImg.style.position = 'fixed';
        flyingImg.style.width = '100px';
        flyingImg.style.height = '100px';
        flyingImg.style.zIndex = '99999';
        flyingImg.style.transition = 'all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        flyingImg.style.borderRadius = '12px';
        flyingImg.style.boxShadow = '0 8px 30px rgba(40, 167, 69, 0.4)';
        flyingImg.style.border = '3px solid #28a745';
        flyingImg.style.pointerEvents = 'none';
        
        // Get positions
        const imgRect = productImg.getBoundingClientRect();
        const cartRect = cartIcon.getBoundingClientRect();
        
        // Set initial position
        flyingImg.style.left = (imgRect.left + imgRect.width/2 - 50) + 'px';
        flyingImg.style.top = (imgRect.top + imgRect.height/2 - 50) + 'px';
        
        document.body.appendChild(flyingImg);
        
        // Animate to cart with parabolic path
        setTimeout(() => {
            flyingImg.style.left = (cartRect.left + cartRect.width/2 - 15) + 'px';
            flyingImg.style.top = (cartRect.top + cartRect.height/2 - 15) + 'px';
            flyingImg.style.width = '30px';
            flyingImg.style.height = '30px';
            flyingImg.style.opacity = '0.8';
            flyingImg.style.transform = 'rotate(360deg) scale(0.3)';
        }, 100);
        
        // Final fade out
        setTimeout(() => {
            flyingImg.style.opacity = '0';
            flyingImg.style.transform = 'rotate(720deg) scale(0.1)';
        }, 800);
        
        // Remove after animation
        setTimeout(() => {
            if (document.body.contains(flyingImg)) {
                document.body.removeChild(flyingImg);
            }
        }, 1300);
        
        // Cart bounce animation with green glow
        cartIcon.style.transition = 'all 0.3s ease';
        cartIcon.style.transform = 'scale(1.3)';
        cartIcon.style.filter = 'drop-shadow(0 0 10px #28a745)';
        
        setTimeout(() => {
            cartIcon.style.transform = 'scale(1.1)';
        }, 150);
        
        setTimeout(() => {
            cartIcon.style.transform = 'scale(1)';
            cartIcon.style.filter = 'none';
        }, 300);
    }
    
    // Save to localStorage
    saveToCart(cartItem);
}

function saveToCart(cartItem) {
    let cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
    
    // Check if item already exists
    const existingItemIndex = cart.findIndex(item => item.id === cartItem.id);
    
    if (existingItemIndex > -1) {
        // Update quantity
        cart[existingItemIndex].quantity += cartItem.quantity;
    } else {
        // Add new item
        cart.push(cartItem);
    }
    
    localStorage.setItem('vanmoc_cart', JSON.stringify(cart));
}

function updateCartCounter() {
    const cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
    const totalItems = cart.length; // Đếm số loại sản phẩm khác nhau, không phải tổng quantity
    
    // Update cart counter if exists
    let cartCounter = document.querySelector('.cart-counter');
    if (!cartCounter && totalItems > 0) {
        // Create cart counter
        const cartIcon = document.querySelector('.cart-link') || document.querySelector('.header-icons a:last-child');
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
                z-index: 10;
            `;
            cartIcon.style.position = 'relative';
            cartIcon.appendChild(cartCounter);
        }
    }
    
    if (cartCounter) {
        cartCounter.textContent = totalItems;
        cartCounter.style.display = totalItems > 0 ? 'flex' : 'none';
        
        // Add bounce animation when counter updates
        if (totalItems > 0) {
            cartCounter.style.transform = 'scale(1.3)';
            setTimeout(() => {
                cartCounter.style.transform = 'scale(1)';
            }, 200);
        }
    }
}

function showNotification(message, type = 'success') {
    // Remove existing notification
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    // Create notification
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.style.cssText = `
        position: fixed;
        top: 80px;
        right: 20px;
        background: ${type === 'success' ? 'rgba(40, 167, 69, 0.95)' : 'rgba(220, 53, 69, 0.95)'};
        color: white;
        padding: 12px 18px;
        border-radius: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        z-index: 9999;
        font-family: 'Be Vietnam Pro', sans-serif;
        font-size: 13px;
        font-weight: 500;
        max-width: 250px;
        transform: translateX(100%) scale(0.8);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        opacity: 0;
        backdrop-filter: blur(10px);
    `;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0) scale(1)';
        notification.style.opacity = '1';
    }, 100);
    
    // Auto remove after 2 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%) scale(0.8)';
        notification.style.opacity = '0';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 400);
    }, 2000);
}
</script>

    <div class="container">
        <!-- 🖼️ 2. Bố cục hiển thị - Layout 2 cột -->
        <div class="product-main-section">
            <!-- Cột trái - Ảnh sản phẩm -->
            <div class="product-images">
                <div class="main-image">
                    @if ($product->image)
                        <img src="{{ RvMedia::getImageUrl($product->image, 'large', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}" id="mainProductImage">
                    @else
                        <img src="{{ RvMedia::getDefaultImage() }}" alt="{{ $product->name }}" id="mainProductImage">
                    @endif
                </div>
                
                <div class="thumbnail-images">
                    @php
                        $productImages = collect();
                        
                        // Thêm ảnh chính nếu có
                        if ($product->image) {
                            $productImages->push((object)['image' => $product->image]);
                        }
                        
                        // Thêm ảnh phụ nếu có
                        if (isset($product->images) && is_object($product->images) && method_exists($product->images, 'count') && $product->images->count() > 0) {
                            foreach ($product->images as $image) {
                                if (!$productImages->contains('image', $image->image)) {
                                    $productImages->push($image);
                                }
                            }
                        }
                        
                        // Giới hạn tối đa 4 ảnh (1 ảnh chính + 3 ảnh phụ)
                        $productImages = $productImages->take(4);
                    @endphp
                    
                    @if ($productImages->count() > 0)
                        @foreach ($productImages as $image)
                            <div class="thumbnail-item">
                                <img src="{{ RvMedia::getImageUrl($image->image, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}" onclick="changeMainImage(this.src)">
                            </div>
                        @endforeach
                    @else
                        {{-- Chỉ hiển thị 1 ảnh default khi không có ảnh nào --}}
                        <div class="thumbnail-item">
                            <img src="{{ RvMedia::getDefaultImage() }}" alt="{{ $product->name }}" onclick="changeMainImage(this.src)">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Cột phải - Thông tin sản phẩm -->
            <div class="product-info">
                <!-- 📋 3. Thông tin sản phẩm -->
                <h1 class="product-title">{{ $product->name }}</h1>
                
                <!-- ⭐ 7. Đánh giá sản phẩm -->
                <div class="product-rating">
                    <div class="stars">
                        <span class="star filled">★</span>
                        <span class="star filled">★</span>
                        <span class="star filled">★</span>
                        <span class="star filled">★</span>
                        <span class="star filled">★</span>
                    </div>
                    <span class="rating-text">28 đánh giá</span>
                </div>

                <!-- Giá bán: xanh lá, nổi bật -->
                <div class="product-price-section">
                    @if (isset($product->price))
                        <div class="price-current">{{ number_format($product->price, 0, ',', '.') }} ₫</div>
                    @else
                        <div class="price-current">142,000 ₫</div>
                    @endif
                </div>

                <!-- Số lượng điều chỉnh và nút mua -->
                <div class="quantity-actions-row">
                    <div class="quantity-selector">
                        <button type="button" class="qty-btn minus" onclick="changeQuantity(-1)">-</button>
                        <input type="number" id="quantity" value="1" min="1" max="99">
                        <button type="button" class="qty-btn plus" onclick="changeQuantity(1)">+</button>
                    </div>
                    <div class="action-buttons">
                        <button class="btn-buy-now" onclick="buyNow()">MUA NGAY</button>
                        <button class="btn-add-to-cart" onclick="addToCart()">THÊM VÀO GIỎ</button>
                    </div>
                </div>

                <!-- Các biểu tượng: "Không cồn", "Không dầu khoáng", v.v... -->
                <div class="product-features">
                    <div class="feature-item feature-highlight">
                        <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_noidung.svg') }}" alt="No Alcohol">
                        <span>Không cồn</span>
                    </div>
                    <div class="feature-item">
                        <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_noidung.svg') }}" alt="No Sulfate">
                        <span>Không sulfate</span>
                    </div>
                    <div class="feature-item">
                        <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_noidung.svg') }}" alt="No Paraben">
                        <span>Không paraben</span>
                    </div>
                    <div class="feature-item feature-highlight">
                        <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_noidung.svg') }}" alt="No Mineral Oil">
                        <span>Không dầu khoáng</span>
                    </div>
                </div>

                <!-- Phần công dụng trình bày gạch đầu dòng rõ ràng -->
                <div class="product-uses">
                    <h3>Công dụng:</h3>
                    <ul>
                        <li>Chống nắng hiệu quả ngay sau khi bôi, bảo vệ da và chống lại tia UVA/UVB.</li>
                        <li>Dưỡng sáng da sau khi thoa.</li>
                        <li>Chống lão hóa Công thức không bết dính, tạo độ thông thoáng cho lỗ chân lông Chống thấm nước & mồ hôi.</li>
                    </ul>
                </div>

                <!-- 📤 5. Chia sẻ & tương tác -->
                <div class="social-share">
                    <span>Chia sẻ:</span>
                    <div class="social-icons">
                        <a href="#" class="social-icon facebook">
                            <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_face.svg') }}" alt="Facebook">
                        </a>
                        <a href="#" class="social-icon twitter">
                            <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_twiter.svg') }}" alt="Twitter">
                        </a>
                        <a href="#" class="social-icon pinterest">
                            <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_pin.svg') }}" alt="Pinterest">
                        </a>
                        <a href="#" class="social-icon linkedin">
                            <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_in.svg') }}" alt="LinkedIn">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- 📋 4. Tab hiển thị: Mô tả, Thành phần, Cách dùng -->
        <div class="product-tabs-section">
            <div class="tab-buttons">
                <button class="tab-btn active" data-tab="description" onclick="switchTab('description')">Mô tả</button>
                <button class="tab-btn" data-tab="ingredients" onclick="switchTab('ingredients')">Thành phần</button>
                <button class="tab-btn" data-tab="usage" onclick="switchTab('usage')">Cách dùng</button>
            </div>
            
            <div class="tab-content">
                <div id="description" class="tab-pane active">
                    <div class="product-full-description">
                        <h3>Mô tả sản phẩm</h3>
                        <p>Nước dưỡng tóc tinh dầu bưởi 140ml là sản phẩm chăm sóc tóc cao cấp được chiết xuất từ 100% thành phần thiên nhiên, đặc biệt là tinh dầu bưởi nguyên chất. Sản phẩm được nghiên cứu và phát triển để mang lại giải pháp toàn diện cho việc chăm sóc tóc và da đầu.</p>
                        
                        <h3>Công dụng chính:</h3>
                        <ul>
                            <li><strong>Giảm gãy rụng:</strong> Tinh dầu bưởi và các thành phần tự nhiên giúp tăng cường sức khỏe nang tóc, giảm thiểu tình trạng gãy rụng</li>
                            <li><strong>Làm mềm tóc:</strong> Dưỡng ẩm sâu, làm mềm mượt tóc từ chân đến ngọn</li>
                            <li><strong>Kích thích mọc tóc:</strong> Thúc đẩy quá trình tái tạo tế bào, kích thích mọc tóc mới</li>
                            <li><strong>Làm sạch da đầu:</strong> Loại bỏ bụi bẩn, dầu thừa và tế bào chết</li>
                            <li><strong>Kháng khuẩn tự nhiên:</strong> Ngăn ngừa gàu và các vấn đề về da đầu</li>
                        </ul>
                        
                        <h3>Đối tượng sử dụng:</h3>
                        <ul>
                            <li>Tóc khô, hư tổn do hóa chất</li>
                            <li>Tóc gãy rụng nhiều</li>
                            <li>Da đầu nhạy cảm, dễ bị kích ứng</li>
                            <li>Mọi loại tóc và mọi lứa tuổi</li>
                        </ul>
                    </div>
                </div>
                
                <div id="ingredients" class="tab-pane">
                    <div class="product-ingredients">
                        <h3>Thành phần chi tiết:</h3>
                        <p>Sản phẩm là sự kết hợp hoàn hảo giữa các thành phần thiên nhiên và khoa học, mang lại giải pháp chăm sóc tóc toàn diện.</p>
                        <ul>
                            <li><strong>Tinh dầu bưởi tự nhiên (Citrus Grandis Peel Oil):</strong> Giàu vitamin C và chất chống oxy hóa, giúp làm sạch da đầu, kích thích mọc tóc và mang lại hương thơm tươi mát.</li>
                            <li><strong>Chiết xuất lá trầu không:</strong> Có tính kháng khuẩn tự nhiên, giúp ngăn ngừa gàu và viêm da đầu.</li>
                            <li><strong>Dầu dừa nguyên chất (Cocos Nucifera Oil):</strong> Dưỡng ẩm sâu, làm mềm tóc và bảo vệ tóc khỏi tác hại của môi trường.</li>
                            <li><strong>Chiết xuất nha đam (Aloe Vera Extract):</strong> Làm dịu da đầu, giảm ngứa và kích ứng.</li>
                            <li><strong>Vitamin E (Tocopherol):</strong> Chống oxy hóa, bảo vệ tóc khỏi tác hại của tia UV và môi trường.</li>
                            <li><strong>Panthenol (Vitamin B5):</strong> Giúp tóc mềm mượt, dễ chải và tăng độ bóng.</li>
                            <li><strong>Glycerin:</strong> Giữ ẩm cho tóc và da đầu, ngăn ngừa khô xơ.</li>
                            <li><strong>Nước tinh khiết (Aqua):</strong> Là dung môi an toàn, giúp hòa tan các thành phần.</li>
                        </ul>
                        
                        <div class="ingredient-note">
                            <h4>Thông tin bổ sung:</h4>
                            <ul>
                                <li>Không chứa Parabens, Sulfates, Silicones</li>
                                <li>Không test trên động vật</li>
                                <li>Phù hợp cho mọi loại tóc</li>
                                <li>An toàn cho da nhạy cảm</li>
                                <li>Đã được kiểm nghiệm da liễu</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div id="usage" class="tab-pane">
                    <div class="product-usage">
                        <h3>Hướng dẫn sử dụng chi tiết để đạt hiệu quả tốt nhất:</h3>
                        
                        <div class="usage-step">
                            <h4>Bước 1: Làm sạch tóc</h4>
                            <p>Gội sạch tóc với dầu gội thông thường để loại bỏ bụi bẩn và dầu thừa. Dùng khăn mềm thấm khô tóc nhẹ nhàng, không chà xát mạnh.</p>
                        </div>
                        
                        <div class="usage-step">
                            <h4>Bước 2: Thoa sản phẩm</h4>
                            <p>Lấy 2-3ml nước dưỡng tóc, thoa đều từ chân tóc đến ngọn tóc. Đặc biệt chú ý đến những vùng tóc khô và hư tổn.</p>
                        </div>
                        
                        <div class="usage-step">
                            <h4>Bước 3: Massage da đầu</h4>
                            <p>Dùng đầu ngón tay massage da đầu nhẹ nhàng theo chuyển động tròn trong 3-5 phút. Việc này giúp sản phẩm thẩm thấu sâu và kích thích tuần hoàn máu.</p>
                        </div>
                        
                        <div class="usage-step">
                            <h4>Bước 4: Để yên và xả sạch</h4>
                            <p>Giữ nguyên sản phẩm trong 10-15 phút để các thành phần thẩm thấu hoàn toàn. Sau đó xả lại bằng nước ấm.</p>
                        </div>
                        
                        <div class="usage-tips">
                            <h4>Tần suất sử dụng:</h4>
                            <ul>
                                <li><strong>Sử dụng 2-3 lần/tuần:</strong> Để có kết quả tốt nhất</li>
                                <li><strong>Có thể sử dụng hàng ngày:</strong> Nếu tóc khô và hư tổn nhiều</li>
                                <li><strong>Không nên sử dụng quá 4 lần/tuần:</strong> Để tránh tóc bị bết dính</li>
                            </ul>
                            
                            <h4>Mẹo sử dụng hiệu quả:</h4>
                            <ul>
                                <li><strong>Thời điểm tốt nhất:</strong> Sử dụng sau khi gội đầu, khi tóc còn ẩm</li>
                                <li><strong>Bảo quản đúng cách:</strong> Giữ sản phẩm ở nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp</li>
                                <li><strong>Kiểm tra phản ứng:</strong> Nếu có kích ứng, ngừng sử dụng và tham khảo ý kiến bác sĩ</li>
                                <li><strong>Tránh dính vào mắt:</strong> Nếu không may dính vào mắt, rửa ngay bằng nước sạch</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Reviews Section -->
        <div class="customer-reviews-section">
            <div class="reviews-header">
                <div>
                    <h2 class="section-title">REVIEW NƯỚC DƯỠNG TÓC TINH DẦU BƯỞI 140ML</h2>
                    <p class="reviews-count">23 đánh giá sản phẩm này</p>
                </div>
                <a href="#" class="view-all-reviews">Xem tất cả <i class="fas fa-chevron-right"></i></a>
            </div>
            <div class="customer-reviews-grid">
                        <div class="review-item">
                                <div class="review-avatar">
                        <img src="{{ RvMedia::getDefaultImage() }}" alt="Lê Tuấn">
                                </div>
                    <div class="review-content">
                        <div class="review-header">
                            <div class="author-name">Lê Tuấn</div>
                            <div class="review-date">Đã mua 29 sản phẩm</div>
                                </div>
                        <div class="review-comment">
                            <p>Sản phẩm dùng rất tốt, đúng như kỳ vọng của mình, nhân viên tư vấn bán hàng nhiệt tình, vui vẻ và giao hàng nhanh, sản phẩm chất lượng, đặc biệt khi trao đổi với nhân viên shop, rất nhiệt tình và giải đáp rất kĩ.</p>
                        </div>
                    </div>
                </div>
                <div class="review-item">
                    <div class="review-avatar">
                        <img src="{{ RvMedia::getDefaultImage() }}" alt="Trang Phạm">
                    </div>
                    <div class="review-content">
                        <div class="review-header">
                            <div class="author-name">Trang Phạm</div>
                            <div class="review-date">Đã mua 29 sản phẩm</div>
                            </div>
                            <div class="review-comment">
                            <p>Sản phẩm dùng rất tốt, đúng như kỳ vọng của mình, nhân viên tư vấn bán hàng nhiệt tình, vui vẻ và giao hàng nhanh, sản phẩm chất lượng, đặc biệt khi trao đổi với nhân viên shop, rất nhiệt tình và giải đáp rất kĩ.</p>
                            </div>
                        </div>
                </div>
                <div class="review-item">
                    <div class="review-avatar">
                        <img src="{{ RvMedia::getDefaultImage() }}" alt="Đức Nguyễn">
                    </div>
                    <div class="review-content">
                        <div class="review-header">
                            <div class="author-name">Đức Nguyễn</div>
                            <div class="review-date">Đã mua 29 sản phẩm</div>
                        </div>
                        <div class="review-comment">
                            <p>Sản phẩm dùng rất tốt, đúng như kỳ vọng của mình, nhân viên tư vấn bán hàng nhiệt tình, vui vẻ và giao hàng nhanh, sản phẩm chất lượng, đặc biệt khi trao đổi với nhân viên shop, rất nhiệt tình và giải đáp rất kĩ.</p>
                        </div>
                    </div>
                </div>
                <div class="review-item">
                    <div class="review-avatar">
                        <img src="{{ RvMedia::getDefaultImage() }}" alt="An Nguyễn">
                    </div>
                    <div class="review-content">
                        <div class="review-header">
                            <div class="author-name">An Nguyễn</div>
                            <div class="review-date">Đã mua 29 sản phẩm</div>
                        </div>
                        <div class="review-comment">
                            <p>Sản phẩm dùng rất tốt, đúng như kỳ vọng của mình, nhân viên tư vấn bán hàng nhiệt tình, vui vẻ và giao hàng nhanh, sản phẩm chất lượng, đặc biệt khi trao đổi với nhân viên shop, rất nhiệt tình và giải đáp rất kĩ.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Related Products Section -->
        <div class="related-products-section">
            <div class="container">
            <div class="section-header">
                    <div class="title-wrapper">
                        <h2>SẢN PHẨM LIÊN QUAN</h2>
                    </div>
                    <div class="subtitle-wrapper">
                        <a href="#" class="view-all">Xem tất cả sản phẩm <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/button_arrow.svg') }}" alt="arrow"></a>
                    </div>
            </div>
            
                <div class="product-grid">
                    <div class="product-item">
                        <div class="product-image">
                            <a href="#">
                                <img src="{{ RvMedia::getDefaultImage() }}" alt="Nước dưỡng tóc tinh dầu bưởi 140ml">
                            </a>
                            </div>
                        <div class="product-info">
                            <div class="product-text">
                                <h3><a href="#">Nước dưỡng tóc tinh dầu bưởi 140ml</a></h3>
                                <p class="product-brand">GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC</p>
                                <div class="price-wrapper">
                                    <span class="price">179.660₫</span>
                        </div>
                    </div>
                            <div class="add-to-cart">
                                <button type="button" class="btn-add-to-cart-featured" title="Thêm vào giỏ hàng">
                                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_cart.svg') }}" alt="Add to cart">
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-item">
                        <div class="product-image">
                            <a href="#">
                                <img src="{{ RvMedia::getDefaultImage() }}" alt="Dầu gội Vân Hương Mộc Hương">
                            </a>
                        </div>
                        <div class="product-info">
                            <div class="product-text">
                                <h3><a href="#">Dầu gội Vân Hương Mộc Hương</a></h3>
                                <p class="product-brand">PHỤC HỒI TÓC - GIẢM GÃY RỤNG</p>
                                <div class="price-wrapper">
                                    <span class="price">226.706₫</span>
                                </div>
                            </div>
                            <div class="add-to-cart">
                                <button type="button" class="btn-add-to-cart-featured" title="Thêm vào giỏ hàng">
                                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_cart.svg') }}" alt="Add to cart">
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-item">
                        <div class="product-image">
                            <a href="#">
                                <img src="{{ RvMedia::getDefaultImage() }}" alt="Nước dưỡng tóc tinh dầu bưởi 140ml">
                            </a>
                        </div>
                        <div class="product-info">
                            <div class="product-text">
                                <h3><a href="#">Nước dưỡng tóc tinh dầu bưởi 140ml</a></h3>
                                <p class="product-brand">GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC</p>
                                <div class="price-wrapper">
                                    <span class="price">279.660₫</span>
                                </div>
                            </div>
                            <div class="add-to-cart">
                                <button type="button" class="btn-add-to-cart-featured" title="Thêm vào giỏ hàng">
                                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_cart.svg') }}" alt="Add to cart">
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-item">
                        <div class="product-image">
                            <a href="#">
                                <img src="{{ RvMedia::getDefaultImage() }}" alt="Nước dưỡng tóc tinh dầu bưởi 140ml">
                            </a>
                            <div class="sale-badge">10% OFF</div>
                        </div>
                        <div class="product-info">
                            <div class="product-text">
                                <h3><a href="#">Nước dưỡng tóc tinh dầu bưởi 140ml</a></h3>
                                <p class="product-brand">GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC</p>
                                <div class="price-wrapper">
                                    <span class="price">279.660₫</span>
                                </div>
                            </div>
                            <div class="add-to-cart">
                                <button type="button" class="btn-add-to-cart-featured" title="Thêm vào giỏ hàng">
                                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_cart.svg') }}" alt="Add to cart">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Feedback Form -->
        <div class="feedback-section">
            <div class="commitments-grid">
                <div class="commitment-item full-width">
                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_noidung.svg') }}" alt="Genuine Commitment">
                    <span>Cam kết chính hãng</span>
                </div>
                <div class="commitment-item">
                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_noidung.svg') }}" alt="Nationwide Delivery">
                    <span>Giao hàng toàn quốc</span>
                </div>
                <div class="commitment-item">
                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_noidung.svg') }}" alt="24/7 Support">
                    <span>Hỗ trợ khách hàng 24/7</span>
                </div>
            </div>
            <div class="feedback-form">
                <h3>Đánh giá của bạn</h3>
                <form action="#" method="POST">
                    <div class="form-group">
                        <input type="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Họ và tên" required>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Nhập tiêu đề đánh giá của bạn">
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Viết nhận xét của bạn vào đây" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn-submit-review">Gửi đánh giá</button>
                </form>
            </div>
        </div>
    
<style>
/* Main Content Wrapper */
.main-content-wrapper {
    background-color: #FFFFFF;
    padding: 40px 0;
}

/* Breadcrumb Section */
.breadcrumb-section {
    background-color: #F7F7F7;
    padding: 20px 0;
}

.breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
}



/* 🖼️ 2. Bố cục hiển thị - Layout 2 cột */
.product-main-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    margin-bottom: 60px;
}

.product-images {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.main-image {
    border: 1px solid #eee;
    border-radius: 12px;
    overflow: hidden;
    background: #f8f9fa;
    aspect-ratio: 1;
}

.main-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.thumbnail-images {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    justify-content: flex-start;
}

.thumbnail-item {
    width: 80px;
    height: 80px;
    border: 2px solid #eee;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    transition: border-color 0.3s ease;
    flex-shrink: 0;
}

.thumbnail-item:hover,
.thumbnail-item.active {
    border-color: #28a745;
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Responsive cho thumbnail */
@media (max-width: 768px) {
    .thumbnail-images {
        gap: 10px;
        justify-content: center;
    }
    
    .thumbnail-item {
        width: 60px;
        height: 60px;
    }
}

/* 📋 3. Thông tin sản phẩm */
.product-info {
    display: flex;
    flex-direction: column;
    gap: 25px;
    align-items: flex-start; /* Align items to the left */
    background-color: #fff; /* Set background to white */
}

.product-title {
    font-family: 'Prata', serif;
    font-size: 28px; /* Adjusted font size */
    font-weight: 400; /* Standard weight */
    color: #333333;
    text-transform: uppercase;
    margin: 0;
    line-height: 1.4;
}

/* ⭐ 7. Đánh giá sản phẩm */
.product-rating {
    display: flex;
    align-items: center;
    gap: 10px;
    text-align: left;
    padding-left: 0;
}

.product-rating .stars {
    display: flex;
    color: #ccc; /* Light grey for stars */
}

.product-rating .star {
    font-size: 18px; /* Adjusted size */
}

.product-rating .star.filled {
    color: #FFC107; /* Keep filled stars yellow */
}

.product-rating .rating-text {
    font-size: 14px;
    color: #999; /* Light grey for review text */
}

/* Giá bán: xanh lá, nổi bật */
.product-price-section {
    margin-bottom: 20px;
    padding-left: 0;
}

.price-current {
    font-family: 'Prata', serif;
    font-size: 28px; /* Adjusted font size */
    font-weight: 400; /* Standard weight */
    color: #333333;
    text-transform: uppercase;
    margin: 0;
    line-height: 1.4;
}

/* Số lượng điều chỉnh và nút mua */
.quantity-actions-row {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
    padding-left: 0;
}

.quantity-selector {
    display: flex;
    align-items: center;
    border: 1px solid #ddd;
    border-radius: 6px;
    overflow: hidden;
    flex-shrink: 0;
}

.qty-btn {
    width: 40px;
    height: 40px;
    border: none;
    background: #f8f9fa;
    cursor: pointer;
    font-size: 18px;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.qty-btn:hover {
    background: #e9ecef;
}

#quantity {
    width: 60px;
    height: 40px;
    border: none;
    text-align: center;
    font-size: 16px;
    font-weight: 500;
}

/* Nút "MUA NGAY" và "THÊM VÀO GIỎ" màu xanh lá, bo tròn, cỡ vừa */
.action-buttons {
    display: flex;
    gap: 15px;
    flex: 1 1 auto; /* Ensure buttons stay in a row */
    white-space: nowrap; /* Prevent wrapping */
}

.btn-add-to-cart,
.btn-buy-now {
    flex: 1;
    padding: 15px 25px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    height: 40px;
}

.btn-buy-now {
    background: white;
    color: #000; /* Change text to black */
    border: 1px solid #28a745; /* Thinner border */
}

.btn-buy-now:hover {
    background: #28a745;
    color: white;
}

.btn-add-to-cart {
    background: #28a745;
    color: white;
}

.btn-add-to-cart:hover {
    background: #218838;
}

/* Các biểu tượng: "Không cồn", "Không dầu khoáng", v.v... */
.product-features {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 25px;
    width: 100%; /* Ensure it spans full width */
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 10px;
    background: transparent; /* No individual background */
    border: none; /* No individual border */
    padding: 0;
}

.feature-item.feature-highlight {
    background: transparent; /* No individual highlight background */
}

.feature-item img {
    width: 20px;
    height: 20px;
}

.feature-item span {
    font-size: 14px;
    color: #333;
    font-weight: 500;
}

/* Phần công dụng trình bày gạch đầu dòng rõ ràng */
.product-uses {
    margin-top: 20px;
    background: transparent;
}

.product-uses h3 {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
    background: transparent;
    text-decoration: underline;
    text-underline-offset: 6px;
}

.product-uses ul {
    list-style: none;
    padding: 0;
    background: transparent;
}

.product-uses li {
    position: relative;
    padding-left: 20px;
    margin-bottom: 8px;
    color: #666;
    line-height: 1.6;
    background: transparent;
}

.product-uses li::before {
    content: "•";
    position: absolute;
    left: 0;
    color: #28a745;
    font-weight: bold;
}

/* 📤 5. Chia sẻ & tương tác */
.social-share {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.social-share span {
    font-weight: 500;
    color: #333;
}

.social-icons {
    display: flex;
    gap: 10px;
}

.social-icon {
    width: 40px; /* Larger icon */
    height: 40px; /* Larger icon */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    text-decoration: none;
}

.social-icon.facebook {
    background: transparent;
}

.social-icon.twitter {
    background: transparent;
}

.social-icon.pinterest {
    background: transparent;
}

.social-icon.linkedin {
    background: transparent;
}

.social-icon:hover {
    transform: scale(1.1);
}

.social-icon img {
    width: 22px;
    height: 22px;
    filter: none;
}

/* 📋 4. Tab hiển thị: Mô tả, Thành phần, Cách dùng */
.product-tabs-section {
    margin-bottom: 60px;
}

.tab-buttons {
    display: flex;
    border-bottom: none; /* Remove bottom border */
    margin-bottom: 0;
    background: #f1f1f1;
    border-radius: 8px;
    overflow: hidden;
}

.tab-btn {
    flex: 1;
    padding: 18px 25px;
    border: none;
    background: #f1f1f1;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    color: #333;
    transition: all 0.3s ease;
    text-align: center;
    position: relative;
}

.tab-btn:hover {
    background: #e8e8e8;
    transform: translateY(-1px);
}

.tab-btn.active {
    background: #28a745;
    color: white;
    font-weight: 600;
    border-bottom: 3px solid #218838;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

.product-full-description,
.product-ingredients,
.product-usage {
    line-height: 1.8;
    color: #333;
}

.product-full-description h3,
.product-ingredients h3,
.product-usage h3 {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
}

.product-full-description h4,
.product-ingredients h4,
.product-usage h4 {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 20px 0 10px 0;
}

.product-full-description ul,
.product-ingredients ul,
.product-usage ul {
    padding-left: 20px;
    margin-bottom: 20px;
}

.product-full-description li,
.product-ingredients li,
.product-usage li {
    margin-bottom: 8px;
    line-height: 1.5;
}

.usage-step {
    margin-bottom: 25px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
}

.usage-step h4 {
    color: #28a745;
    margin-bottom: 10px;
}

.ingredient-note {
    margin-top: 20px;
    padding: 15px;
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    border-radius: 6px;
}

.usage-tips {
    margin-top: 30px;
    padding: 20px;
    background: #e8f5e8;
    border-radius: 8px;
}

/* Product Reviews Section */
.customer-reviews-section {
    margin-top: 60px;
    background-color: #F8F8F8; /* Match feedback section background */
    padding: 40px 0; /* Add padding to match full-width design */
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
    padding-left: calc(50vw - 50%);
    padding-right: calc(50vw - 50%);
}

.reviews-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 30px;
}

.section-title {
    font-size: 24px;
    font-weight: 700;
    margin: 0;
    color: #333;
    text-transform: uppercase;
}

.reviews-count {
    color: #6c757d;
    margin-top: 5px;
    font-size: 14px;
}

.view-all-reviews {
    color: #333;
    text-decoration: none;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 14px;
    transition: color 0.3s ease;
}

.view-all-reviews:hover {
    color: #28a745;
}

.view-all-reviews i {
    font-size: 12px;
}

.review-item {
    background: #FFFFFF;
    border: 1px solid #EAEAEA;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); /* Subtle shadow */
    min-width: 280px;
    flex-shrink: 0;
    text-align: center;
}

.review-avatar {
    margin-bottom: 15px;
}

.review-avatar img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
}

.author-name {
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 5px;
    color: #333;
}

.purchase-info {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 15px;
}

.review-comment {
    color: #555;
    line-height: 1.6;
    font-size: 14px;
    text-align: left;
}

.customer-reviews-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-top: 30px;
}

.review-item {
    background: #FFFFFF;
    border: 1px solid #EAEAEA;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    display: flex;
    gap: 12px;
    align-items: flex-start;
}

.review-avatar {
    flex-shrink: 0;
}

.review-avatar img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #f0f0f0;
}

.review-content {
    flex: 1;
    min-width: 0;
}

.review-header {
    margin-bottom: 8px;
}

.author-name {
    font-weight: 600;
    font-size: 14px;
    color: #333;
    margin-bottom: 2px;
}

.review-date {
    font-size: 11px;
    color: #6c757d;
}

.review-comment {
    color: #555;
    line-height: 1.4;
    font-size: 12px;
    text-align: justify;
}

/* Related Products Section */
.related-products-section {
    margin-top: 60px;
    background-color: #F9F9F9;
    padding: 60px 0;
}

.related-products-section .section-header {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-bottom: 30px;
    text-align: center;
}

.related-products-section .title-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-bottom: 10px;
}

.related-products-section .section-header h2 {
    font-family: 'Prata', serif;
    font-size: 28px;
    text-align: center;
    position: relative;
    margin: 0;
    padding-bottom: 10px;
    color: #244317;
}

.related-products-section .section-header h2:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 2px;
    background-color: #4A7D4A;
}

.related-products-section .subtitle-wrapper {
    margin-top: 5px;
}

.related-products-section .view-all {
    display: flex;
    align-items: center;
    gap: 5px;
    font-weight: 500;
    font-size: 14px;
    color: #666;
}

.related-products-section .view-all img {
    width: 16px;
    height: 16px;
}

.related-products-section .product-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin: 0 auto;
}

.related-products-section .product-item {
    background-color: #FFFFFF;
    border: 1px solid #EAEAEA;
    border-radius: 5px;
    overflow: hidden;
    transition: box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.related-products-section .product-item:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.related-products-section .product-image {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 0 10px;
    background-color: #FFFFFF;
}

.related-products-section .product-image img {
    object-fit: contain;
    display: block;
    transition: transform 0.3s ease;
}

.related-products-section .product-image a:hover img {
    transform: scale(1.05);
}

.related-products-section .sale-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background-color: #E57373;
    color: white;
    padding: 3px 8px;
    font-size: 11px;
    font-weight: 600;
    border-radius: 3px;
}

.related-products-section .product-info {
    padding: 12px;
    position: relative;
    text-align: left;
    flex-grow: 1;
    background-color: #f9f9f9;
    min-height: 100px;
}

.related-products-section .product-text {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    min-width: 0;
    margin-bottom: 10px;
}

.related-products-section .product-item h3 {
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 10px;
    line-height: 1.6;
}

.related-products-section .product-item h3 a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.related-products-section .product-item h3 a:hover {
    color: #28a745;
}

.related-products-section .product-brand {
    font-size: 10px;
    color: #777;
    text-transform: uppercase;
    margin-bottom: 8px;
    line-height: 1.2;
}

.related-products-section .price-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 5px;
}

.related-products-section .product-item .price {
    font-size: 15px;
    font-weight: 600;
    color: #4A7D4A;
}

.related-products-section .add-to-cart {
    position: absolute;
    bottom: 12px;
    right: 12px;
}

.related-products-section .add-to-cart .btn-add-to-cart-featured {
    background-color: #e8f5e9;
    border-radius: 5px;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    border: none;
    cursor: pointer;
    padding: 0;
}

.related-products-section .add-to-cart .btn-add-to-cart-featured img {
    width: 24px;
    height: 24px;
}

/* Responsive for related products */
@media (max-width: 1200px) {
    .related-products-section .product-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .related-products-section .product-grid {
        grid-template-columns: 1fr;
    }
}

/* Feedback Section */
.feedback-section {
    background: #f8f9fa;
    padding: 40px 0;
    margin: 60px -15px 0;
}

.feedback-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 60px;
    align-items: center;
}

.feedback-info {
    display: flex;
    align-items: center;
    gap: 20px;
}

.feedback-icon {
    width: 60px;
    height: 60px;
    background: #28a745;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.feedback-icon img {
    width: 30px;
    height: 30px;
    filter: brightness(0) invert(1);
}

.feedback-text h3 {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin: 0 0 8px 0;
}

.feedback-text p {
    color: #666;
    margin: 0;
    font-size: 16px;
}

.feedback-form {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.form-group {
    margin-bottom: 20px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
    transition: border-color 0.3s ease;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #28a745;
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 100px;
}

.submit-feedback-btn {
    width: 100%;
    padding: 15px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.submit-feedback-btn:hover {
    background: #218838;
}

/* Responsive Design */
@media (max-width: 991px) {
    .product-main-section {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .product-features {
        grid-template-columns: 1fr;
    }
    
    .quantity-actions-row {
        flex-direction: column;
        gap: 15px;
    }
    
    .action-buttons {
        width: 100%;
    }
    
    .tab-buttons {
        flex-direction: column;
    }
    
    .tab-btn.active {
        border-radius: 8px;
    }
    
    .reviews-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .customer-reviews-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    
    .review-item {
        padding: 15px;
    }
    
    .review-avatar img {
        width: 40px;
        height: 40px;
    }
}

@media (max-width: 768px) {
    .product-detail-page {
        padding: 20px 0;
    }
    
    .product-title {
        font-size: 24px;
    }
    
    .price-current {
        font-size: 28px;
    }
    
    .related-products-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }
    
    .thumbnail-images {
        gap: 10px;
    }
    
    .thumbnail-item {
        width: 60px;
        height: 60px;
    }
    
    .review-form {
        padding: 20px;
    }
    
    .customer-reviews-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .reviews-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .section-title {
        font-size: 20px;
    }
    
    .related-products-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    
    .product-card .product-action {
        width: 28px;
        height: 28px;
        bottom: 10px;
        right: 10px;
    }
    
    .product-card .product-action i {
        font-size: 12px;
    }
}

/* Feedback and Commitments Section */
.feedback-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-top: 50px;
    align-items: start;
    background-color: #F8F8F8; /* Light grey background matching footer */
    padding: 40px 0; /* Add padding to match full-width design */
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
    padding-left: calc(50vw - 50%);
    padding-right: calc(50vw - 50%);
}

.commitments-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.commitment-item {
    background: #fff;
    border: 1px solid #f0f0f0;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    min-height: 150px; /* Ensure consistent height */
}

.commitment-item.full-width {
    grid-column: span 2;
}

.commitment-item img {
    margin-bottom: 15px;
    height: 48px;
}

.commitment-item span {
    font-weight: 500;
}

.feedback-form {
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.feedback-form h3 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 22px;
    font-weight: 600;
}

.feedback-form .form-group {
    margin-bottom: 20px;
}

.feedback-form input,
.feedback-form textarea {
    width: 100%;
    padding: 15px;
    border: none;
    border-radius: 8px;
    background: #f0f2f5;
    font-family: 'Be Vietnam Pro', sans-serif;
}

.feedback-form .btn-submit-review {
    width: 100%;
    padding: 15px;
    background: #6D8B74;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s;
}

.feedback-form .btn-submit-review:hover {
    background: #5a7d6a;
}
</style>

<script>


// Add to cart for related products
function addRelatedProductToCart(productName, productPrice, productImage) {
    const cartItem = {
        id: 'related_' + Date.now(), // Generate unique ID
        name: productName,
        price: productPrice,
        image: productImage,
        quantity: 1
    };
    
    // Add to cart with animation
    addToCartWithAnimation(cartItem);
    
    // Update cart counter
    updateCartCounter();
    
    // Show success message
    showNotification(`Đã thêm "${productName}" vào giỏ hàng!`, 'success');
}

// Initialize page - Prevent multiple executions
if (window.productPageInitialized) {
    return;
}
window.productPageInitialized = true;

document.addEventListener('DOMContentLoaded', function() {
    // Set first thumbnail as active
    const firstThumbnail = document.querySelector('.thumbnail-item');
    if (firstThumbnail) {
        firstThumbnail.classList.add('active');
    }
    
    // Update main image to match first thumbnail if exists
    const firstThumbnailImg = firstThumbnail?.querySelector('img');
    if (firstThumbnailImg && firstThumbnailImg.src !== document.getElementById('mainProductImage').src) {
        document.getElementById('mainProductImage').src = firstThumbnailImg.src;
    }
    
    // Initialize cart counter
    updateCartCounter();
    
    // Add to cart functionality for related products
    document.querySelectorAll('.related-products-section .btn-add-to-cart-featured').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const productItem = this.closest('.product-item');
            const productName = productItem.querySelector('h3 a').textContent;
            const productPrice = productItem.querySelector('.price').textContent;
            const productImage = productItem.querySelector('.product-image img').src;
            
            addRelatedProductToCart(productName, productPrice, productImage);
        });
    });
    
    // Initialize tab functionality with event listeners
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    console.log('Found tab buttons:', tabButtons.length);
    console.log('Found tab panes:', tabPanes.length);
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            switchTab(targetTab);
        });
    });
});
</script> 