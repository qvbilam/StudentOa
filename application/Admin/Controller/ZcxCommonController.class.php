<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Controller;
use Think\Controller;
class ZcxCommonController extends Controller{
    function _initialize(){
        if(!session('?id')){
            $this->error('您尚未登录，请登录后再访问', U('Index/login'), 3);
        }
        //判断是否有具体的访问权限
        //1. 获取当前访问的 模块-控制器-方法  字符串
        $now_ac = MODULE_NAME.'-'.CONTROLLER_NAME.'-'.ACTION_NAME;
        //2. 实例化Role模型，根据session中的roleid取出role_path
        $roleid = session('roleid');
        $role_info = D('Role')->field('role_path')->find($roleid);
        $path = $role_info['role_path'];
        //将$path拆分为数组
        $path = explode(',', $path);
        //判断当前访问 模块-控制器-方法 字符串是否在 $path数组当中
        if(!in_array($now_ac, $path)){
            //如果不在就说明是跳墙访问
            //$this->error('您无权访问当前页面，请更换用户再访问', U('Index/logout'), 3);
            $this->display();
        }
    }
}