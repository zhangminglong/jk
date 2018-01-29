<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/21
 * Time: 上午11:29
 */

namespace App\Repositories\Contracts;


interface XcxUserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $openid
     * @return mixed
     */
    public function getXcxByOpenId($openid);
}