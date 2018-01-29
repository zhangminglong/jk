<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/8
 * Time: 下午10:18
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;


/**
 * App\Models\Notifies
 *
 * @property string $id
 * @property string $type
 * @property int $notifiable_id
 * @property string $notifiable_type
 * @property array $data
 * @property \Carbon\Carbon $read_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $notifiable
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notifies whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notifies whereData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notifies whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notifies whereNotifiableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notifies whereNotifiableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notifies whereReadAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notifies whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notifies whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Notifies extends DatabaseNotification
{
    protected $table = 'notifications';
    protected $fillable = [
        'type',
        'notifiable_id',
        'notifiable_type',
        'data',
        'read_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class,'id','notifiable_id');
    }
}