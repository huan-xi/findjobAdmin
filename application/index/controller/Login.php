<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2018/10/16
 * Time: 21:19
 */

namespace app\index\controller;


use think\Controller;
use think\Session;

class Login extends Controller
{
    function index()
    {
        return $this->fetch();
    }
    function logout(){
        Session::set('username','');
        $this->success('已经安全退出',url('index'));
    }
    function login()
    {
        $data = input('post.');
//        var_dump($data['vertify']);
        if (!captcha_check($data['vertify']))
            json_return(['status' => 0, 'msg' => '验证码错误']);
        else {
            if ($data['username'] != 'admin' && $data['password'] != 'admin') {
                json_return(['status' =>0, 'msg' => '账号或密码错误！']);
            } else{
                Session::set("username",'admin');
                json_return(['status' => 1, 'url' => '/index.php/index']);
            }

        }

    }
}
