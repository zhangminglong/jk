<?php
/**
 * 脚本入口
 * @author	Evan<tangzwgo@163.com>
 * @since	2016-03-20
 */
ini_set('date.timezone','PRC');
set_time_limit(0);
ini_set('memory_limit', -1);  //不限制内存
ini_set("display_errors", "On");
error_reporting(E_ERROR);

//载入入口文件
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'index.php';

//数据库执行日志
db::setQueryCallback('Log::dbLog');