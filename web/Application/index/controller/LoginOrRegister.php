<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/15
 * Time: 13:33
 */

namespace app\index\controller;

use think\Controller;
use think\captcha\Captcha;
use think\Db;
use think\exception;

class LoginOrRegister extends Controller
{
    /***
     * 登录方法
     */
    public function login(){
        return $this->fetch();
    }

    /**
     * 产生验证码方法
     */
    public function captcha(){
        $config =    array(
            'fontSize' => 30,    // 验证码字体大小
            'length'   => 4,     // 验证码位数
            'useNoise' => true, // 开启验证码杂点
            'imageW'   => 216,   // 图片宽度
            'imageH'   => 84,    // 图片高度
            'codeSet'  => '0123456789',//随机产生0-9中的数字
        );
        $captcha = new Captcha($config);
        return $captcha->entry();
    }

    public function checkRegister(){
        echo "傻逼玩意";
    }

    public function checkLogin(){
        $code=input('code');
        $captcha=$this->checkCode($code);
        if($captcha){
            echo "正确";
        }else{
            echo "错误";
        }

        /**检测用户名密码是否正确**/
        $account = input("account"," ","trim"); 	//接收用户名，并且使用trim函数去除首尾空格
        $password = input("password"," ","md5");	//接收密码，并且使用md5函数加密
        $return   = $this->checkPassword($account,$password);
        if($return){
            echo "登录成功";
        }else{
            echo "登录失败";
        }
    }

    /***
     * 检查用户输入的验证码是否正确
     * @param $code : 输入的验证码
     * @return bool : 验证码正确返回true，错误返回false
     */
    public function checkCode($code){
        $captcha = new Captcha();
        return $captcha->check($code);
    }

    /***
     * 检测用户名密码是否匹配
     * @param $account
     * @param $password
     * @return bool
     */
    public function checkPassword($account,$password){
        $map['account'] = $account;
        try {
            $admin = Db::name('user')->where($map)->find();
        }catch (Exception $e){
            echo 'Message: ' .$e->getMessage();
        }
        if($admin['password'] === $password){
            return $admin;
        }else{
            return false;
        }
    }
}