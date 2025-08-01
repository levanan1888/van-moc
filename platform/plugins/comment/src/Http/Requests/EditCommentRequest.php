<?php

namespace Botble\Comment\Http\Requests;

use Botble\Comment\Enums\CommentStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class EditCommentRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => Rule::in(CommentStatusEnum::values()),
        ];
    }
}
