<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/18
 * Time: 下午10:43
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/**
 * App\Models\Replies
 *
 * @property int $id
 * @property string $hid 加密ID
 * @property string $source 来源跟踪：iOS，Android
 * @property string $post_hid 帖子HID
 * @property string $user_hid 用户HID
 * @property string $is_blocked 是否block
 * @property int $vote_count 投票数
 * @property string $body 回复内容
 * @property string $body_original 回复原文
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Posts $post
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereBodyOriginal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereIsBlocked($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies wherePostHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereSource($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereUserHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Replies whereVoteCount($value)
 * @mixin \Eloquent
 */
class Replies extends Model
{
    use SoftDeletes;
    protected $table = 'replies';
    protected $fillable = [
        'hid',
        'source',
        'post_hid',
        'user_hid',
        'is_blocked',
        'vote_count',
        'body',
        'body_original',
    ];

    public function post()
    {
        return $this->hasOne(Posts::class,'hid','post_hid');
    }

    public function user()
    {
        return $this->hasOne(User::class,'hid','user_hid');
    }

}