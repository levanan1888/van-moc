<?php

namespace Botble\Customer\Models;

use Botble\Base\Models\BaseModel;

class CustomerTranslation extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'lang_code',
        'customers_id',
        'name',
        'description',
        'content',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
