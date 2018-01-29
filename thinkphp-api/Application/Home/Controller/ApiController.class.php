<?php
namespace Home\Controller;
use Think\Controller;

/**
 * api接口
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-18
 */

class ApiController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 接口入口
     */
    public function index(){
        //检测请求是否合法
        $params = api_check();
        
        //判断请求接口是否存在
        $action = $params['action'];
        if(!method_exists($this,$action)) {
            return Response(1008, '请求不合法');
        }
        
        //调用接口
        $this->$action($params);
    }
    
    /**
     * 测试api接口
     * @param type $params
     */
    private function testApi($params) {        
        //应用信息
        $appInfo = $params['_AppInfo'];       
        return Response(999, '数据获取成功',$appInfo);
    }
}