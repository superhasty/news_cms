<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 
*/
class IndexController extends Controller
{
	public function login(){
		/*if(IS_POST){
			$User = D("User");
			$username = I("post.username");
			$password = I("post.password");
			if($User->isValidUser($username,$password)){
				$this->redirect("Index/index");
			}else{
				$func = __FUNCTION__;
				$this->redirect($func);
			}
		}else{
			$this->display();
		}*/

		$this->display();
	}

	//登陆后的首页
	public function index(){
		$this->display();
	}

	public function check(){
		$result=array();
		$username = I("post.username");
		$password = I("post.password");
		// simulate login success or fail
		/*if($username && $password){
			$result["msg"]=true;
		}else{
			$result["msg"]=false;
		}
		echo json_encode($result);*/

		// real validate with database
		$Admin = D("Admin");
		$result = $Admin->isValidUser($username,$password);
		if($result["status"]==0){
			session("username",$result["data"]["username"]);
			session("userid",$result["data"]["admin_id"]);
		}
		echo AJAXResult($result["status"],$result["msg"]);
	}
}