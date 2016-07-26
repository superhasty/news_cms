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
	 * 添加菜单
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
	 * 排序规则：优先考虑自定义排序字段order
	 * @param  [type] $condition [description]
	 * @param  [type] $page      [description]
	 * @return [type]            [description]
	 */
	public function showMenusByType($condition, $page){
		$start = ($page-1)*C("PAGE_ROWS");
		$defCondition = array(
			"status" => array("neq", "-1"),
		);
		if(is_null($condition)|| !is_array($condition)){
			return $this->where($defCondition)->order("`order` desc")->limit($start, C("PAGE_ROWS"))->select();
		}else{
			$con=array_merge($condition, $defCondition);
			$res = $this->where($con)->order("`order` desc")->limit($start, C("PAGE_ROWS"))->select();
			return $res;
		}
	}


	/**
	 * 删除菜单
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
		return $this->where($condition)->order("`order` desc")->select();
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

	/**
	 * 获取满足条件的菜单数目
	 * @param  [type] $condition [description]
	 * @return [type]            [description]
	 */
	public function getMenusCount($condition){
		if(is_null($condition)||!is_array($condition)){
			return $this->count();
		}else{
			return $this->where($condition)->count();
		}
	}

	/**
	 * 更改指定菜单ID的排序权值
	 * @param  [type] $order  [description]
	 * @param  [type] $menuId [description]
	 * @return [type]         [description]
	 */
	public function updateMenuOrderById($order, $menuId){
		if(is_null($menuId)|| !is_numeric($menuId) || ($order<0)){
			E("更改菜单排序时传入的菜单ID或者排序值不合法");
		}else{
			$data=array(
				"order"=> intval($order),
			);
			$condition=array(
				"menu_id" => array("eq", $menuId),
			);
			return $this->where($condition)->save($data);
		}
	}
}