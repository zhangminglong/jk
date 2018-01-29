<?php
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    /**
     * 关闭自动更新时间戳
     * @var boolean
     */
    public $timestamps = false;
}