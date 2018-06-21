<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-mgt.css" />
<link rel="stylesheet" href="/Public/Admin/css/WdatePicker.css" />
<title>移动办公自动化系统</title>
<style type='text/css'>
	table tr .num{ width:63px; text-align: center;}
	table tr .name{ width:63px; padding-left:17px;}
	table tr .nickname{ width:63px; padding-left:13px;}
	table tr .dept{ width:63px; padding-left:13px;}
	table tr .role{ width:63px; padding-left:13px;}
	table tr .sex{ width:63px; padding-left:13px;}
	table tr .birthday{ width:100px; padding-left:13px;}
	table tr .tel{ width:63px; padding-left:13px;}
	table tr .email{ width:63px; padding-left:13px;}
	table tr .ctime{ width:100px; padding-left:13px;}
	table tr .operate{ width:63px; padding-left:15px;}
	table tr .operate a{ color:#2c7bbc;}
	table tr .operate a:hover{ text-decoration:underline;}
</style>
</head>
<body>
<div class="title"><h2>用户信息管理</h2></div>
<div class="table-operate ue-clear">
    <a href="<?php echo U('/user/add');?>" class="add">添加</a>
    <a href="<?php echo U('/user/dels');?>" class="del" style="padding-left: 10px">批量删除</a>
    <a href="<?php echo U('/User/editUser', 'id='.$vo[user_id]);?>" class="edit">编辑</a>
    <a href="javascript:;" class="count">统计</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
                    <th class="num"><input type='checkbox' id="qfx"/></th>
                    <th class="name">用户名</th>
                    <th class="nickname">用户昵称</th>
                    <th class="dept">类别</th>
                    <th class="role">角色</th>
                    <th class="sex">性别</th>
                    <th class="birthday">出生日期</th>
                    <th class="tel">电话</th>
                    <th class="email">邮箱</th>
                    <th class="ctime">修改时间</th>
                    <th class="operate">操作</th>
            </tr>
        </thead>
        <tbody>
        	<?php if(is_array($user_list)): foreach($user_list as $key=>$vo): ?><tr>
                <td class="num"><input type='checkbox' value='<?php echo ($vo["user_id"]); ?>'/></td>
                <td class="name"><?php echo (str_repeat('&emsp;&emsp;',$vo["name"])); echo ($vo["user_name"]); ?></td>
                <td class="nickname"><?php echo ($vo["user_nickname"]); ?></td>
                <td class="dept"><?php echo ($vo["user_deptid"]); ?></td>
                <td class="role"><?php echo ($vo["user_roleid"]); ?></td>
                <td class="sex"><?php echo ($vo["user_sex"]); ?></td>
                <td class="birthday"><?php echo ($vo["user_birthday"]); ?></td>
                <td class="tel"><?php echo ($vo["user_tel"]); ?></td>
                <td class="email"><?php echo ($vo["user_email"]); ?></td>
                <td class="ctime"><?php echo ($vo["user_ctime"]); ?></td>
                <td class="operate">
                    <a href="<?php echo U('/User/editUser', 'id='.$vo[user_id]);?>">修改</a>|
                    <a href="<?php echo U('/User/ZcxdelUser','id='.$vo[user_id]);?>">删除</a>
                </td>
            </tr><?php endforeach; endif; ?>
        </tbody>
        <tr>
            <td textalign="center" cl nowrap="true" colspan="9" height="20">
            </td>
        </tr>
    </table>
</div>
<div class="pagination ue-clear"><?php echo ($show); ?></div>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.pagination.js"></script>
<script type="text/javascript">
$('.del').click(function(){
        var check_list=$(':checkbox:checked');
        var dept_ids='';
        check_list.each(function(){
            dept_ids += $(this).val() + ',';
        })
        dept_ids=dept_ids.substr(0,dept_ids.length-1);
        location.href="/Admin/User/dels/ids/"+dept_ids;
    })
$('#qfx').click(function(){
    if($(this).is(":checked"))
    {
        $("tbody input").prop("checked",true);
    }
    else
    {
        $("tbody input").prop("checked",false);
    }
})
$(".select-title").on("click",function(){
	$(".select-list").hide();
	$(this).siblings($(".select-list")).show();
	return false;
})
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
})
$('.pagination').pagination(<?php echo ($count); ?>,{
	callback: function(page){
		alert(page+1);	
	},
	display_msg: false,
	setPageNo: false,
        items_per_page:<?php echo ($pagesize); ?>
});
$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

showRemind('input[type=text], textarea','placeholder');

</script>

</html>