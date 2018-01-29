<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/6
 * Time: 下午9:44
 */

namespace App\Services\Console;


use App\Exceptions\TryException;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Services\BaseService;

class RoleService extends BaseService
{

    protected $roleRepository;
    protected $permissionRepository;
    public function __construct(RoleRepositoryInterface $roleRepository,
                                PermissionRepositoryInterface $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @return mixed
     */
    public function paginate()
    {
        //并没有加查询条件    一个系统需要建多少角色??????
        return $this->roleRepository->paginate(per_page());
    }

    /**
     * @param $create
     * @return mixed
     */
    public function store($create)
    {
        return $this->roleRepository->create($create);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->roleRepository->find($id);
    }

    /**
     * @param $update
     * @param $id
     * @return mixed
     */
    public function update($update,$id)
    {
        return $this->roleRepository->update($update,$id);
    }

    /**
     * @param $roleId
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function delete($roleId)
    {
        $this->roleRepository->find($roleId);
        $user = $this->roleRepository->getUserByRole($roleId);
        if (!empty($user)) {
            $this->setCode(config('validation.role')['has.user']);
            return $this->response();
        }
        try {
            \DB::beginTransaction();
            $this->roleRepository->detachPermissionRole($roleId);
            $this->roleRepository->delete($roleId);
            \DB::commit();
        } catch (\Exception $e) {
            $this->log('"service.error" to listener "' . __METHOD__ . '".', ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            \DB::rollBack();
            throw new TryException(json_encode($e->getMessage()),(int)$e->getCode());
        }
        return true;
    }

    /**
     * @param $permissions
     * @param $roleId
     * @return mixed
     */
    public function attachPermission($permissions,$roleId)
    {
        $this->checkExists($permissions);//不用接收,如果有不存在的,会抛异常

        $hadPermissions = $this->roleRepository->getHadAssignedPermissionIds($roleId);
        $newPermissions = array_flip(array_flip(array_merge($hadPermissions,$permissions)));
        $this->log('service.request to '.__METHOD__,['permissions' => $newPermissions]);
        return $this->roleRepository->syncRelationship($newPermissions,$roleId);
    }

    /**
     * 校验传入的权限ID 是否存在
     * @param $permissions
     * @return bool
     */
    public function checkExists($permissions)
    {
        if (is_array($permissions)) {
            foreach ($permissions as $value) {
                $this->permissionRepository->find($value);
            }
        } else {
            $this->permissionRepository->find($permissions);
        }
        return true;
    }
}