<?php

namespace Botble\Product\Models;

use Botble\Base\Models\BaseModel;

class PCategoryTranslation extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pcategories_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'lang_code',
        'categories_id',
        'name',
        'description',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
