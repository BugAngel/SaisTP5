<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/24/024
 * Time: 17:05
 */

namespace app\index\controller;


use app\index\model\CollegeInfo;
use think\Controller;

class School extends Controller
{

    public function index($country='全部',$qsLow='1',$qsHigh='150',$majorLow='1',$majorHigh='150')
    {
        $this->assign('title',"院校自选");

        $map=[];

        $map[0] = ['world_rank','between',[(int)$qsLow, (int)$qsHigh]];
        $map[1] = ['major_rank','between',[(int)$majorLow, (int)$majorHigh]];
        if($country!="全部")
        {
            $map[2]=['country','=',$country];
        }

        $college = CollegeInfo::all(function($query)use($map){
            $query->where($map)->order('world_rank', 'asc');
        });

        foreach($college as $k => $v){
            $college[$k]['hot_major'] = implode("、",$college[$k]['hot_major']);
        }
        $this->assign('college',$college);
        return $this->fetch();
    }
}