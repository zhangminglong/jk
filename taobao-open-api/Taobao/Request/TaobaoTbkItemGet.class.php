<?php
/**
 * 淘宝API接口 - 淘宝客商品查询
 *
 * @author Flc <2016-03-13 19:39:23>
 * @link http://flc.ren 
 * @link http://open.taobao.com/doc2/apiDetail.htm?apiId=24515&scopeId=11655 接口官方文档
 */
namespace Com\Taobao\Request;

use Com\Taobao\Request\Request;

class TaobaoTbkItemGet extends Request
{   
    /**
     * API接口名称
     * @var string
     */
    protected $method = 'taobao.tbk.item.get';

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
     * 查询词[特殊可选]
     * @param string $value [description]
     */
    public function setQ($value)
    {
        $this->params['q'] = $value;
        return $this;
    }

    /**
     * 后台类目ID，用,分割，最大10个，该ID可以通过taobao.itemcats.get接口获取到[特殊可选]
     * @param string $value [description]
     */
    public function setCat($value)
    {
        $this->params['cat'] = $value;
        return $this;
    }

    /**
     * 所在地[可选]
     * @param string $value [description]
     */
    public function setItemloc($value)
    {
        $this->params['itemloc'] = $value;
        return $this;
    }

    /**
     * 排序_des（降序），排序_asc（升序），销量（total_sales），淘客佣金比率（tk_rate）， 累计推广量（tk_total_sales），总支出佣金（tk_total_commi）[可选]
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
     * 是否海外商品，设置为true表示该商品是属于海外商品，设置为false或不设置表示不判断这个属性[可选]
     * @param boolean $value [description]
     */
    public function setIsOverseas($value = false)
    {
        $this->params['is_overseas'] = $value;
        return $this;
    }

    /**
     * 折扣价范围下限，单位：元[可选]
     * @param number $value [description]
     */
    public function setStartPrice($value)
    {
        $this->params['start_price'] = $value;
        return $this;
    }

    /**
     * 折扣价范围上限，单位：元[可选]
     * @param number $value [description]
     */
    public function setEndPrice($value)
    {
        $this->params['end_price'] = $value;
        return $this;
    }

    /**
     * 淘客佣金比率上限，如：1234表示12.34%[可选]
     * @param number $value [description]
     */
    public function setStartTkRate($value)
    {
        $this->params['start_tk_rate'] = $value;
        return $this;
    }

    /**
     * 淘客佣金比率下限，如：1234表示12.34%[可选]
     * @param number $value [description]
     */
    public function setEndTkRate($value)
    {
        $this->params['end_tk_rate'] = $value;
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
