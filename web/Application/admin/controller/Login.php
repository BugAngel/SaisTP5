<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/28/028
 * Time: 14:51
 */

namespace app\admin\controller;

use app\admin\model\Admin;
use think\captcha\Captcha;
use think\Controller;

class Login extends Controller
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
        $admin = Admin::get(['account' => $account]);
        $return = $this->checkPassword($admin,$password);
        if (!$return) {
            $res['status'] = 0;
            $res['message'] = "账号密码不匹配！";
            return json($res);
        } else {
            $admin->loginip=$this->request->ip();
            $admin->save();
            session('admin_id', $admin->id);     //将id存入session
            session('admin_account', $admin->account); //将account存入session
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
    public function checkPassword(Admin $admin,$password){
        if($admin===null){
            return false;
        }else{
            return $admin->checkPassword($password);
        }
    }

    /**
     * 退出
     */
    public function logout(){
        session(null);
        $this->redirect("login");
    }
}