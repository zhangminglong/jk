<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/6
 * Time: 下午1:48
 */

namespace App\Repositories\Contracts;


interface TagRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    public function models();

    /**
     * @param $hid
     * @return mixed
     */
    public function detachPostTag($hid);
}