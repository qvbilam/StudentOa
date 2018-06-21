<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-reg.css" />
<title>移动办公自动化系统</title>
<style type='text/css'>
	select {
		background: rgba(0, 0, 0, 0) url("/Public/Admin/images/inputbg.png") repeat-x scroll 0 0;
	    border: 1px solid #c5d6e0;
	    height: 28px;
	    outline: medium none;
	    padding: 0 10px;
	    width: 240px;
	}
	textarea {
		width:800px;
	}
	#tip {
		position:absolute;
		z-index:999;
		top:96px;
		left:114px;
		width:260px;
		height:auto;
		display:none;
		background:#fff;
		border:1px #C5D6E0 solid;
	}
	#tip div {
		padding:0 10px;
	}
</style>
</head>

<body>
<div class="title"><h2>信息登记</h2></div>
<form action="/thinkoa/index.php/Admin/Email/addOk" method="post" enctype='multipart/form-data'>
<div class="main">
	<p class="short-input ue-clear">
    	<label>收件人：</label>
        <input name="nickname" id='nickname' type="text" placeholder="收件人名称" autocomplete='off' />
		<div id='tip'></div>
    </p>
    <p class="short-input ue-clear">
    	<label>主题：</label>
        <input name="title" type="text" placeholder="邮件主题" />
    </p>
	<p class="short-input ue-clear">
    	<label>附件：</label>
        <input type="file" name="file" />
    </p>
    <p class="short-input ue-clear" style="float:left;">
    	<label>内容：</label>
    </p>
	<p style='width:900px; padding-left:0; float:left;'>
		<textarea name="content" id="content"></textarea>
	</p>
	<div style='clear:both;'></div>
</div>
<div class="btn ue-clear">
	<a href="javascript:;" class="confirm" id='btnSubmit'>确定</a>
    <a href="javascript:;" class="clear" id='btnReset'>清空内容</a>
</div>
</form>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript">
//1. 获取收件人文本框，绑定键盘弹起事件
$('#nickname').keyup(function(){
	//2. 获取文本框中的内容
	var name = $(this).val();
	//3. 发送ajax请求
	$.ajax({
		//要请求的后台php程序地址
		'url': "<?php echo U('ZcxgetUser');?>",
		//指定请求方式
		'type': 'get',
		//如果指定请求方式为get时，需要设置不进行缓存
		'cache': false,
		//向后台php程序发送的数据 json
		'data': {'name':name},
		//设置返回值类型
		'dataType': 'json',
		//当readyState=4时的触发事件,参数就是php的返回值
		'success':function(msg){
			//alert(msg);
			//获取下拉菜单标签对象
			var div_obj = $('#tip');
			//在循环新的用户名之前，将当前已有的用户名清空
			div_obj.empty();
			//循环msg(json对象)，读出所有的nickname，在填充到下拉菜单中
			for(i = 0; i < msg.length; i++){
				//创建一个新的div标签
				var div = $('<div>');
				//将每次取出的用户名写入该div标签
				div.html(msg[i].user_nickname);
				//为div绑定鼠标悬浮事件
				div.mouseover(function(){
					//让该div背景色变蓝
					$(this).css({'background':'blue'});
				})
				//为div绑定鼠标移除事件
				div.mouseout(function(){
					//让该div背景色变白
					$(this).css({'background':'white'});
				})
				//为div绑定点击事件
				div.click(function(){
					//将当前用户名写入收件人
					$('#nickname').val($(this).html());
					//隐藏下拉菜单
					div_obj.hide();
				})
				//将使用div包裹好的用户名写入下拉菜单中
				div_obj.append(div);
			}
			//显示下拉菜单
			div_obj.show();
		}
	})
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