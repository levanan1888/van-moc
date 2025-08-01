@php
    Theme::set('section-name', $product->name);
    $product->loadMissing('metadata');

    $bannerImage = $product->getMetaData('banner_image', true);

    if ($bannerImage) {
        Theme::set('breadcrumbBannerImage', RvMedia::getImageUrl($bannerImage));
    }

    $image_size = RvMedia::getImageUrl($category->image_size, 'large', false, '');
    $image_color = RvMedia::getImageUrl($category->image_color, 'large', false, '');
    $social_messenger = get_social_link('social_messenger');
    $social_zalo = get_social_link('social_zalo');
    $t_dimensions = explode('x', RvMedia::getSize('thumb'));
@endphp

<div class="product">
    <div class="row product-detail">
        @if (!empty($slides))
            <div class="col-lg-6 col-md-12 col-sm-12 mainLeft">
                <div class="slider-galeria-thumbs">
                    @foreach ($slides as $thumb)
                        <div>
                            <img loading="lazy" style="display: none"
                                src="{{ RvMedia::getImageUrl($thumb['thumb'], $thumb['type'] == 'video' ? 'large' : 'thumb', false, RvMedia::getDefaultImage()) }}"
                                width="{{ @$t_dimensions[0] }}" height="{{ @$t_dimensions[1] }}"
                                alt="{{ $product->name }}">
                        </div>
                    @endforeach
                </div>
                <div class="slider-galeria" id="sliderGaleria">

                    @foreach ($slides as $large)
                        <div>
                            @if ($large['type'] == 'video')
                                <div class="embed-responsive-item">
                                    <video id="mainVideo" data-overlay="0" style="display: none" width="100%" height="100%"
                                        poster="{{ RvMedia::getImageUrl(@$large['poster'], 'large', false, '') }}">
                                        <source src="{{ RvMedia::getImageUrl(@$large['large'], 'large', false, '') }}"
                                            type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @else
                            <div class="mainImg">

                                    <img id="mainImg" loading="lazy" style="display: none"
                                        src="{{ RvMedia::getImageUrl($large['large'], 'large', false, RvMedia::getDefaultImage()) }}"
                                        width="800"
                                        height="800"
                                        alt="{{ $product->name }}">

                            </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="col-lg-6 col-md-12 col-sm-12 detail">
            <h1>{{ $product->name }}</h1>
            <div class="desc">{!! $product->description !!}</div>
            <div class="extra-info">
                @if (!empty($image_size))
                    <div class="item">
                        <div class="title">{{ __('Size') }}</div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalImageSize">
                            <div class="icon"><img
                                    src="{{ RvMedia::getImageUrl(theme_option('icon_size'), 'large', false, '') }}" width="70" height="70" alt="{{ __('Size') }}" />
                            </div>
                        </a>
                    </div>
                @endif
                @if (!empty($image_color))
                    <div class="item">
                        <div class="title">{{ __('Color') }}</div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalImageColor">
                            <div class="icon"><img
                                    src="{{ RvMedia::getImageUrl(theme_option('icon_color'), 'large', false, '') }}" width="70" height="70" alt="{{ __('Color') }}" />
                            </div>
                        </a>
                    </div>
                @endif
            </div>
            <div class="row hotline">
                <div class="d-flex align-items-center justify-content-start">
                    <strong>{{ __('Hotline') }}:</strong> <span>{{ theme_option('hotline_phone') }}</span>
                </div>
            </div>
            <div class="request mt-2">
                <a data-scroll="requestForPrice" class="btn btn-scroll">{{ __('Request for a quote') }}</a>
            </div>
            <div class="p-social mt-2">
                @if (!empty($social_zalo))
                    <div class="zalo">
                        <a href="{{ @$social_zalo['link'] }}" target="_blank" class="btn"><img src="{{ RvMedia::getImageUrl(theme_option('icon_zalo'), 'thumb', false, '') }}" width="15" height="15" alt="{{ @$social_zalo['name'] }}" />&nbsp;<span> {{ @$social_zalo['name'] }}</span></a>
                    </div>
                @endif
                @if (!empty($social_messenger))
                    <div class="facebook">
                        <a href="{{ @$social_messenger['link'] }}" target="_blank" class="btn"><img src="{{ RvMedia::getImageUrl(theme_option('icon_messenger'), 'thumb', false, '') }}" width="15" height="15" alt="{{ @$social_messenger['name'] }}" />&nbsp; <span>{{ @$social_messenger['name'] }}</span></a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if (!empty($product->content))
        <div class="page-sidebar mt-5">
            <div class="widget widget__recent-post">
                <div id="category-content" class="widget__content p-4">
                    <div class="desc">{!! str_replace('<img', '<img loading="lazy"', $product->content); !!}</div>
                </div>
            </div>
        </div>
    @endif

    <div class="box-hddd">
        {!! do_shortcode('[static-block alias="huong-dan-dat-hang"][/static-block]') !!}
    </div>

    <div class="row">
        <div class="page-sidebar">
            <div class="widget widget__recent-post">
                <div class="widget__content widget__content__cus" id="requestForPrice">
                    {!! do_shortcode('[contact-form title="NHẬN NGAY BÁO GIÁ" bg="1"][/contact-form]') !!}
                </div>
            </div>
        </div>
    </div>

    @if ($relatedProducts->count() > 0)
        <div class="mt-4 products">
            <div class="row">
                <div
                    class="header col-lg-12 col-md-12 col-sm-12 col-12 d-flex align-items-center justify-content-center">
                    <h3>
                        {{ __('Product by category') }}
                    </h3>
                </div>
                <div class="line col-12 d-flex align-items-center justify-content-center">
                    <span></span>
                </div>
            </div>
            <div class="row list-items mt-3">
                @foreach ($relatedProducts as $product)
                    <div class="item col-lg-3 col-md-4 col-sm-6 col-6 text-center">
                        <div class="page-sidebar">
                            <div class="widget widget__recent-post">
                                <div class="widget__content widget__content__product">
                                    @include('plugins/product::themes.pitem')
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="page-pagination d-flex align-items-center justify-content-center">
                {!! $relatedProducts->links() !!}
            </div> --}}
            </div>
        </div>
    @endif
</div>

<!-- IMAGE SIZE -->
@if (!empty($image_size))
    <div class="modal fade" id="modalImageSize" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Size') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-bodys">
                    <img width="100%" src="{{ $image_size }}" />
                </div>
            </div>
        </div>
    </div>
@endif

<!-- IMAGE COLOR -->
@if (!empty($image_color))
    <div class="modal fade" id="modalImageColor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Color') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-bodys">
                    <img width="100%" src="{{ $image_color }}" />
                </div>
            </div>
        </div>
    </div>
@endif

@include(Theme::getThemeNamespace() . '::views.contact-form', [])
