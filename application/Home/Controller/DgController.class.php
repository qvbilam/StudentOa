<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;

class DgController extends \Think\Controller{
    
    function jc_test(){
        $r=  jc_dg(3);
        echo $r;
    }
     function fib_test(){
        $r= fib_arr(3);
        foreach ($r as $v){
            echo $v."&nbsp;";
        }
    }
     function check_test(){
        $str= zcx;
        echo check($str);
    }
    
   
}
