<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Home\Controller;

/**
 * Description of DeptController
 *
 * @author sxzx
 */
class DeptController extends \Think\Controller {
    //put your code here
    function index(){
        
        //$dept=new DeptController();
        $dept=D("Dept");
        //视图显示数据
        $this->display(lite);
    }
    
    //添加
    function add(){
        $row=array(
          'dept_name'=>'开发三部',
            'dept_pid'=>4,
            'dept_desc'=>'项目开发',
        );
        $dept=D('Dept');
        $dept->add($row);
    }
    
    //修改
    function save(){
        $row=array(
            'dept_id'=>13,
          'dept_name'=>'海外开发三部',
            'dept_pid'=>4,
            'dept_desc'=>'项目开发',
        );
        $dept=D('Dept');
        $dept->save($row);
    }
    
    //删除
    function delete(){
        $dept=D('Dept');
        $dept->delete(13);
    }
    
    //查询一条数据
    function find(){
        $dept=D('Dept');
        $date=$dept->find();
       dump($date);
//        $arr=$dat->find(3);
//        dump($arr);
    }
    
    //全部查询
    function select(){
        $dept=D('Dept');
        $date=$dept->select();
        dump($date);
    }
    
    //1.查询所有男用户的id，name，nickname
    function sel_male(){
         $user=D('user');
         $date=$user
                 ->field('user_id,user_name,user_nickname')
                 ->where("user_sex='男'")
                 ->select();
    }
    
     //2.查询所有张姓用户的id，name，nickname
    function sel_zhang(){
         $user=D('user');
         $date=$user
                 ->field('user_id,user_name,user_nickname')
                 ->where("user_nickname like '张%'")
                 ->select();
         var_dump($date);
    }
    
    //3.查询技术部的所有用户的id，name，nickname
    function sel_js(){
         $user=D('user');
         $date=$user
                 ->alias('u')
                 ->field('user_id,user_name,user_nickname')
                 ->join('oa_dept d on u.user_deptid=d.dept_id')
                 ->where("d.dept_name='技术部'")
                 ->select();
    }
    
    //4.按年龄升序排序所用用户，显示其id，name，nickname和 出生日期
     function sel_px(){
         $user=D('user');
         $date=$user
                 ->field('user_id,user_name,user_nickname,user_birthday')
                 ->order("user_birthday desc")
                 ->select();
    }
    
    //5.查询所用部门的id，name，pid，上级部门名称和备注
        function sel_bm(){
              //1.实例化Dept模型
            $dept=D("Dept");

            //2.连贯操作
            $list=$dept
                    ->alias('d1')
                    ->field('d1.dept_id,d1.dept_name,d1.dept_pid,d1.dept_desc,d2.dept_name as pname')
                    ->join('left join oa_dept d2 on d1.dept_pid=d2.dept_id')
                    ->select();
            dump($list);
        }
}
