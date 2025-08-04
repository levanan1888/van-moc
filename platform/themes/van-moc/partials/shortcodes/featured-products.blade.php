@php
    $title = $shortcode->title ?? 'SẢN PHẨM NỔI BẬT';
    $limit = $shortcode->limit ?? 8;
    
    // Lấy sản phẩm từ database
    if (class_exists('Botble\Ecommerce\Models\Product')) {
        $products = \Botble\Ecommerce\Models\Product::where('is_featured', 1)
            ->where('status', 'published')
            ->with(['slugable', 'categories', 'tags'])
            ->orderBy('order', 'asc')
            ->limit($limit)
            ->get();
    } elseif (function_exists('get_featured_products')) {
        $products = get_featured_products($limit);
    } else {
        // Fallback data nếu không có plugin ecommerce
        $products = collect([
            (object)[
                'name' => 'Nước dưỡng tóc tinh dầu bưởi 140ml',
                'description' => 'GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC',
                'price' => '179.660₫',
                'original_price' => null,
                'image' => null,
                'url' => '#',
                'sale_percentage' => null
            ],
            (object)[
                'name' => 'Nước dưỡng tóc tinh dầu bưởi 140ml',
                'description' => 'GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC',
                'price' => '279.660₫',
                'original_price' => null,
                'image' => null,
                'url' => '#',
                'sale_percentage' => null
            ],
            (object)[
                'name' => 'Nước dưỡng tóc tinh dầu bưởi 140ml',
                'description' => 'GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC',
                'price' => '279.660₫',
                'original_price' => null,
                'image' => null,
                'url' => '#',
                'sale_percentage' => null
            ],
            (object)[
                'name' => 'Nước dưỡng tóc tinh dầu bưởi 140ml',
                'description' => 'GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC',
                'price' => '279.660₫',
                'original_price' => null,
                'image' => null,
                'url' => '#',
                'sale_percentage' => '10% OFF'
            ],
            (object)[
                'name' => 'Dầu gội kích thích mọc tóc thảo dược',
                'description' => 'GIẢM GÃY RỤNG - KÍCH THÍCH MỌ...',
                'price' => '162.000₫',
                'original_price' => '279.660₫',
                'image' => null,
                'url' => '#',
                'sale_percentage' => 'Giảm 40%'
            ],
            (object)[
                'name' => 'Sữa hạt cao cấp Forganic',
                'description' => 'DA DƯỠNG CHẤT - TĂNG ĐỀ KHÁNG',
                'price' => '683.000₫',
                'original_price' => null,
                'image' => null,
                'url' => '#',
                'sale_percentage' => null
            ],
            (object)[
                'name' => 'Tắm & gội trẻ em Mộc Hương tinh dầu',
                'description' => 'AN TOÀN CHO BÉ - DỊU NHẸ',
                'price' => '162.000₫',
                'original_price' => '279.660₫',
                'image' => null,
                'url' => '#',
                'sale_percentage' => 'Giảm 40%'
            ],
            (object)[
                'name' => 'Sữa tắm tinh dầu thảo dược Mộc Hương',
                'description' => 'THƯ GIÃN - LÀM SẠCH DA',
                'price' => '284.000₫',
                'original_price' => null,
                'image' => null,
                'url' => '#',
                'sale_percentage' => null
            ]
        ]);
    }
@endphp

<section class="featured-products" id="san-pham-noi-bat">
    <div class="container">
        <div class="section-header">
            <div class="title-wrapper">
                <h2>{{ $title }}</h2>
            </div>
            <div class="subtitle-wrapper">
                <a href="#" class="view-all">Xem tất cả sản phẩm <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/button_arrow.svg') }}" alt="arrow"></a>
            </div>
        </div>
        
        @if ($products->count())
            <div class="product-grid">
                @foreach ($products as $product)
                    <div class="product-item"
                        @if(isset($product->id))
                            data-id="{{ $product->id }}"
                            data-name="{{ e($product->name) }}"
                            data-price="{{ is_numeric($product->price) ? $product->price : preg_replace('/[^0-9]/', '', $product->price) }}"
                            data-image="{{ RvMedia::getImageUrl($product->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                        @endif
                    >
                        <div class="product-image">
                            <a href="{{ $product->url }}">
                                @if ($product->image)
                                <img src="{{ RvMedia::getImageUrl($product->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                            @else
                                    <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property11.png') }}" alt="{{ $product->name }}">
                            @endif
                            </a>
                            @if (isset($product->sale_percentage) && $product->sale_percentage)
                                <div class="sale-badge">{{ $product->sale_percentage }}</div>
                            @elseif (method_exists($product, 'getSalePercentage') && $product->getSalePercentage() > 0)
                                <div class="sale-badge">Giảm {{ $product->getSalePercentage() }}%</div>
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-text">
                                <h3><a href="{{ $product->url }}">{{ $product->name }}</a></h3>
                                <p class="product-brand">{{ Str::limit(strip_tags($product->description ?? $product->short_description ?? ''), 100) }}</p>
                                <div class="price-wrapper">
                                    @if (isset($product->original_price) && $product->original_price && $product->original_price > $product->price)
                                        <span class="original-price">
                                            @if(is_numeric($product->original_price))
                                                {{ number_format($product->original_price, 0, ',', '.') }}₫
                                            @else
                                                {{ $product->original_price }}
                                            @endif
                                        </span>
                                    @endif
                                    <span class="price">
                                        @if(is_numeric($product->price))
                                            {{ number_format($product->price, 0, ',', '.') }}₫
                                        @else
                                            {{ $product->price }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="add-to-cart">
                                <button type="button" class="btn-add-to-cart-featured" title="Thêm vào giỏ hàng" @if(!isset($product->id)) disabled @endif>
                                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_cart.svg') }}" alt="Add to cart">
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-products">
                <p>Chưa có sản phẩm nổi bật nào.</p>
            </div>
        @endif
    </div>
</section> 

<style>
/* Featured Products Section */
.featured-products {
    padding: 60px 0;
    background-color: #F9F9F9;
}

.section-header {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-bottom: 30px;
    text-align: center;
}

.title-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-bottom: 10px;
}

