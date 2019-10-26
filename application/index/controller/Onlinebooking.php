<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2019/10/18
 * Time: 22:12
 */

namespace app\index\controller;


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
        if (!captcha_check($sql['code'])) {
            return json([
                'code' => 404,
                'msg' => '验证码错误'
            ]);
        }
        unset($sql['code']);
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
}