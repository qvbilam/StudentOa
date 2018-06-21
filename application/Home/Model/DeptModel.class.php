<?php
namespace Home\Model;
use Think\Model\RelationModel;

class DeptModel extends RelationModel{
    protected $_link = array(
        //定义Dept和Student的关联关系
        'student' => array(
            //dept和student的关系
            'mapping_type' => self::HAS_MANY,
            'class_name'   => 'Student',
            'foreign_key'  => 'sdept'
        ),
        
        'dept' => array(
            //dept d1 和 dept d2的关系
            //d1.dpid外键  d2.dpid主键   多对一关系
            'mapping_type' => self::BELONGS_TO,
            'mapping_name' => 'd',
            'class_name'   => 'Dept',
            'parent_key'   => 'dpid',
            'mapping_fields' => 'dname'
        ),
        
    );    
}