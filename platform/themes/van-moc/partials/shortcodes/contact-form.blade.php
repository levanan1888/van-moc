@php
    $title = $shortcode->title ?? 'Để lại thông tin';
    $description = $shortcode->description ?? 'Hãy để lại thông tin để chúng tôi có thể liên hệ với bạn';
@endphp

<section class="contact-form-section">
    <div class="container">
        <div class="contact-form-wrapper">
            <div class="contact-form-header">
                <h2>{{ $title }}</h2>
                @if ($description)
                    <p>{{ $description }}</p>
                @endif
            </div>
            
            <div class="contact-form-content">
                <form class="contact-form" action="{{ route('public.send.contact') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Họ và tên *</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="tel" id="phone" name="phone" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="content">Nội dung *</label>
                        <textarea id="content" name="content" class="form-control" rows="5" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Gửi thông tin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
.contact-form-section {
    padding: 60px 0;
    background: #f8f9fa;
}

.contact-form-wrapper {
    max-width: 600px;
    margin: 0 auto;
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.contact-form-header {
    text-align: center;
    margin-bottom: 30px;
}

.contact-form-header h2 {
    font-size: 28px;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
}

.contact-form-header p {
    color: #666;
    font-size: 16px;
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

.contact-form textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.contact-form .btn-primary {
    background: #28a745;
    border: none;
    color: white;
    padding: 12px 30px;
    font-size: 16px;
    font-weight: 500;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 100%;
}

.contact-form .btn-primary:hover {
    background: #218838;
}

/* Responsive */
@media (max-width: 768px) {
    .contact-form-wrapper {
        margin: 0 20px;
        padding: 30px 20px;
    }
    
    .contact-form-header h2 {
        font-size: 24px;
    }
    
    .contact-form .form-control {
        padding: 10px 12px;
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .contact-form-section {
        padding: 40px 0;
    }
    
    .contact-form-wrapper {
        padding: 20px 15px;
    }
    
    .contact-form-header h2 {
        font-size: 20px;
    }
}
</style> 