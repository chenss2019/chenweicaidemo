<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/25
 * Time: 9:25
 */

namespace app\admin\controller;


use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

}