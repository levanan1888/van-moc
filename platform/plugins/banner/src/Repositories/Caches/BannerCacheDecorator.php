<?php

namespace Botble\Banner\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Banner\Repositories\Interfaces\BannerInterface;

class BannerCacheDecorator extends CacheAbstractDecorator implements BannerInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAllBanners($perPage = 12, $active = true, array $with = ['slugable'])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritDoc}
     */
    public function getFeaturedBanners($limit, array $with = [])
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
