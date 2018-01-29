<?php

namespace App\Http\Requests\Console;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;

class NodeRequest extends BaseRequest
{

    public $key = 'node';

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
                'parentHid' => 'required',
                'weight' => 'required',
                'name' => 'required|unique:nodes,name|regex:/^[a-zA-Z0-9]+$/',
                'displayName' => 'required|max:60|unique:nodes,display_name',
            ];
        }

        if ($actionMethod == 'update') {
            $hid = Request::route()->parameter('hid');
            $rule =  [
                'parentHid' => 'required',
                'weight' => 'required',
                'name' => 'required|unique:nodes,name,null,null,hid,!'.$hid.'|regex:/^[a-zA-Z0-9]+$/',
                'displayName' => 'required|max:60|unique:nodes,display_name,null,null,hid,!'.$hid,
            ];
        }

        return $rule;
    }
}
