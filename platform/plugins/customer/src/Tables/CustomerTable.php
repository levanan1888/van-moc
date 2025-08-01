<?php

namespace Botble\Customer\Tables;

use BaseHelper;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Customer\Exports\CustomerExport;
use Botble\Customer\Repositories\Interfaces\CustomerInterface;
use Botble\Table\Abstracts\TableAbstract;
use Html;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CustomerTable extends TableAbstract
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
     * @var string
     */
    protected $exportClass = CustomerExport::class;

    /**
     * @var int
     */
    protected $defaultSortColumn = 6;

    /**
     * CustomerTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param CustomerInterface $customerRepository
     */
    public function __construct(
        DataTables $table,
        UrlGenerator $urlGenerator,
        CustomerInterface $customerRepository
    ) {
        parent::__construct($table, $urlGenerator);

        $this->repository = $customerRepository;

        if (!Auth::user()->hasAnyPermission(['customers.edit', 'customers.destroy'])) {
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
                if (!Auth::user()->hasPermission('customers.edit')) {
                    return BaseHelper::clean($item->name);
                }

                return Html::link(route('customers.edit', $item->id), BaseHelper::clean($item->name));
            })
            ->editColumn('is_featured', function ($item) {
                return $item->is_featured ? 'Y' : '';
            })
            ->editColumn('logo', function ($item) {
                return $this->displayThumbnail($item->logo);
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return BaseHelper::formatDate($item->created_at);
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
                return $this->getOperations('customers.edit', 'customers.destroy', $item);
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
                'author',
            ])
            ->select([
                'id',
                'name',
                'is_featured',
                'logo',
                'image',
                'created_at',
                'status',
                'updated_at',
                'author_id',
                'author_type',
            ]);

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
            'logo' => [
                'title' => trans('plugins/customer::customers.form.logo'),
                'width' => '150px',
            ],
            'name' => [
                'title' => trans('core/base::tables.name'),
                'class' => 'text-start',
            ],
            'is_featured' => [
                'title' => trans('core/base::forms.is_featured'),
                'class' => 'text-start',
            ],
            'updated_at' => [
                'title' => trans('core/base::tables.updated_at'),
                'width' => '150px',
                'class' => 'no-sort text-center',
                'orderable' => false,
            ],
            'author_id' => [
                'title' => trans('plugins/customer::customers.author'),
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
        return $this->addCreateButton(route('customers.create'), 'customers.create');
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('customers.deletes'), 'customers.destroy', parent::bulkActions());
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
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type' => 'date',
                'validate' => 'required',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function applyFilterCondition($query, string $key, string $operator, ?string $value)
    {
        return parent::applyFilterCondition($query, $key, $operator, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function saveBulkChangeItem(Model $item, string $inputKey, ?string $inputValue)
    {
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
