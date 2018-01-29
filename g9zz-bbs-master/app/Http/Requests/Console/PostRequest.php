<?php

namespace App\Http\Requests\Console;

use App\Http\Requests\BaseRequest;

class PostRequest extends BaseRequest
{
    public $key = 'post';

    /**
     * @return array
     */
    public function rules()
    {
        $rule = [
            'title' => 'required|max:150',
            'content' => 'required',
            'nodeHid' => 'required|exists:nodes,hid'
        ];
        return $rule;
    }
}
