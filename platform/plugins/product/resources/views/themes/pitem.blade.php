@php
    $dimensions = explode('x', RvMedia::getSize('featured'));
@endphp
<div class="avatar">
    <a href="{{ $product->url }}">
        <img loading="lazy" src="{{ RvMedia::getImageUrl($product->image, 'featured', false, RvMedia::getDefaultImage()) }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}"
        alt="{{ $product->name }}">
        <span>{{ __('View detail') }}</span>
    </a>
</div>
<div class="content">
    <div class="title d-flex justify-content-center align-items-center">
        <a href="{{ $product->url }}"><h3>{{ $product->name }}</h3></a>
    </div>
    @if (@$none_contact != 'Y')
    <div class="btn">
        <a href="#" data-bs-toggle="modal" data-bs-target="#modalContact">{{ __('Contact for a quote') }}</a>
    </div>
    @endif
</div>

