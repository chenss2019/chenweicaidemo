<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/27
 * Time: 14:52
 */

namespace app\admin\controller;


use think\Controller;

class Base extends Controller
{
    protected function _initialize()
    {
        if (!session('uname')){
            $this->error("进入后台请先登陆","admin/login/login");
        }
    }

}