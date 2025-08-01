<?php

namespace Botble\Comment\Providers;

use Assets;
use Botble\Comment\Enums\CommentStatusEnum;
use Botble\Comment\Repositories\Interfaces\CommentInterface;
use Html;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Theme;
use RvMedia;
use Throwable;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @throws Throwable
     */
    public function boot()
    {
        add_filter(BASE_FILTER_TOP_HEADER_LAYOUT, [$this, 'registerTopHeaderNotification'], 120);
        add_filter(BASE_FILTER_APPEND_MENU_NAME, [$this, 'getPedingCount'], 120, 2);
        add_filter(BASE_FILTER_MENU_ITEMS_COUNT, [$this, 'getMenuItemCount'], 120);

        if (function_exists('add_shortcode')) {
            add_shortcode(
                'comment-form',
                trans('plugins/comment::comment.shortcode_name'),
                trans('plugins/comment::comment.shortcode_description'),
                [$this, 'form']
            );

            shortcode()
                ->setAdminConfig('comment-form', view('plugins/comment::partials.short-code-admin-config')->render());
        }

        add_filter(BASE_FILTER_AFTER_SETTING_CONTENT, [$this, 'addSettings'], 93);
    }

    /**
     * @param string|null $options
     * @return string
     * @throws BindingResolutionException
     */
    public function registerTopHeaderNotification(?string $options): ?string
    {
        if (Auth::user()->hasPermission('comments.edit')) {
            $comments = $this->app->make(CommentInterface::class)
                ->advancedGet([
                    'condition' => [
                        'status' => CommentStatusEnum::PENDING,
                    ],
                    'paginate' => [
                        'per_page' => 10,
                        'current_paged' => 1,
                    ],
                    'select' => ['id', 'name', 'email', 'content', 'created_at'],
                    'order_by' => ['created_at' => 'DESC'],
                ]);

            if ($comments->count() == 0) {
                return $options;
            }

            return $options . view('plugins/comment::partials.notification', compact('comments'))->render();
        }

        return $options;
    }

    /**
     * @param int|null|string $number
     * @param string|null $menuId
     * @return string
     */
    public function getPedingCount($number, string $menuId)
    {
        if ($menuId == 'cms-plugins-comment') {
            $attributes = [
                'class' => 'badge badge-success menu-item-count unread-contacts',
                'style' => 'display: none;',
            ];

            return Html::tag('span', '', $attributes)->toHtml();
        }

        return $number;
    }

    /**
     * @param array $data
     * @return array
     */
    public function getMenuItemCount(array $data = []): array
    {
        if (Auth::user()->hasPermission('comments.index')) {
            $data[] = [
                'key' => 'unread-contacts',
                'value' => app(CommentInterface::class)->countPending(),
            ];
        }

        return $data;
    }

    /**
     * @param $shortcode
     * @return string
     */
    public function form($shortcode, $post_id): string
    {
        $view = apply_filters(COMMENT_FORM_TEMPLATE_VIEW, 'plugins/comment::forms.comment');

        if (defined('THEME_OPTIONS_MODULE_SCREEN_NAME')) {
            $this->app->booted(function () {
                Theme::asset()
                    ->usePath(false)
                    ->add('comment-css', asset('vendor/core/plugins/comment/css/comment-public.css'), [], [], '1.0.0');

                Theme::asset()
                    ->container('footer')
                    ->usePath(false)
                    ->add(
                        'comment-public-js',
                        asset('vendor/core/plugins/comment/js/comment-public.js'),
                        ['jquery'],
                        [],
                        '1.0.0'
                    );
            });
        }

        if ($shortcode->view && view()->exists($shortcode->view)) {
            $view = $shortcode->view;
        }

        return view($view, compact('shortcode'))->render();
    }

    /**
     * @param string|null $data
     * @return string
     * @throws Throwable
     */
    public function addSettings(?string $data = null): string
    {
        Assets::addStylesDirectly('vendor/core/core/base/libraries/tagify/tagify.css')
            ->addScriptsDirectly([
                'vendor/core/core/base/libraries/tagify/tagify.js',
                'vendor/core/core/base/js/tags.js',
            ]);

        return $data . view('plugins/comment::settings')->render();
    }
}
