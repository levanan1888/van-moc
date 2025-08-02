@php Theme::layout('default'); @endphp

{!! Theme::partial('breadcrumbs') !!}

<section class="product-detail-section">
    <div class="container">
        <div class="product-detail-wrapper">
            <div class="row">
                <!-- Product Images -->
                <div class="col-lg-6">
                    <div class="product-images">
                        <div class="main-image">
                            @if ($product->image)
                                <img src="{{ RvMedia::getImageUrl($product->image, 'large', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}" id="main-product-image">
                            @else
                                <img src="{{ RvMedia::getImageUrl(RvMedia::getDefaultImage(), 'large') }}" alt="{{ $product->name }}" id="main-product-image">
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-info">
                        <div class="product-header">
                            <h1 class="product-title">{{ $product->name }}</h1>
                            @if (isset($product->sku))
                                <p class="product-sku">Mã sản phẩm: {{ $product->sku }}</p>
                            @endif
                        </div>
                        
                        <div class="product-price-section">
                            @if (isset($product->price))
                                <div class="price-current">{{ number_format($product->price, 0, ',', '.') }}₫</div>
                            @else
                                <div class="price-current">Liên hệ</div>
                            @endif
                        </div>
                        
                        <div class="product-description">
                            @if (isset($product->description))
                                <div class="short-description">
                                    {!! clean($product->description) !!}
                                </div>
                            @endif
                        </div>
                        
                        <div class="product-actions">
                            <div class="quantity-selector">
                                <label for="quantity">Số lượng:</label>
                                <div class="quantity-controls">
                                    <button type="button" onclick="decreaseQuantity()">-</button>
                                    <input type="number" id="quantity" value="1" min="1" max="99">
                                    <button type="button" onclick="increaseQuantity()">+</button>
                                </div>
                            </div>
                            
                            <div class="action-buttons">
                                <button class="btn btn-primary add-to-cart-btn" onclick="addToCart({{ $product->id }})">
                                    <i class="fas fa-shopping-cart"></i>
                                    Thêm vào giỏ hàng
                                </button>
                                <button class="btn btn-outline-primary buy-now-btn" onclick="buyNow({{ $product->id }})">
                                    Mua ngay
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-meta">
                            @if (isset($product->categories) && $product->categories->count() > 0)
                                <div class="product-categories">
                                    <span class="meta-label">Danh mục:</span>
                                    @foreach ($product->categories as $category)
                                        <a href="{{ $category->url }}" class="category-link">{{ $category->name }}</a>
                                        @if (!$loop->last), @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product Details Tabs -->
            <div class="product-tabs">
                <div class="tab-navigation">
                    <button class="tab-btn active" onclick="showTab('description')">Mô tả</button>
                    <button class="tab-btn" onclick="showTab('specifications')">Thông số</button>
                </div>
                
                <div class="tab-content">
                    <div id="description" class="tab-pane active">
                        <div class="product-full-description">
                            @if (isset($product->description))
                                {!! clean($product->description) !!}
                            @else
                                <p>Mô tả sản phẩm sẽ được cập nhật sớm.</p>
                            @endif
                        </div>
                    </div>
                    
                    <div id="specifications" class="tab-pane">
                        <div class="product-specifications">
                            <p>Thông tin thông số kỹ thuật sẽ được cập nhật sớm.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.product-detail-section {
    padding: 60px 0;
    background: #f8f9fa;
}

.product-detail-wrapper {
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    overflow: hidden;
}

/* Product Images */
.product-images {
    padding: 30px;
}

.main-image {
    margin-bottom: 20px;
    text-align: center;
}

.main-image img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

/* Product Info */
.product-info {
    padding: 30px;
}

.product-title {
    font-size: 28px;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
}

.product-sku {
    color: #666;
    font-size: 14px;
    margin-bottom: 20px;
}

.product-price-section {
    margin-bottom: 25px;
}

.price-current {
    font-size: 32px;
    font-weight: 700;
    color: #28a745;
}

.product-description {
    margin-bottom: 30px;
}

.short-description {
    color: #666;
    line-height: 1.6;
}

/* Product Actions */
.product-actions {
    margin-bottom: 30px;
}

.quantity-selector {
    margin-bottom: 20px;
}

.quantity-selector label {
    display: block;
    margin-bottom: 10px;
    font-weight: 500;
    color: #333;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.quantity-controls button {
    width: 40px;
    height: 40px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    font-weight: bold;
}

.quantity-controls button:hover {
    background: #f8f9fa;
}

.quantity-controls input {
    width: 60px;
    height: 40px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

.action-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.btn {
    padding: 12px 25px;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background: #28a745;
    color: white;
}

.btn-primary:hover {
    background: #218838;
}

.btn-outline-primary {
    background: white;
    color: #28a745;
    border: 2px solid #28a745;
}

.btn-outline-primary:hover {
    background: #28a745;
    color: white;
}

/* Product Meta */
.product-meta {
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.product-meta > div {
    margin-bottom: 10px;
}

.meta-label {
    font-weight: 500;
    color: #333;
    margin-right: 10px;
}

.category-link {
    color: #28a745;
    text-decoration: none;
}

.category-link:hover {
    text-decoration: underline;
}

/* Product Tabs */
.product-tabs {
    padding: 0 30px 30px;
}

.tab-navigation {
    display: flex;
    border-bottom: 2px solid #eee;
    margin-bottom: 30px;
}

.tab-btn {
    padding: 15px 25px;
    background: none;
    border: none;
    font-size: 16px;
    font-weight: 500;
    color: #666;
    cursor: pointer;
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease;
}

.tab-btn.active {
    color: #28a745;
    border-bottom-color: #28a745;
}

.tab-btn:hover {
    color: #28a745;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

.product-full-description {
    line-height: 1.8;
    color: #333;
}

/* Responsive */
@media (max-width: 991px) {
    .product-images, .product-info {
        padding: 20px;
    }
    
    .product-title {
        font-size: 24px;
    }
    
    .price-current {
        font-size: 28px;
    }
}

@media (max-width: 768px) {
    .product-detail-section {
        padding: 40px 0;
    }
    
    .product-images, .product-info {
        padding: 15px;
    }
    
    .product-title {
        font-size: 20px;
    }
    
    .price-current {
        font-size: 24px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
    
    .tab-navigation {
        flex-wrap: wrap;
    }
    
    .tab-btn {
        padding: 12px 15px;
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .product-images, .product-info {
        padding: 10px;
    }
    
    .product-title {
        font-size: 18px;
    }
    
    .price-current {
        font-size: 20px;
    }
}
</style>

<script>
function decreaseQuantity() {
    const input = document.getElementById('quantity');
    if (input.value > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

function increaseQuantity() {
    const input = document.getElementById('quantity');
    if (input.value < 99) {
        input.value = parseInt(input.value) + 1;
    }
}

function showTab(tabName) {
    // Hide all tab panes
    const tabPanes = document.querySelectorAll('.tab-pane');
    tabPanes.forEach(pane => pane.classList.remove('active'));
    
    // Remove active class from all tab buttons
    const tabBtns = document.querySelectorAll('.tab-btn');
    tabBtns.forEach(btn => btn.classList.remove('active'));
    
    // Show selected tab pane
    document.getElementById(tabName).classList.add('active');
    
    // Add active class to clicked button
    event.target.classList.add('active');
}

function addToCart(productId) {
    const quantity = document.getElementById('quantity').value;
    alert('Đã thêm sản phẩm vào giỏ hàng!');
}

function buyNow(productId) {
    const quantity = document.getElementById('quantity').value;
    alert('Chuyển đến trang thanh toán!');
}
</script> 