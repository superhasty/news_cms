<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;

class AreacontentController extends CommonController{
	/**
	 * 区域内容管理首页的逻辑：
	 * 1. 区域内容搜索采用post方式发送搜索数据
	 * 2. 分页方式显示内容数据
	 * 3. 数据发送url不要带参数，使用__ACTION__即可
	 *
	 * 页面进入时，判断请求方式
	 * 1. 通过Url地址获取参数，包括: 区域名称搜索值, 查询页码数
	 *    查询数据库获取相应数据，分页展示。
	 *    通过页码数和每页展示的条目数计算出当前页码所对应的数据起始值并查询出数据
	 *    使用TP自带分页类实现分页导航
	 */
	public function index(){
		$condition=array();
		$Area = D("Area");
		$AreaContent=D("AreaContent");
		//获取当前可用的网站区域，用于下拉列表展示
		$areaInfos = $Area->getOpenAreaInfos();
		//获取当前可用的网站区域ID，滤掉删除状态。结果是数组
		$areaIds = $Area->getOpenAreaIds();

			$searchAreaId = I("param.searchAreaId/d", "-1");
			$searchTitle = I("param.searchTitle/s", "");
			$searchTitle = trim($searchTitle);
			if($searchAreaId == -1){
				$condition=array(
					"area_id" => array(
							array("neq", $searchAreaId),
							array("in", $areaIds),
						),
					"title"      => array("like","%".$searchTitle."%"),
				);
			}else{
				$condition=array(
					"area_id" => array("eq", $searchAreaId),
					"title"      => array("like","%".$searchTitle."%"),
				);
			}
		
			$page = I("param.p/d", 1);

		$condition["status"]=array("neq","-1");
		$count = $AreaContent->getCounts($condition);
		$pageTool = new Page($count, C("PAGE_ROWS"));
		$pageTool->setConfig("theme",'%HEADER%&nbsp;当前第%NOW_PAGE%页&nbsp;&nbsp;%FIRST%&nbsp;%UP_PAGE%&nbsp;%LINK_PAGE%&nbsp;%DOWN_PAGE%&nbsp;%END%&nbsp;总共%TOTAL_PAGE%页');
		$pageTool->setConfig("prev","上一页");
		$pageTool->setConfig("next","下一页");
		$show = $pageTool->show();
		$data = $AreaContent->showDataByPage($condition, $page);
		
		$this->assign("datashow",$show);
		$this->assign("datalist",$data);
		$this->assign("curAreaId", $searchAreaId);
		$this->assign("areaInfos", $areaInfos);		
		$this->assign("nav_title","预览");
		$this->display();
	}

	/**
	 * 添加新的网站区域内容
	 */
	public function addAreaContent(){
		if(IS_POST){
			$url = __CONTROLLER__."/".__FUNCTION__;
			//获取表单数据
			$title = I("post.title");
			$areaId = I("post.area_id");
			$thumb = I("post.thumb");
			$news_url = I("post.url");
			$newsId = I("post.news_id");
			$status = I("post.status");
			//进行url与id的判断
			if(!$news_url && !$newsId){
				return AJAXResult(1,"第三方跳转url与文章ID不能同时为空",array("url"=>$url));
			}
			if(!$thumb){
				if($newsId){
					//取出当前文章ID对应的缩略图
					$News=D("News");
					$NewsInfo = $News->getNewsInfoById($newsId);
					if($NewsInfo && is_array($NewsInfo)){
						$thumb = $NewsInfo["thumb"];
					}else{
						return AJAXResult(2,"当前指定的新闻没有缩略图",array("url"=>$url));
					}
				}else{
					return AJAXResult(3,"没有指定缩略图",array("url"=>$url));
				}
			}
			$areaContentInfo = array(
				"title"=>$title,
				"area_id"=>$areaId,
				"thumb"=>$thumb,
				"url"=>$news_url,
				"news_id"=>$newsId,
				"status"=>$status,
				"createtime"=>time(),
				"updatetime"=>time()
			);
			//通过Model进行数据库插入
			$AreaContent = D("AreaContent");
			try{
				$result = $AreaContent->addData($areaContentInfo);
				if($result["status"]==0){
					$url = __CONTROLLER__."/index";
				}
			}catch(Exception $e){
				return AJAXResult(4,"添加区域内容时发生异常",array("url"=>$url));
			}
			return AJAXResult($result["status"],$result["msg"],array("url"=>$url));
		}else{
			$this->assign("nav_title","添加");
			// 获取配置信息
			$areaInfos=D("Area")->getOpenAreaInfos();
			$this->assign("areaInfos",$areaInfos);
			$this->display();
		}
	}

