<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/18
 * Time: 14:38
 */
namespace app\index\model;

use think\Model;

class User extends Model
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