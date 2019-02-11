<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/24/024
 * Time: 10:58
 */

namespace app\index\controller;


class Detail extends Base
{
    public function xingqian()
    {
        $this->assign('title',"行前准备");
        return $this->fetch();
    }

    public function xuexi()
    {
        $this->assign('title',"学习指南");
        return $this->fetch();
    }

    public function kecheng()
    {
        $this->assign('title',"课程对照");
        return $this->fetch();
    }

    public function gonggong()
    {
        $this->assign('title',"公共用语");
        return $this->fetch();
    }
}