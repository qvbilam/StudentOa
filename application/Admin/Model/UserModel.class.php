<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model{

    //1. 定义主键
   // protected $pk = 'user_id';
   //定义字段
    protected $pk="user_id";//主键
    protected $fields=array('user_id','user_name','user_nickname','user_passwd','user_roleid','user_deptid','user_sex','user_birthday','user_tel','user_email','user_ctime');//字段
    //字段映射
    protected $_map = array(
        'name'     => 'user_name',
        'password' => 'user_passwd',
        'nickname' => 'user_nickname',
        'deptid'   => 'user_deptid',
        'sex'      => 'user_sex',
        'birthday' => 'user_birthday',
        'tel'      => 'user_tel',
        'email'    => 'user_email'
    ); 
     //    验证字段： 指验证的数据表字段。
//验证规则： 验证使用的具体方法，和“附加规则”配合使用。
//错误提示： 当验证未通过时的错误提示信息。
//验证条件： 0  存在则验证（在表单中存在对应数据表字段，则进行验证）
//           1  必须验证
//           2  数据不为空时才验证
//附加规则： 验证数据的方式，常用的方式：正则表达式，函数验证，字符串验证...
//验证时间： 1  添加时验证
//           2  修改时验证
//           3  添加和修改都验证
    protected $_validate=array(
        //username验证 ，至少6位字母数字下划线
        array('user_name','require','用户名不为空',1,'regex',3),
                //用户名不能重复
        array('user_name','','该用户已被注册',1,'unique',3),
        //必须输入密码
       // array('user_passwd','require','密码不为空',1,'regex',3),
       array('user_passwd','/^\w{6,}$/','密码至少6位字母数字下划线',1,'regex',3),
        
        //两次密码一致 
        //参数1：重写密码标签name，
        //参数2：表字段名
        array('re-password','user_passwd','两次密码输入不一致',1,'confirm',3),
        //电话
        array('user_tel','/^1[3578]\d{9}$/','电话格式不正确',2,'regex',3),
        //email
         array('user_email','email','邮件格式不正确',2,'regex',3),

        
    );

    
   //    在Model基类当中，有$_auto属性，该属性用来进行自动完成的配置
// 
//完成字段： 要对应数据表中的字段
//完成规则： 自动填充该字段使用的具体方法，和“附加规则”配合使用
//完成条件： 1 添加时完成
//           2 修改时完成
//           3 添加和修改时都完成
//附加规则： 自动填充的方式

    //自动完成
    protected $_auto=array(
        //自动添加创建时间
        array('user_ctime','addDate',1,'callback'),
        //自动对密码进行MD5
        array('user_passwd','md5',3,'function'),
    );
    //获取当前时间
     function addDate(){
         return date('Y-m-d H:i:s');
     }
    //获取所有用户
    function getAll($pageIndex,$pageSize){
        
        return $r=  $this
                ->alias('u')
                ->field('u.*,d.dept_name as dname,r.role_name as rname')
                ->join('left join oa_dept d on u.user_deptid=d.dept_id')
                ->join('left join oa_role r  on u.user_roleid=r.role_id')
                ->page($pageIndex,$pageSize)
                ->select();
    }
    //用户总数
    function getCount(){
        return $this->count();
    }

    
    function check($name,$passwd){
        //1.根据用户名查询数据
        $userinfo=$this->where("user_name='$name'")->find();
        if(empty($userinfo)){
            //如果为空，说明用户不存在
            return 1;
        }
        //2.验证用户输入密码和数据表中取出密码的匹配性
        if(md5($passwd)==$userinfo['user_passwd']){
            //如果想等，说明信息正确，登录成功
            //记录session
            session('id',$userinfo['user_id']);
            session('name',$userinfo['user_name']);
            session('nickname',$userinfo['user_nickname']);
            session('deptid',$userinfo['user_deptid']);
            return 3;
        }else{
            //如果不相等，登录失败
            return 2;
        }
    }
}



















