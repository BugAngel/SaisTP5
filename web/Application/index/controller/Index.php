<?php
namespace app\index\controller;


class Index extends Base
{
    public function index()
    {
        $this->assign('title',"主界面");
        return $this->fetch();
    }
}
