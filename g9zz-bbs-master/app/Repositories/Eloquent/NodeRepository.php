<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/5
 * Time: 下午10:17
 */

namespace App\Repositories\Eloquent;


use App\Models\Nodes;
use App\Repositories\Contracts\NodeRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Traits\G9zzLog;
use App\Traits\Respond;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Request;

class NodeRepository extends BaseRepository implements NodeRepositoryInterface
{
    use Respond,G9zzLog;
    protected $postRepository;

    public function __construct(App $app,
                                Collection $collection,
                                PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
        parent::__construct($app, $collection);
    }


    public function model()
    {
        return Nodes::class;
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function getChildByHid($hid)
    {
        return $this->model->whereParentHid($hid)->first();
    }

    /**
     * 修改节点相关的帖子
     * @param $hid
     * @return \Illuminate\Http\JsonResponse
     */
    public function detachPostNode($hid)
    {
        //将原有的帖子的 node 全部换成默认的那个.....
        $default = $this->model->whereName('default-node')->first();
        if (empty($default)) {
            $this->setCode(config('validation.node')['has.post']);
            return $this->response();
        }
        $posts = $this->postRepository->models()->whereNodeHid($hid)->get();

        if (!empty($posts->toArray())) {
            foreach ($posts as $value) {
                $value->node_hid = $default->hid;
                $value->save();
            }
        }

    }

    /**
     * @param $nodeHid
     * @return mixed
     */
    public function getPost($nodeHid)
    {
        return $this->postRepository->models()->whereNodeHid($nodeHid);
    }

    /**
     * @return mixed
     */
    public function getShowNode()
    {
        return $this->model->whereIsShow('yes')->get();
    }
}