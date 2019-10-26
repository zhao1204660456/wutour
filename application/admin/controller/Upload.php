<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2019/10/11
 * Time: 15:30
 */

namespace app\admin\controller;


use think\Controller;

class Upload extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }
    public function index(){
        $file = request()->file('file');
        if ($file) {
            $info = $file->validate(['size' => 200 * 1024, 'ext' => 'png,jpg,jpeg,webp'])
                ->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                $src = UPLOAD_PATH . $info->getSaveName();
                return json([
                    'code' => 0,
                    'msg' => '上传成功',
                    'data' => [
                        'src' => $src
                    ]
                ]);
            } else {// 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }
}