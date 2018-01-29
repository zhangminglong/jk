<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/20
 * Time: 下午11:47
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\WeiboUser
 *
 * @property int $id
 * @property int $weibo_id 微博ID
 * @property int $weibo_idstr
 * @property string $screen_name 微博昵称
 * @property string $name 微博昵称
 * @property string $email 邮箱
 * @property string $province 省份
 * @property string $city 城市
 * @property string $location 现居住地
 * @property string $description 个人描述
 * @property string $url url
 * @property string $profile_image_url 头像
 * @property string $profile_url 个人微博地址
 * @property string $domain 个人微博域名
 * @property string $weihao 个人爱好
 * @property string $gender 性别
 * @property int $followers_count 粉丝
 * @property int $friends_count 关注
 * @property int $pagefriends_count 朋友页数
 * @property int $statuses_count 微博数
 * @property int $favourites_count 收藏数
 * @property string $weibo_created_at 加入微博时间
 * @property string $avatar_large 大头像
 * @property string $avatar 头像
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereAvatarLarge($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereDomain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereFavouritesCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereFollowersCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereFriendsCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser wherePagefriendsCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereProfileImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereProfileUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereProvince($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereScreenName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereStatusesCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereWeiboCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereWeiboId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereWeiboIdstr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WeiboUser whereWeihao($value)
 * @mixin \Eloquent
 */
class WeiboUser extends Model
{
    protected $table = 'weibo_user';
    protected $fillable = [
        'weibo_id',
        'weibo_idstr',
        'screen_name',
        'name',
        'email',
        'province',
        'city',
        'location',
        'description',
        'url',
        'profile_image_url',
        'profile_url',
        'domain',
        'weihao',
        'gender',
        'followers_count',
        'friends_count',
        'pagefriends_count',
        'statuses_count',
        'favourites_count',
        'weibo_created_at',
        'avatar_large',
        'avatar',
    ];
}