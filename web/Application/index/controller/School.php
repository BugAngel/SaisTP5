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
    public function test()
    {
        $this->assign('title',"院校自选");

        trace("进入后台");
        $country="美国";
        trace($country);
        $qsLow="1";
        $qsHigh="10";
        $majorLow="1";
        $majorHigh="10";

        $map=[];

        $map[0] = ['world_rank','between',[$qsLow, $qsHigh]];
        $map[1] = ['major_rank','between',[$majorLow, $majorHigh]];
        if($country!="全部")
        {
            $map[2]=['country','=',$country];
        }
        trace($map);
        $list = CollegeInfo::all(function($query)use($map,$qsLow, $qsHigh){
//            trace($map);
            $query->where('world_rank','between',[$qsLow, $qsHigh])->order('world_rank', 'asc');
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
        trace($college);
        return $this->fetch('index',['college'=>$college]);
    }

    public function index()
    {
        $this->assign('title',"院校自选");

        trace("进入后台");
        $country=input('country');
        trace("country的值",$country);
        $qsLow=input('qsLow');
        $qsHigh=input('qsHigh');
        $majorLow=input('majorLow');
        $majorHigh=input('majorHigh');

        $map=[];

        $map[0] = ['world_rank','between',[$qsLow, $qsHigh]];
        $map[1] = ['major_rank','between',[$majorLow, $majorHigh]];
        if($country!="全部")
        {
            $map[2]=['country','=',$country];
        }

        $list = CollegeInfo::all(function($query)use($map){
//            trace($map);
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