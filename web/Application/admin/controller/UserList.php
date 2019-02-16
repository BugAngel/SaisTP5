<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/16/016
 * Time: 11:44
 */

namespace app\admin\controller;


use app\admin\model\User;

class UserList extends Base
{
    /**
     * 列表
     */
    public function lists(){
        $user = db('user');
        $keyword = input('keyword','','trim');      //过滤开头结尾空格
        $this->assign('keyword',$keyword);
        if($keyword){
            $datalists = $user->where('account','like',$keyword)->order('id','desc')->paginate(10);
        }else{
            $datalists = $user->order('id','desc')->paginate(10);
        }
        $this->assign('datalists',$datalists);
        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function edit(){
        $user = db('user');
        if($this->request->isPost()){
            $data = input('post.');
            $res  = $user->where('account',$data['account'])->update($data);
            if($res !== false){
                $this->success('操作成功',url('lists'));  //跳转到列表页
            }else{
                $this->error('添加失败');
            }
        }else{
            $map['id']  = $id = input('id');
            $user = $user->where($map)->select(); //查找高级分类
            $this->assign('user',$user[0]);
            return $this->fetch();
        }
        return $this->fetch();
    }

    /**
     * 单选删除
     */
    public function delete(){
        $map['id']    = $user_account = input('id');
        $res = model('user')->where($map)->delete();
        if($res){
            $message = '删除成功';
        }else{
            $message = '删除失败';
        }
        return json($message);
    }

    /**
     * 全选删除
     */
    public function delAll(){
        $ids = input('ids',0);
        //删除所有选中高级分类
        $map['id']  = array('in',$ids);
        if(model('user')->where('id','in',$ids)->delete()){
            $message = '删除成功';
        }else {
            $message = '删除失败';
        }
       return json($message);
    }
}