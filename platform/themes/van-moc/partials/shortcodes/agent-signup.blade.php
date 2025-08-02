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
                <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/image215.png') }}" alt="Agent Image">
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
                    <a href="#" target="_blank"><img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/socialicon1.svg') }}" alt="Facebook"></a>
                    <a href="#" target="_blank"><img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/socialicon2.svg') }}" alt="LinkedIn"></a>
                    <a href="#" target="_blank"><img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/socialicon3.svg') }}" alt="Twitter"></a>
                    <a href="#" target="_blank"><img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/socialicon4.svg') }}" alt="Pinterest"></a>
                </div>
            </div>
        </div>
                                   <div class="signup-form">
                <h3>Để lại thông tin</h3>
                @if (is_plugin_active('contact'))
                    {!! do_shortcode('[contact-form title="" bg="0"][/contact-form]') !!}
                @else
                    <form class="contact-form" method="POST" action="{{ route('public.send.contact') }}">
                        @csrf
                        <input type="text" name="name" placeholder="Họ và tên" required>
                        <input type="email" name="email" placeholder="Nhập địa chỉ email" required>
                        <input type="tel" name="phone" placeholder="Nhập số điện thoại" required>
                        <textarea name="content" placeholder="Nội dung bạn muốn tư vấn" required></textarea>
                        <button type="submit" class="btn">Gửi yêu cầu</button>
                    </form>
                @endif
            </div>
    </div>
</section>

<style>
/* Agent Signup Section */
.agent-signup {
    background: linear-gradient(rgba(243, 246, 243, 0.9), rgba(243, 246, 243, 0.9)), url('themes/van-moc/images/VMM_image/VMM_image/background8.png');
    background-size: cover;
    background-position: center;
    padding: 80px 0;
}

.agent-signup .container {
    display: flex;
    align-items: center;
    gap: 30px;
}

.agent-info {
    flex: 1.2;
    display: flex;
    align-items: center;
    gap: 30px;
}

.agent-image {
    flex: 1.2;
}

.agent-image img {
    width: 100%;
    border-radius: 8px;
}

.agent-text {
    flex: 1.2;
    align-items: center;
    display: inline-block;
}

.agent-info h2 {
    font-family: 'Prata', serif;
    font-size: 36px;
    line-height: 1.3;
    margin-bottom: 30px;
}

.agent-info ul {
    margin-bottom: 30px;
}

.agent-info li {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 8px;
}

.agent-info p {
    float: left;
    margin-right: 10px;
}

.social-icons a {
    margin-right: 15px;
}

.social-icons img {
    height: 24px;
}

.signup-form {
    flex: 0.5;
    background: white;
    padding: 25px 25px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.07);
}

.signup-form h3 {
    font-size: 23px;
    margin-bottom: 13px;
}

.signup-form input,
.signup-form textarea {
    width: 100%;
    padding: 15px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-family: inherit;
    background-color: #F9F9F9;
}

.signup-form textarea {
    height: 100px;
    resize: vertical;
}

.signup-form .btn {
    width: 100%;
    text-align: center;
    border: none;
}

/* Responsive */
@media (max-width: 992px) {
    .agent-signup .container {
        flex-direction: column;
        gap: 40px;
    }
}
</style> 