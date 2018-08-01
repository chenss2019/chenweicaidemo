<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/27
 * Time: 11:23
 */

namespace app\admin\controller;


use think\captcha\Captcha;
use think\Controller;
use think\Db;
class Login extends Controller
{
    public function login()
    {
        if (request()->isPost()){
            $data = input('post.');
            //判断验证码是否正确
            $captcha= new Captcha();
            if (!$captcha->check($data['vercode'])){
                $this->error("验证码错误，请重新登陆！", "admin/login/login");
            }
            $admin=Db::name('admin')->where("uname = '".$data['uname']."'")->find();
            if ($admin){
                if ($admin['upwd']==md5($data['upwd'])){
                    //会话保持
                    session('uid',$admin['uid']);
                    session('uname',$admin['uname']);
                    $this->success("登陆成功！即将进入系统后台！", "admin/index/index");
                } else {
                    $this->error("密码错误，请重新登陆！", "admin/login/login");
                }
            }else{
                $this->error("用户名不存在，请重新登陆！", "admin/login/login");
            }
        }else{
            return $this->fetch();
        }
    }
    /**退出登陆**/
    public function logout(){
        //销毁session
        session(null);
        $this->success('注销登陆成功！','admin/login/login');
    }
    public function verifycode(){
        $config =    [
            // 验证码字体大小
            'fontSize'    =>    30,
            // 验证码位数
            'length'      =>    4,
            // 关闭验证码杂点
            'useNoise'    =>    false,
            // 关闭画混淆曲线
            'useCurve'    =>    false,
//            'imageH'      =>    150,
        ];
        $captcha = new Captcha($config);
        return $captcha->entry();

    }

}