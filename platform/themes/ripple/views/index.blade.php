<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vạn Mộc</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600&family=Prata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="#"><img src="{{ asset('images/c88b292dea22637c3a33.jpg') }}" alt="Vạn Mộc Logo"></a>
            </div>
            <div class="menu-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#">TRANG CHỦ</a></li>
                    <li><a href="#">SẢN PHẨM <img src="{{ asset('images/VMM_ICON/arrow.svg') }}" alt="arrow"></a></li>
                    <li><a href="#">KHUYẾN MÃI</a></li>
                    <li><a href="#">BÀI VIẾT</a></li>
                    <li><a href="#">VỀ CHÚNG TÔI <img src="{{ asset('images/VMM_ICON/arrow.svg') }}" alt="arrow"></a></li>
                </ul>
            </nav>
            <div class="header-icons">
                <a href="#"><img src="{{ asset('images/VMM_ICON/search.png') }}" alt="Search"></a>
                <a href="#"><img src="{{ asset('images/VMM_ICON/cart.svg') }}" alt="Cart"></a>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Bắt đầu hành trình<br>sống lành từ Vạn Mộc</h1>
                <p>Chăm sóc làn da và cơ thể không chỉ là thói quen, mà là hành trình yêu thương bản thân một cách trọn vẹn - bắt đầu từ những điều thuần khiết nhất.</p>
                <a href="#" class="btn">Khám phá sản phẩm</a>
            </div>
        </div>
    </section>

    <section class="featured-products" id="san-pham-noi-bat">
        <div class="container">
            <div class="section-header">
                <div class="title-wrapper">
                    <h2>SẢN PHẨM NỔI BẬT</h2>
                </div>
                <div class="subtitle-wrapper">
                    <a href="#" class="view-all">Xem tất cả sản phẩm <img src="{{ asset('images/VMM_ICON/button_arrow.svg') }}" alt="arrow"></a>
                </div>
            </div>
            <div class="product-grid">
                <div class="product-item">
                    <div class="product-image">
                        <img src="{{ asset('images/VMM_image/hinh_product/property11.png') }}" alt="Product 1">
                    </div>
                    <div class="product-info">
                        <div class="product-text">
                            <h3>Nước dưỡng tóc tinh dầu bưởi 140ml</h3>
                            <p class="product-brand">GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC</p>
                            <div class="price-wrapper">
                                <span class="price">179.660₫</span>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            <a href="#"><img src="{{ asset('images/VMM_ICON/icon_cart.svg') }}" alt="Add to cart"></a>
                        </div>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image">
                        <img src="{{ asset('images/VMM_image/hinh_product/property12.png') }}" alt="Product 2">
                    </div>
                    <div class="product-info">
                        <div class="product-text">
                            <h3>Nước dưỡng tóc tinh dầu bưởi 140ml</h3>
                            <p class="product-brand">GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC</p>
                            <div class="price-wrapper">
                                <span class="price">279.660₫</span>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            <a href="#"><img src="{{ asset('images/VMM_ICON/icon_cart.svg') }}" alt="Add to cart"></a>
                        </div>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image">
                        <img src="{{ asset('images/VMM_image/hinh_product/property13.png') }}" alt="Product 3">
                    </div>
                    <div class="product-info">
                        <div class="product-text">
                            <h3>Nước dưỡng tóc tinh dầu bưởi 140ml</h3>
                            <p class="product-brand">GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC</p>
                            <div class="price-wrapper">
                                <span class="price">279.660₫</span>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            <a href="#"><img src="{{ asset('images/VMM_ICON/icon_cart.svg') }}" alt="Add to cart"></a>
                        </div>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image">
                        <img src="{{ asset('images/VMM_image/hinh_product/property14.png') }}" alt="Product 4">
                        <div class="sale-badge">10% OFF</div>
                    </div>
                    <div class="product-info">
                        <div class="product-text">
                            <h3>Nước dưỡng tóc tinh dầu bưởi 140ml</h3>
                            <p class="product-brand">GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC</p>
                            <div class="price-wrapper">
                                <span class="price">279.660₫</span>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            <a href="#"><img src="{{ asset('images/VMM_ICON/icon_cart.svg') }}" alt="Add to cart"></a>
                        </div>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image">
                        <img src="{{ asset('images/VMM_image/hinh_product/property15.png') }}" alt="Product 5">
                        <div class="sale-badge">Giảm 40%</div>
                    </div>
                    <div class="product-info">
                        <div class="product-text">
                            <h3>Dầu gội kích thích mọc tóc thảo dược</h3>
                            <p class="product-brand">GIẢM GÃY RỤNG - KÍCH THÍCH MỌ...</p>
                            <div class="price-wrapper">
                                <span class="original-price">279.660₫</span>
                                <span class="price">162.000₫</span>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            <a href="#"><img src="{{ asset('images/VMM_ICON/icon_cart.svg') }}" alt="Add to cart"></a>
                        </div>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image">
                        <img src="{{ asset('images/VMM_image/hinh_product/property16.png') }}" alt="Product 6">
                    </div>
                    <div class="product-info">
                        <div class="product-text">
                            <h3>Sữa hạt cao cấp Forganic</h3>
                            <p class="product-brand">DA DƯỠNG CHẤT - TĂNG ĐỀ KHÁNG</p>
                             <div class="price-wrapper">
                                <span class="price">683.000₫</span>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            <a href="#"><img src="{{ asset('images/VMM_ICON/icon_cart.svg') }}" alt="Add to cart"></a>
                        </div>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image">
                        <img src="{{ asset('images/VMM_image/hinh_product/property17.png') }}" alt="Product 7">
                        <div class="sale-badge">Giảm 40%</div>
                    </div>
                    <div class="product-info">
                        <div class="product-text">
                            <h3>Tắm & gội trẻ em Mộc Hương tinh dầu</h3>
                            <p class="product-brand">AN TOÀN CHO BÉ - DỊU NHẸ</p>
                            <div class="price-wrapper">
                                <span class="original-price">279.660₫</span>
                                <span class="price">162.000₫</span>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            <a href="#"><img src="{{ asset('images/VMM_ICON/icon_cart.svg') }}" alt="Add to cart"></a>
                        </div>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image">
                        <img src="{{ asset('images/VMM_image/hinh_product/property18.png') }}" alt="Product 8">
                    </div>
                    <div class="product-info">
                        <div class="product-text">
                            <h3>Sữa tắm tinh dầu thảo dược Mộc Hương</h3>
                            <p class="product-brand">THƯ GIÃN - LÀM SẠCH DA</p>
                            <div class="price-wrapper">
                                <span class="price">284.000₫</span>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            <a href="#"><img src="{{ asset('images/VMM_ICON/icon_cart.svg') }}" alt="Add to cart"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="categories">
        <div class="container">
            <div class="section-header">
                <h2>DANH MỤC SẢN PHẨM</h2>
            </div>
            <div class="category-grid">
                <div class="category-item">
                    <img src="{{ asset('images/category-homepage/srisri.png') }}" alt="Category 1">
                    <div class="category-info">
                        <h3>SRISRI</h3>
                    </div>
                </div>
                <div class="category-item">
                    <img src="{{ asset('images/category-homepage/moc-huong.png') }}" alt="Category 2">
                    <div class="category-info">
                        <h3>MỘC HƯƠNG</h3>
                    </div>
                </div>
                <div class="category-item">
                    <img src="{{ asset('images/category-homepage/brands.png') }}" alt="Category 3">
                    <div class="category-info">
                        <h3>BRANDS'</h3>
                    </div>
                </div>
                <div class="category-item">
                    <img src="{{ asset('images/category-homepage/forganic.png') }}" alt="Category 4">
                     <div class="category-info">
                        <h3>FORGANIC</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="van-moc-mall">
        <div class="container">
            <div class="image-side">
                <img src="{{ asset('images/VMM_image/section_vanmocmall/untitled1recovered1.png') }}" alt="Vạn Mộc Mall">
            </div>
            <div class="text-side">
                <h4>Câu chuyện của chúng tôi</h4>
                <h2>VẠN MỘC MALL</h2>
                <p>Vạn Mộc Mall là nơi quy tụ những con người đam mê chăm sóc làn da và sức khỏe bằng phương pháp tự nhiên. Chúng tôi chọn lọc tinh tuý từ vườn thảo mộc, đặc sản của các địa phương, để đưa ra những sản phẩm an toàn, lành tính, và hiệu quả...</p>
                <p>Mang trong mình sứ mệnh xây dựng thói quen sống khỏe đẹp từ thiên nhiên, Vạn Mộc không chỉ là không gian mua sắm, mà còn là người bạn đồng hành cùng bạn trên hành trình chăm sóc và yêu thương bản thân.</p>
                <a href="#" class="btn">Tìm hiểu thêm</a>
            </div>
        </div>
    </section>

    <section class="philosophy-vision-mission">
        <div class="container">
            <div class="philosophy-box">
                <div class="philosophy-content">
                    <h3>Triết lý của chúng tôi</h3>
                    <p>Khởi nguồn từ những chuyên gia yêu thương làn da, sắc đẹp và sức khỏe con người. Vạn Mộc chọn lọc tinh túy từ vườn thảo mộc thiên nhiên, đem đến những sản phẩm thủ công trị liệu cao cấp nhất cho bạn.</p>
                    <a href="#" class="btn">Tìm hiểu thêm</a>
                </div>
            </div>
            <div class="vision-mission-box">
                <div class="vision-content">
                    <h4>Tầm nhìn</h4>
                    <p>Là công ty phát triển thị trường cho các sản phẩm tiêu dùng THUẦN TỰ NHIÊN chuyên nghiệp nhất tại thị trường Việt Nam.</p>
                </div>
                <div class="mission-content">
                    <h4>Sứ mệnh</h4>
                    <p>Xây dựng cộng đồng sử dụng thảo mộc và chăm sóc sức khỏe, sắc đẹp thuần tự nhiên lờn nhất cả nước.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="sustainability">
        <div class="container">
            <div class="section-header">
                 <h2>PHÁT TRIỂN BỀN VỮNG – TẠO CHUỖI GIÁ TRỊ CHO CỘNG ĐỒNG</h2>
            </div>
            <div class="sustainability-grid">
                <div class="sustainability-item">
                    <div class="icon-wrapper">
                        <img src="{{ asset('images/icon-phat-trien-ben-vung/icon-thuan-tu-nhien.jpg') }}" alt="Icon 1">
                    </div>
                    <h3>Sản phẩm thuần tự nhiên</h3>
                    <p>Từ vườn thảo mộc đến tay bạn, mỗi sản phẩm đều được chọn lọc kỹ lưỡng, không hương liệu tổng hợp.</p>
                </div>
                <div class="sustainability-item">
                    <div class="icon-wrapper">
                        <img src="{{ asset('images/icon-phat-trien-ben-vung/icon-ben-vung.jpg') }}" alt="Icon 2">
                    </div>
                    <h3>Đối tác bền vững</h3>
                    <p>Hợp tác lâu dài với người nông dân, tạo ra sinh kế ổn định và phát triển cộng đồng.</p>
                </div>
                <div class="sustainability-item">
                    <div class="icon-wrapper">
                        <img src="{{ asset('images/icon-phat-trien-ben-vung/icon-lan-toa.jpg') }}" alt="Icon 3">
                    </div>
                    <h3>Lan tỏa lối sống thuận tự nhiên</h3>
                    <p>Khai nguồn cảm hứng sống xanh, qua từng sản phẩm và hoạt động, lan tỏa những giá trị giản dị.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="blog">
        <div class="container">
            <div class="section-header">
                <h2>BLOG LÀM ĐẸP TỰ NHIÊN</h2>
                <div class="view-all-wrapper">
                     <a href="#" class="view-all">Xem tất cả <img src="{{ asset('images/VMM_ICON/button_arrow.svg') }}" alt="arrow"></a>
                </div>
            </div>
            <div class="blog-grid">
                <div class="blog-post">
                    <div class="product-image">
                        <div class="blog-tag">Chăm sóc</div>
                        <img src="{{ asset('images/VMM_image/hinh_blog_2/libary1.png') }}" alt="Blog Post 1">
                    </div>
                    <div class="blog-content">
                        <h3>Chăm sóc da cho anh ấy: Quà tặng chu đáo</h3>
                        <p>Chăm sóc da cho anh ấy: Quà tặng chu đáo. Da nhạy cảm...</p>
                        <div class="post-meta">
                            <span>Bởi Vạn Mộc</span> - <span>12/03/2024</span>
                        </div>
                        <a href="#" class="read-more">ĐỌC NGAY <img src="{{ asset('images/VMM_ICON/button_docngay.svg') }}" alt="arrow"></a>
                    </div>
                </div>
                <div class="blog-post">
                    <div class="product-image">
                        <div class="blog-tag">Làm đẹp</div>
                        <img src="{{ asset('images/VMM_image/hinh_blog_2/libary2.png') }}" alt="Blog Post 2">
                    </div>
                    <div class="blog-content">
                        <h3>Quy trình chăm sóc da tối ưu cho làn da nhạy cảm</h3>
                        <p>Da nhạy cảm không phải là điều tồi tệ. Chăm sóc da...</p>
                         <div class="post-meta">
                            <span>Bởi Vạn Mộc</span> - <span>12/03/2024</span>
                        </div>
                        <a href="#" class="read-more">ĐỌC NGAY <img src="{{ asset('images/VMM_ICON/button_docngay.svg') }}" alt="arrow"></a>
                    </div>
                </div>
                <div class="blog-post">
                    <div class="product-image">
                        <div class="blog-tag">Đời sống</div>
                        <img src="{{ asset('images/VMM_image/hinh_blog_2/libary3.png') }}" alt="Blog Post 3">
                    </div>
                     <div class="blog-content">
                        <h3>Mọi thứ bạn muốn biết về chăm sóc da thời kỳ mãn kinh</h3>
                        <p>Chăm sóc da cho anh ấy: Quà tặng chu đáo...</p>
                         <div class="post-meta">
                           <span>Bởi Vạn Mộc</span> - <span>12/03/2024</span>
                        </div>
                        <a href="#" class="read-more">ĐỌC NGAY <img src="{{ asset('images/VMM_ICON/button_docngay.svg') }}" alt="arrow"></a>
                    </div>
                </div>
                <div class="blog-post">
                    <div class="product-image">
                        <div class="blog-tag">Review</div>
                        <img src="{{ asset('images/VMM_image/hinh_blog_2/libary4.png') }}" alt="Blog Post 4">
                    </div>
                     <div class="blog-content">
                        <h3>Hướng dẫn tối ưu về việc làm sạch lớp</h3>
                        <p>Việc sử dụng sữa rửa mặt đúng cách...</p>
                         <div class="post-meta">
                           <span>Bởi Vạn Mộc</span> - <span>12/03/2024</span>
                        </div>
                        <a href="#" class="read-more">ĐỌC NGAY <img src="{{ asset('images/VMM_ICON/button_docngay.svg') }}" alt="arrow"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="agent-signup">
        <div class="container">
            <div class="agent-info">
                <div class="agent-image">
                    <img src="{{ asset('images/VMM_image/image215.png') }}" alt="Agent Image">
                </div>
                <div class="agent-text">
                    <h2>Trở thành đại lý<br>Vạn Mộc Mall</h2>
                    <ul>
                        <li><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"></path></svg> Chiết khấu hấp dẫn, chính sách đại lý tốt nhất</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"></path></svg> Thưởng ưu đãi lớn, hỗ trợ hoạt động quý, năm</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"></path></svg> Hỗ trợ đầy đủ về marketing và bán hàng</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"></path></svg> Sản phẩm an toàn, uy tín, dễ dàng bán</li>
                    </ul>
                    <p>Theo dõi tại: </p>
                    <div class="social-icons">
                        <a href="#"><img src="{{ asset('images/VMM_ICON/socialicon1.svg') }}" alt="Facebook"></a>
                        <a href="#"><img src="{{ asset('images/VMM_ICON/socialicon2.svg') }}" alt="LinkedIn"></a>
                        <a href="#"><img src="{{ asset('images/VMM_ICON/socialicon3.svg') }}" alt="Twitter"></a>
                        <a href="#"><img src="{{ asset('images/VMM_ICON/socialicon4.svg') }}" alt="Pinterest"></a>
                    </div>
                </div>
            </div>
            <div class="signup-form">
                <h3>Để lại thông tin</h3>
                <form>
                    <input type="text" placeholder="Họ và tên">
                    <input type="email" placeholder="Nhập địa chỉ email">
                    <input type="tel" placeholder="Nhập số điện thoại">
                    <textarea placeholder="Nội dung bạn muốn tư vấn"></textarea>
                    <button type="submit" class="btn">Gửi yêu cầu</button>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-col">
                <h4>VỀ CHÚNG TÔI</h4>
                <ul>
                    <li><a href="#">Giới thiệu</a></li>
                    <li><a href="#">Download Catalogue</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>BẠN NÊN BIẾT</h4>
                <ul>
                    <li><a href="#">Hướng dẫn mua hàng</a></li>
                    <li><a href="#">Chính sách đổi trả</a></li>
                    <li><a href="#">Bảo mật thông tin</a></li>
                    <li><a href="#">Câu hỏi thường gặp</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <img src="{{ asset('images/c88b292dea22637c3a33.jpg') }}" alt="Vạn Mộc Logo" class="footer-logo">
                <div class="social-icons">
                    <a href="#"><img src="{{ asset('images/VMM_ICON/socialicon1.svg') }}" alt="Social 1"></a>
                    <a href="#"><img src="{{ asset('images/VMM_ICON/socialicon2.svg') }}" alt="Social 2"></a>
                    <a href="#"><img src="{{ asset('images/VMM_ICON/socialicon3.svg') }}" alt="Social 3"></a>
                    <a href="#"><img src="{{ asset('images/VMM_ICON/socialicon4.svg') }}" alt="Social 4"></a>
                </div>
            </div>
            <div class="footer-col">
                <h4>ĐỊA CHỈ</h4>
                <p class="address"><img src="{{ asset('images/VMM_ICON/local_icon.svg') }}" alt="Location"> 860/60N/8 Xô Viết Nghệ Tĩnh, phường Bình Thạnh, Tp.Hồ Chí Minh</p>
                <h4>LIÊN HỆ</h4>
                <p><img src="{{ asset('images/VMM_ICON/email_icon.svg') }}" alt="Email"> vanmocmall@gmail.com</p>
                <p><img src="{{ asset('images/VMM_ICON/call_icon.svg') }}" alt="Phone"> 081 611 1123</p>
            </div>
        </div>
        <img src="{{ asset('images/VMM_ICON/decorate_icon.png') }}" class="footer-decor-left-img" alt="Footer Decoration">
        <img src="{{ asset('images/VMM_ICON/decorate_icon2.png') }}" class="footer-decor-right-img" alt="Footer Decoration">
        <div class="copyright">
            <p>Copyright © Vạn Mộc Mall all right reserved</p>
        </div>
    </footer>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
