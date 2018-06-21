<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/jquery.dialog.css" />
<link rel="stylesheet" href="/Public/Admin/css/index.css" />
<title>移动办公自动化系统</title>
</head>

<body>
<div id="container">
  <div id="hd">
    <div class="hd-wrap ue-clear">
      <div class="top-light"></div>
      <h1 class="logo"></h1>
      <div class="login-info ue-clear">
        <div class="welcome ue-clear" style="width:150px">
        	<span>欢迎您,</span>
        	<a href="javascript:;" class="user-name"><?php echo (session('nickname')); ?></a>
        </div>
        <div class="login-msg ue-clear"> <a href="javascript:;" class="msg-txt">消息</a> <a href="javascript:;" class="msg-num">10</a> </div>
      </div>
      <div class="toolbar ue-clear"> <a href="<?php echo U('Main/index');?>" class="home-btn">首页</a> <a href="javascript:;" class="quit-btn exit"></a> </div>
    </div>
  </div>
  <div id="bd">
    <div class="wrap ue-clear">
      <div class="sidebar">
        <h2 class="sidebar-header">
          <p>功能导航</p>
        </h2>
<ul class="nav">
  <?php if(is_array($nodeA)): foreach($nodeA as $key=>$vo): ?><li class="<?php echo ($vo["node_title"]); ?>">
    <div class="nav-header">
    	<a href="javascript:;" class="ue-clear">
    		<span><?php echo ($vo["node_name"]); ?></span><i class="icon"></i>
    	</a>
    </div>
    <ul class="subnav">
      <?php if(is_array($nodeB)): foreach($nodeB as $key=>$v): if($v["node_pid"] == $vo["node_id"] ): ?><li><a href="javascript:;" date-src="<?php echo U($v[node_controller].'/'.$v[node_action]);?>">
      		<?php echo ($v["node_name"]); ?></a></li><?php endif; endforeach; endif; ?>
    </ul>
  </li><?php endforeach; endif; ?>
  </ul>
      </div>
      <div class="content">
        <iframe src="<?php echo U('home');?>" id="iframe" width="100%" height="100%" frameborder="0"></iframe>
      </div>
    </div>
  </div>
  <div id="ft" class="ue-clear">
    <div class="ft-left"> <span>中国移动</span> <em>Office&nbsp;System</em> </div>
    <div class="ft-right"> <span>Automation</span> <em>V2.0&nbsp;2014</em> </div>
  </div>
</div>
<div class="exitDialog">
  <div class="dialog-content">
    <div class="ui-dialog-icon"></div>
    <div class="ui-dialog-text">
      <p class="dialog-content">你确定要退出系统？</p>
      <p class="tips">如果是请点击“确定”，否则点“取消”</p>
      <div class="buttons">
        <input type="button" class="button long2 ok" value="确定" />
        <input type="button" class="button long2 normal" value="取消" />
      </div>
    </div>
  </div>
</div>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/core.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.dialog.js"></script>
<script type="text/javascript" src="/Public/Admin/js/index.js"></script>
</html>