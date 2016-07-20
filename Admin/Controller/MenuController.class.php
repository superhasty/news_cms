<?php
namespace Admin\Controller;
use Think\Controller;

class MenuController extends CommonController{
	public function showlist(){
		$Menu = D("Menu");
		return $Menu->showlist();
	}

	public function index(){
		$data = $this->showlist();
		$this->assign("menulist",$data["list"]);
		$this->assign("menushow",$data["show"]);
		$this->assign("nav_title","预览");
		$this->display();
	}

	/**
	 * 添加新的菜单
	 */
	public function addMenu(){
		$this->assign("nav_title","新增");
		if(IS_POST){
			$menuName=I("post.menuName");
			$menuType=I("post.menuType");
			$menuModule=I("post.menuModule");
			$menuController=I("post.menuController");
			$menuAction=I("post.menuAction");
			$menuDesp=I("post.MenuDesp");
			$menustatus=I("post.Menustatus");
			$menuInfo=array(
				"name"=>$menuName,
				"type"=>$menuType,
				"module"=>$menuModule,
				"controller"=>$menuController,
				"action"=>$menuAction,
				"status"=>$menustatus,
				"description"=>$menuDesp
			);
			$Menu = D("Menu");
			$result = $Menu->addMenu($menuInfo);
			if($result["status"]==0){
				$url=__CONTROLLER__."/index";
			}else{
				$url=__CONTROLLER__."/".__FUNCTION__;
			}
			return AJAXResult($result["status"],$result["msg"],array("url"=>$url));
		}else{
			$this->display();
		}
	}

	/**
	 * [editMenu description]
	 * @return [type] [description]
	 */
	public function modifyMenu($menuId){
		$this->assign("nav_title","修改");
		if(IS_POST){
			$menuId=I("post.menuId");
			$menuName=I("post.menuName");
			$menuType=I("post.menuType");
			$menuModule=I("post.menuModule");
			$menuController=I("post.menuController");
			$menuAction=I("post.menuAction");
			$menuDesp=I("post.MenuDesp");
			$menustatus=I("post.Menustatus");
			$menuInfo=array(
				"menu_id"=>$menuId,
				"name"=>$menuName,
				"type"=>$menuType,
				"module"=>$menuModule,
				"controller"=>$menuController,
				"action"=>$menuAction,
				"status"=>$menustatus,
				"description"=>$menuDesp
			);
			$Menu = D("Menu");
			$result = $Menu->modifyMenu($menuInfo);
			if($result["status"]==0){
				$url=__CONTROLLER__."/index";
			}else{
				$url=__CONTROLLER__."/".__FUNCTION__;
			}
			return AJAXResult($result["status"],$result["msg"],array("url"=>$url));
		}else{
			$this->display();
		}
	}

	/**
	 * [deleteMenu description]
	 * @param  [type] $menuId [description]
	 * @return [type]         [description]
	 */
	public function deleteMenu($menuId = -1){
		// if(IS_POST || (IS_GET && !empty(I("get.id")))){
		// 	$this->assign("nav_title","删除");
		// 	//修改状态
		// 	$Menu = D("Menu");
		// 	$result = $Menu->delteMenu($menuId);
		// 	if($result["status"]==0){
		// 		$url=__CONTROLLER__."/index";
		// 	}else{
		// 		$url=__CONTROLLER__."/".__FUNCTION__;
		// 	}
		// 	return AJAXResult($result["status"],$status["msg"],array("url"=>$url));
		// }else{
		// 	$this->redirect("index");
		// }
		
		if(IS_GET){
			if(!empty(I("get.id"))){
				$this->assign("nav_title","删除");
				$Menu = D("Menu");
				$menuId = I("get.id");
				$result = $Menu->delteMenu($menuId);
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
	}
}