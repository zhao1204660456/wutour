<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Index extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $this->assign('tittle',"聊之旅首页");
        $this->assign('id','0');
        $newsdata=Db::table('news')->select();
        $companydata=Db::table('company')->select();
        $sercicedata=Db::table('service')->select();
        $this->assign('newsdatas',$newsdata);
        $this->assign('sericedatas',$sercicedata);
        $this->assign('companydatas',$companydata);
        return $this->fetch();
    }
}

