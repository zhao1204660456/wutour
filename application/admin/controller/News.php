<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2019/10/15
 * Time: 22:40
 */

namespace app\admin\controller;


use think\Db;

class News extends Base
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
        return view();
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
        $res=Db::table('news')->insert($sql);
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
        $res=Db::table('news')->where('id',$id)->delete();
        if($res>0){
            return json([
                'code'=>200,
                'msg'=>"新闻删除成功"
            ]);
        }else{
            return json([
                'code'=>404,
                'msg'=>"新闻删除失败"
            ]);
        }
    }
    /*显示数据*/
    public function query(){
        $data=Db::table('news')->select();
        $count=count($data);
        return json([
            'code'=>0,
            'count'=>$count,
            'data'=>$data,
            'msg'=>'success',
        ]);
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
        $res=Db::table('news')->where('id',$id)->update([$field=>$value]);
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