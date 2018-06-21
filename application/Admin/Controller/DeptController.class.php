<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Controller;
use Think\Controller;
class DeptController extends Controller{
    function index(){
        //1.实例化Dept模型
        $dept_model=D("Dept");
        //2.调用select方法查询dept表中的所有数据
        $dept_list=$dept_model
                ->alias('d1')
                ->field('d1.dept_id,d1.dept_name,d1.dept_pid,d2.dept_name name,d1.dept_desc')
                ->join('LEFT JOIN oa_dept d2 ON d1.dept_pid=d2.dept_id')
                ->select();
        //dump($dept_list);die;
        $dept_list= tree($dept_list);
        //3.将数据分配到视图中
        $this->assign('dept_list',$dept_list);
        $this->display();
    }

        function add(){
            //实例化
            $dept_model = D('Dept');
            //调用select方法
            $dept_list = $dept_model->select();
            //将结果分配到模板
            $this->assign('dept_list',$dept_list);

            $this->display();
        }

        function addok(){
        //    $name =I('post.dept_name','默认值','htmlentities');
        //    echo $name;
        //    $age =I('get.age',10);
        //    echo $age;
            $arr =array(
                'dept_name'=>I('post.dept_name'),
                'dept_pid'=>I('post.dept_pid'),
                'dept_desc'=>I('post.dept_desc')
            );
            //实例化dept模型
            $dept_model  =D('Dept');
            $add_result= $dept_model->add($arr);

            //判断add result的值
            if($add_result){
                $this->success('添加部门成功',U('/dept/index'),3);
            }  else {
                $this->error('添加部门失败',U('/dept/add'),3);
            }
        }

        function delDept(){
            //1.接收dept_id
            $dept_id=I('get.id');
            //2.实例化Dept模型，调用delete方法来进行删除
            $dept_model=D('Dept');
            //3.查询当前的部门中是否存在子部门

            $dept_info=$dept_model->where('dept_pid='.$dept_id)->find();
            //判断查询结果是否为空
            if(!empty($dept_info)){
                //如果不为空，则说明存在子部门，不能删除
                $this->error('当前部门中存在子部门，请先删除子部门再来删除当前部门');
            }
              $del_result=$dept_model->delete($dept_id);
            if($del_result){
                //如果不给参数2，默认回跳转到上次执行的方法中
                //如果不给参数3，默认1秒后跳回
                $this->success('删除部门成功');
            }
            else {
                 //如果不给参数2，默认回跳转到上次执行的方法中
                 //如果不给参数3，默认3秒后跳回
                $this->error('删除部门失败');
            }
    }
    function dels(){
        //1.接收要删除的dept_id组成的祖传
         $ids=I('get.ids');

        //2.实例化dept模型
       $dept=D('Dept');
        //检查要删除的部门中有没有子部门，如果有则不能删除
        //3.批量删除
        //delete from oa_dept where dept_id in(1,2,3);
        if($dept->delete($ids)){
        $this->success('批量删除成功');}
        else{
            $this->error('批量删除失败');
       }
    }
     function editDept() {
        $dept_id = I('get.id');
        //dump($dept_id);
        $dept_model = D('Dept');
        $dept_info = $dept_model->find($dept_id);
        //dump($dept_info);
        $this->assign('dept_info', $dept_info);

        //1.获取所有部门信息
        $dept_list = $dept_model->select();
        $dept_list = tree($dept_list);
        
        $this->assign('dept_list', $dept_list);
        $this->display();
    }

    function editDeptOk() {
        $arr = array(
            'dept_id' => I('post.dept_id'),
            'dept_name' => I('post.dept_name'),
            'dept_pid' => I('post.dept_pid'),
            'dept_desc' => I('post.dept_desc'),
        );
        $dept_model = D('Dept');
        if ($dept_model->save($arr)) {
            $this->success("修改部门成功", U('/dept/index'), 3);
        } else {
            $this->error('修改部门信息失败', U('/dept/editDept', 'id=' . $arr['dept_id']), 3);
        }
    }  

}