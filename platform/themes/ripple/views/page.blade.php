@if (!BaseHelper::isHomepage($page->id))
    @php
        Theme::set('section-name', SeoHelper::getTitle());
        $page->loadMissing('metadata');

        $bannerImage = $page->getMetaData('banner_image', true);

        if ($bannerImage) {
            Theme::set('breadcrumbBannerImage', RvMedia::getImageUrl($bannerImage));
        }
    @endphp
    <div class="row cus-page">
        @if ($page->is_introduce_sidebar)
        <div class="col-lg-3 page-sidebar d-md-block d-none">
            <div class="widget widget__recent-post">
                <div class="widget__content p-4">
                    {!! dynamic_sidebar('introduce_sidebar') !!}
                </div>
            </div>
        </div>
        @endif
        <div class="col-lg-{{ $page->is_introduce_sidebar ? 9 : 12 }} page-sidebar">
            @if ($page->is_introduce_sidebar)
            <div class="widget widget__recent-post">
                <div class="widget__content widget__content__featured">
                    <article class="post post--single">
                        <div class="post__content p-2">
                            @if (defined('GALLERY_MODULE_SCREEN_NAME') && !empty($galleries = gallery_meta_data($page)))
                                {!! render_object_gallery($galleries) !!}
                            @endif
                            {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, BaseHelper::clean($page->content), $page) !!}
                        </div>
                    </article>
                </div>
            </div>
            @else
            <article class="post post--single">
                <div class="post__content p-2">
                    @if (defined('GALLERY_MODULE_SCREEN_NAME') && !empty($galleries = gallery_meta_data($page)))
                        {!! render_object_gallery($galleries) !!}
                    @endif
                    {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, BaseHelper::clean($page->content), $page) !!}
                </div>
            </article>
            @endif
        </div>
    </div>
@else
    @if (defined('GALLERY_MODULE_SCREEN_NAME') && !empty($galleries = gallery_meta_data($page)))
        {!! render_object_gallery($galleries) !!}
    @endif
    {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, BaseHelper::clean($page->content), $page) !!}
@endif

@include(Theme::getThemeNamespace() . '::views.contact-form', [])
