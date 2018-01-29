<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/5
 * Time: 下午5:29
 */

namespace App\Services\Auth;


use App\Services\BaseService;

class RegisterService extends BaseService
{

    protected $isInvite;
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->isInvite = config('g9zz.invite_code.is_invite');
        $this->userService = $userService;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        //需要邀请码
        //不需要邀请码 直接注册
        $other = [];
        if ($this->isInvite) {
            $other['invite_code'] = $request->get('inviteCode');
        }


        $create = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'avatar' => 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1497014683027&di=3cfb152ddbcdb74cc2840e92022e6888&imgtype=0&src=http%3A%2F%2Fwww.ucicq.com%2Fuploads%2Fallimg%2F170307%2F2234302133_0.jpg',
        ];
        return  $this->userService->loginCreate($create,$other);
    }
}