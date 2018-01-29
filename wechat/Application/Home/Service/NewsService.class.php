<?php
namespace Home\Service;
use Think\Model;

/**
 * 回复图文消息
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-10
 */
class NewsService extends Model {
    /**
     * 入口方法
     * @param type $postObj
     */
    public function run($data) {        
        if(!is_array($data) 
                || !isset($data['ToUserName']) 
                || !isset($data['FromUserName']) 
                || !isset($data['Articles']) 
                || !is_array($data['Articles'])
                || count($data['Articles']) == 0) {
            return false;
        }
        
        //图文条数
        $articleCount = count($data['Articles']);
        
        //将回复消息拼装成xml格式数据
        $xml = array();
        $xml[] = '<xml>';
        $xml[] = '<ToUserName><![CDATA[' . $data['ToUserName'] . ']]></ToUserName>';
        $xml[] = '<FromUserName><![CDATA[' . $data['FromUserName'] . ']]></FromUserName>';
        $xml[] = '<CreateTime>' . time() . '</CreateTime>';
        $xml[] = '<MsgType><![CDATA[news]]></MsgType>';
        $xml[] = '<ArticleCount>' . $articleCount . '</ArticleCount>';
        $xml[] = '<Articles>';        
        foreach ($data['Articles'] as $article) {
            $xml[] = '<item>';
            $xml[] = '<Title><![CDATA[' . $article['Title'] . ']]></Title>';
            $xml[] = '<Description><![CDATA[' . $article['Description'] . ']]></Description>';
            $xml[] = '<PicUrl><![CDATA[' . $article['PicUrl'] . ']]></PicUrl>';
            $xml[] = '<Url><![CDATA[' . $article['Url'] . ']]></Url>';
            $xml[] = '</item>';
        }
        $xml[] = '</Articles>';
        $xml[] = '</xml>';
        $xmlMsg = implode($xml, "\n");
        echo $xmlMsg;
        exit(0);
    }
}