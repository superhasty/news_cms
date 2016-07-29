<?php

namespace Home\Controller;
use Think\Controller;

class EnglandController extends CommonController{
	public function index(){
		if(IS_POST){
			$this->redirect("index/index");
		}else{
			$this->getColumn();
		}
	}
}