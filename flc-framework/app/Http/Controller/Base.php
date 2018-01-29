<?php
namespace App\Http\Controller;

/**
 * 基础控制器
 * @author Flc <2016-07-27 00:04:09>
 */
class Base
{
    /**
     * 初始化
     */
    function __construct()
    {
        header("Content-type: text/html; charset=utf-8");
    }
}