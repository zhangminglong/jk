<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/18
 * Time: 下午10:44
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Appends
 *
 * @property int $id
 * @property string $hid 加密ID
 * @property string $content 帖子附言内容
 * @property string $content_original 附言原文
 * @property string $topic_hid 帖子HID
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Posts $post
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereContentOriginal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereTopicHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appends whereDeletedAt($value)
 */
class Appends extends Model
{
    use SoftDeletes;
    protected $table = 'appends';
    protected $fillable = [
        'hid',
        'content',
        'content_original',
        'topic_hid',
    ];

    public function post()
    {
        return $this->hasOne(Posts::class,'hid','topic_hid');
    }
}