<?php
/**
 * 关键字路由
 * @author Evan <tangzwgo@163.com>
 * @since 2016-03-08
 */
return array(
    'KEYWORD_ROUTER' => array(
        '_DEFAULT' => 'Text',//发送文本消息(默认关键字)
        '回复文本消息' => 'Text',//发送文本消息
        '我要看图片' => 'Image',//发送图片消息
        '来点语音' => 'Voice',//发送语音消息
        '小电影' => 'Video',//发送视频消息
        '听歌' => 'Music',//发送音乐消息
        '看看新闻' => 'News',//发送图文消息
    ),
);