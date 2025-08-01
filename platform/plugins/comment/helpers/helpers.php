<?php

use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\SortItemsWithChildrenHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Botble\Comment\Enums\CommentStatusEnum;
use Botble\Comment\Repositories\Interfaces\CommentInterface;
use Botble\Comment\Supports\CommentFormat;

if (!function_exists('get_comments_by_post_id')) {
    /**
     * @param boolean $active
     * @param int $perPage
     * @param array $with
     * @return Collection
     */
    function get_comments_by_post_id(
        bool $active = true,
        int $perPage = 50,
        int $post_id,
        array $with = []
    ) {
        return app(CommentInterface::class)->getCommentsByPostId($perPage, $active, $post_id);
    }
}

if (!function_exists('get_trees_comments')) {
    /**
     * @param array $args
     * @return array
     */
    function get_trees_comments($comments, int $parent_id = 0): array
    {
        $commentTree = [];
        if (!empty($comments)) {
            foreach ($comments as $comment) {
                if ($comment->parent_id === $parent_id) {
                    $children = get_trees_comments($comments, $comment->id);
                    $comment->children = $children ?? [];
                    $commentTree[] = $comment;
                }
            }
            return $commentTree;
        }
        return [];
    }
}
