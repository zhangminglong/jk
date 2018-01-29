<?php
/**
 * 淘宝API接口 - 获取前台展示的店铺类目
 *
 * @author Flc <2016-03-13 22:42:15>
 * @link http://flc.ren 
 * @link http://open.taobao.com/doc2/apiDetail.htm?apiId=64&scopeId=386 接口官方文档
 */
namespace Com\Taobao\Request;

use Com\Taobao\Request\Request;

class TaobaoShopcatsListGet extends Request
{   
    /**
     * API接口名称
     * @var string
     */
    protected $method = 'taobao.shopcats.list.get';

    /**
     * 设置需返回的字段列表[可选]
     * 参考：cid,parent_cid,name,is_parent
     * 
     * @param string $value 
     */
    public function setFields($value = '')
    {
        $this->params['fields'] = $value;
        return $this;
    }

}
