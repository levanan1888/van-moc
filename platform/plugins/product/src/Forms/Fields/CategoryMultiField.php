<?php

namespace Botble\Product\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class CategoryMultiField extends FormField
{
    /**
     * {@inheritDoc}
     */
    protected function getTemplate()
    {
        return 'plugins/product::categories.categories-multi';
    }
}
