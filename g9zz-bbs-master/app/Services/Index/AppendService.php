<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/6
 * Time: 下午3:39
 */

namespace App\Services\Index;


use App\Exceptions\TryException;
use App\Repositories\Contracts\AppendRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Services\BaseService;
use HyperDown\Parser;
use Vinkla\Hashids\Facades\Hashids;

class AppendService extends BaseService
{
    protected $appendRepository;
    protected $postRepository;

    public function __construct(AppendRepositoryInterface $appendRepository,
                                PostRepositoryInterface $postRepository)
    {
        $this->appendRepository = $appendRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * @return mixed
     */
    public function paginate()
    {
        return $this->appendRepository->paginate(per_page());
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function store($request)
    {
        $content = $request->get('content');
        $create['content_original'] = $content;
        $parse = new Parser();
        $create['content'] = $parse->makeHtml($content);

        $authId = $request->get('g9zz_user_hid');
        $postHid = $request->get('postHid');
        //检查是否 是作者自己
        $post = $this->postRepository->hidFind($postHid);
        if ($post->user_hid != $authId) {
            $this->setCode(config('validation.append')['isNot.author']);
            return $this->response();
        }

        //检查是否 数量过多
        $appends = $this->appendRepository->getAppendCountByPostHid($postHid);
        $maxAppends = config('g9zz.append.max_count');
        if ($appends > $maxAppends) {
            $this->setCode(config('validation.append')['max.count']);
            return $this->response();
        }

        $create['topic_hid'] = $postHid;
        $this->log('service.request to '.__METHOD__,['create' => $create]);

        try {
            \DB::beginTransaction();
            $result = $this->appendRepository->create($create);
            $this->log('"service.request" to listener "' . __METHOD__ . '".', ['create' => $create]);
            $result->hid = Hashids::connection('append')->encode($result->id);
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
        return $this->appendRepository->hidFind($hid);
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function hidDelete($hid)
    {
        return $this->appendRepository->hidDelete($hid);
    }
}