<div class="sticky-mobile-icon">

    @php
        $social_messenger = get_social_link('social_messenger');
        $social_zalo = get_social_link('social_zalo');
        $dimensions = explode('x', RvMedia::getSize('thumb'));
    @endphp
    <div class="row">

        <div class="col-3 text-center pt-1 pb-1 Phone">
            <a href="tel:{{ theme_option('hotline_phone') }}" target="_blank"><img class="fa-phone" alt="Liện hệ qua điện thoại" width="45" height="45"
                    src="{{ RvMedia::getImageUrl(theme_option('icon_phone'), 'thumb', false, '') }}" /></a>
        </div>
        <div class="col-3 text-center pt-1 pb-1 Zalo">
            @if (!empty($social_zalo))
                <a href="{{ @$social_zalo['link'] }}" target="_blank"><img class="fa-zalo" alt="{{ @$social_zalo['name'] }}" width="45" height="45"
                        src="{{ RvMedia::getImageUrl(theme_option('icon_zalo'), 'thumb', false, '') }}" /></a>
            @endif
        </div>
        <div class="col-3 text-center pt-1 pb-1 Messenger">
            @if (!empty($social_messenger))
                <a href="{{ @$social_messenger['link'] }}" target="_blank"><img class="fa-messenger" alt="{{ @$social_messenger['name'] }}" width="45" height="45"
                        src="{{ RvMedia::getImageUrl(theme_option('icon_messenger'), 'thumb', false, '') }}" /></a>
            @endif
        </div>
        <div class="col-3 text-center pt-1 pb-1 Quote">
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalContact"><img class="fa-quote" alt="Liên hệ báo giá" width="45" height="45"
                    src="{{ RvMedia::getImageUrl(theme_option('icon_quote'), 'thumb', false, '') }}" /></a>
        </div>

    </div>

</div>
