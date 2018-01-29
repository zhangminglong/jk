<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/5
 * Time: 下午10:15
 */

namespace App\Services\Console;


use App\Exceptions\TryException;
use App\Repositories\Contracts\NodeRepositoryInterface;
use App\Services\BaseService;
use Vinkla\Hashids\Facades\Hashids;

class NodeService extends BaseService
{
    protected $nodeRepository;

    public function __construct(NodeRepositoryInterface $nodeRepository)
    {
        $this->nodeRepository = $nodeRepository;
    }
    /**
     * 节点按照父子关系排序
     * @return array
     */
    public function orderNode()
    {
        $model = $this->nodeRepository->all();
        $data  = self::tree($model);
        foreach ($data as $key => $value) {
            $data[$key]->newHtml = $value->html.$value->name;
        }
        return $data;
    }
    /**
     * 排序算法
     * @param $model
     * @param $parentHid
     * @param int $level
     * @param string $html
     * @return array
     */
    public  static function tree($model, $parentHid = 0, $level = 0, $html = '-')
    {
        $data = array();
        foreach ($model as $k => $v) {
            if ($v->parent_hid == $parentHid) {
                if ($level != 0) {
                    $v->html = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
                    $v->html .= '|';
                }
                $v->html .= str_repeat($html, $level);
                $data[] = $v;
                $data = array_merge($data, self::tree($model, $v->hid, $level + 1));
            }
        }
        return $data;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function storeNode($request)
    {
        $create = [
            'parent_hid' => $request->get('parentHid'),
            'weight' => $request->get('weight'),
            'name' => $request->get('name'),
            'display_name' => $request->get('displayName'),
            'description' => $request->get('description'),
            'is_show' => $request->get('isShow') == 'no' ? 'no' :'yes',
        ];
        $this->log('service.request to '.__METHOD__,['create' => $create]);

        $create['level'] = $this->checkLevel($create['parent_hid']);
        $create['post_count'] = 0;

        try {
            \DB::beginTransaction();
            $result = $this->nodeRepository->create($create);
            $result->hid = Hashids::connection('node')->encode($result->id);
            $result->save();
            \DB::commit();
        } catch (\Exception $e) {
            $this->log('"service.error" to listener "' . __METHOD__ . '".', ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            \DB::rollBack();
            throw new TryException(json_encode($e->getMessage()),(int)$e->getCode());
        }

        return $result;
    }

    /**
     * @param $parentHid
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function checkLevel($parentHid)
    {
        $level = $this->getLevelByParentHid($parentHid);
        $nodeMaxLevel = config('g9zz.node.max_level');
        //建议level不要设置那么大,如果要修改,请到config/g9zz.php 下进行修改
        if ($level > $nodeMaxLevel) {
            $this->setCode(config('validation.node')['node.max_level']);
            return $this->response();
        }
        return $level;
    }

    /**
     * 通过父类ID生成等级level
     * @param $parentHid
     * @param int $level
     * @param array $ids
     * @return mixed
     */
    public function getLevelByParentHid($parentHid,$level = 0,$ids= [])
    {
        if ($parentHid === 0 || $parentHid === '0') {
            return $level;
        } else {
            $nodeData =  $this->nodeRepository->hidFind($parentHid);//返回对象
            if ($nodeData->parent_hid != 0) {
                if (in_array($nodeData->parent_hid,$ids)) {
                    $this->setCode(config('validation.node')['error.relation']);
                    return $this->response();
                }
                $ids[] = $nodeData->parent_hid;
                return $this->getLevelByParentHid($nodeData->parent_hid,$level+1,$ids);
            }
        }
        return $level + 1;
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function hidFind($hid)
    {
        return $this->nodeRepository->hidFind($hid);
    }

    /**
     * @param $request
     * @param $hid
     * @return mixed
     */
    public function hidUpdate($request,$hid)
    {
        $update = parse_input($request->only(['parentHid','weight','name','displayName','description','isShow']));
        if (!$update['is_show']) unset($update['is_show']);
        $this->log('service.request to '.__METHOD__,['request' => $update]);
        $update['level'] = $this->checkLevel($update['parent_hid']);
        $this->log('service.request to '.__METHOD__,['update' => $update]);
        return $this->nodeRepository->hidUpdate($update,$hid);
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function hidDelete($hid)
    {
        $this->nodeRepository->hidFind($hid);
        $isHasChild = $this->nodeRepository->getChildByHid($hid);//return obj | bool
        if (!empty($isHasChild)) {
            $this->setCode(config('validation.node')['has.child_node']);
            return $this->response();
        }
        try {
            \DB::beginTransaction();
            $this->nodeRepository->detachPostNode($hid);
            $this->nodeRepository->hidDelete($hid);
            \DB::commit();
        } catch (\Exception $e) {
            $this->log('"service.error" to listener "' . __METHOD__ . '".', ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            \DB::rollBack();
            throw new TryException(json_encode($e->getMessage()),(int)$e->getCode());
        }
        return true;
    }

    /**
     * @param $nodeHid
     * @return mixed
     */
    public function getPost($nodeHid)
    {
        return $this->nodeRepository->getPost($nodeHid)->paginate(per_page());
    }

    /**
     * @return mixed
     */
    public function getShowNode()
    {
        return $this->nodeRepository->getShowNode();
    }
}