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
}