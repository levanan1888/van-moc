@php
    $dimensions = explode('x', RvMedia::getSize('small'));
@endphp
<div class="avatar">
    <img loading="lazy" src="{{ RvMedia::getImageUrl($post->image, 'small', false, RvMedia::getDefaultImage()) }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}"
        alt="{{ $post->name }}"><a href="{{ $post->url }}" class=""></a>
</div>
<div class="content">
    <div class="title d-flex justify-content-center align-items-center">
        <a href="{{ $post->url }}">{{ Str::limit($post->name, 30) }}</a>
    </div>
</div>
