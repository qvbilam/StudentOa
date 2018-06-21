<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-mgt.css" />
<link rel="stylesheet" href="/Public/Admin/css/WdatePicker.css" />
<title>移动办公自动化系统</title>
</head>

<body>
<div class="title"><h2>信息管理</h2></div>
<div class="table-operate ue-clear">
	<a href="<?php echo U('/dept/add');?>" class="add">添加</a>
    <a href="<?php echo U('/dept/dels');?>" class="del" style='width: 70px'>批量删除</a>
    <a href="javascript:;" class="edit">编辑</a>
    <a href="javascript:;" class="count">统计</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
                    <th class="num">选择</th>
                    <th class="num">序号</th>
                    <th class="name">部门名称</th>
                    <th class="process">上级部门</th>
    <!--                <th class="node">排序</th>-->
                    <th class="time">备注信息</th>
                    <th class="operate">操作</th>
                </tr>
        </thead>
        <tbody>
<!--        	<tr>
            	<td class="num">1</td>
                <td class="name">
                	管理部				</td>
                <td class="process"></td>
                <td class="node">1</td>
                <td class="time">管理部...</td>
                <td class="operate">
                	<input type='checkbox' name='checkbox' value='1' />
                </td>
            </tr><tr>
            	<td class="num">7</td>
                <td class="name">
                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;总裁办				</td>
                <td class="process">管理部</td>
                <td class="node">1</td>
                <td class="time">总裁办...</td>
                <td class="operate">
                	<input type='checkbox' name='checkbox' value='7' />
                </td>
            </tr><tr>
            	<td class="num">2</td>
                <td class="name">
                	财务部				</td>
                <td class="process"></td>
                <td class="node">2</td>
                <td class="time">财务部...</td>
                <td class="operate">
                	<input type='checkbox' name='checkbox' value='2' />
                </td>
            </tr><tr>
            	<td class="num">3</td>
                <td class="name">
                	技术部				</td>
                <td class="process"></td>
                <td class="node">3</td>
                <td class="time">技术部...</td>
                <td class="operate">
                	<input type='checkbox' name='checkbox' value='3' />
                </td>
            </tr><tr>
            	<td class="num">5</td>
                <td class="name">
                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;设计部				</td>
                <td class="process">技术部</td>
                <td class="node">1</td>
                <td class="time">设计部...</td>
                <td class="operate">
                	<input type='checkbox' name='checkbox' value='5' />
                </td>
            </tr><tr>
            	<td class="num">6</td>
                <td class="name">
                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;程序部				</td>
                <td class="process">技术部</td>
                <td class="node">2</td>
                <td class="time">程序部...</td>
                <td class="operate">
                	<input type='checkbox' name='checkbox' value='6' />
                </td>
            </tr><tr>
            	<td class="num">4</td>
                <td class="name">
                	运营部				</td>
                <td class="process"></td>
                <td class="node">4</td>
                <td class="time">运营部...</td>
                <td class="operate">
                	<input type='checkbox' name='checkbox' value='4' />
                </td>
            </tr><tr>
            	<td class="num">16</td>
                <td class="name">
                	人事部				</td>
                <td class="process"></td>
                <td class="node">50</td>
                <td class="time">人事部...</td>
                <td class="operate">
                	<input type='checkbox' name='checkbox' value='16' />
                </td>
            </tr>-->

        <?php if(is_array($dept_list)): foreach($dept_list as $key=>$vo): ?><tr>
                <td><input type="checkbox" value="{vo.dept_id}" /></td>
                <td class="num"><?php echo ($vo["dept_id"]); ?></td>
                <td class="name">
                   <?php echo (str_repeat('&emsp;&emsp;',$vo["level"])); echo ($vo["dept_name"]); ?>
                </td>
                <td class="process"><?php echo ((isset($vo["name"]) && ($vo["name"] !== ""))?($vo["name"]):'顶级部门'); ?></td>
                <td class="time"><?php echo ($vo["dept_desc"]); ?></td>
                <td class="operate">
<!--                    <input type='checkbox' name="checkbox" value='1'/>-->
                        <a href="<?php echo U('/Dept/editDept', 'id='.$vo[dept_id]);?>">修改</a>|
                        <a href="<?php echo U('/dept/delDept','id='.$vo[dept_id]);?>">删除</a>
                </td>
            </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
<div class="pagination ue-clear"></div>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.pagination.js"></script>
<script type="text/javascript">
    //1.为删除按钮绑定点击事件
$('.del').click(function(){
    //2.获取所有已选中的checkbox，重点是获取它的value值
    //$(':checkbox'):选中当前页面中所有的checkbox复选框
    //选中所有已勾选的复选框，该数据是被jQuery包裹的对象
    var check_list=$(':checkbox:checked');
    //alert（check_list）;
    //使用each方法来循环对象
    //设置接收dept_id值得字符串
    var dept_ids='';
    check_list.each(function(){
        dept_ids +=$(this).val()+',';
    });
    //截取掉最后一个
     dept_ids=dept_ids.substr(0,dept_ids.length-1);
     //alert(dept_ids);
     ///Admin/Dept:/Admin/Dept
     location,href="/Admin/Dept/dels/ids"+dept_ids;
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

$('.pagination').pagination(100,{
	callback: function(page){
		alert(page);	
	},
	display_msg: true,
	setPageNo: true
});

$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

showRemind('input[type=text], textarea','placeholder');

</script>
</html>