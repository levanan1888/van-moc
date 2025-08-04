<style>
    .vm-hero-banner {
        position: relative;
        width: 100%;
        background-size: cover;
        background-position: center;
        padding: 100px 0;
    }
    .vm-hero-banner::before {
        content: none;
    }
    .vm-hero-banner .container {
        position: relative;
        z-index: 1;
    }
    .vm-hero-banner-content {
        max-width: 50%;
        color: #333;
        background: transparent;
    }
    .vm-hero-banner-content h1,
    .vm-hero-banner-content p {
        text-shadow: none;
    }
    .vm-hero-banner-content .dot-icon {
        display: none;
    }
</style>

@php
    $title = $shortcode->title;
    $subtitle = $shortcode->subtitle;
    $image = $shortcode->image;
    $buttonText = $shortcode->button_text;
    $buttonUrl = $shortcode->button_url;
@endphp

@if ($image)
<section class="vm-hero-banner" style="background-image: url('{{ RvMedia::getImageUrl($image) }}');">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="vm-hero-banner-content">
                    @if ($title)
                        <h1>{!! BaseHelper::clean($title) !!}</h1>
                    @endif
                    @if ($subtitle)
                        <p>{!! BaseHelper::clean($subtitle) !!}</p>
                    @endif
                    @if ($buttonText && $buttonUrl)
                        <a href="{{ $buttonUrl }}" class="btn btn-primary">{{ $buttonText }}</a>
    $title = $shortcode->title ?? 'Bắt đầu hành trình<br>sống lành từ Vạn Mộc';
    $subtitle = $shortcode->subtitle ?? 'Chăm sóc làn da và cơ thể không chỉ là thói quen, mà là hành trình yêu thương bản thân một cách trọn vẹn - bắt đầu từ những điều thuần khiết nhất.';
    $button_text = $shortcode->button_text ?? 'Khám phá sản phẩm';
    $button_url = $shortcode->button_url ?? '#';
    $show_banner = $shortcode->show_banner ?? true;
@endphp

@if ($show_banner && is_plugin_active('banner'))
    @php
        $banners = get_all_banners(false, 3, []);
    @endphp
    @if ($banners->count() > 0)
        <div id="slideBanners" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($banners as $b => $btn)
                    <button type="button" data-bs-target="#slideBanners" data-bs-slide-to="{{ $b }}"
                        class="{{ $b == 0 ? 'active' : '' }}" aria-current="{{ $b == 0 ? true : false }}"
                        aria-label="Slide {{ $b }}"></button>
                @endforeach
        width: 100%;
        background-size: cover;
        background-position: center;
        padding: 100px 0;
    }
    .vm-hero-banner::before {
        content: none;
    }
    .vm-hero-banner .container {
        position: relative;
        z-index: 1;
    }
    .vm-hero-banner-content {
        max-width: 50%;
        color: #333;
        background: transparent;
    }
    .vm-hero-banner-content h1,
    .vm-hero-banner-content p {
        text-shadow: none;
    }
    .vm-hero-banner-content .dot-icon {
        display: none;
    }
</style>

@php
    $title = $shortcode->title;
    $subtitle = $shortcode->subtitle;
    $image = $shortcode->image;
    $buttonText = $shortcode->button_text;
    $buttonUrl = $shortcode->button_url;
@endphp

@if ($image)
<section class="vm-hero-banner" style="background-image: url('{{ RvMedia::getImageUrl($image) }}');">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="vm-hero-banner-content">
                    @if ($title)
                        <h1>{!! BaseHelper::clean($title) !!}</h1>
                    @endif
                    @if ($subtitle)
                        <p>{!! BaseHelper::clean($subtitle) !!}</p>
                    @endif
                    @if ($buttonText && $buttonUrl)
                        <a href="{{ $buttonUrl }}" class="btn btn-primary">{{ $buttonText }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif
            $banners = get_all_banners(false, 3, []);
        @endphp
        @if ($banners->count() > 0)
            <div id="slideBanners" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($banners as $b => $btn)
                        <button type="button" data-bs-target="#slideBanners" data-bs-slide-to="{{ $b }}"
                            class="{{ $b == 0 ? 'active' : '' }}" aria-current="{{ $b == 0 ? true : false }}"
                            aria-label="Slide {{ $b }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($banners as $i => $item)
                        <a href="{{ $item->link }}">
                            <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                <img width="1920" height="650" {{ $i > 0 ? "loading=lazy" : '' }} src="{{ RvMedia::getImageUrl($item->image, 'large', false, RvMedia::getDefaultImage()) }}"
                                    class="d-block" style="height: auto" alt="{{ $item->name }}">
                            </div>
                        </a>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#slideBanners" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#slideBanners" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @else
            <div class="hero-background-fallback"></div>
        @endif
    @else
        <div class="hero-background-fallback"></div>
    @endif
    <div class="hero-overlay">
        <div class="container">
            <div class="hero-content">
                <h1>{!! $title !!}</h1>
                <p>{{ $subtitle }}</p>
                <a href="{{ $button_url }}" class="btn">{{ $button_text }}</a>
            </div>
        </div>
    </div>
</section> 