<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/11/011
 * Time: 18:14
 */

namespace app\index\controller;

use think\Controller;
use think\facade\Session;
use app\index\model\User;

class Base extends Controller
{
    public function initialize(){
        if(!Session::has('id') || !Session::has('account')){
            $login_res= '0';
        }else{
            $login_res= '1';
        }
        $this->assign('login_res',$login_res);
        if($login_res==='1'){
            $account=session('account');
            $user = User::get(['account' => $account]);
            $login_nickname=$user->nickname;
            $this->assign('login_nickname',$login_nickname);
        }
    }
}