<?php
namespace Home\Service;
use Think\Model;

/**
 * 回复视频消息
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-10
 */
class VideoService extends Model {
    /**
     * 入口方法
     * @param type $postObj
     */
    public function run($data) {        
        if(!is_array($data) 
                || !isset($data['ToUserName']) 
                || !isset($data['FromUserName']) 
                || !isset($data['MediaId']) 
                || !isset($data['Title']) 
                || !isset($data['Description'])) {
            return false;
        }
        
        //将回复消息拼装成xml格式数据
        $xml = array();
        $xml[] = '<xml>';
        $xml[] = '<ToUserName><![CDATA[' . $data['ToUserName'] . ']]></ToUserName>';
        $xml[] = '<FromUserName><![CDATA[' . $data['FromUserName'] . ']]></FromUserName>';
        $xml[] = '<CreateTime>' . time() . '</CreateTime>';
        $xml[] = '<MsgType><![CDATA[video]]></MsgType>';
        $xml[] = '<Video>';
        $xml[] = '<MediaId><![CDATA[ ' . $data['MediaId'] . ' ]]></MediaId>';
        $xml[] = '<Title><![CDATA[ ' . $data['Title'] . ' ]]></Title>';
        $xml[] = '<Description><![CDATA[ ' . $data['Description'] . ' ]]></Description>';
        $xml[] = '</Video>';
        $xml[] = '</xml>';
        $xmlMsg = implode($xml, "\n");
        echo $xmlMsg;
        exit(0);
    }
}