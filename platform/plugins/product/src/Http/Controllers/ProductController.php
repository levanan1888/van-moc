<?php

namespace Botble\Product\Http\Controllers;

use Botble\ACL\Models\User;
use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Forms\FormBuilder;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Traits\HasDeleteManyItemsTrait;
use Botble\Product\Forms\ProductForm;
use Botble\Product\Http\Requests\ProductRequest;
use Botble\Product\Models\Product;
use Botble\Product\Repositories\Interfaces\CategoryInterface;
use Botble\Product\Repositories\Interfaces\ProductInterface;
use Botble\Product\Repositories\Interfaces\TagInterface;
use Botble\Product\Services\StoreCategoryService;
use Botble\Product\Services\StoreTagService;
use Botble\Product\Tables\ProductTable;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Throwable;

class ProductController extends BaseController
{
    use HasDeleteManyItemsTrait;

    /**
     * @var ProductInterface
     */
    protected $productRepository;

    /**
     * @var TagInterface
     */
    protected $tagRepository;

    /**
     * @var CategoryInterface
     */
    protected $categoryRepository;

    /**
     * @param ProductInterface $productRepository
     * @param TagInterface $tagRepository
     * @param CategoryInterface $categoryRepository
     */
    public function __construct(
        ProductInterface $productRepository,
        TagInterface $tagRepository,
        CategoryInterface $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->tagRepository = $tagRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param ProductTable $dataTable
     * @return Factory|View
     * @throws Throwable
     */
    public function index(ProductTable $dataTable)
    {
        page_title()->setTitle(trans('plugins/product::products.menu_name'));

        return $dataTable->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/product::products.create'));

        return $formBuilder->create(ProductForm::class)->renderForm();
    }

    /**
     * @param ProductRequest $request
     * @param StoreTagService $tagService
     * @param StoreCategoryService $categoryService
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(
        ProductRequest $request,
        StoreTagService $tagService,
        StoreCategoryService $categoryService,
        BaseHttpResponse $response
    ) {
        /**
         * @var Product $product
         */
        $product = $this->productRepository->createOrUpdate(array_merge($request->input(), [
            'author_id' => Auth::id(),
            'author_type' => User::class,
        ], [
            'images' => json_encode(array_filter($request->images))
        ]));

        event(new CreatedContentEvent(PRODUCT_MODULE_SCREEN_NAME, $request, $product));

        $tagService->execute($request, $product);

        $categoryService->execute($request, $product);

        return $response
            ->setPreviousUrl(route('products.index'))
            ->setNextUrl(route('products.edit', $product->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param int $id
     * @param FormBuilder $formBuilder
     * @param Request $request
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $product = $this->productRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $product));

        page_title()->setTitle(trans('plugins/product::products.edit') . ' "' . $product->name . '"');

        return $formBuilder->create(ProductForm::class, ['model' => $product])->renderForm();
    }

    /**
     * @param int $id
     * @param ProductRequest $request
     * @param StoreTagService $tagService
     * @param StoreCategoryService $categoryService
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update(
        $id,
        ProductRequest $request,
        StoreTagService $tagService,
        StoreCategoryService $categoryService,
        BaseHttpResponse $response
    ) {
        $product = $this->productRepository->findOrFail($id);

        $product->fill($request->input());

        $this->productRepository->createOrUpdate($product);

        event(new UpdatedContentEvent(PRODUCT_MODULE_SCREEN_NAME, $request, $product));

        $tagService->execute($request, $product);

        $categoryService->execute($request, $product);

        return $response
            ->setPreviousUrl(route('products.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return BaseHttpResponse
     */
    public function destroy($id, Request $request, BaseHttpResponse $response)
    {
        try {
            $product = $this->productRepository->findOrFail($id);
            $this->productRepository->delete($product);

            event(new DeletedContentEvent(PRODUCT_MODULE_SCREEN_NAME, $request, $product));

            return $response
                ->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function deletes(Request $request, BaseHttpResponse $response)
    {
        return $this->executeDeleteItems($request, $response, $this->productRepository, PRODUCT_MODULE_SCREEN_NAME);
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Throwable
     */
    public function getWidgetRecentProducts(Request $request, BaseHttpResponse $response)
    {
        $limit = (int)$request->input('paginate', 10);
        $limit = $limit > 0 ? $limit : 10;

        $products = $this->productRepository->advancedGet([
            'with' => ['slugable'],
            'order_by' => ['created_at' => 'desc'],
            'paginate' => [
                'per_page' => $limit,
                'current_paged' => (int)$request->input('page', 1),
            ],
        ]);

        return $response
            ->setData(view('plugins/product::products.widgets.products', compact('products', 'limit'))->render());
    }
}
