## 淘宝接口API开发

> 访问案例：http://taobao.flc.ren/
>
> 源码地址：https://github.com/flc1125/taobao-open-api

### 本次开发接口如下：

|接口名称|官方接口名称|
|----|----|
|获取前台展示的店铺内卖家自定义商品类目|`taobao.sellercats.list.get`|
|获取前台展示的店铺类目|`taobao.shopcats.list.get`|
|获取卖家店铺的基本信息|`taobao.shop.get`|
|淘宝客商品查询|`taobao.tbk.item.get`|
|淘宝客商品详情（简版）|`taobao.tbk.item.info.get`|
|淘宝客商品关联推荐查询|`taobao.tbk.item.recommend.get`|
|淘宝客店铺查询|`taobao.tbk.shop.get`|
|淘宝客店铺关联推荐查询|`taobao.tbk.shop.recommend.get`|

> 访问案例首页主要使用`taobao.tbk.item.get`

### 文件及配置说明

- 存放目录：将下载的`/Taobao/`整个文件夹放入`/ThinkPHP/Library/Com/`目录下；其中`Thinkphp`为官方核心目录

- 配置文件所在目录：`/ThinkPHP/Library/Com/Taobao/Client.class.php`的`appkey`及`appsecret`

### 实例代码

```php
<?php
/**
 * 淘宝API接口范例
 *
 * @author Flc <2016-03-14 02:14:37>
 * @link http://flc.ren 
 */
namespace Home\Controller;

use Think\Controller;
use Com\Taobao\Client;
use Com\Taobao\Request\TaobaoTbkItemGet;  // 淘宝客商品查询
use Com\Taobao\Request\TaobaoTbkItemRecommendGet; // 淘宝客商品关联推荐查询
use Com\Taobao\Request\TaobaoTbkItemInfoGet; // 淘宝客商品详情（简版）
use Com\Taobao\Request\TaobaoTbkShopGet; // 淘宝客店铺查询
use Com\Taobao\Request\TaobaoTbkShopRecommendGet; // 淘宝客店铺关联推荐查询
use Com\Taobao\Request\TaobaoShopcatsListGet; // 获取前台展示的店铺类目
use Com\Taobao\Request\TaobaoSellercatsListGet; // 获取前台展示的店铺内卖家自定义商品类目
use Com\Taobao\Request\TaobaoShopGet; // 获取前台展示的店铺内卖家自定义商品类目

class IndexController extends Controller {

    /**
     * DEMO
     * @return [type] [description]
     */
    public function index()
    {
        $req = (new TaobaoTbkItemGet)
            ->setFields('num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,seller_id,volume,nick')
            ->setQ("女装")
            ->setCat("16,18")
            ->setSort("_des");
        /*$req = (new TaobaoTbkItemRecommendGet)
            ->setFields('num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,seller_id,volume,nick')
            ->setRelateType(1)
            ->setCount(5)
            ->setNumIid("6956495372");*/
        /*$req = (new TaobaoTbkItemInfoGet)
            ->setFields('num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,seller_id,volume,nick')
            ->setNumIids("6956495372");*/
        /*$req = (new TaobaoTbkShopGet)
            ->setFields('user_id,shop_title,shop_type,seller_nick,pict_url,shop_url')
            ->setQ("女装")
            ->setSort("_des");*/
        /*$req = (new TaobaoTbkShopRecommendGet)
            ->setFields('user_id,shop_title,shop_type,seller_nick,pict_url,shop_url')
            ->setUserId("663336865");*/
        /*$req = (new TaobaoShopcatsListGet)->setFields('cid,parent_cid,name,is_parent');*/
        /*$req = (new TaobaoSellercatsListGet)->setNick('jw原单服饰店');*/
        /*$req = (new TaobaoShopGet)
            ->setNick('jw原单服饰店')
            ->setFields('sid,cid,title,nick,desc,bulletin,pic_path,created,modified');*/

        $rs = (new Client)->execute($req);
        print_r($rs);
    }
}
?>
```

### 其他说明

- 目前仅开发以上接口，其他接口暂时无权限；如需拓展，请在`/ThinkPHP/Library/Com/Taobao/Request/`下新增类