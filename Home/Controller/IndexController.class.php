<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {

    public function index(){
        //调用Admin\Model下的MenuModel
        //在Home模块中调用Admin模块下的模型类
        //获取前端导航条目
        $Menu = D("Admin/Menu");
        $MenuInfo = $Menu->getWebSiteMenuList();
    	//调用Admin\AreaContent读取大图和小图信息
    	$AreaContent = D("Admin/AreaContent");
    	$News=D("Admin/News");
        //首页大图
    	$topBigNewsCondition=array(
    		"status" => 1,
    		"area_id" => 2,
    	);
        //首页小图
    	$topSmallNewsCondition=array(
    		"status" => 1,
    		"area_id" => 3,
    	);
        //首页新闻列表
    	$listNewsCondition=array(
    		"status" => 1,
            "thumb" => array("neq",""),
    	);
        $topBigNews=$AreaContent->pullData($topBigNewsCondition, 1);
        $topSmallNews=$AreaContent->pullData($topSmallNewsCondition, 3);
        $listNews=$News->pullData($listNewsCondition, 15);
        //首页右侧推荐文章位
        $rankNews=$this->getRankNews();
        //首页右侧广告位
        $adNewsCondition=array(
            "status" => 1,
            "area_id" => 5,
            "thumb" => array("neq",""),
        );
        $adNews = $AreaContent->pullData($adNewsCondition, 3);


    	$this->assign("topBigNews",$topBigNews);
    	$this->assign("topSmallNews",$topSmallNews);
        $this->assign("listNews",$listNews);
        $this->assign("rankNews",$rankNews);
    	$this->assign("adNews",$adNews);

    	$this->assign("barMenus",$MenuInfo);
    	$this->assign("curId",-1);
        $this->display();
    }
}