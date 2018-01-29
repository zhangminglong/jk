<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/19
 * Time: 下午6:40
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\InviteCode
 *
 * @property-read \App\Models\User $invitee
 * @property-read \App\Models\User $inviter
 * @mixin \Eloquent
 * @property int $id
 * @property int $inviter_hid 邀请者HID
 * @property int $invitee_hid 被邀请者HID
 * @property string $status 状态 created创建,used已使用,obsolete过时了
 * @property string $code 邀请码
 * @property string $obsoleted_at 过时时间
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InviteCode whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InviteCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InviteCode whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InviteCode whereInviteeHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InviteCode whereInviterHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InviteCode whereObsoletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InviteCode whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InviteCode whereUpdatedAt($value)
 */
class InviteCode extends Model
{
    protected $table = 'invite_code';
    protected $fillable = [
        'inviter_hid',
        'invitee_hid',
        'status',
        'obsoleted_at',
        'code'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inviter()
    {
        return $this->hasOne(User::class,'hid','inviter_hid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invitee()
    {
        return $this->hasOne(User::class,'hid','invitee_hid');
    }
}