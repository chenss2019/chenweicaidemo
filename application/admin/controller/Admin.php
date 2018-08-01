<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/25
 * Time: 9:36
 */

namespace app\admin\controller;


use think\Db;
use think\Loader;
use think\Request;
class Admin extends Base
{
    public function list()
    {
        $list=\app\admin\model\Admin::paginate(5);
        $this->assign("list",$list);
        return $this->fetch();
    }
    public function add()
    {
        if(Request::instance()->isPost()){//判断是否是post请求：request()->ispost()
            $data = Request::instance()->param();
            //1.验证
            $validate = Loader::Validate('Admin');
            if (!$validate->scene('add')->batch()->check($data)){
                $errinfo = $validate->getError();
                $this->assign("errinfo",$errinfo);
                return $this->fetch();
            }else{
                //2.数据添加操作
                $data ['upwd'] = md5($data['upwd']);//密码加密
                $result = db('admin')->insert($data);
//            $result = Db::name('admin')->insert($data);
                if($result>0){//添加数据成功
                    $this->success("添加管理员成功！","admin/admin/list");
                }else{
                    $this->error("添加管理员失败！","admin/admin/list");
                }
            }
        }else{
            return $this->fetch();
        }
    }
    public function edit()
    {
        if (\request()->isPost()) {
            $data = input('post.');
            //数据验证
            $validate = Loader::validate('Admin');
            if (!$validate->scene('edit')->batch()->check($data)) {
                $errinfo = $validate->getError();
                $this->assign("errinfo", $errinfo);
                return $this->fetch();
            } else {
                //更新数据
                $data['upwd'] = md5($data['upwd']);//密码加密
                $result = db('admin')->where('uid', $data['uid'])->update($data);
                if ($result > 0) {//添加数据成功
                    $this->success("编辑管理员成功！", "admin/admin/list");
                } else {
                    $this->error("编辑管理员成功！", "admin/admin/list");
                    $this->assign('admin', $data);
                    return $this->fetch();
                }
            }
        }else{
            $uid =input('uid');
            //加载管理员信息
            $result =Db::name('admin')->where('uid',$uid)->find();
            $this->assign('admin', $result);
            return $this->fetch();
        }
    }
    public function del(){
        $uid = input('uid');
        if ($uid ==1){
            $this->error("超级管理员不允许被删除！",'admin/admin/list');
        }
        $result = Db::name('admin')->where('uid',$uid)->delete();
        if ($result > 0) {//添加数据成功
            $this->success("删除管理员成功！", "admin/admin/list");
        } else {
            $this->error("删除管理员成功！", "admin/admin/list");
        }
    }

}