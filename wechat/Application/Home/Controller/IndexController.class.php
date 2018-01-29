<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 微信公众号入口
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-07
 */
class IndexController extends Controller {
    
    /**
     * 入口
     */
    public function index() {
        if (isset($_GET['echostr'])) {
            //URL地址验证
            $this->valid();
        } else {
            //消息处理接口
            $this->run();
        }
    }
    
    /**
     * 微信URL地址验证
     */
    private function valid() {
        $echoStr = $_GET["echostr"];

        //验证签名是否合法
        if (\Home\Org\Wechat\WechatApi::checkSignature()) {
            echo $echoStr;
            exit;
        }
    }
    
    /**
     * 消息处理接口
     */
    private function run() {
        header("Content-type: text/xml; charset=utf-8");
        $this->responseMsg();
    }
    
    /**
     * 发送消息
     */
    private function responseMsg() {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        //验证签名是否正确
        if (!\Home\Org\Wechat\WechatApi::checkSignature()) {
            exit(0);
        }
        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $msgType = strtolower($postObj->MsgType);//消息类型            
            
            //微信事件推送
            switch ($msgType) {
                case 'text':
                    //文本消息
                    D('Text','Logic')->run($postObj);
                    break;
                case 'image':
                    //图片消息
                    D('Image','Logic')->run($postObj);
                    break;
                case 'voice':
                    //语音消息
                    D('Voice','Logic')->run($postObj);
                    break;
                case 'video':
                    //视频消息
                    D('Video','Logic')->run($postObj);
                    break;
                case 'shortvideo':
                    //小视频消息
                    D('ShortVideo','Logic')->run($postObj);
                    break;
                case 'location':
                    //地理位置消息
                    D('Location','Logic')->run($postObj);
                    break;
                case 'link':
                    //链接消息
                    D('Link','Logic')->run($postObj);
                    break;
                case 'event':
                    //事件推送消息
                    D('Event','Logic')->run($postObj);
                    break;
            }
        } else {
            echo "";
        }
    }
}