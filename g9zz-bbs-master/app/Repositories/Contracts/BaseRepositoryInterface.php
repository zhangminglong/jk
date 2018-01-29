<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/5
 * Time: 上午11:40
 */

namespace App\Repositories\Contracts;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

interface BaseRepositoryInterface extends Repository
{

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'));

    /**
     * @param $hid
     * @return mixed
     */
    public function hidFind($hid);

    /**
     * @param array $data
     * @param $hid
     * @param string $attribute
     * @return mixed
     */
    public function hidUpdate(array $data, $hid, $attribute = "hid");

    /**
     * @param $hid
     * @return mixed
     */
    public function hidDelete($hid);

    /**
     * @return mixed
     */
    public function models();
}