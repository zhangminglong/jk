<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/6
 * Time: 下午1:48
 */

namespace App\Repositories\Eloquent;


use App\Models\Tags;
use App\Repositories\Contracts\TagRepositoryInterface;
use Vinkla\Hashids\Facades\Hashids;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function model()
    {
        return Tags::class;
    }

    /**
     * @return mixed
     */
    public function models()
    {
        return $this->model;
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function detachPostTag($hid)
    {
        $id = Hashids::connection('tag')->decode($hid);
        return $this->model->whereId($id[0])->first()->post()->delete();
    }
}