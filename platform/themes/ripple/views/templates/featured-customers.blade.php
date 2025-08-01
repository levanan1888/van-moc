@php
    $featured_customers = get_featured_customers(5, ['slugable'], [$customer->id]);
    $dimensions = explode('x', RvMedia::getSize('thumb'));
@endphp
@if (@$featured_customers->count() > 0)
    <div class="row post-group__content">
        <div class="page-sidebar">
            <div class="widget widget__recent-post">
                <div class="widget__header widget__header__featured">
                    <h3 class="widget__title">{{ __('Featured customers') }}</h3>
                </div>
                <div class="widget__content widget__content__featured">
                    <ul>
                        @foreach ($featured_customers as $f_customer)
                            <li>
                                <article class="post featured_post post__widget clearfix">
                                    <div class="post__thumbnail"><img loading="lazy"
                                            src="{{ RvMedia::getImageUrl($f_customer->image, 'thumb', false, RvMedia::getDefaultImage()) }}"
                                            width="{{ @$dimensions[0] }}" height="{{ @$dimensions[1] }}"
                                            alt="{{ $f_customer->name }}">
                                        <a href="{{ $f_customer->url }}" class="post__overlay"></a>
                                    </div>
                                    <header class="post__header">
                                        <h5 class="post__title"><a href="{{ $f_customer->url }}"
                                                data-number-line="2">{{ $f_customer->name }}</a></h5>
                                        <div class="post__meta"><span
                                                class="post__created-at">{{ $f_customer->created_at->translatedFormat('M d, Y') }}</span>
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
