<?php

namespace Botble\Banner\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Banner\Repositories\Interfaces\BannerInterface;
use Botble\Base\Enums\BaseStatusEnum;

class BannerRepository extends RepositoriesAbstract implements BannerInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAllBanners($perPage = 12, $active = true, array $with = ['slugable'])
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
    public function getFeaturedBanners($limit, array $with = [])
    {
        $data = $this->model
            ->with($with)
            ->where([
                'status' => BaseStatusEnum::PUBLISHED,
                'is_featured' => 1,
            ])
            ->select([
                'id',
                'name',
                'link',
                'image'
            ])
            ->orderBy('order')
            ->limit($limit);

        return $this->applyBeforeExecuteQuery($data)->get();
    }
}
