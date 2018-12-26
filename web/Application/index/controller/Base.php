<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/25
 * Time: 0:16
 */

use think\Controller;

class Base extends Controller {
    public function _initialize(){
        if(!isset($_SESSION['id']) || !isset($_SESSION['account'])){
            $this->redirect("LoginOrRegister/login");
        }
    }

}