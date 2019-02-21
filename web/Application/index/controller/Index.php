<?php
namespace app\index\controller;


use app\index\model\Slide;
use app\index\model\User;
use think\facade\Session;

class Index extends Base
{
    public function index()
    {
        $this->assign('title',"主界面");

        if(!Session::has('id') || !Session::has('account')){
            $img1 = Slide::get(['qs'=>1]);
            $img2 = Slide::get(['qs'=>2]);
            $img3 = Slide::get(['qs'=>3]);
        }else{
            $user = User::get(['account' => session('account')]);
            $data=$user->recommend;
            arsort($data);
            $i=1;
            foreach($data as $x=>$x_value)
            {
                switch ($i){
                    case 1:
                        $img1 = Slide::get(['qs'=>$x]);
                        break;
                    case 2:
                        $img2 = Slide::get(['qs'=>$x]);
                        break;
                    case 3:
                         $img3 = Slide::get(['qs'=>$x]);
                         break;
                }
                $i=$i+1;
                if($i>3){
                    break;
                }
            }
        }

        $this->assign('img1',$img1);
        $this->assign('img2',$img2);
        $this->assign('img3',$img3);
        return $this->fetch();
    }
}
