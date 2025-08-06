<?php

namespace Botble\Product\Providers;

use Assets;
use BaseHelper;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Product\Models\Category;
use Botble\Product\Models\Product;
use Botble\Product\Models\Tag;
use Botble\Product\Services\ProductService;
use Botble\Dashboard\Supports\DashboardWidgetInstance;
use Botble\Page\Models\Page;
use Botble\Page\Repositories\Interfaces\PageInterface;
use Eloquent;
use Html;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Menu;
use RvMedia;
use stdClass;
use Theme;

class HookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (defined('MENU_ACTION_SIDEBAR_OPTIONS')) {
            Menu::addMenuOptionModel(Category::class);
            Menu::addMenuOptionModel(Tag::class);
            add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions'], 2);
        }
        // add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'registerDashboardWidgets'], 21, 2);
        add_filter(BASE_FILTER_PUBLIC_SINGLE_DATA, [$this, 'handleSingleView'], 2);
        if (defined('PAGE_MODULE_SCREEN_NAME')) {
            add_filter(PAGE_FILTER_FRONT_PAGE_CONTENT, [$this, 'renderProductPage'], 2, 2);
            add_filter(PAGE_FILTER_PAGE_NAME_IN_ADMIN_LIST, [$this, 'addAdditionNameToPageName'], 147, 2);
        }

        Event::listen(RouteMatched::class, function () {
            if (function_exists('admin_bar')) {
                admin_bar()->registerLink(trans('plugins/product::products.product'), route('products.create'), 'add-new', 'products.create');
            }
        });

        if (function_exists('add_shortcode')) {
            add_shortcode(
                'products',
                trans('plugins/product::base.short_code_name'),
                trans('plugins/product::base.short_code_description'),
                [$this, 'renderProducts']
            );
            shortcode()->setAdminConfig('products', function ($attributes, $content) {
                return view('plugins/product::partials.products-short-code-admin-config', compact('attributes', 'content'))
                    ->render();
            });

            add_shortcode(
                'home_products_categories',
                trans('plugins/product::categories.short_code_home_name'),
                trans('plugins/product::categories.short_code_home_description'),
                [$this, 'renderFeaturedCategories']
            );
            shortcode()->setAdminConfig('home_products_categories', function ($attributes, $content) {
                return view('plugins/product::partials.home-categories-short-code-admin-config', compact('attributes', 'content'))
                    ->render();
            });
        }

        if (function_exists('theme_option')) {
            add_action(RENDERING_THEME_OPTIONS_PAGE, [$this, 'addThemeOptions'], 35);
        }

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            add_action(BASE_ACTION_META_BOXES, [$this, 'addLanguageChooser'], 55, 2);
        }

        if (defined('THEME_FRONT_HEADER') && setting('product_schema_enabled', 1)) {
            add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, function ($screen, $product) {
                add_filter(THEME_FRONT_HEADER, function ($html) use ($product) {
                    if (get_class($product) != Category::class) {
                        return $html;
                    }

                    $banners = get_all_banners(false, 3, []);
                    if ($banners->count()) {
                        $banners = $banners->pluck('image')->map(function ($item) {
                            return RvMedia::getImageUrl($item, 'large', false, RvMedia::getDefaultImage());
                        })->toArray();
                    }

                    $social = [];
                    $socialLinks = [];
                    foreach ($social as $item) {
                        $link = $item[3]->value ?? '';
                        if ($link) {
                            $socialLinks[] = $link;
                        }
                    }

                    $schema = [
                        '@context' => 'http://schema.org',
                        '@type' => 'Organization',
                        'name' => theme_option('site_title'),
                        'url' => custom_url('/'),
                        'description' => theme_option('seo_description'),
                        'image' => $banners,
                        'sameAs' => $socialLinks,
                        'address' => [
                            '@type' => 'PostalAddress',
                            '@id' => custom_url('/') . '#address',
                            'streetAddress' => '299/2/45 Lý Thường Kiệt, P.15, Q.11, TPHCM',
                            'addressLocality' => 'Quận 11',
                            'addressRegion' => 'Hồ Chí Minh',
                            'addressCountry' => [
                                '@type' => 'Country',
                                'name' => 'Việt Nam'
                            ]
                        ],
                        'contactPoint' => [
                            'type' => 'ContactPoint',
                            'id' => custom_url('/') . '#contactPoint',
                            'email' => theme_option('contact_email'),
                            'telephone' => theme_option('hotline_phone'),
                            'url' => custom_url('/lien-he')
                        ],
                        'foundingDate' => $product->created_at->toDateString(),
                        'location' => [
                            '@type' => 'Place',
                            '@id' => custom_url('/') . '#location',
                            'address' => [
                                '@id' => custom_url('/') . '#address',
                            ],
                            'hasMap' => [
                                'https://www.google.com/maps/place/C%C3%94NG+TY+MAY+%C4%90%E1%BB%92NG+PH%E1%BB%A4C+PH%C3%9A+QU%C3%9D/@10.7762523,106.6546942,17z/data=!3m1!4b1!4m6!3m5!1s0x31752ec72341a62d:0xc962d83f46c3323!8m2!3d10.7762523!4d106.6546942!16s%2Fg%2F11hbjp_pnd?entry=ttu',
                                'https://www.google.com/maps?cid=906962419726431011',
                            ]
                        ]
                    ];

                    return $html . Html::tag('script', json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), ['type' => 'application/ld+json'])
                        ->toHtml();
                }, 2);

                add_filter(THEME_FRONT_HEADER, function ($html) use ($product) {
                    if (get_class($product) != Category::class) {
                        return $html;
                    }

                    $metadata = $product->getMetaData('seo_meta', true);
                    $image = $product->image ? RvMedia::getImageUrl($product->image) : RvMedia::getImageUrl(theme_option('seo_og_image'));

                    $schema = [
                        '@context' => 'http://schema.org',
                        '@type' => 'CollectionPage',
                        '@id' => $product->url . '#webpage',
                        'name' => $metadata['seo_title'] ?? $product->name,
                        'url' => $product->url,
                        'description' => $metadata['seo_description'] ?? '',
                        'image' => $image,
                        'inLanguage' => 'vi-VN',
                        'isPartOf' => [
                            '@type' => 'WebSite',
                            '@id' => custom_url('/') . '#webpage',
                            'url' => custom_url('/'),
                            'name' => theme_option('seo_title'),
                            'inLanguage' => 'vi-VN',
                            'publisher' => [
                                '@type' => 'Organization',
                                '@id' => custom_url('/') . '#organization',
                                'name' => theme_option('seo_title')
                            ]
                        ]
                    ];

                    return $html . Html::tag('script', json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), ['type' => 'application/ld+json'])
                        ->toHtml();
                }, 2);

                add_filter(THEME_FRONT_HEADER, function ($html) use ($product) {
                    if (get_class($product) != Category::class) {
                        return $html;
                    }

                    $crumbs = Theme::breadcrumb()->getCrumbs();
                    $items = [];
                    foreach ($crumbs as $key => $crumb) {
                        $items[] = [
                            '@type' => 'ListItem',
                            'position' => $key + 1,
                            'item' => [
                                '@type' => 'Thing',
                                '@id' => custom_url($crumb['url']),
                                'name' => $crumb['label']
                            ]
                        ];
                    }

                    $schema = [
                        '@context' => 'https://schema.org',
                        '@type' => 'BreadcrumbList',
                        '@id' => $product->url . '#breadcrumb',
                        'itemListElement' => $items
                    ];

                    return $html . Html::tag('script', json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), ['type' => 'application/ld+json'])
                        ->toHtml();
                }, 2);

                add_filter(THEME_FRONT_HEADER, function ($html) use ($product) {
                    if (get_class($product) != Product::class) {
                        return $html;
                    }

                    $schemaType = setting('product_schema_type', 'NewsArticle');

                    if (!in_array($schemaType, ['NewsArticle', 'News', 'Article', 'Producting'])) {
                        $schemaType = 'NewsArticle';
                    }

                    $schema = [
                        '@context' => 'https://schema.org',
                        '@type' => $schemaType,
                        'mainEntityOfPage' => [
                            '@type' => 'WebPage',
                            '@id' => $product->url,
                        ],
                        'headline' => BaseHelper::clean($product->name),
                        'description' => BaseHelper::clean($product->description),
                        'image' => [
                            '@type' => 'ImageObject',
                            'url' => RvMedia::getImageUrl($product->image, null, false, RvMedia::getDefaultImage()),
                        ],
                        'author' => [
                            '@type' => 'Person',
                            'url' => route('public.index'),
                            'name' => $product->author->name,
                        ],
                        'publisher' => [
                            '@type' => 'Organization',
                            'name' => theme_option('site_title'),
                            'logo' => [
                                '@type' => 'ImageObject',
                                'url' => RvMedia::getImageUrl(theme_option('logo')),
                            ],
                        ],
                        'datePublished' => $product->created_at->toDateString(),
                        'dateModified' => $product->updated_at->toDateString(),
                    ];

                    return $html . Html::tag('script', json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), ['type' => 'application/ld+json'])
                        ->toHtml();
                }, 35);
            }, 35, 2);
        }

        add_filter(BASE_FILTER_AFTER_SETTING_CONTENT, [$this, 'addSettings'], 193);
    }

    public function addThemeOptions()
    {
        $pages = $this->app->make(PageInterface::class)->pluck('name', 'id', ['status' => BaseStatusEnum::PUBLISHED]);

        theme_option()
            ->setSection([
                'title' => 'Product',
                'desc' => 'Theme options for Product',
                'id' => 'opt-text-subsection-product',
                'subsection' => true,
                'icon' => 'fa fa-edit',
                'fields' => [
                    [
                        'id' => 'product_page_id',
                        'type' => 'customSelect',
                        'label' => trans('plugins/product::base.product_page_id'),
                        'attributes' => [
                            'name' => 'product_page_id',
                            'list' => ['' => trans('plugins/product::base.select')] + $pages,
                            'value' => '',
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'number_of_products_in_a_category',
                        'type' => 'number',
                        'label' => trans('plugins/product::base.number_products_per_page_in_category'),
                        'attributes' => [
                            'name' => 'number_of_products_in_a_category',
                            'value' => 12,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'number_of_products_in_a_tag',
                        'type' => 'number',
                        'label' => trans('plugins/product::base.number_products_per_page_in_tag'),
                        'attributes' => [
                            'name' => 'number_of_products_in_a_tag',
                            'value' => 12,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'number_of_categories_in_home',
                        'type' => 'number',
                        'label' => trans('plugins/product::categories.number_of_categories_in_home'),
                        'attributes' => [
                            'name' => 'number_of_categories_in_home',
                            'value' => 12,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ]
                ],
            ]);
    }

    /**
     * Register sidebar options in menu
     */
    public function registerMenuOptions()
    {
        if (Auth::user()->hasPermission('pcategories.index')) {
            Menu::registerMenuOptions(Category::class, trans('plugins/product::categories.menu'));
        }

        if (Auth::user()->hasPermission('ptags.index')) {
            Menu::registerMenuOptions(Tag::class, trans('plugins/product::tags.menu'));
        }
    }

    /**
     * @param array $widgets
     * @param Collection $widgetSettings
     * @return array
     */
    public function registerDashboardWidgets($widgets, $widgetSettings)
    {
        if (!Auth::user()->hasPermission('products.index')) {
            return $widgets;
        }
        Assets::addScriptsDirectly(['/vendor/core/plugins/product/js/product.js']);

        return (new DashboardWidgetInstance())
            ->setPermission('products.index')
            ->setKey('widget_products_recent')
            ->setTitle(trans('plugins/product::products.widget_products_recent'))
            ->setIcon('fas fa-edit')
            ->setColor('#f3c200')
            ->setRoute(route('products.widget.recent-products'))
            ->setBodyClass('scroll-table')
            ->setColumn('col-md-6 col-sm-6')
            ->init($widgets, $widgetSettings);
    }

    /**
     * @param Eloquent $slug
     * @return array|Eloquent
     */
    public function handleSingleView($slug)
    {
        return (new ProductService())->handleFrontRoutes($slug);
    }

    /**
     * @param stdClass $shortcode
     * @return array|string
     */
    public function renderProducts($shortcode)
    {
        $products = get_all_products(true, (int) $shortcode->paginate, ['slugable', 'categories', 'categories.slugable', 'author']);
        $view = 'plugins/product::themes.templates.products';
        $themeView = Theme::getThemeNamespace() . '::views.templates.products';
        if (view()->exists($themeView)) {
            $view = $themeView;
        }

        return view($view, compact('products'))->render();
    }

    /**
     * @param string|null $content
     * @param Page $page
     * @return array|string|null
     */
    public function renderProductPage(?string $content, Page $page)
    {
        if ($page->id == theme_option('product_page_id', setting('product_page_id'))) {
            $view = 'plugins/product::themes.loop';

            if (view()->exists(Theme::getThemeNamespace() . '::views.product-loop')) {
                $view = Theme::getThemeNamespace() . '::views.product-loop';
            }

            return view($view, [
                'products' => get_all_products(
                    true,
                    (int) theme_option('number_of_products_in_a_category', 12),
                    ['slugable', 'categories', 'categories.slugable', 'author']
                ),
            ])
                ->render();
        }

        return $content;
    }

    /**
     * @param stdClass $shortcode
     * @return array|string
     */
    public function renderFeaturedCategories($shortcode)
    {
        $categories = get_featured_pcategories((int) $shortcode->paginate, ['slugable']);
        $view = 'plugins/product::themes.templates.hpcategories';
        $themeView = Theme::getThemeNamespace() . '::views.templates.hpcategories';
        if (view()->exists($themeView)) {
            $view = $themeView;
        }
        return view($view, compact('categories', 'shortcode'))->render();
    }

    /**
     * @param string|null $name
     * @param Page $page
     * @return string|null
     */
    public function addAdditionNameToPageName(?string $name, Page $page)
    {
        if ($page->id == theme_option('product_page_id', setting('product_page_id'))) {
            $subTitle = Html::tag('span', trans('plugins/product::base.product_page'), ['class' => 'additional-page-name'])
                ->toHtml();

            if (Str::contains($name, ' —')) {
                return $name . ', ' . $subTitle;
            }

            return $name . ' —' . $subTitle;
        }

        return $name;
    }

    /**
     * @param BaseModel $model
     * @param string $priority
     * @return string
     */
    public function addLanguageChooser($priority, $model)
    {
        if ($priority == 'head' && $model instanceof Category) {
            $route = 'pcategories.index';

            if ($route) {
                echo view('plugins/language::partials.admin-list-language-chooser', compact('route'))->render();
            }
        }
    }

    /**
     * @param string|null $data
     * @return string
     * @throws Throwable
     */
    public function addSettings(?string $data = null): string
    {
        return $data . view('plugins/product::settings')->render();
    }
}
