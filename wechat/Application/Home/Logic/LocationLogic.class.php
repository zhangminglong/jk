<?php
namespace Home\Logic;
use Think\Model;

/**
 * 地理位置消息处理器
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-10
 */
class LocationLogic extends Model {
    /**
     * 入口方法
     * @param type $postObj
     */
    public function run($postObj){
        $fromUserName = $postObj->FromUserName;//发送者微信号          
        $toUserName = $postObj->ToUserName;//开发者微信号
        $createTime = $postObj->CreateTime;//消息创建时间
        $locationX = $postObj->Location_X; //地理位置纬度
        $locationY = $postObj->Location_Y; //地理位置经度
        $scale = $postObj->Scale; //地图缩放大小
        $label = $postObj->Label; //地理位置信息
        
        
    }
}