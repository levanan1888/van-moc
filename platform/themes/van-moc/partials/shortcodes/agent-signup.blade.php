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
                                <form class="contact-form custom-contact-form" method="POST" action="{{ route('public.send.custom.contact') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" id="name" name="name" placeholder="Họ và tên" required>
                    <input type="email" id="email" name="email" placeholder="Nhập địa chỉ email" required>
                    <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                    <textarea id="content" name="content" placeholder="Nội dung bạn muốn tư vấn" required></textarea>
                    <button type="submit" class="btn">Gửi yêu cầu</button>
                </form>
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
    padding: 30px 25px;
    border-radius: 8px;
    box-shadow: green;
    position: relative;
    overflow: hidden;
}

.signup-form::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: #4A7D4A;
}

.signup-form h3 {
    font-size: 18px;
    margin-bottom: 20px;
    color: #4A7D4A;
    font-weight: 600;
    text-align: center;
}

.signup-form .form-group {
    margin-bottom: 20px;
}

.signup-form .form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #1D1D1D;
    font-size: 14px;
}

.signup-form input,
.signup-form textarea {
    width: 100%;
    padding: 18px 20px;
    margin-bottom: 0;
    border: 2px solid #E8E8E8;
    border-radius: 8px;
    font-family: inherit;
    font-size: 14px;
    background-color: #FFFFFF;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.signup-form input:focus,
.signup-form textarea:focus {
    outline: none;
    border-color: #4A7D4A;
    box-shadow: 0 0 0 3px rgba(74, 125, 74, 0.1);
    background-color: #FFFFFF;
}

.signup-form input::placeholder,
.signup-form textarea::placeholder {
    color: #999;
    font-size: 14px;
}

.signup-form textarea {
    height: 120px;
    resize: vertical;
    min-height: 120px;
}

.signup-form .btn {
    width: 100%;
    text-align: center;
    border: none;
    background: linear-gradient(135deg, #4A7D4A, #6B9E6B);
    color: white;
    padding: 18px 30px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 10px;
}

.signup-form .btn:hover {
    background: linear-gradient(135deg, #3b6b3b, #5a8a5a);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(74, 125, 74, 0.3);
}

/* Custom contact form styles */
.signup-form .custom-contact-form {
    margin: 0;
}

.signup-form .custom-contact-form input,
.signup-form .custom-contact-form textarea,
.signup-form .custom-contact-form select {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 15px;
    border: 1px solid #E0E0E0;
    border-radius: 4px;
    font-family: inherit;
    font-size: 14px;
    background-color: #FFFFFF;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.signup-form .custom-contact-form input:focus,
.signup-form .custom-contact-form textarea:focus,
.signup-form .custom-contact-form select:focus {
    outline: none;
    border-color: #4A7D4A;
    box-shadow: 0 0 0 2px rgba(74, 125, 74, 0.1);
    background-color: #FFFFFF;
}

.signup-form .custom-contact-form input::placeholder,
.signup-form .custom-contact-form textarea::placeholder {
    color: #999;
    font-size: 13px;
}

.signup-form .custom-contact-form textarea {
    height: 100px;
    resize: vertical;
    min-height: 100px;
}

.signup-form .custom-contact-form button,
.signup-form .custom-contact-form input[type="submit"] {
    width: 100%;
    text-align: center;
    border: none;
    background: #4A7D4A;
    color: white;
    padding: 12px 20px;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 5px;
    position: relative;
    overflow: hidden;
}

.signup-form .custom-contact-form button:hover,
.signup-form .custom-contact-form input[type="submit"]:hover {
    background: #3b6b3b;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(74, 125, 74, 0.3);
}

.signup-form .custom-contact-form button:disabled,
.signup-form .custom-contact-form input[type="submit"]:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

/* File upload styling */
.signup-form .custom-contact-form input[type="file"] {
    padding: 15px 20px;
    border: 2px dashed #E8E8E8;
    background-color: #FAFAFA;
    cursor: pointer;
    border-radius: 8px;
}

.signup-form .custom-contact-form input[type="file"]:hover {
    border-color: #4A7D4A;
    background-color: #F8F8F8;
}

.signup-form .custom-contact-form .file-info {
    display: block;
    margin-top: 5px;
    font-size: 12px;
    color: #666;
    font-style: italic;
}

/* Success/Error message styling */
.signup-form .custom-contact-form .alert {
    padding: 15px 20px;
    margin-bottom: 15px;
    border-radius: 8px;
    font-size: 14px;
}

.signup-form .custom-contact-form .alert-success {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.signup-form .custom-contact-form .alert-danger {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

/* Loading state */
.signup-form .custom-contact-form.loading button {
    pointer-events: none;
}

.signup-form .custom-contact-form.loading button::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 992px) {
    .agent-signup .container {
        flex-direction: column;
        gap: 40px;
    }
    
    .signup-form {
        padding: 30px 25px;
    }
    
    .signup-form h3 {
        font-size: 22px;
        margin-bottom: 20px;
    }
    
    .signup-form input,
    .signup-form textarea,
    .signup-form .custom-contact-form input,
    .signup-form .custom-contact-form textarea {
        padding: 14px 16px;
        margin-bottom: 12px;
    }
    
    .signup-form .btn,
    .signup-form .custom-contact-form button,
    .signup-form .custom-contact-form input[type="submit"] {
        padding: 16px 25px;
        font-size: 15px;
    }
}

@media (max-width: 768px) {
    .agent-signup {
        padding: 60px 0;
    }
    
    .signup-form {
        padding: 25px 20px;
    }
    
    .signup-form h3 {
        font-size: 20px;
        margin-bottom: 18px;
    }
    
    .signup-form input,
    .signup-form textarea,
    .signup-form .custom-contact-form input,
    .signup-form .custom-contact-form textarea {
        padding: 12px 14px;
        margin-bottom: 10px;
        font-size: 13px;
    }
    
    .signup-form .btn,
    .signup-form .custom-contact-form button,
    .signup-form .custom-contact-form input[type="submit"] {
        padding: 14px 20px;
        font-size: 14px;
    }
}
</style> 