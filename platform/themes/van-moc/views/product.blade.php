@php Theme::layout('default'); Theme::set('section-name', $product->name); if ($product->categories->count()) { Theme::set('breadcrumb_category', $product->categories->first()->name); Theme::set('breadcrumb_category_url', $product->categories->first()->url); } @endphp


    <div class="container">
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
                <button class="tab-btn active" onclick="showTab('description')">Mô tả</button>
                <button class="tab-btn" onclick="showTab('ingredients')">Thành phần</button>
                <button class="tab-btn" onclick="showTab('usage')">Cách dùng</button>
            </div>
            
            <div class="tab-content">
                <div id="description" class="tab-pane active">
                    <div class="product-full-description">
                        <h3>Thành phần chiết xuất 100% từ thiên nhiên</h3>
                        <p>Sản phẩm của chúng tôi tự hào với công thức độc đáo, kết hợp các thành phần tinh túy từ thiên nhiên, được lựa chọn kỹ lưỡng để mang lại hiệu quả tối ưu và an toàn cho làn da của bạn. Mỗi thành phần đều có một vai trò quan trọng trong việc nuôi dưỡng và bảo vệ da.</p>
                        <ul>
                            <li><strong>Lá trầu không:</strong> Nổi tiếng với khả năng kháng khuẩn tự nhiên, giúp ức chế và ngăn chặn sự phát triển của vi khuẩn gây viêm, giữ cho vùng da nhạy cảm luôn sạch sẽ và khỏe mạnh.</li>
                            <li><strong>Lactic acid:</strong> Là một AHA nhẹ nhàng, giúp duy trì độ pH cân bằng, bảo vệ lớp màng axit tự nhiên của da và ngăn ngừa các vấn đề về da.</li>
                            <li><strong>Lô hội:</strong> Cung cấp độ ẩm sâu, làm dịu da tức thì, giúp vùng kín luôn mịn màng, hồng hào và đầy sức sống.</li>
                            <li><strong>Chiết xuất cúc la mã:</strong> Với đặc tính chống viêm và làm dịu da, cúc la mã giúp giảm ngứa, ngăn ngừa mụn và các dấu hiệu kích ứng.</li>
                            <li><strong>Chiết xuất nhụy hoa nghệ tây:</strong> Một thành phần quý giá giúp làm dịu, tăng cường sức đề kháng cho vùng da nhạy cảm, mang lại cảm giác thoải mái suốt cả ngày.</li>
                        </ul>
                        
                        <h3>Cam kết chất lượng</h3>
                        <p>Chúng tôi cam kết sản phẩm không chứa cồn, paraben, sulfate hay dầu khoáng, đảm bảo an toàn tuyệt đối cho cả những làn da nhạy cảm nhất.</p>
                    </div>
                </div>
                
                <div id="ingredients" class="tab-pane">
                    <div class="product-ingredients">
                        <h3>Thành phần chi tiết:</h3>
                        <p>Sản phẩm là sự kết hợp hoàn hảo giữa các thành phần thiên nhiên và khoa học, mang lại giải pháp chăm sóc da toàn diện.</p>
                        <ul>
                            <li><strong>Tinh dầu bưởi tự nhiên (Citrus Grandis Peel Oil):</strong> Giàu chất chống oxy hóa, giúp làm sáng da, mờ thâm và mang lại hương thơm tươi mát, thư giãn.</li>
                            <li><strong>Vitamin E (Tocopherol):</strong> Một chất chống oxy hóa mạnh mẽ, giúp bảo vệ da khỏi các gốc tự do, dưỡng ẩm sâu và làm chậm quá trình lão hóa.</li>
                            <li><strong>Dầu dừa nguyên chất (Cocos Nucifera Oil):</strong> Cung cấp độ ẩm cần thiết, giúp da mềm mại, mịn màng và tăng cường hàng rào bảo vệ da.</li>
                            <li><strong>Chiết xuất từ thảo dược (Herbal Extracts):</strong> Bao gồm các loại thảo dược quý, có tác dụng kháng khuẩn, làm dịu da và giảm kích ứng.</li>
                            <li><strong>Nước tinh khiết (Aqua):</strong> Là dung môi an toàn, giúp hòa tan các thành phần và mang lại cảm giác mát lạnh, sảng khoái khi sử dụng.</li>
                        </ul>
                        
                        <div class="ingredient-note">
                            <p><strong>Lưu ý:</strong> Sản phẩm đã được kiểm nghiệm da liễu, không chứa paraben, sulfate, cồn hay các hóa chất độc hại khác, phù hợp với mọi loại da.</p>
                        </div>
                    </div>
                </div>
                
                <div id="usage" class="tab-pane">
                    <div class="product-usage">
                        <h3>Hướng dẫn sử dụng chi tiết để đạt hiệu quả tốt nhất:</h3>
                        
                        <div class="usage-step">
                            <h4>Bước 1: Làm sạch da</h4>
                            <p>Luôn bắt đầu với một làn da sạch. Sử dụng sữa rửa mặt dịu nhẹ phù hợp với loại da của bạn để loại bỏ bụi bẩn và dầu thừa. Dùng khăn mềm thấm khô da nhẹ nhàng.</p>
                        </div>
                        
                        <div class="usage-step">
                            <h4>Bước 2: Thoa sản phẩm</h4>
                            <p>Lấy một lượng sản phẩm vừa đủ, khoảng 2-3 giọt hoặc một lượng bằng hạt đậu, ra lòng bàn tay. Xoa nhẹ hai tay để làm ấm sản phẩm trước khi thoa đều lên mặt và cổ.</p>
                        </div>
                        
                        <div class="usage-step">
                            <h4>Bước 3: Massage nhẹ nhàng</h4>
                            <p>Dùng các đầu ngón tay massage nhẹ nhàng theo chuyển động tròn, từ trong ra ngoài và từ dưới lên trên. Việc này giúp sản phẩm thẩm thấu sâu hơn và kích thích tuần hoàn máu.</p>
                        </div>
                        
                        <div class="usage-step">
                            <h4>Bước 4: Vỗ nhẹ và để yên</h4>
                            <p>Sau khi massage, vỗ nhẹ lên da để sản phẩm thẩm thấu hoàn toàn. Chờ khoảng 5-10 phút trước khi tiếp tục các bước chăm sóc da tiếp theo như thoa kem dưỡng ẩm hoặc kem chống nắng.</p>
                        </div>
                        
                        <div class="usage-tips">
                            <h4>Mẹo sử dụng hiệu quả:</h4>
                            <ul>
                                <li><strong>Sử dụng đều đặn:</strong> Để có kết quả tốt nhất, hãy sử dụng sản phẩm 2 lần mỗi ngày, vào buổi sáng và buổi tối.</li>
                                <li><strong>Thứ tự sử dụng:</strong> Áp dụng sản phẩm sau bước toner và trước bước kem dưỡng ẩm.</li>
                                <li><strong>Bảo quản đúng cách:</strong> Giữ sản phẩm ở nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp để bảo toàn chất lượng.</li>
                                <li><strong>Kiểm tra phản ứng da:</strong> Nếu bạn có làn da nhạy cảm, hãy thử sản phẩm trên một vùng da nhỏ trước khi sử dụng cho toàn bộ khuôn mặt.</li>
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
                    <h2 class="section-title">REVIEW {{ strtoupper($product->name) }}</h2>
                    <p class="reviews-count">{{ $product->reviews_count }} đánh giá sản phẩm này</p>
                </div>
                <a href="#" class="view-all-reviews">Xem tất cả <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/button_arrow.svg') }}" alt="Arrow"></a>
            </div>
            <div class="customer-reviews-grid">
                @if ($product->reviews && $product->reviews->count() > 0)
                    @foreach ($product->reviews as $review)
                        <div class="review-item">
                            <div class="review-author">
                                <div class="review-avatar">
                                    <img src="{{ $review->user->avatar_url ? RvMedia::getImageUrl($review->user->avatar_url, 'thumb') : Theme::asset()->url('images/default-avatar.jpg') }}" alt="{{ $review->user_name }}">
                                </div>
                                <div class="author-info">
                                    <div class="author-name">{{ $review->user_name }}</div>
                                    <div class="purchase-info">Đã mua 29 sản phẩm</div>
                                </div>
                            </div>
                            <div class="review-comment">
                                <p>{{ $review->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        
        <!-- Related Products Section -->
        <div class="related-products-section">
            <div class="section-header">
                <h2 class="section-title">Sản phẩm liên quan</h2>
                <a href="#" class="view-all-link">Xem tất cả <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/button_arrow.svg') }}" alt="Arrow"></a>
            </div>
            
            <div class="related-products-grid">
                @php
                    $relatedProducts = get_related_products($product->id, 4);
                    if (count($relatedProducts) == 0) {
                        $relatedProducts = get_latest_products(4, [
                            'author',
                            'categories',
                            'slugable',
                        ]);
                    }
                @endphp
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="product-card">
                        <a href="{{ $relatedProduct->url }}">
                            <img src="{{ RvMedia::getImageUrl($relatedProduct->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $relatedProduct->name }}" class="product-card-image">
                        </a>
                        <div class="product-card-info">
                            <h4 class="product-card-name"><a href="{{ $relatedProduct->url }}">{{ $relatedProduct->name }}</a></h4>
                            <div class="product-card-price">{{ number_format($relatedProduct->price, 0, ',', '.') }} ₫</div>
                            <div class="product-card-rating">
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star">★</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Customer Feedback Form -->
        <div class="feedback-section">
            <div class="commitments-grid">
                <div class="commitment-item full-width">
                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_camket.svg') }}" alt="Genuine Commitment">
                    <span>Cam kết chính hãng</span>
                </div>
                <div class="commitment-item">
                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_giaohang.svg') }}" alt="Nationwide Delivery">
                    <span>Giao hàng toàn quốc</span>
                </div>
                <div class="commitment-item">
                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_hotro.svg') }}" alt="24/7 Support">
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

/* 🧭 1. Điều hướng (Breadcrumbs) */


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
    align-items: flex-start; /* Align items to the left */
    background-color: #fff; /* Set background to white */
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
}

.tab-btn.active {
    background: #28a745;
    color: white;
}

.tab-pane {
    display: none;
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
    font-size: 22px; /* Adjusted font size */
    font-weight: 600;
    margin: 0;
    color: #333;
}

.reviews-count {
    color: #6c757d;
    margin-top: 5px;
}

.view-all-reviews {
    color: #333;
    text-decoration: none;
    font-weight: 500;
    display: flex;
    align-items: center;
}

.view-all-reviews img {
    margin-left: 8px;
}

.review-item {
    background: #FFFFFF;
    border: 1px solid #EAEAEA;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); /* Subtle shadow */
}

.review-author {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.review-avatar img {
    width: 50px; /* Adjusted size */
    height: 50px;
    border-radius: 50%;
    margin-right: 15px;
}

.author-name {
    font-weight: 600;
    font-size: 16px;
}

.purchase-info {
    font-size: 14px;
    color: #6c757d;
}

.review-comment {
    color: #555;
    line-height: 1.7;
    font-size: 14px;
}

/* Related Products Section */
.related-products-section {
    margin-top: 60px;
    background-color: #FFFFFF; /* Ensure white background */
    padding: 40px 0; /* Add padding for consistency */
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
    padding-left: calc(50vw - 50%);
    padding-right: calc(50vw - 50%);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.section-title {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin: 0;
}

.view-all-link {
    color: #28a745;
    text-decoration: none;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 14px;
}

.view-all-link img {
    width: 16px;
    height: 16px;
}

.related-products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}

.product-card {
    background: white;
    border: 1px solid #eee;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    cursor: pointer;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border-color: #28a745;
}

.product-card .product-image {
    aspect-ratio: 1;
    overflow: hidden;
    background: #f8f9fa;
}

.product-card .product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-card .product-info {
    padding: 20px;
}

.product-card .product-name {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0 0 10px 0;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-card .product-price {
    font-size: 18px;
    font-weight: 700;
    color: #28a745;
    margin-bottom: 8px;
}

.product-card .product-rating {
    display: flex;
    gap: 2px;
}

.product-card .product-rating .star {
    color: #ffc107;
    font-size: 14px;
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

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Set first thumbnail as active
    const firstThumbnail = document.querySelector('.thumbnail-item');
    if (firstThumbnail) {
        firstThumbnail.classList.add('active');
    }
    
    // Initialize cart counter
    updateCartCounter();
});
</script> 