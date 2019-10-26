<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2019/10/10
 * Time: 21:03
 */

namespace app\admin\controller;

use think\Db;
use think\Controller;

class Category extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }
    //打卡查看页面
    public function index(){
        return $this->fetch();
    }
    /*显示数据*/
    public function query(){
        $data=Db::table('category')->select();
        return json([
            'code'=>0,
            'count'=>100,
            'data'=>$data,
            'msg'=>'success',
        ]);
    }
    //打开插入数据页面
    public function openinsert(){
        return $this->fetch();
    }
    //插入数据
    public function insert(){
        $method=$this->request->method();
        if ($method!=='POST'){
            return json(['code'=>404,'msg'=>"请求方式错误"]);
        }
        $sql=input('post.');
//        $validata=validate('Nav');
//        if(!$validata->scene('insert')->check($sql)){
//            return json(['code'=>404,'msg'=>$validata->getError()]);
//        }
        $res=Db::table('category')->insert($sql);
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
    //修改数据
    public function update(){
        $data=input('post.');
        $id=$data['id'];
        $key=$data['key'];
        $value=$data['value'];
        $res=Db::table('category')->where('id',$id)->update([$key=>$value]);
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
    //删除数据
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
        $res=Db::table('category')->where('id',$id)->delete();
        if($res>0){
            return json([
                'code'=>200,
                'msg'=>"导航删除成功"
            ]);
        }else{
            return json([
                'code'=>404,
                'msg'=>"导航删除失败"
            ]);
        }
    }
}