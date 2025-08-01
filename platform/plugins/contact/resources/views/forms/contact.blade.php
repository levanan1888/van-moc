<div class="contact-form contact-none-bg">
    <div style="width: 100%" class="d-flex align-items-center justify-content-center">
        <div class="col-lg-4"></div>
        <div class="col-lg-{{ @$shortcode->single == 1 ? 11 : 4 }} content-form">
            <div class="none-bg">{{ @$shortcode->title }}</div>
            @include('plugins/contact::forms.form')
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>
