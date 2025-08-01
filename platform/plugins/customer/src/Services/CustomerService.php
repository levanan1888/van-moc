<?php

namespace Botble\Customer\Services;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Supports\Helper;
use Botble\Customer\Models\Customer;
use Botble\Page\Repositories\Interfaces\PageInterface;
use Botble\Customer\Repositories\Interfaces\CustomerInterface;
use Botble\SeoHelper\SeoOpenGraph;
use Botble\Slug\Models\Slug;
use Eloquent;
use Html;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use RvMedia;
use SeoHelper;
use Theme;

class CustomerService
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
            case Customer::class:
                $customer = app(CustomerInterface::class)
                    ->getFirstBy(
                        $condition,
                        ['*'],
                        ['slugable']
                    );

                if (empty($customer)) {
                    abort(404);
                }

                Helper::handleViewCount($customer, 'viewed_customer');

                SeoHelper::setTitle($customer->name)
                    ->setDescription($customer->description);

                $meta = new SeoOpenGraph();
                if ($customer->image) {
                    $meta->setImage(RvMedia::getImageUrl($customer->image));
                }
                $meta->setDescription($customer->description);
                $meta->setUrl($customer->url);
                $meta->setTitle($customer->name);
                $meta->setType('article');
                $meta->addProperty('canonical', $customer->url);

                SeoHelper::setSeoOpenGraph($meta);

                if (function_exists('admin_bar') && Auth::check() && Auth::user()->hasPermission('customers.edit')) {
                    admin_bar()->registerLink(
                        trans('plugins/customer::customers.edit_this_customer'),
                        route('customers.edit', $customer->id),
                        null,
                        'customers.edit'
                    );
                }


                Theme::breadcrumb()->add(__('Home'), route('public.index'));

                $page = app(PageInterface::class)->getFirstBy(['id' => theme_option('customer_page_id', setting('customer_page_id'))], ['*'], ['slugable']);
                if (!empty($page->id)) {
                    Theme::breadcrumb()->add($page->name, $page->url);
                }

                Theme::breadcrumb()->add($customer->name, $customer->url);

                Theme::asset()->add('ckeditor-content-styles', 'vendor/core/core/base/libraries/ckeditor/content-styles.css');

                $customer->content = Html::tag('div', (string)$customer->content, ['class' => 'ck-content'])->toHtml();

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, CUSTOMER_MODULE_SCREEN_NAME, $customer);

                return [
                    'view' => 'customer',
                    'default_view' => 'plugins/customer::themes.customer',
                    'data' => compact('customer'),
                    'slug' => $customer->slug,
                ];
        }

        return $slug;
    }
}
