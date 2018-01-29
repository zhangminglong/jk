<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/5
 * Time: 下午4:53
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;


/**
 * App\Models\User
 *
 * @property int $id
 * @property string $hid 加密ID
 * @property string $name 用户名
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string $status
 * @property int $github_id
 * @property int $wechat_id
 * @property int $weibo_id
 * @property int $qq_id
 * @property int $google_id
 * @property int $douban_id
 * @property int $xcx_id
 * @property int $topic_count
 * @property int $reply_count
 * @property int $follower_count
 * @property string $verified
 * @property string $email_notify_enabled
 * @property string $register_source
 * @property string $last_activated_at
 * @property string $deleted_at
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Posts[] $post
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Roles[] $role
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDoubanId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmailNotifyEnabled($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereFollowerCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereGithubId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereGoogleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLastActivatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereQqId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRegisterSource($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereReplyCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereTopicCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereVerified($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereWechatId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereWeiboId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereXcxId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\DoubanUser $douban
 * @property-read \App\Models\GithubUser $github
 * @property-read \App\Models\GoogleUser $google
 * @property-read \App\Models\QqUser $qq
 * @property-read \App\Models\WechatUser $wechat
 * @property-read \App\Models\WeiboUser $weibo
 * @property-read \App\Models\WechatMiniPrograms $xcx
 */
class User extends Model
{
    use SoftDeletes,Notifiable;
    protected $table = 'users';
    protected $fillable = [
        'hid',
        'name',
        'email',
        'password',
        'mobile',
        'avatar',
        'github_id',
        'wechat_id',
        'weibo_id',
        'xcx_id',
        'qq_id',
        'google_id',
        'douban_id',
        'topic_count',
        'reply_count',
        'follower_count',
        'verified',
        'email_notify_enabled',
        'register_source',
        'last_activated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role()
    {
        return $this->belongsToMany(Roles::class,'role_user','user_id','role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function post()
    {
        return $this->hasMany(Posts::class,'user_hid','hid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function xcx()
    {
        return $this->hasOne(WechatMiniPrograms::class,'id','xcx_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function google()
    {
        return $this->hasOne(GoogleUser::class,'id','google_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wechat()
    {
        return $this->hasOne(WechatUser::class,'id','wechat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function douban()
    {
        return $this->hasOne(DoubanUser::class,'id','douban_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function qq()
    {
        return $this->hasOne(QqUser::class,'id','qq_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function weibo()
    {
        return $this->hasOne(WeiboUser::class,'id','weibo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function github()
    {
        return $this->hasOne(GithubUser::class,'id','github_id');
    }
}