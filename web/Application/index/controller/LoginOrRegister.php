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
        $code=input('code');
        $captcha=captcha_check($code);
        if(!$captcha){
            $res['statue']=0;
            $res['message']="验证码错误";
            return json($res);
        }
        /**检测用户名是否正确**/
        $account = input("account","","trim"); 	//接收用户名，并且使用trim函数去除首尾空格
        if($account==null){
            $res['status']  = 0;
            $res['message'] = '账号为空!';
            return json($res);
        }
        $return   = $this->checkAccount($account);
        if(!$return){
            $res['statue']=0;
            $res['message']="账号已被注册！";
            return json($res);
        }else{
            $password = input("password","","md5");	//接收密码，并且使用md5函数加密
            $email=input("email");	//邮箱
            $sdate=input("sdate");//出生日期
            $country=input("country");//感兴趣国家
            $user=new User();
            $user->setAccount($account);
            $user->setPassword($password);
            $user->setEmail($email);
            $user->setBirthday($sdate);
            $user->setCountry($country);
            $user->setLoginip($this->request->ip());
            trace($user);
            Db::name('user')->insert($user->toArray());
            session('id', $return["id"]);     //将id存入session
            session('username', $return["username"]); //将username存入session
            $res['status']  = 1;
            $res['message'] = '注册成功!';
            return json($res);
        }
    }

    public function checkLogin(){
        $code=input('code');
        $captcha=captcha_check($code);
        if(!$captcha){
            $res['statue']=0;
            $res['message']="验证码错误";
            return json($res);
        }

        /**检测用户名密码是否正确**/
        $account = input("account"," ","trim"); 	//接收用户名，并且使用trim函数去除首尾空格
        $password = input("password"," ","md5");	//接收密码，并且使用md5函数加密
        $return   = $this->checkPassword($account,$password);
        if(!$return){
            $res['statue']=0;
            $res['message']="账号密码不匹配！";
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
            session('account', $return["account"]); //将account存入session
            $res['status']  = 1;
            $res['message'] = '登录成功!';
            return json($res);
        }
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
            return false;
        }else{
            return true;
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