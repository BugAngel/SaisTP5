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
use app\index\model\User;

class LoginOrRegister extends Controller
{
    /***
     * 登录方法
     */
    public function login(){
        return $this->fetch();
    }

    /***
     * 注册方法
     */
    public function register(){
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
        trace("进入检查注册函数");
        $code=input('code');
        $captcha=$this->checkCode($code);
        if($captcha){
            $res['statue']=0;
            $res['message']="验证码错误";
            return json($res);
        }
        /**检测用户名密码是否正确**/
        $account = input("account"," ","trim"); 	//接收用户名，并且使用trim函数去除首尾空格
        $return   = $this->checkAccount($account);
        if($return==0){
            $res['statue']=0;
            $res['message']="账号已被注册！";
            return json($res);
        }else{
            $password = input("password"," ","md5");	//接收密码，并且使用md5函数加密
            $email=input("email");	//邮箱
            $id=input("number");//身份证号
            $sdate=input("sdate");//出生日期
            $country=input("items");//感兴趣国家

            $user=new User();
            $user->setUsername($account);
            $user->setPassword($password);
            $user->setEmail($email);
            $user->setId($id);
            $user->setBirthday($sdate);
            $user->setCountry($country);
            $user->setLoginip($this->request->ip());

            Db::name('user')->insert($user->toArray());

            session('id', $return["id"]);     //将id存入session
            session('username', $return["username"]); //将username存入session

            $res['status']  = 1;
            $res['message'] = '注册成功!';
            return json($res);
        }
    }

    /***
     * 检查是否可以登录
     * @return \think\response\Json 登录信息
     */
    public function checkLogin(){
        $code=input('code');
        $captcha=$this->checkCode($code);
        if($captcha){
            $res['statue']=0;
            $res['message']="验证码错误";
            return json($res);
        }

        /**检测用户名密码是否正确**/
        $account = input("account"," ","trim"); 	//接收用户名，并且使用trim函数去除首尾空格
        $password = input("password"," ","md5");	//接收密码，并且使用md5函数加密
        $return   = $this->checkPassword($account,$password);
        if($return==-1){
            $res['statue']=0;
            $res['message']="账号不存在！";
            return json($res);
        }else if($return == 0){
            $res['statue']=0;
            $res['message']="密码错误！";
            return json($res);
        }else{
            $data=array(
                "loginip"=>$this->request->ip(),
            );
            try{
                Db::name('user')
                    ->where('account', $account)
                    ->update($data);
            }catch (Exception $e){
                echo 'Message: ' .$e->getMessage();
            }

            session('id', $return["id"]);     //将id存入session
            session('username', $return["username"]); //将username存入session

            $res['status']  = 1;
            $res['message'] = '登录成功!';
            return json($res);
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
     * 检测登录时用户名密码是否匹配
     * @param $account
     * @param $password
     * @return :-1 账号不存在 0 密码错误 1 正确
     */
    public function checkPassword($account,$password){
        $map['account'] = $account;
        try {
            $admin = Db::name('user')->where($map)->find();
        }catch (Exception $e){
            echo 'Message: ' .$e->getMessage();
        }

        if($admin==null){
            return -1;
        }

        if($admin['password'] === $password){
            return 1;
        }else{
            return 0;
        }
    }

    /***
     * @param $account : 用户账号
     * @return int : 0表示账号已被注册，1表示可以注册
     */
    public function checkAccount($account){
        $map['account'] = $account;
        try {
            $admin = Db::name('user')->where($map)->find();
        }catch (Exception $e){
            echo 'Message: ' .$e->getMessage();
        }

        if($admin!=null){
            return 0;
        }else{
            return 1;
        }
    }

    /**
     * 退出
     */
    public function logout(){
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        $this->redirect("login");
    }

}