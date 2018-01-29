<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/5
 * Time: 下午5:51
 */

namespace App\Repositories\Eloquent;


use App\Models\InviteCode;
use App\Repositories\Contracts\InviteCodeRepositoryInterface;

class InviteCodeRepository extends BaseRepository implements InviteCodeRepositoryInterface
{
    public function model()
    {
        return InviteCode::class;
    }

    /**
     * @return mixed
     */
    public function models()
    {
        return $this->model;
    }

    /**
     * @param $authHid
     * @return mixed
     */
    public function getNumByAuthHid($authHid)
    {
        return $this->model->whereInviterHid($authHid)->count();
    }

    /**
     * 通过 邀请人获取该人的所有邀请码
     * @param $inviterHid
     * @return mixed
     */
    public function getAllCodeByInviterHid($inviterHid)
    {
        return $this->model->whereInviterHid($inviterHid)->get();
    }

    /**
     * 通过邀请码获取对应信息
     * @param $code
     * @return mixed
     */
    public function getInviteCodeByCode($code)
    {
        return $this->model->whereCode($code)->first();
    }
}