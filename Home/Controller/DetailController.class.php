<?php

namespace Home\Controller;
use Think\Controller;

class DetailController extends CommonController{
	public function index(){
		if(IS_POST){
			$this->redirect("index/index");
		}else{
			// phpinfo();
			// exit();
			//获取指定新闻ID的新闻详细内容
			$news_id=I("get.id/d");
			if(!$news_id || !is_numeric($news_id)){
				$this->toErrorPage("指定的新闻ID不合法");
			}
			$News=D("Admin/News");
			$NewsInfo = $News->getNewsInfoById($news_id);
			if(!$NewsInfo || $NewsInfo["status"]!=1){
				$this->toErrorPage("未找到新闻或新闻已经被移除");
			}
			$NewsContent = D("Admin/NewsContent");
			$NewsContentInfo = $NewsContent->getContentById($news_id);
			if(!$NewsContentInfo){
				$this->toErrorPage("未找到新闻或新闻已经被移除");
			}
			// dump($NewsContentInfo);
			// exit();
			// $NewsInfo["content"]=stripslashes(htmlspecialchars_decode($NewsContentInfo["content"]));
			$NewsInfo["content"]=htmlspecialchars_decode($NewsContentInfo["content"]);


			$Menu = D("Admin/Menu");
	        $MenuInfo = $Menu->getWebSiteMenuList();
	        //首页右侧推荐文章位
	        $rankNews=$this->getRankNews();
	        //首页右侧广告位
	        $adNewsCondition=array(
	            "status" => 1,
	            "area_id" => 5,
	            "thumb" => array("neq",""),
	        );
	        $AreaContent = D("Admin/AreaContent");
	        $adNews = $AreaContent->pullData($adNewsCondition, 3);

            $this->assign("rankNews",$rankNews);
        	$this->assign("adNews",$adNews);
        	$this->assign("barMenus",$MenuInfo);
        	$this->assign("NewsInfo",$NewsInfo);
        	$this->assign("curId",$NewsInfo["program_id"]);
			$this->display();
		}
	}
}