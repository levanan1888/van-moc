@php
    $philosophy_title = $shortcode->philosophy_title ?? 'Triết lý của chúng tôi';
    $philosophy_content = $shortcode->philosophy_content ?? 'Khởi nguồn từ những chuyên gia yêu thương làn da, sắc đẹp và sức khỏe con người. Vạn Mộc chọn lọc tinh túy từ vườn thảo mộc thiên nhiên, đem đến những sản phẩm thủ công trị liệu cao cấp nhất cho bạn.';
    $vision_title = $shortcode->vision_title ?? 'Tầm nhìn';
    $vision_content = $shortcode->vision_content ?? 'Là công ty phát triển thị trường cho các sản phẩm tiêu dùng THUẦN TỰ NHIÊN chuyên nghiệp nhất tại thị trường Việt Nam.';
    $mission_title = $shortcode->mission_title ?? 'Sứ mệnh';
    $mission_content = $shortcode->mission_content ?? 'Xây dựng cộng đồng sử dụng thảo mộc và chăm sóc sức khỏe, sắc đẹp thuần tự nhiên lờn nhất cả nước.';
    $button_text = $shortcode->button_text ?? 'Tìm hiểu thêm';
    $button_url = $shortcode->button_url ?? '#';
@endphp

<section class="philosophy-vision-mission">
    <div class="container">
        <div class="philosophy-box">
            <div class="philosophy-bg">
                <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh_trietly/hinhtrietly.png') }}" alt="Philosophy Background">
            </div>
            <div class="philosophy-content">
                <h3>{{ $philosophy_title }}</h3>
                <p>{{ $philosophy_content }}</p>
                <a href="{{ $button_url }}" class="btn">{{ $button_text }}</a>
            </div>
        </div>
        <div class="vision-mission-box">
            <div class="vision-content">
                <div class="vision-bg">
                    <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh_trietly/hinhtrietly2.png') }}" alt="Vision Background">
                </div>
                <div class="vision-text">
                    <h4>{{ $vision_title }}</h4>
                    <p>{{ $vision_content }}</p>
                </div>
            </div>
            <div class="mission-content">
                <div class="mission-bg">
                    <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh_trietly/hinhtrietly3.png') }}" alt="Mission Background">
                </div>
                <div class="mission-text">
                    <h4>{{ $mission_title }}</h4>
                    <p>{{ $mission_content }}</p>
                </div>
            </div>
        </div>
    </div>
</section> 