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
	public function showNewsByProgram($condition = array(), $page=1){
		$start = ($page-1)*C("PAGE_ROWS");
		$defCondition = array(
			"status" => array("neq", "-1"),
		);
		if(is_null($condition)){
			return $this->where($defCondition)->limit($start, C("PAGE_ROWS"))->select();
		}else{
			$con=array_merge($condition, $defCondition);
			// dump($con);
			$res = $this->where($con)->limit($start, C("PAGE_ROWS"))->select();
			// dump($res);
			return $res;
		}
	}


	public function getNewsCount($condition){
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
}