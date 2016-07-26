<?php

namespace Admin\Area;
use Think\Area;

class AreaController extends Area{
	/**
	 * 首页
	 * @return [type] [description]
	 */
	public function index(){
		
	}

	/**
	 * 添加推送区域
	 */
	public function addArea(){
		$this->assign("nav_title","新增");
		if(IS_POST){
			$areaName=I("post.AreaName");
			$areaStatus=I("post.AreaStatus/d");
			$areaDesp=I("post.AreaDesp");
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
			$Menu = D("Menu");
			$menuId = I("get.id",-1);
			$result = $Menu->deleteMenu($menuId);
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