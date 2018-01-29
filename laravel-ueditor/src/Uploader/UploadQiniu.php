<?php

namespace Riverslei\UEditor\Uploader;

use \Qiniu\Storage\UploadManager;
use \Qiniu\Auth;

/**
 *
 *
 * trait UploadQiniu
 *
 * 七牛 上传 类
 *
 * @package Riverslei\UEditor\Uploader
 */
trait UploadQiniu
{
    /**
     * 获取文件路径
     * @return string
     */
    protected function getFilePath()
    {
        $fullName = $this->fullName;


        $fullName = ltrim($fullName, '/');


        return $fullName;
    }

    public function uploadQiniu($key, $content)
    {
        $upManager = new UploadManager();
        $auth = new Auth(config('ueditor.core.qiniu.accessKey'), config('ueditor.core.qiniu.secretKey'));
        $token = $auth->uploadToken(config('ueditor.core.qiniu.bucket'));

        list($ret, $error) = $upManager->put($token, $key, $content);
        if ($error) {
            $this->stateInfo= $error->message();
        } else {
            //change $this->fullName ,return the url
            $url=rtrim(strtolower(config('ueditor.core.qiniu.url')),'/');
            $fullName = ltrim($this->fullName, '/');
            $this->fullName=$url.'/'.$fullName;
            $this->stateInfo = $this->stateMap[0];
        }
        return true;
    }
}