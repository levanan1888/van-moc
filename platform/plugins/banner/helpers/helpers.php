<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\SortItemsWithChildrenHelper;
use Botble\Banner\Repositories\Interfaces\BannerInterface;
use Botble\Banner\Supports\BannerFormat;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

if (!function_exists('get_all_banners')) {
    /**
     * @param boolean $active
     * @param int $perPage
     * @param array $with
     * @return Collection
     */
    function get_all_banners(
        bool $active = true,
        int $perPage = 12,
        array $with = ['slugable', 'author']
    ) {
        return app(BannerInterface::class)->getAllBanners($perPage, $active, $with);
    }
}

if (!function_exists('get_featured_banners')) {
    /**
     * @param int $limit
     * @param array $with
     * @return Collection
     */
    function get_featured_banners(int $limit, array $with = []) {
        return app(BannerInterface::class)->getFeaturedBanners($limit, $with);
    }
}
