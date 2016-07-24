-- create time: 2016.07.20
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

-- CREATE DATABASE IF NOT EXISTS `hfaw_news_cms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE DATABASE IF NOT EXISTS `hfaw_news_cms` DEFAULT CHARACTER SET utf8;
use `hfaw_news_cms`;

-- 网站后台管理员信息表
CREATE TABLE IF NOT EXISTS `cms_admin` (
  `admin_id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `lastloginip` varchar(15) DEFAULT '0',
  `lastlogintime` int(10) unsigned DEFAULT '0',
  `email` varchar(40) DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`),
  KEY `username` (`username`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

insert into `cms_admin` values
(1, 'admin', '4ef3d351448d0bdbe441d79f747231aa', '0', 1461135752, 'iamzhouj@163.com', '张三', 1);

-- 菜单信息表
CREATE TABLE IF NOT EXISTS `cms_menu` (
  `menu_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `module` varchar(20) NOT NULL DEFAULT '',
  `controller` varchar(20) NOT NULL DEFAULT '',
  `action` varchar(20) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  `order` smallint(6) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`),
  KEY `order` (`order`),
  KEY `parentid` (`parentid`),
  KEY `route` (`module`,`controller`,`action`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `cms_menu` VALUES
(1, '菜单管理', 0, 'admin', 'menu', 'index', '', 10, 1, 1),
(2, '文章管理', 0, 'admin', 'Content', 'index', '', 0, -1, 1),
(3, '体育', 0, 'home', 'cat', 'index', '', 3, 1, 0),
(4, '科技', 0, 'home', 'cat ', 'index', '', 0, -1, 0),
(5, '汽车', 0, 'home', 'cat', 'index', '', 0, -1, 0),
(6, '文章管理', 0, 'admin', 'content', 'index', '', 9, 1, 1),
(7, '用户管理', 0, 'admin', 'user', 'index', '', 0, -1, 1),
(8, '科技', 0, 'home', 'cat', 'index', '', 0, 1, 0),
(9, '推荐位管理', 0, 'admin', 'position', 'index', '', 4, 1, 1),
(10, '推荐位内容管理', 0, 'admin', 'positioncontent', 'index', '', 1, 1, 1),
(11, '基本管理', 0, 'admin', 'basic', 'index', '', 0, 1, 1),
(12, '新闻', 0, 'home', 'cat', 'index', '', 0, 1, 0),
(13, '用户管理', 0, 'admin', 'admin', 'index', '', 0, 1, 1);

-- 新闻摘要表
CREATE TABLE IF NOT EXISTS `cms_news`(
  `news_id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '新闻ID',
  `program_id` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '栏目ID',
  `title` VARCHAR(80) NOT NULL DEFAULT '' COMMENT '标题',
  `subtitle` VARCHAR(30) DEFAULT '' COMMENT '副标题',
  `titlecolor` VARCHAR(250) DEFAULT NULL COMMENT '标题颜色',
  `thumb` varchar(250) NOT NULL DEFAULT '' COMMENT '缩略图',
  `keywords` VARCHAR(40) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` VARCHAR(250) NOT NULL COMMENT '简介',
  `position_id` VARCHAR(250) NOT NULL DEFAULT '' COMMENT '展示位置',
  `order` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序',
  `status` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `copyfrom` VARCHAR(250) DEFAULT NULL COMMENT '来源',
  `author` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '作者',
  `createtime` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `count` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '阅读量',
  PRIMARY KEY (`news_id`),
  KEY `status` (`status`,`order`,`news_id`),
  KEY `order` (`program_id`,`status`,`order`,`news_id`),
  KEY `program_id` (`program_id`,`status`,`news_id`)
)ENGINE=MYISAM DEFAULT CHARSET=utf8;


-- 新闻正文表
CREATE TABLE IF NOT EXISTS `cms_news_content` (
  `content_id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '新闻正文ID',
  `news_id` MEDIUMINT(8) UNSIGNED NOT NULL COMMENT '新闻摘要ID',
  `content` MEDIUMTEXT NOT NULL COMMENT '新闻正文',
  `createtime` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`content_id`),
  KEY `news_id` (`news_id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;