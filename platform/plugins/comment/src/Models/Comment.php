<?php

namespace Botble\Comment\Models;

use Botble\Base\Supports\Avatar;
use Botble\Base\Traits\EnumCastable;
use Botble\Comment\Enums\CommentStatusEnum;
use Botble\Blog\Models\Post;
use Botble\Base\Models\BaseModel;
use Exception;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Botble\ACL\Models\User;
use RvMedia;

class Comment extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
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
        'email',
        'parent_id',
        'post_id',
        'content',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => CommentStatusEnum::class,
    ];

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id')->withDefault();
    }

    /**
     * @return BelongsTo
     * @deprecated
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * @return BelongsTo
     * @deprecated
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class)->withDefault();
    }

}
