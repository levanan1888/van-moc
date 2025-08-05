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
                    <a href="#" target="_blank" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" target="_blank" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a href="#" target="_blank" aria-label="Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="#" target="_blank" aria-label="YouTube">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
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

    .social-icons svg {
        width: 24px;
        height: 24px;
        color: white;
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
@media (max-width: 1200px) {
    .agent-signup .container {
        gap: 20px;
    }
    
    .agent-info {
        gap: 20px;
    }
    
    .agent-info h2 {
        font-size: 32px;
        margin-bottom: 25px;
    }
}

@media (max-width: 992px) {
    .agent-signup .container {
        flex-direction: column;
        gap: 40px;
    }
    
    .agent-info {
        flex-direction: column;
        text-align: center;
        gap: 30px;
    }
    
    .agent-image {
        flex: 1;
        max-width: 500px;
        margin: 0 auto;
    }
    
    .agent-text {
        flex: 1;
        text-align: center;
    }
    
    .agent-info h2 {
        font-size: 28px;
        margin-bottom: 25px;
    }
    
    .agent-info ul {
        margin-bottom: 25px;
    }
    
    .agent-info li {
        justify-content: center;
        margin-bottom: 10px;
        font-size: 15px;
    }
    
    .agent-info p {
        float: none;
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .social-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
    }
    
    .social-icons a {
        margin-right: 0;
    }
    
    .signup-form {
        flex: 1;
        max-width: 500px;
        margin: 0 auto;
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
        padding: 40px 16px;
        overflow-x: hidden;
    }
    
    .agent-signup .container {
        flex-direction: column;
        gap: 30px;
        max-width: 100%;
    }
    
    .agent-info {
        flex-direction: column;
        gap: 25px;
        text-align: center;
        width: 100%;
    }
    
    /* Ảnh minh họa - trên cùng, canh giữa, co giãn phù hợp */
    .agent-image {
        order: -1; /* Đưa ảnh lên trên cùng */
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
        padding: 0;
    }
    
    .agent-image img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        object-fit: cover;
    }
    
    /* Tiêu đề - canh giữa, font-size vừa phải */
    .agent-text {
        width: 100%;
        text-align: center;
        padding: 0 16px;
    }
    
    .agent-info h2 {
        font-size: 22px;
        margin-bottom: 20px;
        line-height: 1.4;
        text-align: center;
        font-weight: 600;
    }
    
    /* Danh sách nội dung - căn trái, font-size dễ đọc */
    .agent-info ul {
        margin-bottom: 20px;
        text-align: left;
        padding: 0 16px;
    }
    
    .agent-info li {
        font-size: 16px;
        margin-bottom: 12px;
        text-align: left;
        justify-content: flex-start;
        display: flex;
        align-items: flex-start;
        gap: 8px;
        line-height: 1.5;
    }
    
    .agent-info li svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        margin-top: 2px;
    }
    
    /* Text "Theo dõi tại" */
    .agent-info p {
        margin-bottom: 15px;
        font-size: 16px;
        text-align: center;
        font-weight: 500;
    }
    
    /* Các icon mạng xã hội - nằm ở dưới cùng, canh giữa */
    .social-icons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        padding: 0 16px;
    }
    
    .social-icons a {
        margin-right: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 8px;
        background-color: #4A7D4A;
        transition: all 0.3s ease;
    }
    
    .social-icons a:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(74, 125, 74, 0.3);
    }
    
    .social-icons svg {
        width: 24px;
        height: 24px;
        color: white;
    }
    
    /* Form styling cho mobile */
    .signup-form {
        padding: 25px 20px;
        max-width: 100%;
        margin: 0 auto;
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

@media (max-width: 480px) {
    .agent-signup {
        padding: 30px 16px;
        overflow-x: hidden;
    }
    
    .agent-signup .container {
        gap: 20px;
        max-width: 100%;
    }
    
    .agent-info {
        gap: 20px;
    }
    
    /* Ảnh minh họa - tối ưu cho màn hình nhỏ */
    .agent-image {
        width: 100%;
        max-width: 100%;
    }
    
    .agent-image img {
        width: 100%;
        height: auto;
        border-radius: 6px;
    }
    
    /* Tiêu đề - font-size nhỏ hơn cho màn hình nhỏ */
    .agent-text {
        padding: 0 12px;
    }
    
    .agent-info h2 {
        font-size: 20px;
        margin-bottom: 18px;
        line-height: 1.3;
    }
    
    /* Danh sách nội dung - tối ưu cho màn hình nhỏ */
    .agent-info ul {
        margin-bottom: 18px;
        padding: 0 12px;
    }
    
    .agent-info li {
        font-size: 15px;
        margin-bottom: 10px;
        gap: 6px;
        line-height: 1.4;
    }
    
    .agent-info li svg {
        width: 18px;
        height: 18px;
        margin-top: 1px;
    }
    
    /* Text "Theo dõi tại" */
    .agent-info p {
        margin-bottom: 12px;
        font-size: 15px;
    }
    
    /* Các icon mạng xã hội - tối ưu cho màn hình nhỏ */
    .social-icons {
        gap: 12px;
        padding: 0 12px;
    }
    
    .social-icons a {
        width: 40px;
        height: 40px;
        border-radius: 6px;
    }
    
    .social-icons svg {
        width: 20px;
        height: 20px;
        color: white;
    }
    
    /* Form styling cho màn hình nhỏ */
    .signup-form {
        padding: 20px 15px;
    }
    
    .signup-form h3 {
        font-size: 18px;
        margin-bottom: 15px;
    }
    
    .signup-form input,
    .signup-form textarea,
    .signup-form .custom-contact-form input,
    .signup-form .custom-contact-form textarea {
        padding: 10px 12px;
        margin-bottom: 8px;
        font-size: 12px;
    }
    
    .signup-form .btn,
    .signup-form .custom-contact-form button,
    .signup-form .custom-contact-form input[type="submit"] {
        padding: 12px 18px;
        font-size: 13px;
    }
}
</style>

<script>
// Mobile submenu functionality
document.addEventListener('DOMContentLoaded', function() {
    // Handle mobile menu submenu toggle
    const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children > a');
    
    menuItemsWithChildren.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            const parentLi = this.parentElement;
            const submenu = parentLi.querySelector('.sub-menu');
            
            // Toggle active class
            parentLi.classList.toggle('active');
            
            // Close other open submenus
            const otherActiveItems = document.querySelectorAll('.menu-item-has-children.active');
            otherActiveItems.forEach(activeItem => {
                if (activeItem !== parentLi) {
                    activeItem.classList.remove('active');
                }
            });
            
            // Smooth animation for submenu
            if (submenu) {
                if (parentLi.classList.contains('active')) {
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                } else {
                    submenu.style.maxHeight = '0';
                }
            }
        });
    });
    
    // Close submenus when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.main-nav')) {
            const activeItems = document.querySelectorAll('.menu-item-has-children.active');
            activeItems.forEach(item => {
                item.classList.remove('active');
                const submenu = item.querySelector('.sub-menu');
                if (submenu) {
                    submenu.style.maxHeight = '0';
                }
            });
        }
    });
});
</script> 