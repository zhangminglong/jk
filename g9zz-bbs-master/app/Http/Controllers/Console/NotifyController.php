<?php

namespace App\Http\Controllers\Console;

use App\Services\Console\NotifyService;
use App\Transformers\NotifyTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class NotifyController extends Controller
{
    protected $notifyService;
    public function __construct(NotifyService $notifyService)
    {
        $this->notifyService = $notifyService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNotify(Request $request)
    {
        $status = $request->get('status');
        $paginate = $this->notifyService->notifyPaginate($status);
        $resource = new Collection($paginate,new NotifyTransformer());
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginate));
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param $notifyId
     * @return \Illuminate\Http\JsonResponse
     */
    public function setNotifyRead($notifyId)
    {
        $result = $this->notifyService->setNotifyRead($notifyId);
        $resource = new Item($result,new NotifyTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function setAllNotifyRead()
    {
        $this->notifyService->setAllNotifyRead();
        return $this->response();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUnreadNotifyNum()
    {
        $count = $this->notifyService->getUnreadNum();
        $data = new \stdClass();
        $data->count = $count;
        $this->log('controller.log to '.__METHOD__,['data' => $data]);
        $this->setData($data);
        $this->setCode(200);
        return $this->response();
    }
}
