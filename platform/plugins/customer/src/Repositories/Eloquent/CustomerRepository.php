<?php

namespace Botble\Customer\Repositories\Eloquent;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Customer\Repositories\Interfaces\CustomerInterface;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Eloquent;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;

class CustomerRepository extends RepositoriesAbstract implements CustomerInterface
{
    /**
     * {@inheritDoc}
     */
    public function getListCustomerNonInList(array $selected = [], $limit = 7, array $with = [])
    {
        $data = $this->model
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->whereNotIn('id', $selected)
            ->limit($limit)
            ->with($with)
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getByUserId($authorId, $paginate = 6)
    {
        $data = $this->model
            ->where([
                'status' => BaseStatusEnum::PUBLISHED,
                'author_id' => $authorId,
            ])
            ->with('slugable')
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->paginate($paginate);
    }

    /**
     * {@inheritDoc}
     */
    public function getDataSiteMap()
    {
        $data = $this->model
            ->with('slugable')
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getRelated($id, $limit = 3)
    {
        $data = $this->model
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->where('id', '!=', $id)
            ->limit($limit)
            ->with('slugable')
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllCustomers($perPage = 12, $active = true, array $with = ['slugable'])
    {
        $data = $this->model
            ->with($with)
            ->orderBy('created_at', 'desc');

        if ($active) {
            $data = $data->where('status', BaseStatusEnum::PUBLISHED);
        }

        return $this->applyBeforeExecuteQuery($data)->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function getFeaturedCustomers($limit, array $with = [], array $except = [])
    {
        $data = $this->model
            ->with(array_merge(['slugable'], $with))
            ->where([
                'status' => BaseStatusEnum::PUBLISHED,
                'is_featured' => 1,
            ]);
            if (!empty($except)) {
                $data = $data->whereNotIn('id', $except);
            }
            $data->select([
                'id',
                'name',
                'logo',
                'image',
                'created_at'
            ])
            ->orderBy('order')
            ->limit($limit);

        return $this->applyBeforeExecuteQuery($data)->get();
    }
}
