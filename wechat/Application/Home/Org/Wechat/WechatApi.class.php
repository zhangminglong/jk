<?php
namespace Home\Org\Wechat;

/**
 * 微信接口调用类
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-09
 */
class WechatApi {
    /**
     * 微信签名验证
     * @return boolean
     */
    public static function checkSignature() {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = C('Token');
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        
        if($tmpStr == $signature){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * 获取access token
     * 有效期两个小时
     */
    public static function getAccessToken() {
        //从文件中获取缓存的access token数据
        $data = json_decode(file_get_contents(getcwd()."/../../../Public/access_token.json")); 
        
        if($data && $data->expire_time > time()) {
            return $data->access_token;
        }
        
        $appid = C('AppId');
        $secret = C('AppSecret');

        //调用微信接口获取access token
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
        $accessTokenJson = \Home\Org\Util\Http::get($url);
        $accessTokenArr = json_decode($accessTokenJson, true);
        if (isset($accessTokenArr['access_token'])) {
            //缓存7000秒
            $data->expire_time = time() + 7000;
            $data->access_token = $accessTokenArr['access_token'];
            $fp = fopen(getcwd()."/../../../Public/access_token.json", "w");
            fwrite($fp, json_encode($data));
            fclose($fp);

            return $accessTokenArr['access_token'];
        }
        
        return false;
    }        
}