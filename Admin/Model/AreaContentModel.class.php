<?php

namespace Admin\Model;
use Think\Model;

class AreaContentModel extends Model{
	protected $trueTableName = "";

	protected $_validate = array(
		array('area_id','require','所属区域ID号必须存在'),
		array('title','require','标题必须存在'),
		array('thumb','require','缩略图必须存在'),
		array('createtime','require','创建时间必须存在'),
		array('updatetime','require','更新时间必须存在'),
	);


	public function getCounts($condition){
		if(is_null($condition)|| !is_array($condition)){
			return $this->count();
		}
		return $this->where($condition)->count();
	}

	/**
	 * 添加新的区域内容
	 * @param [type] $areaContentInfo [description]
	 */
	public function addData($areaContentInfo){
		$data=null;
		if($this->create($areaContentInfo)){
			$areaContentId = $this->add();
			$status=0;
			$msg="给指定区域推送内容成功";
			$data["id"]=$areaContentId;
		}else{
			$status=1;
			$msg=$this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	public function showDataByPage($condition, $page=1){
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

	public function updateOrderById($order, $areaContentId){
		if(is_null($areaContentId)|| !is_numeric($areaContentId) || ($order<0)){
			E("更改区域内容排序时传入的区域内容ID或者排序值不合法");
		}else{
			$data=array(
				"order"=> intval($order),
			);
			$condition=array(
				"id" => array("eq", $areaContentId),
			);
			return $this->where($condition)->save($data);
		}
	}

	/**
	 * 获取指定ID的区域内容
	 */
	public function getAreaContentInfoById($areaContentId){
		if(is_null($areaContentId) || !is_numeric($areaContentId)){
			return null;
		}else{
			$condition = array(
				"id" => array("eq", $areaContentId),
			);
			return $this->where($condition)->find();
		}
	}

	public function deleteAreaContent($areacontentId){
		$data = null;
		$condition["id"] = $areacontentId;
		$data["status"]= -1;
		if(FALSE!==($res = $this->where($condition)->save($data))){
			$status = 0;
			$msg = "删除区域内容成功";
		}else{
			$status = 1;
			$msg = $this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	public function editAreaContent($areacontentInfo){
		$data=null;
		if(($areacontentId = $this->save($areacontentInfo))!==FALSE){
			$status = 0;
			$msg = "修改区域内容成功";
		}else{
			$status = 1;
			$msg=$this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}
}