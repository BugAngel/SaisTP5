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
        return $this->fetch();
    }
}