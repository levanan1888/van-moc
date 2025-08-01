<?php

namespace Botble\Product;

use Botble\Product\Models\Category;
use Botble\Product\Models\Tag;
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
        Schema::dropIfExists('product_tags');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('pcategories');
        Schema::dropIfExists('ptags');
        Schema::dropIfExists('products_translations');
        Schema::dropIfExists('pcategories_translations');
        Schema::dropIfExists('ptags_translations');

        app(DashboardWidgetInterface::class)->deleteBy(['name' => 'widget_products_recent']);

        app(MenuNodeInterface::class)->deleteBy(['reference_type' => Category::class]);
        app(MenuNodeInterface::class)->deleteBy(['reference_type' => Tag::class]);

        Setting::query()
            ->whereIn('key', [
                'product_schema_enabled',
                'product_schema_type',
            ])
            ->delete();
    }
}
