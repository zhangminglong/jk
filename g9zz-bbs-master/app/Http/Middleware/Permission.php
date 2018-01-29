<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\G9zzLog;
use App\Traits\Respond;
use Closure;
use Request;

class Permission
{
    use G9zzLog,Respond;

    protected $userRepository;
    protected $roleRepository;
    public function __construct(Request $request,
                                UserRepositoryInterface $userRepository,
                                RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authId = $request->get('g9zz_user_id');
        if (empty($authId)) {
            $code = config('validation.default')['need.login'];
            return $this->handleRes($code);
        }

        $actionName = $request->route()->getName();
        $role = $this->userRepository->getRoleByUserId($authId);
        //没有关联角色,提醒 权限不够
        if (empty($role)) {
            $code = config('validation.permission')['permission.forbidden'];
            return $this->handleRes($code);
        }

        //超管,直接跳走
        if ($role->level == 1) {
            return $next($request);
        }

        //判断权限了
        $permissions = $this->roleRepository->getPermissionsByRoleId($role->id);
        if (!in_array($actionName,$permissions->toArray())) {
            $code = config('validation.permission')['permission.forbidden'];
            return $this->handleRes($code);
        }

        return $next($request);
    }

    public function handleRes($code)
    {
        $this->log('error.request to '.__METHOD__,['code' => $code]);
        $this->setCode($code);
        return $this->response();
    }
}
