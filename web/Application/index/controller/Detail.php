<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/12/012
 * Time: 17:53
 */

namespace app\index\controller;


class Detail extends Base
{
    public function index($college=''){
        $this->assign("title","院校详情");
        return $this->fetch();
    }
}