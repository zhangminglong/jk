<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/6
 * Time: 下午6:26
 */

namespace App\Services\Console;


use App\Exceptions\TryException;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Services\BaseService;
use Vinkla\Hashids\Facades\Hashids;

class PermissionService extends BaseService
{
    protected $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @return mixed
     */
    public function paginate()
    {
        return $this->permissionRepository->paginate(per_page());
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $create = $request->only(['name','displayName','description']);
        $this->log('service.request to '.__METHOD__,['request' => $create]);
        $create = parse_input($create);
        //省去校验唯一,表单提交时候已校验
        try {
            \DB::beginTransaction();
            $result = $this->permissionRepository->create($create);
            $this->log('service.request to '.__METHOD__,['permission_create' => $result ]);
            \DB::commit();
        } catch (\Exception $e) {
            $this->log('"service.error" to listener "' . __METHOD__ . '".', ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            \DB::rollBack();
            throw new TryException(json_encode($e->getMessage()),(int)$e->getCode());
        }

        return $result;
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function find($hid)
    {
        return $this->permissionRepository->find($hid);
    }

    /**
     * @param $update
     * @param $id
     * @return mixed
     */
    public function update($update,$id)
    {
        return $this->permissionRepository->update($update,$id);
    }

    /**
     * @param $permissionId
     * @return bool
     */
    public function delete($permissionId)
    {
        $this->permissionRepository->find($permissionId);
        try {
            \DB::beginTransaction();
            $this->permissionRepository->detachPermissionRole($permissionId);
            $this->permissionRepository->delete($permissionId);
            \DB::commit();
        } catch (\Exception $e) {
            $this->log('"service.error" to listener "' . __METHOD__ . '".', ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            \DB::rollBack();
            throw new TryException(json_encode($e->getMessage()),(int)$e->getCode());
        }
        return true;
    }
}