	public function editAreaContent(){
		$this->assign("nav_title","编辑");
		$AreaContent=D("AreaContent");
		if(IS_GET){
			//通过ID获取区域内容并填充页面
			$areaContentId = I("get.id");
			if(!$areaContentId){
				$this->redirect("index");
			}
			$AreaContentInfo = $AreaContent->getAreaContentInfoById($areaContentId);
			$this->assign("areaContentInfo", $AreaContentInfo);
			//获取配置信息
			$areaInfos=D("Area")->getOpenAreaInfos();
			$this->assign("areaInfos",$areaInfos);
			$this->display();
		}else if(IS_POST){
			//获取表单数据
			$areacontentId = I("post.id");
			$title = I("post.title");
			$areaId = I("post.area_id");
			$thumb = I("post.thumb");
			$news_url = I("post.url");
			$newsId = I("post.news_id");
			$status = I("post.status");
			//进行url与id的判断
			if(!$news_url && !$newsId){
				return AJAXResult(1,"第三方跳转url与文章ID不能同时为空",array("url"=>$url));
			}
			if(!$thumb){
				if($newsId){
					//取出当前文章ID对应的缩略图
					$News=D("News");
					$NewsInfo = $News->getNewsInfoById($newsId);
					if($NewsInfo && is_array($NewsInfo)){
						$thumb = $NewsInfo["thumb"];
					}else{
						return AJAXResult(2,"当前指定的新闻没有缩略图",array("url"=>$url));
					}
				}else{
					return AJAXResult(3,"没有指定缩略图",array("url"=>$url));
				}
			}
			$areaContentInfo = array(
				"id"=>$areacontentId,
				"title"=>$title,
				"area_id"=>$areaId,
				"thumb"=>$thumb,
				"url"=>$news_url,
				"news_id"=>$newsId,
				"status"=>$status,
				"createtime"=>time(),
				"updatetime"=>time()
			);
			//通过Model进行数据库插入
			$AreaContent = D("AreaContent");
			try{
				$result = $AreaContent->editAreaContent($areaContentInfo);
				if($result["status"]==0){
					$url = __CONTROLLER__."/index";
				}else{
					$url = __CONTROLLER__."/".__FUNCTION__;
				}
			}catch(Exception $e){
				return AJAXResult(4,"编辑区域内容时发生异常",array("url"=>$url));
			}
			return AJAXResult($result["status"],$result["msg"],array("url"=>$url));
		}
	}

	public function deleteAreaContent(){
		if(IS_POST){
			$AreaContent = D("AreaContent");
			$areacontentId = I("get.id", -1);
			$result = $AreaContent->deleteNews($areacontentId);
			if($result["status"]==0){
				$url = __CONTROLLER__."/index";
			}else{
				$url = __CONTROLLER__."/".__FUNCTION__;	
			}
			return AJAXResult($result["status"],$status["msg"],array("url"=>$url));
		}else{
			$this->redirect("index");
		}
	}

	public function orderAreaContent(){
		$url = I("server.http_referer");
		if(IS_POST){
			$AreaContent=D("AreaContent");
			$errors=array();
			$data = I("post.order/a");
			if($data){
				try {
					foreach ($data as $id => $order){
						$res = $AreaContent->updateOrderById($order, $id);
						if($res===FALSE){
							$errors[]=$id;
						}
					}
				}catch(Exception $e){
					return AJAXResult(3, "排序失败--".implode(",",$errors).",发生异常:".$e->getMessage(), array("url"=>$url));
				}
				if($errors){
					return AJAXResult(2, "排序失败--".implode(",",$errors), array("url"=>$url));
				}
				return AJAXResult(0, "排序成功", array("url"=>$url));
			}else{
				return AJAXResult(1, "传入的排序数据有误", array("url"=>$url));
			}
		}else{
			$this->redirect("index");
		}
	}
}