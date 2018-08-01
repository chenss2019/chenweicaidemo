<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/26
 * Time: 13:47
 */

namespace app\admin\controller;

use think\Db;
use think\Loader;
use think\Request;
class House extends Base
{
    public function list()
    {
        //$list=\app\admin\model\Article::paginate(5);
        $list = \db('house')->alias('h')->join('renovation r','h.hid=r.rid')->field('h.hid,h.htitle,h.hprice,
        h.hmianji,h.hphoto,h.hchaox,h.hxiaoqu,h.hfloor,h.hyear,h.hcontent,h.hstate,r.rname')->paginate(5);
        $this->assign("list",$list);
        return $this->fetch();
    }
    public function add()
    {
        if(Request::instance()->isPost()){//判断是否是post请求：request()->ispost()
           $data = Request::instance()->param();
//           dump($data);
      //    die;
            //1.验证
            $validate = Loader::Validate('House');
            if (!$validate->scene('add')->batch()->check($data)){
                $errinfo = $validate->getError();
                $this->assign("errinfo",$errinfo);
            }else{
                //处理图片
                if ($_FILES['hphoto']['tmp_name']){//判断文件是否上传
                    $file = request()->file('hphoto');
                    //移动到框架应用根目录/public/uploads/目录下
                    if ($file){
                        $info = $file->move(ROOT_PATH .'public' .DS .'uploads');
                        if ($info){
                            $filepath = $info ->getSaveName();
                            $data['hphoto'] =  str_replace("\\","/",$filepath);
                        }else{
                            $this->error($file->getError(),url('admin/house/list'));
                        }
                    }

                }
                //添加发布时间
                $data['hptime']=time();
                //数据持久化
                $result = db('house')->insert($data); //数据添加操作
//            $result = Db::name('admin')->insert($data);
                if($result>0){//添加数据成功
                    $this->success("添加房源成功！","admin/house/list");
                }else{
                    $this->error("添加房源失败！","admin/house/list");
                }
            }
        }
            $result = Db::name('renovation')->select();
            $this->assign("renovation",$result);
            return $this->fetch();
        }

    public function edit()
    {
        if (\request()->isPost()) {
            $data = input('post.');
            //数据验证
            $validate = Loader::validate('House');
            if (!$validate->scene('edit')->batch()->check($data)) {
                $errinfo = $validate->getError();
                $this->assign("house", $data);
                $this->assign("errinfo", $errinfo);
                return $this->fetch();
            } else {
                //图片处理
                if ($_FILES['hphoto']['tmp_name']) {//判断文件是否上传新的图片
                    //删除旧图片，上传新图片
                    $res = db('house')->where('aid', $data['aid'])->find();
                    $fp = 'uploads/' . $res['hphoto'];
                    @unlink($fp);//删除图片
                    //获取表单上传文件
                    $file = request()->file('hphoto');
                    //移动到框架应用根目录/public/uploads/目录下
                    if ($file) {
                        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                        if ($info) {
                            $filepath = $info->getSaveName();

                            //数据的持久化
                            $result = db('house')->where('hid', $data['hid'])->update($data);
                            if ($result > 0) {//添加数据成功
                                $this->success("编辑房源成功！", "admin/house/list");
                            } else {
                                $this->error("编辑房源失败！", "admin/house/list");
                                return $this->fetch();
                            }
                        }
                    }

                } else {
                    //添加管理员信息
                    $aid = input('aid');
                    $article = Db::name('house')->where('hid', $aid)->find();
                    $this->assign("article", $article);
                    //加载分类信息
                    $rel = Db::name('renovation')->select();
                    $this->assign('renovation', $rel);
                    return $this->fetch();
                }
            }
        }
    }

                public
                function del()
                {
                    $result = Db::name('house')->where('hid', input('hid'))->delete();
                    if ($result > 0) {//添加数据成功
                        $this->success("删除房源成功！", "admin/house/list");
                    } else {
                        $this->error("删除房源失败！", "admin/house/list");
                    }
                }
            }
