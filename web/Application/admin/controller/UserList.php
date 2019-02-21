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
                $this->success('操作成功',url('lists'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $map['id']  = input('id');
            $user = $user->where($map)->select();
            $this->assign('user',$user[0]);
            return $this->fetch();
        }
        return $this->fetch();
    }

    /**
     * 单选删除
     */
    public function delete(){
        $map['id'] = input('id');
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
        $map['id']  = array('in',$ids);
        if(db('user')->where('id','in',$ids)->delete()){
            $message = '删除成功';
        }else {
            $message = '删除失败';
        }
       return json($message);
    }
}