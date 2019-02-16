<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/16/016
 * Time: 11:00
 */

namespace app\admin\controller;


use app\admin\model\Admin;

class Index extends Base {
    public function index()
    {
        $this->redirect('admin/user_list/lists');
    }

    /***
     * 修改密码
     */
    public function changePassword(){
        if($this->request->isPost()){
            $old_password = input('old_password','','md5');
            $new_password = input('new_password','','md5');
            $map['id']    = $admin_id = session('admin_id');
            $admin = Admin::get(['id' => $admin_id]);  //根据当前session('admin_id')，查找原密码
            if($old_password === $admin['password']){  //检测原始密码是否正确
                $admin->password=$new_password;
                $admin->save(); //更改密码
                if($admin !== false){
                    $res['status']  = 1;
                    $res['message'] = '更改成功';
                    return json($res);
                }else{
                    $res['status']  = 0;
                    $res['message'] = '更改失败';
                    return json($res);
                }
            }else{
                $res['status']  = 0;
                $res['message'] = '更改失败，原始密码错误';
                return json($res);
            }
        }else{
            return $this->fetch();
        }
    }
}