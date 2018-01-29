<?php
/*
* Author:akic
* Date:2015-06-17
* Description:封装数据返回api接口
*/ 
class Response {
	//定义常量TYPE
	const TYPE = 'json';
	/*
	* 按综合方式输出通信数据
	* @param integer $code 状态码
	* @param string $message 提示信息
	* @param array $data 数据
	* @param string $type 类型
	* @return string
	*/
	public function showData($code,$message,$data = array(),$type = 'json') {
		//判断状态吗是否为空$code
		if(!is_numeric($code)) {
			return '';
		}

		//判断客户端get过来的参数
		$type = isset($_GET['format'])?$_GET['format']:self::TYPE;

		$result = array(
			'code'=>$code,
			'message'=>$message,
			'data'=>$data
		);

		//进行输出类型判断
		if($type == 'json' || $type == 'JSON') {
			self::json($code,$message,$data);
		}elseif($type == 'xml' || $type == 'XML') {
			self::xml($code,$message,$data);
		}elseif($type == 'array') {
			//仅仅只做测试查看数组结构使用
			var_dump($result);
		}else {
			//TODO 后期扩展
		}
	}

	/*
	* 按JSON方式输出通信数据
	* @param integer $code 状态码
	* @param string $message 提示信息
	* @param array $data 数据
	* @return string
	*/
	private static function json($code,$message,$data = array()) {
		if(!is_numeric($code)) {
			return '';
		}
		
		$result = array(
			'code'=>$code,
			'message'=>$message,
			'data'=>$data
		);


		echo json_encode($result);
		exit;
	}

	/*
	* 按XML方式输出通信数据
	* @param integer $code 状态码
	* @param string $message 提示信息
	* @param array $data 数据
	* @return string
	*/
	private static function xml($code,$message,$data = array()) {
		if(!is_numeric($code)) {
			return '';
		}

		$result = array(
			'code'=>$code,
			'message'=>$message,
			'data'=>$data
		);

		//设置输出头部
		header('Content-type:text/html;charset=utf-8');
		//拼接xml数据
		$xml = "<?xml version='1.0' encodinf='UTF-8'?>\n";
		$xml .= "<root>\n";
		$xml .= self::xmlToEncode($data);
		$xml .= "</root>\n";

		echo $xml;
	}

	/*
	* 解析封装XML数据函数
	* @param array $data 数据
	* @return string
	*/
	private static function xmlToEncode($data) {
		$xml = $attr = "";
		foreach ($data as $key => $value) {
			//解决xml节点为数字的问题
			if(is_numeric($key)) {
				$attr = " id='{$key}'";
				$key = "item";
			}
			//将key组装成xml节点
			$xml .= "<{$key}{$attr}>";
			//当self::xmlToEncode($result)传递的是一个数组时，并不会进行解析，而且会报错，要用递归解析下
			$xml .= is_array($value)?self::xmlToEncode($value):$value;
			$xml .= "</{$key}>\n";
		}
		return $xml;
	}
	
}
