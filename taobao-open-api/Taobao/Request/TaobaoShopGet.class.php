<?php
/**
 * 淘宝API接口 - 获取卖家店铺的基本信息
 *
 * @author Flc <2016-03-13 22:42:15>
 * @link http://flc.ren 
 * @link http://open.taobao.com/doc2/apiDetail.htm?apiId=68&scopeId=386 接口官方文档
 */
namespace Com\Taobao\Request;

use Com\Taobao\Request\Request;

class TaobaoShopGet extends Request
{   
    /**
     * API接口名称
     * @var string
     */
    protected $method = 'taobao.shop.get';

    /**
     * 卖家昵称[必须] 
     * 参考值：sid,cid,title,nick,desc,bulletin,pic_path,created,modified
     *
     * @param string $value 
     */
    public function setFields($value)
    {
        $this->params['fields'] = $value;
        return $this;
    }

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
