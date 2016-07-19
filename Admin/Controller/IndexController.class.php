<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 
*/
class IndexController extends Controller
{
	public function login(){
		if(IS_POST){
			/*$User = D("User");
			$username = I("post.username");
			$password = I("post.password");
			if($User->isValidUser($username,$password)){
				$this->redirect("__MODULE__/Index/index");
			}else{
				// $error = $User->getError();
				$this->redirect(__FUNCTION__);
			}*/

			$username = I("post.username");
			$password = I("post.password");
			$this->redirect("Index/index");
		}else{
			$this->display();
		}
	}

	//登陆后的首页
	public function index(){
		$this->display();
	}

	public function check(){
		$result=array();
		$username = I("post.username");
		$password = I("post.password");
		if($username && $password){
			$result["msg"]=true;
		}else{
			$result["msg"]=false;
		}
		echo json_encode($result);
	}
}