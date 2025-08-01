<?php

namespace Botble\Banner\Services;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Supports\Helper;
use Botble\Banner\Models\Banner;
use Botble\Banner\Repositories\Interfaces\BannerInterface;
use Botble\SeoHelper\SeoOpenGraph;
use Botble\Slug\Models\Slug;
use Eloquent;
use Html;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use RvMedia;
use SeoHelper;
use Theme;

class BannerService
{
    /**
     * @param Slug $slug
     * @return array|Eloquent
     */
    public function handleFrontRoutes($slug)
    {
        if (!$slug instanceof Eloquent) {
            return $slug;
        }

        $condition = [
            'id' => $slug->reference_id,
            'status' => BaseStatusEnum::PUBLISHED,
        ];

        if (Auth::check() && request()->input('preview')) {
            Arr::forget($condition, 'status');
        }

        switch ($slug->reference_type) {
            case Banner::class:
                $banner = app(BannerInterface::class)
                    ->getFirstBy(
                        $condition,
                        ['*'],
                        ['slugable']
                    );

                if (empty($banner)) {
                    abort(404);
                }

                Helper::handleViewCount($customer, 'viewed_banner');

                SeoHelper::setTitle($banner->name)
                    ->setDescription($banner->description);

                $meta = new SeoOpenGraph();
                if ($banner->image) {
                    $meta->setImage(RvMedia::getImageUrl($banner->image));
                }
                $meta->setDescription($banner->description);
                $meta->setUrl($banner->url);
                $meta->setTitle($banner->name);
                $meta->setType('article');

                SeoHelper::setSeoOpenGraph($meta);

                if (function_exists('admin_bar') && Auth::check() && Auth::user()->hasPermission('banner.edit')) {
                    admin_bar()->registerLink(
                        trans('plugins/banner::banner.edit_this_banner'),
                        route('banner.edit', $customer->id),
                        null,
                        'banner.edit'
                    );
                }

                Theme::breadcrumb()->add(__('Home'), route('public.index'));

                Theme::breadcrumb()->add($banner->name, $banner->url);

                Theme::asset()->add('ckeditor-content-styles', 'vendor/core/core/base/libraries/ckeditor/content-styles.css');

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, CUSTOMER_MODULE_SCREEN_NAME, $banner);

                return [
                    'view' => 'banner',
                    'default_view' => 'plugins/banner::themes.banner',
                    'data' => compact('banner'),
                    'slug' => $banner->slug,
                ];
        }

        return $slug;
    }
}
