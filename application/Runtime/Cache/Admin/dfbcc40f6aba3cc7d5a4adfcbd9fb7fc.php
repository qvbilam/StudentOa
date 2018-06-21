<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-reg.css" />
<title>移动办公自动化系统</title>
<style>
	.main p input {
		float:none;
	}
</style>
</head>

<body>
<div class="title"><h2>信息登记</h2></div>
<form action="" method="post">
<div class="main">
    <p class="short-input ue-clear">
    	<label>权限名称：</label>
        <input type="text" name="node_name" />
    </p>
    <p class="short-input ue-clear">
    	<label>别名：</label>
        <input type="text" name="node_title" />
    </p>
    <div class="short-input select ue-clear">
    	<label>上级权限：</label>
        <select name="node_pid">
        	<option value="0">作为顶级</option>
			<?php if(is_array($node_list)): foreach($node_list as $key=>$vo): ?><option value="<?php echo ($vo["node_id"]); ?>"><?php echo ($vo["node_name"]); ?></option><?php endforeach; endif; ?>
        </select>
    </div>
    <p class="short-input ue-clear">
    	<label>模块名：</label>
        <input type="text" name="node_module"/>
    </p>
    <p class="short-input ue-clear">
    	<label>控制器名：</label>
        <input type="text" name="node_controller" />
    </p>
    <p class="short-input ue-clear">
    	<label>方法名：</label>
        <input type="text" name="node_action" />
    </p>
    <p class="short-input ue-clear">
    	<label>路径：</label>
        <input type="text" name="node_path" />
    </p>
    <p class="short-input ue-clear">
    	<label>级别：</label>
        <input type="text" name="node_level" />
    </p>
    <p class="short-input ue-clear">
    	<label>排序：</label>
        <input type="text" name="node_sort" />
    </p>
    <p class="short-input ue-clear">
    	<label>是否显示：</label>
        <input type="radio" name="node_show" value="1" checked='checked' />显示&nbsp;&nbsp;
		<input type="radio" name="node_show" value="0" />不显示
    </p>
</div>
<div class="btn ue-clear">
	<a href="javascript:;" class="confirm">确定</a>
    <a href="javascript:;" class="clear">清空内容</a>
</div>
</form>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript">
$('.confirm').click(function(){
	$('form').submit();
})
$(".select-title").on("click",function(){
	$(".select-list").toggle();
	return false;
});
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(".select-title").find("span").text(txt);
});


showRemind('input[type=text], textarea','placeholder');
</script>
</html>