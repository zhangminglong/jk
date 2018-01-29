<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/21
 * Time: 上午10:46
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\WechatMiniPrograms
 *
 * @property int $id
 * @property string $open_id openID
 * @property string $nick_name 昵称
 * @property string $language 城市
 * @property string $province 省份
 * @property string $country 国家
 * @property string $city 城市
 * @property string $avatar_url 头像
 * @property int $gender 性别 1 男,0 女
 * @property string $status 状态
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMiniPrograms whereAvatarUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMiniPrograms whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMiniPrograms whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMiniPrograms whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMiniPrograms whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMiniPrograms whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMiniPrograms whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMiniPrograms whereNickName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMiniPrograms whereOpenId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMiniPrograms whereProvince($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMiniPrograms whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMiniPrograms whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WechatMiniPrograms extends Model
{
    protected $table = 'xcx_user';
    protected $fillable = [
        'open_id',
        'nick_name',
        'language',
        'province',
        'country',
        'city',
        'avatar_url',
        'gender',
        'status',
    ];
}