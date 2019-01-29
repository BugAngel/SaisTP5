<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/24/024
 * Time: 17:05
 */

namespace app\index\controller;


use think\Controller;

class School extends Controller
{
    public function index()
    {
        $this->assign('title',"院校自选");
        $college=[];
        for($key=0;$key<10;$key++){
            $college[]=[
                'href'=>'jianqiao',
                'icon'=>"beikaluolainai.png",
                'college'=>"剑桥大学",
                'college_e_name'=>"jian qiao",
                'major_rank_name'=> '泰晤士',
                'major_rank'=> 1,
                'world_rank'=> 1,
                'rate'=> "20%",
                'country'=> "英国",
                'city'=> "那个哪",
                'hot_major'=> "哈哈",
            ];
        }
        return $this->fetch('',['college'=>$college]);
    }
}