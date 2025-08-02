@php Theme::layout('default'); @endphp

{!! Theme::partial('breadcrumbs') !!}

<section class="section pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="tag-content">
                    <h1>{{ trans('plugins/blog::base.tag') }}: {{ $tag->name }}</h1>
                    
                    <div class="tag-posts">
                        @foreach ($posts as $post)
                            <article class="post post--tag">
                                <div class="post__header">
                                    <h3 class="post__title">
                                        <a href="{{ $post->url }}">{{ $post->name }}</a>
                                    </h3>
                                    <div class="post__meta">
                                        <span class="post__date">{{ $post->created_at->format('M d, Y') }}</span>
                                        @if ($post->author)
                                            <span class="post__author">{{ trans('plugins/blog::base.by') }} {{ $post->author->name }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                @if ($post->image)
                                    <div class="post__image">
                                        <a href="{{ $post->url }}">
                                            <img src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}">
                                        </a>
                                    </div>
                                @else
                                    <div class="post__image">
                                        <a href="{{ $post->url }}">
                                            <img src="{{ RvMedia::getImageUrl(RvMedia::getDefaultImage(), 'medium') }}" alt="{{ $post->name }}">
                                        </a>
                                    </div>
                                @endif
                                
                                <div class="post__excerpt">
                                    {!! Str::limit(clean($post->description), 200) !!}
                                </div>
                            </article>
                        @endforeach
                    </div>
                    
                    {!! $posts->links() !!}
                </div>
            </div>
            <div class="col-lg-3">
                <div class="tag-sidebar">
                    {!! Theme::partial('sidebar') !!}
                </div>
            </div>
        </div>
    </div>
</section> 