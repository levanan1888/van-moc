<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\SortItemsWithChildrenHelper;
use Botble\Product\Repositories\Interfaces\CategoryInterface;
use Botble\Product\Repositories\Interfaces\ProductInterface;
use Botble\Product\Repositories\Interfaces\TagInterface;
use Botble\Product\Supports\ProductFormat;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

if (!function_exists('get_featured_products')) {
    /**
     * @param int $limit
     * @param array $with
     * @return Collection
     */
    function get_featured_products(int $limit, array $with = []): Collection
    {
        return app(ProductInterface::class)->getFeatured($limit, $with);
    }
}

if (!function_exists('get_latest_products')) {
    /**
     * @param int $limit
     * @param array $excepts
     * @param array $with
     * @return Collection
     */
    function get_latest_products(int $limit, array $excepts = [], array $with = []): Collection
    {
        return app(ProductInterface::class)->getListProductNonInList($excepts, $limit, $with);
    }
}

if (!function_exists('get_related_products')) {
    /**
     * @param int $id
     * @param int $limit
     * @return Collection
     */
    function get_related_products(int $id, int $limit): Collection
    {
        return app(ProductInterface::class)->getRelated($id, $limit);
    }
}

if (!function_exists('get_products_by_category')) {
    /**
     * @param int $categoryId
     * @param int $paginate
     * @param int $limit
     * @return Collection
     */
    function get_products_by_category(int $categoryId, int $paginate = 12, int $limit = 0)
    {
        return app(ProductInterface::class)->getByCategory($categoryId, $paginate, $limit);
    }
}

if (!function_exists('get_products_by_tag')) {
    /**
     * @param string $slug
     * @param int $paginate
     * @return Collection
     */
    function get_products_by_tag(string $slug, int $paginate = 12)
    {
        return app(ProductInterface::class)->getByTag($slug, $paginate);
    }
}

if (!function_exists('get_products_by_user')) {
    /**
     * @param int $authorId
     * @param int $paginate
     * @return Collection
     */
    function get_products_by_user(int $authorId, int $paginate = 12)
    {
        return app(ProductInterface::class)->getByUserId($authorId, $paginate);
    }
}

if (!function_exists('get_all_products')) {
    /**
     * @param boolean $active
     * @param int $perPage
     * @param array $with
     * @return Collection
     */
    function get_all_products(
        bool $active = true,
        int $perPage = 12,
        array $with = ['slugable', 'pcategories', 'pcategories.slugable', 'author']
    ) {
        return app(ProductInterface::class)->getAllProducts($perPage, $active, $with);
    }
}

if (!function_exists('get_recent_products')) {
    /**
     * @param int $limit
     * @return Collection
     */
    function get_recent_products(int $limit)
    {
        return app(ProductInterface::class)->getRecentProducts($limit);
    }
}

if (!function_exists('get_featured_pcategories')) {
    /**
     * @param int $limit
     * @param array $with
     * @return Collection
     */
    function get_featured_pcategories(int $limit, array $with = [])
    {
        return app(CategoryInterface::class)->getFeaturedCategories($limit, $with);
    }
}

if (!function_exists('get_all_pcategories')) {
    /**
     * @param array $condition
     * @param array $with
     * @return Collection
     */
    function get_all_pcategories(array $condition = [], array $with = [])
    {
        return app(CategoryInterface::class)->getAllCategories($condition, $with);
    }
}

if (!function_exists('get_all_ptags')) {
    /**
     * @param boolean $active
     * @return Collection
     */
    function get_all_ptags(bool $active = true)
    {
        return app(TagInterface::class)->getAllTags($active);
    }
}

if (!function_exists('get_popular_ptags')) {
    /**
     * @param int $limit
     * @param array|string[] $with
     * @param array $withCount
     * @return Collection
     */
    function get_popular_ptags(int $limit = 10, array $with = ['slugable'], array $withCount = ['products'])
    {
        return app(TagInterface::class)->getPopularTags($limit, $with, $withCount);
    }
}

if (!function_exists('get_popular_products')) {
    /**
     * @param integer $limit
     * @param array $args
     * @return Collection
     */
    function get_popular_products(int $limit = 10, array $args = [])
    {
        return app(ProductInterface::class)->getPopularProducts($limit, $args);
    }
}

if (!function_exists('get_popular_pcategories')) {
    /**
     * @param integer $limit
     * @param array $with
     * @param array $withCount
     * @return Collection
     */
    function get_popular_pcategories(int $limit = 10, array $with = ['slugable'], array $withCount = ['products'])
    {
        return app(CategoryInterface::class)->getPopularCategories($limit, $with, $withCount);
    }
}

if (!function_exists('get_pcategory_by_id')) {
    /**
     * @param integer $id
     * @return BaseModel|null
     */
    function get_pcategory_by_id(int $id): ?BaseModel
    {
        return app(CategoryInterface::class)->getCategoryById($id);
    }
}

