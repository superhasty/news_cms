<?php

namespace Admin\Controller;
use Think\Controller;

class ImageController extends Controller{
	/**
	 * 上传新闻缩略图
	 * @return [type] [description]
	 */
	public function uploadThumbImage(){
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
			dump($_FILES);
			exit();
			$data = uploadImage("./Public/image/News/");
			if($data["status"]==0){
				$error = $data["status"];

				// $url = ROOT_URL."/Public/image/News/".$data["data"]["imgFile"]["savepath"].$data["data"]["imgFile"]["savename"];
				$url = ROOT_URL."/Public/image/News/".$data["data"]["KindEditorimgFile"]["savepath"].$data["data"]["KindEditorimgFile"]["savename"];

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