<?php

namespace Botble\Customer\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Customer\Supports\CustomerFormat;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class CustomerRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'nullable|email',
            // 'email' => 'email|unique:customers,email',
            'logo' => 'required',
            'status' => Rule::in(BaseStatusEnum::values()),
        ];

        $customerFormats = CustomerFormat::getCustomerFormats(true);

        if (count($customerFormats) > 1) {
            $rules['format_type'] = Rule::in(array_keys($customerFormats));
        }

        return $rules;
    }
}
