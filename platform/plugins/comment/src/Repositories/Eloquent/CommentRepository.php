<?php

namespace Botble\Comment\Repositories\Eloquent;

use Botble\Comment\Enums\CommentStatusEnum;
use Botble\Comment\Repositories\Interfaces\CommentInterface;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;

class CommentRepository extends RepositoriesAbstract implements CommentInterface
{
    /**
     * {@inheritDoc}
     */
    public function getPending($select = ['*'])
    {
        $data = $this->model
            ->where('status', CommentStatusEnum::PENDING)
            ->select($select)
            ->orderBy('created_at', 'DESC')
            ->get();

        $this->resetModel();

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function countPending()
    {
        $data = $this->model->where('status', CommentStatusEnum::PENDING)->count();
        $this->resetModel();

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function getCommentsByPostId($perPage = 50, $active = true, int $post_id)
    {
        $data = $this->model
            ->orderBy('created_at', 'asc');
        $data = $data->where('post_id', $post_id);
        if ($active) {
            $data = $data->where('status', CommentStatusEnum::APPROVED);
        }

        return $this->applyBeforeExecuteQuery($data)->paginate($perPage);
    }

}
