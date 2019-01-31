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
    public function index($area=0)
    {
        $this->assign('title',"院校自选");
        $map=[];
        switch ($area) {
            case 1:
                $map['country'] = array('in','美国');
                break;
            case 2:
                $map['country'] = array('in','英国');
                break;
        }
        $list = CollegeInfo::all(function($query)use($map){
            $query->where($map)->order('world_rank', 'asc');
        });
        $college=[];
        foreach ($list as $school) {
            $college[]=[
                'href'=>$school->college_name,
                'icon'=>$school->icon,
                'college_name'=>$school->college_name,
                'college_e_name'=>$school->college_e_name,
                'major_rank_name'=> $school->major_rank_name,
                'major_rank'=> $school->major_rank,
                'world_rank'=> $school->world_rank,
                'rate'=> $school->rate,
                'country'=> $school->country,
                'area'=> $school->area,
                'hot_major'=> implode("、",$school->hot_major),
            ];
        }
        return $this->fetch('',['college'=>$college]);
    }
}