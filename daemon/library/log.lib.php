<?php
/**
 * 日志类库
 * @author	Evan<tangzwgo@163.com>
 * @since	2016-03-20
 */
class Log {
    /**
     * 写日志
     * @param string $fileName 文件名   命名规则：当前类名_日志文件名.log
     * @param string $content 日志内容
     * @param string $extend_path 扩展路径  如：order
     * @param bool $isAutoWrap 是否自动添加\n换行，true时自动添加
     * @param bool $isAutoExt 文件名是否自动添加日期后缀，true时自动添加
     */
    
    public static function printLog($fileName, $content, $extend_path = '', $isAutoWrap = true, $isAutoExt = true){
        $fileName = substr(strtolower(preg_replace("/[^a-zA-Z0-9_.]/i", "", $fileName)), 0, 128);
        if ($fileName == '') {
            $fileName = 'default.log';
        }
        
        $filePath = LOG_PATH . $extend_path . DS;
        if(!is_dir($filePath)) {
            mkdir($filePath);
        }
        
        $filePath .= $fileName;
        
        $isAutoExt && $filePath .= "." . date("Ymd");
        
        $isAutoWrap && $content .= "\n";
        
        error_log("[" . date("Y-m-d H:i:s") . "] " . $content, 3, $filePath);
    }

    /**
     * 数据库操作日志
     * @param type $sql
     * @param type $params
     */
    public static function dbLog($sql, $params) {
        $json_params = json_encode($params);
        self::printLog('log_db_query.log', "[sql:{$sql}] [params:{$json_params}]", 'database');
    }
}