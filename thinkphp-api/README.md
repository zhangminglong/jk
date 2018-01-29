# thinkphp-api
基于thinkphp开发api接口，支持数据加密

## 非加密调用
    需要传递以下参数：
        1. appid：分配给每个应用的标识（必传）
        2. timestamp：时间戳（必传）
        3. sign：签名（必传）
        4. action：接口名(必传)
        5. 其他参数
    签名生成规则：md5(token + timestamp + token)

## 加密调用
    需要传递以下参数：
        1. appid：分配给每个应用的标识（必传）
        2. Encrypt：密文（必传）
        3. MsgSignature：签名串（必传）
        4. TimeStamp：时间戳(必传)
        5. Nonce：随机串(必传)
    加密方式：AES-CBC