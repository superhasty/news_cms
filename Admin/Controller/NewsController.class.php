<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;

/**
 * 新闻管理控制器
 * 复制新闻的添加，删除，修改，排序，改变状态
 */
class NewsController extends CommonController{
	/**
	 * 首页
	 * @return [type] [description]
	 */
	public function index(){
		$condition=array();
		$News = D("News");
		$Menu = D("Menu");
		
		//获取当前可用的前台展示栏目,用于下拉列表展示
		$programs = $Menu->getWebSiteMenuNames();
		//获取当前可用的前台展示栏目ID，滤掉删除状态。结果是数组
		$programIds = $Menu->getWebSiteMenuIds();

			$newsProgramId = I("param.searchNewsProgram/d", "-1");
			$newsTitle = I("param.searchNewsTitle/s", "");
			$newsTitle = trim($newsTitle);
			if($newsProgramId == -1){
				$condition=array(
					"program_id" => array(
							array("neq", $newsProgramId),
							array("in", $programIds),
						),
					"title"      => array("like","%".$newsTitle."%"),
				);
			}else{
				$condition=array(
					"program_id" => array("eq", $newsProgramId),
					"title"      => array("like","%".$newsTitle."%"),
				);
			}
		
			$page = I("param.p/d", 1);

		$condition["status"]=array("neq","-1");
		$count = $News->getNewsCount($condition);
		$pageTool = new Page($count, C("PAGE_ROWS"));
		$pageTool->setConfig("theme",'%HEADER%&nbsp;当前第%NOW_PAGE%页&nbsp;&nbsp;%FIRST%&nbsp;%UP_PAGE%&nbsp;%LINK_PAGE%&nbsp;%DOWN_PAGE%&nbsp;%END%&nbsp;总共%TOTAL_PAGE%页');
		$pageTool->setConfig("prev","上一页");
		$pageTool->setConfig("next","下一页");
		$show = $pageTool->show();
		$data = $News->showNewsByProgram($condition, $page);

		//获取网站管理区域的信息
		$Area = D("Area");
		$areaInfos = $Area->getAreaInfos();
		$this->assign("areaInfos", $areaInfos);
		
		$this->assign("newsshow",$show);
		$this->assign("newslist",$data);
		$this->assign("programs", $programs);
		$this->assign("curProgramId", $newsProgramId);
		$this->assign("nav_title","文章列表");
		$this->display();
	}

	/**
	 * 添加新闻
	 */
	public function addNews(){
		if(IS_POST){
			//获取表单数据
			$title = I("post.newstitle");
			$subtitle = I("post.newssubtitle");
			$thumb = I("post.thumb");
			$titlecolor = I("post.newstitlecolor");
			$program = I("post.newsprogram");
			$copyfrom = I("post.newscopyfrom");
			$desc = I("post.newsdescription");
			$keywords = I("post.newskeywords");
			//通过session读取管理员信息
			$username = session("username")?session("username") : "";
			$Admin=D("Admin");
			$res = $Admin->getAdminByUserName($username);
			if($res!==FALSE){
				$author = $res["realname"];
			}else{
				$author = "匿名";
			}
			$newsInfo = array(
				"title"=>$title,
				"subtitle"=>$subtitle,
				"thumb"=>$thumb,
				"titlecolor"=>$titlecolor,
				"program_id"=>$program,
				"copyfrom"=>$copyfrom,
				"description"=>$desc,
				"keywords"=>$keywords,
				"author"=>$author,
				"createtime"=>time(),
				"updatetime"=>time()
			);
			//通过Model进行数据库插入
			$News = D("News");
			$result = $News->addNews($newsInfo);
			if($result["status"]==0){
				//将新闻正文内容添加到数据库中
				$NewsContent = D("NewsContent");
				$contentInfo = array(
					"news_id" => $result["data"]["id"],
					// "content" => htmlspecialchars(I("post.newscontent")),
					"content" => I("post.newscontent"),
					"createtime" => time(),
					"updatetime" => time()
				);
				$result = $NewsContent->addContent($contentInfo);
				if($result["status"]==0){
					$url = __CONTROLLER__."/index";
				}else{
					$url = __CONTROLLER__."/".__FUNCTION__;	
				}
			}else{
				$url = __CONTROLLER__."/".__FUNCTION__;
			}
			return AJAXResult($result["status"],$result["msg"],array("url"=>$url));
		}else{
			$this->assign("nav_title","添加文章");
			// 获取配置信息：新闻来源，新闻标题颜色，新闻所属栏目
			$newsCopyFrom=C("NEWS_COPY_FROM");
			$newsTitleColor=C("NEWS_TITLE_COLOR");
			$newsProgram=D("Menu")->getWebSiteMenuList();
			$this->assign("newsCopyFrom",$newsCopyFrom);
			$this->assign("newsTitleColor",$newsTitleColor);
			$this->assign("newsProgram",$newsProgram);
			$this->display();
		}
	}

