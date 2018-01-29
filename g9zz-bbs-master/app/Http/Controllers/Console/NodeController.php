<?php

namespace App\Http\Controllers\Console;

use App\Http\Requests\Console\NodeRequest;
use App\Services\Console\NodeService;
use App\Transformers\NodeTransformer;
use App\Http\Controllers\Controller;
use App\Transformers\PostListTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class NodeController extends Controller
{
    protected $nodeService;

    public function __construct (NodeService $nodeService)
    {
        $this->nodeService = $nodeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $orderNode = $this->nodeService->orderNode();
        $resource = new Collection($orderNode,new NodeTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param NodeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NodeRequest $request)
    {
        $result = $this->nodeService->storeNode($request);
        $resource = new Item($result,new NodeTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param $hid
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($hid)
    {
        $node = $this->nodeService->hidFind($hid);
        $resource = new Item($node,new NodeTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param NodeRequest $request
     * @param $hid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(NodeRequest $request, $hid)
    {
        $this->nodeService->hidUpdate($request,$hid);
        $resource = new Item($this->nodeService->hidFind($hid),new NodeTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param $hid
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($hid)
    {
        $result =  $this->nodeService->hidDelete($hid);
        if ($result) return $this->response();
    }

    /**
     * @param $nodeHid
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPostByNode($nodeHid)
    {
        $result = $this->nodeService->getPost($nodeHid);
        $resource = new Collection($result,new PostListTransformer());
        $resource->setPaginator(new IlluminatePaginatorAdapter($result));
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getShowNode()
    {
        $result = $this->nodeService->getShowNode();
        $resource = new Collection($result,new NodeTransformer());
        $this->setData($resource);
        return $this->response();
    }
}
