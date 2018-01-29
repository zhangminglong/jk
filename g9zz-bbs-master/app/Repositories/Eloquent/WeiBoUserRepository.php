<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/9
 * Time: 下午3:31
 */

namespace App\Repositories\Eloquent;


use App\Models\WeiboUser;
use App\Repositories\Contracts\WeiBoUserRepositoryInterface;

class WeiBoUserRepository extends BaseRepository implements WeiBoUserRepositoryInterface
{
    public function model()
    {
        return WeiboUser::class;
    }

    /**
     * @param $weiboId
     * @return mixed
     */
    public function getWeibo($weiboId)
    {
        return $this->model->where('weibo_id',$weiboId)->first();
    }
}