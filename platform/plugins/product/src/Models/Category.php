<?php

namespace Botble\Product\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Html;
use Illuminate\Support\Collection;

class Category extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pcategories';

    /**
     * The date fields
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'icon',
        'banner',
        'image',
        'image_size',
        'image_color',
        'is_featured',
        'order',
        'home_order',
        'is_default',
        'status',
        'author_id',
        'author_type',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_categories')->with('slugable');
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id')->withDefault();
    }

    /**
     * @return Collection
     */
    public function getParentsAttribute(): Collection
    {
        $parents = collect([]);

        $parent = $this->parent;

        while ($parent->id) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function activeChildren(): HasMany
    {
        return $this
            ->children()
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->with(['slugable', 'activeChildren']);
    }

    /**
     * @return \Illuminate\Support\HtmlString
     */
    public function getBadgeWithCountAttribute()
    {
        switch ($this->status->getValue()) {
            case BaseStatusEnum::DRAFT:
                $badge = 'bg-secondary';

                break;
            case BaseStatusEnum::PENDING:
                $badge = 'bg-warning';

                break;
            default:
                $badge = 'bg-success';

                break;
        }

        return Html::tag('span', (string)$this->products_count, [
            'class' => 'badge font-weight-bold ' . $badge,
            'data-bs-toggle' => 'tooltip',
            'data-bs-original-title' => trans('plugins/product::products.total_products', ['total' => $this->products_count]),
        ]);
    }

    protected static function boot()
    {
        parent::boot();

        self::deleting(function (Category $category) {
            foreach ($category->children()->get() as $child) {
                $child->delete();
            }

            $category->products()->detach();
        });
    }
}
