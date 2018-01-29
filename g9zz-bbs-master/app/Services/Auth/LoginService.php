<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/20
 * Time: 下午11:39
 */

namespace App\Services\Auth;


use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\XcxUserRepositoryInterface;
use App\Services\BaseService;
use GuzzleHttp\Client;
use Vinkla\Hashids\Facades\Hashids;

class LoginService extends BaseService
{
    protected $client;
    protected $userRepository;
    protected $xcxUserRepository;

    public function __construct(Client $client,
                                UserRepositoryInterface $userRepository,
                                XcxUserRepositoryInterface $xcxUserRepository)
    {
        $this->client = $client;
        $this->userRepository = $userRepository;
        $this->xcxUserRepository = $xcxUserRepository;
    }

    public function getXCXUserInfo($code)
    {
        $miniProgramAppid = env('XCX_APPID');
        $miniProgramSECRET = env('XCX_SECRET');
        $url = 'https://api.weixin.qq.com/sns/jscode2session';
        $response = $this->client->request('GET',$url,['query' => ['appid' => $miniProgramAppid,
            'secret'=>$miniProgramSECRET,
            'js_code' => $code,
            'grant_type' => 'authorization_code']]);

        $body = $response->getBody();
        return (string) $body;
    }

    /**
     * @param $openid
     * @return mixed
     */
    public function getXcxByOpenId($openid)
    {
        return $this->xcxUserRepository->getXcxByOpenId($openid);
    }

    /**
     * @param $input
     * @return mixed
     */
    public function createXcx($input)
    {
        $result = $this->xcxUserRepository->create($input);
        $time = time();
        $param = [$result->id,$time,5];
        return Hashids::connection('user')->encode($param);
    }

    /**
     * @param $xcxId
     * @return mixed
     */
    public function getUserByXcxId($xcxId)
    {
        return $this->userRepository->getUserByXcxId($xcxId);
    }
}