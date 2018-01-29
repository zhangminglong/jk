<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/9
 * Time: 上午12:07
 */

namespace App\Repositories\Eloquent;


use App\Repositories\Contracts\NotifyRepositoryInterface;
use Illuminate\Notifications\DatabaseNotification;

class NotifyRepository extends BaseRepository implements NotifyRepositoryInterface
{
    public function model()
    {
        return DatabaseNotification::class;
    }
}