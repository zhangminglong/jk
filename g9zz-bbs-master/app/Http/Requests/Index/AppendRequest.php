<?php

namespace App\Http\Requests\Index;

use App\Http\Requests\BaseRequest;

class AppendRequest extends BaseRequest
{
    public $key = 'append';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [
            'content' => 'required|max:300',
            'postHid' => 'required|exists:posts,hid'
        ];
        return $rule;
    }
}
