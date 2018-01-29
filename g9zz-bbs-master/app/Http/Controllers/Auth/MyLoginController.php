<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\ConsoleLoginRequest;
use App\Services\Auth\LoginService;
use App\Services\Auth\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Vinkla\Hashids\Facades\Hashids;

class MyLoginController extends Controller
{
    protected $isInvite;
    protected $userService;
    protected $loginService;

    public function __construct(UserService $userService,LoginService $loginService)
    {
        $this->isInvite = config('g9zz.invite_code.is_invite');
        $this->userService = $userService;
        $this->loginService = $loginService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLogin(Request $request)
    {
        $auth = $request->get('auth');

        $data = new \stdClass();
        $data->auth = $auth;
        $this->setData($data);
        $this->setCode(200);
        return $this->response();
    }

    /**
     * @param ConsoleLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(ConsoleLoginRequest $request)
    {
        $email = $request->get('email');
        $user = $this->userService->findUserByEmail($email);
        //防止三方登录,密码为空的情况
        if (empty($user->password)) {
            $this->setCode(config('validation.login')['login.error']);
            return $this->response();
        }

        $requestPwd = $request->get('password');
        $this->userService->checkPwd($requestPwd,$user->password);

        //如果授权登录
        $authorization = $request->get('auth');
        if (!empty($authorization)) {
            $oauth = Hashids::connection('user')->decode($authorization);
            if (empty($oauth)) {
                $this->setCode(config('validation.login')['oauth.failed']);
                return $this->response();
            }

            $verifyTime = config('g9zz.verify.valid_time');
            $now = time();
            if ( $now - $oauth[1] > $verifyTime ) {
                $this->setCode(config('validation.login')['oauth.failed']);
                return $this->response();
            }

            $login = config('g9zz.oauth.login.'.$oauth[2]);
            $result = $this->userService->checkExistsOauth($oauth[0],$login);
            if (!empty($result)) {
                $this->setCode(config('validation.login')['had.oauth']);
                return $this->response();
            }
            $user = $this->saveOauth($login,$user,$oauth);
            $user->save();
        }

        $now = time();
        $auth = [$user->id, $now];
        $hid = $user->hid;
        return $this->makeToken($auth,$hid);
    }

    /**
     * @param $login
     * @param $user
     * @param $oauth
     * @return mixed
     */
    public function saveOauth($login,$user,$oauth)
    {
        switch ($login) {
            case 'github_id':
                $user->github_id = $oauth[0];
                break;
            case 'weibo_id':
                $user->weibo_id = $oauth[0];
                break;
            case 'weixin_id':
                $user->weixin_id = $oauth[0];
                break;
            case 'qq_id':
                $user->qq_id = $oauth[0];
                break;
            case 'xcx_id':
                $user->xcx_id = $oauth[0];
                break;
            case 'douban_id':
                $user->douban_id = $oauth[0];
                break;
        }
        return $user;
    }

    /**
     * @param $auth
     * @param $hid
     * @return \Illuminate\Http\JsonResponse
     */
    public function makeToken($auth,$hid)
    {
        $token = Hashids::connection('console_token')->encode($auth);
        $data = new \stdClass();
        $data->token = $token;
        $data->hid = $hid;
        $this->setData($data);
        $this->setCode(200);
        return $this->response();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVerifyToken(Request $request)
    {
        $authId = $request->get('g9zz_user_id');
        $user = $this->userService->getUserById($authId);
        if ($user->verified) {
            $this->setCode(config('validation.login')['had.verified']);
            return $this->response();
        }
        $result = $this->userService->verifyEmail($user->email,$user->name,$user->id);
        return $this->response();
    }

    /**
     * 点击邮箱里校验链接进行校验
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify(Request $request)
    {
        $token = $request->get('token');
        $message = Hashids::connection('code')->decode($token);
        //返回的code不对..校验失败
        if (empty($message)) return $this->returnError();

        //返回的code类型不对,校验失败
        if ($message[2] != 3) return $this->returnError();

        //超时,校验失败
        $now = time();
        $validTime = config('g9zz.verify.valid_time');
        if ($now - $message[1] > $validTime) return $this->returnError();

        //查无此人,校验失败
        $user = $this->userService->getUserById($message[0]);
        if (empty($user)) return $this->returnError();

        $result = $this->userService->updateVerify($message[0]);

        $this->response();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnError()
    {
        $this->setCode(config('validation.login')['verify.failed']);
        return $this->response();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWechatMiniProgramUserInfo(Request $request)
    {
//        $code = $request->get('code');
        $input = $request->only(['nickName','avatarUrl','gender','province','city','country','code']);
        $input = parse_input($input);
        $this->log('controller.request to '.__METHOD__,['request' => $input]);
        $res = $this->loginService->getXCXUserInfo($input['code']);
        $this->log('controller.record to '.__METHOD__,['get_xcx_user' => $res]);
        $data = json_decode($res,true);
        $return = new \stdClass();
        if (isset($data['openid'])) {
            $xcx = $this->loginService->getXcxByOpenId($data['openid']);
            if (empty($xcx)) {//第一次授权
                $input['open_id'] = $data['openid'];
                $token = $this->loginService->createXcx($input);
                $return->token = $token;
                $this->setData($return);
                $this->setCode(200);
                return $this->response();
            } else {
                $user = $this->loginService->getUserByXcxId($xcx->id);
                if (empty($user)) {//已经授权,但未绑定账号
                    $time = time();
                    $param = [$xcx->id,$time,5];
                    $token = Hashids::connection('user')->encode($param);
                    $return->token = $token;
                    $this->setData($return);
                    $this->setCode(200);
                    return $this->response();
                } else {//已经授权且已经绑定账号
                    $now = time();
                    $auth = [$user->id, $now];
                    $hid = $user->hid;
                    return $this->makeToken($auth,$hid);
                }
            }
        } else {
            $return->message = '授权失败';
            $this->setData($return);
            $this->setCode(401);
            return $this->response();
        }
    }



    /**
     * @param Request $request
     * @param $service
     * @return mixed
     */
    public function redirectToProvider(Request $request,$service)
    {
        if (!in_array($service,config('g9zz.token.login_way'))) {
            $this->setCode(config('validation.default')['some.error']);
            return $this->response();
        }
        return Socialite::driver($service)->redirect();
    }

    /**
     * 授权回调页面
     * @param Request $request
     * @param $service
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|mixed|void
     */
    public function handleProviderCallback(Request $request,$service)
    {
        $user = Socialite::driver($service)->stateless()->user();
        switch ($service)
        {
            case 'github':
                return $this->loginByGithub($user);
                break;
            case 'weixin':
                return $this->loginByWeixin($user);
                break;
            case 'weibo':
                return $this->loginByWeibo($user);
                break;
            default:
                return $this->loginByEmail();
                break;
        }

    }

    /**
     * 用github登录
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginByGithub($user)
    {
        $isGithub = $this->userService->checkIsGithub($user->id);
        //第一次授权
        if (empty($isGithub)) {
            if ($this->isInvite) {
                $this->setCode(config('validation.register')['needInvite.notSocialite']);
                return $this->response();
            }

            return $this->userService->storeGithub($user);
        } else {
            $result = $this->userService->findUserByGithubId($isGithub->id);
            if (empty($result)) {
                $now = time();
                $oauth = config('g9zz.oauth.auth.github');
                $param = [$isGithub->id,$now,$oauth];

                $auth = Hashids::connection('user')->encode($param);

                return redirect()->route('web.get.login',['auth' => $auth]);
            }
        }

        $now = time();
        $auth = [$result->id, $now];
        return $this->makeToken($auth,$result->hid);

    }

    public function loginByWeixin($user)
    {

    }

    /**
     * @param $user
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|mixed
     */
    public function loginByWeibo($user)
    {

        $isWeibo = $this->userService->checkIsWeibo($user->id);
        //第一次授权
        if (empty($isWeibo)) {
            if ($this->isInvite) {
                $this->setCode(config('validation.register')['needInvite.notSocialite']);
                return $this->response();
            }

            return $this->userService->storeWeibo($user);
        } else {
            $result = $this->userService->findUserByWeiboId($isWeibo->id);
            if (empty($result)) {
                $now = time();
                $oauth = config('g9zz.oauth.auth.weibo');
                $param = [$isWeibo->id,$now,$oauth];

                $auth = Hashids::connection('user')->encode($param);

                return redirect()->route('web.get.login',['auth' => $auth]);
            }
        }

        $now = time();
        $auth = [$result->id, $now];
        return $this->makeToken($auth,$result->hid);
    }

    public function loginByEmail()
    {

    }
}
