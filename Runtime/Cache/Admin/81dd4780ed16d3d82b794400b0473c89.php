<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>内容管理平台--新闻编辑</title>
	<link rel="stylesheet" type="text/css" href="/Public/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/bootstrap-switch.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/admin/index.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/admin/morris.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/admin/global.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/admin/upload.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/uploadify.css">
	<script type="text/javascript" src="/Public/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/Public/js/layer/layer.js"></script>
	<script type="text/javascript" src="/Public/js/dialog.js"></script>
	<script type="text/javascript" src="/Public/js/admin/news.js"></script>
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
				              <i class="icon icon-dashboard"></i>&nbsp;&nbsp;<a href="/Admin/News/index">文章管理</a>
				            </li>
				            <li class="active">
				              <i class="icon icon-edit"></i>&nbsp;<?php echo ($nav_title); ?>
				            </li>
			          	</ol>
			        </div>
		    	</div>
		      	<!-- /.row -->
		    	<div class="row">
		        	<div class="col-lg-12">
			          	<form class="form-horizontal" id="singcms-form" method="post" action="/Admin/News/editNews/id/5">
				            <div class="form-group">
				           		<label for="newstitle" class="col-sm-2 control-label">标题:</label>
				            	<div class="col-sm-5">
				            		<input type="text" name="newstitle" class="form-control" id="newstitle" placeholder="请填写标题" value="<?php echo ($newsInfo["title"]); ?>">
				            	</div>
				        	</div>
					        <div class="form-group">
					            <label for="newssubtitle" class="col-sm-2 control-label">短标题:</label>
					            <div class="col-sm-5">
					                <input type="text" name="newssubtitle" class="form-control" id="newssubtitle" placeholder="请填写短标题" value="<?php echo ($newsInfo["subtitle"]); ?>">
					            </div>
					        </div>
				            <div class="form-group">
						        <label id="thumbLabel" img-url="/Public/image/Uploads/" for="file_upload" class="col-sm-2 control-label">缩图:</label>
						        <div class="col-sm-5">
						            <input id="file_upload" name="file_upload" type="file" multiple="false" data-url="/Admin/Image/uploadThumbImage" swf-url="/Public/js/uploadify.swf" style="display:none;" img-url="/Public/image/Uploads/" ><!-- multiple="true" -->
						            <img style="display: none" id="upload_origin_img" src="<?php echo ($newsInfo["thumb"]); ?>" style="width:100%;">
						            <input id="upload_thumb_image" name="thumb" type="hidden" multiple="false" value="<?php echo ($newsInfo["thumb"]); ?>" multiple="true" ><!-- multiple="true" -->
						        </div>
				            </div>
				            <div class="form-group">
				              	<label for="newstitlecolor" class="col-sm-2 control-label">标题颜色:</label>
				              	<div class="col-sm-5">
				                	<select class="form-control" name="newstitlecolor" id="newstitlecolor">
				                  		<option value="-1"
				                  			<?php if(-1 == $newsInfo.titlecolor): ?>selected="selected"<?php endif; ?>
				                  		>==请选择颜色==</option>
				                    	<?php if(is_array($newsTitleColor)): foreach($newsTitleColor as $key=>$color): ?><option value="<?php echo ($key); ?>"
												<?php if($key == $newsInfo['titlecolor']): ?>selected="selected"<?php endif; ?>
				                      		><?php echo ($color); ?></option><?php endforeach; endif; ?>
				                	</select>
				              	</div>
				            </div>
				            <div class="form-group">
				              	<label for="newsprogram" class="col-sm-2 control-label">所属栏目:</label>
				              	<div class="col-sm-5">
				                	<select class="form-control" name="newsprogram" id="newsprogram" >
				                  		<option value="-1"
					                  		<?php if(-1 == $newsInfo['program_id']): ?>selected="selected"<?php endif; ?>
				                  		>==请选择栏目==</option>
				                  		<?php if(is_array($newsProgram)): foreach($newsProgram as $key=>$program): ?><option value="<?php echo ($program["menu_id"]); ?>"
					                    		<?php if($program["menu_id"] == $newsInfo['program_id']): ?>selected="selected"<?php endif; ?>
				                    		><?php echo ($program["name"]); ?></option><?php endforeach; endif; ?>
				                	</select>
				              	</div>
				            </div>
				            <div class="form-group">
				              	<label for="newscopyfrom" class="col-sm-2 control-label">来源:</label>
				              	<div class="col-sm-5">
				                	<select class="form-control" name="newscopyfrom" id="newscopyfrom">
					                 	<option value="-1"
						                 	<?php if(-1 == $newsInfo.copyfrom): ?>selected="selected"<?php endif; ?>
					                 	>==请选择来源==</option>
					                 	<?php if(is_array($newsCopyFrom)): foreach($newsCopyFrom as $key=>$from): ?><option value="<?php echo ($key); ?>"
						                    	<?php if($key == $newsInfo['copyfrom']): ?>selected="selected"<?php endif; ?>
					                    	><?php echo ($from); ?></option><?php endforeach; endif; ?>
				                </select>
				              </div>
				            </div>
				            <div class="form-group">
				              	<label for="news_editor_area" class="col-sm-2 control-label">内容:</label>
				              	<div class="col-sm-10">
				                <textarea class="input js-editor" id="news_editor_area" name="newscontent" rows="20" attr-imguploadurl="/Admin/Image/uploadNewsImage" ><?php echo (html_entity_decode($newsInfo["content"])); ?></textarea>
				              	</div>
				            </div>
				            <div class="form-group">
				              	<label for="newsdescription" class="col-sm-2 control-label">描述:</label>
				              	<div class="col-sm-5">
				                	<input type="text" class="form-control" name="newsdescription" id="newsdescription" placeholder="描述" value="<?php echo ($newsInfo["description"]); ?>">
				              	</div>
				            </div>
				            <div class="form-group">
				              	<label for="newskeywords" class="col-sm-2 control-label">关键字:</label>
				              	<div class="col-sm-5">
				               		<input type="text" class="form-control" name="newskeywords" id="newskeywords" placeholder="请填写关键词" value="<?php echo ($newsInfo["keywords"]); ?>">
				              	</div>
				            </div>
				            <div class="form-group">
				              	<div class="col-sm-offset-2 col-sm-10">				           
				                	<button type="button" class="btn btn-default" id="btn_edit_news_submit" data-url="/Admin/News/editNews" attr-id="<?php echo ($newsInfo["news_id"]); ?>">提交</button>
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
<script type="text/javascript" src="/Public/kindeditor/kindeditor-all-min.js"></script>
<script type="text/javascript" src="/Public/js/jquery.uploadify.min.js"></script>
<script type="text/javascript">
	    var imgPathPre=$("#thumbLabel").attr("img-url");
	    var newsImgUploadUrl=$("#news_editor_area").attr("attr-imguploadurl");
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

	    KindEditor.ready(function(k){
	        window.editor=k.create("#news_editor_area",{
	            width : "100%",
	            filterMode : true,
	            themeType: "simple",
	            colorTable: [
	                ['#E53333', '#E56600', '#FF9900', '#64451D', '#DFC5A4', '#FFE500'],
	                ['#009900', '#006600', '#99BB00', '#B8D100', '#60D978', '#00D5FF'],
	                ['#337FE5', '#003399', '#4C33E5', '#9933E5', '#CC33E5', '#EE33EE'],
	                ['#FFFFFF', '#CCCCCC', '#999999', '#666666', '#333333', '#000000'],
	                ['#f6f6f6', '#214ef7', '#f8f8f8', '#ff6600', '#444444', '#777777']
	            ],
	            uploadJson: newsImgUploadUrl,
	            filePostName: "KindEditorimgFile",
	        });
	    });

	    //文件开始编辑前是否显示缩略图
	    var thumbpath = "<?php echo ($newsInfo["thumb"]); ?>";
	    if(thumbpath){
	    	$("#upload_origin_img").show();
	    }
</script>
</html>