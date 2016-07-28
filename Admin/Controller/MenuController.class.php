<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;

class MenuController extends CommonController{

	/**
	 * 菜单管理首页的逻辑：
	 * 1. 菜单搜索采用post方式发送搜索数据
	 * 2. 分页方式显示菜单数据
	 * 3. 数据发送url不要带参数，使用__ACTION__即可
	 *
	 * 页面进入时，判断请求方式
	 * 1. 通过Url地址获取参数，包括: 菜单搜索类型值, 查询页码数
	 *    a. type = -1 表示全部类型菜单
	 *    b. type = 0  表示前台菜单
	 *    b. type = 1  表示后台菜单
	 *    查询数据库获取相应菜单数据，分页展示。
	 *    通过页码数和每页展示的条目数计算出当前页码所对应的数据起始值并查询出菜单数据
	 *    使用TP自带分页类实现分页导航
	 * @return [type] [description]
	 */
	public function index(){
		$condition=array();
		$Menu = D("Menu");
		$menutype=I("param.searchMenuType/d",-1);
		$page = I("param.p/d", 1);
		if($menutype == -1){
			$condition=array(
				"type" => array("neq", $menutype),
			);
		}else{
			$condition=array(
				"type" => array("eq", $menutype),
			);
		}

		$condition["status"]=array("neq","-1");
		$count = $Menu->getMenusCount($condition);
		$pageTool = new Page($count, C("PAGE_ROWS"));
		$pageTool->setConfig("theme",'%HEADER%&nbsp;当前第%NOW_PAGE%页&nbsp;&nbsp;%FIRST%&nbsp;%UP_PAGE%&nbsp;%LINK_PAGE%&nbsp;%DOWN_PAGE%&nbsp;%END%&nbsp;总共%TOTAL_PAGE%页');
		$pageTool->setConfig("prev","上一页");
		$pageTool->setConfig("next","下一页");
		$show = $pageTool->show();
		$data = $Menu->showMenusByType($condition, $page);
		$this->assign("menushow",$show);
		$this->assign("menulist",$data);
		$this->assign("curMenuType",$menutype);
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
			$menuType=I("post.menuType/d");
			$menuModule=I("post.menuModule");
			$menuController=I("post.menuController");
			$menuAction=I("post.menuAction");
			$menuDesp=I("post.MenuDesp");
			$menustatus=I("post.Menustatus/d");
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
	public function modifyMenu(){
		$Menu = D("Menu");
		$this->assign("nav_title","修改");
		if(IS_GET){
			$menuId=I("get.id",-1);
			$menuInfo=$Menu->getMenuInfoById($menuId);
			$this->assign("menuInfo",$menuInfo);
			$this->display();
		}else if(IS_POST){
			$menuId=I("post.menuId/d",-1);
			$menuName=I("post.menuName");
			$menuType=I("post.menuType");
			$menuModule=I("post.menuModule");
			$menuController=I("post.menuController");
			$menuAction=I("post.menuAction");
			$menuDesp=I("post.menuDesp");
			$menuStatus=I("post.menuStatus");
			$menuInfo=array(
				"menu_id"=>$menuId,
				"name"=>$menuName,
				"type"=>$menuType,
				"module"=>$menuModule,
				"controller"=>$menuController,
				"action"=>$menuAction,
				"status"=>$menuStatus,
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
	public function deleteMenu(){
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
	 * 重新排序菜单展示顺序
	 * @return [type] [description]
	 */
	public function orderMenu(){
		$url = I("server.http_referer");
		if(IS_POST){
			$Menu=D("Menu");
			$errors=array();
			$data = I("post.order/a");
			if($data){
				try {
					foreach ($data as $menuId => $order){
						$res = $Menu->updateMenuOrderById($order, $menuId);
						if($res===FALSE){
							$errors[]=$menuId;
						}
					}
				}catch(Exception $e){
					return AJAXResult(3, "排序失败--".implode(",",$errors).",发生异常:".$e->getMessage(), array("url"=>$url));
				}
				if($errors){
					return AJAXResult(2, "排序失败--".implode(",",$errors), array("url"=>$url));
				}
				return AJAXResult(0, "排序成功", array("url"=>$url));
			}else{
				return AJAXResult(1, "传入的排序数据有误", array("url"=>$url));
			}
		}else{
			$this->redirect("index");
		}
	}

	/**
	 * 改变菜单显示状态
	 * @return [type] [description]
	 */
	public function updateStatus(){
		if(IS_POST){
			$Menu = D("Menu");
			$menuId = I("post.id/d");
			if($menuId){
				try{
					$result = $Menu->updateMenuStatus($menuId, 0);
					if($result!==FALSE){
						// $url=__CONTROLLER__."/index";
						$url=I("server.http_referer");
					}else{
						$url=__CONTROLLER__."/".__FUNCTION__;
					}
				}catch(Exception $e){
					return AJAXResult(2,"更新菜单状态产生异常",array("url"=>$url));
				}
				return AJAXResult(0,"更新菜单状态成功",array("url"=>$url));
			}else{
				return AJAXResult(1,"未指定修改的菜单ID号",array("url"=>$url));
			}
		}else{
			$this->redirect("index");
		}
	}

}