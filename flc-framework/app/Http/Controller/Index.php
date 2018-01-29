<?php
namespace App\Http\Controller;

use App\Core\DB;
use App\Http\Model\Members;

class Index extends Base
{
    /**
     * 首页
     * @return [type] [description]
     */
    public function index()
    {
        //echo 'Hello world! - ' . date('Y-m-d H:i:s') . '<br />';

        //$result = DB::table('members')->take(5)->get();
        $member = Members::with('info')->where(['id' => 2])->first();

        //$member->is_worker = 0;
        //$member->save();
        //print_r($member->info->real_name);

        $rs = Members::with(['info' => function($query){
            $query->select('uid', 'real_name');
        }])->select('id', 'user_name')->where(function($query){
            $query->whereBetween('reg_time' , [strtotime('2014-01-01'), strtotime('2015-01-01')]);
        })->take(10)->orderBy('id', 'asc')->get();

        print_r($rs->toArray());
    }
}