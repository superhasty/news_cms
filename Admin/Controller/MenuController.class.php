<?php
namespace Admin\Controller;
use Think\Controller;

class MenuController extends CommonController{
	public function index(){
		//获取菜单类型
		$menutype=null;
		if(IS_POST){
			$menutype=I("post.searchMenuType/d",-1);
		}
		$Menu = D("Menu");
		$data = $Menu->showMenusByType($menutype);

		// 系统自带分页类
		$this->assign("menulist",$data["list"]);
		$this->assign("menushow",$data["show"]);
		// dump($data["list"]);
		// dump($data["show"]);
		 
		// 获取type类型
		
		// $page = I("param.p", "1");
		// $pagesize = C("PAGE_ROWS");
		// $count = ($page-1)*$pagesize;
		



		$this->assign("curMenuType",isset($menutype)?$menutype:-1);
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
	 * [editMenu description]
	 * @return [type] [description]
	 */
	public function modifyMenu($menuId = -1){
		$Menu = D("Menu");
		$this->assign("nav_title","修改");
		if(IS_GET){
			$menuId=I("get.id",$menuId);
			$menuInfo=$Menu->getMenuInfoById($menuId);
			$this->assign("menuInfo",$menuInfo);
			$this->display();
		}else if(IS_POST){
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
			$result = $Menu->modifyMenu($menuInfo);
			if($result["status"]==0){
				$url=__CONTROLLER__."/index";
			}else{
				$url=__CONTROLLER__."/".__FUNCTION__;
			}
			return AJAXResult($result["status"],$result["msg"],array("url"=>$url));
		}
	}

	/**
	 * [deleteMenu description]
	 * @param  [type] $menuId [description]
	 * @return [type]         [description]
	 */
	public function deleteMenu($menuId = -1){	
		if(IS_POST){
			$this->assign("nav_title","删除");
			$Menu = D("Menu");
			$menuId = I("get.id",$menuId);
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


}