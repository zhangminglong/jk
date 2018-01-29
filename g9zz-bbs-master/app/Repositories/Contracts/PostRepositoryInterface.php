<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/5
 * Time: 下午9:12
 */

namespace App\Repositories\Contracts;


interface PostRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    public function models();

    /**
     * 通过帖子HID获取 帖子作者的ID
     * @param $postHid
     * @return mixed
     */
    public function getAuthorByPostHid($postHid);
}