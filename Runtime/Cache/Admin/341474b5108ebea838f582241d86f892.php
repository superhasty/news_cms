<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>内容管理平台</title>
	<link rel="stylesheet" type="text/css" href="/news_imooc/project-demo/news_cms/Public/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/news_imooc/project-demo/news_cms/Public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/news_imooc/project-demo/news_cms/Public/css/admin/index.css">
</head>
<body>
	<div class="s_center container col-lg-6 ">

		<!-- 普通POST方法登陆 -->
	    <!-- <form action="#" class="form-signin" enctype="multipart/form-data"  method="post">
	      <h2 class="form-signin-heading">请登录</h2>
	      <label class="sr-only">用户名</label>
	      <input type="text"  class="form-control" name="username" placeholder="请填写用户名" required autofocus>
	      <br />
	      <label  class="sr-only">密码</label>
	      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="密码" required>
	      <br />
	      <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
	    </form> -->

		<!-- AJAX方式登陆 -->
	    <form action="#" class="form-signin" enctype="multipart/form-data" method="post">
	      <h2 class="form-signin-heading">请登录</h2>
	      <label class="sr-only">用户名</label>
	      <input type="text"  class="form-control" name="username" id="inputUsername" placeholder="请填写用户名" required autofocus>
	      <br />
	      <label  class="sr-only">密码</label>
	      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="密码" required>
	      <br />
	      <button class="btn btn-lg btn-primary btn-block" type="button" id="btn_login">登录</button>
	    </form>
	</div>
	<script type="text/javascript" src="/news_imooc/project-demo/news_cms/Public/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/news_imooc/project-demo/news_cms/Public/js/layer/layer.js"></script>
	<script type="text/javascript" src="/news_imooc/project-demo/news_cms/Public/js/dialog.js"></script>
	<script type="text/javascript" src="/news_imooc/project-demo/news_cms/Public/js/admin/index.js"></script>
</body>
</html>