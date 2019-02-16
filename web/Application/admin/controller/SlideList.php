<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/16/016
 * Time: 15:54
 */

namespace app\admin\controller;


class SlideList extends Base
{
    public function lists(){
        return $this->fetch();
    }
}