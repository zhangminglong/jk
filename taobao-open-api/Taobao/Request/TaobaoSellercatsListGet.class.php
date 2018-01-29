<?php
/**
 * 淘宝API接口 - 获取前台展示的店铺内卖家自定义商品类目
 *
 * @author Flc <2016-03-13 22:42:15>
 * @link http://flc.ren 
 * @link http://open.taobao.com/doc2/apiDetail.htm?apiId=65&scopeId=386 接口官方文档
 */
namespace Com\Taobao\Request;

use Com\Taobao\Request\Request;

class TaobaoSellercatsListGet extends Request
{   
    /**
     * API接口名称
     * @var string
     */
    protected $method = 'taobao.sellercats.list.get';

    /**
     * 卖家昵称[必须] 
     * @param string $value 
     */
    public function setNick($value)
    {
        $this->params['nick'] = $value;
        return $this;
    }

}
