<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2019/10/21
 * Time: 17:13
 */

namespace app\admin\controller;


use think\Db;

class Aboutus extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $cate = Db::table('category')->order('id', 'asc')->select();
        $this->assign('cates', $cate);
        return $this->fetch();
    }

    public function openinsert()
    {
        $cate = Db::table('category')->order('id', 'asc')->select();
        $this->assign('cates', $cate);
        return $this->fetch();
    }

    public function insert()
    {
        if (!$this->request->isPost()) {
            return json(['code' => 404, 'msg' => "请求方式错误"]);
        }
        $data = input('post.');
//        $validata = validate('Goods');
//        if (!$validata->scene('insert')->check($data)) {
//            return json(['code' => 404, 'msg' => $validata->getError()]);
//        }
        $res = Db::table('guide')->insert($data);
        if ($res > 0) {
            return json([
                'code' => 200,
                'msg' => "商品添加成功"
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => "商品添加失败"
            ]);
        }
    }

    /*显示数据*/
    public function query()
    {
        //返回数据总数，当前数据
//        $data=Db::table('goods')->order('id','asc')->select();
        //搜索条件：默认无，点击搜索按钮就有字段
        $qs = $this->request->get();
        $page = $qs['page'];
        $limit = $qs['limit'];
        $count = Db::table('guide')->count();
        $data = Db::table('guide')->page($page, $limit)->select();
        return json([
            'code' => 0,
            'count' => $count,
            'data' => $data,
            'msg' => '数据获取成功',
        ]);
    }

    /*删除数据*/
    public function delete()
    {
        if (!$this->request->isPost()) {
            return json(['code' => 404, 'msg' => "请求方式错误"]);
        }
        $data = input('post.');
        $id = input('post.id');
//        $validata=validate('Goods');
//        if(!$validata->scene('del')->check($data)){
//            return json(['code'=>404,'msg'=>$validata->getError()]);
//        }
        $res = Db::table('guide')->where('id', $id)->delete();
        if ($res > 0) {
            return json([
                'code' => 200,
                'msg' => "商品删除成功"
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => "商品删除失败"
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
        $res=Db::table('guide')->where('id',$id)->update([$field=>$value]);
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