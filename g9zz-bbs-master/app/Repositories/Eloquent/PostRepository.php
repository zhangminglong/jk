<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/5
 * Time: 下午9:13
 */

namespace App\Repositories\Eloquent;


use App\Models\Posts;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function model()
    {
        return Posts::class;
    }

    /**
     * @return mixed
     */
    public function models()
    {
        return $this->model;
    }

    /**
     * @param $postHid
     * @return mixed
     */
    public function getAuthorByPostHid($postHid)
    {
        return $this->hidFind($postHid);
    }
}