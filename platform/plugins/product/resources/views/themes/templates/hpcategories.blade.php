@if ($categories->count() > 0)
<div class="container dpmtyc">
    @php
    $dimensions = explode('x', RvMedia::getSize('medium'));
    @endphp
    <div class="row">
        <div class="header col-lg-12 col-md-12 col-sm-12 col-12 d-flex align-items-center justify-content-center">
            <h2>
                {{ @$shortcode->title }}
            </h2>
        </div>
        <div class="desc col-lg-12 col-md-12 col-sm-12 col-12 d-flex align-items-center justify-content-center">
            {{ @$shortcode->description }}
        </div>
        <div class="line col-12 d-flex align-items-center justify-content-center">
            <span></span>
        </div>
    </div>
    <div class="row list-items mt-3">
        @foreach ($categories as $category)
        <div class="mt-4 item col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="avatar">
                <a href="{{ $category->url }}">
                    <img loading="lazy" src="{{ RvMedia::getImageUrl($category->image, 'medium', false, RvMedia::getDefaultImage()) }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" alt="{{ $category->name }}">
                </a>
                <h3 class="title">
                    <a href="{{ $category->url }}">{{ Str::upper($category->name) }}</a>
                </h3>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
