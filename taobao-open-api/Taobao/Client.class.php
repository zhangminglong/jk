<?php
/**
 * 淘宝API接口主入口
 *
 * @author Flc <2016-03-13 19:39:23>
 * @link http://flc.ren 
 */
namespace Com\Taobao;

class Client
{
    /**
     * 请求地址
     * @var string
     */
    protected $reqURI = 'http://gw.api.taobao.com/router/rest';

    /**
     * appkey
     * @var string
     */
    protected $appkey = '';

    /**
     * appsecret
     * @var string
     */
    protected $appsecret = '';

    /**
     * 请求超时时间
     * @var integer
     */
    protected $timeout = 5;

    /**
     * 响应格式。可选值：xml，json。
     * 目前仅支持json
     * 
     * @var string
     */
    protected $format = 'json';

    /**
     * 签名的摘要算法，可选值为：hmac，md5。
     * 目前仅支持md5
     * 
     * @var string
     */
    protected $sign_method = 'md5';

    /**
     * 初始化
     */
    public function __construct($appkey = '', $appsecret = '')
    {
        if (!empty($appkey))
            $this->appkey = $appkey;

        if (!empty($appsecret))
            $this->appsecret = $appsecret;
    }

    /**
     * 设置appkey
     * @param string $value appkey
     */
    public function setAppkey($value)
    {
        $this->appkey = $value;
        return $this;
    }

    /**
     * 设置appsecret
     * @param [type] $value [description]
     */
    public function setAppsecret($value)
    {
        $this->appsecret = $value;
        return $this;
    }

    /**
     * 设置超时时间
     * @param [type] $value [description]
     */
    public function setTimeout($value)
    {
        $this->timeout = $value;
        return $this;
    }

    /**
     * 请求
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function execute($request)
    {   
        // 获取参数
        $params = array_merge(array(
            'method' => $request->getMethod()
        ), $this->publicParams(), $request->getParams());

        // 生成签名
        $params['sign'] = $this->generateSign($params);

        // 读取数据
        $json = $this->curl($this->reqURI, $params);

        if (!$json)
            return false;

        // 转换成json
        $rs = json_decode($json, true);
        if (!$rs)
            return false;

        return $rs;
    }

    /**
     * 公共参数
     * @return [type] [description]
     */
    protected function publicParams()
    {
        return array(
            'app_key'     => $this->appkey,
            'timestamp'   => date('Y-m-d H:i:s'),
            'format'      => $this->format,
            'v'           => '2.0',
            'sign_method' => $this->sign_method,
        );
    }

    /**
     * 生成签名
     * @param  array $params 需要签名的参数
     * @return string         
     */
    protected function generateSign($params)
    {
        ksort($params);

        $tmps = array();
        foreach ($params as $k => $v) {
            $tmps[] = $k . $v;
        }

        $string = $this->appsecret . implode('', $tmps) . $this->appsecret;

        return strtoupper(md5($string));
    }

    /**
     * curl post方式请求
     * @param  string $url        请求地址
     * @param  array $postFields  post参数
     * @return string|false             
     */
    public function curl($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->timeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        }
        //https 请求
        if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        if (is_array($postFields) && 0 < count($postFields))
        {
            $postBodyString = "";
            foreach ($postFields as $k => $v)
            {
                $postBodyString .= "$k=" . urlencode($v) . "&"; 
            }
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);

            $header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
            curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
        }
        $reponse = curl_exec($ch);
        
        if (curl_errno($ch))
        {
            return false;
        }
        curl_close($ch);
        return $reponse;
    }

}
