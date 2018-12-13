<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\exception;

class Index extends Controller
{
    public function index()
    {
        //        http://localhost/WFT/web/public/index.php/index/
//        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
//    return "hello world";
// 插入记录
        Db::name('user')
            ->insert(['username' => 'SuMing', 'password' => md5('123456'),'group'=>'admin']);

// 更新记录
        try{
            Db::name('user')
                ->where('group', 'admin')
                ->update(['username' => 'YeFan']);
        }catch (Exception $e){
            echo 'Message: ' .$e->getMessage();
        }


// 查询数据
        try{
            $list = Db::name('user')
                ->where('group', 'admin')
                ->find();
            dump($list);
        }catch (Exception $e){
            echo 'Message: ' .$e->getMessage();
        }

//        // 删除数据
//        try{
//            Db::name('user')
//                ->where('group', 'admin')
//                ->delete();
//        }catch (Exception $e){
//            echo 'Message: ' .$e->getMessage();
//        }

    }

    public function hello($name = 'ThinkPHP5')
    {
        $this->assign('name',$name);
        return $this->fetch();
    }
}
