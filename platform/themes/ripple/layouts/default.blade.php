{!! Theme::partial('header') !!}
@if (Theme::get('section-name'))
    {!! Theme::partial('breadcrumbs') !!}
@endif
<section class="section pt-10 pb-20">
    <div class="container">
        <div class="row">

            <div class="col-lg-3">
                <div class="page-sidebar">
                    {!! Theme::partial('sidebar') !!}
                </div>
            </div>
            <div class="col-lg-12">
                <div class="page-content">
                    {!! Theme::content() !!}
                </div>
            </div>
        </div>
    </div>
</section>
{!! Theme::partial('footer') !!}


