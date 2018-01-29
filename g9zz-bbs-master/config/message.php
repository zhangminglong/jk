<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/5
 * Time: 下午4:24
 */
return [
    //default
    0 => '成功',
    200 => '成功',
    401 => '授权失败',

    400000000 => '有点不正常，请稍后再试',
    400000001 => '数据不存在,请检查后再试',
    400000002 => 'try catch 出现问题,请检查日志',
    400000003 => '需要登录,请登录后重试',

    //post
    401000000 => '请输入帖子标题',
    401000001 => '帖子标题过长,请检查后再试',
    401000002 => '请输入帖子内容',
    401000003 => '请输入节点HID',
    401000004 => '节点不存在,请检查后再试',

    //node
    402000000 => '请输入父节点的HID',
    402000001 => '请输入权重',
    402000002 => '请输入节点名称',
    402000003 => '请输入节点别名',
    402000004 => '节点名称已存在,请检查后再试',
    402000005 => '节点别名已存在,请检查后再试',
    402000006 => '节点名称格式不正确,请检查后再试',
    402000007 => '节点别名过长,请检查后再试',
    402000008 => '节点level级别过高,请检查后再试',
    402000009 => '父节点设置有逻辑错误,请检查后再试',
    402000010 => '该节点下还有子节点,不允许删除,请检查后再试',
    402000011 => '该节点下还有关联的文章,请先修改这些文章归属节点',
    //tag
    403000000 => '请输入标签名',
    403000001 => '标签名已存在,请检查后再试',
    403000002 => '请输入别名',
    403000003 => '别名已存在,请检查后再试',
    403000004 => '别名字数过长,请检查后再试',
    403000005 => '标签名格式不正确,请检查后再试',
    403000006 => '请输入标签权重',
    403000007 => '标签描述过长,请检查后再试',

    //reply
    405000000 => '请传入帖子ID',
    405000001 => '该帖子不存在,请检查后再试',
    405000002 => '回复内容不能为空,请检查后再试',

    //append
    406000000 => '请输入附言内容',
    406000001 => '附言内容过长,请检查后再试',
    406000002 => '请输入帖子ID',
    406000003 => '帖子ID不存在,请检查后再试',
    406000004 => '只有原帖作者才能添加,请检查后再试',
    406000005 => '该帖已超过最大附言数,请检查后再试',

    //permission
    407000000 => '请输入权限名',
    407000001 => '权限名已存在,请检查后再试',
    407000002 => '请输入权限别名',
    407000003 => '权限别名已存在,请检查后再试',
    407000004 => '描述长度过长,请检查后再试',
    407000005 => '权限不够,请检查后再试',

    //role
    408000000 => '请输入角色名',
    408000001 => '角色名已存在,请检查后再试',
    408000002 => '请输入角色别名',
    408000003 => '角色别名已存在,请检查后再试',
    408000004 => '描述长度过长,请检查后再试',
    408000005 => '请输入权限ID',
    408000006 => '角色下尚有用户,不允许删除',

    //invite_code
    409000000 => '您邀请码数量已超限,请检查后再试',

    //register
    410000000 => '请输入邀请码',
    410000001 => '邀请码不存在或者已失效,请检查后再试',
    410000002 => '请重复输入密码',
    410000003 => '两次密码不一样,请检查后再试',
    410000004 => '需要邀请码才能注册,请检查后再试',
    410000005 => '请输入用户名',
    410000006 => '用户名超出最大范围,请检查后再试',
    410000007 => '请输入邮箱',
    410000008 => '邮箱格式不正确,请检查后再试',
    410000009 => '邮箱超出长度,请检查后再试',
    410000010 => '邮箱异常或已存在,请检查后再试',
    410000011 => '请输入密码',
    410000012 => '密码长度过短,请检查后再试',
    410000013 => '邀请码注册,不允许三方登录,请先用邮箱注册',

    //token
    411000000 => '客户端授权不能为空',
    411000001 => '客户端授权不是最新或失效,请检查后再试',

    //login
    412000000 => '账号密码错误,请检查后再试',
    412000001 => '密码格式不正确,请检查后再试',
    412000002 => '登录方式出错,请检查后再试',
    412000003 => '账号激活失败,请检查后再试',
    412000004 => '账号已然激活,请勿反复校验',
    412000005 => '授权绑定失败,请检查后再试',
    412000006 => '该账号已经授权,请检查后再试',


    //notify
    413000000 => '标记失败,请检查后再试',
];