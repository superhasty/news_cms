<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 
*/
class IndexController extends Controller
{
	//首页
	public function index(){
		//检查session判断直接是否登陆
		//如果登陆账号则进入首页，否则跳转到登陆页面
		if(session("username")){
			$Admin = D("Admin");
			$realName = $Admin->getRealNameByUserId(session("userid"));
			$this->assign("adminName", $realName);
			$this->display();
		}else{
			$this->redirect("login");
		}
	}

	public function login(){
		$this->display();
	}

	public function logout(){
		session(null);
		$this->redirect("login");
	}

	//ajax接口
	public function check(){
		$result=array();
		$username = I("post.username");
		$password = I("post.password");
		$Admin = D("Admin");
		$result = $Admin->isValidUser($username,$password);
		if($result["status"]==0){
			session("username",$result["data"]["username"]);
			session("userid",$result["data"]["admin_id"]);
			$url=__CONTROLLER__."/index";
		}else{
			$url=__CONTROLLER__."/login";
		}
		echo AJAXResult($result["status"],$result["msg"],array("url"=>$url));
	}
}