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
 * App\Models\Tags
 *
 * @property int $id
 * @property string $hid 加密ID
 * @property string $name 标签名(英文)
 * @property string $display_name 标签名(汉字)
 * @property string $description 描述
 * @property int $post_count 帖子数
 * @property bool $weight 权重
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags wherePostCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tags whereWeight($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Posts[] $post
 */
class Tags extends Model
{
    use SoftDeletes;

    protected $table = 'tags';
    protected $fillable = [
        'hid',
        'name',
        'display_name',
        'description',
        'post_count',
        'weight',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function post()
    {
        return $this->belongsToMany(Posts::class,'post_tag','tag_id','post_id');
    }
}