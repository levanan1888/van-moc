<?php

namespace Botble\Product\Repositories\Eloquent;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Product\Repositories\Interfaces\ProductInterface;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Eloquent;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;

class ProductRepository extends RepositoriesAbstract implements ProductInterface
{
    /**
     * {@inheritDoc}
     */
    public function getFeatured(int $limit = 5, array $with = [])
    {
        $data = $this->model
            ->where([
                'status' => BaseStatusEnum::PUBLISHED,
                'is_featured' => 1,
            ])
            ->limit($limit)
            ->with(array_merge(['slugable'], $with))
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getListProductNonInList(array $selected = [], $limit = 7, array $with = [])
    {
        $data = $this->model
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->whereNotIn('id', $selected)
            ->limit($limit)
            ->with($with)
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getRelated($id, $limit = 3)
    {
        $data = $this->model
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->where('id', '!=', $id)
            ->limit($limit)
            ->with('slugable')
            ->orderBy('created_at', 'desc')
            ->whereHas('categories', function ($query) use ($id) {
                $query->whereIn('pcategories.id', $this->getRelatedCategoryIds($id));
            });

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getRelatedCategoryIds($model)
    {
        $model = $model instanceof Eloquent ? $model : $this->findById($model);

        if (!$model) {
            return [];
        }

        try {
            return $model->categories()->allRelatedIds()->toArray();
        } catch (Exception $exception) {
            return [];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getByCategory($categoryId, $paginate = 12, $limit = 0, $except = [])
    {
        if (!is_array($categoryId)) {
            $categoryId = [$categoryId];
        }

        $data = $this->model
            ->where('products.status', BaseStatusEnum::PUBLISHED)
            ->join('product_categories', 'product_categories.product_id', '=', 'products.id')
            ->join('pcategories', 'product_categories.category_id', '=', 'pcategories.id')
            ->whereIn('product_categories.category_id', $categoryId);

        if (!empty($except)) {
            $data->whereNotIn('products.id', $except);
        }

        $data->select('products.*')
            ->distinct()
            ->with('slugable')
            ->orderBy('products.order', 'asc')
            ->orderBy('products.created_at', 'desc');

        if ($paginate != 0) {
            return $this->applyBeforeExecuteQuery($data)->paginate($paginate);
        }

        return $this->applyBeforeExecuteQuery($data)->limit($limit)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getByUserId($authorId, $paginate = 6)
    {
        $data = $this->model
            ->where([
                'status' => BaseStatusEnum::PUBLISHED,
                'author_id' => $authorId,
            ])
            ->with('slugable')
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->paginate($paginate);
    }

    /**
     * {@inheritDoc}
     */
    public function getDataSiteMap()
    {
        $data = $this->model
            ->with('slugable')
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getByTag($tag, $paginate = 12)
    {
        $data = $this->model
            ->with('slugable', 'categories', 'categories.slugable', 'author')
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->whereHas('tags', function ($query) use ($tag) {
                /**
                 * @var Builder $query
                 */
                $query->where('tags.id', $tag);
            })
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->paginate($paginate);
    }

    /**
     * {@inheritDoc}
     */
    public function getRecentProducts($limit = 5, $categoryId = 0)
    {
        $data = $this->model->where(['status' => BaseStatusEnum::PUBLISHED]);

        if ($categoryId != 0) {
            $data = $data
                ->join('product_categories', 'product_categories.product_id', '=', 'products.id')
                ->where('product_categories.category_id', $categoryId);
        }

        $data = $data->limit($limit)
            ->with('slugable')
            ->select('products.*')
            ->orderBy('created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getSearch($keyword, $limit = 10, $paginate = 10)
    {
        $data = $this->model
            ->with('slugable')
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->where(function ($query) use ($keyword) {
                $query->addSearch('name', $keyword);
                $query->addSearch('description', $keyword);
                $query->addSearch('content', $keyword);
            })
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc');

        if ($limit) {
            $data = $data->limit($limit);
        }

        if ($paginate) {
            return $this->applyBeforeExecuteQuery($data)->paginate($paginate);
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllProducts($perPage = 12, $active = true, array $with = ['slugable'])
    {
        $data = $this->model
            ->with($with)
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc');

        if ($active) {
            $data = $data->where('status', BaseStatusEnum::PUBLISHED);
        }

        return $this->applyBeforeExecuteQuery($data)->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function getPopularProducts($limit, array $args = [])
    {
        $data = $this->model
            ->with('slugable')
            ->orderBy('views', 'desc')
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->limit($limit);

        if (!empty(Arr::get($args, 'where'))) {
            $data = $data->where($args['where']);
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters(array $filters)
    {
        $data = $this->originalModel;

        if ($filters['categories'] !== null) {
            $categories = array_filter((array)$filters['categories']);

            $data = $data->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('categories.id', $categories);
            });
        }

        if ($filters['categories_exclude'] !== null) {
            $data = $data
                ->whereHas('categories', function ($query) use ($filters) {
                    $query->whereNotIn('categories.id', array_filter((array)$filters['categories_exclude']));
                });
        }

        if ($filters['exclude'] !== null) {
            $data = $data->whereNotIn('Products.id', array_filter((array)$filters['exclude']));
        }

        if ($filters['include'] !== null) {
            $data = $data->whereNotIn('Products.id', array_filter((array)$filters['include']));
        }

        if ($filters['author'] !== null) {
            $data = $data->whereIn('author_id', array_filter((array)$filters['author']));
        }

        if ($filters['author_exclude'] !== null) {
            $data = $data->whereNotIn('author_id', array_filter((array)$filters['author_exclude']));
        }

        if ($filters['featured'] !== null) {
            $data = $data->where('Products.is_featured', $filters['featured']);
        }

        if ($filters['search'] !== null) {
            $data = $data
                ->where(function ($query) use ($filters) {
                    $query
                        ->addSearch('Products.name', $filters['search'])
                        ->addSearch('Products.description', $filters['search']);
                });
        }

        $orderBy = Arr::get($filters, 'order_by', 'updated_at');
        $order = Arr::get($filters, 'order', 'desc');

        $data = $data
            ->where('Products.status', BaseStatusEnum::PUBLISHED)
            ->orderBy($orderBy, $order);

        return $this->applyBeforeExecuteQuery($data)->paginate((int)$filters['per_page']);
    }
}
