<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>内容管理平台--菜单管理</title>
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
	    <div id="page-wrapper">
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
	    <div class="container-fluid" >
	        <!-- Page Heading -->
	        <div class="row">
	            <div class="col-lg-12">
	                <ol class="breadcrumb">
	                    <li>
	                        <i class="icon icon-dashboard"></i>
	                        <a href="/Admin/Menu/index">菜单管理</a>
	                    </li>
	                    <li class="active">
	                        <i class="icon icon-table"></i>&nbsp;&nbsp;<?php echo ($nav_title); ?>
	                    </li>
	                </ol>
	            </div>
	        </div>
	        <!-- /.row -->
	        <div class="row">
	            <form action="/Admin/Menu/index" method="GET">
	                <div class="col-md-5">
	                	<div class="input-group">
	                	    <span class="input-group-addon">类型</span>
	                	    <select class="form-control" name="searchMenuType">
	                	        <option value="-1" <?php if($curMenuType == -1): ?>selected="selected"<?php endif; ?>>==全部类型==</option>
	                	        <option value="1" <?php if($curMenuType == 1): ?>selected="selected"<?php endif; ?> >后台菜单</option>
	                	        <option value="0" <?php if($curMenuType == 0): ?>selected="selected"<?php endif; ?> >前端导航</option>
	                	    <select>
		                	<span class="input-group-btn">
		                	  <button id="menu_type_search" type="submit" class="btn btn-primary">
		                	  	<i class="icon icon-search"></i>
		                	  </button>
		                	</span>
	                	</div>
	                </div>
	            </form>
		        <div class="col-md-1">
		          <button id="menu_add_link" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-url="/Admin/Menu/addMenu">
		          	<span class="icon icon-plus" aria-hidden="true"></span>&nbsp;添加
		          </button>
		        </div>
	        </div>
	        <div class="row">
	            <div class="col-lg-10">
	                <h3></h3>
	                <div class="table-responsive">
	                    <form id="menu_controller_form">
	                    <table class="table table-bordered table-hover news-cms-table">
	                        <thead>
	                        <tr>
	                            <th>排序</th>
	                            <th>id</th>
	                            <th>菜单名</th>
	                            <th>模块名</th>
	                            <th>控制器名</th>
	                            <th>方法名</th>
	                            <th>类型</th>
	                            <th>状态</th>
	                            <th>操作</th>
	                        </tr>
	                        </thead>
	                        <tbody>
	                        	<?php if(is_array($menulist)): foreach($menulist as $key=>$menu): ?><tr>
		                        	    <td><input size="4" type="text" name="order[<?php echo ($menu["menu_id"]); ?>]" value="<?php echo ($menu["order"]); ?>"/></td>
		                        	    <td><?php echo ($menu["menu_id"]); ?></td>
		                        	    <td><?php echo ($menu["name"]); ?></td>
		                        	    <td><?php echo ($menu["module"]); ?></td>
		                        	    <td><?php echo ($menu["controller"]); ?></td>
		                        	    <td><?php echo ($menu["action"]); ?></td>
		                        	    <td><?php echo (getMenuTypeName($menu["type"])); ?></td>
		                        	    <td><?php echo (parseStatus($menu["status"])); ?></td>
		                        	    <td>
		                        	    	<a href="javascript:void(0)" attr-id="<?php echo ($menu["menu_id"]); ?>" class="menu_modify_link" data-url="/Admin/Menu/modifyMenu/id/<?php echo ($menu["menu_id"]); ?>" attr-message="编辑">
		                        	    		<span class="icon icon-edit" aria-hidden="true"></span>
		                        	    	</a>
		                        	    	<a href="javascript:void(0)" attr-id="<?php echo ($menu["menu_id"]); ?>" class="menu_delete_link" data-url="/Admin/Menu/deleteMenu/id/<?php echo ($menu["menu_id"]); ?>" success-url="/Admin/Menu/index" error-url="/Admin/Menu/index/searchMenuType/1/p/1.html" attr-message="删除">
		                        	    		<span class="icon icon-remove-circle" aria-hidden="true"></span>
		                        	    	</a>
		                        	    </td>
		                        	</tr><?php endforeach; endif; ?>
	                        </tbody>
	                    </table>
	                    </form>
	                    <nav>
	                        <ul class="pagination">
	                            <?php echo ($menushow); ?>
	                        </ul>
	                    </nav>
	                    <div>
	                        <button id="btn_change_menu_order" type="button" class="btn btn-primary dropdown-toggle" data-url="/Admin/Menu/orderMenu" data-redirect-url="/Admin/Menu/index">
	                        	<span class="icon icon-plus" aria-hidden="true"></span>&nbsp;更新排序
	                       	</button>
	                    </div>
	                </div>
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