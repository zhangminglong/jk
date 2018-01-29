<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/21
 * Time: 上午11:30
 */

namespace App\Repositories\Eloquent;


use App\Models\WechatMiniPrograms;
use App\Repositories\Contracts\XcxUserRepositoryInterface;

class XcxUserRepository extends BaseRepository implements XcxUserRepositoryInterface
{
    public function model()
    {
        return WechatMiniPrograms::class;
    }

    /**
     * @param $openid
     * @return mixed
     */
    public function getXcxByOpenId($openid)
    {
        return $this->model->where('open_id',$openid)->first();
    }
}