@php Theme::layout('default'); @endphp

<div class="product-detail-page">
    <div class="container">
        <!-- 🧭 1. Điều hướng (Breadcrumbs) -->
        <div class="breadcrumb-wrapper">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('public.index') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('public.products') }}">Chăm sóc da</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>

        <!-- 🖼️ 2. Bố cục hiển thị - Layout 2 cột -->
        <div class="product-main-section">
            <!-- Cột trái - Ảnh sản phẩm -->
            <div class="product-images">
                <div class="main-image">
                    @if ($product->image)
                        <img src="{{ RvMedia::getImageUrl($product->image, 'large', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}" id="mainProductImage">
                    @else
                        <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property11.png') }}" alt="{{ $product->name }}" id="mainProductImage">
                    @endif
                </div>
                
                <div class="thumbnail-images">
                    @if (isset($product->images) && is_object($product->images) && method_exists($product->images, 'count') && $product->images->count() > 0)
                        @foreach ($product->images->take(3) as $image)
                            <div class="thumbnail-item">
                                <img src="{{ RvMedia::getImageUrl($image->image, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}" onclick="changeMainImage(this.src)">
                            </div>
                        @endforeach
                    @else
                        <div class="thumbnail-item">
                            <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property11.png') }}" alt="{{ $product->name }}" onclick="changeMainImage(this.src)">
                        </div>
                        <div class="thumbnail-item">
                            <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property12.png') }}" alt="{{ $product->name }}" onclick="changeMainImage(this.src)">
                        </div>
                        <div class="thumbnail-item">
                            <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property13.png') }}" alt="{{ $product->name }}" onclick="changeMainImage(this.src)">
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
                    <div class="feature-item">
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
                    <div class="feature-item">
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
                <button class="tab-btn active" onclick="showTab('description')">Mô tả</button>
                <button class="tab-btn" onclick="showTab('ingredients')">Thành phần</button>
                <button class="tab-btn" onclick="showTab('usage')">Cách dùng</button>
            </div>
            
            <div class="tab-content">
                <div id="description" class="tab-pane active">
                    <div class="product-full-description">
                        <h3>Thành phần chiết xuất 100% từ thiên nhiên</h3>
                        <ul>
                            <li><strong>Lá trầu không:</strong> ức chế và ngăn chặn sự phát triển của vi khuẩn gây viêm vùng kín.</li>
                            <li><strong>Lactic acid:</strong> duy trì độ pH an toàn cho vùng nhạy cảm.</li>
                            <li><strong>Lô hội:</strong> giúp dưỡng ẩm vùng kín mịn màng và hồng hào.</li>
                            <li><strong>Chiết xuất cúc la mã:</strong> làm dịu da, ngăn ngừa mụn, giảm viêm, giảm ngứa.</li>
                            <li><strong>Chiết xuất nhụy hoa nghệ tây:</strong> làm dịu da, tăng độ kháng cho vùng da nhạy cảm.</li>
                        </ul>
                        
                        <h3>Hướng dẫn sử dụng</h3>
                        <ol>
                            <li>Bước 1: Làm ướt mặt.</li>
                            <li>Bước 2: Lấy một lượng nhỏ vừa đủ dung dịch.</li>
                            <li>Bước 3: Thoa đều khắp mặt.</li>
                            <li>Bước 4: Sau 30 phút rửa sạch lại.</li>
                        </ol>
                    </div>
                </div>
                
                <div id="ingredients" class="tab-pane">
                    <div class="product-ingredients">
                        <h3>Thành phần chi tiết:</h3>
                        <ul>
                            <li><strong>Tinh dầu bưởi tự nhiên:</strong> Làm sáng da, chống oxy hóa</li>
                            <li><strong>Vitamin E:</strong> Dưỡng ẩm, chống lão hóa</li>
                            <li><strong>Dầu dừa nguyên chất:</strong> Dưỡng ẩm sâu</li>
                            <li><strong>Chiết xuất từ thảo dược:</strong> Kháng khuẩn, làm dịu da</li>
                            <li><strong>Nước tinh khiết:</strong> Làm mát, cân bằng độ ẩm</li>
                        </ul>
                        
                        <div class="ingredient-note">
                            <p><strong>Lưu ý:</strong> Sản phẩm không chứa paraben, sulfate, cồn hay các hóa chất độc hại khác.</p>
                        </div>
                    </div>
                </div>
                
                <div id="usage" class="tab-pane">
                    <div class="product-usage">
                        <h3>Hướng dẫn sử dụng chi tiết:</h3>
                        
                        <div class="usage-step">
                            <h4>Bước 1: Làm sạch da</h4>
                            <p>Rửa mặt bằng sữa rửa mặt dịu nhẹ và lau khô bằng khăn mềm.</p>
                        </div>
                        
                        <div class="usage-step">
                            <h4>Bước 2: Thoa sản phẩm</h4>
                            <p>Lấy một lượng vừa đủ (khoảng 2-3 giọt) thoa đều lên toàn bộ khuôn mặt.</p>
                        </div>
                        
                        <div class="usage-step">
                            <h4>Bước 3: Massage</h4>
                            <p>Massage nhẹ nhàng theo chiều từ trong ra ngoài trong 2-3 phút.</p>
                        </div>
                        
                        <div class="usage-step">
                            <h4>Bước 4: Để yên</h4>
                            <p>Để sản phẩm thấm vào da trong 5-10 phút trước khi thoa kem dưỡng ẩm.</p>
                        </div>
                        
                        <div class="usage-tips">
                            <h4>Mẹo sử dụng:</h4>
                            <ul>
                                <li>Sử dụng 2 lần/ngày (sáng và tối)</li>
                                <li>Tránh tiếp xúc với mắt</li>
                                <li>Bảo quản ở nơi khô ráo, thoáng mát</li>
                                <li>Ngưng sử dụng nếu có dấu hiệu dị ứng</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Reviews Section -->
        <div class="customer-reviews-section">
            <h2 class="section-title">REVIEW {{ strtoupper($product->name) }}</h2>
            <div class="reviews-header">
                <span class="reviews-count">28 đánh giá sản phẩm này</span>
                <a href="#" class="view-all-reviews">Xem tất cả <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/button_arrow.svg') }}" alt="Arrow"></a>
            </div>
            
            <div class="reviews-pagination">
                <span>Trang 1 / 1</span>
                <div class="pagination-controls">
                    <button class="pagination-btn">-</button>
                    <button class="pagination-btn">+</button>
                    <button class="pagination-btn search-btn">
                        <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_noidung.svg') }}" alt="Search">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* 🎨 6. Thiết kế tổng thể - Tông màu trắng và xanh lá */
