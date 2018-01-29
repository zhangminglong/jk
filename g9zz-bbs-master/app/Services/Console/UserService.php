<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/6
 * Time: 下午5:47
 */

namespace App\Services\Console;


use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Http\Request;

class UserService extends BaseService
{

    protected $userRepository;
    protected $roleRepository;
    protected $request;
    public function __construct(UserRepositoryInterface $userRepository,
                                RoleRepositoryInterface $roleRepository,
                                Request $request)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function paginate()
    {
        return $this->userRepository->paginate(per_page());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * 给用户分配权限
     * @param $userId
     * @param $roleId
     * @return mixed
     */
    public function attachRole($userId,$roleId)
    {
        $this->roleRepository->find($roleId);
        $this->userRepository->find($userId);
        return $this->userRepository->syncRelationship($roleId,$userId);
    }

    /**
     * @param $userHid
     */
    public function getPostByUser($userHid)
    {
        return $this->userRepository->getPostByUser($userHid)->paginate(per_page());
    }

    /**
     * @param $userHid
     * @return mixed
     */
    public function getReplyByUser($userHid)
    {
        return $this->userRepository->getReplyByUser($userHid)->paginate(per_page());
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function hidFind($hid)
    {
        return $this->userRepository->hidFind($hid);
    }
}