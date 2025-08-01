<?php

namespace Botble\Product\Http\Controllers;

use Botble\Product\Models\Category;
use Botble\Product\Models\Product;
use Botble\Product\Models\Tag;
use Botble\Product\Repositories\Interfaces\ProductInterface;
use Botble\Product\Services\ProductService;
use Botble\Theme\Events\RenderingSingleEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Response;
use SeoHelper;
use SlugHelper;
use Theme;

class PublicController extends Controller
{
    /**
     * @param Request $request
     * @param ProductInterface $productRepository
     * @return Response
     */
    public function getSearch(Request $request, ProductInterface $productRepository)
    {
        $query = $request->input('q');
        $title = __('Search result for: ":query"', compact('query'));
        SeoHelper::setTitle($title)
            ->setDescription($title);

        $products = empty($query) ? [] : $productRepository->getSearch($query, 0, 12);
        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add($title, route('public.product.search'));

        return Theme::scope('search', compact('products'))
            ->render();
    }

    /**
     * @param string $slug
     * @param ProductService $productService
     * @return RedirectResponse|Response
     */
    public function getTag($slug, ProductService $productService)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Tag::class));

        if (!$slug) {
            abort(404);
        }

        $data = $productService->handleFrontRoutes($slug);

        if (isset($data['slug']) && $data['slug'] !== $slug->key) {
            return redirect()->to(route('public.single', SlugHelper::getPrefix(Tag::class) . '/' . $data['slug']));
        }

        event(new RenderingSingleEvent($slug));

        return Theme::scope($data['view'], $data['data'], $data['default_view'])
            ->render();
    }

    /**
     * @param string $slug
     * @param ProductService $ProductService
     * @return RedirectResponse|Response
     */
    public function getProduct($slug, ProductService $productService)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Product::class));

        if (!$slug) {
            abort(404);
        }

        $data = $productService->handleFrontRoutes($slug);

        if (isset($data['slug']) && $data['slug'] !== $slug->key) {
            return redirect()->to(route('public.single', SlugHelper::getPrefix(Product::class) . '/' . $data['slug']));
        }

        event(new RenderingSingleEvent($slug));

        Theme::asset()->add('ckeditor-content-styles', 'vendor/core/core/base/libraries/ckeditor/content-styles.css');

        return Theme::scope($data['view'], $data['data'], $data['default_view'])
            ->render();
    }

    /**
     * @param string $slug
     * @param ProductService $ProductService
     * @return RedirectResponse|Response
     */
    public function getCategory($slug, ProductService $productService)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Category::class));

        if (!$slug) {
            abort(404);
        }

        $data = $productService->handleFrontRoutes($slug);

        if (isset($data['slug']) && $data['slug'] !== $slug->key) {
            return redirect()->to(route('public.single', SlugHelper::getPrefix(Category::class) . '/' . $data['slug']));
        }

        event(new RenderingSingleEvent($slug));

        return Theme::scope($data['view'], $data['data'], $data['default_view'])
            ->render();
    }
}
