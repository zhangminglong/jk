<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/5
 * Time: 下午10:16
 */

namespace App\Repositories\Contracts;


interface NodeRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $hid
     * @return mixed
     */
    public function getChildByHid($hid);

    /**
     * @param $hid
     * @return mixed
     */
    public function detachPostNode($hid);

    /**
     * 获取节点下所有帖子
     * @param $nodeHid
     * @return mixed
     */
    public function getPost($nodeHid);

    /**
     * @return mixed
     */
    public function getShowNode();
}