<?php

namespace Botble\Comment\Tables;

use BaseHelper;
use Botble\Comment\Exports\CommentExport;
use Html;
use Illuminate\Support\Facades\Auth;
use Botble\Comment\Enums\CommentStatusEnum;
use Botble\Comment\Repositories\Interfaces\CommentInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CommentTable extends TableAbstract
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
    protected $exportClass = CommentExport::class;

    /**
     * ContactTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param ContactInterface $commentRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, CommentInterface $commentRepository)
    {
        parent::__construct($table, $urlGenerator);

        $this->repository = $commentRepository;

        if (!Auth::user()->hasAnyPermission(['comments.edit', 'comments.destroy'])) {
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
                if (!Auth::user()->hasPermission('comments.edit')) {
                    return $item->name;
                }

                return Html::link(route('comments.edit', $item->id), $item->name);
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return BaseHelper::formatDate($item->created_at);
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            })
            ->addColumn('operations', function ($item) {
                return $this->getOperations('comments.edit', 'comments.destroy', $item);
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
            'post' => function ($query) {
                $query->select(['post.id', 'post.name']);
            },
            'author',
        ])
        ->select([
            'id',
            'name',
            'content',
            'parent_id',
            'post_id',
            'email',
            'created_at',
            'status'
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
            'name' => [
                'title' => trans('core/base::tables.name'),
                'class' => 'text-start',
            ],
            'email' => [
                'title' => trans('plugins/comment::comment.tables.email'),
                'class' => 'text-start',
            ],
            'content' => [
                'title' => trans('plugins/comment::comment.tables.content'),
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status' => [
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('comments.deletes'), 'comments.destroy', parent::bulkActions());
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
            'email' => [
                'title' => trans('core/base::tables.email'),
                'type' => 'text',
                'validate' => 'required|max:120',
            ],
            'content' => [
                'title' => trans('plugins/comment::comment.content'),
                'type' => 'text',
                'validate' => 'required|max:120',
            ],
            'status' => [
                'title' => trans('core/base::tables.status'),
                'type' => 'customSelect',
                'choices' => CommentStatusEnum::labels(),
                'validate' => 'required|' . Rule::in(CommentStatusEnum::values()),
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type' => 'date',
            ],
        ];
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
