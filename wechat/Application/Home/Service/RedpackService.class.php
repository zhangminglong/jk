<?php
namespace Home\Service;
use Think\Model;

/**
 * 发送红包
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-10
 */
class RedpackService extends Model {
    /**
     * 入口方法
     * @param type $postObj
     */
    public function run($data) {        
        if(!is_array($data) 
                || !isset($data['openid'])) {
            return false;
        }
        
        $wx_api = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
        $mchid = C('Mchid');
        $appid = C('AppId');
        $client_ip = $_SERVER['SERVER_ADDR'];
        $openid = $data['openid'];
        
        //获取红包模板
        $redpackTemplate = C('REDPACK_TEMPLATE');
        $template = $redpackTemplate['_DEFAULT'];
        if(isset($data['template']) && isset($redpackTemplate[$data['template']])) {
            $template = $redpackTemplate[$data['template']];
        }
        
        //获取红包金额
        if(isset($data['total_amount']) && $data['total_amount'] >= 100) {
            $total_amount = $data['total_amount'];
        } else {
            $total_amount = mt_rand($template['min'],$template['max']);
        }
        //红包金额必须大于1元小于200元
        $total_amount < 100 && $total_amount = 100;
        $total_amount > 20000 && $total_amount = 20000;
        
        $params = array();
        $params['nonce_str'] = md5(time() . mt_rand(10000, 99999));
        $params['mch_billno'] = $mchid . date("Ymd") . substr(time(), -5) . mt_rand(10000, 99999);
        $params['mch_id'] = $mchid;
        $params['wxappid'] = $appid;
        $params['send_name'] = $template['send_name'];
        $params['re_openid'] = $openid;
        $params['total_amount'] = $total_amount;
        $params['total_num'] = 1;
        $params['wishing'] = $template['wishing'];
        $params['client_ip'] = $client_ip;
        $params['act_name'] = $template['act_name'];
        $params['remark'] = $template['remark'];
        $params['sign'] = self::createSign($params);
        
        //将红包数据拼装成xml格式数据，并调用微信发红包接口
        $xml = self::getXML($params);
        $httpRes = self::curl_post_ssl($wx_api, $xml);
        
        if ($httpRes) {
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($httpRes, 'SimpleXMLElement', LIBXML_NOCDATA);
            $return_code = $postObj->return_code;
            $result_code = $postObj->result_code;
            $post_mch_id = $postObj->mch_id;
            $wxappid = $postObj->wxappid;
            $re_openid = $postObj->re_openid;
            $post_total_amount = $postObj->total_amount;
            $post_mch_billno = $postObj->mch_billno;
            //调用成功
            if ($return_code == 'SUCCESS') {                
                if ($result_code == 'SUCCESS') {
                    //商户号，公众号，用户id，金额 都正确
                    if (($post_mch_id == $mchid) && ($wxappid == $appid) && ($re_openid == $openid) && ($post_total_amount == $params['total_amount']) && ($post_mch_billno == $params['mch_billno'])) {
                        //红包发送成功
                        return true;
                    }
                }
            }
        }
        
        return false;
    }
    
    /**
     * 生成签名
     * @param type $params
     * @return type
     */
    private function createSign($params) {
        ksort($params);
        $tmp_str = '';
        foreach ($params as $key => $val) {
            if ($key == 'sign' || $val === '') {
                continue;
            }
            $tmp_str .= $key . "=" . $val . "&";
        }
        return strtoupper(md5($tmp_str . "key=" . C('KEY')));
    }
    
    /**
     * 组织xml参数
     * @param type $params
     */
    private function getXML($params) {
        $xml = "<xml>";
        $xml .= "<sign><![CDATA[{$params['sign']}]]></sign>";
        $xml .= "<mch_billno><![CDATA[{$params['mch_billno']}]]></mch_billno>";
        $xml .= "<mch_id><![CDATA[{$params['mch_id']}]]></mch_id>";
        $xml .= "<wxappid><![CDATA[{$params['wxappid']}]]></wxappid>";
        $xml .= "<send_name><![CDATA[{$params['send_name']}]]></send_name>";
        $xml .= "<re_openid><![CDATA[{$params['re_openid']}]]></re_openid>";
        $xml .= "<total_amount><![CDATA[{$params['total_amount']}]]></total_amount>";
        $xml .= "<total_num><![CDATA[{$params['total_num']}]]></total_num>";
        $xml .= "<wishing><![CDATA[{$params['wishing']}]]></wishing>";
        $xml .= "<client_ip><![CDATA[{$params['client_ip']}]]></client_ip>";
        $xml .= "<act_name><![CDATA[{$params['act_name']}]]></act_name>";
        $xml .= "<remark><![CDATA[{$params['remark']}]]></remark>";
        $xml .= "<nonce_str><![CDATA[{$params['nonce_str']}]]></nonce_str>";
        $xml .= "</xml>";
        return $xml;
    }
    
    /**
     * http请求
     * @param type $url
     * @param type $vars
     * @param type $second
     * @param type $aHeader
     * @return boolean
     */
    private static function curl_post_ssl($url, $vars, $second = 30, $aHeader = array()) {        
        $ch = curl_init();
        //超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        //以下两种方式需选择一种
        //第一种方法，cert 与 key 分别属于两个.pem文件
        //默认格式为PEM，可以注释
        curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
        curl_setopt($ch, CURLOPT_SSLCERT, getcwd() . '/../../Public/Cert/WxRedpackCert/apiclient_cert.pem');
        //默认格式为PEM，可以注释
        curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
        curl_setopt($ch, CURLOPT_SSLKEY, getcwd() . '/../../Public/Cert/WxRedpackCert/apiclient_key.pem');
        curl_setopt($ch, CURLOPT_CAINFO, getcwd() . '/../../Public/Cert/WxRedpackCert/rootca.pem');
        //第二种方式，两个文件合成一个.pem文件
        //curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/all.pem');

        if (count($aHeader) >= 1) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        }

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}