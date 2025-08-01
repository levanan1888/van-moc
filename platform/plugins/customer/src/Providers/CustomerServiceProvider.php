<?php

namespace Botble\Customer\Providers;

use ApiHelper;
use Botble\LanguageAdvanced\Supports\LanguageAdvancedManager;
use Botble\Shortcode\View\View;
use Illuminate\Routing\Events\RouteMatched;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Customer\Models\Customer;
use Botble\Customer\Repositories\Caches\CustomerCacheDecorator;
use Botble\Customer\Repositories\Eloquent\CustomerRepository;
use Botble\Customer\Repositories\Interfaces\CustomerInterface;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Language;
use Note;
use SeoHelper;
use SlugHelper;

/**
 * @since 02/07/2016 09:50 AM
 */
class CustomerServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(CustomerInterface::class, function () {
            return new CustomerCacheDecorator(new CustomerRepository(new Customer()));
        });
    }

    public function boot()
    {
        SlugHelper::registerModule(Customer::class, 'Customers');
        SlugHelper::setPrefix(Customer::class, null, true);

        $this->setNamespace('plugins/customer')
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
            dashboard_menu()->registerItem([
                'id' => 'cms-plugins-customer',
                'priority' => 4,
                'parent_id' => null,
                'name' => 'plugins/customer::base.menu_name',
                'icon' => 'fa fa-users',
                'url' => route('customers.index'),
                'permissions' => ['customers.index'],
            ]);
        });

        $useLanguageV2 = $this->app['config']->get('plugins.customer.general.use_language_v2', false) &&
            defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME');

        if (defined('LANGUAGE_MODULE_SCREEN_NAME') && $useLanguageV2) {
            LanguageAdvancedManager::registerModule(Customer::class, [
                'name',
                'description',
                'content',
            ]);
        }

        $this->app->booted(function () use ($useLanguageV2) {
            $models = [Customer::class];

            if (defined('LANGUAGE_MODULE_SCREEN_NAME') && !$useLanguageV2) {
                Language::registerModule($models);
            }

            SeoHelper::registerModule($models);

            $configKey = 'packages.revision.general.supported';
            config()->set($configKey, array_merge(config($configKey, []), [Customer::class]));

            if (defined('NOTE_FILTER_MODEL_USING_NOTE')) {
                Note::registerModule(Customer::class);
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
