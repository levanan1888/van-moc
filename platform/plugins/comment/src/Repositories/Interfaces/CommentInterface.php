<?php

namespace Botble\Comment\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface CommentInterface extends RepositoryInterface
{
    /**
     * @param array $select
     * @return mixed
     */
    public function getPending($select = ['*']);

    /**
     * @return int
     */
    public function countPending();

    /**
     * @param int $perPage
     * @param bool $active
     * @param int $post_id
     * @return mixed
     */
    public function getCommentsByPostId($perPage = 50, $active = true, int $post_id);
}
