@php Theme::layout('default'); @endphp

{!! Theme::partial('breadcrumbs') !!}

<section class="section pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="post-content">
                    <article class="post post--single">
                        <div class="post__header">
                            <h3 class="post__title">{{ $post->name }}</h3>
                            <div class="post__meta">
                                <span class="post__date">{{ $post->created_at->format('M d, Y') }}</span>
                                @if ($post->author)
                                    <span class="post__author">{{ trans('plugins/blog::base.by') }} {{ $post->author->name }}</span>
                                @endif
                            </div>
                        </div>
                        
                        @if ($post->image)
                            <div class="post__image">
                                <img src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}">
                            </div>
                        @endif
                        
                        <div class="post__content">
                            {!! clean($post->content) !!}
                        </div>
                        
                        @if ($post->tags->count() > 0)
                            <div class="post__tags">
                                <span>{{ trans('plugins/blog::base.tags') }}:</span>
                                @foreach ($post->tags as $tag)
                                    <a href="{{ $tag->url }}">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        @endif
                    </article>
                    
                    @if (theme_option('facebook_comment_enabled_in_post', 'yes') == 'yes')
                        {!! Theme::partial('facebook-integration') !!}
                    @endif
                </div>
            </div>
            <div class="col-lg-3">
                <div class="post-sidebar">
                    {!! Theme::partial('sidebar') !!}
                </div>
            </div>
        </div>
    </div>
</section> 