<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/24/024
 * Time: 14:33
 */

namespace app\index\controller;


use think\Controller;

class Help extends Controller
{
    public function method()
    {
        $this->assign('title',"使用方法");
        return $this->fetch();
    }

    public function about()
    {
        $this->assign('title',"关于我们");
        return $this->fetch();
    }
}