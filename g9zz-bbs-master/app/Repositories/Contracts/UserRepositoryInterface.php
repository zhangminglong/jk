<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/5
 * Time: 下午5:24
 */

namespace App\Repositories\Contracts;


interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * 通过邮箱 获取user
     * @param $email
     * @return mixed
     */
    public function findUserByEmail($email);

    /**
     * 通过githubId 获取user
     * @param $githubId
     * @return mixed
     */
    public function findUserByGithubId($githubId);

    /**
     * 重新分配角色
     * @param $role
     * @param $id
     * @return mixed
     */
    public function syncRelationship($role,$id);

    /**
     * 根据userId 获取user
     * @param $userId
     * @return mixed
     */
    public function first($userId);

    /**
     * 通过id获取其对应的角色
     * @param $authId
     * @return mixed
     */
    public function getRoleByUserId($authId);

    /**
     * 通过用户的hid 获取其相关的帖子
     * @param $userHid
     * @return mixed
     */
    public function getPostByUser($userHid);

    /**
     * 通过用户的hid 获取其相关回复
     * @param $userHid
     * @return mixed
     */
    public function getReplyByUser($userHid);

    /**
     * 通过ID获取用户
     * @param $id
     * @return mixed
     */
    public function getUserById($id);

    /**
     * 通过weibo_user 的id 查找user 表里数据
     * @param $weiboId
     * @return mixed
     */
    public function findUserByWeiboId($weiboId);

    /**
     * @param $xcxId
     * @return mixed
     */
    public function getUserByXcxId($xcxId);
}