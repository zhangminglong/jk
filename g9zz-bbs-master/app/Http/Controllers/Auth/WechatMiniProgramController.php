<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/20
 * Time: 下午11:26
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Services\Auth\WechatMiniProgramService;

class WechatMiniProgramController extends Controller
{
    protected $wechatMiniProgramService;
    public function __construct(WechatMiniProgramService $wechatMiniProgramService)
    {
        $this->wechatMiniProgramService = $wechatMiniProgramService;
    }






}