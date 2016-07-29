/*
SQLyog Community v11.51 (64 bit)
MySQL - 5.6.17 : Database - hfaw_news_cms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hfaw_news_cms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `hfaw_news_cms`;

/*Table structure for table `cms_admin` */

DROP TABLE IF EXISTS `cms_admin`;

CREATE TABLE `cms_admin` (
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `cms_admin` */

insert  into `cms_admin`(`admin_id`,`username`,`password`,`lastloginip`,`lastlogintime`,`email`,`realname`,`status`) values (1,'admin','4ef3d351448d0bdbe441d79f747231aa','0',1461135752,'iamzhouj@163.com','张三',1);

/*Table structure for table `cms_area` */

DROP TABLE IF EXISTS `cms_area`;

CREATE TABLE `cms_area` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '区域ID号',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '区域名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '区域状态',
  `description` varchar(100) DEFAULT NULL COMMENT '区域描述',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `cms_area` */

insert  into `cms_area`(`id`,`name`,`status`,`description`,`createtime`,`updatetime`) values (1,'底部广告',1,'展示底部广告',1455634352,145665871),(2,'首页大图',1,'展示首页大图',1455634715,145665871),(3,'小图推荐',1,'小图推荐位',1456665873,145665871),(4,'首页右侧推荐文章位',1,'首页右侧推荐文章位',1457248469,1469724090),(5,'右侧广告位',1,'右侧广告位',1457873143,145665871);

/*Table structure for table `cms_area_content` */

DROP TABLE IF EXISTS `cms_area_content`;

CREATE TABLE `cms_area_content` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '区域内容ID',
  `area_id` int(5) unsigned NOT NULL COMMENT '区域名称ID号',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '内容标题',
  `thumb` varchar(250) NOT NULL DEFAULT '' COMMENT '内容缩略图',
  `url` varchar(250) DEFAULT NULL COMMENT '内容链接地址',
  `news_id` mediumint(8) unsigned NOT NULL COMMENT '内容对应新闻ID号',
  `order` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '内容排序规则',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '内容状态',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '　更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `cms_area_content` */

insert  into `cms_area_content`(`id`,`area_id`,`title`,`thumb`,`url`,`news_id`,`order`,`status`,`createtime`,`updatetime`) values (1,2,'爱尔兰航空公司推出涂有C罗名字飞机','/Public/image/Uploads/2016-07-28/579a1400d50d7.jpg',NULL,8,0,1,1469715460,1469716628),(2,3,'皇马中场也过剩了','/Public/image/Uploads/2016-07-28/579a0f79e19b6.jpg',NULL,7,0,1,1469714346,1469716650),(3,3,'爱尔兰航空公司推出涂有C罗名字飞机','/Public/image/Uploads/2016-07-28/579a1400d50d7.jpg',NULL,8,0,1,1469715460,1469716650),(4,3,'热身赛-18岁妖将103秒破门','/Public/image/Uploads/2016-07-28/579a168a73a97.jpg',NULL,9,0,1,1469716108,1469716650),(5,3,'足协杯-高迪建功申花1-0','/Public/image/Uploads/2016-07-28/579a0e0dbc7ad.jpg',NULL,6,0,1,1469714006,1469716835),(6,5,'沪苏拼进攻鲁能斗升班马','/Public/image/Uploads/2016-07-28/579a0b85e21af.jpg',NULL,1,0,1,1469713312,1469724111),(7,5,'鲁能提前出征延边不耽误踩场','/Public/image/Uploads/2016-07-28/579a0beaebae0.jpg',NULL,2,0,1,1469713466,1469724111),(8,5,'热身赛-18岁妖将103秒破门','/Public/image/Uploads/2016-07-28/579a168a73a97.jpg',NULL,9,0,1,1469716108,1469724111);

/*Table structure for table `cms_menu` */

DROP TABLE IF EXISTS `cms_menu`;

CREATE TABLE `cms_menu` (
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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `cms_menu` */

insert  into `cms_menu`(`menu_id`,`name`,`parentid`,`module`,`controller`,`action`,`description`,`order`,`status`,`type`) values (1,'菜单管理',0,'admin','menu','index','',10,1,1),(15,'英超',0,'home','england','index','英格兰超级足球联赛',3,1,0),(3,'中超',0,'home','china','index','中国足球超级联赛',4,1,0),(4,'科技',0,'home','cat ','index','',0,-1,0),(5,'意甲',0,'home','seriea','index','意大利足球联赛',2,1,0),(6,'文章管理',0,'admin','news','index','文章',9,1,1),(7,'用户管理',0,'admin','user','index','',0,1,1),(9,'区域管理',0,'admin','area','index','指定网站运营区域',4,1,1),(10,'区域内容管理',0,'admin','areacontent','index','网站运营区域的内容管理',1,1,1),(11,'基本管理',0,'admin','basic','index','',0,1,1),(12,'天气',0,'home','weather','index','天气资讯',0,1,0),(16,'西甲',0,'home','laliga','index','西班牙足球联赛',1,1,0);

/*Table structure for table `cms_news` */

DROP TABLE IF EXISTS `cms_news`;

CREATE TABLE `cms_news` (
  `news_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '新闻ID',
  `program_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `title` varchar(80) NOT NULL DEFAULT '' COMMENT '标题',
  `subtitle` varchar(30) NOT NULL DEFAULT '' COMMENT '副标题',
  `titlecolor` varchar(250) DEFAULT NULL COMMENT '标题颜色',
  `thumb` varchar(250) NOT NULL DEFAULT '' COMMENT '缩略图',
  `keywords` varchar(40) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(250) NOT NULL COMMENT '简介',
  `position_id` varchar(250) NOT NULL DEFAULT '' COMMENT '展示位置',
  `order` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `copyfrom` varchar(250) DEFAULT NULL COMMENT '来源',
  `author` varchar(20) NOT NULL DEFAULT '' COMMENT '作者',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '阅读量',
  PRIMARY KEY (`news_id`),
  KEY `status` (`status`,`order`,`news_id`),
  KEY `order` (`program_id`,`status`,`order`,`news_id`),
  KEY `program_id` (`program_id`,`status`,`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `cms_news` */

insert  into `cms_news`(`news_id`,`program_id`,`title`,`subtitle`,`titlecolor`,`thumb`,`keywords`,`description`,`position_id`,`order`,`status`,`copyfrom`,`author`,`createtime`,`updatetime`,`count`) values (1,3,'沪苏拼进攻鲁能斗升班马','恒大又遇不服','#5674ed','/Public/image/Uploads/2016-07-28/579a0b85e21af.jpg','中超；扎哈维；恒大；鲁能；建业','2016赛季中超联赛第20轮赛事将告进行，领跑积分榜的恒大客场对阵建业，建业上赛季对恒大形成了优势战绩；苏宁客场对阵申花与富力主场对阵上港这两战均极具看点；鲁能客场对阵韩范儿球队延边富德，鲁能的硬度与拼劲儿又将受到考验。','',0,1,'1','张三',1469713312,1469805349,5),(2,3,'鲁能提前出征延边不耽误踩场','杨旭齐天羽或将缺席','#5674ed','/Public/image/Uploads/2016-07-28/579a0beaebae0.jpg','鲁能；中超；马加特','输掉与申花的比赛后，鲁能还是只领先排名倒数第二的永昌2分，保级的危险依然没有解除。本赛季至今，鲁能客场比赛难求一胜，马加特急需改变这一窘境。','',0,1,'1','admin',1469713466,1469713466,2),(3,3,'鲁能青年队1-2狼堡','无缘四强将交手皇马','#5674ed','','山东鲁能；沃尔夫斯堡；潍坊杯','四强队伍全部产生，中国国青对阵鹿岛鹿角，巴西体育对阵沃尔夫斯堡。','',0,1,'1','admin',1469713577,1469713577,2),(4,3,'两次遭逆转!国安最后希望破灭','又一四大皆空赛季','#ed568b','/Public/image/Uploads/2016-07-28/579a0cfe5481f.jpg','恒大；国安；郜林；高拉特','在联赛表现并不出色的情况下，国安几乎和亚冠说再见，连续两年四大皆空。而葡萄牙人帕切科今天出现在工体的看台上，也不禁让人产生了一丝遐想。','',0,1,'1','admin',1469713724,1469713724,0),(5,3,'幸运晋级!比分本应是3-3','盼国家队照顾国脚','#5674ed','/Public/image/Uploads/2016-07-28/579a0d91b47a5.jpg','恒大；国安；郜林；高拉特','在足协杯八强战第二回合的比赛之中，广州恒大客场对阵北京国安队。结果恒大队在0-1落后的情况下，由保利尼奥和郜林连扳两球，最终客场以2-1战胜了国安队，两回合以4-2的比分淘汰国安队。','',0,1,'1','admin',1469713861,1469713861,0),(6,3,'足协杯-高迪建功申花1-0','总分5-0淘汰权健进4强','#5674ed','/Public/image/Uploads/2016-07-28/579a0e0dbc7ad.jpg','高迪；申花；权健；足协杯','2016年中国足协杯八进四第二回合赛事在天津海河体育场开始一场较量，由天津权健主场迎战上海申花。','',0,1,'1','admin',1469714006,1469714006,0),(7,16,'皇马中场也过剩了','9大球星争3位置 谁走谁留','#5674ed','/Public/image/Uploads/2016-07-28/579a0f79e19b6.jpg','阿森西奥；伊斯科；卡塞米罗','似乎一夜之间，西班牙俱乐部的中场球员开始过剩了。继巴萨出现7名中场球员竞争2个位置的情况后，皇马也出现了9名中场竞争3个位置的“盛况”，而按照一个位置两名球员的配置，皇马也多出3名中场球员。','',0,1,'1','admin',1469714346,1469714346,0),(8,16,'爱尔兰航空公司推出涂有C罗名字飞机','致敬C罗','#ed568b','/Public/image/Uploads/2016-07-28/579a1400d50d7.jpg','C罗；葡萄牙；皇家马德里','','',0,1,'1','admin',1469715460,1469715460,9),(9,16,'热身赛-18岁妖将103秒破门','皇马1-3不敌巴黎','#5674ed','/Public/image/Uploads/2016-07-28/579a168a73a97.jpg','卡瓦尼；卡塞米罗；伊斯科；马塞洛；莫拉塔','2016国际冠军杯北美赛区一场比赛在俄亥俄球场展开角逐，皇家马德里1比3不敌巴黎圣日耳曼','',2,1,'1','admin',1469716108,1469716108,0),(10,16,'巴萨官方宣布续约后防磐石3年','断尤文挖角念想','#5674ed','','马斯切拉诺；巴塞罗那；西甲','西甲卫冕冠军巴塞罗那官方宣布，已经和球队中坚马斯切拉诺达成续约协议，阿根廷人将续约3年。','',0,1,'1','admin',1469716205,1469716205,0),(11,16,'巴萨大将放弃11天休假提前归队','西媒盛赞','#5674ed','/Public/image/Uploads/2016-07-28/579a1729cb2a0.jpg','布拉沃；马斯切拉诺；布斯克茨；曼城','德国门将特尔施特根连续第二年提前归队参加巴萨的训练，以在与布拉沃的竞争中占据优势。德国人的敬业也获得了加泰罗尼亚媒体的好评。','',0,1,'1','admin',1469716322,1469716322,0),(12,16,'不卖！不卖！就不卖！','巴萨宣布4100万大将留队','#ed568b','/Public/image/Uploads/2016-07-28/579a17d7bbc13.jpg','图兰；巴塞罗那；土耳其','关于图兰的未来依然有着诸多的传闻，而在昨天针对这些传闻，巴萨教练组秘书罗伯特表示“图兰铁定不走”。','',1,1,'1','张三',1469716442,1469805765,2),(13,15,'小将87分钟绝杀 阿森纳2-1','德罗巴进球','#5674ed','/Public/image/Uploads/2016-07-29/579b5722e1b91.jpg','阿森纳；德罗巴；英超','2016/17赛季阿森纳季前第2场热身赛阿瓦亚球场展开角逐，阿森纳客场2比1取胜MLS全明星，坎贝尔和阿克鹏进球，德罗巴一度扳平比分。新援扎卡阿森纳首秀。','',0,1,'1','张三',1469798234,1469798234,0),(14,15,'热身赛-阿圭罗破门香川助攻','曼城点球7-6胜多特','#5674ed','/Public/image/Uploads/2016-07-29/579b57ad6b68c.jpg','阿圭罗；曼城；多特蒙德','北京时间7月28日19时30分，国际冠军杯在深圳龙岗体育中心开始1场较量，曼城90分钟与多特蒙德战为1比1平，并在点球大战中6比5胜出。','',0,1,'1','张三',1469798608,1469798608,0),(15,15,'穆里尼奥动刀！曼联9人清洗名单曝光 小猪离队','穆里尼奥动刀！','#ed568b','/Public/image/Uploads/2016-07-29/579b59364f4c4.jpg','穆里尼奥；施魏因斯泰格；曼联；门萨；贾努扎伊','《每日邮报》还玩了个文字游戏，形象的称昨天是一个“清洗般的星期四”，因为穆里尼奥通知了9名球员他们可以以转会或者租借的方式离队，其中就包括了施魏因斯泰格。','',0,1,'1','张三',1469798712,1469805000,0);

/*Table structure for table `cms_news_content` */

DROP TABLE IF EXISTS `cms_news_content`;

CREATE TABLE `cms_news_content` (
  `content_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '新闻正文ID',
  `news_id` mediumint(8) unsigned NOT NULL COMMENT '新闻摘要ID',
  `content` mediumtext NOT NULL COMMENT '新闻正文',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`content_id`),
  KEY `news_id` (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `cms_news_content` */

insert  into `cms_news_content`(`content_id`,`news_id`,`content`,`createtime`,`updatetime`) values (7,1,'&amp;lt;p&amp;gt;\n	周中足协杯上国安被恒大淘汰出局，国安还能否争夺下赛季亚冠门票的看点变得非常具体：目前少赛3场的国安积24分，排名积分榜第10位，距离三甲有9分差距；也就是说理论上国安绝对还有在联赛中发力抢票的机会。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	足协杯上国安遭遇了主场对恒大的3连败，在工体向其他球队确立主场优势的意义在放大。本赛季国安前8个主场3胜2平3负、打入7球失9球，同过往相比有大幅下滑。中超交锋史上国安对绿城8胜5平6负，国安主场对绿城5胜1平3负，国安近2次主场对阵绿城均以4-0的比分奏凯。本赛季首回合较量国安客场3-0战胜绿城，那是国安的赛季首胜，伊尔马兹首秀半场引出3个入球的表现非常精彩。如今国安外援的入球能力又成为焦点，此战看点非常明确。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	绿城上轮在主场3-1战胜泰达，取得近6战的第4胜，积分提升到22分，继续缓解着保级压力。但绿城客场2胜1平7负、打入7球失16球的数据不佳，难以在工体放大抢分希望。加盟绿城后3战打入3球的萨米尔值得重点关注。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	借助连续主场的赛程之利，延边队近阶段打出了绝对强势：对申花、苏宁与富力取得3连胜，这3战共打入8球仅失1球。延边队本赛季主场战绩提升到6胜2平2负、打入20球失10球。韩国前锋金承大连续3轮入球，其表现值得重点关注。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	延边队的韩国风格与元素很醒目，众所周知中国队即将在12强赛迎来中韩对话，鲁能对延边队理应更为重视：亚冠多年征战中鲁能抗韩不利，而本赛季亚冠八强战鲁能又将对阵韩国球队，本轮比赛事实上有着帮助鲁能备战的意义。本赛季首回合鲁能主场3-1战胜延边队。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;nbsp; &amp;amp;nbsp; 鲁能阵营当前最为关注的还是在联赛中抢分，上轮主场负于申花后鲁能4轮不败的反弹走势被终结，积18分列积分榜倒数第3位，抢分压力又显放大。更有压力的数据是：鲁能前8个客场3平5负、打入4球失12球，是中超客场积分最少的球队。\n&amp;lt;/p&amp;gt;',1469713312,1469805349),(19,13,'&amp;lt;p&amp;gt;\n	北京时间7月29日08:00(美国圣何塞当地时间28日18:00)，2016/17赛季阿森纳季前第2场热身赛阿瓦亚球场展开角逐，阿森纳客场2比1取胜MLS全明星，坎贝尔和阿克鹏进球，德罗巴一度扳平比分。新援扎卡阿森纳首秀。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;切赫和威尔谢尔结束休假回归首发。卡卡、皮尔洛、比利亚和德罗巴均为MLS全明星首发出场。开场仅3分钟，皮尔洛后场丢球，张伯伦传球，但沃尔科特禁区 边缘内的射门偏出。3分钟后，坎贝尔赢得左路任意球，沃尔科特直接射门绕过一侧人墙后被门将没收。比利亚切入禁区左侧的射门被封堵。皮尔洛精准长传，热奥瓦尼-多斯-桑托斯反越位后禁区右侧12码处的射门被切赫扑出，别利克及时解围。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;阿森纳第11分钟取得领先，坎贝尔禁区边缘内挑过出击的门将后又被西曼拉倒，坎贝尔亲自主罚点球命中。阿森纳有望扩大比分，沃尔科特反击中突破一人几近形成单刀，但最后在禁区边缘的低射缺乏威胁。张伯伦远射偏出。卡卡两度主罚角球均被解围。贝克尔曼挑传，比利亚禁区左侧小角度凌空倒挂钩射偏出远角。\n&amp;lt;/p&amp;gt;',1469798234,1469798234),(8,2,'&amp;amp;nbsp; &amp;amp;nbsp; &amp;lt;span style=&amp;quot;line-height:1.5;&amp;quot;&amp;gt;昨日，鲁能在基地正常进行训练，备战与延边富德的比赛。按照鲁能的安排，今日球队将提前启程前往延边，球队先坐高铁去北京，休息一夜后再乘飞机前往延边。&amp;lt;/span&amp;gt; \n&amp;lt;p&amp;gt;\n	输掉与申花的比赛后，鲁能还是只领先排名倒数第二的永昌2分，保级的危险依然没有解除。本赛季至今，鲁能客场比赛难求一胜，马加特急需改变这一窘境。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;nbsp; &amp;amp;nbsp;&amp;amp;nbsp;延边本赛季的主场战绩颇为出色，近期更是连续击败申花、苏宁和富力，势头强劲。从阵容实力上看，鲁能占据一定的优势，本赛季首回合交手，鲁能曾3比1击败对手。但延边士气正旺，鲁能必须要全力以赴才能从客场带回理想的分数。近期的训练，马加特再次对球队的阵容做出改变，这场比赛的18人名单也将再次发生变化。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;nbsp; &amp;amp;nbsp; 在鲁能官方公布的马加特庆生照片中，细心的鲁能球迷发现，杨旭和齐天羽缺席。据了解，两人近日一直在跟随预备队训练，未能进入备战延边的23人名单，这意味着他们可能缺席客场与延边的比赛。不出意外，马加特将从23人训练名单里挑选出征延边的18人名单。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;nbsp; &amp;amp;nbsp; 由于济南到延边的航班很少，而且多为经停航班，为了避免航班延误影响球队的训练，鲁能放弃从济南直飞延边的计划。按照球队的最新安排，今日训练结束后，鲁能将先乘坐高铁前往北京，休息一晚后再从北京乘坐飞机前往延边，这样可以保证球队不会错过下午的踩场训练。\n&amp;lt;/p&amp;gt;',1469713466,1469713466),(9,3,'&amp;lt;p&amp;gt;\n	北京时间7月27日下午，2016“鲁能•潍坊杯”国际青年&amp;lt;a href=&amp;quot;http://2016.sina.com.cn/events/ft/&amp;quot; target=&amp;quot;_blank&amp;quot;&amp;gt;足球&amp;lt;/a&amp;gt;邀请赛B组进入第三比赛日，山东鲁能青年队主场1-2不敌德国沃尔夫斯堡青年队，小组赛1胜2负无缘四强。接下来，山东鲁能将在排名赛中与A组小组第四皇马青年队交手。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;B小组前两轮战罢，日本鹿岛鹿角队两连胜提前出线，而山东鲁能与沃尔夫斯堡同为1胜1负，其中山东鲁能以净胜球劣势位居小组第三。此役，两队相遇，山东鲁能只有取胜才可以进入四强。面对生死决战，山东鲁能在首发阵容上变化不大。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;比赛开始之后，沃尔夫斯堡对山东鲁能形成围攻之势，山东鲁能只能被动防守。第15分钟，山东鲁能快速反击被断球，沃尔夫斯堡打出快速反击，禁区外场上远射，球擦着立柱偏出。第19分钟，沃尔夫斯堡球员突入禁区与山东鲁能防守队员相撞倒地，但主裁判并未有任何判罚。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;第22分钟，沃尔夫斯堡角球传中直奔远角，双方球员都未碰到，球擦着立柱稍稍偏出。第32分钟，沃尔夫斯堡连续一脚配合，边路球员拿球内切远射，球稍稍高出。第42分钟，沃尔夫斯堡打破僵局，扬·诺伊维特禁区外吊射破门。上半场比赛战罢，山东鲁能0-1落后。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;下半场易边再战，比分落后的山东鲁能率先换人，闫子冉、田鑫和柏天赐换下。田鑫一上来就犯规，被主裁判黄牌警告。第55分钟，沃尔夫斯堡禁区外觅得机会远射将球打高。第56分钟，沃尔夫斯堡再下一城，里士满·塔奇过了一名后卫之后禁区内抽射得手，山东鲁能0-2落后。第57分钟，魏东亮换下夏锡成。沃尔夫斯堡禁区内倒地未判点球，之后双方发生冲突，山东鲁能替补球员上场把发生纠纷的双方拉开。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;第62分钟，沃尔夫斯堡门将禁区内接回传球被黄牌警告，山东鲁能获得小禁区线附近间接任意球，射门打在门柱上弹出。之后，陈蒲换下高鑫，马帅换下毛锦澎。第76分钟，山东鲁能获得任意球，宋华直接射门打在人墙上形成吊射打入死角，场上比分变为1-2。补时阶段，柏天赐拿球杀入禁区被对手放倒，但主裁判并未判罚点球。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;最终全场比赛战罢，山东鲁能1-2不敌沃尔夫斯堡。至此，四强队伍全部产生，中国国青对阵鹿岛鹿角，巴西体育对阵沃尔夫斯堡。\n&amp;lt;/p&amp;gt;',1469713577,1469713577),(10,4,'&amp;lt;p&amp;gt;\n	又是先进1球被逆转，国安再一次因为控制力的缺乏而输掉比赛。在人员比对手更加齐整，又有针对性的战术部署的情况下，次回合的翻盘最终还是没能实现，这样的失利不仅让球队止步足协杯8强，同时，在联赛表现并不出色的情况下，国安几乎和亚冠说再见，连续两年四大皆空。而葡萄牙人帕切科今天出现在工体的看台上，也不禁让人产生了一丝遐想。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;今晚，虽然国安在比赛的前30分钟，在场面上取得了一定的优势，但我们依然能够明显感受到，无论是从队员之间的娴熟度、配合度以及打法的先进程度上看，恒大还是名副其实的高上国安一筹。不得不承认，尽管恒大两名主力外援高拉特、金英权以及多名后防线上的首选球员因伤无法登场，一定程度上影响了球队的实力，但近几年，恒大由于不断的引进高水平的外援和教练，经过长时间的磨合之后，他们的整体打法其实早已成型。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;反观国安，除了受伤的张呈栋，所有的主力球员今天都在，老队长徐云龙久伤之后也是在本场比赛中复出首发并打满全场。但是，国安依然给人一种“拾不起个儿来”的感觉。虽然土耳其锋霸伊尔马兹在前场用自己积极的跑动去扯动恒大的防线，也几乎凭借一己之力带动了国安的整条进攻线，但在与一次又一次机会失之交臂之后，球队还是没有更好的办法去取得胜利。必须要认清的是，球队也尽了全力了，但球队始终就是有劲儿不能完全使出来的样子，而这一次，不是没有劲儿，而是使不上，使不对劲儿。究其原因就是一句话，国安不比恒大，整个的战术体系没能成型甚至是定型，造成属于球员自己的战术特点发挥不到极致。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;赛季初期一系列的被动确实影响到了球队走上正确道路的步伐，直到现在，国安还处于缓不过劲儿来的阶段。国安这一回也必须应该承认，自己的实力的确不如对手，现在并不具备足够的实力去击垮对手。有意思的是，今天转播画面中，工体的看台上出现了一位国安的老朋友，葡萄牙人帕切科。他曾经在2011和2012赛季先后率领国安队获得过联赛的亚军和季军，并且帕切科时期的国安在与恒大的4次交锋中取得1胜2平1负相当的战绩。谢峰目前还是国安队的代理主教练，帕切科4年之后再次出现在工体看台上，不禁又让人们产生了一丝遐想？\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;随着今晚足协杯被广州恒大淘汰止步八强，北京国安本赛季已经没有争夺任何冠军的可能性了，也把凭借足协杯冠的身份直接进入明年亚冠比赛的愿望彻底破碎。今年的国安赛季初干了一番大事业，请来了名帅，签下了大牌的外援，投入更是创造了历史之最，但在这个充满希望但又混乱的赛季，国安的确需要反思，有句话说的好——知耻而后勇！四大皆空已经是几乎成为事实，球队目前最需要做的，是要尽快打造和演练出属于自己的成熟的战术体系来，吸取今年磨合时间短的教训，用剩下的联赛进行实战，为明年的联赛、杯赛和冲击亚冠做好准备。\n&amp;lt;/p&amp;gt;',1469713724,1469713724),(11,5,'&amp;lt;p&amp;gt;\n	7月26日，在足协杯八强战第二回合的比赛之中，广州恒大客场对阵北京国安队。结果恒大队在0-1落后的情况下，由保利尼奥和郜林连扳两球，最终客场以2-1战胜了国安队，两回合以4-2的比分淘汰国安队。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;比赛结束之后，恒大队主帅斯科拉里表示：今天赛前两队都想晋级，可以说是一场生死战，都创造出了很多机会，我觉得这场比赛的比分应当是3-3，很幸运恒大能够晋级。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;今天的比赛之中，恒大队几名国脚带伤上阵，张琳芃与冯潇霆先后受伤下场，赛后斯科拉里强调到：我们球队的伤病出现了一些困难，我向国家队教练做一个请求，希望他能够看一下我们的伤号，照顾我们的球员，不要从国家队回来再受伤。我们不希望恒大与国家队的球员都出现伤号。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;提到了伤病号，斯科拉里说到：我想特别表扬冯潇霆、张琳芃两名球员，他们是我们优秀的榜样，虽然他们有伤，今天还是坚持带伤上阵、克服了伤病的疼痛。这两名球员今天的伤不算太严重，周六与河南的比赛，至少会有一个上场。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;在这场比赛之中，斯科拉里特意又让小将王上源司职左后卫，在张琳芃下场之后，又回到右后卫的位置上。对于这名年轻球员的表现，斯科拉里说到：王上源是我们球队七八名最重要的球员之一，我对他很有信心，对他现在的表现也很放心。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;谈到足协杯的目标，斯科拉里表示：现在我们已经进入四强了，肯定不会放弃后面的比赛。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;最后，斯科拉里主动提到了前一段受伤的刘健：希望大家能够给刘健送上祝福，他因为受伤可能要进行手术，需要五六个月才能恢复，所以这个赛季不会重新回到赛场，我一直认为他也是球队的榜样，是几个队长候选人之一，希望他的精神一直能够在恒大，希望大家能够祝福，他对球队帮助非常大，在任何位置上都可以胜任，希望他能够尽快康复回到场上，我非常想念他。\n&amp;lt;/p&amp;gt;',1469713861,1469713861),(12,6,'&amp;lt;p&amp;gt;\n	北京时间7月27日晚19点35分，2016年中国足协杯八进四第二回合赛事在天津海河体育场开始一场较量，由天津权健主场迎战上海申花。上半场第9分钟晋鹏翔后场解围失误，王赟传球入禁区，高迪抢先倒地卧射得分。下半场久未露面的邓卓翔本赛季第一次在申花正赛中出场。第78分钟申花获得点球机会，但高迪的点球被杨君奋力扑出。第91分钟对裁判不敬的夏宁宁被红牌罚出，最终上海申花1比0战胜天津权健，两回合5比0晋级足协杯四强。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;双方第一回合申花主场4比0大胜。第二回合申花基本以替补选手出战，只有瓜林一人属于绝对主力。权健继续沿用全华班阵容。刚开场20秒不到，权健长传到前场，反身切入禁区的李星灿被判越位，不过慢镜头显示是误判。第2分钟申花后场长传到前场，高迪单刀杀入禁区后推射稍偏出界！第9分钟晋鹏翔后场解围，结果把球送到王赟脚下，王赟毫不犹豫，直接起脚传入禁区，高迪在防守空档处顺利拿球转身，向柏旭过来飞铲，高迪抢射，球打在向柏旭腿上弹起飞入球门，1比0，申花轻松领先！第15分钟李文博突破被储金朝放倒，瓜林左路任意球直接射门被杨君双拳打出。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;第20分钟权健中场苏缘杰在中场附近和李文博冲撞后倒地不起，比赛暂停了小会。 第24分钟申花右路快速反击，王赟下底传中，高迪中路起脚推射打在自己队员身上弹出，权健拿球立刻反击，中场附近毕津浩飞身踢倒郑达伦，毕津浩吃到黄牌。第26分钟李文博飞铲右路助攻的储金朝也吃到黄牌，李星灿任意球直接选择小角度射门，皮球稍稍高出。第30分钟郑达伦估计是臀部肌肉群拉伤，他痛苦倒地，被担架队抬出。夏宁宁换下郑达伦。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;第39分钟高迪后场犯规，李星灿任意球直接找后点埋伏的夏宁宁，可惜夏宁宁在王赟干扰下冲顶没顶到球。第43分钟瓜林左路策动进攻，王赟左路传中，郑凯木头球中柱而出，但郑凯木被判越位在先。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;下半场申花做出一个令人瞩目的换人，邓卓翔换下熊飞，这是邓卓翔本赛季第一次代表申花打正式比赛，另外王寿挺换下瓜林。第48分钟李星灿前场任意球送入禁区，晋鹏翔从王寿挺身后杀出，他的推射稍稍偏出，但哨声响起，晋鹏翔越位在先。第60分钟权健前场快攻，王寿挺从身后拉倒张修维吃到黄牌，权健获得禁区弧内任意球机会。李星灿左脚任意球打出漂亮弧线，耿晓峰飞身跃起但无奈身位太低，好在皮球砸在横梁上弹出！下半场申花通过频繁倒脚拖慢了比赛节奏，但传来传去最后一脚总不能喂到点上。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;第71分钟申花打出下半场第一脚威胁射门，王赟中路送到右侧，高迪大步流星赶上，起右脚怒射，皮球同样打中横梁弹出！第75分钟吕征换下王赟。第77分钟权健用董宇晨换下和申花两回合打得都很出彩的李星灿。第78分钟申花传球入禁区，向柏旭争球中踢翻高迪，点球！张修维不满判罚，对着主裁顾春含鼓掌，结果吃到黄牌。高迪助跑两步起左脚打大门左下角，杨君判断非常到位，一个侧扑奋力把球打出界外！\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;第81分钟吴伟超换下黄龙。第82分钟李文博抽筋倒地，两队队员立刻退到一边补水。第85分钟吕征下底传中，徐骏敏飞身抢射被吴伟超挡出界外。第87分钟郑凯木铲倒张修维吃到黄牌。第91分钟顾春突然对夏宁宁出红牌，估计夏宁宁对裁判有很不恰当的言语和举止。最终上海申花1比0战胜天津权健，两回合5比0晋级足协杯四强。\n&amp;lt;/p&amp;gt;',1469714007,1469714007),(13,7,'&amp;lt;p&amp;gt;\n	似乎一夜之间，西班牙俱乐部的中场球员开始过剩了。继巴萨出现7名中场球员竞争2个位置的情况后，皇马也出现了9名中场竞争3个位置的“盛况”，而按照一个位置两名球员的配置，皇马也多出3名中场球员。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;“必须要出售球员，然后等着看。”这是皇马高层多次重复的话语。齐达内希望在每个位置都有2名球员，这在门将、后卫、锋线上都很好解决。皇马的问题出在中场，无论是在安切洛蒂、贝尼特斯还是齐达内时代，皇马在锋线都会安排BBC组合，这样中场就会只剩下3个位置。上赛季，齐达内让卡塞米罗担任后腰，莫德里奇和克洛斯在巴西人前面活动。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;在这3名主力之外，还有厄德高和马科斯-略伦特这样的小将，挪威天才已经决定寻找新的球队，不过略伦特已经告诉皇马高层，自己决定留下。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;除了上述5位球员，皇马还有伊斯科和J罗这样的重量级球员，也不能忘记阿森西奥和科瓦契奇。加起来，3个位置都有9名球员可选，这还没算可能引进的球员。如果中场引进球员，那皇马必须卖掉几位中场。若博格巴这样的球员来，那伊斯科和J罗的日子会更难过。而皇马如果不出售球员，那阿森西奥这样的球员也很难上场。不过皇马方面不着急，俱乐部高层表示，8月31日之前，会发生很多事情。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;眼下皇马只走了阿韦洛亚和马约拉尔。马里亚诺、厄德高和略伦特都有一队编制，而莫拉塔、阿森西奥、科恩特朗都已回归。皇马需要瘦身，尤其是中场位置。卡塞米罗、莫德里奇、克洛斯不可动摇，J罗也将留下，洛伦特表示留下，伊斯科、阿森西奥、科瓦契奇难以确定，厄德高则将明确走人。8月31日之前，还会有许多故事发生。\n&amp;lt;/p&amp;gt;',1469714346,1469714346),(14,8,'&amp;lt;p&amp;gt;\n	在史诗般率领葡萄牙夺冠之后，爱尔兰的一家航空公司也为C罗送上了特别的礼物：一架带着特殊喷漆的飞机。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	在自己的推特上，爱尔兰廉价航空公司Ryanair展示了一架喷有Ryanaldo的飞机，并写道：\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	“恭喜C罗拥有全新的以你命名的飞机场，来自你最喜欢的航空公司。”\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;lt;img src=&amp;quot;/Public/image/News/2016-07-28/579a13d757d32.png&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	此前C罗的家乡马德拉岛地区政府宣布，将把当地的一座机场命名为“克里斯蒂亚诺-罗纳尔多机场”。\n&amp;lt;/p&amp;gt;',1469715460,1469715460),(15,9,'&amp;lt;p&amp;gt;\n	北京时间7月28日07:30(美国俄亥俄当地时间27日20:30)，2016国际冠军杯北美赛区一场比赛在俄亥俄球场展开角逐，皇家马德里1比3不敌巴黎圣日耳曼，18岁小将伊科内先拔头筹，替补出场的麦尼埃梅开二度，马塞洛扳回一城。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;lt;br /&amp;gt;\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;lt;img src=&amp;quot;/Public/image/News/2016-07-28/579a15b87acb1.JPG&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	这是皇马本赛季的首场热身。从尤文图斯回购的莫拉塔进入首发，恩佐-齐达内进入替补席。巴黎开场仅103秒取得领先，18岁小将伊科内前场连过4人后在10码处单刀推射入网。随后皇马展开反攻，卡塞米罗传球，伊斯科25码处射门偏出。莫拉塔切入禁区左侧的小角度射门打在边网。蒂亚戈-席尔瓦受伤被早早换下。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	皇马第18分钟险些扳平，马塞洛传球，科瓦契奇左路禁区边缘的弧线球射门被特拉普扑挡后击中远角立柱弹回。随后达尼洛右路禁区边缘外抽射高出，卡塞米罗的远射角度太正也被救出。小卢卡斯反击中右路传中，无人防守的卡瓦尼禁区边缘腾空扫射高出。替补出场麦尼埃禁区右侧传中，但卡瓦尼小禁区前抢在瓦拉内之前捅射偏出近角。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;lt;img src=&amp;quot;/Public/image/News/2016-07-28/579a16472480e.JPG&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;\n&amp;lt;/p&amp;gt;',1469716109,1469716109),(16,10,'&amp;lt;p&amp;gt;\n	北京时间7月27日，西甲卫冕冠军巴塞罗那官方宣布，已经和球队中坚马斯切拉诺达成续约协议，阿根廷人将续约3年。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;马斯切拉诺2010年以2400万欧元从利物浦加盟，虽然初期经历了一段不适应，但是此后改打中卫的小马哥成为巴萨后防中最稳定一环，他的出色表现也帮助球队取得近年的辉煌战绩。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;上赛季结束后，由于续约进展停滞，小马哥一度想要出走，此时意甲冠军尤文伸出了橄榄枝，在博格巴很可能离队的情况下，老妇人希望引进马斯切拉诺来增强中场硬度。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;不过巴萨高层随后马上采取措施，球队总监费尔南德斯更是在&amp;lt;a href=&amp;quot;http://sports.sina.com.cn/g/2015copaamerica/&amp;quot; target=&amp;quot;_blank&amp;quot;&amp;gt;美洲杯&amp;lt;/a&amp;gt;期间飞往美国亲自与他谈判，最终小马哥回心转意选择留队。\n&amp;lt;/p&amp;gt;',1469716205,1469716205),(17,11,'&amp;lt;p&amp;gt;\n	德国门将特尔施特根连续第二年提前归队参加巴萨的训练，以在与布拉沃的竞争中占据优势。德国人的敬业也获得了加泰罗尼亚媒体的好评。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;据《每日体育报》报道，特尔施特根参加了法国欧洲杯，俱乐部原本给他放假到8月8日，然而特尔施特根却主动早早结束假期回到巴塞罗那，7月28日他就要到俱乐部体育城进行训练。也就是说，他的归队整整提前了11天。不过，在巴萨队内，提前归队的不仅仅只有特尔施特根，梅西等队友也都主动缩短假期提前归队了。另外据《每日体育报》的消息，马斯切拉诺跟布斯克茨也缩短假期，提前归队。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;特尔施特根提前归队不算奇怪，因为去年也有过这样的情况下，他同样提前11天归队，在赛季初还一度在门将之争中占据优势。不过他在比赛中表现一般，在西班牙超级杯首回合的比赛中还犯下严重错误，丢掉了4个球，这让他在西甲主力门将之争中输给布拉沃。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;与此同时，布拉沃和去年夏天一样，没有提前结束假期的打算，智利国门要到8月1日才会归队参加训练。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;不过《每日体育报》也透露，特尔施特根不会参加球队在英国的集训，也不会参加周六对凯尔特人的比赛，但8月3日在斯德哥尔摩对莱切斯特，他会上场踢上一段时间。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;特尔施特根的目标是在赛季初期就占据主力门将的位置，也就是说，他希望能在西班牙超级杯对塞维利亚的比赛中首发上场。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;今时今日，布拉沃的未来会如何仍然还是未知数，瓜迪奥拉的曼城队他表示了兴趣，有传言称巴萨俱乐部也已将他列入出售名单，如果曼城能开出2000万欧元的价格，巴萨就会出售这位33岁的门将。而年轻的特尔施特根是巴萨俱乐部高层眼中的未来球星，巴萨俱乐部也给他设定了8500万欧元的合同毁约金。\n&amp;lt;/p&amp;gt;',1469716322,1469716322),(18,12,'&lt;p&gt;\n	关于图兰的未来依然有着诸多的传闻，而在昨天针对这些传闻，巴萨教练组秘书罗伯特表示“图兰铁定不走”。\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;emsp;&amp;emsp;“图兰的情况没有发生变化，他还会继续留在巴萨。上个赛季对于他来说很艰难，但是我们都记得，在他来到巴萨之前曾有过很出色的表现，我们正在等待马竞的那个图兰回来。”在昨天参加戈麦斯的亮相仪式时，罗伯特说道。\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;emsp;&amp;emsp;“我们从没考虑过卖掉图兰，这是毫无疑问的，因为毫无疑问未来他能够成为决定性的球员。”\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;emsp;&amp;emsp;“上个赛季对于他来说很艰难，这是毫无疑问的，但是我们对于新的赛季他的表现充满了期待。”\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;img src=&quot;/Public/image/News/2016-07-28/579a179f31378.jpg&quot; alt=&quot;&quot; /&gt; \n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	此前《每日体育报》和《马卡报》相继报道称，巴萨执意要卖掉图兰以回首资金，并声称有包括国米，摩纳哥等俱乐部都对图兰很感兴趣。\n&lt;/p&gt;\n&lt;p&gt;\n	而对于人们关心的另一个问题，也就是巴萨的替补前锋，罗伯特表示：\n&lt;/p&gt;\n&lt;p&gt;\n	“该来的时候总会来的，我们现在有两种选择，一个是选择一位年轻的前锋，一个是选择一个经验丰富的老将。”\n&lt;/p&gt;\n&lt;p&gt;\n	“我们需要认真分析和研究这个问题，以确定哪个选择对我们是最有利的，这是一个很复杂的事情。”\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;',1469716442,1469805765),(20,14,'&amp;lt;p&amp;gt;\n	北京时间7月28日19时30分，国际冠军杯在深圳龙岗体育中心开始1场较量，曼城90分钟与多特蒙德战为1比1平，并在点球大战中6比5胜出。上半时结束前，伊赫纳乔近射被扑出。下半时，卡斯特罗单刀打高。席尔瓦助攻阿圭罗破门。诺利托替补出场完成首秀。补时阶段，香川真司助攻普利西奇扳平。点球战进行8轮，曼城替补门将古恩扑出3个点球。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;北京鸟巢德比取消后，曼城本届杯赛只剩1场较量。与对阵拜仁相比，瓜迪奥拉更换3名首发，克里希、奥塔门迪、德尔夫出战。阵型则尝试三中卫。阿达拉比奥约、奥塔门迪、科拉罗夫坐镇后防，纳瓦斯与科拉罗夫打两翼。伊赫纳乔与新援津琴科组成锋线。多特蒙德首战4比1大胜曼联。图赫尔遣上登贝莱、罗德、巴特拉、莫尔4名新援。从多特转会曼城的京多安因膝伤无缘出战旧主。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;lt;img src=&amp;quot;/Public/image/News/2016-07-29/579b58462f412.jpg&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	一开场，克里希传中，伊赫纳乔转身摆脱帕帕斯塔索普洛斯，禁区前沿左脚凌空打偏。此后卡巴列罗开球失误，登贝莱禁区边缘劲射被奥塔门迪封堵。曼城第8分钟再度经历险情，登贝莱突入禁区被封堵，罗德得球挑传，施梅尔策左路横扫门前，但无人接应。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;lt;img src=&amp;quot;/Public/image/News/2016-07-29/579b5856db804.jpg&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	卡巴列罗再度传球失误，莫尔禁区外断球左脚弧线球偏出左上角。曼城接着打出反击，纳瓦斯低传禁区，德尔夫面对门将推射偏出左门柱。伊赫纳乔在帕帕斯塔索普洛斯脚下断球，禁区边缘左脚射门被比尔基得到。阿达拉比奥约后场丢球，登贝莱在门前18米处抽射高出。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;lt;img src=&amp;quot;/Public/image/News/2016-07-29/579b5864a9e87.jpg&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	比赛节奏有所减缓。主裁判第24分钟暂停比赛，双方球员到场边饮水。施梅尔策左路传中，莫尔前点左脚没打上力量，将球送还卡巴列罗。登贝莱突入禁区，在科拉罗夫防守下倒地，主裁判拒绝判罚点球。多特右侧角球被破坏，沙欣后点左脚凌空抽射被挡出横梁。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;lt;img src=&amp;quot;/Public/image/News/2016-07-29/579b58723dfef.jpg&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	曼城上半时结束前几乎破门！费尔南迪尼奥禁区右侧传中，伊赫纳乔停球距门7米处左脚推射，比尔基右脚挡出左门柱。津琴科左侧开出角球，阿达拉比奥约头球偏出远门柱。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;lt;img src=&amp;quot;/Public/image/News/2016-07-29/579b587edc5f4.jpg&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	下半时，瓜迪奥拉一口气换上8人，阿圭罗、席尔瓦、亚亚-图雷等主将登场，阵型恢复4后卫。图赫尔也换了6人。替补卡斯特罗分球，拉莫斯禁区左侧没有直接射门，停球再射被阿达拉比奥约挡出底线。博尼外围大力低射造成比尔基脱手，但周围无人补射。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;lt;img src=&amp;quot;/Public/image/News/2016-07-29/579b588c1f269.jpg&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	图赫尔又换3人。席尔瓦右路低传，博尼在门前13米处转身打飞。双方球员又到场边补水。多特第76分钟错失单刀，香川真司中场，霍贝尔反越位无私做球，卡斯特罗突入禁区距门9米处推射高出横梁！\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;lt;img src=&amp;quot;/Public/image/News/2016-07-29/579b5897389e9.jpg&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;lt;p&amp;gt;\n		安赫利尼奥换下科拉罗夫。曼城第79分钟打破僵局！阿达拉比奥约长传转移，安赫利尼奥左路回敲，席尔瓦与加西亚踢墙配合后禁区左侧横传，阿圭罗在门前5米处推射入网，1比0。\n	&amp;lt;/p&amp;gt;\n	&amp;lt;p&amp;gt;\n		&amp;amp;emsp;&amp;amp;emsp;诺利托换下博尼，上演首秀。斯特林换下图雷。补时第2分钟，香川真司突入禁区被费尔南迪尼奥撞倒，多特未获点球。补时第6分钟，比赛眼看就要结束，多特蒙德追平比分！左侧角球开出后，香川真司禁区左侧停球回传，普利西奇在门前11米处推射从古恩裆下入网，1比1。\n	&amp;lt;/p&amp;gt;\n	&amp;lt;p&amp;gt;\n		&amp;lt;img src=&amp;quot;/Public/image/News/2016-07-29/579b58aa08f2a.jpg&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;\n	&amp;lt;/p&amp;gt;\n此球也将比赛拖入点球战。第1轮，加西亚推射左下角被比尔基飞身单手托出！帕斯拉克推射右下角也被古恩侧扑封出！0比0。第2轮，阿达拉比奥约和香川真司均推进右下角，1比1。第3轮，费尔南迪尼奥推进右下角，卡斯特罗推射中路得手，2比2。第4轮，席尔瓦左脚推进左下角，布尔尼奇骗过古恩打进，3比3。第5轮，阿圭罗推进右下角，普利西奇推射右下角被古恩一扑入网，4比4。第6轮，诺利托推进右下角，霍贝尔左脚推进左上角，5比5。第7轮，斯特林推射左下角被比尔基扑出底线！拉尔森推射右下角也被古恩扑出！5比5。第8轮，安赫利尼奥左脚推进右下角，梅里诺左脚推射太正被古恩倒地封出，曼城6比5胜出！\n&amp;lt;/p&amp;gt;',1469798608,1469798608),(21,15,'&amp;lt;p&amp;gt;\n	随着博格巴即将加盟曼联，穆里尼奥今夏的引援计划已经差不多完成了。如今红魔阵容臃肿，穆帅对阵容进行精简是板上钉钉的事情。来自《镜报》、《太阳报》和《邮报》等多家英国媒体的消息称，穆帅计划清洗9名球员，其中还包括了施魏因斯泰格等名将。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;昨天，曼联全队进行了例行训练。《每日邮报》还玩了个文字游戏，形象的称昨天是一个“清洗般的星期四”，因为穆里尼奥通知了9名球员他们可以以转会或者租借的方式离队，其中就包括了施魏因斯泰格。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;昨天的训练中，伊布、马夏尔、施奈德林这些之前休息的球员全都回到了球队，但是施魏因斯泰格并没有出现。《邮报》称，穆里尼奥通知了施魏因斯泰格等9名球员他们可以离队，而这9个人将跟随预备队训练，所以并没有出现在一线队的训练中。\n&amp;lt;/p&amp;gt;\n&amp;lt;p style=&amp;quot;font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;&amp;quot;&amp;gt;\n	&amp;lt;img src=&amp;quot;/Public/image/News/2016-07-29/579b5908dae64.jpg&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt; \n&amp;lt;/p&amp;gt;\n&amp;lt;p style=&amp;quot;font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;&amp;quot;&amp;gt;\n	&amp;lt;br /&amp;gt;\n&amp;lt;/p&amp;gt;\n&amp;lt;p style=&amp;quot;font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;&amp;quot;&amp;gt;\n	&amp;lt;strong&amp;gt;《邮报》透露的9人名单为门萨、麦克奈尔、布莱克特、博斯维克-杰克逊、施魏因斯泰格、佩雷拉、贾努扎伊、威尔-基恩和威尔逊。目前看起来，这9名球员也不太可能出现在本周六面对加拉塔萨雷的热身赛中。&amp;lt;/strong&amp;gt; \n&amp;lt;/p&amp;gt;\n&amp;lt;p style=&amp;quot;font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;&amp;quot;&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;这其中最为引人关注的无疑是施魏因斯泰格了，这名31岁的老将上赛季以700万镑的价格加盟曼联，但由于伤病等因素，他表现平平。目前他与曼联还有2年的合同，周薪高达16万镑。\n&amp;lt;/p&amp;gt;\n&amp;lt;p style=&amp;quot;font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;&amp;quot;&amp;gt;\n	&amp;amp;emsp;&amp;amp;emsp;穆里尼奥早前就曾经公开表示过，他希望自己的阵容精简到24人，因此清洗是是计划之中的。值得一提的是，包括威尔逊、门萨、贾努扎伊、佩雷拉等年轻球员并不缺少下家，租借离队也有助于他们获得更多的出场机会，增长经验。\n&amp;lt;/p&amp;gt;\n&amp;lt;p&amp;gt;\n	&amp;lt;br /&amp;gt;\n&amp;lt;/p&amp;gt;',1469798712,1469805000);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
