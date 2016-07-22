<?php
/* 系统公共函数库*/


use Think\Upload;

/**
 * 公共函数：返回 ajax请求的结果
 * @param  [integer] $status [错误码]
 * @param  [string] $msg    [描述信息]
 * @param  array  $data   [结果数据]
 * @return [json]         [返回json格式数据]
 */
function AJAXResult($status, $msg, $data=array()){
	$result = array(
		"status" => $status,
		"msg" => $msg,
		"data" => $data
	);
	exit(json_encode($result));
}

/**
 * 公共函数: 返回MD5加密后的密码数据
 * @param [type] $password [description]
 * @param [type] $key      [description]
 */
function lock_md5($password){
	return md5($password.C("MD5_KEY"));
}

/**
 * [parseStatus description]
 * @param  [type] $status [description]
 * @return [type]         [description]
 */
function getMenuStatus($status){
	switch($status){
		case '0':
			$name = "关闭";
			break;
		case "1":
			$name = "开启";
			break;
		case "-1":
			$name = "删除";
			break;
		default:
			break;
	}
	return $name;
}

function getMenuTypeName($type){
	switch($type){
		case '0':
			$name = "前端栏目";
			break;
		case "1":
			$name = "后台菜单";
			break;
		default:
			break;
	}
	return $name;
}

function isActive($navController){
	$cur = CONTROLLER_NAME;
	if(strtolower($navController) == strtolower($cur)){
		return "active";		
	}else{
		return "";
	}
}

function uploadImage(){
	$upload = new Upload();
	$upload->exts=array("jpg","jpeg","png","gif","bmp");
	$upload->rootPath="./Public/image/Uploads/";

	if(($res=$upload->upload())){
		$data["status"]=0;
		$data["error"]="";
		$data["data"]=$res;
	}else{
		$data["status"]=1;
		$data["error"]=$upload->getError();
		$data["data"]=null;
	}
	return $data;
}