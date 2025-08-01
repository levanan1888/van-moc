<?php

namespace Botble\Product\Tables;

use BaseHelper;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Product\Exports\ProductExport;
use Botble\Product\Repositories\Interfaces\CategoryInterface;
use Botble\Product\Repositories\Interfaces\ProductInterface;
use Botble\Table\Abstracts\TableAbstract;
use Html;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProductTable extends TableAbstract
{
    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * @var CategoryInterface
     */
    protected $categoryRepository;

    /**
     * @var string
     */
    protected $exportClass = ProductExport::class;

    /**
     * @var int
     */
    protected $defaultSortColumn = 6;

    /**
     * ProductTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param ProductInterface $productRepository
     * @param CategoryInterface $categoryRepository
     */
    public function __construct(
        DataTables $table,
        UrlGenerator $urlGenerator,
        ProductInterface $productRepository,
        CategoryInterface $categoryRepository
    ) {
        parent::__construct($table, $urlGenerator);

        $this->repository = $productRepository;
        $this->categoryRepository = $categoryRepository;

        if (!Auth::user()->hasAnyPermission(['products.edit', 'products.destroy'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('name', function ($item) {
                if (!Auth::user()->hasPermission('products.edit')) {
                    return BaseHelper::clean($item->name);
                }

                return Html::link(route('products.edit', $item->id), BaseHelper::clean($item->name));
            })
            ->editColumn('image', function ($item) {
                return $this->displayThumbnail($item->image);
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return BaseHelper::formatDate($item->created_at);
            })
            ->editColumn('updated_at', function ($item) {
                $categories = '';
                foreach ($item->categories as $category) {
                    $categories .= Html::link(route('pcategories.edit', $category->id), $category->name) . ', ';
                }

                return rtrim($categories, ', ');
            })
            ->editColumn('author_id', function ($item) {
                return $item->author && $item->author->name ? BaseHelper::clean($item->author->name) : '&mdash;';
            })
            ->editColumn('status', function ($item) {
                if ($this->request()->input('action') === 'excel') {
                    return $item->status->getValue();
                }

                return BaseHelper::clean($item->status->toHtml());
            })
            ->addColumn('operations', function ($item) {
                return $this->getOperations('products.edit', 'products.destroy', $item);
            });

        return $this->toJson($data);
    }

    /**
     * {@inheritDoc}
     */
    public function query()
    {
        $query = $this->repository->getModel()
            ->with([
                'categories' => function ($query) {
                    $query->select(['pcategories.id', 'pcategories.name']);
                },
                'author',
            ])
            ->select([
                'id',
                'order',
                'code',
                'name',
                'image',
                'created_at',
                'status',
                'updated_at',
                'author_id',
                'author_type',
            ])->orderBy('order', 'asc')->orderBy('id', 'desc');

        return $this->applyScopes($query);
    }

    /**
     * {@inheritDoc}
     */
    public function columns(): array
    {
        return [
            'id' => [
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'order' => [
                'title' => trans('core/base::forms.order'),
                'width' => '10px',
            ],
            'code' => [
                'title' => trans('plugins/product::products.form.code'),
                'width' => '150px',
            ],
            'image' => [
                'title' => trans('core/base::tables.image'),
                'width' => '70px',
            ],
            'name' => [
                'title' => trans('core/base::tables.name'),
                'class' => 'text-start',
            ],
            'updated_at' => [
                'title' => trans('plugins/product::products.categories'),
                'width' => '150px',
                'class' => 'no-sort text-center',
                'orderable' => false,
            ],
            'author_id' => [
                'title' => trans('plugins/product::products.author'),
                'width' => '150px',
                'class' => 'no-sort text-center',
                'orderable' => false,
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
                'class' => 'text-center',
            ],
            'status' => [
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
                'class' => 'text-center',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons(): array
    {
        return $this->addCreateButton(route('products.create'), 'products.create');
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('products.deletes'), 'products.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'name' => [
                'title' => trans('core/base::tables.name'),
                'type' => 'text',
                'validate' => 'required|max:120',
            ],
            'status' => [
                'title' => trans('core/base::tables.status'),
                'type' => 'customSelect',
                'choices' => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'category' => [
                'title' => trans('plugins/product::products.category'),
                'type' => 'select-search',
                'validate' => 'required',
                'callback' => 'getCategories',
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type' => 'date',
                'validate' => 'required',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categoryRepository->pluck('name', 'id');
    }

    /**
     * {@inheritDoc}
     */
    public function applyFilterCondition($query, string $key, string $operator, ?string $value)
    {
        if ($key === 'category' && $value && !BaseHelper::isJoined($query, 'product_categories')) {
            $query = $query
                ->join('product_categories', 'product_categories.product_id', '=', 'products.id')
                ->join('pcategories', 'product_categories.category_id', '=', 'pcategories.id')
                ->select($query->getModel()->getTable() . '.*');

            return $query->where('product_categories.category_id', $value);
        }

        return parent::applyFilterCondition($query, $key, $operator, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function saveBulkChangeItem(Model $item, string $inputKey, ?string $inputValue)
    {
        if ($inputKey === 'category') {
            $item->categories()->sync([$inputValue]);

            return $item;
        }

        return parent::saveBulkChangeItem($item, $inputKey, $inputValue);
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultButtons(): array
    {
        return [
            'export',
            'reload',
        ];
    }
}
