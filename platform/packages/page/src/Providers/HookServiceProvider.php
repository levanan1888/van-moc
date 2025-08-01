<?php

namespace Botble\Page\Providers;

use Botble\Base\Enums\BaseStatusEnum;
use BaseHelper;
use Botble\Dashboard\Supports\DashboardWidgetInstance;
use Botble\Page\Models\Page;
use Botble\Page\Repositories\Interfaces\PageInterface;
use Botble\Page\Services\PageService;
use Eloquent;
use Html;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Menu;
use RvMedia;
use Throwable;

class HookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (defined('MENU_ACTION_SIDEBAR_OPTIONS')) {
            Menu::addMenuOptionModel(Page::class);
            add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions'], 10);
        }

        add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'addPageStatsWidget'], 15, 2);
        add_filter(BASE_FILTER_PUBLIC_SINGLE_DATA, [$this, 'handleSingleView'], 1);

        if (function_exists('theme_option')) {
            add_action(RENDERING_THEME_OPTIONS_PAGE, [$this, 'addThemeOptions'], 31);
        }

        if (defined('THEME_FRONT_HEADER')) {
            add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, function ($screen, $page) {
                add_filter(THEME_FRONT_HEADER, function ($html) use ($page) {
                    if (get_class($page) != Page::class) {
                        return $html;
                    }

                    $banners = get_all_banners(false, 3, []);
                    if ($banners->count()) {
                        $banners = $banners->pluck('image')->map(function ($item) {
                            return RvMedia::getImageUrl($item, 'large', false, RvMedia::getDefaultImage());
                        })->toArray();
                    }

                    $social = @json_decode(theme_option('social_links'));
                    $socialLinks = [];
                    foreach ($social as $item) {
                        $link = $item[3]->value ?? '';
                        if ($link) {
                            $socialLinks[] = $link;
                        }
                    }

                    $schema = [
                        '@context' => 'https://schema.org',
                        '@type' => 'LocalBusiness',
                        '@id' => 'kg:/g/11hbjp_pnd',
                        '@name' => theme_option('seo_title'),
                        '@legalName' => 'CÔNG TY MAY ĐỒNG PHỤC PHÚ QUÝ',
                        'url' => custom_url($page->url),
                        'description' => theme_option('seo_description'),
                        'additionalType' => [
                            'https://vi.wiktionary.org/wiki/uniform',
                            'https://vi.wiktionary.org/wiki/%C4%91%E1%BB%93ng_ph%E1%BB%A5c',
                            'https://en.wikipedia.org/wiki/Uniform',
                            'https://vi.wikipedia.org/wiki/%C4%90%E1%BB%93ng_ph%E1%BB%A5c',
                            'https://www.wikidata.org/wiki/Q7434'
                        ],
                        'logo' => RvMedia::getImageUrl(theme_option('logo')),
                        'image' => $banners,
                        'priceRange' => '10,000,000 vnđ - 18,000,000,000 vnđ',
                        'hasMap' => [
                            'https://www.google.com/maps/place/C%C3%94NG+TY+MAY+%C4%90%E1%BB%92NG+PH%E1%BB%A4C+PH%C3%9A+QU%C3%9D/@10.7762523,106.6546942,17z/data=!3m1!4b1!4m6!3m5!1s0x31752ec72341a62d:0xc962d83f46c3323!8m2!3d10.7762523!4d106.6546942!16s%2Fg%2F11hbjp_pnd?entry=ttu',
                            'https://www.google.com/maps?cid=906962419726431011'
                        ],
                        'email' => theme_option('contact_email'),
                        'address' => [
                            '@type' => 'PostalAddress',
                            '@id' => custom_url('/') . '#address',
                            'streetAddress' => '299/2/45 Lý Thường Kiệt, P.15, Q.11, TPHCM',
                            'addressLocality' => 'Quận 11',
                            'addressRegion' => 'Hồ Chí Minh',
                            'addressCountry' => 'Việt Nam'
                        ],
                        'areaServed' => [
                            '@type' => 'AdministrativeArea',
                            '@id' => 'kg:/m/01crd5',
                            'name' => 'Việt Nam',
                            'url' => 'https://vi.wikipedia.org/wiki/Việt_Nam',
                            'hasMap' => 'https://www.google.com/maps?cid=12698937955444482750'
                        ],
                        'telephone' => theme_option('hotline_phone'),
                        'geo' => [
                            '@type' => 'GeoCoordinates',
                            'latitude' => 10.7762523,
                            'longitude' => 106.6546942
                        ],
                        'openingHoursSpecification' => [
                            [
                                '@type' => 'OpeningHoursSpecification',
                                'dayOfWeek' => [
                                    'Monday',
                                    'Wednesday',
                                    'Tuesday',
                                    'Thursday',
                                    'Friday'
                                ],
                                'opens' => '08:30',
                                'closes' => '17:00'
                            ]
                        ],
                        'sameAs' => $socialLinks
                    ];

                    return $html . Html::tag('script', json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), ['type' => 'application/ld+json'])
                        ->toHtml();
                }, 2);

                add_filter(THEME_FRONT_HEADER, function ($html) use ($page) {
                    if (get_class($page) != Page::class) {
                        return $html;
                    }

                    $pages = (resolve(PageInterface::class))->getDataSiteMap();
                    $homepage = null;
                    foreach ($pages as $page) {
                        if (BaseHelper::isHomepage($page->id)) {
                            $homepage = $page;
                            break;
                        }
                    }

                    list ($widthLogo, $heightLogo) = get_image_dimensions(RvMedia::getImageUrl(theme_option('logo')));
                    $image = $page->image ? RvMedia::getImageUrl($page->image) : RvMedia::getImageUrl(theme_option('seo_og_image'));
                    list ($widthImage, $heightImage) = get_image_dimensions($image);

                    $schema = [
                        '@context' => 'https://schema.org',
                        '@type' => 'NewsArticle',
                        '@id' => custom_url('/') . '#richSnippet',
                        'headline' => theme_option('site_title'),
                        'description' => theme_option('seo_description'),
                        'datePublished' => $homepage->created_at->toDateString() ?? '',
                        'dateModified' => $homepage->updated_at->toDateString() ?? '',
                        'inLanguage' => 'vi-VN',
                        'publisher' => [
                            '@type' => 'Organization',
                            '@id' => custom_url('/') . '#organization',
                            'name' => theme_option('seo_title'),
                            'url' => custom_url($page->url),
                            'logo' => [
                                '@type' => 'ImageObject',
                                '@id' => custom_url('/') . '#logo',
                                'url' => RvMedia::getImageUrl(theme_option('logo')),
                                'height' => $heightLogo,
                                'width' => $widthLogo
                            ]
                        ],
                        'image' => [
                            '@type' => 'ImageObject',
                            '@id' => $image,
                            'url' => $image,
                            'height' => $heightImage,
                            'width' => $widthImage
                        ],
                        'mainEntityOfPage' => custom_url($page->url)
                    ];

                    return $html . Html::tag('script', json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), ['type' => 'application/ld+json'])
                        ->toHtml();
                }, 2);
            }, 2, 2);
        }
    }

    public function addThemeOptions()
    {
        $pages = $this->app->make(PageInterface::class)
            ->pluck('name', 'id', ['status' => BaseStatusEnum::PUBLISHED]);

        theme_option()
            ->setSection([
                'title' => 'Page',
                'desc' => 'Theme options for Page',
                'id' => 'opt-text-subsection-page',
                'subsection' => true,
                'icon' => 'fa fa-book',
                'fields' => [
                    [
                        'id' => 'homepage_id',
                        'type' => 'customSelect',
                        'label' => trans('packages/page::pages.settings.show_on_front'),
                        'attributes' => [
                            'name' => 'homepage_id',
                            'list' => ['' => trans('packages/page::pages.settings.select')] + $pages,
                            'value' => '',
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                ],
            ]);
    }

    /**
     * Register sidebar options in menu
     * @throws Throwable
     */
    public function registerMenuOptions()
    {
        if (Auth::user()->hasPermission('pages.index')) {
            Menu::registerMenuOptions(Page::class, trans('packages/page::pages.menu'));
        }
    }

    /**
     * @param array $widgets
     * @param Collection $widgetSettings
     * @return array
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function addPageStatsWidget(array $widgets, Collection $widgetSettings): array
    {
        $pages = $this->app->make(PageInterface::class)->count(['status' => BaseStatusEnum::PUBLISHED]);

        return (new DashboardWidgetInstance())
            ->setType('stats')
            ->setPermission('pages.index')
            ->setTitle(trans('packages/page::pages.pages'))
            ->setKey('widget_total_pages')
            ->setIcon('far fa-file-alt')
            ->setColor('#32c5d2')
            ->setStatsTotal($pages)
            ->setRoute(route('pages.index'))
            ->init($widgets, $widgetSettings);
    }

    /**
     * @param Eloquent|Builder $slug
     * @return array|Eloquent
     */
    public function handleSingleView($slug)
    {
        return (new PageService())->handleFrontRoutes($slug);
    }
}
