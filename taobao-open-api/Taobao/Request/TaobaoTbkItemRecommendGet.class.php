<?php
/**
 * 淘宝API接口 - 淘宝客商品关联推荐查询
 *
 * @author Flc <2016-03-13 20:38:49>
 * @link http://flc.ren 
 * @link http://open.taobao.com/doc2/apiDetail.htm?apiId=24517&scopeId=11655 接口官方文档
 */
namespace Com\Taobao\Request;

use Com\Taobao\Request\Request;

class TaobaoTbkItemRecommendGet extends Request
{   
    /**
     * API接口名称
     * @var string
     */
    protected $method = 'taobao.tbk.item.recommend.get';

    /**
     * 设置需返回的字段列表[必须]
     * 参考：num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,seller_id,volume,nick
     * 
     * @param string $value 
     */
    public function setFields($value)
    {
        $this->params['fields'] = $value;
        return $this;
    }

    /**
     * 推荐类型，1:同类商品推荐，2:异类商品推荐，3:同店商品推荐，此时必须输入num_iid;4:店铺热门推荐，此时必须输入user_id，这里的user_id得通过taobao.tbk.shop.get这个接口去获取user_id字段;5:类目热门推荐，此时必须输入cid[可选]
     * @param number $value [description]
     */
    public function setRelateType($value)
    {
        $this->params['relate_type'] = $value;
        return $this;
    }

    /**
     * 商品Id[可选]
     * @param number $value [description]
     */
    public function setNumIid($value)
    {
        $this->params['num_iid'] = $value;
        return $this;
    }

    /**
     * 卖家Id[可选]
     * @param number $value [description]
     */
    public function setUserId($value)
    {
        $this->params['user_id'] = $value;
        return $this;
    }

    /**
     * 后台类目Id，仅支持叶子类目Id，即通过taobao.itemcats.get获取到is_parent=false的cid[可选]
     * @param number $value [description]
     */
    public function setCat($value)
    {
        $this->params['cat'] = $value;
        return $this;
    }

    /**
     * 链接形式：1：PC，2：无线，默认：１[可选]
     * @param number $value [description]
     */
    public function setPlatform($value = 1)
    {
        $this->params['platform'] = $value;
        return $this;
    }

    /**
     * 返回数量，默认20，最大值40[可选]
     * @param number $value [description]
     */
    public function setCount($value = 20)
    {
        $this->params['count'] = $value;
        return $this;
    }

}
