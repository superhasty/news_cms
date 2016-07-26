<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo ($basicWebConfig["title"]); ?></title>
	<meta name="keywords" content="<?php echo ($basicWebConfig["keywords"]); ?>">
	<meta name="description" content="<?php echo ($basicWebConfig["description"]); ?>">
	<link rel="stylesheet" type="text/css" href="/news_imooc/project-demo/news_cms/Public/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/news_imooc/project-demo/news_cms/Public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/news_imooc/project-demo/news_cms/Public/css/bootstrap-switch.css">
	<link rel="stylesheet" type="text/css" href="/news_imooc/project-demo/news_cms/Public/css/admin/index.css">
	<link rel="stylesheet" type="text/css" href="/news_imooc/project-demo/news_cms/Public/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/news_imooc/project-demo/news_cms/Public/css/admin/morris.css">
	<link rel="stylesheet" type="text/css" href="/news_imooc/project-demo/news_cms/Public/css/admin/global.css">
	<link rel="stylesheet" type="text/css" href="/news_imooc/project-demo/news_cms/Public/css/admin/upload.css">
	<!-- javascript -->
	<script type="text/javascript" src="/news_imooc/project-demo/news_cms/Public/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/news_imooc/project-demo/news_cms/Public/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/news_imooc/project-demo/news_cms/Public/js/layer/layer.js"></script>
	<script type="text/javascript" src="/news_imooc/project-demo/news_cms/Public/js/dialog.js"></script>
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
          <a href="/news_imooc/project-demo/news_cms/Admin/index/getPersonInfo/username/<?php echo ($userName); ?>"><i class="icon icon-fw icon-user"></i>&nbsp;个人中心</a>
        </li>
       
        <li class="divider"></li>
        <li>
          <a href="/news_imooc/project-demo/news_cms/Admin/index/logout"><i class="icon icon-fw icon-power-off"></i>&nbsp;退出</a>
        </li>
      </ul>
    </li>
  </ul>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav nav_list">
      <li class="<?php echo (isActive((isset($defCtrl) && ($defCtrl !== ""))?($defCtrl):'index')); ?>">
        <a href="/news_imooc/project-demo/news_cms/Admin/Index/index"><i class="icon icon-fw icon-dashboard"></i>&nbsp;首页</a>
      </li>
      <?php if(is_array($MenuList)): $i = 0; $__LIST__ = $MenuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo (isActive($menu["controller"])); ?>">
        <a href="/news_imooc/project-demo/news_cms/Admin/<?php echo ($menu["controller"]); ?>/<?php echo ($menu["action"]); ?>"><i class="icon icon-fw icon-bar-chart-o">&nbsp;<?php echo ($menu["name"]); ?></i></a>
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
	                <h1 class="page-header">
	                    您好!欢迎使用singcms内容管理平台
	                </h1>
	                <ol class="breadcrumb">
	                    <li class="active">
	                        <i class="fa fa-dashboard"></i>平台整理指标
	                    </li>
	                </ol>
	            </div>
	        </div>
	        <div class="row">
	            <div class="col-lg-3 col-md-6">
	                <div class="panel panel-primary">
	                    <div class="panel-heading">
	                        <div class="row">
	                            <div class="col-xs-3">
	                                <i class="icon icon-comments icon-5x"></i>
	                            </div>
	                            <div class="col-xs-9 text-right">
	                                <div class="huge"></div>
	                                <div>今日登录用户数12</div>
	                            </div>
	                        </div>
	                    </div>
                        <div class="panel-footer">
                            <span class="pull-left"></span>
                            <span class="pull-right">
                            	<i class="icon icon-circle-arrow-right"></i>
                            </span>
                            <div class="clearfix"></div>
                        </div>
	                </div>
	            </div>
	            <div class="col-lg-3 col-md-6">
	                <div class="panel panel-green">
	                    <div class="panel-heading">
	                        <div class="row">
	                            <div class="col-xs-3">
	                                <i class="icon icon-tasks icon-5x"></i>
	                            </div>
	                            <div class="col-xs-9 text-right">
	                                <div class="huge"></div>
	                                <div>文章数量12</div>
	                            </div>
	                        </div>
	                    </div>
	                    <a href="/admin.php?c=content&a=index">
	                        <div class="panel-footer">
	                            <span class="pull-left">查看</span>
	                            <span class="pull-right"><i class="icon icon-circle-arrow-right"></i></span>
	                            <div class="clearfix"></div>
	                        </div>
	                    </a>
	                </div>
	            </div>
	            <div class="col-lg-3 col-md-6">
	                <div class="panel panel-yellow">
	                    <div class="panel-heading">
	                        <div class="row">
	                            <div class="col-xs-3">
	                                <i class="icon icon-asterisk icon-5x"></i>
	                            </div>
	                            <div class="col-xs-9 text-right">
	                                <div class="huge"></div>
	                                <div>文章最大阅读数12</div>
	                            </div>
	                        </div>
	                    </div>
	                    <a target="_blank" href="">
	                        <div class="panel-footer">
	                            <span class="pull-left"></span>
	                            <span class="pull-right"><i class="icon icon-circle-arrow-right"></i></span>
	                            <div class="clearfix">ssssssssssssssss</div>
	                        </div>
	                    </a>
	                </div>
	            </div>
	            <div class="col-lg-3 col-md-6">
	                <div class="panel panel-red">
	                    <div class="panel-heading">
	                        <div class="row">
	                            <div class="col-xs-3">
	                                <i class="icon icon-screenshot icon-5x"></i>
	                            </div>
	                            <div class="col-xs-9 text-right">
	                                <div class="huge"></div>
	                                <div>推荐位数</div>
	                            </div>
	                        </div>
	                    </div>
	                    <a href="/admin.php?c=position">
	                        <div class="panel-footer">
	                            <span class="pull-left">查看</span>
	                            <span class="pull-right">
	                            	<i class="icon icon-circle-arrow-right"></i>
	                            </span>
	                            <div class="clearfix"></div>
	                        </div>
	                    </a>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->
	<!-- Morris Charts JavaScript -->
	</div>
</body>
</html>