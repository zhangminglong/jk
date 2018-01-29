<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/6
 * Time: 下午1:45
 */

namespace App\Services\Console;


use App\Exceptions\TryException;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Services\BaseService;
use Vinkla\Hashids\Facades\Hashids;

class TagService extends BaseService
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param $page
     * @param lluminate\Http\Request
     * @return mixed
     */
    public function paginate($page,$request)
    {
        $query = $this->tagRepository->models();

        $postCount = $request->get('cOrder');
        if (!empty($postCount)) {
            $postCount = $postCount == 'desc' ? 'desc' : 'asc';
            $query = $query->orderBy('post_count',$postCount);
        }

        $weightOrder = $request->get('wOrder');
        if (!empty($weightOrder)) {
            $weightOrder = $weightOrder == 'desc' ? 'desc' : 'asc';
            $query = $query->orderBy('weight',$weightOrder);
        }

        return $query->paginate($page);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $create = [
            "name" => $request->get('name'),
            "display_name" => $request->get('displayName'),
            "description" => $request->get('description'),
            "weight" => $request->get('weight'),
        ];

        $this->log('service.request to '.__METHOD__,['create' => $create]);
        $create['post_count'] = 0;
        try {
            \DB::beginTransaction();
            $result = $this->tagRepository->create($create);
            $result->hid = Hashids::connection('tag')->encode($result->id);
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
     * @param $hid
     * @return mixed
     */
    public function hidFind($hid)
    {
        return $this->tagRepository->hidFind($hid);
    }

    /**
     * @param $request
     * @param $hid
     * @return mixed
     */
    public function hidUpdate($request,$hid)
    {
        $update = parse_input($request->only(['weight','name','displayName','description']));
        $this->log('service.request to '.__METHOD__,['update' => $update]);
        return $this->tagRepository->hidUpdate($update,$hid);
    }

    /**
     * @param $hid
     * @return bool
     */
    public function hidDelete($hid)
    {
        $this->tagRepository->hidFind($hid);
        try {
            \DB::beginTransaction();
            $this->tagRepository->detachPostTag($hid);
            $this->tagRepository->hidDelete($hid);
            \DB::commit();
        } catch (\Exception $e) {
            $this->log('"service.error" to listener "' . __METHOD__ . '".', ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]);
            \DB::rollBack();
            throw new TryException(json_encode($e->getMessage()),(int)$e->getCode());
        }
        return true;
    }

}