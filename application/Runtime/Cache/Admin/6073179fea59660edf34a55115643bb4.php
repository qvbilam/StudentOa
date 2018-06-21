<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Public/Admin/css/base.css"/>
    <link rel="stylesheet" href="/Public/Admin/css/info-mgt.css"/>
    <link rel="stylesheet" href="/Public/Admin/css/WdatePicker.css"/>
    <script src="/Public/Common/iDialog/jquery-1.8.3.min.js"></script>
    <script src="/Public/Common/iDialog/jquery.iDialog.js" dialog-theme="default"></script>
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
            width: 80px;
            padding-left: 13px;
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
    <a href="<?php echo U('zcxadd');?>" class="add">添加</a>
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
            <th class="file">附件下载</th>
            <th class="node">作者</th>
            <th class="time">添加时间</th>
            <th class="operate">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($doc_list)): foreach($doc_list as $key=>$vo): ?><tr>
                <td class="num"><?php echo ($vo["doc_id"]); ?></td>
                <td class="name"><?php echo ($vo["doc_title"]); ?></td>
                <td class="process">
                    <a class='show' onclick="show(<?php echo ($vo["doc_id"]); ?>)">查看全文</a>
                </td>
                <td class="file">
                    <?php if($vo["doc_file"] != 'null' ): ?><a href="<?php echo U('zcxdownload', 'id='.$vo[doc_id]);?>">附件下载</a>
                        <?php else: ?>
                        无附件<?php endif; ?>
                </td>
                <td class="node"><?php echo ($vo["user_nickname"]); ?></td>
                <td class="time"><?php echo ($vo["doc_ctime"]); ?></td>
                <td class="operate">
                    <a href="<?php echo U('zcxdelDoc', 'id='.$vo[doc_id]);?>" onclick="return del()">删除</a>
                    <a href="<?php echo U('zcxeditDoc', 'id='.$vo[doc_id]);?>">编辑</a>
                </td>
            </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
</body>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/core.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.pagination.js"></script>
<script type="text/javascript">
    function del() {
        //返回值是 true/false , 点击“确定”时返回true, 点击"取消"是返回false
        var result = confirm('确认删除该公文');
        //判断返回值
        if (result) {
            return true;
        } else {
            return false;
        }
    }

    function show(id) {
        //参数1: 请求的后台PHP程序地址
        //参数2: 传递到后台程序的参数
        //参数3: readyState=4时的触发事件，参数是从后台接收到的结果
        //参数4: 设置返回值类型  text  json  xml
        $.post("<?php echo U('zcxgetContent');?>", {'id': id}, function (msg) {
            //alert(msg);
            //调用iDialog插件显示标题和内容
            iDialog({
                title: msg.doc_title,
                content: msg.doc_content,
                lock: true,
                width: 800,
                fixed: true,
                height: 500
            });
        }, 'json');
    }

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