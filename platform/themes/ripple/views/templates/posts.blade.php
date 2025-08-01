@php
Theme::set('section-name', $category->name);

$dimensions = explode('x', RvMedia::getSize('medium'));
@endphp
<div class="row cus-posts">
    <div class="col-lg-8 col-md-12 col-sm-12 col-12 items">
        @forelse ($posts as $post)
            <div class="page-sidebar">
                <div class="widget widget__recent-post">
                    <div class="widget__content">
                        <div class="accordion trees-categories" id="menuAccordions">
                            <article class="post post__horizontal mb-20 clearfix">
                                <div class="post__thumbnail">
                                    <a href="{{ $post->url }}">
                                        <img loading="lazy" src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                                        width="{{ @$dimensions[0] }}"
                                        height="{{ @$dimensions[1] }}"
                                        alt="{{ $post->name }}">
                                    </a>
                                </div>
                                <div class="post__content-wrap">
                                    <header class="post__header">
                                        <h3 class="post__title"><a href="{{ $post->url }}">{{ $post->name }}</a>
                                        </h3>
                                        <div class="post__meta"><span class="post__created-at"><i
                                                    class="ion-clock"></i>{{ $post->created_at->translatedFormat('M d, Y') }}</span>
                                            <span class="post-category"><i class="ion-cube"></i>
                                                @foreach ($post->categories as $cate)
                                                    <a href="{{ $cate->url }}">{{ $cate->name }}</a>
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </span>
                                        </div>
                                    </header>
                                    <div class="post__content" style="padding: 0">
                                        <p data-number-line="4">{{ Str::limit($post->description, 150) }}</p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        <div class="ml-10">
            <p>{{ __('There is no data to display!') }}</p>
        </div>
        @endforelse
        <div class="page-pagination d-flex align-items-center justify-content-center mb-5">
            {!! $posts->onEachSide(0)->links() !!}
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-12 menus">
        <div class="menu-sticky">
            @include(Theme::getThemeNamespace() . '::views.templates.category-posts', compact('categories', 'category'))
            @include(Theme::getThemeNamespace() . '::views.templates.featured-posts', [])
        </div>
    </div>
</div>

@include(Theme::getThemeNamespace() . '::views.contact-form', [])
