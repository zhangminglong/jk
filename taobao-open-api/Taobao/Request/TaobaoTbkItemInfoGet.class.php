<?php
/**
 * 淘宝API接口 - 淘宝客商品详情（简版）
 *
 * @author Flc <2016-03-13 20:38:49>
 * @link http://flc.ren 
 * @link http://open.taobao.com/doc2/apiDetail.htm?apiId=24518&scopeId=11655 接口官方文档
 */
namespace Com\Taobao\Request;

use Com\Taobao\Request\Request;

class TaobaoTbkItemInfoGet extends Request
{   
    /**
     * API接口名称
     * @var string
     */
    protected $method = 'taobao.tbk.item.info.get';

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
     * 商品ID串，用,分割，从taobao.tbk.item.get接口获取num_iid字段，最大40个[必须]
     * @param string $value [description]
     */
    public function setNumIids($value)
    {
        $this->params['num_iids'] = $value;
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
}
