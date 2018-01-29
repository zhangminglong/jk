<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/6
 * Time: 下午4:23
 */

namespace App\Repositories\Eloquent;


use App\Models\Replies;
use App\Repositories\Contracts\ReplyRepositoryInterface;

class ReplyRepository extends BaseRepository implements ReplyRepositoryInterface
{
    public function model()
    {
        return Replies::class;
    }

    /**
     * @return mixed
     */
    public function noBlocked()
    {
        return $this->model->whereIsBlocked('no');
    }

    /**
     * @param $postHid
     * @return mixed
     */
    public function getReply($postHid)
    {
        return $this->models()
            ->wherePostHid($postHid)
            ->whereIsBlocked('no')
            ->orderBy('created_at','asc')
            ->paginate(per_page(100));
    }
}