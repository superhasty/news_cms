<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {

    public function index($showtype=""){
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

        if($showtype=="build"){
            $url=I("server.http_referer");
            try{
                $this->buildHtml("index","./","index/index");
                AJAXResult(0,"更改成功",array("url"=>$url));
            }catch(Exception $e){
                AJAXResult(1,$e->getMessage(),array("url"=>$url));
            }
        }else{
            $this->display();
        }
    }

    public function buildStaticHTML(){
        // 创建静态页面
        // @htmlfile 生成的静态文件名称
        // @htmlpath 生成的静态文件路径
        // @param string $templateFile 指定要调用的模板文件
        // 默认为空 由系统自动定位模板文件
        //buildHtml($htmlfile='',$htmlpath='',$templateFile='')
        if(IS_POST){
            $this->index("build");
        }else if(IS_GET){
            $this->toErrorPage("页面不存在");
        }
    }
}