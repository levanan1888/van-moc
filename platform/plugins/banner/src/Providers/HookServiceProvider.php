<?php

namespace Botble\Banner\Providers;

use Assets;
use BaseHelper;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Banner\Models\Banner;
use Botble\Banner\Services\BannerService;
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
            add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions'], 2);
        }
        add_filter(BASE_FILTER_PUBLIC_SINGLE_DATA, [$this, 'handleSingleView'], 2);
        if (defined('PAGE_MODULE_SCREEN_NAME')) {
            add_filter(PAGE_FILTER_PAGE_NAME_IN_ADMIN_LIST, [$this, 'addAdditionNameToPageName'], 147, 2);
        }

        Event::listen(RouteMatched::class, function () {
            if (function_exists('admin_bar')) {
                admin_bar()->registerLink(trans('plugins/banner::banner.banner'), route('banner.create'), 'add-new', 'banner.create');
            }
        });

        if (function_exists('add_shortcode')) {
            add_shortcode(
                'featured-banners',
                trans('plugins/banner::banner.short_code_name'),
                trans('plugins/banner::banner.short_code_description'),
                [$this, 'renderFeaturedBanners']
            );
            shortcode()->setAdminConfig('featured-banners', function ($attributes, $content) {
                return view('plugins/banner::partials.banners-featured-short-code-admin-config', compact('attributes', 'content'))
                    ->render();
            });
        }

        if (function_exists('theme_option')) {
            add_action(RENDERING_THEME_OPTIONS_PAGE, [$this, 'addThemeOptions'], 35);
        }

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            add_action(BASE_ACTION_META_BOXES, [$this, 'addLanguageChooser'], 55, 2);
        }

        if (defined('THEME_FRONT_HEADER') && setting('banner_schema_enabled', 1)) {
            add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, function ($screen, $banner) {
                add_filter(THEME_FRONT_HEADER, function ($html) use ($banner) {
                    if (get_class($banner) != Banner::class) {
                        return $html;
                    }

                    $schemaType = setting('banner_schema_type', 'NewsArticle');

                    if (!in_array($schemaType, ['NewsArticle', 'News', 'Article', 'Bannering'])) {
                        $schemaType = 'NewsArticle';
                    }

                    $schema = [
                        '@context' => 'https://schema.org',
                        '@type' => $schemaType,
                        'mainEntityOfPage' => [
                            '@type' => 'WebPage',
                            '@id' => $banner->url,
                        ],
                        'headline' => BaseHelper::clean($banner->name),
                        'description' => BaseHelper::clean($banner->description),
                        'image' => [
                            '@type' => 'ImageObject',
                            'url' => RvMedia::getImageUrl($banner->image, null, false, RvMedia::getDefaultImage()),
                        ],
                        'author' => [
                            '@type' => 'Person',
                            'url' => route('public.index'),
                            'name' => $banner->author->name,
                        ],
                        'publisher' => [
                            '@type' => 'Organization',
                            'name' => theme_option('site_title'),
                            'logo' => [
                                '@type' => 'ImageObject',
                                'url' => RvMedia::getImageUrl(theme_option('logo')),
                            ],
                        ],
                        'datePublished' => $banner->created_at->toDateString(),
                        'dateModified' => $banner->updated_at->toDateString(),
                    ];

                    return $html . Html::tag('script', json_encode($schema), ['type' => 'application/ld+json'])
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
                'title' => 'Banner',
                'desc' => 'Theme options for Banner',
                'id' => 'opt-text-subsection-banner',
                'subsection' => true,
                'icon' => 'fa fa-edit',
                'fields' => [
                    [
                        'id' => 'banner_page_id',
                        'type' => 'customSelect',
                        'label' => trans('plugins/banner::banner.banner_page_id'),
                        'attributes' => [
                            'name' => 'banner_page_id',
                            'list' => ['' => trans('plugins/banner::banner.select')] + $pages,
                            'value' => '',
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
        if (Auth::user()->hasPermission('banner.index')) {
            Menu::registerMenuOptions(Banner::class, trans('plugins/banner::banner.menu'));
        }
    }

    /**
     * @param Eloquent $slug
     * @return array|Eloquent
     */
    public function handleSingleView($slug)
    {
        return (new BannerService())->handleFrontRoutes($slug);
    }

    /**
     * @param stdClass $shortcode
     * @return array|string
     */
    public function renderBanner($shortcode)
    {
        $banners = get_all_banners(true, (int)$shortcode->paginate, ['slugable', 'author']);
        $view = 'plugins/banner::themes.templates.banners';
        $themeView = Theme::getThemeNamespace() . '::views.templates.banners';
        if (view()->exists($themeView)) {
            $view = $themeView;
        }

        return view($view, compact('banners'))->render();
    }

    /**
     * @param stdClass $shortcode
     * @return array|string
     */
    public function renderFeaturedBanners($shortcode)
    {
        $banners = get_featured_banners((int)$shortcode->paginate, []);
        $view = 'plugins/banner::themes.templates.hbanners';
        $themeView = Theme::getThemeNamespace() . '::views.templates.hbanners';
        if (view()->exists($themeView)) {
            $view = $themeView;
        }
        return view($view, compact('banners'))->render();
    }

    /**
     * @param string|null $name
     * @param Page $page
     * @return string|null
     */
    public function addAdditionNameToPageName(?string $name, Page $page)
    {
        if ($page->id == theme_option('banner_page_id', setting('banner_page_id'))) {
            $subTitle = Html::tag('span', trans('plugins/banner::banner.banner_page'), ['class' => 'additional-page-name'])
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
            $route = 'banner.index';

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
        return $data . view('plugins/banner::settings')->render();
    }
}
