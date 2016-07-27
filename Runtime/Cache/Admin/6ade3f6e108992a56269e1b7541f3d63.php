<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>内容管理平台--菜单编辑</title>
	<link rel="stylesheet" type="text/css" href="/Public/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/bootstrap-switch.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/admin/index.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/admin/morris.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/admin/global.css">
	<!-- javascript -->
	<script type="text/javascript" src="/Public/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/Public/js/layer/layer.js"></script>
	<script type="text/javascript" src="/Public/js/dialog.js"></script>
	<script type="text/javascript" src="/Public/js/admin/menu.js"></script>
</head>
<body>
	<div id="wrapper">
	    <?php
 $MenuList = D("Menu")->getAdminMenuList(); ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <a class="navbar-brand" >华风爱科新闻内容管理平台</a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-user"></i>&nbsp;<?php echo ($realName); ?><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a href="/Admin/index/getPersonInfo/username/<?php echo ($userName); ?>"><i class="icon icon-fw icon-user"></i>&nbsp;个人中心</a>
        </li>
       
        <li class="divider"></li>
        <li>
          <a href="/Admin/index/logout"><i class="icon icon-fw icon-power-off"></i>&nbsp;退出</a>
        </li>
      </ul>
    </li>
  </ul>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav nav_list">
      <li class="<?php echo (isActive((isset($defCtrl) && ($defCtrl !== ""))?($defCtrl):'index')); ?>">
        <a href="/Admin/Index/index"><i class="icon icon-fw icon-dashboard"></i>&nbsp;首页</a>
      </li>
      <?php if(is_array($MenuList)): $i = 0; $__LIST__ = $MenuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo (isActive($menu["controller"])); ?>">
        <a href="/Admin/<?php echo ($menu["controller"]); ?>/<?php echo ($menu["action"]); ?>"><i class="icon icon-fw icon-bar-chart-o">&nbsp;<?php echo ($menu["name"]); ?></i></a>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
  <!-- /.navbar-collapse -->
</nav>
	    <div id="page-wrapper">
	    <div class="container-fluid">
	        <!-- Page Heading -->
	        <div class="row">
	            <div class="col-lg-12">
	                <ol class="breadcrumb">
	                    <li>
	                        <i class="icon icon-dashboard"></i>
	                        <a href="/Admin/Menu/index">菜单管理</a>
	                    </li>
	                    <li class="active">
	                        <i class="icon icon-edit"></i>&nbsp;<?php echo ($nav_title); ?>
	                    </li>
	                </ol>
	            </div>
	        </div>
	        <!-- /.row -->
	        <div class="row">
	            <div class="col-lg-6">
	                <form class="form-horizontal" id="news_cms_form" >
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">菜单名:</label>
	                        <div class="col-sm-5">
	                            <input type="text" name="menuName" class="form-control" placeholder="请填写菜单名" value="<?php echo ($menuInfo["name"]); ?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">菜单类型:</label>
	                        <div class="col-sm-5">
	                            <input type="radio" name="menuType" value="1" <?php if($menuInfo["type"] == 1): ?>checked<?php endif; ?>>&nbsp;后台菜单
	                            <input type="radio" name="menuType" value="0" <?php if($menuInfo["type"] == 0): ?>checked<?php endif; ?>>&nbsp;前端栏目
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">模块名:</label>
	                        <div class="col-sm-5">
	                            <input type="text" class="form-control" name="menuModule" placeholder="模块名如admin" value="<?php echo ($menuInfo["module"]); ?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">控制器:</label>
	                        <div class="col-sm-5">
	                            <input type="text" class="form-control" name="menuController" placeholder="控制器如index" value="<?php echo ($menuInfo["controller"]); ?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">方法:</label>
	                        <div class="col-sm-5">
	                            <input type="text" class="form-control" name="menuAction" placeholder="方法名如index" value="<?php echo ($menuInfo["action"]); ?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-2 control-label">描述:</label>
	                        <div class="col-sm-5">
	                            <input type="text" class="form-control" name="menuDesp" placeholder="菜单描述如下" value="<?php echo ($menuInfo["description"]); ?>">
	                        </div>
	                    </div>
	                    <!--<div class="form-group">
	                        <label for="inputPassword3" class="col-sm-2 control-label">是否为前台菜单:</label>
	                        <div class="col-sm-5">
	                            <input type="radio" name="type" id="optionsRadiosInline1" value="0" checked> 否
	                            <input type="radio" name="type" id="optionsRadiosInline2" value="1"> 是
	                        </div>
	                    </div>-->
	                    <div class="form-group">
	                        <label for="inputMenuStatusOption1" class="col-sm-2 control-label">状态:</label>
	                        <div class="col-sm-5">
	                            <input type="radio" name="menuStatus" id="inputMenuStatusOption1" value="1" <?php if($menuInfo["status"] == 1): ?>checked<?php endif; ?> />&nbsp;开启
	                            <input type="radio" name="menuStatus" id="inputMenuStatusOption2" value="0" <?php if($menuInfo["status"] == 0): ?>checked<?php endif; ?> />&nbsp;关闭
	                            <input style="display:none;" type="radio" name="Menustatus" id="inputMenuStatusOption3" value="-1" <?php if($menuInfo["status"] == -1): ?>checked<?php endif; ?> />
	                        </div>
	                    </div>
	                    <input type="hidden" name="menuId" value="<?php echo ($menuInfo["menu_id"]); ?>"/>
		                <div class="form-group">
		                    <div class="col-sm-offset-2 col-sm-10">
		                        <button type="button" class="btn btn-default" id="btn_modify_menu_submit" data-url="/Admin/Menu/modifyMenu/id/10">更新</button>
		                    </div>
		                </div>
	                </form>
	            </div>
	        </div>
	        <!-- /.row -->
	    </div>
	    <!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->
	</div>
	<!-- /#wrapper -->
	<!-- Morris Charts JavaScript -->
</body>
</html>