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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

insert into `cms_admin` values
(1, 'admin', 'd099d126030d3207ba102efa8e60630a', '0', 1461135752, 'iamzhouj@163.com', '张三', 1);