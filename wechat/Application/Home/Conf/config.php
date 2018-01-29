<?php
/**
 * 微信公众号配置
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-07
 */
return array(
    //引入其他配置文件
    'LOAD_EXT_CONFIG' => 'keywordRouter',
    
    'Token' => '',//令牌
    'AppId' => '',//应用ID
    'AppSecret' => '',//应用密钥
    'EncodingAESKey' => '',//消息加解密密钥
    'Mchid' => '',//微信支付商户id
    'Key' => '',//微信支付API密钥
);