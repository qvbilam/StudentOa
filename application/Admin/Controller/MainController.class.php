<?php
namespace Admin\Controller;
use Think\Controller;

class MainController extends Controller{
    function index(){
        //1. 从session中获取roleid
        $roleid = session('roleid');
        //2. 实例化Role模型，根据roleid读取role表中role_ids的值
        $role_info = D('Role')->field('role_ids')->find($roleid);
        $ids = $role_info['role_ids'];
        //dump($ids);die;
        
        //3. 实例化Node模型，根据role_ids从Node表中查询数据
        //将一级权限和二级权限分开读取，有利于在模板中的输出
        $node_model = D('Node');
        $nodeA = $node_model->where("node_id in ($ids) and node_pid=0 and node_show=1")->select();
        $nodeB = $node_model->where("node_id in ($ids) and node_pid!=0 and node_show=1")->select();
    // dump($nodeB);die;
        $this->assign('nodeA', $nodeA);
        $this->assign('nodeB', $nodeB);
        
        $this->display();
    }
    
    function home(){
        $this->display();
    }
}