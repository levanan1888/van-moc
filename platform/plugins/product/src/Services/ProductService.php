<?php

namespace Botble\Product\Services;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Supports\Helper;
use Botble\Product\Models\Category;
use Botble\Product\Models\Product;
use Botble\Product\Models\Tag;
use Botble\Product\Repositories\Interfaces\CategoryInterface;
use Botble\Product\Repositories\Interfaces\ProductInterface;
use Botble\Product\Repositories\Interfaces\TagInterface;
use Botble\SeoHelper\SeoOpenGraph;
use Botble\Slug\Models\Slug;
use Eloquent;
use Html;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use RvMedia;
use SeoHelper;
use Theme;

class ProductService
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
            case Product::class:
                $product = app(ProductInterface::class)
                    ->getFirstBy(
                        $condition,
                        ['*'],
                        ['categories', 'tags', 'slugable', 'categories.slugable', 'tags.slugable']
                    );

                if (empty($product)) {
                    abort(404);
                }

                $images = !empty($product->images) ? array_values(array_filter(json_decode($product->images, true))) : [];
                $slides = get_files($images, $product->video, $product->video_poster);

                Helper::handleViewCount($product, 'viewed_product');

                SeoHelper::setTitle($product->name)
                    ->setDescription($product->description);

                $meta = new SeoOpenGraph();
                if ($product->image) {
                    $meta->setImage(RvMedia::getImageUrl($product->image));
                }
                $meta->setDescription($product->description);
                $meta->setUrl($product->url);
                $meta->setTitle($product->name);
                $meta->setType('article');
                $meta->addProperty('canonical', $product->url);

                SeoHelper::setSeoOpenGraph($meta);

                if (function_exists('admin_bar') && Auth::check() && Auth::user()->hasPermission('products.edit')) {
                    admin_bar()->registerLink(
                        trans('plugins/product::products.edit_this_product'),
                        route('products.edit', $product->id),
                        null,
                        'products.edit'
                    );
                }

                Theme::breadcrumb()->add(__('Home'), route('public.index'));
                $category = $product->categories->sortByDesc('id')->first();
                if ($category) {
                    if ($category->parents->count()) {
                        foreach ($category->parents->reverse() as $parentCategory) {
                            Theme::breadcrumb()->add($parentCategory->name, $parentCategory->url);
                        }
                    }
                    Theme::breadcrumb()->add($category->name, $category->url);
                }

                $relatedProducts = app(ProductInterface::class)
                        ->getByCategory([$category->id], 8, 12, [$product->id]);

                Theme::breadcrumb()->add($product->name, $product->url);

                Theme::asset()->add('ckeditor-content-styles', 'vendor/core/core/base/libraries/ckeditor/content-styles.css');
                Theme::asset()->add('ckin-css', 'themes/'. Theme::theme()->getThemeName() .'/plugins/ckin/ckin.css');

                // Theme::asset()->container('footer')->usePath()->add('product-js', 'js/product.js', ['jquery'], [], 1);
                Theme::asset()
                    ->container('footer')
                    ->usePath(false)
                    ->add(
                        'product-js',
                        asset('vendor/core/plugins/product/js/product.js'),
                        ['jquery'],
                        [],
                        '1.0.0'
                    );
                Theme::asset()->container('footer')->usePath()->add('ckin-js', 'plugins/ckin/ckin.min.js', ['jquery'], [], 1);

                $product->content = Html::tag('div', (string)$product->content, ['class' => 'ck-content'])->toHtml();
                $product->description = Html::tag('div', (string)$product->description, ['class' => 'ck-content'])->toHtml();

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, PRODUCT_MODULE_SCREEN_NAME, $product);


                return [
                    'view' => 'product',
                    'default_view' => 'plugins/product::themes.product',
                    'data' => compact('product', 'slides', 'category', 'relatedProducts'),
                    'slug' => $product->slug,
                ];
            case Category::class:
                $category = app(CategoryInterface::class)
                    ->getFirstBy($condition, ['*'], ['slugable']);
                if (empty($category)) {
                    abort(404);
                }

                $root_category = get_root_category($category);

                $cates = app(CategoryInterface::class)->getAllCategories(['status' => BaseStatusEnum::PUBLISHED], ['slugable']);
                $tree_categories = get_trees_pcategories($cates, 0);
                if (!empty($root_category->id) && isset($tree_categories[$root_category->id])) {
                    $categories = [$tree_categories[$root_category->id]];
                } else {
                    $categories = array_values($tree_categories);
                }

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
                        trans('plugins/product::categories.edit_this_category'),
                        route('pcategories.edit', $category->id),
                        null,
                        'pcategories.edit'
                    );
                }

                $allRelatedCategoryIds = array_merge([$category->id], get_children_pcategory_ids($category));

                $products = app(ProductInterface::class)
                    ->getByCategory($allRelatedCategoryIds, (int)theme_option('number_of_products_in_a_category', 12));

                Theme::breadcrumb()->add(__('Home'), route('public.index'));

                if ($category->parents->count()) {
                    foreach ($category->parents->reverse() as $parentCategory) {
                        Theme::breadcrumb()->add($parentCategory->name, $parentCategory->url);
                    }
                }

                Theme::breadcrumb()->add($category->name, $category->url);
                //Theme::asset()->container('footer')->usePath()->add('product-js', 'js/product.js', ['jquery'], [], 1);
                Theme::asset()
                    ->container('footer')
                    ->usePath(false)
                    ->add(
                        'product-js',
                        asset('themes/ripple/js/product.js'),
                        ['jquery'],
                        [],
                        '1.0.0'
                    );
                Theme::asset()->container('footer')->usePath()->add('readmore-js', 'plugins/readmore/readmore.min.js', ['jquery'], [], 1);

                $category->description = Html::tag('div', (string)@$category->description, ['class' => 'ck-content'])->toHtml();

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, PCATEGORY_MODULE_SCREEN_NAME, $category);

                return [
                    'view' => 'pcategory',
                    'default_view' => 'plugins/product::themes.category',
                    'data' => compact('category', 'products', 'categories'),
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
                    admin_bar()->registerLink(trans('plugins/product::tags.edit_this_tag'), route('tags.edit', $tag->id), null, 'tags.edit');
                }

                $products = get_products_by_tag($tag->id, (int)theme_option('number_of_products_in_a_tag', 12));

                Theme::breadcrumb()
                    ->add(__('Home'), route('public.index'))
                    ->add($tag->name, $tag->url);

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, PTAG_MODULE_SCREEN_NAME, $tag);

                return [
                    'view' => 'ptag',
                    'default_view' => 'plugins/product::themes.tag',
                    'data' => compact('tag', 'products'),
                    'slug' => $tag->slug,
                ];
        }

        return $slug;
    }
}
