@php
    $dimensions = explode('x', RvMedia::getSize('medium'));
@endphp
<div>
    <h3>{{ $category->name }}</h3>
    {!! Theme::breadcrumb()->render() !!}
</div>
<div>
    @if ($posts->count() > 0)
        @foreach ($posts as $post)
            <article>
                <div>
                    <a href="{{ $post->url }}"><img loading="lazy" src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}" alt="{{ $post->name }}"></a>
                </div>
                <div>
                    <header>
                        <h3><a href="{{ $post->url }}">{{ $post->name }}</a></h3>
                        <div><span>{{ $post->created_at->format('M d, Y') }}</span><span>{{ $post->author->name }}</span> - <a href="{{ $category->url }}">{{ $category->name }}</a></div>
                    </header>
                    <div>
                        <p>{{ $post->description }}</p>
                    </div>
                </div>
            </article>
        @endforeach
        <div>
            {!! $posts->onEachSide(0)->links() !!}
        </div>
    @else
        <div>
            <p>{{ __('There is no data to display!') }}</p>
        </div>
    @endif
</div>
