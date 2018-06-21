<?php
namespace Home\Controller;
use Think\Controller;
class UploadController extends Controller{
    function index(){
        if(IS_POST){
            //1. 自定义配置项
            $config = array(
                //设置最大上传3M大小
                'maxSize' => 3145728,
                //设置允许上传的文件后缀
                'exts' => array('txt', 'doc', 'jpg', 'png'),
                //设置上传文件保存的根路径
                'rootPath' => './Uploads/'
            );
            //2. 实例化文件上传类
            $uploader = new \Think\Upload($config);
            //3. 调用upload方法进行文件上传
            $result = $uploader->upload();
            //4. 判断上传结果是否为false
            if(!$result){
                //如果上传结果为false,使用getError方法获取错误信息
                echo $uploader->getError();
            } else {
                //如果不为false，返回文件上传信息（数组）
                dump($result);
            }
        } else {
            $this->display();
        }
        
    }
    
    function edit(){
        $this->display();
    }
}

















