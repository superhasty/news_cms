<?php

/**
 * 公共方法：返回 ajax请求的结果
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
	return json_encode($result);
}

/**
 * 公共方法: 返回MD5加密后的密码数据
 * @param [type] $password [description]
 * @param [type] $key      [description]
 */
function lock_md5($password){
	return md5($password.C("MD5_KEY"));
}