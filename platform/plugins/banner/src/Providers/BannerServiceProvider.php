<?php

namespace Botble\Banner\Providers;

use Language;
use SeoHelper;
use Botble\Banner\Models\Banner;
use Illuminate\Support\ServiceProvider;
use Botble\Banner\Repositories\Caches\BannerCacheDecorator;
use Botble\Banner\Repositories\Eloquent\BannerRepository;
use Botble\Banner\Repositories\Interfaces\BannerInterface;
use Illuminate\Support\Facades\Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

use SlugHelper;

class BannerServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(BannerInterface::class, function () {
            return new BannerCacheDecorator(new BannerRepository(new Banner));
        });

        $this->setNamespace('plugins/banner')->loadHelpers();
    }

    public function boot()
    {
        // SlugHelper::registerModule(Banner::class, 'Banners');
        // SlugHelper::setPrefix(Banner::class, null, true);

        $this->setNamespace('plugins/banner')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions', 'general'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web'])
            ->loadMigrations()
            ->publishAssets();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-banner',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/banner::banner.name',
                'icon'        => 'fa fa-list',
                'url'         => route('banner.index'),
                'permissions' => ['banner.index'],
            ]);
        });

        $useLanguageV2 = $this->app['config']->get('plugins.banner.general.use_language_v2', false) &&
            defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME');

        if (defined('LANGUAGE_MODULE_SCREEN_NAME') && $useLanguageV2) {
            LanguageAdvancedManager::registerModule(Banner::class, [
                'name',
                'description'
            ]);
        }

        $this->app->booted(function () use ($useLanguageV2) {
            $models = [Banner::class];

            if (defined('LANGUAGE_MODULE_SCREEN_NAME') && !$useLanguageV2) {
                Language::registerModule($models);
            }

            SeoHelper::registerModule($models);

            $configKey = 'packages.revision.general.supported';
            config()->set($configKey, array_merge(config($configKey, []), [Banner::class]));

            if (defined('NOTE_FILTER_MODEL_USING_NOTE')) {
                Note::registerModule(Banner::class);
            }

            $this->app->register(HookServiceProvider::class);
        });

        if (function_exists('shortcode')) {
            view()->composer([
                'plugins/customer::themes.customer'
            ], function (View $view) {
                $view->withShortcodes();
            });
        }
    }
}
