<?php

namespace Botble\Customer\Http\Controllers\API;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Customer\Http\Resources\ListCustomerResource;
use Botble\Customer\Http\Resources\CustomerResource;
use Botble\Customer\Models\Customer;
use Botble\Customer\Repositories\Interfaces\CustomerInterface;
use Botble\Customer\Supports\FilterCustomer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use SlugHelper;

class CustomerController extends Controller
{
    /**
     * @var CustomerInterface
     */
    protected $customerRepository;

    /**
     * AuthenticationController constructor.
     *
     * @param CustomerInterface $customerRepository
     */
    public function __construct(CustomerInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * List Customers
     *
     * @group Blog
     *
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function index(Request $request, BaseHttpResponse $response)
    {
        $data = $this->customerRepository
            ->advancedGet([
                'with' => ['author', 'slugable'],
                'condition' => ['status' => BaseStatusEnum::PUBLISHED],
                'paginate' => [
                    'per_page' => (int)$request->input('per_page', 10),
                    'current_paged' => (int)$request->input('page', 1),
                ],
            ]);

        return $response
            ->setData(ListCustomerResource::collection($data))
            ->toApiResponse();
    }

    /**
     * Search Customer
     *
     * @bodyParam q string required The search keyword.
     *
     * @group Blog
     *
     * @param Request $request
     * @param CustomerInterface $customerRepository
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function getSearch(Request $request, CustomerInterface $customerRepository, BaseHttpResponse $response)
    {
        $query = $request->input('q');
        $Customers = $customerRepository->getSearch($query);

        $data = [
            'items' => $Customers,
            'query' => $query,
            'count' => $Customers->count(),
        ];

        if ($data['count'] > 0) {
            return $response->setData(apply_filters(BASE_FILTER_SET_DATA_SEARCH, $data));
        }

        return $response
            ->setError()
            ->setMessage(trans('core/base::layouts.no_search_result'));
    }

    /**
     * Filters Customers
     *
     * @group Blog
     * @queryParam page                 Current page of the collection. Default: 1
     * @queryParam per_page             Maximum number of items to be returned in result set.Default: 10
     * @queryParam search               Limit results to those matching a string.
     * @queryParam after                Limit response to Customers published after a given ISO8601 compliant date.
     * @queryParam author               Limit result set to Customers assigned to specific authors.
     * @queryParam author_exclude       Ensure result set excludes Customers assigned to specific authors.
     * @queryParam before               Limit response to Customers published before a given ISO8601 compliant date.
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
        $filters = FilterCustomer::setFilters($request->input());

        $data = $this->customerRepository->getFilters($filters);

        return $response
            ->setData(ListCustomerResource::collection($data))
            ->toApiResponse();
    }

    /**
     * Get Customer by slug
     *
     * @group Blog
     * @queryParam slug Find by slug of Customer.
     * @param string $slug
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse|JsonResponse
     */
    public function findBySlug(string $slug, BaseHttpResponse $response)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Customer::class), Customer::class);

        if (!$slug) {
            return $response->setError()->setCode(404)->setMessage('Not found');
        }

        $Customer = $this->customerRepository->getFirstBy([
            'id' => $slug->reference_id,
            'status' => BaseStatusEnum::PUBLISHED,
        ]);

        if (!$Customer) {
            return $response->setError()->setCode(404)->setMessage('Not found');
        }

        return $response
            ->setData(new CustomerResource($Customer))
            ->toApiResponse();
    }
}
