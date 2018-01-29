# Alipay
PHP支付宝免签接口
# 用法

打开command.php修改如下内容。

    $alipay = new Alipay([
      'cookie' => '', //支付宝Cookie
      'notify' => '', //通知地址
      'token' => 'please_input_your_token'    //安全密钥
    ]);

关于Cookie需要登录支付宝后按下F12，然后再console上面输入document.cookie复制cookie。
只需要：

    ALIPAYJSESSIONID=xxxxxxxxxxxxx;session.cookieNameId=ALIPAYJSESSIONID

然后执行

    php Command.php

# 对接说明
1、本插件会用curl发送POST请求到你设定的通知地址。
### POST字段说明
    
    time 转账时间
    title  转账的说明
    trade 支付宝交易号（流水号）
    name 打款人
    amount 转账金额
    sig 密钥（大写的MD5加密后的字符串）

### 返回字符
如果通知成功请返回success字符。

# License
http://www.gnu.de/documents/gpl-3.0.en.html
