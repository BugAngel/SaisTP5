<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/15/015
 * Time: 15:17
 */

namespace app\admin\model;


use think\Model;

class Admin extends Model
{
    /***
     * 检测用户名密码是否匹配
     * @param $account
     * @param $password
     * @return
     */
    public function checkPassword($password)
    {
        return $password===$this->getAttr('password');
    }
}