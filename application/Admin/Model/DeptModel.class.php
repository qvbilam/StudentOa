<?php
namespace Admin\Model;
use Think\Model;

class DeptModel extends Model{
    function dept_list(){
        //2. 调用select方法查询dept表中的所有数据
        $dept_list = $this
            ->alias('d1')
            ->field('d1.dept_id,d1.dept_name,d1.dept_pid,d2.dept_name name,d1.dept_desc')
            ->join('LEFT JOIN oa_dept d2 ON d1.dept_pid=d2.dept_id')
            ->select();
        //重构查询结果
        $dept_list = tree($dept_list);
        return $dept_list;
    }
}