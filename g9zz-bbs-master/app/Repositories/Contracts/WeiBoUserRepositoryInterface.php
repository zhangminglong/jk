<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/9
 * Time: 下午3:30
 */

namespace App\Repositories\Contracts;


interface WeiBoUserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * 通过微博ID 获取 weibo_user 里的 id
     * @param $weiboId
     * @return mixed
     */
    public function getWeibo($weiboId);
}