<?php
/**
 * 淘宝API接口 - 淘宝客店铺查询
 *
 * @author Flc <2016-03-13 21:03:06>
 * @link http://flc.ren 
 * @link http://open.taobao.com/doc2/apiDetail.htm?apiId=24521&scopeId=11655 接口官方文档
 */
namespace Com\Taobao\Request;

use Com\Taobao\Request\Request;

class TaobaoTbkShopGet extends Request
{   
    /**
     * API接口名称
     * @var string
     */
    protected $method = 'taobao.tbk.shop.get';

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
     * 查询词[特殊可选]
     * @param string $value [description]
     */
    public function setQ($value)
    {
        $this->params['q'] = $value;
        return $this;
    }

    /**
     * 排序_des（降序），排序_asc（升序），佣金比率（commission_rate）， 商品数量（auction_count），销售总数量（total_auction）[可选]
     * @param string $value [description]
     */
    public function setSort($value)
    {
        $this->params['sort'] = $value;
        return $this;
    }

    /**
     * 是否商城商品，设置为true表示该商品是属于淘宝商城商品，设置为false或不设置表示不判断这个属性[可选]
     * @param boolean $value [description]
     */
    public function setIsTmall($value = false)
    {
        $this->params['is_tmall'] = $value;
        return $this;
    }

    /**
     * 信用等级下限，1~20[可选]
     * @param number $value [description]
     */
    public function setStartCredit($value)
    {
        $this->params['start_credit'] = $value;
        return $this;
    }

    /**
     * 信用等级上限，1~20[可选]
     * @param number $value [description]
     */
    public function setEndCredit($value)
    {
        $this->params['end_credit'] = $value;
        return $this;
    }

    /**
     * 淘客佣金比率下限，1~10000[可选]
     * @param number $value [description]
     */
    public function setStartCommissionRate($value)
    {
        $this->params['start_commission_rate'] = $value;
        return $this;
    }

    /**
     * 淘客佣金比率上限，1~10000[可选]
     * @param number $value [description]
     */
    public function setEndCommissionRate($value)
    {
        $this->params['end_commission_rate'] = $value;
        return $this;
    }

    /**
     * 店铺商品总数下限[可选]
     * @param number $value [description]
     */
    public function setStartTotalAction($value)
    {
        $this->params['start_total_action'] = $value;
        return $this;
    }

    /**
     * 店铺商品总数上限[可选]
     * @param number $value [description]
     */
    public function setEndTotalAction($value)
    {
        $this->params['end_total_action'] = $value;
        return $this;
    }

    /**
     * 累计推广商品下限[可选]
     * @param number $value [description]
     */
    public function setStartAuctionCount($value)
    {
        $this->params['start_auction_count'] = $value;
        return $this;
    }

    /**
     * 累计推广商品上限[可选]
     * @param number $value [description]
     */
    public function setEndAuctionCount($value)
    {
        $this->params['end_auction_count'] = $value;
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
     * 第几页，默认：１[可选]
     * @param number $value [description]
     */
    public function setPageNo($value = 1)
    {
        $this->params['page_no'] = $value;
        return $this;
    }

    /**
     * 页大小，默认20，1~100[可选]
     * @param number $value [description]
     */
    public function setPageSize($value = 20)
    {
        $this->params['page_size'] = $value;
        return $this;
    }

}
