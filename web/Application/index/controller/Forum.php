<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/22/022
 * Time: 10:46
 */

namespace app\index\controller;


use app\index\model\Post;
use think\facade\Session;

class Forum extends Base
{
    public function index(){
        $this->assign("title","论坛");
        $list = db('post')->where(['post_type'=>0])->order('addtime', 'desc')->paginate(5);
        $post=$list->all();
        $this->assign("post",$post);
        $this->assign("list",$list);
        return $this->fetch();
    }

    public function detail($id=''){
        $this->assign("title","论坛详情");
        $post=Post::get(['id'=>$id]);
        $list = db('post')->where(['post_type'=>1,'pid'=>$id])->order('addtime', 'desc')->paginate(5);
        $reply=$list->all();
        trace($reply);
        foreach($reply as $k => $v){
            $temp=Post::get(['id'=>$reply[$k]['parent_user_id']]);
            $reply[$k]['parent'] = $temp->nickname;
        }
        $this->assign("post",$post);
        $this->assign("reply",$reply);
        $this->assign("list",$list);
        return $this->fetch();
    }

    public function post($title='',$content=''){
        if(!Session::has('id') || !Session::has('nickname')){
            $res= "2";
            return json($res);
        }

        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        $post->addtime = date('Y-m-d h:i:s', time());
        $post->nickname = session('nickname');
        $post->user_id = session('id');
        $post->post_type = 0;
        if ($post->save()) {
            $res = "1";
            return json($res);
        } else {
            $res = "0";
            return json($res);
        }
    }

    public function reply($content='',$parent_user_id='',$id=''){
        if(!Session::has('id') || !Session::has('nickname')){
            $res= "2";
            return json($res);
        }

        $post = new Post();
        $post->content = $content;
        $post->addtime = date('Y-m-d h:i:s', time());
        $post->nickname = session('nickname');
        $post->user_id = session('id');
        $post->pid = $id;//发帖人ID
        $post->parent_user_id = $parent_user_id;//被回复人ID
        $post->post_type = 1;
        if ($post->save()) {
            $res = "1";
            return json($res);
        } else {
            $res = "0";
            return json($res);
        }
    }
}