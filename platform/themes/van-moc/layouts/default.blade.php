{!! Theme::partial('header') !!}
@if (Theme::get('section-name'))
    {!! Theme::partial('breadcrumbs') !!}
@endif
<main class="main-content-wrapper">
    {!! Theme::content() !!}
</main>
{!! Theme::partial('footer') !!} 