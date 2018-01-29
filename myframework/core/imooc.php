<?php
namespace core;
/**
 * Created by PhpStorm.
 * User: sailwish004
 * Date: 2017/2/10
 * Time: 16:46
 */
class imooc
{
    public static $classMap = array();
    public static function run() {
        $route = new \core\lib\route();
    }

    /**
     * 自动加载类库
     * @param $class 自动引入的类的名称
     */
    public static function load($class) {
        // 正常情况下创建一个对象应该是new \core\route();
        // 函数传入的参数$class = '\core\route';
        // 真正引入的路径IMOOC.'/core/route.php'
        $class = str_replace('\\', '/', $class);
        if (isset($classMap[$class])) {
            return true;
        }
        $file = IMOOC.'/'.$class.'.php';
        if (is_file($file)) {
            include $file;
            self::$classMap[$class] = $class;
        }else {
            return false;
        }
    }
}