<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Admin\Controller;
use \Think\Controller;
class UserController extends Controller{
	 function charts(){
        //1. 实例化User模型
        $user_model = D('User');
        $list = $user_model
            ->alias('u')
            ->field('dept_name,COUNT(*) num')
            ->join('LEFT JOIN oa_dept d ON u.user_deptid=d.dept_id')
            ->group('u.user_deptid')
            ->select();
        //dump($list);die;
        $this->assign('list', $list);
        $this->display();
    }
    function index()
    {
        //定义当前页号
        $pageno=I('get.p',1);
        //定义每页显示数
        $pagesize=3;
        //1.实例化User模型
        $user_model=D('User');
        //2.调用select方法查询所有数据
        $user_list=$user_model
                ->alias('u')
                ->field('u.*,d.dept_name')
                ->join('left join oa_dept d on u.user_deptid=d.dept_id')
                //page连贯操作进行分页查询
                ->page($pageno,$pagesize)
                ->select();
        //3.将查询结果分配到模板
        $this->assign('user_list',$user_list);
        
        //制作分页导航条
        //1.获取符合条件的总计录数
        $count=$user_model
                ->alias('u')
                ->field('u.*,d.dept_name')
                ->join('left join oa_dept d on u.user_deptid=d.dept_id')
                ->count();
         //2、实例化分页类
        $page = new \Think\Page($count,$pagesize);
         // 配置翻页的样式
//        $page -> setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
//        $page->setConfig('last', '末页');
//        $page->setConfig('first', '首页');
//        $page -> setConfig('prev','上一页');
//        $page -> setConfig('next','下一页');
//        $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        //$pageString = $page->show();
        //3.调用show方法来产生分页导航条
        $show=$page->show();
        $this->assign('show', $show);
        $this->display();
        
        //ajax分页
        //定义当前页号
//        $pageno=I('get.p',1);
//        //定义每页显示数量
//        $pagesize=2;
//        //讲每页显示数量分配到模板，提供给pagination插件使用
//        $this->assign('pagesize',$pagesize);
//        // 1.获取符合条件的总记录数
//        $count=$user_model
//               ->alias('u')
//                ->field('u.*,d.dept_name')
//                ->join('left join oa_dept d on u.user_deptid=d.dept_id')
//                ->count();
//        //将总记录数分配到模板，供pagintaion使用
//        $this->assign('count',$count);
    }

    function add(){
        if (IS_POST) {
            //如果是post表单提交，则进行if块
            
            //1.实例化User模型
            $user_model=D('User');
            
            //2.调用create方法接收表单数据
            //参数2:1 声明当前为添加操作 2 声明当前是修改操作
            $from_data=$user_model ->create('',1);
            
            if (!$from_data) {
                //如果返回值false，使用模型对象调用getError来获取错误信息
                echo $user_model->getError();
            }else{
                //如果正常接收到数据，则写入user表
                if ($user_model->add($from_data)) {
                    $this->success('添加用户成功');
                }  else {
                    $this->error('添加用户失败');
                }
            }
        }  else {
            //如果不是post表单提交，则进入else块
            $dept_model=D('Dept');
            $dept_list=$dept_model->select();
            $this->assign('dept_list',$dept_list);

            $this->display();
        }
    }
    function Zcxaddok(){
        /*$name =I('post.pety_name','默认值','htmlentities');
        echo $bane;
        $age = I('get.age',10);
        echo $age;*/
        if(!I('post.user_name')){
            $this->error('煞笔用户名不能为空！');
        }
        if(!I('post.user_password')){
            $this->error('煞笔密码不能为空！');
        }

        $arr=array(
            'user_name'=>I('post.user_name'),
            'user_password'=>I('post.user_password'),
            'user_nickname'=>I('post.user_nickname'),
            'user_deptid'=>I('post.dept_pid'),
            'dept_name'=>I('post.dept_name'),
            'user_sex'=>I('post.user_sex'),
            'user_birthday'=>I('post.user_birthday'),
            'user_tel'=>I('post.user_tel'),
            'user_email'=>I('post.user_email')
        );
        $user=D('User');
        if($user->add($arr))
        {
            $this->success('添加成功',U('/user/index'),3);
        }
        else
        {
            $this->error('添加失败！');
        }
    }
      function ZcxdelUser(){
        $user_id=I('get.id');
        $user_model=D('User');
          $del_result=$user_model->delete($user_id);
        if($del_result){
            $this->success('删除用户成功');
        }
       else {
            $this->error('删除用户失败');
         }
    }
function dels(){
    $ids=I('get.ids');
    $user_model=D('User');
    if($user_model->delete($ids)){
        $this->success('批量删除成功');
    }  else {
        $this->error('批量删除失败');    
    }
}
}
