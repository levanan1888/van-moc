<?php

namespace Botble\Comment\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Comment\Repositories\Interfaces\CommentInterface;

class CommentCacheDecorator extends CacheAbstractDecorator implements CommentInterface
{
    /**
     * {@inheritDoc}
     */
    public function getPending($select = ['*'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function countPending()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function getCommentsByPostId($perPage = 50, $active = true, int $post_id)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
