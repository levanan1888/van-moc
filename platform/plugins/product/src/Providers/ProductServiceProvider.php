<?php

namespace Botble\Product\Providers;

use ApiHelper;
use Botble\LanguageAdvanced\Supports\LanguageAdvancedManager;
use Botble\Shortcode\View\View;
use Illuminate\Routing\Events\RouteMatched;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Product\Models\Product;
use Botble\Product\Repositories\Caches\ProductCacheDecorator;
use Botble\Product\Repositories\Eloquent\ProductRepository;
use Botble\Product\Repositories\Interfaces\ProductInterface;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Botble\Product\Models\Category;
use Botble\Product\Repositories\Caches\CategoryCacheDecorator;
use Botble\Product\Repositories\Eloquent\CategoryRepository;
use Botble\Product\Repositories\Interfaces\CategoryInterface;
use Botble\Product\Models\Tag;
use Botble\Product\Repositories\Caches\TagCacheDecorator;
use Botble\Product\Repositories\Eloquent\TagRepository;
use Botble\Product\Repositories\Interfaces\TagInterface;
use Language;
use Note;
use SeoHelper;
use SlugHelper;

/**
 * @since 02/07/2016 09:50 AM
 */
class ProductServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(ProductInterface::class, function () {
            return new ProductCacheDecorator(new ProductRepository(new Product()));
        });

        $this->app->bind(CategoryInterface::class, function () {
            return new CategoryCacheDecorator(new CategoryRepository(new Category()));
        });

        $this->app->bind(TagInterface::class, function () {
            return new TagCacheDecorator(new TagRepository(new Tag()));
        });
    }

    public function boot()
    {
        // \Gallery::registerModule([Product::class]);
        SlugHelper::registerModule(Product::class, 'Products');
        SlugHelper::registerModule(Category::class, 'Product Categories');
        SlugHelper::registerModule(Tag::class, 'Product Tags');

        SlugHelper::setPrefix(Tag::class, 'ptag', true);
        SlugHelper::setPrefix(Product::class, null, true);
        SlugHelper::setPrefix(Category::class, null, true);

        $this->setNamespace('plugins/product')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions', 'general'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web'])
            ->loadMigrations()
            ->publishAssets();

        if (ApiHelper::enabled()) {
            $this->loadRoutes(['api']);
        }

        $this->app->register(EventServiceProvider::class);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id' => 'cms-plugins-product',
                    'priority' => 4,
                    'parent_id' => null,
                    'name' => 'plugins/product::base.menu_name',
                    'icon' => 'fa fa-camera',
                    'url' => route('products.index'),
                    'permissions' => ['products.index'],
                ])
                ->registerItem([
                    'id' => 'cms-plugins-product-products',
                    'priority' => 1,
                    'parent_id' => 'cms-plugins-product',
                    'name' => 'plugins/product::products.menu_name',
                    'icon' => 'fa fa-camera',
                    'url' => route('products.index'),
                    'permissions' => ['products.index'],
                ])
                ->registerItem([
                    'id' => 'cms-plugins-product-categories',
                    'priority' => 2,
                    'parent_id' => 'cms-plugins-product',
                    'name' => 'plugins/product::categories.menu_name',
                    'icon' => 'fa fa-tag',
                    'url' => route('pcategories.index'),
                    'permissions' => ['pcategories.index'],
                ])
                ->registerItem([
                    'id' => 'cms-plugins-product-tags',
                    'priority' => 3,
                    'parent_id' => 'cms-plugins-product',
                    'name' => 'plugins/product::tags.menu_name',
                    'icon' => 'fa fa-archive',
                    'url' => route('ptags.index'),
                    'permissions' => ['ptags.index'],
                ]);
        });

        $useLanguageV2 = $this->app['config']->get('plugins.product.general.use_language_v2', false) &&
            defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME');

        if (defined('LANGUAGE_MODULE_SCREEN_NAME') && $useLanguageV2) {
            LanguageAdvancedManager::registerModule(Product::class, [
                'name',
                'description',
                'content',
            ]);

            LanguageAdvancedManager::registerModule(Category::class, [
                'name',
                'description',
            ]);

            LanguageAdvancedManager::registerModule(Tag::class, [
                'name',
                'description',
            ]);
        }

        $this->app->booted(function () use ($useLanguageV2) {
            $models = [Product::class, Category::class, Tag::class];

            if (defined('LANGUAGE_MODULE_SCREEN_NAME') && !$useLanguageV2) {
                Language::registerModule($models);
            }

            SeoHelper::registerModule($models);

            $configKey = 'packages.revision.general.supported';
            config()->set($configKey, array_merge(config($configKey, []), [Product::class]));

            if (defined('NOTE_FILTER_MODEL_USING_NOTE')) {
                Note::registerModule(Product::class);
            }

            $this->app->register(HookServiceProvider::class);
        });

        if (function_exists('shortcode')) {
            view()->composer([
                'plugins/product::themes.product',
                'plugins/product::themes.category',
                'plugins/product::themes.tag',
            ], function (View $view) {
                $view->withShortcodes();
            });
        }
    }
}
