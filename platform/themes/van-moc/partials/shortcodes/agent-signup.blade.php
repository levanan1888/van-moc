@php
    $title = $shortcode->title ?? 'Trở thành đại lý<br>Vạn Mộc Mall';
    $image = $shortcode->image ?? 'themes/van-moc/images/sections/agent.png';
    $form_title = $shortcode->form_title ?? 'Để lại thông tin';
    $button_text = $shortcode->button_text ?? 'Gửi yêu cầu';
@endphp

<section class="agent-signup">
    <div class="container">
        <div class="agent-info">
            <div class="agent-image">
                <img src="{{ asset($image) }}" alt="Agent Image">
            </div>
            <div class="agent-text">
                <h2>{!! $title !!}</h2>
                <ul>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"></path></svg> Chiết khấu hấp dẫn, chính sách đại lý tốt nhất
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"></path></svg> Thưởng ưu đãi lớn, hỗ trợ hoạt động quý, năm
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"></path></svg> Hỗ trợ đầy đủ về marketing và bán hàng
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"></path></svg> Sản phẩm an toàn, uy tín, dễ dàng bán
                    </li>
                </ul>
                <p>Theo dõi tại: </p>
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
        </div>
                       <div class="signup-form">
                   <h3>{{ $form_title }}</h3>
                   @if (is_plugin_active('contact'))
                       {!! do_shortcode('[contact-form title="" bg="0"][/contact-form]') !!}
                   @else
                       <form class="contact-form" method="POST" action="{{ route('public.send.contact') }}">
                           @csrf
                           <input type="text" name="name" placeholder="Họ và tên" required>
                           <input type="email" name="email" placeholder="Nhập địa chỉ email" required>
                           <input type="text" name="phone" placeholder="Nhập số điện thoại" required>
                           <textarea name="content" placeholder="Nội dung bạn muốn tư vấn" required></textarea>
                           <button type="submit" class="btn">{{ $button_text }}</button>
                       </form>
                   @endif
               </div>
    </div>
</section> 