<?php

namespace Theme\VanMoc\Http\Controllers;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Product\Repositories\Interfaces\ProductInterface;
use Botble\Theme\Http\Controllers\PublicController;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Theme;

class VanMocController extends PublicController
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

    /**
     * Handle contact form submission
     *
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function sendContact(Request $request, BaseHttpResponse $response)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'content' => 'required|string|max:1000',
        ]);

        try {
            // Save to database if contact plugin is active
            if (class_exists('Botble\Contact\Models\Contact')) {
                \Botble\Contact\Models\Contact::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'content' => $request->input('content'),
                    'status' => 'unread',
                ]);
            }

            return $response
                ->setMessage(__('Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi sớm nhất có thể!'))
                ->setNextUrl(route('public.index'));
        } catch (\Exception $e) {
            return $response
                ->setError()
                ->setMessage(__('Có lỗi xảy ra. Vui lòng thử lại sau!'));
        }
    }

    /**
     * Get products page
     *
     * @param Request $request
     * @param ProductInterface $productRepository
     * @return \Illuminate\View\View
     */
    public function getProducts(Request $request, ProductInterface $productRepository)
    {
        $products = $productRepository->getAllProducts(12, true, ['slugable', 'categories', 'tags']);
        
        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('Products'), route('public.products'));

        return Theme::scope('products', compact('products'))->render();
    }
}
