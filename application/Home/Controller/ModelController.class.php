<?php
namespace Home\Controller;
use Think\Controller;
class ModelController extends Controller{
    function index(){
        //$obj = M('Student');
        $obj = D('Student');
        
        //dump方法是ThinkPHP提供的一个方法，能够输出任何类型的数据
        dump($obj);
    }
    
    function add_test(){
        //1. 实例化Student模型
        $obj = D('Student');
        //2. 构造要写入数据表的数据（数组）
        $arr = array(
            //下标是数据表字段名
            //单元值就是要写入表的数据
            //'sno' => 2,  //有主键、自增长属性，可以不写
            'sname' => 'ww',
            'ssex' => '女',
            'sage' => 21,
            'sdept' => 'MA'
        );
        //3. 调用add方法向数据表中写入数据
        $obj->add($arr);
    }
    
    function save_test(){
        //1. 实例化Student模型
        $obj = D('Student');
        //update 表名  set 字段名=值,字段名=值,。。。 where 修改条件
        //2. 构造要修改的数据 （数组，该数组必须要有主键）
        $arr = array(
            'sno' => 1,  //主键永远都是作为修改条件的
            'sname' => 'aaa',
            'sage' => 30,
            'sdept' => 'EN'
        );
        //2. 调用save方法进行修改
        $obj->save($arr);
        //update tp_student sname='aaa',sage=30,sdept='EN' where sno=1
    }
    
    function del_test(){
        //1. 实例化Student模型
        $obj = D('Student');
        //2. 调用delete方法删除
        //参数: 必须是主键的值
        $obj->delete(1);
        //delete from tp_student where sno=1;
    }
    
    function find_test(){
        //1. 实例化Studnet模型
        $obj = D('Student');
        //2. 调用find方法查询一条数据
        //不给参数，默认会查询数据表的第一条数据
        $arr1 = $obj->find();
        dump($arr1);
        //给参数，那么就必须是主键的值
        $arr2 = $obj->find(3);
        // 就是 sno=3
        // select * from tp_student where sno=3
        dump($arr2);
    }
    
    function select_test(){
        //1. 实例化Studnet模型
        $obj = D('Student');
        //2. 调用select方法查询
        $arr = $obj->select();
        //select * from tp_student
        dump($arr);
    }
    
    function where_test(){
        //1. 实例化student模型
        $student_model = D('Student');
        //2. 连贯操作
        $list = $student_model->where("sage>=20 and ssex='女'")->select();
        dump($list);
    }
    
    function order_test(){
        //1. 实例化student模型
        $student_model = D('Student');
        //2. 连贯操作
        $list = $student_model
            ->where('sage>=20')
            ->order('sage desc')
            ->select();
        dump($list);
    }
    
    function limit_test(){
        //1. 实例化student模型
        $student_model = D('Student');
        //2. 连贯操作
        $list = $student_model
            ->where('sage>=20')
            ->order('sage asc')
            ->limit(0,2)  //limit(2)
            ->select();
        dump($list);
    }
    
    function group_test(){
        //1. 实例化student模型
        $student_model = D('Student');
        //2. 连贯操作
        $list = $student_model
            ->field('ssex,count(*) count')
            ->group('ssex')
            ->select();
        dump($list);
    }
    
    function group_test1(){
        //1. 实例化sc模型
        // 在Model目录下没有 SC模型，也一样能够使用D或者M方法来进行实例化
        // 实例化的结果就是底层model对应的基类模型
        $sc = D('Sc');
        $list = $sc->field('cno,count(*)')->group('cno')->select();
        dump($list);
    }
    
    function group_test2(){
        //1. 实例化sc模型
        $sc = D('Sc');
        //2. 连贯操作
        $list = $sc
            ->field('sno, count(*)')
            ->group('sno')
            ->having('count(*)>=3')
            ->select();
        dump($list);
    }
    
    function group_test3(){
        //1. 实例化sc模型
        $sc = D('Sc');
        //2. 连贯操作
        $list = $sc
            ->field('sno,count(*)')
            ->where('grade>=80')
            ->having('count(*) >=2')
            ->group('sno')
            ->select();
        dump($list);
    }
    
    function table_test(){
        //1. 实例化一个空模型
        //实例化模型时（不管是D还是M）,不要传递参数，则为空模型
        //就是底层Model基类实例化出来的模型
        $model = D();
        //2. 调用table来指定查询的表
        $list = $model
            ->field('s.sno,s.sname,s.ssex,sc.grade')
            ->table('tp_student s,tp_sc sc')
            ->where('s.sno=sc.sno and s.ssex="男" ')
            ->select();
        dump($list);
    }
    
    function join_test(){
        //1. 实例化student模型
        $list = D('Student')
            //为tp_student表设置别名
            ->alias('s')
            ->field('s.sno,s.sname,s.ssex,sc.grade')
            ->join('left join tp_sc sc on s.sno=sc.sno')
            ->where('s.ssex="男"')
            ->select();
        dump($list);
    }
    
    function join_test1(){
        //1. 实例化student模型
        $list = D('Student')
            ->alias('s')
            ->field('s.sno,sname,c.cname,sc.grade')
            ->join('left join tp_sc sc on s.sno=sc.sno')
            ->join('left join tp_course c on sc.cno=c.cno')
            ->select();
        dump($list);
    }
    
    function count_test(){
        $result = D('Student')->where('ssex="男"')->count();
        dump($result);
    }
    
    function  max_test(){
        $max = D('Student')->where('ssex="女" and sdept="CS"')->max('sage');
        dump($max);
    }
    
    function min_test(){
        $min = D('Student')->where('ssex="女" and sdept="CS"')->min('sage');
        dump($min);
    }
    
    function avg_test(){
        $avg = D('Student')->where('ssex="女"')->avg('sage');
        dump($avg);
    }
    
    function sum_test(){
        $sum = D('Student')->avg('sage');
        dump($sum);
    }
    
    function test(){
        //1. 实例化Student模型
        $grade = D('Student')->alias('s')
            ->join('LEFT JOIN tp_sc sc ON s.sno=sc.sno')
            ->join('LEFT JOIN tp_course c ON sc.cno=c.cno')
            ->where('s.sdept="CS" AND c.cname="高等数学"')
            ->avg('sc.grade');
        dump($grade);
    }
    
    function query_test(){
        //1. 实例化一个空模型
        $model = D();
        //2. 调用query方法执行查询
        $sql = 'SELECT  AVG(sc.grade) grade  FROM tp_student s
                    LEFT JOIN tp_sc sc ON s.sno=sc.sno
                    LEFT JOIN tp_course c ON sc.cno=c.cno
                    WHERE s.sdept="CS" AND c.cname="高等数学"';
        //调用query方法
        $result = $model->query($sql);
        dump($result);
    }
    
    function execute_test(){
        //1. 实例化一个空模型
        $model = D();
        //2. 调用excute执行写入
        $sql = "insert into tp_student 
                values(NULL, 'ddd', '男', 20, 'MA'),
                (NUll, 'eee', '女', 21, 'IS')";
        echo $model->execute($sql);
    }
}


















