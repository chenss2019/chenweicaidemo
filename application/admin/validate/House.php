<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/26
 * Time: 13:47
 */

namespace app\admin\validate;


use think\Validate;

class House extends Validate
{
    protected $rule =   [
        'htitle'    =>'require|max:30',
        'hprice'    =>'require|min:5',
        'hchaox'    =>'require|min:1',
        'hmianji'   =>'require|max:10',
        'hxiaoqu'   =>'require|max:10',
        'hfloor'    =>'require|max:10',
        'hyear'     =>'require|max:5',
        'hcontent'  =>'require|max:100',
    ];

    protected $message      =   [
        'htitle.require'    => '标题必须填写!',
        'htitle.max'        => '标题名称太长!',
        'hprice.require'    => '售假必须填写!',
        'hprice.min'        => '售价金额最少5位数!',
        'hchaox.require'    => '朝向必须填写!',
        'hchaox.min'        => '朝向位置最少5个字!',
        'hmianji.require'   => '面积必须填写!',
        'hmianji.min'       => '面积大小最少10个字!',
        'hxiaoqu.require'   => '小区必须填写!',
        'hxiaoqu.min'       => '小区名称最少10个字!',
        'hfloor.require'    => '楼层必须填写!',
        'hfloor.min'        => '楼层数最少5个字!',
        'hyear.require'     => '年限必须填写!',
        'hyear.min'         => '年限数最少5个字!',
        'hcontent.require'  => '房情内容必须填写!',
        'hcontent.max'      => '房情内容太长!',
    ];
    //验证场景的定义
    protected $scene =[
        'add'  => ['htitle','hprice','hchaox','hmianji','hxiaoqu','hfloor','hyear','hcontent'],
        'edit' => ['htitle','hprice','hchaox','hmianji','hxiaoqu','hfloor','hyear','hcontent']

    ];

}