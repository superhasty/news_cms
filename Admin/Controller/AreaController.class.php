<?php

namespace Admin\Controller;
use Think\Controller;

class AreaController extends CommonController{
	/**
	 * 首页
	 * @return [type] [description]
	 */
	public function index(){
		$Area = D("Area");
		$areaInfos=$Area->getAreaInfos();
		$this->assign("areaInfos",$areaInfos);
		$this->assign("nav_title","预览");
		$this->display();
	}

	/**
	 * 添加推送区域
	 */
	public function addArea(){
		$this->assign("nav_title","新增");
		if(IS_POST){
			$areaName=I("post.areaName");
			$areaStatus=I("post.areaStatus/d");
			$areaDesp=I("post.areaDesp");
			$areaInfo=array(
				"name"=>$areaName,
				"status"=>$areaStatus,
				"description"=>$areaDesp,
				"createtime"=>time(),
				"updatetime"=>time()
			);
			$Area = D("Area");
			$result = $Area->addArea($areaInfo);
			if($result["status"]==0){
				$url= __CONTROLLER__."/index";
			}else{
				$url= __CONTROLLER__."/".__FUNCTION__;
			}
			return AJAXResult($result["status"],$result["msg"],array("url"=>$url));
		}else{
			$this->display();
		}
	}

	/**
	 * 删除推送区域
	 * @return [type] [description]
	 */
	public function deleteArea(){
		if(IS_POST){
			$Area = D("Area");
			$areaId = I("get.id",-1);
			$result = $Area->deleteArea($areaId);
			if($result["status"]==0){
				$url=__CONTROLLER__."/index";
			}else{
				$url=__CONTROLLER__."/".__FUNCTION__;
			}
			return AJAXResult($result["status"],$status["msg"],array("url"=>$url));
		}else{
			$this->redirect("index");
		}
	}

	/**
	 * 编辑推送区域
	 * @return [type] [description]
	 */
	public function editArea(){
		$Area = D("Area");
		$this->assign("nav_title","修改");
		if(IS_GET){
			$areaId=I("get.id/d",-1);
			$areaInfo=$Area->getAreaInfoById($areaId);
			$this->assign("areaInfo",$areaInfo);
			$this->display();
		}else if(IS_POST){
			$areaId=I("post.areaId",-1);
			$areaName=I("post.areaName");
			$areaDesp=I("post.areaDesp");
			$areaInfo=array(
				"id"=>$areaId,
				"name"=>$areaName,
				"description"=>$areaDesp,
				"updatetime"=>time()
			);
			$result = $Area->editArea($areaInfo);
			if($result["status"]==0){
				$url=__CONTROLLER__."/index";
			}else{
				$url=__CONTROLLER__."/".__FUNCTION__;
			}
			return AJAXResult($result["status"],$result["msg"],array("url"=>$url));
		}
	}

	/**
	 * 排序推送区域
	 * @return [type] [description]
	 */
	// public function orderArea(){

	// }

	/**
	 * 改变区域显示状态
	 * @return [type] [description]
	 */
	public function updateStatus(){
		if(IS_POST){
			$Area = D("Area");
			$areaId = I("post.id/d");
			if($areaId){
				try{
					$result = $Area->updateAreaStatus($areaId, 0);
					if($result!==FALSE){
						$url=__CONTROLLER__."/index";
					}else{
						$url=__CONTROLLER__."/".__FUNCTION__;
					}
				}catch(Exception $e){
					return AJAXResult(2,"更新区域显示状态产生异常",array("url"=>$url));
				}
				return AJAXResult(0,"更新区域显示状态成功",array("url"=>$url));
			}else{
				return AJAXResult(1,"未指定修改的区域ID号",array("url"=>$url));
			}
		}else{
			$this->redirect("index");
		}
	}
}