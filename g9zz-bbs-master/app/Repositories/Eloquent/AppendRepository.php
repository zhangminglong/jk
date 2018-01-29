<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/6
 * Time: 下午3:43
 */

namespace App\Repositories\Eloquent;


use App\Models\Appends;
use App\Repositories\Contracts\AppendRepositoryInterface;

class AppendRepository extends BaseRepository implements AppendRepositoryInterface
{
    public function model()
    {
        return Appends::class;
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function getAppendCountByPostHid($hid)
    {
        return $this->model->whereTopicHid($hid)->count();
    }
}