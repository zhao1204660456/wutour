<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2019/10/10
 * Time: 21:21
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class Goods extends Base
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
        $d = date("Y-m-d");
        $data['gcreate_time'] = $d;
        $validata = validate('Goods');
        if (!$validata->scene('insert')->check($data)) {
            return json(['code' => 404, 'msg' => $validata->getError()]);
        }
        $res = Db::table('goods')->insert($data);
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
        $where = [];
        if (isset($qs['dat']) && !empty($qs['dat'])) {
            $da = $qs['dat'];
            if ($da['cid']) {
                $where['cid'] = $da['cid'];
            }
            if ($da['price_min'] >= 0 && $da['price_max'] && $da['price_min'] < $da['price_max']) {
                $where['gmprice'] = ['between', [$da['price_min'], $da['price_max']]];
            }
            if ($da['gname']) {
                $where['gname'] = ['like', "%{$da['gname']}%"];
            }
        }
        $page = $qs['page'];
        $limit = $qs['limit'];
        $count = Db::table('goodscategory')->where($where)->count();
        $data = Db::table('goodscategory')->where($where)->page($page, $limit)->select();
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
        $res = Db::table('goods')->where('id', $id)->delete();
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
    public function vupdate()
    {
        if (!$this->request->isPost()) {
            return json(['code' => 404, 'msg' => "请求方式错误"]);
        }
        $data = input('post.');
        $id = $data['id'];
//        $validata=validate('Goods');
//        if(!$validata->scene('update')->check($data)){
//            return json(['code'=>404,'msg'=>$validata->getError()]);
//        }
        if ($id) {
            return json([
                'code' => 200,
            ]);
        } else {
            return json([
                'code' => 404
            ]);
        }

    }

    public function update()
    {
        $data = input('get.');
        $id = $data['id'];
        $nav = Db::table('category')->select();
        $res = Db::table('goods')->where('id', $id)->find();
        $src = explode(',', $res['gbanner']);
        $this->assign('datas', $res);
        $this->assign('cates', $nav);
        $this->assign('src', $src);
        return $this->fetch();
    }

    public function updates()
    {
        $data = input('post.');
        $id = $data['id'];
        unset($data['id']);
        $res = Db::table('goods')->where('id', $id)->update($data);
        return json([
            'code' => 200,
            'msg' => '修改成功'
        ]);
    }
}