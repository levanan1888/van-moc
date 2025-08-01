@php
    $dimensions = explode('x', RvMedia::getSize('small'));
@endphp
<div>
    <h3>{{ $post->name }}</h3>
    {!! Theme::breadcrumb()->render() !!}
</div>
<header>
    <h3>{{ $post->name }}</h3>
    <div>
        @if (!$post->categories->isEmpty())
            <span>
                <a href="{{ $post->categories->first()->url }}">{{ $post->categories->first()->name }}</a>
            </span>
        @endif
        <span>{{ $post->created_at->format('M d, Y') }}</span>

        @if (!$post->tags->isEmpty())
            <span>
                @foreach ($post->tags as $tag)
                    <a href="{{ $tag->url }}">{{ $tag->name }}</a>
                @endforeach
            </span>
        @endif
    </div>
</header>
{!! BaseHelper::clean($post->content) !!}
<br />
{!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null) !!}

@php $relatedPosts = get_related_posts($post->id, 2); @endphp

@if ($relatedPosts->count())
    <footer>
        @foreach ($relatedPosts as $relatedItem)
            <div>
                <article>
                    <div><a href="{{ $relatedItem->url }}"></a>
                        <img loading="lazy" src="{{ RvMedia::getImageUrl($relatedItem->image, 'small', false, RvMedia::getDefaultImage()) }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" alt="{{ $relatedItem->name }}">
                    </div>
                    <header><a href="{{ $relatedItem->url }}"> {{ $relatedItem->name }}</a></header>
                </article>
            </div>
        @endforeach
    </footer>
@endif
