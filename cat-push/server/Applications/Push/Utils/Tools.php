<?php
namespace Applications\Push\Utils;
/**
 * 工具类
 * @author Evan
 * @since 2016年4月16日
 */
class Tools {
	/**
	 * 返回数据
	 * @param type $ResponseCode    响应码
	 * @param type $ResponseMsg     响应消息
	 * @param type $ResponseData    响应数据
	 */
	public static function ReturnJson($ResponseCode = 999,$ResponseMsg = '调用成功',$ResponseData = array()){
		if(!is_numeric($ResponseCode)) {
			return false;
		}
		$result = array(
				'Code'=>$ResponseCode,
				'Msg'=>$ResponseMsg,
				'Data'=>$ResponseData
		);
		return json_encode($result);
	}
	
	/**
	 * json转数组
	 * @param unknown $json
	 */
	public static function JsonToArray($json) {
		$result = json_decode($json, true);
		if(!is_array($result)) {
			$result = $json;
		}
		return $result;
	}
}