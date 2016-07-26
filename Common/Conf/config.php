<?php
return array(
	//'配置项'=>'配置值'
	"LOAD_EXT_CONFIG"	=>	"db", //"db,url,...."//引入额外配置文件
	"MD5_KEY"	        =>	"news_cms",//md5加密时钥匙
	"SHOW_PAGE_TRACE"	=>	true,//打开调试工具
	"PAGE_ROWS"         =>  5, //分页显示时每一页的个数
	'DEFAULT_MODULE'        =>  'Home',  // 默认模块
	'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
	"DEFAULT_ACTION"        =>  'Index', // 默认操作名称
	'URL_MODEL'             =>  2,
	"NEWS_TITLE_COLOR"      =>  array(
									"#5674ed" => "蓝色",
									"#ed568b" => "红色",
								),
	"NEWS_COPY_FROM"		=>  array(
									"0" => "本站",
									"1" => "新浪网",
									"2" => "央视网",
									"3" => "网易",
									"4" => "搜狐",
								),

	// 'TMPL_EXCEPTION_FILE'   =>  '',// 异常页面的模板文件
);