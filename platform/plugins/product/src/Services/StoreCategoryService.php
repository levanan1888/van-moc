<?php

namespace Botble\Product\Services;

use Botble\Product\Models\Product;
use Botble\Product\Services\Abstracts\StoreCategoryServiceAbstract;
use Illuminate\Http\Request;

class StoreCategoryService extends StoreCategoryServiceAbstract
{
    /**
     * @param Request $request
     * @param Product $product
     * @return mixed|void
     */
    public function execute(Request $request, Product $product)
    {
        $categories = $request->input('categories');
        if (!empty($categories) && is_array($categories)) {
            $product->categories()->sync($categories);
        }
    }
}
