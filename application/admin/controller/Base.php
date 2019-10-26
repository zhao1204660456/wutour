<?php

namespace app\admin\controller;


use think\Controller;
use think\Session;

class Base extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        if (!Session::has('user')){
            $this->error('请登录',url('admin/login/index'));
            exit();
        }
    }
}