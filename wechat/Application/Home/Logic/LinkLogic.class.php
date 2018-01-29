<?php
namespace Home\Logic;
use Think\Model;

/**
 * 链接消息处理器
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-10
 */
class TextLogic extends Model {
    /**
     * 入口方法
     * @param type $postObj
     */
    public function run($postObj){
        $fromUserName = $postObj->FromUserName;//发送者微信号          
        $toUserName = $postObj->ToUserName;//开发者微信号
        $createTime = $postObj->CreateTime;//消息创建时间
        $title = $postObj->Title; //消息标题
        $description = $postObj->Description; //消息描述
        $url = $postObj->Url; //消息链接
        
        
    }
}