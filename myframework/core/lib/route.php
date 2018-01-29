<?php
/**
 * Created by PhpStorm.
 * User: sailwish004
 * Date: 2017/2/10
 * Time: 16:49
 */

namespace core\lib;


class route
{
    public $ctrl;
    public $action;
    public function __construct()
    {
        // 当网址是xxx.com/index/index时，希望访问到的是Index控制器里的index方法
        /**
         * 1、隐藏index.php
         * 2、获取URL中的参数
         * 3、返回对应的控制器和方法
         */
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != "/") {
            $path = $_SERVER['REQUEST_URI'];
            $path_arr = explode('/', trim($path, '/'));
            if (isset($path_arr[0])) {
                $this->ctrl = $path_arr[0];
                unset($path_arr[0]);
            }
            if (isset($path_arr[1])) {
                $this->action = $path_arr[1];
                unset($path_arr[1]);
            }else {
                $this->action = "index";
            }
            // 将URL的多余部分转化为参数 GET
            // id/1/str/2/test/3
            $count = count($path_arr) + 2;
            $i = 2;
            while ($i < $count) {
                if (isset($path_arr[$i+1])) {
                    $_GET[$path_arr[$i]] = $path_arr[$i+1];
                }
                $i += 2;
            }
        }else {
            $this->ctrl = "index";
            $this->action = "index";
        }
    }
}