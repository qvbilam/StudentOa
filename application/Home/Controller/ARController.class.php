<?php
namespace Home\Controller;
use Think\Controller;
class ARController extends Controller{
    function add_test(){
        $student = D('Student');
        $student->sno = 20;
        $student->sname = 'Jacky';
        $student->spasswd = 123;
        $student->ssex = '男';
        $student->sage = 22;
        $student->sdept = 5;
        $student->saddtime = date('Y-m-d H:i:s');
        
        $student->add();
    }
    
    function save_test(){
        $student = D('Student');
        $student->sno = 20;
        $student->spasswd = 345;
        $student->sdept = 6;
        
        $student->save();
    }
    
    function del_test(){
        $student = D('Student');
        $student->sno = 20;
        $student->delete();
    }
    
    function find_test(){
        $student = D('Student');
        //通过字段名称查询数据
        //$arr = $student->getbysno(19);
        $arr = $student->getbysname('ooo');
        dump($arr);
    }
}
















