<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/9
 * Time: 上午12:09
 */

namespace App\Services\Console;


use App\Repositories\Contracts\NotifyRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Http\Request;

class NotifyService extends BaseService
{
    protected $notifyRepository;
    protected $userRepository;
    protected $request;
    public function __construct(NotifyRepositoryInterface $notifyRepository,
                                UserRepositoryInterface $userRepository,
                                Request $request)
    {
        $this->notifyRepository = $notifyRepository;
        $this->userRepository = $userRepository;
        $this->request = $request;
    }

    /**
     * @param $notifyId
     * @return mixed
     */
    public function setNotifyRead($notifyId)
    {
        $notify =  $this->notifyRepository->find($notifyId);
        //不允许标记他人的通知
        if ($notify->notifiable_id != $this->request->get('g9zz_user_id')) {
            $this->setCode(config('validation.notify')['noSet.other']);
            return $this->response();
        }
        $notify->markAsRead();
        return $this->notifyRepository->find($notifyId);
    }

    /**
     * 返回 各种通知(已读 未读 两者都有)
     * @param $status
     * @return mixed
     */
    public function notifyPaginate($status)
    {
        $user = $this->userRepository->find($this->request->get('g9zz_user_id'));
        switch ($status) {
            case 'read':
                $result = $user->readNotifications()->paginate(per_page());
                break;
            case 'unread':
                $result = $user->unreadNotifications()->paginate(per_page());
                break;
            default :
                $result = $user->notifications()->orderBy('created_at','desc')->paginate(per_page());
                break;
        }
        return $result;
    }

    /**
     * 全部标记已读
     * @return mixed
     */
    public function setAllNotifyRead()
    {
        $user = $this->userRepository->find($this->request->get('g9zz_user_id'));
        return $user->unreadNotifications->markAsRead();;
    }

    /**
     * @return int
     */
    public function getUnreadNum()
    {
        $user = $this->userRepository->find($this->request->get('g9zz_user_id'));
        $count = count($user->unreadNotifications->toArray());
//        dd($count,$user->unreadNotifications->toArray());
        return $count;
    }
}