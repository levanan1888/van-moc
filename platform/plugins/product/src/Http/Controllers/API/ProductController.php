<?php

namespace Botble\Product\Http\Controllers\API;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Product\Http\Resources\ListProductResource;
use Botble\Product\Http\Resources\ProductResource;
use Botble\Product\Models\Product;
use Botble\Product\Repositories\Interfaces\ProductInterface;
use Botble\Product\Supports\FilterProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use SlugHelper;

class ProductController extends Controller
{
    /**
     * @var ProductInterface
     */
    protected $productRepository;

    /**
     * AuthenticationController constructor.
     *
     * @param ProductInterface $productRepository
     */
    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * List Products
     *
     * @group Blog
     *
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function index(Request $request, BaseHttpResponse $response)
    {
        $data = $this->ProductRepository
            ->advancedGet([
                'with' => ['tags', 'categories', 'author', 'slugable'],
                'condition' => ['status' => BaseStatusEnum::PUBLISHED],
                'paginate' => [
                    'per_page' => (int)$request->input('per_page', 10),
                    'current_paged' => (int)$request->input('page', 1),
                ],
            ]);

        return $response
            ->setData(ListProductResource::collection($data))
            ->toApiResponse();
    }

    /**
     * Search Product
     *
     * @bodyParam q string required The search keyword.
     *
     * @group Blog
     *
     * @param Request $request
     * @param ProductInterface $ProductRepository
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function getSearch(Request $request, ProductInterface $productRepository, BaseHttpResponse $response)
    {
        $query = $request->input('q');
        $Products = $productRepository->getSearch($query);

        $data = [
            'items' => $products,
            'query' => $query,
            'count' => $products->count(),
        ];

        if ($data['count'] > 0) {
            return $response->setData(apply_filters(BASE_FILTER_SET_DATA_SEARCH, $data));
        }

        return $response
            ->setError()
            ->setMessage(trans('core/base::layouts.no_search_result'));
    }

    /**
     * Filters Products
     *
     * @group Blog
     * @queryParam page                 Current page of the collection. Default: 1
     * @queryParam per_page             Maximum number of items to be returned in result set.Default: 10
     * @queryParam search               Limit results to those matching a string.
     * @queryParam after                Limit response to Products published after a given ISO8601 compliant date.
     * @queryParam author               Limit result set to Products assigned to specific authors.
     * @queryParam author_exclude       Ensure result set excludes Products assigned to specific authors.
     * @queryParam before               Limit response to Products published before a given ISO8601 compliant date.
     * @queryParam exclude              Ensure result set excludes specific IDs.
     * @queryParam include              Limit result set to specific IDs.
     * @queryParam order                Order sort attribute ascending or descending. Default: desc .One of: asc, desc
     * @queryParam order_by             Sort collection by object attribute. Default: updated_at. One of: author, created_at, updated_at, id,  slug, title
     * @queryParam categories           Limit result set to all items that have the specified term assigned in the categories taxonomy.
     * @queryParam categories_exclude   Limit result set to all items except those that have the specified term assigned in the categories taxonomy.
     * @queryParam tags                 Limit result set to all items that have the specified term assigned in the tags taxonomy.
     * @queryParam tags_exclude         Limit result set to all items except those that have the specified term assigned in the tags taxonomy.
     * @queryParam featured             Limit result set to items that are sticky.
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function getFilters(Request $request, BaseHttpResponse $response)
    {
        $filters = FilterProduct::setFilters($request->input());

        $data = $this->productRepository->getFilters($filters);

        return $response
            ->setData(ListProductResource::collection($data))
            ->toApiResponse();
    }

    /**
     * Get Product by slug
     *
     * @group Blog
     * @queryParam slug Find by slug of Product.
     * @param string $slug
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse|JsonResponse
     */
    public function findBySlug(string $slug, BaseHttpResponse $response)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Product::class), Product::class);

        if (!$slug) {
            return $response->setError()->setCode(404)->setMessage('Not found');
        }

        $Product = $this->productRepository->getFirstBy([
            'id' => $slug->reference_id,
            'status' => BaseStatusEnum::PUBLISHED,
        ]);

        if (!$Product) {
            return $response->setError()->setCode(404)->setMessage('Not found');
        }

        return $response
            ->setData(new ProductResource($Product))
            ->toApiResponse();
    }
}
