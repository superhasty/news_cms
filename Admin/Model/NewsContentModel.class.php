<?php

namespace Admin\Model;
use Think\Model;

class NewsContentModel extends Model{
	protected $trueTableName="cms_news_content";

	protected $_validate = array(
		array('news_id','require','新闻摘要ID号必须存在'),
		array('content','require','新闻正文内容必须存在'),
		array('createtime','require','创建时间必须存在'),
		array('updatetime','require','更新时间必须存在')
	);

	/**
	 * 添加新闻正文
	 * @param [type] $content [description]
	 */
	public function addContent($content){
		$data=null;
		if($this->create($content)){
			$this->add();
			$status=0;
			$msg="添加新闻正文成功";
		}else{
			$status=1;
			$msg=$this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	/**
	 * 添加新闻正文
	 * @param [type] $content [description]
	 */
	public function editContent($content){
		$data=null;
		$condition=array(
			"news_id" => array("eq", $content["news_id"]),
		);
		if(($res = $this->where($condition)->save($content))!==FALSE){
			$status=0;
			$msg="修改新闻正文成功";
		}else{
			$status=1;
			$msg=$this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	public function deleteContent($newsId){
		$data = null;
		$condition["news_id"] = $newsId;
		if(FALSE!==($res = $this->where($condition)->delete())){
			$status = 0;
			$msg = "删除新闻正文成功";
		}else{
			$status = 1;
			$msg = $this->getError();
		}
		return array("status"=>$status,"msg"=>$msg,"data"=>$data);
	}

	public function getContentById($newsId){
		if(is_null($newsId) || !is_numeric($newsId)){
			return null;
		}else{
			$condition=array(
				"news_id"=> array("eq", $newsId),
			);
			return $this->where($condition)->find();
		}
	}

	
}