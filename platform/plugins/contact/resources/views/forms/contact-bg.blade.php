<div class="contact-form contact-bg lazy-load-background" title="Liên hệ báo giá" aria-label="Liên hệ báo giá" data-bg-src="{{ RvMedia::getImageUrl(theme_option('contact_bg')) }}" style="{{ @$shortcode->is_home ? 'padding-top:35px' : '' }}">
    <div style="width: 100%" class="contact-form-content d-flex align-items-center justify-content-center">
        <div class="col-lg-4 col-md-2 col-sm-0"></div>
        <div class="col-lg-4 col-md-8 col-sm-12 col-12 content-form">
            <div class="bg">{{ @$shortcode->title }}</div>
            @include('plugins/contact::forms.form')
        </div>
        <div class="col-lg-4 col-md-2 col-sm-0"></div>
    </div>
</div>
