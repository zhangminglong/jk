# g9zz-php-doc

## 后台

### post

* [帖子列表](#帖子列表)
* [帖子创建](#帖子创建)
* [帖子详情](#帖子详情)
* [帖子修改](#帖子修改)
* [删除帖子](#删除帖子)


### node

* [节点列表](#节点列表)
* [节点创建](#节点创建)
* [节点详情](#节点详情)
* [节点修改](#节点修改)
* [节点删除](#节点删除)

### tag

* [标签列表](#标签列表)
* [标签创建](#标签创建)
* [标签详情](#标签详情)
* [标签修改](#标签修改)
* [标签删除](#标签删除)

### reply

* [回复列表](#回复列表)
* [回复创建](#回复创建)
* [回复详情](#回复详情)
* [回复修改](#回复修改)
* [回复删除](#回复删除)

### append

* [附言列表](#附言列表)
* [附言创建](#附言创建)
* [附言详情](#附言详情)

### permission

* [权限列表](#权限列表)
* [权限创建](#权限创建)
* [权限修改](#权限修改)
* [权限详情](#权限详情)
* [权限删除](#权限删除)

### role

* [角色列表](#角色列表)
* [角色创建](#角色创建)
* [角色修改](#角色修改)
* [角色详情](#角色详情)
* [角色删除](#角色删除)
* [角色分配权限](#角色分配权限)

## 前台





## 后台

### post

#### 帖子列表

- PATH `console/post`
- METHOD `GET`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|replyCount|`desc`,`asc`| 回复数 | |
|viewCount|`desc`,`asc`|点击数||
|voteCount|`desc`,`asc`|点赞数|
|isTop|`desc`,`asc`|置顶|

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": [
    {
      "id": 2,
      "title": "这是标题",
      "content": "这个是内容",
      "source": "IOS",
      "replyCount": 0,
      "viewCount": 100,
      "voteCount": 1,
      "isTop": "yes",
      "bodyOriginal": null,
      "user": {
        "name": "叶落",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
      },
      "lastReplyUser": {
        "name": "叶落",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
      }
    },
    {
      "id": 3,
      "title": "第二个标题",
      "content": "这又是个内容",
      "source": null,
      "replyCount": 0,
      "viewCount": 0,
      "voteCount": 0,
      "isTop": "no",
      "bodyOriginal": null
    },
    {
      "id": 4,
      "title": "222",
      "content": "<h2>内容呢</h2>",
      "source": null,
      "replyCount": 0,
      "viewCount": 0,
      "voteCount": 0,
      "isTop": "no",
      "bodyOriginal": "## 内容呢",
      "user": {
        "name": "叶落",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
      },
      "lastReplyUser": {
        "name": "叶落",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
      }
    },
    {
      "id": 6,
      "title": "222",
      "content": "<h2>内容呢</h2>",
      "source": null,
      "replyCount": 0,
      "viewCount": 0,
      "voteCount": 0,
      "isTop": "no",
      "bodyOriginal": "## 内容呢"
    }
  ],
  "pager": {
    "entities": 4,
    "current": 1,
    "total": 1,
    "limit": 20,
    "last": 1,
    "next": "",
    "previous": ""
  }
}
```

#### 帖子创建

- PATH `console/post`
- METHOD `POST`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|title|string|标题|必须|
|content|string|内容|必须(可以markdown)|
|isTop|`yes`,`no`|置顶|非必须|

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": {
    "id": 6,
    "title": 222,
    "content": "<h2>内容呢</h2>",
    "source": null,
    "replyCount": null,
    "viewCount": null,
    "voteCount": null,
    "isTop": null,
    "bodyOriginal": "## 内容呢"
  }
}
```



#### 帖子详情

- PATH `console/post/{id}`
- METHOD `GET`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": {
    "id": 2,
    "title": "这是标题",
    "content": "这个是内容",
    "source": "IOS",
    "replyCount": 0,
    "viewCount": 100,
    "voteCount": 1,
    "isTop": "yes",
    "bodyOriginal": null,
    "user": {
      "name": "叶落",
      "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
    },
    "lastReplyUser": {
      "name": "叶落",
      "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
    }
  }
}

```

#### 帖子修改

- PATH `console/post/{id}`
- METHOD `PUT`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|title|string|标题|必须|
|content|string|内容|必须(可以markdown)|
|isTop|`yes`,`no`|置顶|非必须|

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": {
    "id": 4,
    "title": "222",
    "content": "<h2>内容呢</h2>",
    "source": null,
    "replyCount": 0,
    "viewCount": 0,
    "voteCount": 0,
    "isTop": "no",
    "bodyOriginal": "## 内容呢",
    "user": {
      "name": "叶落",
      "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
    },
    "lastReplyUser": {
      "name": "叶落",
      "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
    }
  }
}
```


#### 删除帖子

- PATH `console/post/{id}`
- METHOD `DELETE`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": {}
}
```



#### 节点列表

- PATH `console/node/`
- METHOD `GET`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": [
    {
      "postCount": 0,
      "weight": 0,
      "level": 0,
      "is_show": "no",
      "name": "节点1",
      "slug": "node1",
      "description": null,
      "html": {
        "newHtml": "节点1"
      }
    },
    {
      "postCount": 0,
      "weight": 0,
      "level": 0,
      "is_show": "no",
      "name": "节点2",
      "slug": "node2",
      "description": null,
      "html": {
        "newHtml": "&nbsp;&nbsp;&nbsp;&nbsp;|-节点2"
      }
    },
    {
      "postCount": 0,
      "weight": 2,
      "level": 2,
      "is_show": "yes",
      "name": "开玩笑呢",
      "slug": "kwxn",
      "description": null,
      "html": {
        "newHtml": "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--开玩笑呢"
      }
    },
    {
      "postCount": 0,
      "weight": 2,
      "level": 2,
      "is_show": "yes",
      "name": "开玩2笑呢",
      "slug": "kwx2n",
      "description": null,
      "html": {
        "newHtml": "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--开玩2笑呢"
      }
    },
    {
      "postCount": 0,
      "weight": 2,
      "level": 2,
      "is_show": "yes",
      "name": "开玩24笑呢",
      "slug": "kwx42n",
      "description": null,
      "html": {
        "newHtml": "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--开玩24笑呢"
      }
    },
    {
      "postCount": 0,
      "weight": 2,
      "level": 2,
      "is_show": "yes",
      "name": "开玩244笑呢",
      "slug": "kwx424n",
      "description": null,
      "html": {
        "newHtml": "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--开玩244笑呢"
      }
    },
    {
      "postCount": 0,
      "weight": 1,
      "level": 2,
      "is_show": "yes",
      "name": "开玩笑呢..",
      "slug": "33",
      "description": null,
      "html": {
        "newHtml": "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--开玩笑呢.."
      }
    },
    {
      "postCount": 0,
      "weight": 1,
      "level": 2,
      "is_show": "yes",
      "name": "开玩笑呢4..",
      "slug": "334",
      "description": null,
      "html": {
        "newHtml": "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--开玩笑呢4.."
      }
    },
    {
      "postCount": 0,
      "weight": 0,
      "level": 0,
      "is_show": "no",
      "name": "节点4",
      "slug": "node4",
      "description": null,
      "html": {
        "newHtml": "&nbsp;&nbsp;&nbsp;&nbsp;|-节点4"
      }
    },
    {
      "postCount": 0,
      "weight": 0,
      "level": 0,
      "is_show": "no",
      "name": "节点3",
      "slug": "node3",
      "description": null,
      "html": {
        "newHtml": "节点3"
      }
    },
    {
      "postCount": 0,
      "weight": 0,
      "level": 0,
      "is_show": "no",
      "name": "节点5",
      "slug": "node5",
      "description": null,
      "html": {
        "newHtml": "&nbsp;&nbsp;&nbsp;&nbsp;|-节点5"
      }
    }
  ]
}
```

#### 节点创建

- PATH `console/node/`
- METHOD `POST`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
| parentId |int|父类ID|必须|
|weight|int|权重|必须|
|name|string|节点(中文)名称|必须|
|slug|string|节点(英文)名称|必须|
|description|string|描述|非必须|

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": {
    "postCount": 0,
    "weight": 1,
    "level": 2,
    "is_show": "yes",
    "name": "开玩笑呢4..",
    "slug": 334,
    "description": null
  }
}
```

#### 节点详情

- PATH `console/node/{id}`
- METHOD `GET`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": {
    "postCount": 0,
    "weight": 0,
    "level": 0,
    "is_show": "no",
    "name": "节点2",
    "slug": "node2",
    "description": null
  }
}
```

#### 节点修改

- PATH `console/node/{id}`
- METHOD `PUT`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
| parentId |int|父类ID|必须|
|weight|int|权重|必须|
|name|string|节点(中文)名称|必须|
|slug|string|节点(英文)名称|必须|
|description|string|描述|非必须|
|isShow|`yes`,`no`|是否展示|非必须|

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": {
    "postCount": 0,
    "weight": 1,
    "level": 0,
    "is_show": "no",
    "name": "23333",
    "slug": "kwxn1",
    "description": null
  }
}
```

#### 节点删除

- PATH `console/node/{id}`
- METHOD `DELETE`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE
```json
{
  "message": "成功",
  "code": 0,
  "data": {}
}
```


#### 标签列表

- PATH `console/tag/`
- METHOD `GET`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|cOrder|`desc`,`asc`|文章数排序||
|wOrder|`desc`,`asc`|权重排序||

- RESPONSE
```json
{
  "code": 0,
  "message": "成功",
  "data": [
    {
      "id": 2,
      "name": "test2",
      "displayName": "测试2 标签",
      "description": "这又是一个标签",
      "postCount": 0,
      "weight": 4
    },
    {
      "id": 1,
      "name": "test1",
      "displayName": "测试1标签",
      "description": "这是个标签",
      "postCount": 1,
      "weight": 0
    }
  ],
  "pager": {
    "entities": 2,
    "current": 1,
    "total": 1,
    "limit": 20,
    "last": 1,
    "next": "",
    "previous": ""
  }
}
```

#### 标签创建

- PATH `console/tag/`
- METHOD `POST`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|weight|int|权重|必须|
|name|string|标签(中文)名称|必须|
|displayName|string|标签(英文)名称|必须|
|description|string|描述|非必须|

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": {
    "id": 4,
    "name": "23323333",
    "displayName": "2333434",
    "description": "你怎么在开玩笑呢",
    "postCount": 0,
    "weight": 1
  }
}
```

#### 标签详情

- PATH `console/tag/{id}`
- METHOD `GET`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": {
    "id": 1,
    "name": "test1",
    "displayName": "测试1标签",
    "description": "这是个标签",
    "postCount": 1,
    "weight": 0
  }
}
```

#### 标签修改

- PATH `console/tag/{id}`
- METHOD `PUT`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|weight|int|权重|必须|
|name|string|标签(中文)名称|必须|
|displayName|string|标签(英文)名称|必须|
|description|string|描述|非必须|

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": {
    "id": 4,
    "name": "23323333",
    "displayName": "2333434",
    "description": "你怎么在开玩d笑呢",
    "postCount": 0,
    "weight": 1
  }
}
```

#### 标签删除

- PATH `console/tag/{id}`
- METHOD `DELETE`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE
```json
{
  "message": "成功",
  "code": 0,
  "data": {}
}
```

#### 回复列表

- PATH `console/reply/`
- METHOD `GET`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE
```json
{
  "code": 0,
  "message": "成功",
  "data": [
    {
      "source": "ios",
      "content": "这是一个回复",
      "contentOriginal": "### 这是一个回复",
      "post": {
        "id": null,
        "title": null
      },
      "user": {
        "id": 1,
        "name": "叶落山城秋",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=2911900371,4188553288&os=2777149326,2467460676&simid=80045321,1051818213&pn=3&rn=1&di=188983409670&ln=1986&"
      }
    },
    {
      "source": null,
      "content": "<h2>内容呢</h2>",
      "contentOriginal": "## 内容呢",
      "post": {
        "id": 2,
        "title": "这是标题"
      },
      "user": {
        "id": 2,
        "name": "叶落",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
      }
    },
    {
      "source": null,
      "content": "<h2>内容呢 - 哈哈哈</h2>",
      "contentOriginal": "## 内容呢 - 哈哈哈",
      "post": {
        "id": 2,
        "title": "这是标题"
      },
      "user": {
        "id": 2,
        "name": "叶落",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
      }
    },
    {
      "source": null,
      "content": "<h2>内容呢 - 哈哈哈</h2>",
      "contentOriginal": "## 内容呢 - 哈哈哈",
      "post": {
        "id": 2,
        "title": "这是标题"
      },
      "user": {
        "id": 2,
        "name": "叶落",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
      }
    },
    {
      "source": null,
      "content": "<h2>内容呢 - 哈哈哈</h2>",
      "contentOriginal": "## 内容呢 - 哈哈哈",
      "post": {
        "id": 2,
        "title": "这是标题"
      },
      "user": {
        "id": 2,
        "name": "叶落",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
      }
    }
  ],
  "pager": {
    "entities": 5,
    "current": 1,
    "total": 1,
    "limit": 20,
    "last": 1,
    "next": "",
    "previous": ""
  }
}
```

#### 回复创建

- PATH `console/reply/`
- METHOD `POST`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|postId|int|帖子ID|必须|
|content|string|回复内容|必须|

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": {
    "source": null,
    "content": "<h2>内容呢 - 哈哈哈</h2>",
    "contentOriginal": "## 内容呢 - 哈哈哈",
    "post": {
      "id": 2,
      "title": "这是标题"
    },
    "user": {
      "id": 2,
      "name": "叶落",
      "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
    }
  }
}
```

#### 回复详情

- PATH `console/reply/{id}`
- METHOD `GET`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": {
    "source": null,
    "content": "<h2>内容呢 - 哈哈哈</h2>",
    "contentOriginal": "## 内容呢 - 哈哈哈",
    "post": {
      "id": 2,
      "title": "这是标题"
    },
    "user": {
      "id": 2,
      "name": "叶落",
      "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
    }
  }
}
```

#### 回复修改

- PATH `console/reply/{id}`
- METHOD `PUT`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|content|string|回复内容|必须|

- RESPONSE

```json
{
  "code": 0,
  "message": "成功",
  "data": {
    "source": null,
    "content": "<h2>内容呢 - 哈哈哈</h2>",
    "contentOriginal": "## 内容呢 - 哈哈哈",
    "post": {
      "id": 2,
      "title": "这是标题"
    },
    "user": {
      "id": 2,
      "name": "叶落",
      "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=3495161387,2602242859&os=3408035920,2765980592&simid=4249158544,682669875&pn=1&rn=1&di=170437508230&ln=1986"
    }
  }
}
```

#### 回复删除

- PATH `console/reply/{id}`
- METHOD `DELETE`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE
```json
{
  "message": "成功",
  "code": 0,
  "data": {}
}
```


#### 附言列表

- PATH `console/append/`
- METHOD `GET`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE
```
{
  "code": 0,
  "message": "成功",
  "data": [
    {
      "id": 1,
      "content": "这是个附言....",
      "contentOriginal": "### 这是个附言",
      "createdAt": "2017-04-22T00:00:00+00:00",
      "post": {
        "id": 2,
        "title": "这是标题"
      }
    },
    {
      "id": 2,
      "content": "<h2>内容呢 - 哈哈哈</h2>",
      "contentOriginal": "## 内容呢 - 哈哈哈",
      "createdAt": "2017-05-16T15:42:37+00:00",
      "post": {
        "id": 2,
        "title": "这是标题"
      }
    }
  ],
  "pager": {
    "entities": 2,
    "current": 1,
    "total": 1,
    "limit": 20,
    "last": 1,
    "next": "",
    "previous": ""
  }
}
```

#### 附言创建

- PATH `console/append/`
- METHOD `POST`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|content|string|附言内容|必须|
|postId|int|帖子内容|必须|

- RESPONSE
```
{
  "code": 0,
  "message": "成功",
  "data": {
    "content": "<h2>内容呢 - 哈哈哈</h2>",
    "contentOriginal": "## 内容呢 - 哈哈哈",
    "createdAt": "2017-05-16T15:42:37+00:00",
    "post": {
      "id": 2,
      "title": "这是标题"
    }
  }
}
```

#### 附言详情

- PATH `console/append/{id}`
- METHOD `GET`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE
```
{
  "code": 0,
  "message": "成功",
  "data": {
    "id": 2,
    "content": "<h2>内容呢 - 哈哈哈</h2>",
    "contentOriginal": "## 内容呢 - 哈哈哈",
    "createdAt": "2017-05-16T15:42:37+00:00",
    "post": {
      "id": 2,
      "title": "这是标题"
    }
  }
}
```

#### 权限详情

- PATH `console/permission`
- METHOD `GET`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE
```
{
  "code": 0,
  "message": "成功",
  "data": [
    {
      "id": 1,
      "name": "first",
      "displayName": "第一个权限",
      "description": "这是一个权限哦"
    },
    {
      "id": 2,
      "name": "second",
      "displayName": "第er个权限",
      "description": "这是一个权限哦"
    }
  ],
  "pager": {
    "entities": 2,
    "current": 1,
    "total": 1,
    "limit": 20,
    "last": 1,
    "next": "",
    "previous": ""
  }
}
```

#### 权限创建

- PATH `console/permission`
- METHOD `POST`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|name|string|权限名(建议英文或者英文加数字)|必须,唯一,没有对英文校验|
|displayName|string|权限别名|必须,唯一|
|description|string|描述|非必须|

- RESPONSE
```
{
  "code": 0,
  "message": "成功",
  "data": {
    "id": 3,
    "name": "three",
    "displayName": "第san个权限",
    "description": "这是一个权限哦"
  }
}
```

#### 权限修改

- PATH `console/permission/{id}`
- METHOD `PUT`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|name|string|权限名(建议英文或者英文加数字)|必须,唯一,没有对英文校验|
|displayName|string|权限别名|必须,唯一|
|description|string|描述|非必须|

- RESPONSE
```
{
  "code": 0,
  "message": "成功",
  "data": {
    "id": 3,
    "name": "three",
    "displayName": "第三个权限",
    "description": "这是一个权限哦"
  }
}
```

#### 权限详情

- PATH `console/permission/{id}`
- METHOD `GET`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE
```
{
  "code": 0,
  "message": "成功",
  "data": {
    "id": 3,
    "name": "three",
    "displayName": "第三个权限",
    "description": "这是一个权限哦"
  }
}
```

#### 权限删除

- PATH `console/permission/{id}`
- METHOD `DELETE`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE
```
{
  "message": "成功",
  "code": 0,
  "data": {}
}
```

#### 角色列表

- PATH `console/role`
- METHOD `GET`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE
```
{
  "code": 0,
  "message": "成功",
  "data": [
    {
      "id": 1,
      "name": "first",
      "displayName": "第一个角色",
      "description": "这是个角色哦"
    },
    {
      "id": 2,
      "name": "second",
      "displayName": "第er个角色",
      "description": "这是个角色哦"
    },
    {
      "id": 3,
      "name": "three",
      "displayName": "第3个角色",
      "description": "这是个角色哦",
      "permission": [
        {
          "id": 1,
          "name": "first",
          "displayName": "第一个权限"
        },
        {
          "id": 4,
          "name": "three",
          "displayName": "第三个权限"
        },
        {
          "id": 5,
          "name": "four",
          "displayName": "第si个权限"
        },
        {
          "id": 6,
          "name": "five",
          "displayName": "第wu个权限"
        }
      ]
    }
  ],
  "pager": {
    "entities": 3,
    "current": 1,
    "total": 1,
    "limit": 20,
    "last": 1,
    "next": "",
    "previous": ""
  }
}
```

#### 角色创建

- PATH `console/role`
- METHOD `POST`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|name|string|角色名,推荐非中文|必须|
|displayName|string|角色别名,推荐英文|必须|
|description|string|描述|非必须|

- RESPONSE
```
{
  "code": 0,
  "message": "成功",
  "data": {
    "id": 4,
    "name": "admin",
    "displayName": "管理员",
    "description": "管理员哦"
  }
}
```

#### 角色详情

- PATH `console/role/{id}`
- METHOD `GET`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE
```
{
  "code": 0,
  "message": "成功",
  "data": {
    "id": 3,
    "name": "three",
    "displayName": "第3个角色",
    "description": "这是个角色哦",
    "permission": [
      {
        "id": 1,
        "name": "first",
        "displayName": "第一个权限"
      },
      {
        "id": 4,
        "name": "three",
        "displayName": "第三个权限"
      },
      {
        "id": 5,
        "name": "four",
        "displayName": "第si个权限"
      },
      {
        "id": 6,
        "name": "five",
        "displayName": "第wu个权限"
      }
    ]
  }
}
```

#### 角色详情

- PATH `console/role/{id}`
- METHOD `DELETE`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE
```
{
  "message": "成功",
  "code": 0,
  "data": {}
}
```

#### 角色分配权限

- PATH `console/role/{roleId}/permission`
- METHOD `POST`
- PARAMS

| request  | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|permissionIds|array|权限id数组|必须|

- RESPONSE
```
{
  "code": 0,
  "message": "成功",
  "data": {
    "id": 3,
    "name": "three",
    "displayName": "第3个角色",
    "description": "这是个角色哦",
    "permission": [
      {
        "id": 1,
        "name": "first",
        "displayName": "第一个权限"
      },
      {
        "id": 4,
        "name": "three",
        "displayName": "第三个权限"
      },
      {
        "id": 5,
        "name": "four",
        "displayName": "第si个权限"
      },
      {
        "id": 6,
        "name": "five",
        "displayName": "第wu个权限"
      }
    ]
  }
}
```
