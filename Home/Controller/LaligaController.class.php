<?php

namespace Home\Controller;
use Think\Controller;

class LaligaController extends CommonController{
	public function index(){
		if(IS_POST){

		}else{
			$this->getColumn();
		}
	}
}