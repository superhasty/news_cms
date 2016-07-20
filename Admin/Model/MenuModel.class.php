<?php
namespace Admin\Model;
use Think\Model;
use Think\Page;

class MenuModel extends Model{
	protected $trueTableName = "cms_menu";

	protected $_validate = array(
		array("name","require","菜单名必须存在"),
		array('type','require','菜单类型必须存在'),
		array('status','require','菜单状态必须存在')
	);

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
		if($this->data($data)){
			$this->save();
			$status=0;
			$msg="修改菜单成功";
		}else{
			$status=1;
			$msg=$this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	public function showlist(){
		$count = $this->count();
		$page = new Page($count,C("PAGE_ROWS"));
		//'%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%'
		$page->setConfig("theme",'%HEADER%&nbsp;当前第%NOW_PAGE%页&nbsp;&nbsp;%FIRST%&nbsp;%UP_PAGE%&nbsp;%LINK_PAGE%&nbsp;%DOWN_PAGE%&nbsp;%END%&nbsp;总共%TOTAL_PAGE%页');
		$page->setConfig("prev","上一页");
		$page->setConfig("next","下一页");
		$show = $page->show();
		$list = $this->order("`order` desc")->limit($page->firstRow,$page->listRows)->select();
		return array("list"=>$list,"show"=>$show);
	}


	/**
	 * [delteMenu description]
	 * @param  [type] $menuId [description]
	 * @return [type]         [description]
	 */
	public function delteMenu($menuId){
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
}