<?php
namespace Home\Logic;
use Think\Model;

/**
 * 图片消息处理器
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-10
 */
class ImageLogic extends Model {
    /**
     * 入口方法
     * @param type $postObj
     */
    public function run($postObj){
        $fromUserName = $postObj->FromUserName;//发送者微信号          
        $toUserName = $postObj->ToUserName;//开发者微信号
        $createTime = $postObj->CreateTime;//消息创建时间
        $picUrl = $postObj->PicUrl; //图片链接
        $meidaId = $postObj->MediaId; //图片消息媒体id，可以调用多媒体文件下载接口拉取数据
        
        
    }
}