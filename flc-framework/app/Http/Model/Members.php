<?php
namespace App\Http\Model;

class Members extends Base
{
    /**
     * 表名
     * @var string
     */
    protected $table = 'members';

    /**
     * 关联member_info
     * @return object 
     */
    public function info()
    {
        return $this->hasOne('App\Http\Model\MemberInfo', 'uid', 'id');
    }
}