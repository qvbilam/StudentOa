<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    function login(){
        $this->display();
    }
    
    function checkLogin(){
        //1. 接收用户输入验证码
        $code = I('post.code');
        //2. 实例化验证码类，调用check方法来验证用户输入和系统产生验证码的匹配性
        $v = new \Think\Verify();
        //参数: 用户输入的验证码
        //返回值: true 验证成功   false 验证失败
        if(!$v->check($code)){
            $this->error('验证码错误');
        }
        
        //3. 验证用户名和密码匹配性
        $name = I('post.name');
        $passwd = I('post.passwd');
        $user_model = D('User');
        $login_result = $user_model->check($name, $passwd);
        if($login_result == 1){
            $this->error('用户名不存在');
        } else if($login_result == 2){
            $this->error('密码错误');
        } else if($login_result == 3){
            $this->success('登录成功', U('Main/index'), 3);
        }
    }
    
    function verify(){
        //自定义配置项
        $config = array(
            'useCurve'  =>  false,            // 是否画混淆曲线
            'useNoise'  =>  false,            // 是否添加杂点
            'bg'        =>  array(110, 203, 44),  // 背景颜色
            'fontttf'   =>  '4.ttf',
            'imageH'    =>  38,               // 验证码图片高度
            'imageW'    =>  86,               // 验证码图片宽度
            'fontSize'  =>  15,
            'length'    =>  5,
        );
        //1. 实例化验证码类
        $verify = new \Think\Verify($config);
        //2. 调用entry方法，绘制验证码
        $verify->entry1();
    }
    
    function logout(){
        session(null);
       // $this->success('退出成功', U('login'), 3);
        echo "<script> top.location.href='".U('login')."';</script>";
    }
}

















