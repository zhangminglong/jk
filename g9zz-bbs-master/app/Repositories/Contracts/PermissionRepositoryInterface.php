<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/6
 * Time: 下午6:28
 */

namespace App\Repositories\Contracts;


interface PermissionRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $permissionId
     * @return mixed
     */
    public function detachPermissionRole($permissionId);
}