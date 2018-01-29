<?php

/**
 * 短信类库
 * @author	Evan<tangzwgo@163.com>
 * @since	2016-03-20
 */

class SMS {
    /**
     * 发送短信（创蓝）
     * @param type $mobile
     * @param type $msg
     * @return boolean
     */
    public static function sendMsg($mobile, $msg) {
        if (!$mobile) {
            return false;
        }
        if (!$msg) {
            return false;
        }
        
        //读取短信配置
        Config::cfgFile('sms/sms');
        $username = Config::getConfig('SMS_USERNAME');
        $password = Config::getConfig('SMS_PASSWORD');
        $url = Config::getConfig('SMS_URL');
        
        $params = array();
        $params['account'] = $username;        
        $params['pswd'] = $password;
        $params['mobile'] = $mobile;
        $params['msg'] = $msg;
        
        $result = Http::post($url, $params);
        
        //记录短信发送日志
        Log::printLog('sms_sendmsg.log', "[$mobile] [$msg] [$result]", 'sms');
        
        $resultCode = explode(',', $result);
        if ($resultCode[1] == 0) {
            return true;
        } else {
            return false;
        }
    }
}