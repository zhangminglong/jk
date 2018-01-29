<?php
/**
 * 淘宝API接口 - 淘宝客店铺关联推荐查询
 *
 * @author Flc <2016-03-13 22:39:57>
 * @link http://flc.ren 
 * @link http://open.taobao.com/doc2/apiDetail.htm?apiId=24522&scopeId=11655 接口官方文档
 */
namespace Com\Taobao\Request;

use Com\Taobao\Request\Request;

class TaobaoTbkShopRecommendGet extends Request
{   
    /**
     * API接口名称
     * @var string
     */
    protected $method = 'taobao.tbk.shop.recommend.get';

    /**
     * 设置需返回的字段列表[必须]
     * 参考：user_id,shop_title,shop_type,seller_nick,pict_url,shop_url
     * 
     * @param string $value 
     */
    public function setFields($value)
    {
        $this->params['fields'] = $value;
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
