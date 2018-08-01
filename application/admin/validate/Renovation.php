<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/26
 * Time: 10:49
 */

namespace app\admin\validate;


use think\Validate;

class Renovation extends Validate
{
    //验证规则定义
    protected $rule =   [
        'rname' =>'require|max:10|unique:renovation',
    ];
    //验证消息的定义
    protected $message  =   [
        'rname.require'  => '分类名称必须填写!',
        'rname.max'      => '分类名称太长!',
        'rname.unique'   => '分类已存在!',
    ];
    //验证场景的定义
    protected $scene =[
        'add'  => ['rname'],
        'edit' => ['rname'],

    ];





}