<?php
namespace Admin\Model;
use Think\Model;
use Think\Page;

class MenuModel extends Model{
	protected $trueTableName = "cms_menu";

	protected $_validate = array(
		array("name","require","菜单名必须存在"),
		array('type','require','菜单类型必须存在'),
		array('type','array(0,1)','菜单类型值不符合要求',"2","in"),
		array('status','require','菜单状态必须存在'),
		array('status','array(0,1,-1)','菜单状态值不符合要求',"2","in"),
	);

	/**
	 * [addMenu description]
	 * @param [type] $menuInfo [description]
	 */
	public function addMenu($menuInfo){
		$data=null;
		if($this->create($menuInfo)){
			$this->add();
			$status=0;
			$msg="添加菜单成功";
		}else{
			$status=1;
			$msg=$this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	/**
	 * 修改菜单
	 * @param  [type] $menuInfo [description]
	 * @return [type]           [description]
	 */
	public function modifyMenu($menuInfo){
		$data=null;
		if($this->data($menuInfo)){
			$this->save();
			$status=0;
			$msg="修改菜单成功";
		}else{
			$status=1;
			$msg=$this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	/**
	 * 根据菜单类型分页展示菜单信息
	 * @return [type] [description]
	 */
	public function showMenusByType($menutype){
		if(!isset($menutype) || !in_array(intval($menutype), array(0,1))){
			$condition = array("status"=>array("neq","-1"));
			$count = $this->where($condition)->count();
		}else{
			$condition["type"]=array("eq",$menutype);
			$condition["status"]=array("neq","-1");
			$count = $this->where($condition)->count();
		}
		$page = new Page($count,C("PAGE_ROWS"));
		//'%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%'
		$page->setConfig("theme",'%HEADER%&nbsp;当前第%NOW_PAGE%页&nbsp;&nbsp;%FIRST%&nbsp;%UP_PAGE%&nbsp;%LINK_PAGE%&nbsp;%DOWN_PAGE%&nbsp;%END%&nbsp;总共%TOTAL_PAGE%页');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$show = $page->show();
		$list = $this->where($condition)->order("`order` desc")->limit($page->firstRow,$page->listRows)->select();
		return array("list"=>$list,"show"=>$show);
	}


	/**
	 * [delteMenu description]
	 * @param  [type] $menuId [description]
	 * @return [type]         [description]
	 */
	public function deleteMenu($menuId){
		$data = null;
		$condition["menu_id"] = $menuId;
		$data["status"]= -1;
		if(FALSE!==($res = $this->where($condition)->save($data))){
			$status = 0;
			$msg = "删除菜单成功";
		}else{
			$status = 1;
			$msg = $this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	public function getMenuInfoById($menuId){
		$condition["menu_id"]=$menuId;
		return $this->where($condition)->find();
	}

	/**
	 * 获取所有后台菜单信息
	 * @return [type] [description]
	 */
	public function getAdminMenuList(){
		$condition = array(
			"type" => array("eq", 1),
			"status"=> array("neq", -1),
		);
		return $this->where($condition)->select();
	}

	/**
	 * 获取所有前台菜单信息
	 * @return [type] [description]
	 */
	public function getWebSiteMenuList(){
		$condition = array(
			"type" => array("eq", 0),
			"status" => array("eq", 1),
		);
		return $this->where($condition)->select();
	}

	public function getWebSiteMenuNames(){
		$condition = array(
			"type" => array("eq", 0),
			"status" => array("eq", 1),
		);
		return $this->field("menu_id,name")->where($condition)->select();
	}

	public function getWebSiteMenuNameById($menuId){
		if($menuId==-1){
			return null;
		}
		$condition["menu_id"]=$menuId;
		return $this->field("name")->where($condition)->getField("name");
	}

	public function getWebSiteMenuIds(){
		$condition = array(
			"type" => array("eq", 0),
			"status" => array("eq", 1),
		);
		return $this->field("menu_id")->where($condition)->getField("menu_id",true);
	}
}