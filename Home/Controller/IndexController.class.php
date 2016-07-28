<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	//调用Admin\Model下的MenuModel
    	//在Home模块中调用Admin模块下的模型类
    	$Menu = D("Admin/Menu");
    	$MenuInfo = $Menu->getWebSiteMenuList();
    	//调用Admin\AreaContent读取大图和小图信息
    	$AreaContent = D("Admin/AreaContent");
    	$News=D("Admin/News");
    	$topBigNewsCondition=array(
    		"status" => 1,
    		"area_id" => 2,
    	);
    	$topSmallNewsCondition=array(
    		"status" => 1,
    		"area_id" => 3,
    	);
    	$listNewsCondition=array(
    		"status" => 1,
    	);
    	$topBigNews=$AreaContent->pullData($topBigNewsCondition, 1);
    	$topSmallNews=$AreaContent->pullData($topSmallNewsCondition, 4);
    	$listNews=$News->pullData($listNewsCondition, 15);


    	$this->assign("topBigNews",$topBigNews);
    	$this->assign("topSmallNews",$topSmallNews);
    	$this->assign("listNews",$listNews);

    	$this->assign("barMenus",$MenuInfo);
    	$this->assign("curId",-1);
        $this->display();
    }
}