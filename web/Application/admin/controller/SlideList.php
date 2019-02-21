<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/16/016
 * Time: 15:54
 */

namespace app\admin\controller;


use think\exception\ErrorException;
use think\Request;
use think\Facade\Env;

class SlideList extends Base
{
    /**
     * 列表
     */
    public function lists(){
        $slide = db('slide');
        $keyword = input('keyword','','trim');      //过滤开头结尾空格
        $this->assign('keyword',$keyword);
        if($keyword){
            $datalists = $slide->where('college_name','like',$keyword)->order('qs','asc')->paginate(5);
        }else{
            $datalists = $slide->order('qs','asc')->paginate(5);
        }
        $this->assign('datalists',$datalists);
        return $this->fetch();
    }

    /**
     * 新增
     */
    public function add(Request $request){
        $slide = db('slide');
        if($this->request->isPost()){
            // 获取表单上传文件
            $file = $request->file('picture');
            if (empty($file)) {
                $this->error('请选择上传文件');
            }
            // 移动到框架应用根目录/Public/static/images/uploads/ 目录下
            $info = $file->validate(['ext' => 'jpg,png'])->move('./static/images/uploads/');
            if (!$info) {
                // 上传失败获取错误信息
                $this->error($file->getError());
            }

            $data = input('post.');
            $data['picture']=$info->getSaveName();
            $data['qs']=(int)$data['qs'];
            $res  = $slide->insert($data);
            if($res !== false){
                $this->redirect('lists');
            }else{
                $this->error('添加失败');
            }
        }
        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function edit(Request $request){
        $slide = db('slide');
        if($this->request->isPost()){
            $data = input('post.');
            // 获取表单上传文件

            if ($_FILES['picture']['tmp_name']) {
                $file = $request->file('picture');
                if (empty($file)) {
                    $this->error('请选择上传文件');
                }
                // 移动到框架应用根目录/Public/static/images/uploads/ 目录下
                $info = $file->validate(['ext' => 'jpg,png'])->move('./static/images/uploads/');
                if (!$info) {
                    // 上传失败获取错误信息
                    $this->error($file->getError());
                }
                $data['picture']=$info->getSaveName();
            }
            $data['qs']=(int)$data['qs'];
            $res  = $slide->where('college_e_name',$data['college_e_name'])->update($data);
            if($res !== false){
                $this->redirect('lists');
            }else{
                $this->error('添加失败');
            }
        }else{
            $map['id']  = input('id');
            $data = $slide->where($map)->select();
            $this->assign('data',$data[0]);
            return $this->fetch();
        }
        return $this->fetch();
    }

    /**
     * 单选删除
     */
    public function delete(){
        $map['id']    = $slide = input('id');
        $res = db('slide')->where($map)->delete();
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
        if(db('slide')->where('id','in',$ids)->delete()){
            $message = '删除成功';
        }else {
            $message = '删除失败';
        }
        return json($message);
    }
}