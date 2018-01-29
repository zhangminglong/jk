<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/5
 * Time: 上午11:41
 */

namespace App\Repositories\Eloquent;
use App\Exceptions\DataNullException;
use Bosnadev\Repositories\Eloquent\Repository;
abstract class BaseRepository extends Repository
{
    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $result = parent::find($id);
        if (empty($result) ){
            throw new DataNullException();
        } else {
            return $result;
        }
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function hidFind($hid)
    {
        $result = parent::findWhere(['hid' => $hid])->first();
        if (empty($result) ){
            throw new DataNullException();
        } else {
            return $result;
        }
    }

    /**
     * @param array $data
     * @param $hid
     * @param string $attribute
     * @return mixed
     */
    public function hidUpdate(array $data, $hid, $attribute = "hid")
    {
        return parent::update($data, $hid, $attribute = "hid");
    }

    /**
     * @param $hid
     * @return mixed
     */
    public function hidDelete($hid)
    {
        return $this->model->whereHid($hid)->delete();
    }

    /**
     * @return mixed
     */
    public function models()
    {
        return $this->model;
    }
}