<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>内容管理平台--区域内容管理</title>
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
	<script type="text/javascript" src="/Public/js/admin/areacontent.js"></script>
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
		              			<a href="/Admin/Areacontent/index">&nbsp;&nbsp;区域内容管理</a>
		            		</li>
		            		<li class="active">
		              			<i class="icon icon-table"></i>&nbsp;&nbsp;<?php echo ($nav_title); ?>
		            		</li>
		                </ol>
		            </div>
		        </div>
		        <!-- /.row -->
		        <div >
		            <button id="areacontent_add_link" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-url="/Admin/Areacontent/addAreaContent">
		            	<span class="icon icon-plus" aria-hidden="true"></span>&nbsp;添加
		            </button>
		        </div>
		        <div class="row">
		            <form action="/Admin/Areacontent/index" method="GET">
		                <div class="col-md-3">
		                    <div class="input-group">
		                        <span class="input-group-addon">区域</span>
		                        <select class="form-control" name="searchAreaId">
		                        	<option value="-1" <?php if($areaInfo['id'] == -1): ?>selected="selected"<?php endif; ?>>==全部区域==</option>
		                            <?php if(is_array($areaInfos)): foreach($areaInfos as $key=>$areaInfo): ?><option value="<?php echo ($areaInfo["id"]); ?>" 
		                                	<?php if($areaInfo['id'] == $curAreaId): ?>selected="selected"<?php endif; ?>
		                                ><?php echo ($areaInfo["name"]); ?></option><?php endforeach; endif; ?>
		                        </select>
		                    </div>
		                </div>
		                <div class="col-md-3">
		                    <div class="input-group">
		                        <input class="form-control" name="searchTitle" type="text" value="<?php echo ($title); ?>" placeholder="文章标题" />
			                	<span class="input-group-btn">
			                  		<button id="sub_data" type="submit" class="btn btn-primary">
			                  			<i class="icon icon-search"></i>
			                  		</button>
			                	</span>
		                    </div>
		                </div>
		            </form>
		        </div>
		        <div class="row">
		            <div class="col-lg-12">
		                <h3></h3>
		                <div class="table-responsive">
		                    <form id="areacontent_controller_form">
		                    <table class="table table-bordered table-hover singcms-table">
		                        <thead>
		                        <tr>
		                            <th width="14">排序</th>
		                            <th>id</th>
		                            <th>标题</th>
		                            <th>区域</th>
		                            <th>封面图</th>
		                            <th>创建时间</th>
		                            <th>更新时间</th>
		                            <th>状态</th>
		                            <th>操作</th>
		                        </tr>
		                        </thead>
		                        <tbody>
		                            <?php if(is_array($datalist)): foreach($datalist as $key=>$content): ?><tr>
		                                <td>
		                                	<input size='4' type='text' name='order[<?php echo ($content["id"]); ?>]' value="<?php echo ($content["order"]); ?>"/>
		                                </td>
		                                <td><?php echo ($content["id"]); ?></td>
		                                <td><?php echo ($content["title"]); ?></td>
		                                <td><?php echo (getAreaName($areaInfos,$content["area_id"])); ?></td>
		                                <td><?php echo (hasthumb($content["thumb"])); ?></td>
		                                <td><?php echo (date("y-m-d H:i:s",$content["createtime"])); ?></td>
		                                <td><?php echo (date("y-m-d H:i:s",$content["updatetime"])); ?></td>
		                                <td>
		                                    <span attr-status="
		                                    	<?php if($content['status'] == 1): ?>0
		                                    	<?php else: ?>
		                                    		1<?php endif; ?>" 
		                                    	attr-id="<?php echo ($content["id"]); ?>" class="singcms-on-off" id="singcms-on-off">
		                                    	<?php echo (parseStatus($content["status"])); ?>
		                                    </span>
		                                </td>
		                                <td>
		                                    <a href="javascript:void(0)" attr-id="<?php echo ($content["id"]); ?>" class="areacontent_edit_link" data-url="/Admin/Areacontent/editAreaContent/id/<?php echo ($content["id"]); ?>" attr-message="编辑">
		                                    	<span class="sing_cursor icon icon-edit" aria-hidden="true"></span>
		                                    </a>
		                                    <a href="javascript:void(0)" attr-id="<?php echo ($content["id"]); ?>" class="areacontent_delete_link" data-url="/Admin/Areacontent/deleteAreaContent/id/<?php echo ($content["id"]); ?>" attr-message="删除">
		                                        <span class="icon icon-remove-circle" aria-hidden="true"></span>
		                                    </a>
		                                </td>
		                            </tr><?php endforeach; endif; ?>
		                        </tbody>
		                    </table>
		                    <nav>
				              	<ul>
				                	<?php echo ($datashow); ?>
				              	</ul>
				            </nav>
		                    <div>
		                        <button  id="btn_change_areacontent_order" type="button" class="btn btn-primary dropdown-toggle" data-url="/Admin/Areacontent/orderAreaContent" data-redirect-url="/Admin/Areacontent/index">
		                        	<span class="icon icon-resize-vertical" aria-hidden="true"></span>&nbsp;&nbsp;更新排序
		                        </button>
		                    </div>
		                    </form>
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
</body>
</html>