<?php

namespace Botble\Blog\Providers;

use Assets;
use BaseHelper;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Blog\Models\Category;
use Botble\Blog\Models\Post;
use Botble\Blog\Models\Tag;
use Botble\Blog\Services\BlogService;
use Botble\Blog\Repositories\Interfaces\CategoryInterface;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Dashboard\Supports\DashboardWidgetInstance;
use Botble\Page\Models\Page;
use Botble\Page\Repositories\Interfaces\PageInterface;
use Eloquent;
use Html;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Menu;
use RvMedia;
use stdClass;
use Theme;

class HookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (defined('MENU_ACTION_SIDEBAR_OPTIONS')) {
            Menu::addMenuOptionModel(Category::class);
            Menu::addMenuOptionModel(Tag::class);
            add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions'], 2);
        }
        add_filter(DASHBOARD_FILTER_ADMIN_LIST, [$this, 'registerDashboardWidgets'], 21, 2);
        add_filter(BASE_FILTER_PUBLIC_SINGLE_DATA, [$this, 'handleSingleView'], 2);
        if (defined('PAGE_MODULE_SCREEN_NAME')) {
            add_filter(PAGE_FILTER_FRONT_PAGE_CONTENT, [$this, 'renderBlogPage'], 2, 2);
            add_filter(PAGE_FILTER_PAGE_NAME_IN_ADMIN_LIST, [$this, 'addAdditionNameToPageName'], 147, 2);
        }

        Event::listen(RouteMatched::class, function () {
            if (function_exists('admin_bar')) {
                admin_bar()->registerLink(trans('plugins/blog::posts.post'), route('posts.create'), 'add-new', 'posts.create');
            }
        });

        if (function_exists('add_shortcode')) {
            add_shortcode(
                'blog-posts',
                trans('plugins/blog::base.short_code_name'),
                trans('plugins/blog::base.short_code_description'),
                [$this, 'renderBlogPosts']
            );
            shortcode()->setAdminConfig('blog-posts', function ($attributes, $content) {
                return view('plugins/blog::partials.posts-short-code-admin-config', compact('attributes', 'content'))
                    ->render();
            });

            add_shortcode(
                'home-posts',
                trans('plugins/blog::base.short_code_home_name'),
                trans('plugins/blog::base.short_code_home_description'),
                [$this, 'renderFeaturedPosts']
            );
            shortcode()->setAdminConfig('home-posts', function ($attributes, $content) {
                return view('plugins/blog::partials.posts-home-short-code-admin-config', compact('attributes', 'content'))
                    ->render();
            });
        }

        if (function_exists('theme_option')) {
            add_action(RENDERING_THEME_OPTIONS_PAGE, [$this, 'addThemeOptions'], 35);
        }

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            add_action(BASE_ACTION_META_BOXES, [$this, 'addLanguageChooser'], 55, 2);
        }

        if (defined('THEME_FRONT_HEADER') && setting('blog_post_schema_enabled', 1)) {
            add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, function ($screen, $post) {
                add_filter(THEME_FRONT_HEADER, function ($html) use ($post) {
                    if (get_class($post) != Post::class) {
                        return $html;
                    }

                    $metadata = $post->getMetaData('seo_meta', true);
                    $category = $post->categories ? $post->categories->last() : null;
                    $categoryName = $category ? $category->name : '';
                    $stripped_content = strip_tags($post->content);

                    list ($widthLogo, $heightLogo) = get_image_dimensions(RvMedia::getImageUrl(theme_option('logo')));
                    $image = $post->image ? RvMedia::getImageUrl($post->image) : RvMedia::getImageUrl(theme_option('seo_og_image'));
                    list ($widthImage, $heightImage) = get_image_dimensions($image);

                    $schema = [
                        '@context' => 'http://schema.org',
                        '@type' => 'BlogPosting',
                        '@id' => $post->url . '#richSnippet',
                        'url' => $post->url,
                        'headline' => $metadata['seo_title'] ?? $post->name,
                        'description' => $metadata['seo_description'] ?? $post->description,
                        'alternativeHeadline' => $post->name,
                        'dateCreated' => $post->created_at->toDateString(),
                        'datePublished' => $post->created_at->toDateString(),
                        'dateModified' => $post->updated_at->toDateString(),
                        'inLanguage' => 'vi-VN',
                        'isFamilyFriendly' => 'true',
                        // 'author' => [
                        //     '@type' => 'Person',
                        //     'name' => $post->author->name ?? '',
                        //     'url' => custom_url('/'),
                        // ],
                        'publisher' => [
                            '@type' => 'Organization',
                            '@id' => custom_url('/') . '#organization',
                            'name' => theme_option('seo_title'),
                            'url' => custom_url('/'),
                            'logo' => [
                                '@type' => 'ImageObject',
                                '@id' => custom_url('/') . '#logo',
                                'url' => RvMedia::getImageUrl(theme_option('logo')),
                                'width' => $widthLogo,
                                'height' => $heightLogo
                            ]
                        ],
                        'image' => [
                            '@type' => 'ImageObject',
                            '@id' => $image,
                            'url' => $image,
                            'width' => $widthImage,
                            'height' => $heightImage,
                        ],
                        'mainEntityOfPage' => $post->url,
                        // 'keywords' => [
                        //     'keyword1',
                        //     'keyword2',
                        //     'keyword3',
                        //     'keyword4'
                        // ],
                        'articleSection' => $categoryName,
                        'articleBody' => $stripped_content
                    ];

                    return $html . Html::tag('script', json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), ['type' => 'application/ld+json'])
                        ->toHtml();
                }, 35);

                add_filter(THEME_FRONT_HEADER, function ($html) use ($post) {
                    if (get_class($post) != Post::class) {
                        return $html;
                    }

                    $crumbs = Theme::breadcrumb()->getCrumbs();
                    $items = [];
                    foreach ($crumbs as $key => $crumb) {
                        $items[] = [
                            '@type' => 'ListItem',
                            'position' => $key + 1,
                            'item' => [
                                '@type' => 'Thing',
                                '@id' => custom_url($crumb['url']),
                                'name' => $crumb['label']
                            ]
                        ];
                    }

                    $schema = [
                        '@context' => 'https://schema.org',
                        '@type' => 'BreadcrumbList',
                        '@id' => $post->url . '#breadcrumb',
                        'itemListElement' => $items
                    ];

                    return $html . Html::tag('script', json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), ['type' => 'application/ld+json'])
                        ->toHtml();
                }, 2);
            }, 35, 2);
        }

        add_filter(BASE_FILTER_AFTER_SETTING_CONTENT, [$this, 'addSettings'], 193);
    }

    public function addThemeOptions()
    {
        $pages = $this->app->make(PageInterface::class)->pluck('name', 'id', ['status' => BaseStatusEnum::PUBLISHED]);

        theme_option()
            ->setSection([
                'title' => 'Blog',
                'desc' => 'Theme options for Blog',
                'id' => 'opt-text-subsection-blog',
                'subsection' => true,
                'icon' => 'fa fa-edit',
                'fields' => [
                    [
                        'id' => 'blog_page_id',
                        'type' => 'customSelect',
                        'label' => trans('plugins/blog::base.blog_page_id'),
                        'attributes' => [
                            'name' => 'blog_page_id',
                            'list' => ['' => trans('plugins/blog::base.select')] + $pages,
                            'value' => '',
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'number_of_posts_in_a_category',
                        'type' => 'number',
                        'label' => trans('plugins/blog::base.number_posts_per_page_in_category'),
                        'attributes' => [
                            'name' => 'number_of_posts_in_a_category',
                            'value' => 12,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'number_of_posts_in_a_tag',
                        'type' => 'number',
                        'label' => trans('plugins/blog::base.number_posts_per_page_in_tag'),
                        'attributes' => [
                            'name' => 'number_of_posts_in_a_tag',
                            'value' => 12,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id' => 'number_of_posts_in_home',
                        'type' => 'number',
                        'label' => trans('plugins/blog::base.number_posts_in_home'),
                        'attributes' => [
                            'name' => 'number_of_posts_in_home',
                            'value' => 12,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                ],
            ]);
    }

    /**
     * Register sidebar options in menu
     */
    public function registerMenuOptions()
    {
        if (Auth::user()->hasPermission('categories.index')) {
            Menu::registerMenuOptions(Category::class, trans('plugins/blog::categories.menu'));
        }

        if (Auth::user()->hasPermission('tags.index')) {
            Menu::registerMenuOptions(Tag::class, trans('plugins/blog::tags.menu'));
        }
    }

    /**
     * @param array $widgets
     * @param Collection $widgetSettings
     * @return array
     */
    public function registerDashboardWidgets($widgets, $widgetSettings)
    {
        if (!Auth::user()->hasPermission('posts.index')) {
            return $widgets;
        }

        Assets::addScriptsDirectly(['/vendor/core/plugins/blog/js/blog.js']);

        return (new DashboardWidgetInstance())
            ->setPermission('posts.index')
            ->setKey('widget_posts_recent')
            ->setTitle(trans('plugins/blog::posts.widget_posts_recent'))
            ->setIcon('fas fa-edit')
            ->setColor('#f3c200')
            ->setRoute(route('posts.widget.recent-posts'))
            ->setBodyClass('scroll-table')
            ->setColumn('col-md-6 col-sm-6')
            ->init($widgets, $widgetSettings);
    }

    /**
     * @param Eloquent $slug
     * @return array|Eloquent
     */
    public function handleSingleView($slug)
    {
        return (new BlogService())->handleFrontRoutes($slug);
    }

    /**
     * @param stdClass $shortcode
     * @return array|string
     */
    public function renderBlogPosts($shortcode)
    {
        $posts = get_all_posts(true, (int) $shortcode->paginate, ['slugable', 'categories', 'categories.slugable', 'author']);

        $view = 'plugins/blog::themes.templates.posts';
        $themeView = Theme::getThemeNamespace() . '::views.templates.posts';
        if (view()->exists($themeView)) {
            $view = $themeView;
        }

        return view($view, compact('posts'))->render();
    }

    /**
     * @param stdClass $shortcode
     * @return array|string
     */
    public function renderFeaturedPosts($shortcode)
    {
        $posts = get_featured_posts((int) $shortcode->paginate, ['slugable']);
        $view = 'plugins/blog::themes.templates.hposts';
        $themeView = Theme::getThemeNamespace() . '::views.templates.hposts';
        if (view()->exists($themeView)) {
            $view = $themeView;
        }
        return view($view, compact('posts', 'shortcode'))->render();
    }

    /**
     * @param string|null $content
     * @param Page $page
     * @return array|string|null
     */
    public function renderBlogPage(?string $content, Page $page)
    {
        if ($page->id == theme_option('blog_page_id', setting('blog_page_id'))) {
            $cates = app(CategoryInterface::class)->getAllCategories(['status' => BaseStatusEnum::PUBLISHED], ['slugable']);
            $category = !empty($cates) ? $cates->first() : new Category();

            if (!empty($category->id)) {
                return redirect()->intended($category->url);
            }

            $view = 'plugins/blog::themes.loop';

            if (view()->exists(Theme::getThemeNamespace() . '::views.loop')) {
                $view = Theme::getThemeNamespace() . '::views.loop';
            }

            $categories = get_trees_categories($cates, 0);

            $allRelatedCategoryIds = array_merge([$category->id], $category->activeChildren->pluck('id')->all());
            $posts = app(PostInterface::class)
                ->getByCategory($allRelatedCategoryIds, (int) theme_option('number_of_posts_in_a_category', 12));

            Theme::breadcrumb()->add($category->name, $category->url);

            return view($view, [
                'posts' => $posts,
                'categories' => $categories,
                'category' => $category
            ])
                ->render();
        }

        return $content;
    }

    /**
     * @param string|null $name
     * @param Page $page
     * @return string|null
     */
    public function addAdditionNameToPageName(?string $name, Page $page)
    {
        if ($page->id == theme_option('blog_page_id', setting('blog_page_id'))) {
            $subTitle = Html::tag('span', trans('plugins/blog::base.blog_page'), ['class' => 'additional-page-name'])
                ->toHtml();

            if (Str::contains($name, ' —')) {
                return $name . ', ' . $subTitle;
            }

            return $name . ' —' . $subTitle;
        }

        return $name;
    }

    /**
     * @param BaseModel $model
     * @param string $priority
     * @return string
     */
    public function addLanguageChooser($priority, $model)
    {
        if ($priority == 'head' && $model instanceof Category) {
            $route = 'categories.index';

            if ($route) {
                echo view('plugins/language::partials.admin-list-language-chooser', compact('route'))->render();
            }
        }
    }

    /**
     * @param string|null $data
     * @return string
     * @throws Throwable
     */
    public function addSettings(?string $data = null): string
    {
        return $data . view('plugins/blog::settings')->render();
    }
}
