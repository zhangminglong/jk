<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/6
 * Time: 下午3:43
 */

namespace App\Repositories\Contracts;


interface AppendRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $hid
     * @return mixed
     */
    public function getAppendCountByPostHid($hid);
}