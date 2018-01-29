<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/6
 * Time: 下午9:47
 */

namespace App\Repositories\Contracts;


interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $roleId
     * @return mixed
     */
    public function getUserByRole($roleId);

    /**
     * @param $roleId
     * @return mixed
     */
    public function detachPermissionRole($roleId);

    /**
     * 获取已分配的权限的ID列表
     * @param $roleId
     * @return mixed
     */
    public function getHadAssignedPermissionIds($roleId);

    /**
     * 重新分配权限
     * @param $permissions
     * @param $id
     * @return mixed
     */
    public function syncRelationship($permissions,$id);

    /**
     * 通过角色获取权限列表
     * @param $roleId
     * @return mixed
     */
    public function getPermissionsByRoleId($roleId);
}