<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/12/012
 * Time: 17:53
 */

namespace app\index\controller;


use app\index\model\Slide;
use app\index\model\CollegeDetail;
use app\index\model\CollegeInfo;
use app\index\model\User;
use think\facade\Session;

class Detail extends Base
{
    public function index($college=''){
        $this->assign("title","院校详情");

        $icon=$college.'.png';
        $college_detail = CollegeDetail::get(['icon'=> $icon]);
        $college_detail['hot_major'] = $college_detail['hot_major'][0];
        $slide = Slide::get(['college_e_name'=> $college_detail->college_e_name]);
        $picture = strtr($slide->picture, '\\', '/');

        $this->assign('college_detail',$college_detail);
        $this->assign('banner',$picture);

        if(Session::has('id') && Session::has('account')){
            $user = User::get(['account' => session('account')]);
            $rank=$college_detail['world_rank'];
            $recommend=$user->recommend;
            $list = CollegeInfo::all();
            foreach ($list as $item) {
                $world_rank=$item->world_rank;
                $add=100.0/sqrt(2*3.14*10)*exp(-($world_rank-$rank)*($world_rank-$rank)/(2*10));
                $recommend[$world_rank]=$recommend[$world_rank]+$add;
            }

            $sum=array_sum($recommend);
            $len=150;
            for($i=1;$i<$len;$i++) {
                $recommend[$i]=$recommend[$i]*100/$sum;
            }
            $user->recommend=$recommend;
            $user->save();
        }

        return $this->fetch();
    }
}