@php
    $featured_posts = get_featured_posts(5, ['slugable']);
    $dimensions = explode('x', RvMedia::getSize('thumb'));
@endphp
@if (@$featured_posts->count() > 0)
    <div class="row post-group__content">
        <div class="page-sidebar">
            <div class="widget widget__recent-post">
                <div class="widget__header widget__header__featured">
                    <div class="widget__title">{{ __('Featured posts') }}</div>
                </div>
                <div class="widget__content widget__content__featured">
                    <ul>
                        @foreach ($featured_posts as $f_post)
                            <li>
                                <article class="post featured_post post__widget clearfix">
                                    <div class="post__thumbnail"><img loading="lazy"
                                            src="{{ RvMedia::getImageUrl($f_post->image, 'thumb', false, RvMedia::getDefaultImage()) }}"
                                            width="{{ @$dimensions[0] }}"
                                            height="{{ @$dimensions[1] }}"
                                            alt="{{ $f_post->name }}">
                                        <a href="{{ $f_post->url }}" class="post__overlay"></a>
                                    </div>
                                    <header class="post__header">
                                        <h5 class="post__title"><a href="{{ $f_post->url }}"
                                                data-number-line="2">{{ $f_post->name }}</a></h5>
                                        <div class="post__meta"><span
                                                class="post__created-at">{{ $f_post->created_at->translatedFormat('M d, Y') }}</span>
                                        </div>
                                    </header>
                                </article>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
