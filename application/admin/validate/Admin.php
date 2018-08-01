<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/25
 * Time: 15:28
 */

namespace app\admin\validate;
use think\Validate;

class Admin extends Validate
{
    protected $rule =   [
        'uname' =>'require|max:10|unique:admin',
        'upwd'  =>'require|min:6'
    ];

    protected $message  =   [
        'uname.require'  => '账号名称必须填写!',
        'uname.max'      => '账号名称太长!',
        'uname.unique'   => '账号已存在!',
        'upwd.require'   => '密码必须填写!',
        'upwd.min'       => '密码长度太短!',
    ];
    //验证场景的定义
    protected $scene =[
        'add'  => ['uname'=>'require|max:5|unique:admin','upwd'],
        'edit' => ['uname'],

    ];



}