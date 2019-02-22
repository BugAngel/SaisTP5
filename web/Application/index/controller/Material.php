<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/21/021
 * Time: 16:56
 */

namespace app\index\controller;


use app\index\model\User;

class Material extends UserBase
{
    public function index()
    {
        $this->assign("title", "修改密码");
        return $this->fetch();
    }

    /***
     * 修改密码
     */
    public function changePassword()
    {
        $old_password = input('old_password', '', 'md5');
        $new_password = input('new_password', '', 'md5');
        $map['id'] = $admin_id = session('id');
        $user = User::get(['id' => $admin_id]);  //根据当前session('id')，查找原密码
        if ($old_password === $user['password']) {  //检测原始密码是否正确
            $user->password = $new_password;
            $user->save(); //更改密码
            if ($user !== false) {
                $res['status'] = 1;
                $res['message'] = '更改成功';
                return json($res);
            } else {
                $res['status'] = 0;
                $res['message'] = '更改失败';
                return json($res);
            }
        } else {
            $res['status'] = 0;
            $res['message'] = '更改失败，原始密码错误';
            return json($res);
        }
    }

    public function changeData(){
        $user = db('user');
        $data = input('post.');
        $data['ielts']=(double)$data['ielts'];
        $data['toefl']=(double)$data['toefl'];
        $data['gpa']=(double)$data['gpa'];
        $data['sat']=(double)$data['sat'];
        $res  = $user->where('account',session('account'))->update($data);
        if($res !== false){
            $this->success('操作成功',url('index'));
        }else{
            $this->error('添加失败');
        }
    }
}