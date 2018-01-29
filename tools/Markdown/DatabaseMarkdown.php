<?php
/**
 * 将数据库表结构导出为markdown文档
 * @author	Evan<tangzwgo@foxmail.com>
 * @since	2016-03-31
 */
class DatabaseMarkdown {
    private static $_host = '';//数据库服务器地址
    private static $_user = '';//用户名
    private static $_pass = '';//密码
    private static $_database = '';//数据库
    
    private static $_filePath = 'database.md';
    
    /**
     * 脚本入口
     */
    public function run() {
        //连接数据库
        $conn = mysql_connect(self::$_host, self::$_user, self::$_pass);
        !$conn && die("conn fail！");
        //选择数据库
        mysql_select_db(self::$_database) or die("conn db fail！");
        
        $tableList = array();
        
        //查询所有表
        $tableResult = mysql_query("SHOW TABLES");
        while ($tableRow = mysql_fetch_array($tableResult)) {
            //表名
            $tableName = $tableRow[0];
            
            //查询表中所有字段
            $fieldResult = mysql_query("SHOW FULL FIELDS FROM {$tableName}");
            //字段
            $fieldList = array();
            while ($fieldRow = mysql_fetch_array($fieldResult)) {
                //字段名
                $field = $fieldRow['Field'];
                //字段类型
                $type = $fieldRow['Type'];
                //字段描述
                $comment = $fieldRow['Comment'];
                //索引
                $key = $fieldRow['Key'];
                //默认值
                $default = $fieldRow['Default'];
                
                $fieldItem = array();
                $fieldItem['field'] = $field;
                $fieldItem['type'] = $type;
                $fieldItem['comment'] = $comment;
                $fieldItem['key'] = $key;
                $fieldItem['default'] = $default;
                
                $fieldList[$field] = $fieldItem;
            }
            
            //建表语句
            $sqlResult = mysql_query("SHOW CREATE TABLE {$tableName}");
            $sqlRow = mysql_fetch_array($sqlResult);
            $sql = $sqlRow['Create Table'];
            
            //表注释
            $commentResult = mysql_query("SELECT TABLE_COMMENT FROM information_schema.tables WHERE table_name='{$tableName}'");
            $commentRow = mysql_fetch_array($commentResult);
            $comment = $commentRow['TABLE_COMMENT'];
            
            $table = array();
            $table['name'] = $tableName;
            $table['comment'] = $comment;
            $table['fieldList'] = $fieldList;
            $table['sql'] = $sql;
            
            $tableList[$tableName] = $table;
        }
        
        //导出为markdown文档        
        //1、生成头部
        $this->writeContent("# 数据库表结构文档 v1.0");
        
        //2、生成文档说明
        $this->writeContent("## 简介");
        $this->writeContent("    数据库表结构说明文档......");
        
        //3、生成目录
        $this->writeContent("## 目录");
        $i = 1;
        foreach ($tableList as $table) {
            $this->writeContent("{$i}.[{$table['comment']}({$table['name']})](#{$table['name']})");
            
            $i++;
        }
        
        //生成正文
        $this->writeContent("***");
        $i = 1;
        foreach ($tableList as $table) {
            $this->writeContent('**<a id="'.$table['name'].'" href="#'.$table['name'].'">'.$i.'.'.$table['comment'].'('.$table['name'].')</a>**');
            //表结构
            $this->writeContent("###### 表结构");
            $this->writeContent("> |字段名|字段类型|字段描述|PK/FK|默认值|备注|");
            $this->writeContent("|-----|:-----:|:-----:|:-----:|-----:|");
            foreach ($table['fieldList'] as $field) {
                $this->writeContent("|{$field['field']}|{$field['type']}|{$field['comment']}|{$field['key']}|{$field['default']}||");
            }
            
            //建表sql
            $this->writeContent("###### 建表SQL");
            $this->writeContent("```sql");
            $this->writeContent($table['sql']);
            $this->writeContent("```");
            //换两行
            $this->writeContent("\n");
            
            $i++;
        }
    }
    
    /**
     * 将数据写入文件
     * @param type $content
     */
    private function writeContent($content) {
        error_log($content . "\n",3,self::$_filePath);
    }
}

//启动脚本
$obj = new DatabaseMarkdown();
$obj->run();
