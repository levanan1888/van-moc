<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" lang="{{ app()->getLocale() }}"><![endif]-->
<!--[if IE 8]><html class="ie ie8" lang="{{ app()->getLocale() }}"><![endif]-->
<!--[if IE 9]><html class="ie ie9" lang="{{ app()->getLocale() }}"><![endif]-->
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
        <meta name="format-detection" content="telephone=no">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family={{ urlencode(theme_option('primary_font', 'Roboto')) }}&display=swap" rel="stylesheet">

        <style>
            :root {
                --color-1st: {{ theme_option('primary_color', '#bead8e') }};
                --primary-font: '{{ theme_option('primary_font', 'Roboto') }}', sans-serif;
            }
        </style>

        @php
            Theme::asset()->container('footer')->remove('simple-slider-js');
        @endphp

        {!! Theme::header() !!}

        <link rel="stylesheet" href="{{ asset('themes/ripple/css/custom.css') }}">

        <!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
        <!--WARNING: Respond.js doesn't work if you view the page via file://-->
        <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <!--[if IE 7]><body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
    <!--[if IE 8]><body class="ie8 lt-ie9 lt-ie10"><![endif]-->
    <!--[if IE 9]><body class="ie9 lt-ie10"><![endif]-->
    <body @if (BaseHelper::siteLanguageDirection() == 'rtl') dir="rtl" @endif>
    {!! apply_filters(THEME_FRONT_BODY, null) !!}
    <header data-sticky="false" data-sticky-checkpoint="200" data-responsive="991" class="fixed-top page-header page-header--light">
        <div class="rows">
            <!-- LOGO & SEARCH -->
            <div class="container header-top">
                <div class="row">
                    <div class="logo col-lg-3 col-md-12 col-sm-12 col-12 d-flex align-items-center justify-content-center">
                        <a href="{{ route('public.single') }}/" class="page-logo">
                            @if (theme_option('logo'))
                                <img src="{{ RvMedia::getImageUrl(theme_option('logo')) }}" alt="{{ theme_option('site_title') }}" width="269" height="62">
                            @endif
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-12 d-flex align-items-center justify-content-center">
                        <div class="search-box">
                            <form method="GET" action="{{ route('public.product.search') }}">
                            <div class="input-group">
                                <input type="text" name="q" value="{{ Request::input('q') }}" class="form-control input-form" placeholder="{{ __('Search Product') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text" aria-label="Submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    @if(theme_option('contact_phone'))
                    <div class="col-lg-3 col-md-12 col-sm-12 col-12 d-flex align-items-center justify-content-center">
                        <div class="contact-phone">
                            <!-- Hình ảnh bên trái -->
                            <div class="page-icon">
                                <img class="mt-1" src="{{ asset('themes/ripple/images/contact.png') }}" width="25" height="25" alt="Liên hệ báo giá" style="height: auto" />
                            </div>
                            <!-- Tiêu đề và nội dung bên phải -->
                            <div class="page-header-content">
                                <div class="title">{{ __('Contact for a quote') }}</div>
                                <div class="desc">{{ theme_option('contact_phone') }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(theme_option('contact_email'))
                    <div class="col-lg-3 col-md-12 col-sm-12 col-12 d-flex align-items-center justify-content-center">
                        <div class="contact-email">
                            <!-- Hình ảnh bên trái -->
                            <div class="page-icon">
                                <img class="mt-1" src="{{ asset('themes/ripple/images/email.png') }}" width="30" height="30" alt="Liên hệ qua email" style="height: auto" />
                            </div>
                            <!-- Tiêu đề và nội dung bên phải -->
                            <div class="page-header-content">
                                <div class="title">{{ __('Email') }}</div>
                                <div class="desc"><a href="mailto:{{ theme_option('contact_email') }}">{{ theme_option('contact_email') }}</a></div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- LOGO-->
            <div class="page-header__right">
                <!-- MOBILE MENU-->
                <div class="navigation-toggle navigation-toggle--dark" style="display: none">
                    <span></span>
                </div>
                <div class="pull-left d-flex align-items-center justify-content-center">
                    <!-- NAVIGATION-->
                    <div class="mobile-logo">
                        <a href="{{ route('public.single') }}/" class="page-logo">
                            @if (theme_option('mobile_logo'))
                                <img src="{{ RvMedia::getImageUrl(theme_option('mobile_logo')) }}" alt="{{ theme_option('site_title') }}" width="150" height="35">
                            @endif
                        </a>
                    </div>
                    <nav class="navigation navigation--light navigation--fade navigation--fadeLeft">
                        {!!
                            Menu::renderMenuLocation('main-menu', [
                                'options' => ['class' => 'menu sub-menu--slideLeft'],
                                'view'    => 'main-menu',
                            ])
                        !!}
                    </nav>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="search-box mobile-search">
                <form method="GET" action="{{ route('public.product.search') }}">
                <div class="input-group">
                    <input type="text" name="q" value="" class="form-control input-form input-mobile" placeholder="Tìm kiếm sản phẩm">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text" aria-label="Submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </header>
    <div id="page-wrap">
