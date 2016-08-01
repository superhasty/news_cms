<?php

namespace Admin\Controller;
use Think\Controller;

class BasicController extends CommonController{
	//配置网站基本信息：Keywords, title, description
	public function index(){
		if(IS_POST){
			$keywords=I("post.keywords",null);
			$title=I("post.title",null);
			$description=I("post.description",null);
			if(!$keywords || !$title || !$description){
				$this->redirect( __CONTROLLER__."/".__FUNCTION__ );
			}else{
				$data=array(
					"keywords"=> $keywords,
					"title"=> $title,
					"description"=> $description,
				);
				$res = F("basic_web_config", $data);
				$url = __CONTROLLER__."/".__FUNCTION__;
				if($res === FALSE){
					AJAXResult(1,"修改基本配置失败",array("url"=>$url));
				}else{
					AJAXResult(0,"修改基本配置成功",array("url"=>$url));
				}
			}
		}else{
			$this->assign("type",1);
			$this->display();
		}
	}

	public function cache(){
		$this->assign("type",2);
		$this->display();
	}

}