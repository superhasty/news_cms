mysql系统设置
mysql_mode设置mysql模式
mysql_mode=NO_AUTO_VALUE_ON_ZERO
对于自增长主键,禁止0,只能通过NULL生成下一个序列号

数据库设计
1. cms_admin         网站后台管理员信息表
admin_id, username,   password,   lastloginIP, lastloginTime, email, realName, status
管理员ID，管理员账号，管理员密码，最近登陆IP， 最近登陆时间，  邮箱，真实姓名，登陆状态

2. cms_menu          网站后台菜单管理表
menu_id,name,     parentid, module, controller, action,   description, order,     status,   type
菜单ID, 菜单名称, 父菜单ID, 模块名, 控制器名, 操作方法名, 菜单描述, 菜单排列规则, 菜单状态, 菜单类型

3. cms_news          网站新闻摘要信息表
news_id, programid, title, subtitle, titlecolor, thumb, keywords, description, contentid, order, status, copyfrom, author, createtime, updatetime
新闻ID, 栏目ID, 标题, 副标题, 标题颜色, 缩略图, 关键字, 简介, 文章内容ID, 新闻排序规则, 新闻状态, 新闻来源, 新闻作者, 创建时间, 更新时间

4. cms_news_content  网站新闻主体内容表
content_id, news_id,    content,  createtime, updatetime
新闻正文ID, 新闻摘要ID, 新闻正文, 创建时间,   更新时间

5. cms_position      网站分类位置表
6. cms_position_content      网站分类内容表