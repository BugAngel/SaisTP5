<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/22/022
 * Time: 16:53
 */

namespace app\admin\controller;


class ComplainList extends Base
{
    /**
     * 列表
     */
    public function lists(){
        $user = db('complaint');
        $keyword = input('keyword','','trim');      //过滤开头结尾空格
        $this->assign('keyword',$keyword);
        if($keyword){
            $datalists = $user->where('content','like',$keyword)->order('id','desc')->paginate(10);
        }else{
            $datalists = $user->order('id','desc')->paginate(10);
        }
        $this->assign('datalists',$datalists);
        return $this->fetch();
    }

    /**
     * 单选删除
     */
    public function delete(){
        $map['id'] = input('id');
        $res = model('complaint')->where($map)->delete();
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
        if(db('complaint')->where('id','in',$ids)->delete()){
            $message = '删除成功';
        }else {
            $message = '删除失败';
        }
        return json($message);
    }
}