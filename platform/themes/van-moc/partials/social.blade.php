@php
    $social_messenger = get_social_link('social_messenger');
    $social_zalo = get_social_link('social_zalo');
@endphp

<div class="sticky-icon">
    <a href="tel:{{ theme_option('hotline_phone') }}" target="_blank" class="Phone">
        <i class="fas fa-phone"></i>
        </a>
    @if (!empty($social_messenger))
    <a href="{{ @$social_messenger['link'] }}" target="_blank" class="Messenger">
        <i class="fab fa-facebook-messenger"></i>
        </a>
    @endif
    @if (!empty($social_zalo))
    <a href="{{ @$social_zalo['link'] }}" target="_blank" class="Zalo">
        <i class="fas fa-comments"></i>
        </a>
    @endif
</div> 