<?php

namespace Theme\Ripple\Http\Controllers;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Product\Repositories\Interfaces\ProductInterface;
use Botble\Theme\Http\Controllers\PublicController;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Theme;

class RippleController extends PublicController
{
    /**
     * {@inheritDoc}
     */
    public function getIndex()
    {
       
        return parent::getIndex();
    }

    /**
     * {@inheritDoc}
     */
    public function getView(string $key = null)
    {
        return parent::getView($key);
    }

    /**
     * {@inheritDoc}
     */
    public function getSiteMap()
    {
        return parent::getSiteMap();
    }

    /**
     * Search post
     *
     * @bodyParam q string required The search keyword.
     *
     * @group Blog
     *
     * @param Request $request
     * @param ProductInterface $productRepository
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     * @throws FileNotFoundException
     */
    public function getSearch(Request $request, ProductInterface $productRepository, BaseHttpResponse $response)
    {
        $query = $request->input('q');

        if (!empty($query)) {
            $products = $productRepository->getSearch($query);

            $data = [
                'items' => Theme::partial('search', compact('products')),
                'query' => $query,
                'count' => $products->count(),
            ];

            if ($data['count'] > 0) {
                return $response->setData(apply_filters(BASE_FILTER_SET_DATA_SEARCH, $data, 10, 1));
            }
        }

        return $response
            ->setError()
            ->setMessage(__('No results found, please try with different keywords.'));
    }
}
