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
 * App\Models\Followers
 *
 * @property int $id
 * @property string $user_Hid
 * @property string $follow_Hid
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Followers whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Followers whereFollowHid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Followers whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Followers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Followers whereUserHid($value)
 * @mixin \Eloquent
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Followers whereDeletedAt($value)
 */
class Followers extends Model
{
    use SoftDeletes;
    protected $table = 'followers';
    protected $fillable = [
        'user_hid',
        'follow_hid',
    ];
}