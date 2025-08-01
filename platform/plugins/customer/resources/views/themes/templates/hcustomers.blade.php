@if ($customers->count() > 0)
@php
$dimensions = explode('x', RvMedia::getSize('medium'));
@endphp
<div class="container home-customer">
    <div class="">
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
    <div class="row list-items mt-2">
        @foreach ($customers as $customer)
        <div class="mt-4 item col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="avatar">
                <a href="{{ $customer->url }}">
                    <img loading="lazy" src="{{ RvMedia::getImageUrl($customer->logo, 'medium', false, RvMedia::getDefaultImage()) }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" alt="{{ $customer->name }}">
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
