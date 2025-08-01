@php
    $dimensions = explode('x', RvMedia::getSize('featured'));
@endphp
<div>
    <h3>{{ $category->name }}</h3>
    {!! Theme::breadcrumb()->render() !!}
</div>
<div>
    @if ($products->count() > 0)
        @foreach ($products as $product)
            <article>
                <div>
                    <a href="{{ $product->url }}"><img loading="lazy" src="{{ RvMedia::getImageUrl($product->image, 'featured', false, RvMedia::getDefaultImage()) }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" alt="{{ $product->name }}"></a>
                </div>
                <div>
                    <header>
                        <h3><a href="{{ $product->url }}">{{ $product->name }}</a></h3>
                        <div><span>{{ $product->created_at->format('M d, Y') }}</span><span>{{ $product->author->name }}</span> - <a href="{{ $category->url }}">{{ $category->name }}</a></div>
                    </header>
                    <div>
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
            </article>
        @endforeach
        <div>
            {!! $products->onEachSide(0)->links() !!}
        </div>
    @else
        <div>
            <p>{{ __('There is no data to display!') }}</p>
        </div>
    @endif
</div>
