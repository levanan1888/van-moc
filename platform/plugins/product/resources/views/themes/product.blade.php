@php
    $dimensions = explode('x', RvMedia::getSize('featured'));
@endphp
<div>
    <h3>{{ $product->name }}</h3>
    {!! Theme::breadcrumb()->render() !!}
</div>
<header>
    <h3>{{ $product->name }}</h3>
    <div>
        @if (!$product->categories->isEmpty())
            <span>
                <a href="{{ $product->categories->first()->url }}">{{ $product->categories->first()->name }}</a>
            </span>
        @endif
        <span>{{ $product->created_at->format('M d, Y') }}</span>

        @if (!$product->tags->isEmpty())
            <span>
                @foreach ($product->tags as $tag)
                    <a href="{{ $tag->url }}">{{ $tag->name }}</a>
                @endforeach
            </span>
        @endif
    </div>
</header>
{!! BaseHelper::clean($product->content) !!}
<br />
{!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null) !!}

@php $relatedProducts = get_related_products($product->id, 2); @endphp

@if ($relatedProducts->count())
    <footer>
        @foreach ($relatedProducts as $relatedItem)
            <div>
                <article>
                    <div><a href="{{ $relatedItem->url }}"></a>
                        <img loading="lazy" src="{{ RvMedia::getImageUrl($relatedItem->image, 'featured', false, RvMedia::getDefaultImage()) }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" alt="{{ $relatedItem->name }}">
                    </div>
                    <header><a href="{{ $relatedItem->url }}"> {{ $relatedItem->name }}</a></header>
                </article>
            </div>
        @endforeach
    </footer>
@endif
