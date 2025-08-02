@php Theme::layout('no-sidebar'); @endphp

<section class="section pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="error-page text-center">
                    <h1 class="error-code">500</h1>
                    <h2 class="error-title">{{ trans('plugins/blog::base.internal_server_error') }}</h2>
                    <p class="error-message">{{ trans('plugins/blog::base.internal_server_error_message') }}</p>
                    <a href="{{ route('public.index') }}" class="btn btn-primary">{{ trans('plugins/blog::base.back_to_home') }}</a>
                </div>
            </div>
        </div>
    </div>
</section> 