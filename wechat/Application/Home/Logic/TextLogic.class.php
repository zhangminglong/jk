<?php
namespace Home\Logic;
use Think\Model;

/**
 * 文本消息处理器
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-10
 */
class TextLogic extends Model {
    /**
     * 入口方法
     * @param type $postObj
     */
    public function run($postObj){
        //用户发送消息
        $content = trim($postObj->Content);
        
        //获取关键字路由列表
        $keywordRouter = C('KEYWORD_ROUTER');
        
        //将用户发送的内容作为关键字
        $router = $keywordRouter['_DEFAULT'];
        if(isset($keywordRouter[$content])) {
            $router = $keywordRouter[$content];
        }
        
        switch ($router) {
            case 'Text':
                //回复文本消息
                $this->sendTextMsg($postObj);
                break;
            case 'Image':
                //回复图片消息
                $this->sendImageMsg($postObj);
                break;
            case 'Voice':
                //回复语音消息
                $this->sendVoiceMsg($postObj);
                break;
            case 'Video':
                //回复视频消息
                $this->sendVideoMsg($postObj);
                break;
            case 'Music':
                //回复音乐消息
                $this->sendMusicMsg($postObj);
                break;
            case 'News':
                //回复图文消息
                $this->sendNewsMsg($postObj);
                break;
            default :
                //其他操作
                break;
        }
    }
    
    /**
     * 回复文本消息
     * @param type $postObj
     */
    private function sendTextMsg($postObj) {
        $fromUserName = $postObj->FromUserName;//发送者微信号          
        $toUserName = $postObj->ToUserName;//开发者微信号
        $content = trim($postObj->Content); //用户发送消息
        
        //关键字模板列表
        $textTemplate = C('TEXT_TEMPLATE');
        
        //获取关键字模板
        $template = $textTemplate['_DEFAULT'];
        if(isset($textTemplate[$content])) {
            $template = $textTemplate[$content];
        }
        
        $data = array();
        $data['ToUserName'] = $fromUserName;
        $data['FromUserName'] = $toUserName;
        $data['Content'] = $template['Content'];
        
        D('Text','Service')->run($data);
    }
    
    /**
     * 回复图片消息
     * @param type $postObj
     */
    private function sendImageMsg($postObj) {
        $fromUserName = $postObj->FromUserName;//发送者微信号          
        $toUserName = $postObj->ToUserName;//开发者微信号
        $content = trim($postObj->Content); //用户发送消息
        
        //关键字模板列表
        $imageTemplate = C('IMAGE_TEMPLATE');
        
        //获取关键字模板
        $template = $imageTemplate['_DEFAULT'];
        if(isset($imageTemplate[$content])) {
            $template = $imageTemplate[$content];
        }
        
        $data = array();
        $data['ToUserName'] = $fromUserName;
        $data['FromUserName'] = $toUserName;
        $data['MediaId'] = $template['MediaId'];
        
        D('Image','Service')->run($data);
    }
    
    /**
     * 回复语音消息
     * @param type $postObj
     */
    private function sendVoiceMsg($postObj) {
        $fromUserName = $postObj->FromUserName;//发送者微信号          
        $toUserName = $postObj->ToUserName;//开发者微信号
        $content = trim($postObj->Content); //用户发送消息
        
        //关键字模板列表
        $voiceTemplate = C('VOICE_TEMPLATE');
        
        //获取关键字模板
        $template = $voiceTemplate['_DEFAULT'];
        if(isset($voiceTemplate[$content])) {
            $template = $voiceTemplate[$content];
        }
        
        $data = array();
        $data['ToUserName'] = $fromUserName;
        $data['FromUserName'] = $toUserName;
        $data['MediaId'] = $template['MediaId'];
        
        D('Voice','Service')->run($data);
    }
    
    /**
     * 回复视频消息
     * @param type $postObj
     */
    private function sendVideoMsg($postObj) {
        $fromUserName = $postObj->FromUserName;//发送者微信号          
        $toUserName = $postObj->ToUserName;//开发者微信号
        $content = trim($postObj->Content); //用户发送消息
        
        //关键字模板列表
        $videoTemplate = C('VIDEO_TEMPLATE');
        
        //获取关键字模板
        $template = $videoTemplate['_DEFAULT'];
        if(isset($videoTemplate[$content])) {
            $template = $videoTemplate[$content];
        }
        
        $data = array();
        $data['ToUserName'] = $fromUserName;
        $data['FromUserName'] = $toUserName;
        $data['MediaId'] = $template['MediaId'];
        $data['Title'] = $template['Title'];
        $data['Description'] = $template['Description'];
        
        D('Video','Service')->run($data);
    }
    
    /**
     * 回复音乐消息
     * @param type $postObj
     */
    private function sendMusicMsg($postObj) {
        $fromUserName = $postObj->FromUserName;//发送者微信号          
        $toUserName = $postObj->ToUserName;//开发者微信号
        $content = trim($postObj->Content); //用户发送消息
        
        //关键字模板列表
        $musicTemplate = C('MUSIC_TEMPLATE');
        
        //获取关键字模板
        $template = $musicTemplate['_DEFAULT'];
        if(isset($musicTemplate[$content])) {
            $template = $musicTemplate[$content];
        }
        
        $data = array();
        $data['ToUserName'] = $fromUserName;
        $data['FromUserName'] = $toUserName;        
        $data['Title'] = $template['Title'];
        $data['Description'] = $template['Description'];
        $data['MusicURL'] = $template['MusicURL'];
        $data['HQMusicUrl'] = $template['HQMusicUrl'];
        $data['ThumbMediaId'] = $template['ThumbMediaId'];
        
        D('Music','Service')->run($data);
    }
    
    /**
     * 回复图文消息
     * @param type $postObj
     */
    private function sendNewsMsg($postObj) {
        $fromUserName = $postObj->FromUserName;//发送者微信号          
        $toUserName = $postObj->ToUserName;//开发者微信号
        $content = trim($postObj->Content); //用户发送消息
        
        //关键字模板列表
        $newsTemplate = C('NEWS_TEMPLATE');
        
        //获取关键字模板
        $template = $newsTemplate['_DEFAULT'];
        if(isset($newsTemplate[$content])) {
            $template = $newsTemplate[$content];
        }
        
        $data = array();
        $data['ToUserName'] = $fromUserName;
        $data['FromUserName'] = $toUserName;        
        $data['Articles'] = $template['Articles'];
        
        D('News','Service')->run($data);
    }
}