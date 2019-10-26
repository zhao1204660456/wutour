<?php

namespace app\admin\validate;

use think\Validate;//验证

class Nav extends Validate
{
    protected $rule=[
        'nname'=>'require',
        'ename'=>'require',
        'nsort'=>'require|number',
        'ntpl'=>'require',
        'id'=>'require|number',
        'field'=>'require',
        'value'=>'require',
    ];
//    protected $message=[
//
//    ];
    protected $scene =[
      'insert'=>['nname','ename','nsort','ntpl'],
      'del'=>['id'],
        'update'=>['id','field','value'],
    ];
}