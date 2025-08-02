@php Theme::layout('default'); @endphp

{!! Theme::partial('breadcrumbs') !!}

<section class="section pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="search-content">
                    <h1 class="search-title">{{ trans('plugins/blog::base.search_results_for') }}: "{{ request()->get('q') }}"</h1>
                    
                    <div class="search-results">
                        @if ($posts->count() > 0)
                            @foreach ($posts as $post)
                                <article class="post post--search">
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
                                    
                                    <div class="post__excerpt">
                                        {!! Str::limit(clean($post->description), 200) !!}
                                    </div>
                                </article>
                            @endforeach
                            
                            {!! $posts->links() !!}
                        @else
                            <p>{{ trans('plugins/blog::base.no_posts_found') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="search-sidebar">
                    {!! Theme::partial('sidebar') !!}
                </div>
            </div>
        </div>
    </div>
</section> 