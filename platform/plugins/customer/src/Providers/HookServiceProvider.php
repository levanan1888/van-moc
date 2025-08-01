<?php

namespace Botble\Customer\Providers;

use Assets;
use BaseHelper;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Customer\Models\Customer;
use Botble\Customer\Services\CustomerService;
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
        // add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'registerDashboardWidgets'], 21, 2);
        add_filter(BASE_FILTER_PUBLIC_SINGLE_DATA, [$this, 'handleSingleView'], 2);
        if (defined('PAGE_MODULE_SCREEN_NAME')) {
            add_filter(PAGE_FILTER_FRONT_PAGE_CONTENT, [$this, 'renderCustomerPage'], 2, 2);
            add_filter(PAGE_FILTER_PAGE_NAME_IN_ADMIN_LIST, [$this, 'addAdditionNameToPageName'], 147, 2);
        }

        Event::listen(RouteMatched::class, function () {
            if (function_exists('admin_bar')) {
                admin_bar()->registerLink(trans('plugins/customer::customers.customer'), route('customers.create'), 'add-new', 'customers.create');
            }
        });

        if (function_exists('add_shortcode')) {
            add_shortcode(
                'home_customers',
                trans('plugins/customer::base.short_code_home_name'),
                trans('plugins/customer::base.short_code_home_description'),
                [$this, 'renderFeaturedCustomers']
            );
            shortcode()->setAdminConfig('home_customers', function ($attributes, $content) {
                return view('plugins/customer::partials.customers-home-short-code-admin-config', compact('attributes', 'content'))
                    ->render();
            });
        }

        if (function_exists('theme_option')) {
            add_action(RENDERING_THEME_OPTIONS_PAGE, [$this, 'addThemeOptions'], 35);
        }

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            add_action(BASE_ACTION_META_BOXES, [$this, 'addLanguageChooser'], 55, 2);
        }

        if (defined('THEME_FRONT_HEADER') && setting('customer_schema_enabled', 1)) {
            add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, function ($screen, $customer) {
                add_filter(THEME_FRONT_HEADER, function ($html) use ($customer) {
                    if (get_class($customer) != Customer::class) {
                        return $html;
                    }

                    $schemaType = setting('customer_schema_type', 'NewsArticle');

                    if (!in_array($schemaType, ['NewsArticle', 'News', 'Article', 'Customering'])) {
                        $schemaType = 'NewsArticle';
                    }

                    $schema = [
                        '@context' => 'https://schema.org',
                        '@type' => $schemaType,
                        'mainEntityOfPage' => [
                            '@type' => 'WebPage',
                            '@id' => $customer->url,
                        ],
                        'headline' => BaseHelper::clean($customer->name),
                        'description' => BaseHelper::clean($customer->description),
                        'image' => [
                            '@type' => 'ImageObject',
                            'url' => RvMedia::getImageUrl($customer->image, null, false, RvMedia::getDefaultImage()),
                        ],
                        'logo' => [
                            '@type' => 'ImageObject',
                            'url' => RvMedia::getImageUrl($customer->logo, null, false, RvMedia::getDefaultImage()),
                        ],
                        'author' => [
                            '@type' => 'Person',
                            'url' => route('public.index'),
                            'name' => $customer->author->name,
                        ],
                        'publisher' => [
                            '@type' => 'Organization',
                            'name' => theme_option('site_title'),
                            'logo' => [
                                '@type' => 'ImageObject',
                                'url' => RvMedia::getImageUrl(theme_option('logo')),
                            ],
                        ],
                        'datePublished' => $customer->created_at->toDateString(),
                        'dateModified' => $customer->updated_at->toDateString(),
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
                'title' => 'Customer',
                'desc' => 'Theme options for Customer',
                'id' => 'opt-text-subsection-customer',
                'subsection' => true,
                'icon' => 'fa fa-edit',
                'fields' => [
                    [
                        'id' => 'customer_page_id',
                        'type' => 'customSelect',
                        'label' => trans('plugins/customer::base.customer_page_id'),
                        'attributes' => [
                            'name' => 'customer_page_id',
                            'list' => ['' => trans('plugins/customer::base.select')] + $pages,
                            'value' => '',
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'number_of_customers_in_home',
                        'type' => 'number',
                        'label' => trans('plugins/customer::base.number_customers_in_home'),
                        'attributes' => [
                            'name' => 'number_of_customers_in_home',
                            'value' => 12,
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
     */
    public function registerMenuOptions()
    {
        if (Auth::user()->hasPermission('customers.index')) {
            Menu::registerMenuOptions(Customer::class, trans('plugins/customer::customers.menu'));
        }
    }

    /**
     * @param array $widgets
     * @param Collection $widgetSettings
     * @return array
     */
    public function registerDashboardWidgets($widgets, $widgetSettings)
    {
        if (!Auth::user()->hasPermission('customers.index')) {
            return $widgets;
        }

        Assets::addScriptsDirectly(['/vendor/core/plugins/customer/js/customer.js']);

        return (new DashboardWidgetInstance())
            ->setPermission('customers.index')
            ->setKey('widget_customers_recent')
            ->setTitle(trans('plugins/customer::customers.widget_customers_recent'))
            ->setIcon('fas fa-edit')
            ->setColor('#f3c200')
            ->setRoute(route('customers.widget.recent-customers'))
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
        return (new CustomerService())->handleFrontRoutes($slug);
    }

    /**
     * @param stdClass $shortcode
     * @return array|string
     */
    public function renderCustomers($shortcode)
    {
        $customers = get_all_customers(true, (int)$shortcode->paginate, ['slugable', 'author']);
        $view = 'plugins/customer::themes.templates.customers';
        $themeView = Theme::getThemeNamespace() . '::views.templates.customers';
        if (view()->exists($themeView)) {
            $view = $themeView;
        }

        return view($view, compact('customers'))->render();
    }

    /**
     * @param stdClass $shortcode
     * @return array|string
     */
    public function renderFeaturedCustomers($shortcode)
    {
        $customers = get_featured_customers((int)$shortcode->paginate, ['slugable']);
        $view = 'plugins/customer::themes.templates.hcustomers';
        $themeView = Theme::getThemeNamespace() . '::views.templates.hcustomers';
        if (view()->exists($themeView)) {
            $view = $themeView;
        }

        return view($view, compact('customers', 'shortcode'))->render();
    }

    /**
     * @param string|null $content
     * @param Page $page
     * @return array|string|null
     */
    public function renderCustomerPage(?string $content, Page $page)
    {
        if ($page->id == theme_option('customer_page_id', setting('customer_page_id'))) {
            $view = 'plugins/customer::themes.loop';

            if (view()->exists(Theme::getThemeNamespace() . '::views.customer-loop')) {
                $view = Theme::getThemeNamespace() . '::views.customer-loop';
            }

            Theme::asset()->container('footer')->usePath()->add('customer-js', 'js/customer.js', ['jquery'], [], 1);

            return view($view, [
                'customers' => get_all_customers(
                    true,
                    (int)theme_option('number_of_customers', 12),
                    ['slugable', 'author']
                ),
            ])
                ->render();
        }

        return $content;
    }

    /**
     * @param string|null $name
     * @param Page $page
     * @return string|null
     */
    public function addAdditionNameToPageName(?string $name, Page $page)
    {
        if ($page->id == theme_option('customer_page_id', setting('customer_page_id'))) {
            $subTitle = Html::tag('span', trans('plugins/customer::base.customer_page'), ['class' => 'additional-page-name'])
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
        return $data . view('plugins/customer::settings')->render();
    }
}
