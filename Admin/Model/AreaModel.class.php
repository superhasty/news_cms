<?php

namespace Admin\Model;
use Think\Model;

class AreaModel extends Model{
	protected $trueTableName="cms_area";

	protected $_validate = array(
		array("name","require","区域名称必须存在"),
		array('status','require','区域状态必须存在'),
		array('status','array(0,1,-1)','区域状态值不符合要求',"2","in"),
	);

	/**
	 * 添加区域
	 * @param [type] $areaInfo [description]
	 */
	public function addArea($areaInfo){
		$data=null;
		if($this->create($areaInfo)){
			$this->add();
			$status=0;
			$msg="添加区域成功";
		}else{
			$status=1;
			$msg=$this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	/**
	 * 编辑区域
	 * @param  [type] $areaInfo [description]
	 * @return [type]           [description]
	 */
	public function editArea($areaInfo){
		$data=null;
		if($this->data($areaInfo)){
			$this->save();
			$status=0;
			$msg="修改区域成功";
		}else{
			$status=1;
			$msg=$this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	/**
	 * 删除指定ID号的区域
	 * @param  [type] $areaId [description]
	 * @return [type]         [description]
	 */
	public function deleteArea($areaId){
		$data = null;
		$condition["id"] = $areaId;
		$data["status"]= -1;
		if(FALSE!==($res = $this->where($condition)->save($data))){
			$status = 0;
			$msg = "删除区域成功";
		}else{
			$status = 1;
			$msg = $this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	/**
	 * 获取所有的区域名称
	 * @return [type] [description]
	 */
	public function getAreaNames(){
		$condition=array(
			"status" => array("neq", -1),
		);
		return $this->field("name")->where($condition)->select();
	}

	/**
	 * 获取所有有效的区域信息(status!=-1)
	 * @return [type] [description]
	 */
	public function getAreaInfos(){
		$condition=array(
			"status" => array("neq", -1),
		);
		return $this->where($condition)->select();
	}

	/**
	 * 通过指定ID号获取对应区域信息
	 * @param  [type] $areaId [description]
	 * @return [type]         [description]
	 */
	public function getAreaInfoById($areaId){
		if(is_null($areaId) || !is_numeric($areaId)){
			E("传入的区域ID不合法");
		}else{
			$condition=array(
				"id" => array("eq", $areaId),
			);
			return $this->where($condition)->select();
		}
	}

	/**
	 * 更改指定区域ID的排序权值
	 * @param  [type] $order  [description]
	 * @param  [type] $areaId [description]
	 * @return [type]         [description]
	 */
	// public function updateAreaOrderById($order, $areaId){

	// }

	/**
	 * 通过指定ID号修改对应区域的显示状态
	 * @param  [type] $areaId [description]
	 * @param  [type] $status [description]
	 * @return [type]         [description]
	 */
	public function updateMenuStatus($areaId,$status){
		if(is_null($areaId) || !is_numeric($areaId)){
			E("更改区域状态时传入的区域ID不合法");
		}elseif(is_null($status) || !is_numeric($status)){
			E("更改区域状态时传入的状态值不合法");
		}else{
			$condition=array(
				"id" => array("eq", $areaId),
			);
			$data=array(
				"status" => $status
			);
			return $this->where($condition)->save($data);
		}
	}

}