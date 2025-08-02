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
            <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/section_vanmocmall/untitled1recovered1.png') }}" alt="{{ $title }}">
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

<style>
/* Van Moc Mall Section */
.van-moc-mall {
    background-color: #FFFFFF;
    padding: 0 0 80px 0;
}

.van-moc-mall .container {
    display: flex;
    align-items: stretch;
    max-width: 100%;
    padding: 0;
    height: 800px;
}

.van-moc-mall .image-side {
    flex: 1;
}

.van-moc-mall .image-side img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.van-moc-mall .text-side {
    flex: 0.8;
    background: linear-gradient(rgba(243, 246, 243, 0.92), rgba(243, 246, 243, 0.92)), url('themes/van-moc/images/VMM_image/VMM_image/background.png');
    background-size: cover;
    background-position: center;
    padding: 50px 70px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.van-moc-mall h4 {
    color: #4A7D4A;
    margin-bottom: 22px;
}

.van-moc-mall h2 {
    font-family: 'Prata', serif;
    font-size: 32px;
    margin-bottom: 20px;
}

.van-moc-mall p {
    line-height: 2;
    margin-bottom: 10px;
}

.van-moc-mall .btn {
    display: inline-block;
    width: 30%;
    text-align: center;
    margin-top: 20px;
}

/* Responsive */
@media (max-width: 992px) {
    .van-moc-mall .container {
        flex-direction: column;
        gap: 40px;
        height: auto;
    }
    
    .van-moc-mall .text-side {
        order: 2;
        padding: 40px;
    }
    
    .van-moc-mall .image-side {
        order: 1;
    }
    
    .van-moc-mall h2 {
        font-size: 26px;
    }
    
    .van-moc-mall p {
        font-size: 14px;
    }
    
    .van-moc-mall .btn {
        width: auto;
        align-self: flex-start;
    }
}
</style> 