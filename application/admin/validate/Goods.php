<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2019/10/11
 * Time: 13:40
 */

namespace app\admin\validate;


use think\Validate;

class Goods extends Validate
{
    protected $rule=[
        'gname'=>'require',
        'gbanner'=>'require',
        'gthumb'=>'require',
        'gmprice'=>'require',
        'gsale'=>'require',
        'gstock'=>'require',
        'gdetail'=>'require',
        'gcreate_time'=>'require',
        'cid'=>'require|number',
    ];
    protected $scene =[
        'insert'=>['gname','gbanner','gthumb','gmprice','gsale','gstock','cid','gcreate_time','gdetail'],
        'del'=>['id'],
        'update'=>['id','field','value'],
    ];
}