<?php
/**
 * 配置类库
 * @author	Evan<tangzwgo@163.com>
 * @since	2016-03-20
 */
class Config {
    /**
     * 存储配置文件
     * @var type 
     */
    protected static $config = array();

    /**
     * 加载配置文件
     * @param type $cfgPath
     * demo1：part/config   加载单个配置文件
     * demo2：array('part/config1','part/config2')  加载多个配置文件
     */
    public static function cfgFile($cfgPath) {
        if(is_array($cfgPath)) {
            //加载多个配置文件
            foreach ($cfgPath as $cfg) {
                self::$config = array_merge(self::loadConfig($cfg), self::$config);
            }
        } else {
            //加载单个配置文件
            self::$config = self::loadConfig($cfgPath);
        }
    }        
    
    /**
     * 加载配置文件
     * @param type $dir_name
     * @param type $config
     * @return type
     */
    protected static function loadConfig($dir_name) {
        return include_once CONFIG_PATH .$dir_name.'.cfg.php';
    }
    
    /**
     * 获取配置项
     * @param type $key
     */
    public static function getConfig($key) {
        if(!self::$config) {
            return false;
        }
        return self::$config[$key];
    }
}