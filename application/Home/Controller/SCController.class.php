<?php
namespace Home\Controller;
use Think\Controller;
class SCController extends Controller{
    function setS(){
        session('id', 10001);
        session('name', 'zs');
    }
    
    function getS(){
        $id = session('id');
        echo $id;
        echo "<hr />";
        $info = session();
        print_r($info);
    }
    
    function issetS(){
        echo (int)session('?name');
    }
    
    function delS(){
        //session('name', null);
        session(null);
    }
    
    function setC(){
        cookie('oa_color', 'red');
        cookie('oa_size', '16px');
        cookie('width', '100px');
    }
    
    function getC(){
        $color = cookie('color');
        echo $color;
        echo "<hr />";
        $arr = cookie();
        print_r($arr);
    }
    
    function delC(){
        // 删除指定名称的cookie
        //cookie('color', null);
        
        //删除默认前缀的cookie
        //cookie(null); //删除所有cookie
        
        //删除指定前缀的cookie
        cookie( null, 'oa_');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}