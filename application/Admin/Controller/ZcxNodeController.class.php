<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Admin\Controller;
use Think\Controller;
class ZcxNodeController extends Controller{
    function Zzcxindex(){
        $node_list = D('Node')->select();
        $node_list = nodeTree($node_list);
        $this->assign('node_list', $node_list);
        
        $this->display();
    }
    function Zcxadd(){
        if(IS_POST){
            //1. 实例化Node模型，调用create方法来接收表单数据
            $node_model = D('Node');
            $form_data = $node_model->create();
            if($form_data['node_title'] == ""){
                $form_data['node_title'] = "kong";
            }
            //2. 调用add方法将数据写入node表
            if($node_model->add($form_data)){
                $this->success('添加权限成功');
            } else {
                $this->error('添加权限失败');
            }
        } else {
            //实例化Node模型，读取一级菜单
            $node_list = D('Node')->where("node_pid=0")->select();
            $this->assign('node_list', $node_list);
            
            //$this->display();
        } 
    }
}
