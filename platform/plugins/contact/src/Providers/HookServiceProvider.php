<?php

namespace Botble\Contact\Providers;

use Assets;
use Html;
use Botble\Contact\Enums\ContactStatusEnum;
use Botble\Contact\Repositories\Interfaces\ContactInterface;
use Botble\Page\Models\Page;
use Botble\Page\Repositories\Interfaces\PageInterface;
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
        add_filter(BASE_FILTER_APPEND_MENU_NAME, [$this, 'getUnreadCount'], 120, 2);
        add_filter(BASE_FILTER_MENU_ITEMS_COUNT, [$this, 'getMenuItemCount'], 120);

        if (function_exists('add_shortcode')) {
            add_shortcode(
                'contact-form',
                trans('plugins/contact::contact.shortcode_name'),
                trans('plugins/contact::contact.shortcode_description'),
                [$this, 'form']
            );

            shortcode()->setAdminConfig('contact-form', function ($attributes, $content) {
                return view('plugins/contact::partials.short-code-admin-config', compact('attributes', 'content'))
                    ->render();
            });
        }

        if (function_exists('theme_option')) {
            add_action(RENDERING_THEME_OPTIONS_PAGE, [$this, 'addThemeOptions'], 35);
        }

        add_filter(BASE_FILTER_AFTER_SETTING_CONTENT, [$this, 'addSettings'], 93);
    }

    public function addThemeOptions()
    {
        theme_option()
            ->setSection([
                'title' => 'Contact',
                'desc' => 'Theme options for Contact',
                'id' => 'opt-text-subsection-contact',
                'subsection' => true,
                'icon' => 'fa fa-edit',
                'fields' => [
                    [
                        'id' => 'contact_capacity',
                        'type' => 'number',
                        'label' => trans('plugins/contact::contact.number_of_capacity'),
                        'attributes' => [
                            'name' => 'contact_capacity',
                            'value' => '',
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'contact_extensions',
                        'type' => 'text',
                        'label' => trans('plugins/contact::contact.number_of_extensions'),
                        'attributes' => [
                            'name' => 'contact_extensions',
                            'value' => '',
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'contact_bg',
                        'type' => 'mediaImage',
                        'label' => trans('plugins/contact::contact.background'),
                        'attributes' => [
                            'name' => 'contact_bg',
                            'value' => null,
                            'attributes' => ['allow_thumb' => false],
                        ],
                    ],
                ],
            ]);
    }

    /**
     * @param string|null $options
     * @return string
     * @throws BindingResolutionException
     */
    public function registerTopHeaderNotification(?string $options): ?string
    {
        if (Auth::user()->hasPermission('contacts.edit')) {
            $contacts = $this->app->make(ContactInterface::class)
                ->advancedGet([
                    'condition' => [
                        'status' => ContactStatusEnum::UNREAD,
                    ],
                    'paginate' => [
                        'per_page' => 10,
                        'current_paged' => 1,
                    ],
                    'select' => ['id', 'name', 'email', 'phone', 'created_at'],
                    'order_by' => ['created_at' => 'DESC'],
                ]);

            if ($contacts->count() == 0) {
                return $options;
            }

            return $options . view('plugins/contact::partials.notification', compact('contacts'))->render();
        }

        return $options;
    }

    /**
     * @param int|null|string $number
     * @param string|null $menuId
     * @return string
     */
    public function getUnreadCount($number, string $menuId)
    {
        if ($menuId == 'cms-plugins-contact') {
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
        if (Auth::user()->hasPermission('contacts.index')) {
            $data[] = [
                'key' => 'unread-contacts',
                'value' => app(ContactInterface::class)->countUnread(),
            ];
        }

        return $data;
    }

    /**
     * @param $shortcode
     * @return string
     */
    public function form($shortcode): string
    {
        $view = apply_filters(CONTACT_FORM_TEMPLATE_VIEW, 'plugins/contact::forms.contact');
        if (@$shortcode->bg == 1) {
            $view = apply_filters(CONTACT_FORM_TEMPLATE_VIEW, 'plugins/contact::forms.contact-bg');
        }
        if (defined('THEME_OPTIONS_MODULE_SCREEN_NAME')) {
            $this->app->booted(function () {
                Theme::asset()
                    ->usePath(false)
                    ->add('contact-css', asset('vendor/core/plugins/contact/css/contact-public.css'), [], [], '1.0.0');

                Theme::asset()
                    ->container('footer')
                    ->usePath(false)
                    ->add(
                        'contact-public-js',
                        asset('vendor/core/plugins/contact/js/contact-public.js'),
                        ['jquery'],
                        [],
                        '1.0.0'
                    );
                //Theme::asset()->container('footer')->usePath()->add('contact-public-js', 'js/contact-public.js', ['jquery'], [], 1);
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

        return $data . view('plugins/contact::settings')->render();
    }
}
