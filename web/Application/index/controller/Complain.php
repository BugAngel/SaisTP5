<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/11/011
 * Time: 16:00
 */

namespace app\index\controller;


use app\index\model\Complaint;
use think\Controller;
use think\facade\Session;

class Complain extends Controller
{
    public function checkComplain($tsnr="",$email="",$phone="")
    {
        if(!Session::has('id') || !Session::has('account')){
            $res= "2";
            return json($res);
        }
        $complaint = new Complaint();
        $complaint->content = $tsnr;
        $complaint->mail = $email;
        $complaint->phone = $phone;
        if ($complaint->save()) {
            $res = "1";
            return json($res);
        } else {
            $res = "0";
            return json($res);
        }
    }
}