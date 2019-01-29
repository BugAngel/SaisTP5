<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\exception;

class Index extends Controller
{
    public function index()
    {
        $this->assign('title',"主界面");
        return $this->fetch();
    }

    public function hello($name = 'ThinkPHP5')
    {
        $this->assign('name',$name);
        return $this->fetch();
    }

    public function test()
    {
        $user=[];
        for($key=0;$key<10;$key++){
            $user[]=[
                'name'=>'peter'.$key,
                'sex'=>$key?'男':'女',
                'age'=>rand(15,40),
                'salary'=>rand(3200,6800)
            ];
        }
        return $this->view->fetch('',['user'=>$user]);
    }
}
