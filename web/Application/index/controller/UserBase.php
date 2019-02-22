<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/21/021
 * Time: 16:57
 */

namespace app\index\controller;

use think\Controller;
use think\facade\Session;
use app\index\model\User;

class UserBase extends Controller
{
    public function initialize(){
        if(!Session::has('id') || !Session::has('account')){
            $this->redirect("login_or_register/login");
        }else{
            $account=session('account');
            $user = User::get(['account' => $account]);
            $this->assign("user",$user);
            $this->assign("login_res","1");
            $login_nickname=$user->nickname;
            $this->assign('login_nickname',$login_nickname);
        }
    }
}