<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
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
 * @property int $topic_count
 * @property int $reply_count
 * @property int $follower_count
 * @property string $verified
 * @property string $email_notify_enabled
 * @property string $register_source
 * @property string $last_actived_at
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDoubanId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmailNotifyEnabled($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereFollowerCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereGithubId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereGoogleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastActivedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereQqId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRegisterSource($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereReplyCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTopicCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereVerified($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereWechatId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereWeiboId($value)
 * @mixin \Eloquent
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDeletedAt($value)
 * @property int $xcx_id
 * @method static \Illuminate\Database\Query\Builder|\App\User whereXcxId($value)
 * @property string $last_activated_at
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastActivatedAt($value)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
