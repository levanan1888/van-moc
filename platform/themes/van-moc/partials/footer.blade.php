    @if(!empty(theme_option('map_address')))
    <div class="google-map-section">
        {!! do_shortcode('[google-map]'.theme_option('map_address').'[/google-map]') !!}
    </div>
    @endif
    <footer>
        <div class="container">
            <div class="footer-col">
                <h4>VỀ CHÚNG TÔI</h4>
                {!! Menu::renderMenuLocation('footer-menu-1', [
                    'options' => ['class' => 'footer-menu'],
                    'view' => 'footer-menu',
                ]) !!}
            </div>
            <div class="footer-col">
                <h4>BẠN NÊN BIẾT</h4>
                {!! Menu::renderMenuLocation('footer-menu-2', [
                    'options' => ['class' => 'footer-menu'],
                    'view' => 'footer-menu',
                ]) !!}
            </div>
            <div class="footer-col">
                @if (theme_option('logo'))
                    <img src="{{ RvMedia::getImageUrl(theme_option('logo'), 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ theme_option('site_title', 'Vạn Mộc') }}" class="footer-logo">
                @else
                    <img src="{{ asset('themes/van-moc/images/logo.png') }}" alt="Vạn Mộc Logo" class="footer-logo">
                @endif
                <div class="social-icons">
                    @if (theme_option('social_facebook'))
                        <a href="{{ theme_option('social_facebook') }}" target="_blank"><img src="{{ asset('themes/van-moc/images/social/facebook.svg') }}" alt="Facebook"></a>
                    @endif
                    @if (theme_option('social_linkedin'))
                        <a href="{{ theme_option('social_linkedin') }}" target="_blank"><img src="{{ asset('themes/van-moc/images/social/linkedin.svg') }}" alt="LinkedIn"></a>
                    @endif
                    @if (theme_option('social_twitter'))
                        <a href="{{ theme_option('social_twitter') }}" target="_blank"><img src="{{ asset('themes/van-moc/images/social/twitter.svg') }}" alt="Twitter"></a>
                    @endif
                    @if (theme_option('social_pinterest'))
                        <a href="{{ theme_option('social_pinterest') }}" target="_blank"><img src="{{ asset('themes/van-moc/images/social/pinterest.svg') }}" alt="Pinterest"></a>
                    @endif
                </div>
            </div>
            <div class="footer-col">
                <h4>ĐỊA CHỈ</h4>
                <p class="address"><img src="{{ asset('themes/van-moc/images/local_icon.svg') }}" alt="Location"> {{ theme_option('contact_address', '860/60N/8 Xô Viết Nghệ Tĩnh, phường Bình Thạnh, Tp.Hồ Chí Minh') }}</p>
                <h4>LIÊN HỆ</h4>
                <p><img src="{{ asset('themes/van-moc/images/email_icon.svg') }}" alt="Email"> {{ theme_option('contact_email', 'vanmocmall@gmail.com') }}</p>
                <p><img src="{{ asset('themes/van-moc/images/call_icon.svg') }}" alt="Phone"> {{ theme_option('contact_phone', '081 611 1123') }}</p>
            </div>
        </div>
        <img src="{{ asset('themes/van-moc/images/decorate_icon.png') }}" class="footer-decor-left-img" alt="Footer Decoration">
        <img src="{{ asset('themes/van-moc/images/decorate_icon2.png') }}" class="footer-decor-right-img" alt="Footer Decoration">
        <div class="copyright">
            <p>Copyright © {{ theme_option('site_title', 'Vạn Mộc Mall') }} all right reserved</p>
        </div>
    </footer>
    
    {!! Theme::footer() !!}
    <script src="{{ asset('themes/van-moc/js/script.js') }}"></script>
    </body>
</html> 