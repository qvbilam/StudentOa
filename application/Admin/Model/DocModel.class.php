<?php
namespace Admin\Model;
use Think\Model;
class DocModel extends Model{
    //1. 定义主键
    protected $pk = 'doc_id';
    //2. 定义字段
    protected $fields = array(
        'doc_id', 'doc_title', 'doc_content',
        'doc_file', 'doc_author', 'doc_ctime'
    );
    //3. 定义字段映射
    protected $_map = array(
        'id'   => 'doc_id',
        'title' => 'doc_title',
        'content' => 'doc_content',
    );
    //4. 自动验证
    protected $_validate = array(
        array('doc_title', 'require', '标题不能为空', 1, 'regex', 3),
        array('doc_title', '', '该标题已经被使用', 1, 'unique', 3),
        array('doc_content', 'require', '内容不能为空', 1, 'regex', 3)
    );
    //5. 自动完成
    protected $_auto = array(
        //作者id从session中获取
        array('doc_author', 'setAuthor', 3, 'function'),
        array('doc_ctime', 'setDateTime', 3, 'function'),
    );
}