	/**
	 * 删除新闻
	 * @return [type] [description]
	 */
	public function deleteNews(){
		if(IS_POST){
			$News = D("News");
			$newsId = I("get.id", -1);
			$result = $News->deleteNews($newsId);
			if($result["status"]==0){
				//开始删除新闻正文部分
				$NewsContent = D("NewsContent");
				$result = $NewsContent->deleteContent($newsId);
				if($result["status"]==0){
					$url = __CONTROLLER__."/index";
				}else{
					$url = __CONTROLLER__."/".__FUNCTION__;	
				}
			}else{
				$url=__CONTROLLER__."/".__FUNCTION__;
			}
			return AJAXResult($result["status"],$status["msg"],array("url"=>$url));
		}else{
			$this->redirect("index");
		}
	}

	/**
	 * 编辑新闻
	 * @return [type] [description]
	 */
	public function editNews(){
		$this->assign("nav_title","编辑");
		$News=D("News");
		$NewsContent = D("NewsContent");
		if(IS_GET){
			//通过ID获取新闻内容并填充页面
			$newsId = I("get.id");
			if(!$newsId){
				$this->redirect("index");
			}
			$newsInfo = $News->getNewsInfoById($newsId);
			$content = $NewsContent->getContentById($newsId);
			$newsInfo["content"]=$content["content"];
			$this->assign("newsInfo", $newsInfo);
			//获取配置信息：新闻来源，新闻标题颜色，新闻所属栏目
			$newsCopyFrom=C("NEWS_COPY_FROM");
			$newsTitleColor=C("NEWS_TITLE_COLOR");
			$newsProgram=D("Menu")->getWebSiteMenuList();
			$this->assign("newsCopyFrom",$newsCopyFrom);
			$this->assign("newsTitleColor",$newsTitleColor);
			$this->assign("newsProgram",$newsProgram);
			$this->display();
		}else if(IS_POST){
			//获取表单数据
			$newsId = I("post.newsId/d");//获取新闻ID号
			$title = I("post.newstitle");
			$subtitle = I("post.newssubtitle");
			$thumb = I("post.thumb");
			$titlecolor = I("post.newstitlecolor");
			$program = I("post.newsprogram");
			$copyfrom = I("post.newscopyfrom");
			$desc = I("post.newsdescription");
			$keywords = I("post.newskeywords");
			$content = I("post.newscontent");
			//通过session读取管理员信息
			$username = session("username")?session("username") : "";
			$Admin=D("Admin");
			$res = $Admin->getAdminByUserName($username);
			if($res!==FALSE){
				$author = $res["realname"];
			}else{
				$author = "匿名";
			}
			$newsInfo = array(
				"news_id"=>$newsId,
				"title"=>$title,
				"subtitle"=>$subtitle,
				"thumb"=>$thumb,
				"titlecolor"=>$titlecolor,
				"program_id"=>$program,
				"copyfrom"=>$copyfrom,
				"description"=>$desc,
				"keywords"=>$keywords,
				"author"=>$author,
				"updatetime"=>time()
			);
			//通过Model进行数据库插入
			$News = D("News");
			$result = $News->editNews($newsInfo);
			if($result["status"]==0){
				//将新闻正文内容添加到数据库中
				$NewsContent = D("NewsContent");
				$contentInfo = array(
					"news_id" => $newsId,
					// "content" => htmlspecialchars($content),
					"content" => I("post.newscontent"),
					"updatetime" => time()
				);
				$result = $NewsContent->editContent($contentInfo);
				if($result["status"]==0){
					$url = __CONTROLLER__."/index";
				}else{
					$url = __CONTROLLER__."/".__FUNCTION__;	
				}
			}else{
				$url = __CONTROLLER__."/".__FUNCTION__;
			}
			return AJAXResult($result["status"],$result["msg"],array("url"=>$url));
		}
	}

