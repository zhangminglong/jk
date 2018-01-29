<?php
namespace App\Http\Model;

class MemberInfo extends Base
{
    /**
     * 表名
     * @var string
     */
    protected $table = 'member_info';

    /**
     * 关联member
     * @return object 
     */
    public function member()
    {
        return $this->belongsTo('App\Http\Model\Member', 'uid', 'id');
    }
}