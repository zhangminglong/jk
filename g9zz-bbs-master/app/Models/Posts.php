<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/18
 * Time: 下午10:42
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/**
 * App\Models\Posts
 *
 * @property int $id
 * @property string $hid 加密ID
 * @property string $title 帖子标题
 * @property string $content 帖子内容
 * @property string $source 来源跟踪：iOS，Android
 * @property string $user_hid 作者HID
 * @property string $node_hid 节点HID
 * @property int $reply_count 回复数
 * @property int $view_count 查看数
 * @property int $vote_count 点赞数
 * @property string $last_reply_user_hid 最后回复人的HID
 * @property string $last_reply_actived_at 最后回复的时间
 * @property int $order
 * @property string $is_top 是否置顶
 * @property string $is_excellent 是否加精
 * @property string $is_blocked 是否block
 * @property string $body_original 原内容
 * @property string $excerpt 摘要
 * @property string $is_tagged
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $author
 * @property-read \App\Models\User $last_reply_user
 * @property-read \App\Models\Nodes $node
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appends[] $postscript
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Replies[] $reply
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tags[] $tag
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereBodyOriginal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereExcerpt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereIsBlocked($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereIsExcellent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereIsTagged($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereIsTop($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereLastReplyActivedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereLastReplyUserHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereNodeHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereReplyCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereSource($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereUserHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereViewCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereVoteCount($value)
 * @mixin \Eloquent
 * @property string $last_reply_activated_at 最后回复的时间
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereLastReplyActivatedAt($value)
 */
class Posts extends Model
{
    use SoftDeletes;

    protected $table = 'posts';
    protected $fillable = [
        'hid',
        'title',
        'content',
        'source',
        'user_hid',
        'node_hid',
        'reply_count',
        'view_count',
        'vote_count',
        'last_reply_user_hid',
        'last_reply_activated_at',
        'order',
        'is_top',
        'is_excellent',
        'is_blocked',
        'body_original',
        'excerpt',
        'is_tagged',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tag()
    {
        return $this->belongsToMany(Tags::class,'post_tag','post_id','tag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function node()
    {
        return $this->hasOne(Nodes::class,'hid','node_hid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
        return $this->hasOne(User::class,'hid','user_hid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function last_reply_user()
    {
        return $this->hasOne(User::class,'hid','last_reply_user_hid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reply()
    {
        return $this->hasMany(Replies::class,'post_hid','hid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postscript()
    {
        return $this->hasMany(Appends::class,'topic_hid','hid');
    }

}