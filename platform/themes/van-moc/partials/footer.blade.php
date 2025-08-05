    @if(!empty(theme_option('map_address')))
    <div class="google-map-section">
        {!! do_shortcode('[google-map]'.theme_option('map_address').'[/google-map]') !!}
    </div>
    @endif
    <footer>
        <div class="container">
            <div class="footer-col">
                <h4>VỀ CHÚNG TÔI</h4>
                <ul class="footer-menu">
                    <li><a href="#">Điều khoản</a></li>
                    <li><a href="#">Sản phẩm</a></li>
                    <li><a href="#">Download Catalogue</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>BẠN NÊN BIẾT</h4>
                <ul class="footer-menu">
                    <li><a href="#">Hướng dẫn mua hàng</a></li>
                    <li><a href="#">Thanh toán giao nhận</a></li>
                    <li><a href="#">Chính sách đổi trả</a></li>
                    <li><a href="#">Bảo mật thông tin</a></li>
                    <li><a href="#">Câu hỏi thường gặp</a></li>
                </ul>
            </div>
            <div class="footer-col">
                @if (theme_option('logo'))
                    <img src="{{ RvMedia::getImageUrl(theme_option('logo'), 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ theme_option('site_title', 'Vạn Mộc') }}" class="footer-logo">
                @else
                    <img src="{{ asset('themes/van-moc/images/c88b292dea22637c3a33.jpg') }}" alt="Vạn Mộc Logo" class="footer-logo">
                @endif
                <div class="social-icons">
                    <a href="#" target="_blank"><img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/socialicon1.svg') }}" alt="Facebook"></a>
                    <a href="#" target="_blank"><img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/socialicon2.svg') }}" alt="Instagram"></a>
                    <a href="#" target="_blank"><img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/socialicon3.svg') }}" alt="Twitter"></a>
                    <a href="#" target="_blank"><img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/socialicon4.svg') }}" alt="YouTube"></a>
                </div>
            </div>
            <div class="footer-col">
                <h4>ĐỊA CHỈ</h4>
                <p class="address"><img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/local_icon.svg') }}" alt="Location"> {{ theme_option('contact_address', '860/60N/8 Xô Viết Nghệ Tĩnh, phường Bình Thạnh, Tp.Hồ Chí Minh') }}</p>
                <h4>LIÊN HỆ</h4>
                <p><img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/email_icon.svg') }}" alt="Email"> {{ theme_option('contact_email', 'vanmocmall@gmail.com') }}</p>
                <p><img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/call_icon.svg') }}" alt="Phone"> {{ theme_option('contact_phone', '081 611 1123') }}</p>
            </div>
        </div>
        <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/decorate_icon.png') }}" class="footer-decor-left-img" alt="Footer Decoration">
        <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/decorate_icon2.png') }}" class="footer-decor-right-img" alt="Footer Decoration">
        <div class="copyright">
            <p>Copyright © {{ theme_option('site_title', 'Vạn Mộc Mall') }} all right reserved</p>
        </div>
    </footer>
    
    <div class="social-sticky">
        {!! Theme::partial('social') !!}
    </div>
    
    <div class="social-mobile-sticky">
        {!! Theme::partial('mobile-social') !!}
    </div>
    
    <div id="back2top">
        <i class="fa fa-angle-up"></i>
    </div>
    
    {!! Theme::footer() !!}
    <script src="{{ asset('themes/van-moc/js/script.js') }}"></script>
    
    <script>
    // Mobile menu toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.menu-toggle');
        const mainNav = document.querySelector('.main-nav');
        
        if (menuToggle && mainNav) {
            menuToggle.addEventListener('click', function() {
                mainNav.classList.toggle('active');
                menuToggle.classList.toggle('active');
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!menuToggle.contains(e.target) && !mainNav.contains(e.target)) {
                    mainNav.classList.remove('active');
                    menuToggle.classList.remove('active');
                }
            });
            
            // Handle submenu toggles
            const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children');
            menuItemsWithChildren.forEach(item => {
                const link = item.querySelector('a');
                const submenu = item.querySelector('.sub-menu');
                
                if (link && submenu) {
                    link.addEventListener('click', function(e) {
                        if (window.innerWidth <= 992) {
                            e.preventDefault();
                            item.classList.toggle('active');
                        }
                    });
                }
            });
        }
        
        // Update cart counter on page load
        function updateCartCounter() {
            const cart = JSON.parse(localStorage.getItem('vanmoc_cart') || '[]');
            const totalItems = cart.length; // Đếm số loại sản phẩm khác nhau
            
            const cartCounter = document.querySelector('.cart-counter');
            if (cartCounter) {
                cartCounter.textContent = totalItems;
                cartCounter.style.display = totalItems > 0 ? 'inline' : 'none';
            }
        }
        
        // Update cart counter when page loads
        updateCartCounter();
    });
    </script>
    </body>
</html> 