.product-detail-page {
    padding: 40px 0;
    background: #fff;
    font-family: 'Be Vietnam Pro', sans-serif;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

/* 🧭 1. Điều hướng (Breadcrumbs) */
.breadcrumb-wrapper {
    margin-bottom: 30px;
}

.breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
    display: flex;
    list-style: none;
    gap: 8px;
    align-items: center;
}

.breadcrumb-item {
    font-size: 14px;
    color: #666;
}

.breadcrumb-item a {
    color: #666;
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb-item a:hover {
    color: #28a745;
}

.breadcrumb-item.active {
    color: #333;
    font-weight: 500;
}

.breadcrumb-item:not(:last-child)::after {
    content: ">";
    margin-left: 8px;
    color: #ccc;
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
}

.thumbnail-item {
    width: 80px;
    height: 80px;
    border: 2px solid #eee;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    transition: border-color 0.3s ease;
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

/* 📋 3. Thông tin sản phẩm */
.product-info {
    display: flex;
    flex-direction: column;
    gap: 25px;
    padding-left: 0;
}

.product-title {
    font-size: 28px;
    font-weight: 700;
    color: #333;
    margin: 0;
    line-height: 1.3;
    text-align: left;
    padding-left: 0;
}

/* ⭐ 7. Đánh giá sản phẩm */
.product-rating {
    display: flex;
    align-items: center;
    gap: 10px;
    text-align: left;
    padding-left: 0;
}

.stars {
    display: flex;
    gap: 2px;
}

.star {
    color: #ddd;
    font-size: 18px;
}

.star.filled {
    color: #ffc107;
}

.rating-text {
    color: #666;
    font-size: 14px;
}

/* Giá bán: xanh lá, nổi bật */
.product-price-section {
    margin-bottom: 20px;
    padding-left: 0;
}

.price-current {
    font-size: 32px;
    font-weight: 700;
    color: #28a745;
    padding-left: 0;
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
    flex: 1;
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
    color: #28a745;
    border: 2px solid #28a745;
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
    gap: 15px;
    margin-bottom: 25px;
    padding-left: 0;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 15px;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    background: transparent;
}

.feature-item:nth-child(1),
.feature-item:nth-child(4) {
    background: #f8f9fa;
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
    width: 35px;
    height: 35px;
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
    border-bottom: 2px solid #eee;
    margin-bottom: 30px;
}

.tab-btn {
    padding: 15px 30px;
    border: none;
    background: transparent;
    font-size: 16px;
    font-weight: 500;
    color: #666;
    cursor: pointer;
    transition: all 0.3s ease;
}

.tab-btn.active {
    color: #28a745;
    background: #e8f5e8;
    border-radius: 8px 8px 0 0;
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
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
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
}

.product-full-description li,
.product-ingredients li,
.product-usage li {
    margin-bottom: 10px;
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
    margin-bottom: 60px;
}

.reviews-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.reviews-count {
    color: #666;
    font-size: 16px;
}

.view-all-reviews {
    color: #28a745;
    text-decoration: none;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 5px;
}

.view-all-reviews img {
    width: 16px;
    height: 16px;
}

.reviews-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    margin-top: 30px;
}

.reviews-pagination span {
    color: #666;
    font-size: 14px;
}

.pagination-controls {
    display: flex;
    gap: 10px;
}

.pagination-btn {
    width: 35px;
    height: 35px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.pagination-btn:hover {
    background: #f8f9fa;
    border-color: #28a745;
}

.search-btn img {
    width: 16px;
    height: 16px;
    opacity: 0.7;
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
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
}
</style>

<script>
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

// Tab functionality
function showTab(tabName) {
    // Hide all tab panes
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('active');
    });
    
    // Remove active class from all buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected tab pane
    document.getElementById(tabName).classList.add('active');
    
    // Add active class to clicked button
    event.target.classList.add('active');
}

// Add to cart functionality
function addToCart() {
    const quantity = document.getElementById('quantity').value;
    const productName = document.querySelector('.product-title').textContent;
    
    alert(`Đã thêm ${quantity} sản phẩm "${productName}" vào giỏ hàng!`);
}

// Buy now functionality
function buyNow() {
    const quantity = document.getElementById('quantity').value;
    const productName = document.querySelector('.product-title').textContent;
    
    alert(`Chuyển đến trang thanh toán cho ${quantity} sản phẩm "${productName}"!`);
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Set first thumbnail as active
    const firstThumbnail = document.querySelector('.thumbnail-item');
    if (firstThumbnail) {
        firstThumbnail.classList.add('active');
    }
});
</script> 