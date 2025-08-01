<div>
    <h3>{{ $tag->name }}</h3>
    {!! Theme::breadcrumb()->render() !!}
</div>

<div>
    @if ($products->count() > 0)
        @foreach ($products as $product)
            <article>
                <div>
                    <a href="{{ $product->url }}"><img loading="lazy" src="{{ RvMedia::getImageUrl($product->image, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}"></a>
                </div>
                <div>
                    <header>
                        <h3><a href="{{ $product->url }}">{{ $product->name }}</a></h3>
                        <div>
                            {{ $product->created_at->format('M d, Y') }} - <span>{{ $product->author->name }}</span>>
                            @if ($product->categories->first())
                                <a href="{{ $product->categories->first()->url }}">{{ $product->categories->first()->name }}</a>
                            @endif
                        </div>
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
