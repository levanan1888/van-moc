<?php

namespace Botble\Banner\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface BannerInterface extends RepositoryInterface
{
    /**
     * @param int $perPage
     * @param bool $active
     * @return mixed
     */
    public function getAllBanners($perPage = 12, $active = true, array $with = ['slugable']);

    /**
     * @param int $limit
     * @param array $with
     */
    public function getFeaturedBanners($limit, array $with = []);
}
