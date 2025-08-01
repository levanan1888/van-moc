@php
    Theme::set('section-name', $post->name);
    $post->loadMissing('metadata');

    $bannerImage = $post->getMetaData('banner_image', true);

    if ($bannerImage) {
        Theme::set('breadcrumbBannerImage', RvMedia::getImageUrl($bannerImage));
    }
    $dimensions = explode('x', RvMedia::getSize('thumb'));
@endphp
<div class="row cus-posts">
    <div class="col-lg-8 col-md-12 col-sm-12 col-12 items">
        <div class="page-sidebar">
            <div class="widget widget__recent-post">
                <div class="widget__content widget__content__featured">
                    <article class="post post--single">
                        <header class="post__header">
                            <h1 class="post__title">{{ $post->name }}</h1>
                            <div class="post__meta">
                                @if (!$post->categories->isEmpty())
                                    <span class="post-category"><i class="ion-cube"></i>
                                        <a href="{{ $post->firstCategory->url }}">{{ $post->firstCategory->name }}</a>
                                    </span>
                                @endif
                                <span class="post__created-at"><i
                                        class="ion-clock"></i> {{ $post->created_at->translatedFormat('M d, Y') }}</span>
                                @if ($post->author->username)
                                    <span class="post__author"><i
                                            class="ion-android-person"></i><span> {{ $post->author->name }}</span></span>
                                @endif

                                @if (!$post->tags->isEmpty())
                                    @php
                                        if (is_plugin_active('language-advanced')) {
                                            $post->tags->loadMissing('translations');
                                        }
                                    @endphp
                                    <span class="post__tags"><i class="ion-pricetags"></i>
                                        @foreach ($post->tags as $tag)
                                            <a href="{{ $tag->url }}" class="me-0">{{ $tag->name }}</a>
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </span>
                                @endif
                            </div>
                        </header>
                        <div class="post__content mt-3">
                            @if (defined('GALLERY_MODULE_SCREEN_NAME') && !empty(($galleries = gallery_meta_data($post))))
                                {!! render_object_gallery($galleries, $post->first_category ? $post->first_category->name : __('Uncategorized')) !!}
                            @endif
                            {!! str_replace('<img', '<img loading="lazy"', BaseHelper::clean($post->content)); !!}
                            <div class="fb-like" data-href="{{ request()->url() }}" data-layout="standard"
                                data-action="like" data-show-faces="false" data-share="true"></div>
                        </div>
                        @php $relatedPosts = get_related_posts($post->id, 2); @endphp

                        @if ($relatedPosts->count())
                            <footer class="post__footer">
                                <div class="row">
                                    @foreach ($relatedPosts as $relatedItem)
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div
                                                class="post__relate-group @if ($loop->last) post__relate-group--right text-end @else text-start @endif">
                                                <div class="relate__title">
                                                    @if ($loop->first)
                                                        {{ __('Previous Post') }}
                                                    @else
                                                        {{ __('Next Post') }}
                                                    @endif
                                                </div>
                                                <article class="post post--related">
                                                    <div class="post__thumbnail"><a href="{{ $relatedItem->url }}"
                                                            class="post__overlay"></a>
                                                        <img loading="lazy"
                                                            src="{{ RvMedia::getImageUrl($relatedItem->image, 'thumb', false, RvMedia::getDefaultImage()) }}"
                                                            width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}"
                                                            alt="{{ $relatedItem->name }}">
                                                    </div>
                                                    <header class="post__header">
                                                        <p><a href="{{ $relatedItem->url }}" class="post__title">
                                                                {{ $relatedItem->name }}</a></p>
                                                        <div class="post__meta"><span
                                                                class="post__created-at">{{ $post->created_at->translatedFormat('M d, Y') }}</span>
                                                        </div>
                                                    </header>
                                                </article>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </footer>
                        @endif
                        <br>
                        {!! apply_filters(
                            BASE_FILTER_PUBLIC_COMMENT_AREA,
                            theme_option('facebook_comment_enabled_in_post', 'yes') == 'yes' ? Theme::partial('comments') : null,
                        ) !!}
                    </article>
                </div>
            </div>
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
