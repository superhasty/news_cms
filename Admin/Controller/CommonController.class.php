<?php
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller{
	public function __construct(){
		parent::__construct();
		$this->init();
	}

	public function init(){
		//检查是否登陆系统
		if(!$this->isLogin()){
			$this->redirect("index/login");
		}
	}

	private function isLogin(){
		if(session("username")){
			return true;
		}
		return false;
	}
}