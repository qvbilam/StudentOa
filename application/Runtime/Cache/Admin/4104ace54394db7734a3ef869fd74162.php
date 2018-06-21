<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/admin/css/base.css" />
<link rel="stylesheet" href="/Public/admin/css/info-reg.css" />
<title>移动办公自动化系统</title>
</head>

<body>
<div class="title"><h2>信息登记</h2></div>
<form action="<?php echo U('/dept/addok');?>" method="post">
<div class="main">
    <p class="short-input ue-clear">
    	<label>部门名称：</label>
        <input type="text" name="dept_name" placeholder="分类号" />
    </p>
    <div class="short-input select ue-clear">
    	<label>上级部门：</label>
        <div class="select-wrap">
            <select name="dept_pid">
                <option value="0">顶级部门</option>
                <?php if(is_array($dept_list)): foreach($dept_list as $key=>$vo): ?><option value="<?php echo ($vo["dept_id"]); ?>"><?php echo ($vo["dept_name"]); ?></option><?php endforeach; endif; ?>
            </select>
        </div>
        <br/><br/>
    <div class="short-input ue-clear">
    	<label>备注：</label>
        <textarea name="dept_desc" placeholder="请输入内容"></textarea>
    </div>
</div>
</form>
<div class="btn ue-clear">
	<a href="javascript:;" class="confirm">确定</a>
    <a href="javascript:;" class="clear">清空内容</a>
</div>
</body>
<script type="text/javascript" src="/Public/admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/admin/js/common.js"></script>
<script type="text/javascript" src="/Public/admin/js/WdatePicker.js"></script>
<script type="text/javascript">
    
    //1.
    $('.confirm').click(function(){
        $('form').submit();
    })
    
//    $(".select-title").on("click",function(){
//            $(".select-list").toggle();
//            return false;
//    });
//    $(".select-list").on("click","li",function(){
//            var txt = $(this).text();
//            $(".select-title").find("span").text(txt);
//    });
//
//
//    showRemind('input[type=text], textarea','placeholder');
</script>
</html>