if (!function_exists('get_pcategories')) {
    /**
     * @param array $args
     * @return array
     */
    function get_pcategories(array $args = []): array
    {
        $indent = Arr::get($args, 'indent', '——');

        $repo = app(CategoryInterface::class);

        $categories = $repo->getCategories(Arr::get($args, 'select', ['*']), [
            'created_at' => 'DESC',
            'is_default' => 'DESC',
            'order' => 'ASC',
        ]);

        $categories = sort_item_with_children($categories);

        foreach ($categories as $category) {
            $depth = (int)$category->depth;
            $indentText = str_repeat($indent, $depth);
            $category->indent_text = $indentText;
        }

        return $categories;
    }
}

if (!function_exists('get_pcategories_with_children')) {
    /**
     * @return Collection
     * @throws Exception
     */
    function get_pcategories_with_children()
    {
        $categories = app(CategoryInterface::class)
            ->getAllCategoriesWithChildren(['status' => BaseStatusEnum::PUBLISHED], [], ['id', 'name', 'parent_id']);

        return app(SortItemsWithChildrenHelper::class)
            ->setChildrenProperty('child_cats')
            ->setItems($categories)
            ->sort();
    }
}

if (!function_exists('get_trees_pcategories')) {
    /**
     * @param array $args
     * @return array
     */
    function get_trees_pcategories($categories, int $parent_id = 0): array
    {
        $categoryTree = [];
        if (!empty($categories)) {
            foreach ($categories as $category) {
                if ($category->parent_id === $parent_id) {
                    $children = get_trees_categories($categories, $category->id);
                    $category->children = $children ?? [];
                    if ($category->parent_id == 0) {
                        $categoryTree[$category->id] = $category;
                    } else {
                        $categoryTree[] = $category;
                    }
                }
            }
            return $categoryTree;
        }
        return [];
    }
}

if (!function_exists('register_product_format')) {
    /**
     * @param array $formats
     * @return void
     */
    function register_product_format(array $formats)
    {
        ProductFormat::registerProductFormat($formats);
    }
}

if (!function_exists('get_product_formats')) {
    /**
     * @param bool $convertToList
     * @return array
     */
    function get_product_formats(bool $convertToList = false): array
    {
        return ProductFormat::getProductFormats($convertToList);
    }
}

if (!function_exists('get_product_page_id')) {
    /**
     * @return int
     */
    function get_product_page_id(): int
    {
        return (int)theme_option('product_page_id', setting('product_page_id'));
    }
}

if (!function_exists('get_product_page_url')) {
    /**
     * @return string
     */
    function get_product_page_url(): string
    {
        $blogPageId = (int)theme_option('product_page_id', setting('product_page_id'));

        if (!$blogPageId) {
            return url('/');
        }

        $blogPage = app(\Botble\Page\Repositories\Interfaces\PageInterface::class)->findById($blogPageId);

        if (!$blogPage) {
            return url('/');
        }

        return $blogPage->url;
    }
}


if (!function_exists('get_social_link')) {
    /**
     * @return string
     */
    function get_social_link($social_key): array
    {
        $social_links = @json_decode(theme_option('social_links'), true);
        if (!empty(@$social_links)) {
            foreach ($social_links as $social_link) {
                if ($social_link[1]['value'] == $social_key) {
                    return [
                        'name' => $social_link[0]['value'],
                        'link' => $social_link[3]['value']
                    ];
                }
            }
        }
        return [];
    }
}

if (!function_exists('get_files')) {
    /**
     * @return string
     */
    function get_files($slides, $video, $poster): array
    {
        $files = [];
        if (!empty($video)) {
            $files[] = [
                'type' => 'video',
                'poster' => $poster,
                'thumb' => theme_option('icon_video'),
                'large' => $video
            ];
        }
        if (!empty($slides)) {
            foreach ($slides as $slide) {
                $files[] = [
                    'type' => 'image',
                    'thumb' => $slide,
                    'large' => $slide
                ];
            }
        }
        return $files;
    }
}

if (!function_exists('get_root_category')) {
    /**
     * @param array $args
     * @return array
     */
    function get_root_category($category)
    {
        if (empty($category->parent->id)) {
            return $category;
        }
        return get_root_category($category->parent);
    }
}

if (!function_exists('get_children_pcategory_ids')) {
    /**
     * @param array $args
     * @return array
     */
    function get_children_pcategory_ids($category): array
    {
        $categoryIds = [];
        if (!empty($category->activeChildren)) {
            foreach ($category->activeChildren as $child) {
                $categoryIds[] = $child->id;
                $categoryIds = array_merge($categoryIds, get_children_category_ids($child));
            }
        }
        return $categoryIds;
    }
}
