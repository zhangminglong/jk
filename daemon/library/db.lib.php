<?php

/**
 * 数据库操作类库
 * @author	Evan<tangzwgo@163.com>
 * @since	2016-03-20
 */

/** 
 * 【SQL格式说明】
 * 	·以冒号(:)加键名(keyname)作为预绑定键名 示例：	(可读性更强，解析效率更高，强烈建议使用)
 *   	"UPDATE user_info SET sex=:sex WHERE uid=:uid" , ['sex'=>$sex,'uid'=>$uid]
 *      ·以问号(?)作为与绑定键名 示例：					(可读性较弱，解析较慢，特别是参数比较多时)
 *  	"UPDATE user_info SET sex=? WHERE uid=?""  ,		 [$sex, $uid]
 *
 * 【公用函数】
 *  //执行SQL 只返回成功失败 一般用于增删改操作等写操作
 *  DB::Query("UPDATE user_info SET sex=:sex WHERE uid=:uid", ['sex'=>$sex,'uid'=>$uid]);
 *  //查询多行	返回二维数组 一般用于select操作
 *  DB::SELECT("SELECT * FROM user_info WHERE uid=:uid",['uid'=>123]);
 *  //DB::SELECT()同名函数
 *  DB::getAll($sql, $params);//as same as DB::SELECT($sql, $params);
 *  //查询一行 返回一维数组
 *  DB::getOne($sql, $params);//as same as DB::SELECT($sql, $params)[0];
 *  //插入并返回插入的自增ID  失败返回FALSE
 *  DB::insert($sql, $params);
 *  //删除并返回影响行数 	失败返回FALSE
 *  DB::delete($sql, $params);
 *  //更新并返回影响行数 	失败返回FALSE
 *  DB::update($sql, $params);
 */
class DB {
    /**
     * PDO实例数组
     * @var array[PDO]
     */
    protected static $instances;
    protected static $pdo_key_curr;

    /**
     * @var PDOStatement对象
     */
    protected static $PDOStatement;

    /**
     * @var string 马上要执行的SQL语句
     */
    protected static $sql;

    /**
     * 被尝试执行的SQL
     * @var array
     */
    protected static $executed_sql = array();

    /**
     * @var 执行SQL操作返回的错误
     */
    protected static $error = array();

    /**
     * 存储用于操作数据库的host username password database_name table_name等信息
     * @var array 
     */
    protected static $config = array();
    
    /**
     * 默认必须要加载的配置文件名前缀(替代下面的*号)，后期用户可以自定义补充新的配置文件
     * 配置位于config/database/*.cfg.php
     * @var string
     */
    protected static $db_config_base = 'test';
    
    protected static $query_callback = null;

    /**
     * 设置回调
     * @param [type] $callback_function [description]
     */
    public static function setQueryCallback($callback_function) {
        self::$query_callback = $callback_function;
    }

    /**
     * self::SELECT()同名函数 查询多行数据
     * @param  string $sql    要执行的SQL
     * @param  array  $params 要绑定的参数
     * @param  string $with_column_key 如果需要某一列作为二维数组key，则此参数为该列名，默认不需要
     * @return array/false    二维数组或失败
     */
    public static function getAll($sql, $params = array(), $with_column_key = false) {
        return self::select($sql, $params, $with_column_key);
    }

    /**
     * 查询一行 as same as DB::SELECT($sql, $param)[0]
     * @param  string $sql    要执行的SQL
     * @param  array  $params 要绑定的参数
     * @return array/false    一维数组或失败
     */
    public static function getOne($sql, $params = array()) {
        $res = self::select($sql, $params, false);
        if ($res) {
            return $res[0];
        }
        return $res;
    }

    /**
     * 查询多行数据
     * @param  string $sql    要执行的SQL
     * @param  array  $params 要绑定的参数
     * @param  string $with_column_key 如果需要某一列作为二维数组key，则此参数为该列名，默认不需要
     * @return array/false    二维数组或失败
     */
    public static function select($sql, $params = array(), $with_column_key = false) {
        if (self::Query($sql, $params)) {
            if ($with_column_key) {
                $rows = array();
                while ($row = self::$PDOStatement->fetch(PDO::FETCH_ASSOC)) {
                    $rows[$row[$with_column_key]] = $row;
                }
                return $rows;
            } else {
                return self::$PDOStatement->fetchAll(PDO::FETCH_ASSOC);
            }
        } else {
            return false;
        }
    }

    /**
     * 插入并返回lastInsertId
     * @param [type] $sql    [description]
     * @param array  $params [description]
     */
    public static function insert($sql, $params = array()) {
        return self::InsertWithLastId($sql, $params);
    }

