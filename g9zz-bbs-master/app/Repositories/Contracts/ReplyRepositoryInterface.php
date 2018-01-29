<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/6
 * Time: 下午4:22
 */

namespace App\Repositories\Contracts;


interface ReplyRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    public function noBlocked();

    /**
     * @param $postHid
     * @return mixed
     */
    public function getReply($postHid);
}