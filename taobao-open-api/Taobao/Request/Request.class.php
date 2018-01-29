<?php
/**
 * 淘宝API接口主参数文件
 *
 * @author Flc <2016-03-13 19:39:23>
 * @link http://flc.ren 
 */
namespace Com\Taobao\Request;

class Request
{   

    /**
     * 请求参数
     * @var array
     */
    protected $params = array();

    /**
     * 返回API接口名称。
     * @return string 
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * 返回所有参数
     * @return array 
     */
    public function getParams()
    {
        return $this->params;
    }
}
