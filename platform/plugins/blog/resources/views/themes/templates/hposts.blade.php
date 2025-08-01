@php
    $dimensions = explode('x', RvMedia::getSize('medium'));
@endphp
@if ($posts->count() > 0)
<div class="container home-post">
    <div class="row">
        <div class="header col-lg-12 col-md-12 col-sm-12 col-12 d-flex align-items-center justify-content-center">
            <h2>
                {{ @$shortcode->title }}
            </h2>
        </div>
        <div class="line col-12 d-flex align-items-center justify-content-center">
            <span></span>
        </div>
    </div>
    <div class="row list-items mt-2">
        @foreach ($posts as $post)
        <div class="item col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="page-sidebar">
                <div class="widget widget__recent-post">
                    <div class="widget__content p-0">
                        <div class="avatar">
                            <a href="{{ $post->url }}">
                                <img loading="lazy" src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" alt="{{ $post->name }}">
                            </a>
                        </div>
                        <div class="content p-3">
                            <h5 class="title"><a href="{{ $post->url }}">{{ $post->name }}</a></h5>
                            <div class="desc mt-1">{{ Str::limit($post->description, 80) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
