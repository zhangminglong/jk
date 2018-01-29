<?php

/**
 * http操作相关类
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-20
 */
class Http {

    /**
     * @ignore
     * 连接超时时间
     */
    private static $_cTimeout = 10.0;

    /**
     * @ignore
     * 读取超时时间
     */
    private static $_rTimeout = 10.0;

    /**
     * @ignore
     * 写入超时时间
     */
    private static $_wTimeout = 10.0;

    /**
     * @ignore
     * User Agent
     */
    private static $_userAgent = 'FO UA v1.0';

    /**
     * @ignore
     * CURL 请求完成后的信息
     */
    private static $_info;

    /**
     * 发起get请求并获取返回值
     * @param string $url
     * @return string
     */
    public static function get($url) {
        return self::request($url);
    }

    /**
     * 发起post请求并获取返回值
     * @param string $url
     * @param array|string $postFields
     * @return string
     */
    public static function post($url, $postFields = null) {
        return self::request($url, 'POST', $postFields);
    }

    /**
     * 发起请求并获取返回值
     * @param string $url
     * @param string $method
     * @param array|string $postFields
     * @param array $headers
     * @return string
     */
    public static function request($url, $method = 'GET', $postFields = null, $headers = null) {

        if (is_array($postFields)) {
            $postFields = http_build_query($postFields);
        }
        $ci = curl_init();

        curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ci, CURLOPT_URL, $url);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true); // 不直接输出
        curl_setopt($ci, CURLOPT_HEADER, false); // 返回中不包含header
        curl_setopt($ci, CURLOPT_USERAGENT, self::$_userAgent);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, self::$_cTimeout);
        curl_setopt($ci, CURLOPT_TIMEOUT, (self::$_cTimeout + self::$_rTimeout + self::$_wTimeout));

        if ('POST' == strtoupper($method)) {
            curl_setopt($ci, CURLOPT_POST, true);
            curl_setopt($ci, CURLOPT_POSTFIELDS, $postFields);
        }

        $ret = curl_exec($ci);

        self::$_info = curl_getinfo($ci);

        curl_close($ci);

        return $ret;
    }

    public static function getHttpCode() {
        if (!is_array(self::$_info)) {
            return false;
        }
        return self::$_info['http_code'];
    }

    public static function getInfo() {
        return self::$_info;
    }

}
