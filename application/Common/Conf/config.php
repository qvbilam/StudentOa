<?php
return array(
	//'配置项'=>'配置值'
	//定义要载入的文件名,多个文件用 , 分割
	'LOAD_EXT_FILE' => 'dir,image',
    
    /* 数据库设置 */
    'DB_TYPE'        =>  'mysql',     // 数据库类型
    'DB_HOST'        =>  'localhost', // 服务器地址
    'DB_NAME'        =>  'school',          // 数据库名
    'DB_USER'        =>  'root',      // 用户名
    'DB_PWD'         =>  '',          // 密码
    'DB_PORT'        =>  '3306',        // 端口
    'DB_PREFIX'      =>  'tp_',    // 数据库表前缀
    
	//设置URL访问模式为rewrite模式
    'URL_MODEL' => 2,
    
	//定义默认访问项
    'DEFAULT_MODULE'        =>  'Admin',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'login', // 默认操作名称
    //拒绝访问的模块
    'MODULE_DENY_LIST'      =>  array('Common','Runtime'),
    //允许访问的模块
    'MODULE_ALLOW_LIST'     =>  array('Home', 'Admin'),
    
    
    //自定义路径常量
    'TMPL_PARSE_STRING' => array(
        '__ADMIN__' => '/Public/Admin',
        '__ADMINCSS__' => '/Public/Admin/css',
        '__ADMINJS__' => '/Public/Admin/js',
        '__ADMINIMG__' => '/Public/Admin/images',
        
        '__HOME__'  => '/Public/Home',
        
        '__COMMON__' => '/Public/Common',
    ),
);