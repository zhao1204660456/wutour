<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2019/10/15
 * Time: 22:40
 */

namespace app\admin\controller;


use think\Db;

class Onlinebooking extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }
    /*查看导航*/
    public function index()
    {
        return $this->fetch();
    }
    /*显示插入页面*/
    public function openinsert()
    {
        $cate=Db::table('onlinetable')->order('oid','asc')->select();
        $this->assign('cates',$cate);
        return $this->fetch();
    }
    /*插入逻辑*/
    public function insert()
    {
        $method=$this->request->method();
        if ($method!=='POST'){
            return json(['code'=>404,'msg'=>"请求方式错误"]);
        }
        $sql=input('post.');
//        $validata=validate('Nav');
//        if(!$validata->scene('insert')->check($sql)){
//            return json(['code'=>404,'msg'=>$validata->getError()]);
//        }
        $res=Db::table('onlinebooking')->insert($sql);
        if($res>0){
            return json([
                'code'=>200,
                'msg'=>"导航插入成功"
            ]);
        }else{
            return json([
                'code'=>404,
                'msg'=>"导航插入失败"
            ]);
        }
    }
    /*显示数据*/
    public function query(){
        $data=Db::table('onlinebooking')->select();
//        $count=Db::table('nav')->count();
        $count=count($data);
        return json([
            'code'=>0,
            'count'=>$count,
            'data'=>$data,
            'msg'=>'success',
        ]);
    }
    /*删除数据*/
    public function delete(){
        if (!$this->request->isPost()){
            return json(['code'=>404,'msg'=>"请求方式错误"]);
        }
        $data=input('post.');
        $id=input('post.id');
//        $validata=validate('Nav');
//        if(!$validata->scene('del')->check($data)){
//            return json(['code'=>404,'msg'=>$validata->getError()]);
//        }
        $res=Db::table('onlinebooking')->where('id',$id)->delete();
        if($res>0){
            return json([
                'code'=>200,
                'msg'=>"导航添加成功"
            ]);
        }else{
            return json([
                'code'=>404,
                'msg'=>"导航删除失败"
            ]);
        }
    }
    /*修改数据*/
    public function update(){
        if (!$this->request->isPost()){
            return json(['code'=>404,'msg'=>"请求方式错误"]);
        }
        $data=input('post.');
        $id=$data['id'];
        $field=$data['field'];
        $value=$data['value'];
//        $validata=validate('Nav');
//        if(!$validata->scene('update')->check($data)){
//            return json(['code'=>404,'msg'=>$validata->getError()]);
//        }
        $res=Db::table('onlinebookin')->where('id',$id)->update([$field=>$value]);
        if($res>0){
            return json([
                'code'=>200,
                'msg'=>"数据修改成功"
            ]);
        }else{
            return json([
                'code'=>404,
                'msg'=>"数据修改失败"
            ]);
        }
    }
}