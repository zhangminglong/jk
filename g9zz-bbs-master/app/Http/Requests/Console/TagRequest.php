<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/12
 * Time: 上午12:26
 */

namespace App\Http\Requests\Console;


use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;

class TagRequest extends BaseRequest
{
    public $key = 'tag';

    public function rules()
    {
        $actionMethod = Request::route()->getActionMethod();
        $rule = [];
        if ($actionMethod == 'store') {
            $rule = [
                'description' => 'max:120',
                'weight' => 'required',
                'name' => 'required|unique:tags,name|regex:/^[a-zA-Z0-9]+$/',
                'displayName' => 'required|max:60|unique:tags,display_name',
            ];
        }

        if ($actionMethod == 'update') {
            $hid = Request::route()->parameter('hid');

            $rule =  [
                'description' => 'max:120',
                'weight' => 'required',
                'name' => 'required|unique:tags,name,'.$hid.',hid|regex:/^[a-zA-Z0-9]+$/',
                'displayName' => 'required|max:60|unique:tags,display_name,'.$hid.',hid',
            ];
        }

        return $rule;
    }
}