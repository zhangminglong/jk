<?php
namespace Home\Logic;
use Think\Model;

/**
 * 事件消息处理器
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-10
 */
class EventLogic extends Model {
    /**
     * 入口方法
     * @param type $postObj
     */
    public function run($postObj){
        //事件类型
        $event = strtolower($postObj->Event);
        
        switch ($event) {
            case 'subscribe':
                //关注事件
                $this->subscribe($postObj);
                break;
            case 'unsubscribe':
                //取消关注事件
                $this->unsubscribe($postObj);
                break;
            case 'scan':
                //扫描带参数的二维码，用户未关注时，会推送subscribe事件，用户已关注时会推送scan事件
                $this->scan($postObj);
                break;
            case 'location':
                //上报地理位置事件
                $this->location($postObj);
                break;
            case 'click':
                //点击菜单拉取消息的事件
                $this->click($postObj);
                break;
            case 'view':
                //点击菜单跳转链接的事件
                $this->view($postObj);
                break;
            case 'templatesendjobfinish':
                //模板消息发送结束的事件
                $this->templateSendJobFinish($postObj);
                break;
        }        
    }
    
    /**
     * 处理用户关注事件
     * @param type $postObj
     */
    private function subscribe($postObj) {
        //扫描带参数二维码关注
        $event_key = $postObj->EventKey;
        if(stripos($event_key, 'qrscene_') === 0) {
        	$scene_id = substr($event_key, strpos($event_key, '_')+1);
        }
    }
    
    /**
     * 处理用户取消关注事件
     * @param type $postObj
     */
    private function unsubscribe($postObj) {
        
    }
    
    /**
     * 处理用户扫描带参数的二维码，用户未关注时，会推送subscribe事件，用户已关注时会推送scan事件
     * @param type $postObj
     */
    private function scan($postObj) {
    	//扫描带参数二维码
    	$event_key = $postObj->EventKey;
    	if(stripos($event_key, 'qrscene_') === 0) {
    		$scene_id = substr($event_key, strpos($event_key, '_')+1);
    	}
    }
    
    /**
     * 处理用户上报地理位置事件
     * @param type $postObj
     */
    private function location($postObj) {
        
    }
    
    /**
     * 处理用户点击菜单拉取消息的事件
     * @param type $postObj
     */
    private function click($postObj) {
        
    }
    
    /**
     * 处理用户点击菜单跳转链接的事件
     * @param type $postObj
     */
    private function view($postObj) {
        
    }
    
    /**
     * 处理模板消息发送结束的事件
     * @param type $postObj
     */
    private function templateSendJobFinish($postObj) {
        
    }
}