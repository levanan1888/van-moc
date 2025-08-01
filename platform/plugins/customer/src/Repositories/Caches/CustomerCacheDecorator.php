<?php

namespace Botble\Customer\Repositories\Caches;

use Botble\Customer\Repositories\Interfaces\CustomerInterface;
use Botble\Support\Repositories\Caches\CacheAbstractDecorator;

class CustomerCacheDecorator extends CacheAbstractDecorator implements CustomerInterface
{
    /**
     * {@inheritDoc}
     */
    public function getListCustomerNonInList(array $selected = [], $limit = 12, array $with = [])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function getByUserId($authorId, $limit = 6)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function getDataSiteMap()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function getAllCustomers($perPage = 12, $active = true, array $with = ['slugable'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function getFeaturedCustomers($limit, array $with = [], array $except = [])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function getRelated($slug, $limit = 3)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters(array $filters)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
