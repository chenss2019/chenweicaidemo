<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function _initialize()
    {
        $res=\db('renovation')->select();
        $this->assign('header', $res);
    }
    public function index()
    {
        $list = \db('house')->alias('h')->join('renovation r','h.hid=r.rid')->field
        ('h.hid,h.htitle,h.hprice,h.hmianji,h.hphoto,h.hchaox,h.hxiaoqu,h.hfloor,h.hyear,h.hcontent,h.hstate,r.rname')->paginate(5);
        $this->assign("list",$list);
        return  $this->fetch();
    }
    public function login()
    {
        return $this->fetch();
    }
    public function reg()
    {
        return $this->fetch();
    }
    public function proinfo()
    {
        return $this->fetch();
    }
}