    /**
     * insert同名函数
     * @param [type] $sql    [description]
     * @param array  $params [description]
     */
    public static function InsertWithLastId($sql, $params = array()) {
        $last_id = 'last_id';
        $ret = self::Query($sql, $params, $last_id);
        if ($ret) {
            return $last_id ? : $ret;
        }
        return $ret;
    }

    /**
     * 删除并返回影响行数 失败返回FALSE
     * @param  [type] $sql    [description]
     * @param  array  $params [description]
     * @return [type]         [description]
     */
    public static function delete($sql, $params = array()) {
        return self::deleteOrUpdate($sql, $params);
    }

    /**
     * 更新并返回影响行数 失败返回FALSE
     * @param  [type] $sql    [description]
     * @param  array  $params [description]
     * @return [type]         [description]
     */
    public static function update($sql, $params = array()) {
        return self::deleteOrUpdate($sql, $params);
    }

    /**
     * 删除或更新并返回影响行数  失败返回FALSE
     * @param  [type] $sql    [description]
     * @param  array  $params [description]
     * @return [type]         [description]
     */
    protected static function deleteOrUpdate($sql, $params = array()) {
        $rowCount = 'rows';
        $ret = self::Query($sql, $params, $rowCount);
        if ($ret) {
            return $rowCount;
        }
        return $ret;
    }

    public static function affectedRows() {
        return self::$PDOStatement->rowCount();
    }

    /**
     * 执行一条SQL语句，并返回执行结果
     * @param string SQL语句
     * @param array  绑定的参数
     * @return bool  是否成功
     */
    public static function Query($sql, $params = array(), &$ext_info = null) {
        self::$sql = $sql;
        //创建PDO
        $time = microtime(true);
        self::$pdo_key_curr = self::getInstance();
        self::$PDOStatement = self::$instances[self::$pdo_key_curr]->prepare($sql);
        if ($params && is_array($params)) {
            foreach ($params as $key => $value) {
                if (is_int($value)) {
                    $PARAM_TYPE = PDO::PARAM_INT;
                } else {
                    $PARAM_TYPE = PDO::PARAM_STR;
                }
                if (is_numeric($key)) {
                    self::$PDOStatement->bindValue($key + 1, $value, $PARAM_TYPE);
                } else {
                    $rr = self::$PDOStatement->bindValue(':' . $key, $value, $PARAM_TYPE);
                }
            }
        }
        $ret = self::$PDOStatement->execute();
        $time = microtime(true) - $time;
        if ($ret) {
            switch ($ext_info) {
                case 'last_id':
                    $ext_info = self::$instances[self::$pdo_key_curr]->lastInsertId();
                    break;
                case 'rows':
                    $ext_info = self::$PDOStatement->rowCount();
                    break;
                default:
                    # code...
                    break;
            }
            self::$query_callback && call_user_func_array(self::$query_callback, array('sql' => $sql, 'params' => $params));           
        } else {
            self::$error[] = self::$PDOStatement->errorInfo();
            self::$executed_sql[] = array('sql' => $sql, 'params' => $params, 'time' => $time, 'error' => self::$PDOStatement->errorInfo());            
        }
        return $ret;
    }

    /**
     * 根据具体的参数创建PDO实例
     * @param 配置信息
     * @return pdo PDO实例的KEY self::$instances[$key]
     */
    protected static function getInstance($config = null) {
        !$config && $config = self::$config;
        switch ($config['driver']) {
            case 'mysql':
                $dsn = $config['driver'] . ':dbname=' . $config['database'] . ';host=' . $config['host'].';charset=' . $config['charset'];
                break;
            default:
                # code...
                break;
        }

        $key = $config['driver'] . ':host=' . $config['host'] . ';username=' . $config['username'];
        if (empty(self::$instances[$key]) || !(self::$instances[$key] instanceof PDO)) {            
            self::$instances[$key] = new PDO($dsn, $config['username'], $config['password'], array(PDO::ATTR_TIMEOUT => 2));
        }

        return $key;
    }
    
    /**
     * 设置数据库表配置文件 initConfig同名函数
     * @return bool
     */
    public static function cfgFile($config) {
        return self::initConfig($config);
    }

    /**
     * 初始化配置文件
     * @param type $config
     * @return type
     */
    public static function initConfig($config = null) {
        if (empty(self::$config)) {
            self::$config = self::getConfig('database/', self::$db_config_base);
        }
        if ($config) {
            $config_arr = self::getConfig('database/', $config);
            if ($config_arr && is_array($config_arr)) {
                foreach ($config_arr as $key => $value) {
                    self::$config[$key] = $value;
                }
            }
        }
        return self::$config;
    }
    
    /**
     * 加载配置文件
     * @param type $dir_name
     * @param type $config
     * @return type
     */
    protected static function getConfig($dir_name, $config) {
        return include_once CONFIG_PATH .$dir_name.$config.'.cfg.php';
    }
}
