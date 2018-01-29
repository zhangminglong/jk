<?php
namespace Home\Service;
use Think\Model;

/**
 * 回复图片消息
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-10
 */
class ImageService extends Model {
    /**
     * 入口方法
     * @param type $data
     */
    public function run($data) {        
        if(!is_array($data) || !isset($data['ToUserName']) || !isset($data['FromUserName']) || !isset($data['media_id'])) {
            return false;
        }
        
        //将回复消息拼装成xml格式数据
        $xml = array();
        $xml[] = '<xml>';
        $xml[] = '<ToUserName><![CDATA[' . $data['ToUserName'] . ']]></ToUserName>';
        $xml[] = '<FromUserName><![CDATA[' . $data['FromUserName'] . ']]></FromUserName>';
        $xml[] = '<CreateTime>' . time() . '</CreateTime>';
        $xml[] = '<MsgType><![CDATA[image]]></MsgType>';
        $xml[] = '<Image>';
        $xml[] = '<MediaId><![CDATA[ ' . $data['media_id'] . ' ]]></MediaId>';
        $xml[] = '</Image>';
        $xml[] = '</xml>';
        $xmlMsg = implode($xml, "\n");
        echo $xmlMsg;
        exit(0);
    }
}