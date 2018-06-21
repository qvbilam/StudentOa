<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Admin\Controller;
use Think\Controller;
class ZcxRoleController extends Controller{
    function Zcxindex(){
        $role_list = D('Role')->select();
        $this->assign('role_list', $role_list);
        $this->display();
    }
    function Zcxdistribute(){
        if(IS_POST){
            //接收权限列表页提交的node_id
            $node_id = I('post.node_id');
            //将数组组成 role_ids需要的字符串
            $ids = implode(',', $node_id);
            //根据ids组装role_path中的数据
            //实例化node模型，根据ids查询具体的权限的node_path值
            //select * from oa_node where node_id in (1,2,3,4);
            $path = D('Node')->field('node_path')->where("node_id in ($ids)")->select();
            //遍历$path,将里面值组装成 role_path
            $role_path = 'Admin-Main-index,Admin-Main-home,';
            foreach($path as $value){
                if($value['node_path'] != 'kong'){
                    $role_path .= $value['node_path'] . ',';
                } 
            }
            $role_path = rtrim($role_path, ',');
            //实例化Role模型，将准备好的ids和path写入到role对应的字段中
            $arr = array(
                'role_id'  => I('post.role_id'),
                'role_ids' => $ids,
                'role_path'=> $role_path
            );
            if(D('Role')->save($arr)){
                $this->success('分配权限成功', U('index'), 3);
            } else {
                $this->error('分配权限失败', U('index'), 3);
            }
            
        } else {
            //实例化Node模型，调用select方法
            $node_list = D('Node')->select();
            $node_list = nodeTree($node_list);
            $this->assign('node_list', $node_list);
            
            $this->display();
        }
    }
    function Zcxadd()
    {
        $this->display();
    }
}
