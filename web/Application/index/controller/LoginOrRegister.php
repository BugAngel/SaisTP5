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
use app\index\model\User;

class LoginOrRegister extends Controller
{
    /***
     * 登录方法
     */
    public function login(){
        $this->assign('title',"登录界面");
        return $this->fetch();
    }

    /***
     * 注册方法
     */
    public function register(){
        $this->assign('title',"注册界面");
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

    public function checkRegister()
    {
        $code = input('code');
        $captcha = captcha_check($code);
        if (!$captcha) {
            $res['status'] = 0;
            $res['message'] = "验证码错误";
            return json($res);
        }
        /**检测用户名是否正确**/
        $account = input("account", "", "trim");    //接收用户名，并且使用trim函数去除首尾空格
        $return = $this->checkAccount(User::get(['account' => $account]));
        if (!$return) {
            $res['status'] = 0;
            $res['message'] = "账号已被注册！";
            return json($res);
        } else {
            $password = input("password", "", "md5");    //接收密码，并且使用md5函数加密
            $user=new User;
            $user->account=$account;
            $user->password=$password;
            $user->nickname=$account;
            $user->loginip=$this->request->ip();
            $user->logintime=date('Y-m-d h:i:s', time());
            $user->admin='0';
            $user->comment='1';
            $user->gender='0';
            $user->ielts=0;
            $user->toefl=0;
            $user->gpa=0;
            $user->sat=0;
            $arr = [];
            $len = 150;//长度
            $arr[1]=33.3;
            $arr[2]=33.3;
            $arr[3]=33.3;
            for($i=4;$i<$len;$i++) {
                $arr[$i] = 0.0;
            }
            $user->recommend=$arr;
            $user->save();
            $res['status'] = 1;
            $res['message'] = '注册成功!';
            session('id', $user->id);     //将id存入session
            session('account', $user->account); //将account存入session
            session('nickname', $user->nickname); //将nickname存入session
            return json($res);
        }
    }

    public function checkLogin()
    {
        $code = input('code');
        $captcha = captcha_check($code);
        if (!$captcha) {
            $res['status'] = 0;
            $res['message'] = "验证码错误";
            return json($res);
        }

        /**检测用户名密码是否正确**/
        $account = input("account", " ", "trim");    //接收用户名，并且使用trim函数去除首尾空格
        $password = input("password", " ", "md5");    //接收密码，并且使用md5函数加密
        $user = User::get(['account' => $account]);
        $return = $this->checkPassword($user,$password);
        if (!$return) {
            $res['status'] = 0;
            $res['message'] = "账号密码不匹配！";
            return json($res);
        } else {
            $user->loginip=$this->request->ip();
            $user->logintime=date('Y-m-d h:i:s', time());
            $user->save();
            session('id', $user->id);     //将id存入session
            session('account', $user->account); //将account存入session
            session('nickname', $user->nickname); //将nickname存入session
            $res['status'] = 1;
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
    public function checkPassword(User $user,$password){
        if($user===null){
            return false;
        }else{
            return $user->checkPassword($password);
        }
    }

    /***
     * @param $account : 用户账号
     * @return true 表示账号未被注册 false表示账号已被注册
     */
    public function checkAccount($user)
    {
        return $user === null ;
    }

    /**
     * 退出
     */
    public function logout(){
        session(null);
        $this->redirect("index/index");
    }
}