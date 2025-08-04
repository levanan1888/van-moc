<div class="sticky-mobile-icon">
    @php
        $social_messenger = get_social_link('social_messenger');
        $social_zalo = get_social_link('social_zalo');
    @endphp
    <div class="row">
        <div class="col-4 text-center pt-1 pb-1 Phone">
            <a href="tel:{{ theme_option('hotline_phone') }}" target="_blank">
                <i class="fas fa-phone"></i>
            </a>
        </div>
        <div class="col-4 text-center pt-1 pb-1 Messenger">
            @if (!empty($social_messenger))
                <a href="{{ @$social_messenger['link'] }}" target="_blank">
                    <i class="fab fa-facebook-messenger"></i>
                </a>
            @endif
        </div>
        <div class="col-4 text-center pt-1 pb-1 Zalo">
            @if (!empty($social_zalo))
                <a href="{{ @$social_zalo['link'] }}" target="_blank">
                    <i class="fas fa-comments"></i>
                </a>
            @endif
        </div>
    </div>
</div> 