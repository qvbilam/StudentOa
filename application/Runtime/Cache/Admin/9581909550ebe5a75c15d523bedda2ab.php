<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Public/Admin/css/base.css"/>
    <link rel="stylesheet" href="/Public/Admin/css/info-mgt.css"/>
    <link rel="stylesheet" href="/Public/Admin/css/WdatePicker.css"/>
    <title>移动办公自动化系统</title>
    <style type='text/css'>
        table tr .num {
            width: 50px;
        }

        table tr .name {
            width: 320px;
        }

        table tr .process {
            width: 80px;
        }

        table tr .file {
            width: 115px;
            padding-left: 13px;
        }

        table tr .file img {
            margin-top: 5px;
        }

        table tr .node {
            width: 80px;
        }

        table tr .addtime {
            width: 80px;
        }

        .i-content {
            height: 400px;
            overflow: auto;
        }
    </style>
</head>

<body>
<div class="title"><h2>信息管理</h2></div>
<div class="table-operate ue-clear">
    <a href="javascript:;" class="add">添加</a>
    <a href="javascript:;" class="del" id='btnDel'>删除</a>
    <a href="javascript:;" class="edit" id='btnEdit'>编辑</a>
</div>
<div class="table-box">
    <table>
        <thead>
        <tr>
            <th class="num">序号</th>
            <th class="name">标题</th>
            <th class="process">内容</th>
            <th class="file">缩略图</th>
            <th class="node">作者</th>
            <th class="time">添加时间</th>
            <th class="operate">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($post)): $i = 0; $__LIST__ = $post;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td class="num"><?php echo ($vo["k_id"]); ?></td>
            <td class="name"><?php echo ($vo["k_title"]); ?></td>
            <td class="process">
                <a class='show'>查看全文</a>
            </td>
            <td class="file">
                <img src=<?php echo ($vo["k_smallpic"]); ?>/>
            </td>
            <td class="node"><?php echo ($vo["user_nickname"]); ?></td>
            <td class="time"><?php echo ($vo["k_ctime"]); ?></td>
            <td class="operate">
                <input type='checkbox' name='checkbox' value='4'/>
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/core.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.pagination.js"></script>
<script type="text/javascript">
    $(".select-title").on("click", function () {
        $(".select-list").hide();
        $(this).siblings($(".select-list")).show();
        return false;
    })
    $(".select-list").on("click", "li", function () {
        var txt = $(this).text();
        $(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
    })

    $('.pagination').pagination(100, {
        callback: function (page) {
            alert(page);
        },
        display_msg: true,
        setPageNo: true
    });

    $("tbody").find("tr:odd").css("backgroundColor", "#eff6fa");

    showRemind('input[type=text], textarea', 'placeholder');
</script>
</html>