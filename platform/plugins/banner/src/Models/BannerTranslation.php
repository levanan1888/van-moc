<?php

namespace Botble\Banner\Models;

use Botble\Base\Models\BaseModel;

class BannerTranslation extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banners_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'lang_code',
        'banners_id',
        'name',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
