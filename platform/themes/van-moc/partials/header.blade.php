<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ theme_option('site_title', 'Vạn Mộc') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600&family=Prata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('themes/van-moc/css/style.css') }}">
    {!! Theme::header() !!}
</head>
<body @if (BaseHelper::siteLanguageDirection() == 'rtl') dir="rtl" @endif>
{!! apply_filters(THEME_FRONT_BODY, null) !!}

<header>
    <div class="container">
        <div class="logo">
            <a href="{{ route('public.index') }}">
                @if (theme_option('logo'))
                    <img src="{{ RvMedia::getImageUrl(theme_option('logo'), 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ theme_option('site_title', 'Vạn Mộc') }}">
                @else
                    <img src="{{ asset('themes/van-moc/images/c88b292dea22637c3a33.jpg') }}" alt="Vạn Mộc Logo">
                @endif
            </a>
        </div>
        <div class="menu-toggle">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <nav class="main-nav">
            {!!
                Menu::renderMenuLocation('main-menu', [
                    'options' => ['class' => 'main-menu'],
                    'view'    => 'main-menu',
                ])
            !!}
        </nav>
        <div class="header-icons">
            <a href="#" class="search-icon" title="Tìm kiếm">
                <i class="fa fa-search"></i>
            </a>
            <a href="{{ route('public.cart') }}" class="cart-icon" title="Giỏ hàng">
                <i class="fa fa-shopping-bag"></i>
                <span class="cart-counter">0</span>
            </a>
        </div>
    </div>
</header> 