.section-header h2 {
    font-family: 'Prata', serif;
    font-size: 28px;
    text-align: center;
    position: relative;
    margin: 0;
    padding-bottom: 10px;
    color: #244317;
}

.section-header h2:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 2px;
    background-color: #4A7D4A;
}

.subtitle-wrapper {
    margin-top: 5px;
}

.view-all {
    display: flex;
    align-items: center;
    gap: 5px;
    font-weight: 500;
    font-size: 14px;
    color: #666;
}

.view-all img {
    width: 16px;
    height: 16px;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin: 0 auto;
}

.product-item {
    background-color: #FFFFFF;
    border: 1px solid #EAEAEA;
    border-radius: 5px;
    overflow: hidden;
    transition: box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.product-item:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.product-image {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 0 10px;
    background-color: #FFFFFF;
}

.product-image img {
    object-fit: contain;
    display: block;
    transition: transform 0.3s ease;
}

.product-image a:hover img {
    transform: scale(1.05);
}

.sale-badge {
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

.product-info {
    padding: 12px;
    position: relative;
    text-align: left;
    flex-grow: 1;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f9f9f9;
    min-height: 100px;
    gap: 10px;
}

.product-text {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    min-width: 0;
}

.product-item h3 {
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 10px;
    line-height: 1.6;
}

.product-item h3 a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.product-item h3 a:hover {
    color: #28a745;
}

.product-brand {
    font-size: 10px;
    color: #777;
    text-transform: uppercase;
    margin-bottom: 8px;
    line-height: 1.2;
}

.price-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 5px;
}

.product-item .price {
    font-size: 15px;
    font-weight: 600;
    color: #4A7D4A;
}

.product-item .original-price {
    font-size: 13px;
    color: #999;
    text-decoration: line-through;
}

/* Cart icon styling */
.add-to-cart {
    flex-shrink: 0;
}

.add-to-cart .btn-add-to-cart-featured {
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

.add-to-cart .btn-add-to-cart-featured img {
    width: 24px;
    height: 24px;
}

.no-products {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

/* Toast Notification */
#toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.toast-notification {
    background-color: #28a745;
    color: white;
    padding: 15px 25px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    opacity: 0;
    transform: translateX(100%);
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    font-size: 16px;
}

.toast-notification.show {
    opacity: 1;
    transform: translateX(0);
}

/* Responsive */
@media (max-width: 1200px) {
    .product-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .product-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Toast Notification --- //
    function showToast(message) {
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            document.body.appendChild(toastContainer);
        }

        const toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.textContent = message;
        
        toastContainer.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('show');
        }, 100);

        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 500);
        }, 3000);
    }

    // --- Cart Counter Update --- //
    function updateCartCounter() {
        const cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        
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

    // --- Add to Cart Functionality with Animation --- //
    document.querySelectorAll('.btn-add-to-cart-featured').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Ngăn sự kiện click lan ra product-item

            const productItem = this.closest('.product-item');
            const productId = productItem.dataset.id;
            const productName = productItem.dataset.name;
            const productPrice = productItem.dataset.price;
            const productImage = productItem.dataset.image;
            const quantity = 1; // Mặc định thêm 1 sản phẩm từ danh sách

            if (!productId) {
                console.error('Product ID not found for item:', productItem);
                return;
            }

            // Create cart item object
            const cartItem = {
                id: productId,
                name: productName,
                price: productPrice,
                image: productImage,
                quantity: quantity
            };

            // Add to cart with animation
            addToCartWithAnimation(cartItem, productItem);
            
            // Update cart counter
            updateCartCounter();
            
            // Show success message
            showNotification(`Đã thêm ${quantity} sản phẩm vào giỏ hàng!`, 'success');
        });
    });

    // Cart animation function
    function addToCartWithAnimation(cartItem, productItem) {
        // Get the product image for animation
        const productImg = productItem.querySelector('.product-image img');
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

    // --- Product Item Click to Detail Page --- //
    document.querySelectorAll('.product-item').forEach(item => {
        item.addEventListener('click', function(e) {
            // Chỉ chuyển hướng nếu không click vào nút thêm giỏ hàng
            if (!e.target.closest('.add-to-cart')) {
                const productLink = this.querySelector('a');
                if (productLink && productLink.href) {
                    window.location.href = productLink.href;
                }
            }
        });
    });

    // Initial cart counter update on page load
    updateCartCounter();
});
</script>