<?php
function setAuthor(){
    return session('id');
}


function checkDept($deptid){
    $dept = D('Dept')->find($deptid);
    if(empty($dept)){
        return false;
    }
    return true;
}

function setDate(){
    return date('Y-m-d');
}

function setDateTime(){
    return date('Y-m-d H:i:s');
}



function checkAge($age){
    if($age < 18 || $age > 120){
        return false;
    }
    return true;
}

function nodeTree($arr, $pid = 0, $level = 0){
    static $result = array();
    foreach($arr as $value){
        //输出顶级栏目，pid=0
        if($value['node_pid'] == $pid){
            $value['level'] = $level;
            $result[] = $value;
            nodeTree($arr, $value['node_id'], $level+1);
        }
    }
    return $result;
}


//重构部门属性结构数组函数
function tree($arr, $pid = 0, $level = 0){
    static $result = array();
    foreach($arr as $value){
        //输出顶级栏目，pid=0
        if($value['dept_pid'] == $pid){
            $value['level'] = $level;
            $result[] = $value;
            tree($arr, $value['dept_id'], $level+1);
        }
    }
    return $result;
}

function str2md5($str){
    return md5($str);
}