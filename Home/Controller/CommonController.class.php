<?php

namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller{
	public function __construct(){
		header("Content-type:text/html;charset=utf-8");
		parent::__construct();
	}

	public function getRankNews(){
		$count = C("RANK_COUNT");
		$News = D("Admin/News");
		return $News->getRankNews($count);
	}

	public function toErrorPage($message="系统错误"){
		$this->assign("message",$message);
		$this->display("Index:error");
	}

	public function getColumn(){
		//获取导航条菜单信息
		$Menu = D("Admin/Menu");
		$News=D("Admin/News");
		$AreaContent = D("Admin/AreaContent");

    	$MenuInfo = $Menu->getWebSiteMenuList();
    	$this->assign("barMenus",$MenuInfo);

		$programId=I("get.id/d");
		if(!$programId || !is_numeric($programId)){
			$this->toErrorPage("栏目内容正在维护");
		}
		//新闻列表
		$listNewsCondition=array(
			"status" => 1,
	        "thumb" => array("neq",""),
	        "program_id"=> array("eq",$programId),
		);
		$listNews=$News->pullData($listNewsCondition, 15);
		$this->assign("listNews",$listNews);
		//首页右侧推荐文章位
        $rankNews=$this->getRankNews();
        $this->assign("rankNews",$rankNews);
        //首页右侧广告位
        $adNewsCondition=array(
            "status" => 1,
            "area_id" => 5,
            "thumb" => array("neq",""),
        );
        $adNews = $AreaContent->pullData($adNewsCondition, 3);
		$this->assign("adNews",$adNews);
		
		$this->assign("curId",$programId);
		$this->display();
	}
}