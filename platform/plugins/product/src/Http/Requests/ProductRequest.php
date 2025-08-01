<?php

namespace Botble\Product\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Product\Supports\ProductFormat;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ProductRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'code' => 'required|max:100',
            'name' => 'required|max:255',
            'categories' => 'required',
            'status' => Rule::in(BaseStatusEnum::values()),
        ];

        $productFormats = ProductFormat::getProductFormats(true);

        if (count($productFormats) > 1) {
            $rules['format_type'] = Rule::in(array_keys($productFormats));
        }

        return $rules;
    }
}
