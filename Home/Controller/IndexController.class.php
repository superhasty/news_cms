<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	//调用Admin\Model下的MenuModel
    	//在Home模块中调用Admin模块下的模型类
    	$Menu = D("Admin/Menu");
    	$MenuInfo = $Menu->getWebSiteMenuList();
    	$this->assign("barMenus",$MenuInfo);
    	$this->assign("curId",-1);
        $this->display();
    }
}