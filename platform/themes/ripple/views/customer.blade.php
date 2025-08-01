@php
    Theme::set('section-name', $customer->name);
    $customer->loadMissing('metadata');

    $bannerImage = $customer->getMetaData('banner_image', true);

    if ($bannerImage) {
        Theme::set('breadcrumbBannerImage', RvMedia::getImageUrl($bannerImage));
    }

@endphp

<article class="row customer customer--single">
    <div class="col-lg-8 col-md-12 col-sm-12 col-12">
        <div class="page-sidebar">
            <div class="widget widget__recent-post">
                <div class="widget__content p-4">
                    <article class="post post--single">
                        <header class="post__header">
                            <h1 class="post__title">{{ $customer->name }}</h1>
                            <div class="post__meta">
                                <span class="post__created-at"><i
                                        class="ion-clock"></i>{{ $customer->created_at->translatedFormat('M d, Y') }}</span>
                                @if ($customer->author->username)
                                    <span class="post__author"><i
                                            class="ion-android-person"></i><span>{{ $customer->author->name }}</span></span>
                                @endif
                            </div>
                        </header>
                        <div class="post__content mt-3">
                            {!! str_replace('<img', '<img loading="lazy"', BaseHelper::clean($customer->content)); !!}
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-12">
        @include(Theme::getThemeNamespace() . '::views.templates.featured-customers', [
            'customer' => $customer,
        ])
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-sidebar">
            <div class="widget widget__recent-post">
                <div class="widget__content widget__content__cus">
                    {!! do_shortcode('[contact-form title="NHẬN NGAY BÁO GIÁ" bg="1"][/contact-form]') !!}
                </div>
            </div>
        </div>
    </div>
</article>

@include(Theme::getThemeNamespace() . '::views.contact-form', [])
