<?php

namespace Botble\Product\Models;

use Botble\Base\Models\BaseModel;

class ProductTranslation extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'lang_code',
        'products_id',
        'name',
        'description',
        'content',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
