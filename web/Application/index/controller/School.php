<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/24/024
 * Time: 17:05
 */

namespace app\index\controller;


use app\index\model\CollegeInfo;

class School extends Base
{
    public function index($country='all',$qsLow='1',$qsHigh='150',$majorLow='1',$majorHigh='150')
    {
        $this->assign('title',"院校自选");

        $map=[];

        $map[0] = ['world_rank','between',[(int)$qsLow, (int)$qsHigh]];
        $map[1] = ['major_rank','between',[(int)$majorLow, (int)$majorHigh]];
        if($country=="US"){
            $map[2]=['country','=',"美国"];
        }else if($country=="UK"){
            $map[2]=['country','=',"英国"];
        }

        $list = db('college_info')->where($map)->order('world_rank', 'asc')->paginate(5);
        $college=$list->all();
        foreach($college as $k => $v){
            $college[$k]['hot_major'] = implode("、",$college[$k]['hot_major']);
            $college[$k]['href'] = explode('.', $college[$k]['icon'])[0];
        }
        $this->assign('college',$college);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function sousuo($like='')
    {
        $this->assign('title',"院校自选");

        $college = CollegeInfo::all(function($query)use($like){
            $query->where('college_name', 'LIKE', $like)->order('world_rank', 'asc');
        });

        foreach($college as $k => $v){
            $college[$k]['hot_major'] = implode("、",$college[$k]['hot_major']);
            $college[$k]['href'] = explode('.', $college[$k]['icon'])[0];
        }
        $this->assign('college',$college);
        return $this->fetch();
    }
}