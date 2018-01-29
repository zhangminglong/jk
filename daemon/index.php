<?php
/**
 * 公共入口
 * @author	Evan<tangzwgo@163.com>
 * @since	2016-03-20
 */

//目录分隔符
defined('DS') || define('DS', DIRECTORY_SEPARATOR);

//项目根路径
defined('APP_PATH') || define('APP_PATH', __DIR__);

//日志文件存放根目录
defined('LOG_PATH') || define('LOG_PATH', APP_PATH . DS . 'log' . DS);

//类库根目录
defined('LIB_PATH') || define('LIB_PATH', APP_PATH . DS . 'library' . DS);

//配置文件存放根目录
defined('CONFIG_PATH') || define('CONFIG_PATH', APP_PATH . DS . 'config' . DS);

//载入公共类库
$files = scandir(LIB_PATH);
if(is_array($files) && count($files)>0) {
    foreach($files as $file) {
        if(is_file(LIB_PATH.$file) && preg_match("/\.(lib.php)$/i", $file)) {
            require_once LIB_PATH.$file;
        }
    }
}