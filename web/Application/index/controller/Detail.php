<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/12/012
 * Time: 17:53
 */

namespace app\index\controller;


use app\index\model\Banner;
use app\index\model\CollegeDetail;
use app\index\model\CollegeInfo;

class Detail extends Base
{
    public function index($college=''){
        $this->assign("title","院校详情");

        $icon=$college.'.png';
        $college_detail = CollegeDetail::get(['icon'=> $icon]);
        $college_detail['hot_major'] = $college_detail['hot_major'][0];
        $this->assign('college_detail',$college_detail);
        return $this->fetch();
    }
}