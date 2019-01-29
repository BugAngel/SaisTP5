<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/28/028
 * Time: 14:51
 */

namespace app\admin\controller;

use think\captcha\Captcha;
use think\Controller;

class Login extends Controller
{
    public function login(){
        if(request()->isPost()){
            //检测验证码是否正确
            $code   = input('code');
            $verify = captcha_check($code);
            if(!$verify){
                $res['status']  = 0;
                $res['message'] = '验证码错误!';
                return json($res);
            }
            //检测用户名和密码是否正确
            $account = input("account",'','trim');
            $password = input("password",'','md5');
            $admin    = db("admin")->where("account",$account)->find();
            if(!$admin || $admin['password'] != $password){
                $res['status']  = 0;
                $res['message'] = '用户名或者密码错误!';
                return json($res);
            }else{
                db("admin")->where('account', $account)->update("loginip",$this->request->ip())->update("logintime",date("Y-m-d H:i:s"));
                session('admin_id',$admin["id"]);
                session('admin_account',$admin["account"]);
                $res['status']  = 1;
                $res['message'] = '登录成功!';
                return json($res);
            }
        }else{
            //判断session是否存在，session存在不需登录，直接跳转
            if(session('admin_id') || session('admin_account')){
                $this->redirect("Index/index");
            }else{
                return $this->fetch();
            }
        }
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

    /**
     * 检验登录信息
     */
    public function checkLogin(){
        /**检测验证码是否正确**/
        $code     = input('code');               	//接收验证码
        $verify   = captcha_check($code);	//调用checkCode方法
        if(!$verify){
            $res['status']  = 0;
            $res['message'] = '验证码错误!';
            return json($res);
        }
        /**检测用户名密码是否正确**/
        $account = input("account"," ","trim"); 	//接收用户名，并且使用trim函数去除首尾空格
        $password = input("password"," ","md5");	//接收密码，并且使用md5函数加密
        $return   = $this->checkPassword($account,$password);

        if(!$return){
            $res['status']  = 0;
            $res['message'] = '用户名或者密码错误!';
            return json($res);
        }else{
            db("admin")->where('account', $account)->update("loginip",$this->request->ip())->update("logintime",date("Y-m-d H:i:s"));

            session('admin_id', $return["id"]);     //将admin_id存入session
            session('admin_account', $return["account"]); //将admin_username存入session
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

        $admin = db('admin')->where($map)->find();

        if($admin['password'] === $password){
            return $admin;
        }else{
            return false;
        }
    }


    /**
     * 退出
     */
    public function logout(){
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_account']);
        $this->redirect("login");
    }
}