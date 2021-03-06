<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-reg.css" />
<script src="/Public/Common/uploadify/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="/Public/Common/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/Public/Common/uploadify/uploadify.css">

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
		font-size:12px;
		font-family:'Microsoft YaHei';
	}
	textarea#description { width:472px; padding:10px; height:84px; resize:none; outline:none; border:1px solid #c5d6e0; background:url(/Public/Admin/images/inputbg.png) repeat-x left top;overflow:auto; float:left;}
	#showPic {width:145px; height:120px; position:absolute; left:400px; top:65px; background:#f00;}
	#showPic img {width:145px; height:120px;}
</style>

</head>

<body>
<div class="title"><h2>信息登记</h2></div>
<form id="mainForm" action="" method="post" enctype='multipart/form-data'>
<div class="main">
	<div id='showPic'></div>
    <p class="short-input ue-clear">
    	<label>标题：</label>
        <input name="k_title" type="text" placeholder="标题" />
    </p>
	<p class="short-input ue-clear" style='float:left;'>
    	<label>缩略图：</label>
		<input type='hidden' id='thumb' name='k_smallpic' />
		<input type='hidden' id='pic'  name='k_pic' />
    </p>
	<br />
	<div style='float:left;'>
		<input type="file" id="file" name="file" multiple='true' />
	</div>
	<div style='clear:both;'></div>
	<p class="short-input ue-clear">
    	<label>作者：</label>
        <input name="k_author" type="text" value="<?php echo (session('nickname')); ?>" />
    </p>
	<p class="short-input ue-clear">
    	<label>描述：</label>
        <textarea name="k_desc" id="description" placeholder='描述'></textarea>
    </p>
    <p class="short-input ue-clear" style="float:left;">
    	<label>内容：</label>
    </p>
	<p style='width:900px; padding-left:0; float:left;'>
		<textarea name="k_content" id="content"></textarea>
	</p>
	<div style='clear:both;'></div>
</div>
<div class="btn ue-clear">
	<a href="javascript:;" class="confirm" id='btnSubmit'>确定</a>
    <a href="javascript:;" class="clear" id='btnReset'>清空内容</a>
</div>
</form>
</body>

<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript">
$('#btnSubmit').click(function(){
	$('#mainForm').submit();
})

$('#file').uploadify({
	'swf'      : '/Public/Common/uploadify/uploadify.swf',
	'uploader' : "<?php echo U('ZcxupImage');?>",
	'onUploadSuccess' : function(file, data, response) {
		//data不是json对象是一个json格式字符串
        //将字符串转为json对象
		data = JSON.parse(data);
		//alert(data);
        //获取id=showPic的div标签
        var div = $('#showPic');
        //alert(data.small);
        //将smal路径最前面的 . 截取掉
        var small_path = data.small;
        small_path = small_path.substr(1);
        //创建img对象
        str = "<img src='"+small_path+"' />";
        div.html(str);
        
        //将大图和小图的路径写入隐藏域
        $('#thumb').val(data.small);
        $('#pic').val(data.big);
    }
});

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