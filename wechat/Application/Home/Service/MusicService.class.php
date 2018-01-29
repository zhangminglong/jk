<?php
namespace Home\Service;
use Think\Model;

/**
 * 回复音乐消息
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-10
 */
class MusicService extends Model {
    /**
     * 入口方法
     * @param type $postObj
     */
    public function run($data) {        
        if(!is_array($data) 
                || !isset($data['ToUserName']) 
                || !isset($data['FromUserName']) 
                || !isset($data['Title']) 
                || !isset($data['Description']) 
                || !isset($data['MusicURL'])
                || !isset($data['HQMusicUrl'])
                || !isset($data['ThumbMediaId'])) {
            return false;
        }
        
        //将回复消息拼装成xml格式数据
        $xml = array();
        $xml[] = '<xml>';
        $xml[] = '<ToUserName><![CDATA[' . $data['ToUserName'] . ']]></ToUserName>';
        $xml[] = '<FromUserName><![CDATA[' . $data['FromUserName'] . ']]></FromUserName>';
        $xml[] = '<CreateTime>' . time() . '</CreateTime>';
        $xml[] = '<MsgType><![CDATA[music]]></MsgType>';
        $xml[] = '<Music>';        
        $xml[] = '<Title><![CDATA[ ' . $data['Title'] . ' ]]></Title>';
        $xml[] = '<Description><![CDATA[ ' . $data['Description'] . ' ]]></Description>';
        $xml[] = '<MusicUrl><![CDATA[ ' . $data['MusicUrl'] . ' ]]></MusicUrl>';
        $xml[] = '<HQMusicUrl><![CDATA[ ' . $data['HQMusicUrl'] . ' ]]></HQMusicUrl>';
        $xml[] = '<ThumbMediaId><![CDATA[ ' . $data['ThumbMediaId'] . ' ]]></ThumbMediaId>';
        $xml[] = '</Music>';
        $xml[] = '</xml>';
        $xmlMsg = implode($xml, "\n");
        echo $xmlMsg;
        exit(0);
    }
}