<?php
namespace Home\Org\Api;

/**
 * API接口公共工具类
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-18
 */

class ApiTool {
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
    public function __construct($appInfo) {
        //初始化应用配置
        $this->AppID = $appInfo['app_id'];
        $this->AppSecret = $appInfo['app_secret'];
        $this->Token = $appInfo['token'];
        $this->EncodingAESKey = $appInfo['encoding_aeskey'];
    }
    
    /**
     * 加密数据
     * @param type $replyData   需要加密的数据
     * @param type $encryptData 加密后的数据
     */
    public function encryptMsg($replyData,&$encryptData) {
        $timeStamp = time();
        $nonce = \Home\Org\Api\ApiUtil::getNonce();
        $text = json_encode($replyData);
        
        $apiUtil = new \Home\Org\Api\ApiUtil($this->AppID,$this->AppSecret,$this->Token,$this->EncodingAESKey);
        $encryptMsg = '';
        $errCode = $apiUtil->encryptMsg($text, $timeStamp, $nonce, $encryptMsg);
        if ($errCode == 0) {
            $encryptData = $encryptMsg;
        }
        return $errCode;
    }
    
    /**
     * 解密数据
     * @param type $MsgSignature    签名串
     * @param type $TimeStamp       时间戳
     * @param type $Nonce           随机串
     * @param type $Encrypt         密文
     * @param type $decryptData     解密后的原文
     */
    public function decryptMsg($MsgSignature, $TimeStamp = null, $Nonce, $Encrypt, &$decryptData) {
        $apiUtil = new \Home\Org\Api\ApiUtil($this->AppID,$this->AppSecret,$this->Token,$this->EncodingAESKey);
        $decryptMsg = '';
        $errCode = $apiUtil->decryptMsg($MsgSignature, $TimeStamp, $Nonce, $Encrypt,$decryptMsg);
        if ($errCode == 0) {
            $decryptData = json_decode($decryptMsg,true);
        }
        return $errCode;
    }
}