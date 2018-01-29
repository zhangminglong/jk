<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\MyRegisterRequest;
use App\Services\Auth\RegisterService;
use App\Services\Auth\UserService;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Item;

class MyRegisterController extends Controller
{
    protected $userService;

    protected $registerService;

    protected $isInvite;

    public function __construct(UserService $userService,
                                RegisterService $registerService)
    {
        $this->userService = $userService;
        $this->registerService = $registerService;
        $this->isInvite = config('g9zz.invite_code.is_invite');

    }

    /**
     * @param MyRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MyRegisterRequest $request)
    {
        $result = $this->registerService->store($request);
        $resource = new Item($result,new UserTransformer());
        $this->setData($resource);
        return $this->response();
    }


}
