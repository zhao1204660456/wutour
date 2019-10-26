<?php

namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\Session;

class Login extends Controller
{
    public function index()
    {
        return view();
    }

    public function check()
    {
        $data = input('post.');
        $a = crypt($data['password'], md5('hour'));
//        ->where(['username' => 'admin', 'password' => $a])
        $useen = Db::table('manager')->select();
        $user = $useen[0];
        if ($data['username'] !== $user['username']) {
            return json([
                'code' => 404,
                'msg' => '用户名不存在'
            ]);
        }

        if (!captcha_check($data['code'])) {
            return json([
                'code' => 404,
                'msg' => '验证码错误'
            ]);
        }
        if ($a == $user['password']) {
            Session::set('user',$data['username']);
            return json([
                'code' => 200,
                'msg' => '登录成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '用户名与密码不匹配'
            ]);
        }
    }
}