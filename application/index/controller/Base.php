<?php

namespace app\index\controller;


use think\Controller;
use think\Db;
use think\Session;

class Base extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        $nav=Db::table('nav')->order('nsort','asc')->select();
        $this->assign('nav',$nav);
    }
}