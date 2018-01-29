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
 * App\Models\Nodes
 *
 * @property int $id
 * @property string $hid 加密ID
 * @property string $parent_hid 父级 hid
 * @property int $post_count 帖子数
 * @property bool $weight 权重
 * @property bool $level 等级
 * @property string $is_show
 * @property string $name 名称
 * @property string $display_name 别名
 * @property string $description 描述
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereIsShow($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereParentHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes wherePostCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Nodes whereWeight($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Posts[] $post
 */
class Nodes extends Model
{
//    use SoftDeletes;

    protected $table = 'nodes';
    protected $fillable = [
        'hid',
        'parent_hid',
        'post_count',
        'weight',
        'level',
        'is_show',
        'name',
        'display_name',
        'description',
    ];

    public function post()
    {
        return $this->hasMany(Posts::class,'node_hid','hid');
    }
}