<?php

namespace Botble\Comment\Http\Requests;

use Botble\Support\Http\Requests\Request;

class CommentReplyRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required',
        ];
    }
}
