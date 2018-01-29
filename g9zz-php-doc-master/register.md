### register

#### 注册


- PATH `register`
- METHOD `POST`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|name|string| 用户名 | |
|email|string|邮箱||
|password|string|密码||
|password_confirmation|string|确认密码||
|inviteCode|string|邀请码|需要时候的时候需要|

- RESPONSE
```json
{
  "code": 0,
  "message": "成功",
  "data": {
    "name": "123",
    "mobile": "***",
    "email": "222***@11.com"
  }
}
```
