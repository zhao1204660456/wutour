<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2019/10/24
 * Time: 20:49
 */

namespace app\index\controller;


use think\Db;

class Goods extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $gid=$this->request->get()['gid'];
        $id=$this->request->get()['id'];
        $data=Db::table('goods')->where('id',$gid)->find();
        $banner=explode(',',$data['gbanner']);
        $count=array_splice($banner,1);
        $this->assign('datas',$data);
        $this->assign('banner',$banner);
        $this->assign('tittle',"产品详情");
        $this->assign('id',$id);
        $this->assign('count',$count);
        return $this->fetch('xiangqing');
    }
}