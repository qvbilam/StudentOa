<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Admin\Controller;
use Think\Controller;
class zcxEmailController extends Controller{
    function Zcxindex(){

        $this->display();
    }
    function ZcxgetUser(){
         //1. 接收用户名
        $name = I('get.name');
        //2. 实例化User模型
        $user_model = D('User');
        //3. 执行模糊查询
        // select * from oa_user where user_nickname like '%$name%'
        $user_list = $user_model->where("user_nickname like '%$name%'")->select();
        //4.转为json对象，返回给前台
        echo json_encode($user_list);
    }
    function Zcxsend(){
        $this->display();
    }
}
