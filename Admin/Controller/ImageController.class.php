<?php

namespace Admin\Controller;
use Think\Controller;

class ImageController extends Controller{
	/**
	 * 
	 * @return [type] [description]
	 */
	public function uploadImage(){
		if(IS_POST){
			$data = uploadImage();
			if($data["status"]==0){
				return AJAXResult($data["status"], $data["error"], $data["data"]);
			}else{
				return AJAXResult($data["status"], $data["error"]);
			}
		}else{
			$this->redirect("index/index");
		}
	}
}