	/**
	 * 改变新闻显示状态
	 * @return [type] [description]
	 */
	public function updateStatus(){
		if(IS_POST){
			$News = D("News");
			$newsId = I("post.id/d");
			$status = I("post.status");
			if($newsId){
				try{
					$result = $News->updateNewsStatus($newsId, $status);
					if($result!==FALSE){
						// $url=__CONTROLLER__."/index";
						$url = I("server.http_referer");
					}else{
						$url=__CONTROLLER__."/".__FUNCTION__;
					}
				}catch(Exception $e){
					return AJAXResult(2,"更新新闻状态产生异常",array("url"=>$url));
				}
				return AJAXResult(0,"更新新闻状态成功",array("url"=>$url));
			}else{
				return AJAXResult(1,"未指定修改的新闻ID号",array("url"=>$url));
			}
		}else{
			$this->redirect("index");
		}
	}

	/**
	 * 新闻排序
	 * @return [type] [description]
	 */
	public function orderNews(){
		$url = I("server.http_referer");
		if(IS_POST){
			$News=D("News");
			$errors=array();
			$data = I("post.order/a");
			if($data){
				try {
					foreach ($data as $newsId => $order){
						$res = $News->updateNewsOrderById($order, $newsId);
						if($res===FALSE){
							$errors[]=$newsId;
						}
					}
				}catch(\Exception $e){
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

	/**
	 * 推送新闻
	 * @return [type] [description]
	 */
	public function pushNews(){
		$url = I("server.http_referer");
		if(IS_POST){
			$News=D("News");
			$AreaContent=D("AreaContent");
			$errors=array();
			$areaId=I("post.areaId/d");
			$newsIds=I("post.newsIds/a");
			if(is_null($areaId)){
				return AJAXResult(1, "请选择区域ID进行推送", array("url"=>$url));
			}
			if(is_null($newsIds) || !is_array($newsIds)){
				return AJAXResult(2, "请选择新闻ID进行推送", array("url"=>$url));
			}
			try{
				$newsInfos = $News->getNewsInfosByIds($newsIds);
				if(is_null($newsInfos)){
					return AJAXResult(3, "未找到推送数据", array("url"=>$url));
				}else{
					foreach ($newsInfos as $newsInfo){
						//将新闻内容写入到指定区域的内容管理表中
						$areaContentData = array(
							"area_id" => $areaId,
							"title" => $newsInfo["title"],
							"thumb" => $newsInfo["thumb"],
							"news_id" => $newsInfo["news_id"],
							"createtime" => $newsInfo["createtime"],
							// "createtime" => time(),
							"updatetime" => time()
						);
						$res = $AreaContent->addData($areaContentData);
						if($res["status"]!=0){
							$errors[]=$newsInfo["news_id"];
						}
					}
					if($errors){
						AJAXResult(4, "推送失败,新闻ID号--".implode(",", $errors), array("url"=>$url));
					}
					return AJAXResult(0, "推送成功", array("url"=>$url));
				}
			}
			catch(Exception $e){
				return AJAXResult(5, "推送失败,发生异常", array("url"=>$url));
			}
		}else{
			$this->redirect("index");
		}
	}
	
}