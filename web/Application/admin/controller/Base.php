<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/11/011
 * Time: 18:14
 */

namespace app\admin\controller;

use think\Controller;
use think\facade\Session;

class Base extends Controller
{
    public function initialize(){
        if(!Session::has('id') || !Session::has('account')){
            $this->redirect("admin/login/login");
        }
    }
}