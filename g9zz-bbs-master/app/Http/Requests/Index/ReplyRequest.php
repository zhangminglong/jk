<?php

namespace App\Http\Requests\Index;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;

class ReplyRequest extends BaseRequest
{
    public $key = 'reply';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $actionMethod = Request::route()->getActionMethod();
        $rule = [];
        if ($actionMethod == 'store') {
            $rule = [
                'postHid' => 'required|exists:posts,hid',
                'content' => 'required',
            ];
        }

        if ($actionMethod == 'update') {
            $rule = [
                'content' => 'required',
            ];
        }
        return $rule;
    }
}
