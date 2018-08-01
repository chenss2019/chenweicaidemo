<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/26
 * Time: 10:49
 */

namespace app\admin\controller;


use think\Db;
use think\Loader;
use think\Request;
class Renovation extends Base
{
    public function list()
    {
        $list = \app\admin\model\Renovation::paginate(5);
        $this->assign("list",$list);
        return $this->fetch();
    }
    public function add()
    {
        if(Request::instance()->isPost()){//判断是否是post请求：request()->ispost()
            $data = Request::instance()->param();
            //1.验证
            $validate = Loader::Validate('Renovation');
            if (!$validate->scene('add')->batch()->check($data)){
                $errinfo = $validate->getError();
                $this->assign("errinfo",$errinfo);
                return $this->fetch();
            }else{
                //2.数据添加操作
                $result = db('renovation')->insert($data);
//            $result = Db::name('admin')->insert($data);
                if($result>0){//添加数据成功
                    $this->success("添加房源分类成功！","admin/renovation/list");
                }else{
                    $this->error("添加房源分类失败！","admin/renovation/list");
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
            $validate = Loader::validate('Renovation');
            if (!$validate->scene('edit')->batch()->check($data)) {
                $errinfo = $validate->getError();
                $this->assign("renovation", $errinfo);
                $this->assign("errinfo", $errinfo);
                return $this->fetch();
            } else {
                //更新数据
                $result = db('renovation')->where('rid', $data['rid'])->update($data);
                if ($result > 0) {//添加数据成功
                    $this->success("编辑分类成功！", "admin/renovation/list");
                } else {
                    $this->error("编辑分类成功！", "admin/renovation/list");
                    $this->assign('catalog', $data);
                    return $this->fetch();
                }
            }
        }else{
            $cid =input('cid');
            //加载管理员信息
            $result =Db::name('renovation')->where('rid',$cid)->find();
            $this->assign('admin', $result);
            return $this->fetch();
        }
    }
    public function del(){
        //删除数据
        $result = Db::name('renovation')->where('rid',input('rid'))->delete();
        if ($result > 0) {//添加数据成功
            $this->success("删除管理员成功！", "admin/catalog/list");
        } else {
            $this->error("删除管理员成功！", "admin/catalog/list");
        }
    }

}