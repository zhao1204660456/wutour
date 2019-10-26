<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2019/10/14
 * Time: 16:29
 */

namespace app\index\controller;


use think\Db;

class Category extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }
    public function index(){
        $id=$this->request->get('id');
        $currentnav=Db::table('nav')->where('id',$id)->find();
        $tpl=$currentnav['ntpl'];
        $this->assign('tittle',$currentnav['nname']);
        $this->assign('ename',$currentnav['ename']);
        $this->assign('id',$id);
        switch ($tpl){
            case 'aboutus';
                $guidedata=Db::table('guide')->select();
                $companydata=Db::table('company')->select();
                $this->assign('guidesdata',$guidedata);
                $this->assign('companydata',$companydata);
                break;
            case 'list';
                $goodsdata=Db::table('goods')->select();
                $catedata=Db::table('category')->select();
                $catedata=array_merge([["id"=>'0',"cname"=>"精选",'cid'=>'-1']],$catedata);
                $datas=[];
                for($i=0;$i<count($catedata);$i++){
                    if($i==0){
                        $datas[$i]=$goodsdata;
                        continue;
                    }
                    $id=$catedata[$i]['id'];
                    $va=array_filter($goodsdata,function($v) use($id){
                        return $v['cid']==$id;
                    });
                    $datas[$i]=$va;
                }
                $this->assign('catedata',$catedata);
                $this->assign('datas',$datas);
                break;
            case 'news';
                $newsdata=Db::table('news')->select();
                $this->assign('datas',$newsdata);
                break;
            case 'onlinebooking';
                $newsdata=Db::table('onlinetable')->select();
                $this->assign('datas',$newsdata);
                break;
            case 'service';
                $sercicedata=Db::table('service')->select();
                $this->assign('datas',$sercicedata);
                break;
            default:
                break;
        }
        return $this->fetch($tpl);
    }
}