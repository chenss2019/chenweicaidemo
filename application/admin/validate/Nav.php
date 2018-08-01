<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/26
 * Time: 10:49
 */

namespace app\admin\validate;


use think\Validate;

class Nav extends Validate
{
    //验证规则定义
    protected $rule =   [
        'nname' =>'require|max:10|unique:nav',
    ];
    //验证消息的定义
    protected $message  =   [
        'nname.require'  => '分类名称必须填写!',
        'nname.max'      => '分类名称太长!',
        'nname.unique'   => '分类已存在!',
    ];
    //验证场景的定义
    protected $scene =[
        'add'  => ['nname'],
        'edit' => ['nname'],

    ];





}