<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 2017/4/12
 * Time: 下午4:12
 */

namespace App\Transformers;


use App\Models\User;

class UserTransformer extends BaseTransformer
{
    public function transform(User $user)
    {

        $return =  [
            'hid' => $user->hid,
            'name' => $user->name,
            'avatar' => $user->avatar,
        ];

        if ($user->xcx) {
            $return['xcx'] = [
                'nickName' => $user->xcx->nick_name,
                'avatarUrl' => $user->xcx->avatar_url,
            ];
        }

        if ($user->github) {
            $return['github'] = [
                'nickname' => $user->github->nickname,
                'displayName' => $user->github->display_name,
                'avatar' => $user->github->avatar,
            ];
        }

        if ($user->google) {
            $return['google'] = [

            ];
        }

        if ($user->weibo) {
            $return['weibo'] = [
                'screenName' => $user->weibo->screen_name,
                'name' => $user->weibo->name,
                'description' => $user->weibo->description,
                'url' => $user->weibo->url,
            ];
        }

        if ($user->qq) {
            $return['qq'] = [

            ];
        }

        if ($user->douban) {
            $return['douban'] = [

            ];
        }

        if ($user->wechat) {
            $return['wechat'] = [

            ];
        }


        $g9zz = \Request::get('g9zz_user_hid');

        if (empty($g9zz)) return $return;

        if ($g9zz == $user->hid) {
            $return['email'] = $user->email;
            $return['mobile'] = $user->mobile;
        }

        if ($user->role){
            foreach ($user->role as $value) {
                $return['role'][] = [
                    'name' => $value->name,
                    'displayName' => $value->display_name,
                    'description' => $value->description
                ];
            }
        }
        
        return $return;
    }
}