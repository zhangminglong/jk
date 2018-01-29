<?php
include __DIR__ . '/run.php';

/**
 * 测试
 * @author	Evan<tangzwgo@163.com>
 * @since	2016-03-20
 */

class Test {
    public function run(){
        //打印日志
        Log::printLog('test_test.log', 'hello');
        
        //发送短信
        var_dump(SMS::sendMsg('18508422008', 'hello world'));
        
        //连接数据库
        DB::cfgFile('test');
        $sql = 'select * from ims_heixiu_car_item where id=:id limit 1';
        $result = DB::getOne($sql,array('id'=>1));
        var_dump($result);
        
        //加载配置
        Config::cfgFile('test/test');
        $cfg = Config::getConfig('TEST');
        var_dump($cfg);        
    }
}

$test = new Test();
$test->run();