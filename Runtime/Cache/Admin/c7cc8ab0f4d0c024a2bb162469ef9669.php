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
	<!-- <link rel="stylesheet" type="text/css" href="/Public/css/admin/upload.css"> -->
	<link rel="stylesheet" type="text/css" href="/Public/css/uploadify.css">
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
				  <i class="fa fa-dashboard"></i>
				  <a href="/Admin/Areacontent/index">&nbsp;&nbsp;区域内容管理</a>
				</li>
				<li class="active">
				  <i class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo ($nav_title); ?>
				</li>
			  </ol>
			</div>
		  </div>
		  <!-- /.row -->
		  <div class="row">
			<div class="col-lg-12">
			  <form class="form-horizontal" id="singcms-form">
				<div class="form-group">
				  <label for="title" class="col-sm-2 control-label">标题:</label>
				  <div class="col-sm-5">
					<input type="text" name="title" class="form-control" id="title" placeholder="请填写标题" value="<?php echo ($areaContentInfo["title"]); ?>">
				  </div>
				</div>
				<div class="form-group">
				  	<label for="area_id" class="col-sm-2 control-label">选择推荐位:</label>
				  	<div class="col-sm-5">
						<select class="form-control" name="area_id" id="area_id">
					  	<?php if(is_array($areaInfos)): foreach($areaInfos as $key=>$areaInfo): ?><option value="<?php echo ($areaInfo["id"]); ?>"
					  		<?php if($areaInfo['id'] == $areaContentInfo['area_id']): ?>selected="selected"<?php endif; ?>
					  		><?php echo ($areaInfo["name"]); ?></option><?php endforeach; endif; ?>
						</select>
				  	</div>
				</div>
				<div class="form-group">
				  <label for="file_upload" class="col-sm-2 control-label">缩图:</label>
				  <div class="col-sm-5">
					<input id="file_upload" type="file" data-url="/Admin/Image/uploadThumbImage" swf-url="/Public/js/uploadify.swf" img-url="/Public/image/Uploads/"><!-- multiple="true -->
					<img style="display: none" id="upload_origin_img" src="<?php echo ($areaContentInfo["thumb"]); ?>" style="width:100%;">
					<input id="upload_thumb_image" name="thumb" type="hidden" multiple="false" value="<?php echo ($areaContentInfo["thumb"]); ?>">
				  </div>
				</div>
				<div class="form-group">
				  <label for="url" class="col-sm-2 control-label">url:</label>
				  <div class="col-sm-5">
					<input type="text" class="form-control" value="<?php echo ($areaContentInfo["url"]); ?>" name="url" id="url" placeholder="请填写url地址">
				  </div>
				</div>
				<div class="form-group">
				  <label for="news_id" class="col-sm-2 control-label">文章id:</label>
				  <div class="col-sm-5">
					<input type="text" name="news_id" value="<?php echo ($areaContentInfo["news_id"]); ?>" class="form-control" id="news_id" placeholder="如果和文章无关联的可以不添加文章id">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">状态:</label>
				  <div class="col-sm-5">
					<input type="radio" name="status" value="1" 
						<?php if($areaContentInfo['status'] == 1): ?>checked<?php endif; ?>
					>开启
					<input type="radio" name="status" value="0" 
						<?php if($areaContentInfo['status'] == 0): ?>checked<?php endif; ?>
					>关闭
				  </div>
				</div>
				<div class="form-group">
				  	<div class="col-sm-offset-2 col-sm-10">
						<button type="button" class="btn btn-default" id="btn_edit_areacontent_submit" data-url="/Admin/Areacontent/editAreaContent" attr-id="<?php echo ($areaContentInfo["id"]); ?>">提交</button>
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
</body>
<script type="text/javascript" src="/Public/js/jquery.uploadify.min.js"></script>
<script type="text/javascript">
	    var imgPathPre=$("#file_upload").attr("img-url");
		$("#file_upload").uploadify({
			"buttonText": "上传美图",
			"fileTypeDesc": "Image Files",
			"fileObjName": "file_upload",
			"fileTypeExts": "*.gif; *.jpg; *.jpeg; *.png; *.bmp",
	    	"swf"      : $("#file_upload").attr('swf-url'),
	    	"uploader" : $("#file_upload").attr('data-url'),
	        "removeCompleted": false,
	        // 现在已经没有cancelImg这个属性了，如需要修改取消按钮图标，应该直接在css文件中修改
	    	"onUploadSuccess": function(file, data, response){
	    		if(response){
	    			var obj = JSON.parse(data);
	    			$imagePath = imgPathPre + obj.data.file_upload.savepath+obj.data.file_upload.savename;
	                $("#upload_origin_img").attr("src", $imagePath);
	                $("#upload_origin_img").show();
	    			$("#upload_thumb_image").attr("value", $imagePath);
	    		}else{
	    			hfaw_dialog.error("图片上传失败");
	    		}
	    	}
		});

	    //文件开始编辑前是否显示缩略图
	    var thumbpath = "<?php echo ($areaContentInfo["thumb"]); ?>";
	    if(thumbpath){
	    	$("#upload_origin_img").show();
	    }
</script>
</html>