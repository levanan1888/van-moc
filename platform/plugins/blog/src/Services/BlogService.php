<?php

namespace Botble\Blog\Services;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Supports\Helper;
use Botble\Blog\Models\Category;
use Botble\Blog\Models\Post;
use Botble\Blog\Models\Tag;
use Botble\Blog\Repositories\Interfaces\CategoryInterface;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Blog\Repositories\Interfaces\TagInterface;
use Botble\Page\Repositories\Interfaces\PageInterface;
use Botble\SeoHelper\SeoOpenGraph;
use Botble\Slug\Models\Slug;
use Eloquent;
use Html;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use RvMedia;
use SeoHelper;
use Theme;

class BlogService
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
            case Post::class:
                $post = app(PostInterface::class)
                    ->getFirstBy(
                        $condition,
                        ['*'],
                        ['categories', 'tags', 'slugable', 'categories.slugable', 'tags.slugable']
                    );

                if (empty($post)) {
                    abort(404);
                }

                Helper::handleViewCount($post, 'viewed_post');

                SeoHelper::setTitle($post->name)
                    ->setDescription($post->description);

                $meta = new SeoOpenGraph();
                if ($post->image) {
                    $meta->setImage(RvMedia::getImageUrl($post->image));
                }
                $meta->setDescription($post->description);
                $meta->setUrl($post->url);
                $meta->setTitle($post->name);
                $meta->setType('article');
                $meta->addProperty('canonical', $post->url);

                SeoHelper::setSeoOpenGraph($meta);

                if (function_exists('admin_bar') && Auth::check() && Auth::user()->hasPermission('posts.edit')) {
                    admin_bar()->registerLink(
                        trans('plugins/blog::posts.edit_this_post'),
                        route('posts.edit', $post->id),
                        null,
                        'posts.edit'
                    );
                }

                Theme::breadcrumb()->add(__('Home'), route('public.index'));

                $category = $post->categories->sortByDesc('id')->first();
                if ($category) {
                    if ($category->parents->count()) {
                        foreach ($category->parents->reverse() as $parentCategory) {
                            Theme::breadcrumb()->add($parentCategory->name, $parentCategory->url);
                        }
                    }

                    Theme::breadcrumb()->add($category->name, $category->url);
                }

                $cates = app(CategoryInterface::class)->getAllCategories(['status' => BaseStatusEnum::PUBLISHED], ['slugable']);
                $categories = get_trees_categories($cates, 0);

                Theme::breadcrumb()->add($post->name, $post->url);

                Theme::asset()->add('ckeditor-content-styles', 'vendor/core/core/base/libraries/ckeditor/content-styles.css');

                $post->content = Html::tag('div', (string)$post->content, ['class' => 'ck-content'])->toHtml();

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, POST_MODULE_SCREEN_NAME, $post);

                return [
                    'view' => 'post',
                    'default_view' => 'plugins/blog::themes.post',
                    'data' => compact('post', 'categories', 'category'),
                    'slug' => $post->slug,
                ];
            case Category::class:
                $category = app(CategoryInterface::class)
                    ->getFirstBy($condition, ['*'], ['slugable']);

                if (empty($category)) {
                    abort(404);
                }

                $page_id = theme_option('blog_page_id', setting('blog_page_id'));
                $page = app(PageInterface::class)->whereIn([$page_id], ['*'])->first();

                $cates = app(CategoryInterface::class)->getAllCategories(['status' => BaseStatusEnum::PUBLISHED], ['slugable']);
                $categories = get_trees_categories($cates, 0);

                SeoHelper::setTitle($category->name)
                    ->setDescription($category->description);

                $meta = new SeoOpenGraph();
                if ($category->image) {
                    $meta->setImage(RvMedia::getImageUrl($category->image));
                }
                $meta->setDescription($category->description);
                $meta->setUrl($category->url);
                $meta->setTitle($category->name);
                $meta->setType('article');
                $meta->addProperty('canonical', $category->url);

                SeoHelper::setSeoOpenGraph($meta);

                if (function_exists('admin_bar')) {
                    admin_bar()->registerLink(
                        trans('plugins/blog::categories.edit_this_category'),
                        route('categories.edit', $category->id),
                        null,
                        'categories.edit'
                    );
                }

                $allRelatedCategoryIds = array_merge([$category->id], get_children_category_ids($category));

                $posts = app(PostInterface::class)
                    ->getByCategory($allRelatedCategoryIds, (int)theme_option('number_of_posts_in_a_category', 12));

                /**
                 * ADD BREADCRUMB
                 */
                Theme::breadcrumb()->add(__('Home'), route('public.index'));

                if (!empty($page)) {
                    Theme::breadcrumb()->add($page->name, $page->url);
                }

                if ($category->parents->count()) {
                    foreach ($category->parents->reverse() as $parentCategory) {
                        Theme::breadcrumb()->add($parentCategory->name, $parentCategory->url);
                    }
                }

                Theme::breadcrumb()->add($category->name, $category->url);

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, CATEGORY_MODULE_SCREEN_NAME, $category);

                return [
                    'view' => 'category',
                    'default_view' => 'plugins/blog::themes.category',
                    'data' => compact('category', 'posts', 'categories'),
                    'filter' => '',
                    'slug' => $category->slug,
                ];
            case Tag::class:
                $tag = app(TagInterface::class)->getFirstBy($condition, ['*'], ['slugable']);

                if (!$tag) {
                    abort(404);
                }

                SeoHelper::setTitle($tag->name)
                    ->setDescription($tag->description);

                $meta = new SeoOpenGraph();
                $meta->setDescription($tag->description);
                $meta->setUrl($tag->url);
                $meta->setTitle($tag->name);
                $meta->setType('article');

                if (function_exists('admin_bar')) {
                    admin_bar()->registerLink(trans('plugins/blog::tags.edit_this_tag'), route('tags.edit', $tag->id), null, 'tags.edit');
                }

                $posts = get_posts_by_tag($tag->id, (int)theme_option('number_of_posts_in_a_tag', 12));

                Theme::breadcrumb()
                    ->add(__('Home'), route('public.index'))
                    ->add($tag->name, $tag->url);

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, TAG_MODULE_SCREEN_NAME, $tag);

                return [
                    'view' => 'tag',
                    'default_view' => 'plugins/blog::themes.tag',
                    'data' => compact('tag', 'posts'),
                    'slug' => $tag->slug,
                ];
        }

        return $slug;
    }
}
