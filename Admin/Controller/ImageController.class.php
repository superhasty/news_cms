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
			$data = uploadImage("./Public/image/Uploads/");
			if($data["status"]==0){
				return AJAXResult($data["status"], $data["error"], $data["data"]);
			}else{
				return AJAXResult($data["status"], $data["error"]);
			}
		}else{
			$this->redirect("index/index");
		}
	}

	public function uploadNewsImage(){
		if(IS_POST){
			$data = uploadImage("./Public/image/News/");
			if($data["status"]==0){
				$error = $data["status"];

				$url = APP_PATH."../../Public/image/News/".$data["data"]["imgFile"]["savepath"].$data["data"]["imgFile"]["savename"];
				KindUploadResult($error, $url);
			}else{
				$error = 1;
				$url = "上传失败";
				KindUploadResult($error, $url);
			}
		}else{
			$this->redirect("index/index");
		}
	}
}