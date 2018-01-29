<?php
namespace Home\Service;
use Think\Model;

/**
 * 发送模板消息
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-10
 */
class TemplateService extends Model {
    /**
     * 入口方法
     * @param type $postObj
     */
    public function run($data) {
        if(!is_array($data) 
                || !isset($data['touser']) 
                || !isset($data['template_id']) 
                || !isset($data['url'])
                || !isset($data['data'])) {
            return false;
        }
        
        //获取access token
        $accessToken = \Home\Org\Wechat\WechatApi::getAccessToken();
        
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$accessToken}";
        $result = \Home\Org\Util\Http::post($url,$data);
        
        $res = json_decode($result, true);
        if(isset($res['errcode']) && $res['errcode'] == 0) {
            //发送成功
            return true;
        } else {
            //发送失败
            return false;
        }
    }
}