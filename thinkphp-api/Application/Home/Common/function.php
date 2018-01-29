<?php

/**
 * 公共函数
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-18
 */

/**
 * 接口权限检测
 */
function api_check() {
    $appid = isset($_POST['appid'])?$_POST['appid']:'';
    
    if(!$appid) {
        return Response(1001, '参数异常');
    }
    
    //查询应用信息
    $appInfo = D('App')->getAppInfo($appid);
    if(!$appInfo) {
        return Response(1002, '您没有访问权限');
    }
    
    //判断应用是否需要加密
    if($appInfo['is_encryption'] == 1) {
        //需要加密
        $encrypt = isset($_POST['Encrypt'])?$_POST['Encrypt']:'';
        $msgSignature = isset($_POST['MsgSignature'])?$_POST['MsgSignature']:'';
        $timeStamp = isset($_POST['TimeStamp'])?$_POST['TimeStamp']:'';
        $nonce = isset($_POST['Nonce'])?$_POST['Nonce']:'';

        //判断参数是否完整
        if(!$encrypt || !$msgSignature || !$timeStamp || !$nonce) {
            return Response(1003, '参数异常');
        }

        //解密数据
        $apiTool = new \Home\Org\Api\ApiTool($appInfo);
        $decryptData = array();
        $errCode = $apiTool->decryptMsg($msgSignature, $timeStamp, $nonce, $encrypt, $decryptData);
        if($errCode == 0) {
            $decryptData['_AppInfo'] = $appInfo;
            return $decryptData;
        } else {
            return Response(1004, '您没有访问权限');
        }
    }
        
    //不需要加密
    $requestData = $_POST;
    
    //验证token是否合法
    $sign = $requestData['sign'];
    if(!$sign) {
        return Response(1005, '您没有访问权限');
    }

    $timeStamp = $requestData['timestamp'];
    if(!$timeStamp) {
        return Response(1006, '请求不合法');
    }
        
    $newSign = md5($appInfo['token'] . $timeStamp . $appInfo['token']);
    
    if($newSign != $sign) {
        return Response(1007, '您没有访问权限');
    }
    
    $requestData['_AppInfo'] = $appInfo;
    
    return $requestData;
}

/**
 * 接口数据响应
 * @param type $ResponseCode    响应码
 * @param type $ResponseMsg     响应消息
 * @param type $ResponseData    响应数据
 * @param type $ResponseType    响应数据类型
 */
function Response($ResponseCode = 999,$ResponseMsg = '接口请求成功',$ResponseData = array(),$ResponseType = 'json'){
    if(!is_numeric($ResponseCode)) {
        return '';
    }
    
    //判断数据是否需要加密
    $appid = isset($_POST['appid'])?$_POST['appid']:'';
    if($appid && is_array($ResponseData) && count($ResponseData)>0) {
        $appInfo = D('App')->getAppInfo($appid);
        if($appInfo && $appInfo['is_encryption'] == 1) {
            $apiTool = new \Home\Org\Api\ApiTool($appInfo);
            $encryptData = array();
            $errCode = $apiTool->encryptMsg($ResponseData,$encryptData);
            if($errCode == 0) {
                $ResponseData = $encryptData;
            }
        }
    }
    
    $ResponseType = isset($_GET['format']) ? $_GET['format'] : $ResponseType;
    
    $result = array(
        'Code'=>$ResponseCode,
        'Msg'=>$ResponseMsg,
        'Data'=>$ResponseData
    );
    
    if($ResponseType == 'json') {
        Json($ResponseCode, $ResponseMsg, $ResponseData);
        exit();
    } else if($ResponseType == 'xml') {
        xmlEncode($ResponseCode, $ResponseMsg, $ResponseData);
        exit();
    } else if($ResponseType == 'array') {
        var_dump($result);
        exit();
    } else {
        Json($ResponseCode, $ResponseMsg, $ResponseData);
        exit();
    }
}

/**
 * 响应Json格式数据
 * @param type $ResponseCode    响应码
 * @param type $ResponseMsg     响应消息
 * @param type $ResponseData    响应数据
 */
function Json($ResponseCode = 999,$ResponseMsg = '接口请求成功',$ResponseData = array()){
    if(!is_numeric($ResponseCode)) {
        return '';
    }
    
    $result = array(
        'Code'=>$ResponseCode,
        'Msg'=>$ResponseMsg,
        'Data'=>$ResponseData,
        'Type'=>'json'
    );
    header("Content-type: text/html; charset=utf-8");
    echo json_encode($result);
    exit();
}

/**
 * 响应xml格式数据
 * @param type $ResponseCode    响应码
 * @param type $ResponseMsg     响应消息
 * @param type $ResponseData    响应数据
 */
function xmlEncode($ResponseCode = 999,$ResponseMsg = '接口请求成功',$ResponseData = array()) {
    if (!is_numeric($ResponseCode)) {
        return '';
    }

    $result = array(
        'Code'=>$ResponseCode,
        'Msg'=>$ResponseMsg,
        'Data'=>$ResponseData,
        'Type'=>'xml'
    );

    header("Content-Type:text/xml");
    $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
    $xml .= "<root>\n";

    $xml .= xmlToEncode($result);

    $xml .= "</root>";
    echo $xml;
}

/**
 * 将数据编码成xml格式
 * @param type $data
 * @return type
 */
function xmlToEncode($data) {
    $xml = $attr = "";
    foreach($data as $key => $value) {
        if(is_numeric($key)) {
            $attr = " id='{$key}'";
            $key = "item";
        }
        $xml .= "<{$key}{$attr}>";
        $xml .= is_array($value) ? xmlToEncode($value) : $value;
        $xml .= "</{$key}>\n";
    }
    return $xml;
}