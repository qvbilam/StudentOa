<?php
namespace Home\Model;
use Think\Model\RelationModel;

class StudentModel extends RelationModel{
    //定义$_link
    protected $_link = array(
        //下标就是要联合查询的表名（无前缀）
        'sc' => array(
            //定义表与表之间的关系
            // student和sc的关系: 一对多
            'mapping_type' => self::HAS_MANY,
            'mapping_name' => 'aaa',
            //定义联合查询表对应的模型名称
            'class_name'   => 'Sc',
            'foreign_key'  => 'sno',
            'mapping_fields' => 'sno,grade'
        ),

    );
}