<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/6
 * Time: 下午6:28
 */

namespace App\Repositories\Eloquent;


use App\Models\Permissions;
use App\Repositories\Contracts\PermissionRepositoryInterface;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function model()
    {
        return Permissions::class;
    }

    /**
     * @param $permissionId
     * @return mixed
     */
    public function detachPermissionRole($permissionId)
    {
        return $this->model->find($permissionId)->role()->sync([]);
    }
}