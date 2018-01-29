<?php
namespace Home\Org\Api;

/**
 * API接口公共工具类
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-18
 */

class ApiUtil {
    //应用ID
    private $AppID;
    //应用秘钥
    private $AppSecret;
    //令牌
    private $Token;
    //消息加解密密钥
    private $EncodingAESKey;
    
    /**
     * 构造函数
     */
    public function __construct($appId,$appSecret,$token,$encodingAESKey) {
        //初始化应用配置
        $this->AppID = $appId;
        $this->AppSecret = $appSecret;
        $this->Token = $token;
        $this->EncodingAESKey = $encodingAESKey;        
    }
    
    /**
     * 消息加密
     * <ol>
     *    <li>对要发送的消息进行AES-CBC加密</li>
     *    <li>生成安全签名</li>
     *    <li>将消息密文和安全签名打包成数组格式</li>
     * </ol>
     * @param type $replyMsg    需要加密的json数据
     * @param type $timeStamp   时间戳
     * @param type $nonce       随机串
     * @param type $encryptMsg  加密后的可以直接回复用户的密文
     */
    public function encryptMsg($replyMsg, $timeStamp, $nonce, &$encryptMsg) {
        $pc = new \Home\Org\Api\Prpcrypt($this->EncodingAESKey);

        //加密
        $array = $pc->encrypt($replyMsg, $this->AppID);
        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }

        if ($timeStamp == null) {
            $timeStamp = time();
        }
        $encrypt = $array[1];

        //生成安全签名
        $sha1 = new \Home\Org\Api\SHA1;
        $array = $sha1->getSHA1($this->Token, $timeStamp, $nonce, $encrypt);
        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }
        $signature = $array[1];
        
        //生成加密数据包
        $dataPack = array();
        $dataPack['Encrypt'] = $encrypt;
        $dataPack['MsgSignature'] = $signature;
        $dataPack['TimeStamp'] = $timeStamp;
        $dataPack['Nonce'] = $nonce;

        $encryptMsg = $dataPack;
        return \Home\Org\Api\ErrorCode::$OK;
    }
    
    /**
     * 检验消息的真实性，并且获取解密后的明文.
     * <ol>
     *    <li>利用收到的密文生成安全签名，进行签名验证</li>
     *    <li>若验证通过，则提取数据包中的加密消息</li>
     *    <li>对消息进行解密</li>
     * </ol>
     *
     * @param $msgSignature string 签名串，对应URL参数的msg_signature
     * @param $timestamp string 时间戳 对应URL参数的timestamp
     * @param $nonce string 随机串，对应URL参数的nonce
     * @param $postData string 密文，对应POST请求的数据
     * @param &$msg string 解密后的原文，当return返回0时有效
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function decryptMsg($msgSignature, $timestamp = null, $nonce, $encrypt, &$msg) {
        if (strlen($this->EncodingAESKey) != 43) {
            return \Home\Org\Api\ErrorCode::$IllegalAesKey;
        }

        $pc = new \Home\Org\Api\Prpcrypt($this->EncodingAESKey);
       
        if ($timestamp == null) {
            $timestamp = time();
        }        

        //验证安全签名
        $sha1 = new \Home\Org\Api\SHA1;
        $array = $sha1->getSHA1($this->Token, $timestamp, $nonce, $encrypt);
        
        $ret = $array[0];

        if ($ret != 0) {
            return $ret;
        }

        $signature = $array[1];
        if ($signature != $msgSignature) {
            return \Home\Org\Api\ErrorCode::$ValidateSignatureError;
        }

        $result = $pc->decrypt($encrypt, $this->AppID);
        if ($result[0] != 0) {
            return $result[0];
        }
        $msg = $result[1];

        return \Home\Org\Api\ErrorCode::$OK;
    }
    
    /**
     * 获取随机字符串
     * @return string
     */
    public static function getNonce($length = 6){
        $length = intval($length);
        $str = "";
        $str_pol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($str_pol) - 1;
        for ($i = 0; $i < $length; $i++) {
            $str .= $str_pol[mt_rand(0, $max)];
        }
        return $str;
    }
}