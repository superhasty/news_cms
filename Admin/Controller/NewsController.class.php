<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;

class NewsController extends Controller{
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
			$author = session("username")?session("username") : "";
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
					"content" => htmlspecialchars(I("post.newscontent")),
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

	public function deleteNews(){
		$this->assign("nav_title","删除文章");
		$this->display();
	}

	public function index(){
		$newsProgram = null;
		$condition=null;
		$News = D("News");
		$Menu = D("Menu");
		
		//获取栏目
		$programs = $Menu->getWebSiteMenuNames();
		$programIds = $Menu->getWebSiteMenuIds();//获取当前可用的前台展示栏目ID，滤掉删除状态。结果是数组

			$newsProgramId = I("param.searchNewsProgram/d", "-1");
			$newsTitle = I("param.searchNewsTitle/s", "");
			if($newsProgramId == -1){
				$condition=array(
					"program_id" => array(
							array("neq", $newsProgramId),
							array("in", $programIds),
						)
				);
			}else{
				$condition=array(
					"program_id" => array(
							array("eq", $newsProgramId),
							// array("in", $programIds),
						),
					"title"      => array("like","%".$newsTitle."%"),
				);
			}
		
			$page = I("param.p/d", 1);
		
		// echo "<br><br><br><br><br><br><br><br>---$newsProgramId-------$newsTitle-------------$page";

		$condition["status"]=array("neq","-1");
		// $condition["program_id"]=array("in",$programIds);//查询结果集时考虑滤掉删除状态的前台栏目
		$count = $News->getNewsCount($condition);
		// echo "<br><br>----------$count";
		$pageTool = new Page($count, C("PAGE_ROWS"));
		$pageTool->setConfig("theme",'%HEADER%&nbsp;当前第%NOW_PAGE%页&nbsp;&nbsp;%FIRST%&nbsp;%UP_PAGE%&nbsp;%LINK_PAGE%&nbsp;%DOWN_PAGE%&nbsp;%END%&nbsp;总共%TOTAL_PAGE%页');
		$pageTool->setConfig("prev","上一页");
		$pageTool->setConfig("next","下一页");
		$show = $pageTool->show();
		$this->assign("newsshow",$show);
		$data = $News->showNewsByProgram($condition, $page);
		$this->assign("newslist",$data);
		// dump($data);
		
		// $curProgram = $Menu->getWebSiteMenuNameById($newsProgramId);
		$this->assign("programs", $programs);
		$this->assign("curProgramId", $newsProgramId);
		$this->assign("nav_title","文章列表");
		$this->display();
	}

	public function editNews(){
		$this->assign("nav_title","新增");
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
			$author = session("username")?session("username") : "";
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
				"createtime"=>time(),
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
					"content" => htmlspecialchars($content),
					"createtime" => time(),
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
}