@php
    $dimensions = explode('x', RvMedia::getSize('medium'));
@endphp
@foreach ($customers as $customer)
    <div>
        <article>
            <div><a href="{{ $customer->url }}"></a>
                <img loading="lazy" src="{{ RvMedia::getImageUrl($customer->image, 'medium', false, RvMedia::getDefaultImage()) }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" alt="{{ $customer->name }}">
            </div>
            <header><a href="{{ $customer->url }}"> {{ $customer->name }}</a></header>
        </article>
    </div>
@endforeach

<div class="pagination">
    {!! $customers->withQueryString()->onEachSide(0)->links() !!}
</div>
