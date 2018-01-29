<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/5
 * Time: 下午5:50
 */

namespace App\Repositories\Contracts;


interface InviteCodeRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * 获取邀请人有多少个邀请码了
     * @param $authHid
     * @return mixed
     */
    public function getNumByAuthHid($authHid);

    /**
     * 通过邀请人获取这人所有的邀请码
     * @param $inviterHid
     * @return mixed
     */
    public function getAllCodeByInviterHid($inviterHid);

    /**
     * 通过邀请码获取对应信息
     * @param $code
     * @return mixed
     */
    public function getInviteCodeByCode($code);

    /**
     * @return mixed
     */
    public function models();
}