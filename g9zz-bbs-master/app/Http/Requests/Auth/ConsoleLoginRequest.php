<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class ConsoleLoginRequest extends BaseRequest
{
    public $key = 'login';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [
            'email' => 'required|email|exists:users,email,status,activited',
            'password' => 'required|string'
        ];
        return $rule;
    }
}
