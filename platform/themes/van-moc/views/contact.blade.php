@php Theme::layout('default'); @endphp

{!! Theme::partial('breadcrumbs') !!}

<section class="contact-page-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form-wrapper">
                    <div class="contact-form-header">
                        <h1>Liên hệ với chúng tôi</h1>
                        <p>Hãy để lại thông tin để chúng tôi có thể liên hệ với bạn trong thời gian sớm nhất</p>
                    </div>
                    
                    <div class="contact-form-content">
                        <form class="contact-form" action="{{ route('public.send.contact') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Họ và tên *</label>
                                        <input type="text" id="name" name="name" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="email" id="email" name="email" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="tel" id="phone" name="phone" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subject">Chủ đề</label>
                                        <select id="subject" name="subject" class="form-control">
                                            <option value="">Chọn chủ đề</option>
                                            <option value="tư vấn sản phẩm">Tư vấn sản phẩm</option>
                                            <option value="đặt hàng">Đặt hàng</option>
                                            <option value="khiếu nại">Khiếu nại</option>
                                            <option value="hợp tác">Hợp tác</option>
                                            <option value="khác">Khác</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="content">Nội dung *</label>
                                <textarea id="content" name="content" class="form-control" rows="6" required placeholder="Hãy mô tả chi tiết yêu cầu của bạn..."></textarea>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i>
                                    Gửi thông tin
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="contact-info-wrapper">
                    <div class="contact-info">
                        <h3>Thông tin liên hệ</h3>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Địa chỉ</h4>
                                <p>{{ theme_option('contact_address', '860/60N/8 Xô Viết Nghệ Tĩnh, phường Bình Thạnh, Tp.Hồ Chí Minh') }}</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Điện thoại</h4>
                                <p>{{ theme_option('contact_phone', '081 611 1123') }}</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Email</h4>
                                <p>{{ theme_option('contact_email', 'vanmocmall@gmail.com') }}</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Giờ làm việc</h4>
                                <p>Thứ 2 - Thứ 7: 8:00 - 18:00<br>Chủ nhật: 9:00 - 16:00</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="social-links">
                        <h4>Theo dõi chúng tôi</h4>
                        <div class="social-icons">
                            @if (theme_option('social_facebook'))
                                <a href="{{ theme_option('social_facebook') }}" target="_blank" class="social-icon">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif
                            
                            @if (theme_option('social_linkedin'))
                                <a href="{{ theme_option('social_linkedin') }}" target="_blank" class="social-icon">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            @endif
                            
                            @if (theme_option('social_twitter'))
                                <a href="{{ theme_option('social_twitter') }}" target="_blank" class="social-icon">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @endif
                            
                            @if (theme_option('social_pinterest'))
                                <a href="{{ theme_option('social_pinterest') }}" target="_blank" class="social-icon">
                                    <i class="fab fa-pinterest-p"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.contact-page-section {
    padding: 60px 0;
    background: #f8f9fa;
}

.contact-form-wrapper {
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    height: 100%;
}

.contact-form-header {
    text-align: center;
    margin-bottom: 30px;
}

.contact-form-header h1 {
    font-size: 32px;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
}

.contact-form-header p {
    color: #666;
    font-size: 16px;
    line-height: 1.6;
}

.contact-form .form-group {
    margin-bottom: 20px;
}

.contact-form label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #333;
}

.contact-form .form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

.contact-form .form-control:focus {
    outline: none;
    border-color: #28a745;
    box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.2);
}

.contact-form select.form-control {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
}

.contact-form textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.contact-form .btn-primary {
    background: #28a745;
    border: none;
    color: white;
    padding: 15px 30px;
    font-size: 16px;
    font-weight: 500;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.contact-form .btn-primary:hover {
    background: #218838;
}

/* Contact Info */
.contact-info-wrapper {
    height: 100%;
}

.contact-info {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.contact-info h3 {
    font-size: 24px;
    font-weight: 600;
    color: #333;
    margin-bottom: 25px;
    text-align: center;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.contact-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.contact-icon {
    width: 50px;
    height: 50px;
    background: #28a745;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.contact-icon i {
    color: white;
    font-size: 18px;
}

.contact-details h4 {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.contact-details p {
    color: #666;
    line-height: 1.5;
    margin: 0;
}

/* Social Links */
.social-links {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.social-links h4 {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

.social-icons {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.social-icon {
    width: 45px;
    height: 45px;
    background: #28a745;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-icon:hover {
    background: #218838;
    transform: translateY(-2px);
}

.social-icon i {
    font-size: 18px;
}

/* Responsive */
@media (max-width: 991px) {
    .contact-form-wrapper {
        margin-bottom: 30px;
    }
    
    .contact-form-header h1 {
        font-size: 28px;
    }
}

@media (max-width: 768px) {
    .contact-page-section {
        padding: 40px 0;
    }
    
    .contact-form-wrapper {
        padding: 30px 20px;
    }
    
    .contact-form-header h1 {
        font-size: 24px;
    }
    
    .contact-form .form-control {
        padding: 10px 12px;
        font-size: 14px;
    }
    
    .contact-info, .social-links {
        padding: 20px;
    }
    
    .contact-info h3 {
        font-size: 20px;
    }
}

@media (max-width: 480px) {
    .contact-form-wrapper {
        padding: 20px 15px;
    }
    
    .contact-form-header h1 {
        font-size: 20px;
    }
    
    .contact-info, .social-links {
        padding: 15px;
    }
    
    .contact-item {
        flex-direction: column;
        text-align: center;
    }
    
    .contact-icon {
        margin-right: 0;
        margin-bottom: 10px;
    }
    
    .social-icons {
        gap: 10px;
    }
    
    .social-icon {
        width: 40px;
        height: 40px;
    }
}
</style> 