<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <meta name="description" content="">
        <meta name="author" content="">

        <title>用户登录</title>

        <!-- Bootstrap core CSS -->
        <link href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="/Public/css/signin.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="/Public/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class="container">
            <form class="form-signin">
                <h2 class="form-signin-heading">CatPush消息推送系统</h2>
                <label for="username" class="sr-only">用户名</label>
                <input type="email" id="username" class="form-control" placeholder="用户名" required autofocus>
                <label for="password" class="sr-only">密码</label>
                <input type="password" id="password" class="form-control" placeholder="密码" required>
                <label class="err-msg"></label>
                <button class="btn btn-lg btn-primary btn-block" type="button" id="login-btn">登录</button>
            </form>
        </div> <!-- /container -->
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="/Public/js/ie10-viewport-bug-workaround.js"></script>
        <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript">
            $(function(){
                $("#login-btn").click(function(){
                    var username = $.trim($("#username").val());
                    var password = $.trim($("#password").val());
                    
                    if(!!!username) {
                        $('.err-msg').text('请输入用户名');
                        $("#username").focus();
                        return;
                    }
                    
                    if(!!!password) {
                        $('.err-msg').text('请输入密码');
                        $("#password").focus();
                        return;
                    }
                    
                   $.post('/login/loginCommit',{username : username,password : password},function(data){
                       if(data.Code == 999) {
                           $('.err-msg').text(data.Msg);
                           window.location.href = data.Data.url;
                       } else {
                           $('.err-msg').text(data.Msg);
                       }
                   },'json');
                });
            });
        </script>
    </body>
</html>