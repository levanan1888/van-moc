</div>
@if(!empty(theme_option('map_address')))
<div class="google map">
    {!! do_shortcode('[google-map]'.theme_option('map_address').'[/google-map]') !!}
</div>
@endif
<footer class="page-footer bag-dark pt-50">
    <div class="container">
        {{-- <div class="row sub-logo mb-4">
            @if (theme_option('logo'))
                <div class="logo">
                    <img src="{{ RvMedia::getImageUrl(theme_option('logo')) }}" alt="{{ theme_option('site_title') }}" height="50">
                </div>
            @endif
            @if (theme_option('logo'))
                <div class="bct">
                    <img src="{{ RvMedia::getImageUrl(theme_option('bct')) }}" alt="{{ theme_option('site_title') }}" height="50">
                </div>
            @endif
        </div> --}}
        <div class="row">
            @if (theme_option('address') || theme_option('website') || theme_option('contact_email') || theme_option('site_description'))
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <aside class="widget widget--transparent widget__footer widget__about">
                    {{-- <div class="widget__header">
                        <h3 class="widget__title">{{ __('About us') }}</h3>
                    </div> --}}
                    <div class="widget__content">
                        <p>{!! theme_option('site_description') !!}</p>
                        {{-- <div class="person-detail">
                            @if (theme_option('address'))
                                <p><i class="ion-home"></i>{{ theme_option('address') }}</p>
                            @endif
                            @if (theme_option('website'))
                                <p><i class="ion-earth"></i><a href="{{ theme_option('website') }}">{{ theme_option('website') }}</a></p>
                            @endif
                            @if (theme_option('contact_email'))
                                <p><i class="ion-email"></i><a href="mailto:{{ theme_option('contact_email') }}">{{ theme_option('contact_email') }}</a></p>
                            @endif
                        </div> --}}
                    </div>
                </aside>
            </div>
            @endif
            {!! dynamic_sidebar('footer_sidebar') !!}
        </div>
    </div>
    <div class="social-mobile-sticky">
    {!! Theme::partial('mobile-social') !!}
    </div>
    <div class="page-footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <div class="page-copyright">
                        {!! BaseHelper::clean(theme_option('copyright')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="social-sticky">
    {!! Theme::partial('social') !!}
</div>
<div id="back2top">
    <i class="fa fa-angle-up"></i>
</div>
<!-- JS Library-->
{!! Theme::footer() !!}

</body>
</html>
