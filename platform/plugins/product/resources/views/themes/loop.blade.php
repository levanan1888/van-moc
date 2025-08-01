@php
    $dimensions = explode('x', RvMedia::getSize('featured'));
@endphp
@foreach ($products as $product)
    <div>
        <article>
            <div><a href="{{ $product->url }}"></a>
                <img loading="lazy" src="{{ RvMedia::getImageUrl($product->image, 'featured', false, RvMedia::getDefaultImage()) }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" alt="{{ $product->name }}">
            </div>
            <header><a href="{{ $product->url }}"> {{ $product->name }}</a></header>
        </article>
    </div>
@endforeach

<div class="pagination">
    {!! $products->withQueryString()->onEachSide(0)->links() !!}
</div>
