@php
    $title = $shortcode->title ?? 'Bắt đầu hành trình<br>sống lành từ Vạn Mộc';
    $subtitle = $shortcode->subtitle ?? 'Chăm sóc làn da và cơ thể không chỉ là thói quen, mà là hành trình yêu thương bản thân một cách trọn vẹn - bắt đầu từ những điều thuần khiết nhất.';
    $button_text = $shortcode->button_text ?? 'Khám phá sản phẩm';
    $button_url = $shortcode->button_url ?? '#';
@endphp

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>{!! $title !!}</h1>
            <p>{{ $subtitle }}</p>
            <a href="{{ $button_url }}" class="btn">{{ $button_text }}</a>
        </div>
    </div>
</section> 