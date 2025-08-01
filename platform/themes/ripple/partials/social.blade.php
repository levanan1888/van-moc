@php
    $social_messenger = get_social_link('social_messenger');
    $social_zalo = get_social_link('social_zalo');
    $dimensions = explode('x', RvMedia::getSize('thumb'));
@endphp

<div class="sticky-icon">
    <a href="#" data-bs-toggle="modal" data-bs-target="#modalContact" class="Quote"><img class="fa-quote" alt="Liên hệ báo giá" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" src="{{ RvMedia::getImageUrl(theme_option('icon_quote'), 'thumb', false, '') }}" />{{ (__('Contact for a quote')) }} </a>
    @if (!empty($social_zalo))
    <a href="{{ @$social_zalo['link'] }}" target="_blank" class="Zalo"><img class="fa-zalo" alt="{{ @$social_zalo['name'] }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" src="{{ RvMedia::getImageUrl(theme_option('icon_zalo'), 'thumb', false, '') }}" /> {{ @$social_zalo['name'] }} </a>
    @endif
    @if (!empty($social_messenger))
    <a href="{{ @$social_messenger['link'] }}" target="_blank" class="Messenger"><img class="fa-messenger" alt="{{ @$social_messenger['name'] }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" src="{{ RvMedia::getImageUrl(theme_option('icon_messenger'), 'thumb', false, '') }}" /> {{ @$social_messenger['name'] }} </a>
    @endif
    <a href="tel:{{ theme_option('hotline_phone') }}" target="_blank" class="Phone"><img class="fa-phone" alt="Liên hệ qua điện thoại" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" src="{{ RvMedia::getImageUrl(theme_option('icon_phone'), 'thumb', false, '') }}" /> {{ theme_option('hotline_phone') }} </a>
 </div>
