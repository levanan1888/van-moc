@php
    $title = $shortcode->title ?? 'VẠN MỘC MALL';
    $subtitle = $shortcode->subtitle ?? 'Câu chuyện của chúng tôi';
    $content = $shortcode->content ?? 'Vạn Mộc Mall là nơi quy tụ những con người đam mê chăm sóc làn da và sức khỏe bằng phương pháp tự nhiên. Chúng tôi chọn lọc tinh tuý từ vườn thảo mộc, đặc sản của các địa phương, để đưa ra những sản phẩm an toàn, lành tính, và hiệu quả...';
    $content2 = $shortcode->content2 ?? 'Mang trong mình sứ mệnh xây dựng thói quen sống khỏe đẹp từ thiên nhiên, Vạn Mộc không chỉ là không gian mua sắm, mà còn là người bạn đồng hành cùng bạn trên hành trình chăm sóc và yêu thương bản thân.';
    $image = $shortcode->image ?? 'themes/van-moc/images/sections/vanmocmall.png';
    $button_text = $shortcode->button_text ?? 'Tìm hiểu thêm';
    $button_url = $shortcode->button_url ?? '#';
@endphp

<section class="van-moc-mall">
    <div class="container">
        <div class="image-side">
            <img src="{{ asset($image) }}" alt="{{ $title }}">
        </div>
        <div class="text-side">
            <h4>{{ $subtitle }}</h4>
            <h2>{{ $title }}</h2>
            <p>{{ $content }}</p>
            <p>{{ $content2 }}</p>
            <a href="{{ $button_url }}" class="btn">{{ $button_text }}</a>
        </div>
    </div>
</section> 