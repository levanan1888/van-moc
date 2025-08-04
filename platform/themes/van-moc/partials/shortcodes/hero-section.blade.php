@php
    $title = $shortcode->title ?? 'Bắt đầu hành trình<br>sống lành từ Vạn Mộc';
    $subtitle = $shortcode->subtitle ?? 'Chăm sóc làn da và cơ thể không chỉ là thói quen, mà là hành trình yêu thương bản thân một cách trọn vẹn - bắt đầu từ những điều thuần khiết nhất.';
    $button_text = $shortcode->button_text ?? 'Khám phá sản phẩm';
    $button_url = $shortcode->button_url ?? '#';
@endphp

<section class="hero">
    @if (is_plugin_active('banner'))
        @php
            $banners = get_all_banners(false, 3, []);
        @endphp
        @if ($banners->count() > 0)
            <div class="banner-container">
                <div class="banner-grid">
                    @foreach ($banners as $i => $item)
                        <a href="{{ $item->link }}" class="banner-item">
                            <img width="1920" height="650" {{ $i > 0 ? "loading=lazy" : '' }} src="{{ RvMedia::getImageUrl($item->image, 'large', false, RvMedia::getDefaultImage()) }}"
                                class="d-block" alt="{{ $item->name }}">
                        </a>
                    @endforeach
                </div>
                <div class="hero-overlay">
                    <div class="container">
                        <div class="hero-content">
                            <h1>{!! $title !!}</h1>
                            <p>{{ $subtitle }}</p>
                            <a href="{{ $button_url }}" class="btn">{{ $button_text }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="hero-background-fallback">
                <div class="hero-overlay">
                    <div class="container">
                        <div class="hero-content">
                            <h1>{!! $title !!}</h1>
                            <p>{{ $subtitle }}</p>
                            <a href="{{ $button_url }}" class="btn">{{ $button_text }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="hero-background-fallback">
            <div class="hero-overlay">
                <div class="container">
                    <div class="hero-content">
                        <h1>{!! $title !!}</h1>
                        <p>{{ $subtitle }}</p>
                        <a href="{{ $button_url }}" class="btn">{{ $button_text }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section> 