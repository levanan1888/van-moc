<?php

namespace Botble\Customer;

use Botble\Dashboard\Repositories\Interfaces\DashboardWidgetInterface;
use Botble\Menu\Repositories\Interfaces\MenuNodeInterface;
use Botble\Setting\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('customers');
        Schema::dropIfExists('customers_translations');

        app(DashboardWidgetInterface::class)->deleteBy(['name' => 'widget_customers_recent']);

        Setting::query()
            ->whereIn('key', [
                'customer_schema_enabled',
                'customer_schema_type',
            ])
            ->delete();
    }
}
