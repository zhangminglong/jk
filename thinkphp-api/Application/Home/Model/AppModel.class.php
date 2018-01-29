<?php
namespace Home\Model;
use Think\Model;

/**
 * 应用模型
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-18
 */

class AppModel extends Model {
    protected $trueTableName = '';
    
    /**
     * 根据appId获取app信息
     * @param type $appId
     */
    public function getAppInfo($appId) {
        $appList = C('APP');
        
        if(isset($appList[$appId])) {
            return $appList[$appId];
        } else {
            return false;
        }
    }
}
