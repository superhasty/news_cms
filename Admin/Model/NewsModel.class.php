<?php
namespace Admin\Model;
use Think\Model;

class NewsModel extends Model{
	protected $trueTableName="cms_news";

	protected $_validate = array(
		array("title","require","新闻标题必须存在"),
		array('description','require','新闻简介必须存在'),
		// array('copyfrom','array(0,1,2,3,4)','菜单类型必须存在',2,'in'),
		array('copyfrom','require','新闻来源必须存在'),
	);

	/**
	 * 添加新闻摘要信息
	 * @param [type] $newsInfo [description]
	 */
	public function addNews($newsInfo){
		$data=null;
		if($this->create($newsInfo)){
			$newsId = $this->add();
			$status=0;
			$msg="添加新闻摘要信息成功";
			$data["id"]=$newsId;
		}else{
			$status=1;
			$msg=$this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	/**
	 * 修改新闻摘要信息
	 * @param [type] $newsInfo [description]
	 */
	public function editNews($newsInfo){
		$data=null;
		if(($newsId = $this->save($newsInfo))!==FALSE){
			$status=0;
			$msg="修改新闻摘要信息成功";
		}else{
			$status=1;
			$msg=$this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	/**
	 * 根据新闻栏目分页展示新闻信息
	 * @param  [type]  $condition [description]
	 * @param  integer $page      [description]
	 * @return [type]             [description]
	 */
	public function showNewsByProgram($condition, $page=1){
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

	public function getNewsCount($condition){
		if(is_null($condition)|| !is_array($condition)){
			return $this->count();
		}
		return $this->where($condition)->count();
	}

	public function getNewsInfoById($newsId){
		if(is_null($newsId) || !is_numeric($newsId)){
			return null;
		}else{
			$condition=array(
				"news_id" => array("eq", $newsId),
			);
			return $this->where($condition)->find();
		}
	}

	public function deleteNews($newsId){
		$data = null;
		$condition["news_id"] = $newsId;
		$data["status"]= -1;
		if(FALSE!==($res = $this->where($condition)->save($data))){
			$status = 0;
			$msg = "删除新闻摘要成功";
		}else{
			$status = 1;
			$msg = $this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	public function updateNewsStatus($newsId, $status){
		if(is_null($newsId) || !is_numeric($newsId)){
			E("更改新闻状态时传入的新闻ID不合法");
		}elseif(is_null($status) || !is_numeric($status)){
			E("更改新闻状态时传入的状态值不合法");
		}else{
			$condition=array(
				"news_id" => array("eq", $newsId),
			);
			$data=array(
				"status" => $status
			);
			return $this->where($condition)->save($data);
		}
	}

	public function updateNewsOrderById($order, $newsId){
		if(is_null($newsId)|| !is_numeric($newsId) || ($order<0)){
			E("更改新闻排序时传入的新闻ID或者排序值不合法");
		}else{
			$data=array(
				"order"=> intval($order),
			);
			$condition=array(
				"news_id" => array("eq", $newsId),
			);
			return $this->where($condition)->save($data);
		}
	}
}