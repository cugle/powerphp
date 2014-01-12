-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 12, 2014 at 05:34 PM
-- Server version: 5.5.35
-- PHP Version: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `powerphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `think_access`
--

CREATE TABLE IF NOT EXISTS `think_access` (
  `role_id` smallint(5) unsigned NOT NULL,
  `node_id` smallint(5) unsigned NOT NULL,
  `level` tinyint(4) NOT NULL,
  `pid` smallint(6) NOT NULL,
  KEY `role_id` (`role_id`,`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `think_access`
--

INSERT INTO `think_access` (`role_id`, `node_id`, `level`, `pid`) VALUES
(1, 1, 1, 0),
(1, 2, 2, 1),
(1, 9, 3, 2),
(1, 7, 3, 2),
(2, 7, 3, 2),
(1, 5, 2, 1),
(1, 11, 3, 5),
(2, 1, 1, 0),
(1, 8, 3, 2),
(2, 2, 2, 1),
(1, 1, 1, 0),
(1, 2, 2, 1),
(1, 9, 3, 2),
(1, 7, 3, 2),
(2, 7, 3, 2),
(1, 5, 2, 1),
(1, 11, 3, 5),
(2, 1, 1, 0),
(1, 8, 3, 2),
(2, 2, 2, 1),
(1, 2, 2, 1),
(1, 9, 3, 2),
(1, 7, 3, 2),
(2, 7, 3, 2),
(1, 5, 2, 1),
(1, 11, 3, 5),
(2, 1, 1, 0),
(1, 8, 3, 2),
(2, 2, 2, 1),
(1, 47, 2, 1),
(1, 48, 3, 47),
(1, 49, 3, 47),
(1, 50, 3, 47),
(1, 51, 3, 47),
(1, 51, 2, 1),
(1, 52, 3, 51),
(1, 53, 3, 51),
(1, 54, 3, 51),
(1, 13, 2, 1),
(1, 14, 3, 13),
(1, 15, 3, 13),
(1, 16, 3, 13),
(1, 17, 3, 13),
(1, 18, 2, 1),
(1, 19, 3, 18),
(1, 20, 3, 18),
(1, 21, 3, 18),
(1, 22, 3, 18),
(1, 55, 2, 1),
(1, 56, 3, 55),
(1, 57, 3, 55),
(1, 58, 3, 55);

-- --------------------------------------------------------

--
-- Table structure for table `think_node`
--

CREATE TABLE IF NOT EXISTS `think_node` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL,
  `sort` smallint(5) unsigned NOT NULL,
  `pid` smallint(5) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`status`,`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `think_node`
--

INSERT INTO `think_node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES
(1, 'Admin', '后台管理', 1, '后台项目', 0, 0, 1),
(2, 'Section', '单元管理', 1, '控制器', 1, 1, 2),
(3, 'Category', '分类管理', 1, '控制器', 2, 1, 2),
(4, 'Article', '文章管理', 1, '控制器', 3, 1, 2),
(5, 'Index', '后台默认', 1, '控制器', 0, 1, 2),
(6, 'Public', '公共管理', 1, '控制器', 0, 1, 2),
(7, 'index', '单元列表', 1, '动作', 0, 2, 3),
(8, 'add', '添加单元', 1, '动作', 9, 2, 3),
(9, 'edit', '编辑单元', 1, '动作', 0, 2, 3),
(10, 'delete', '删除单元', 1, '动作', 0, 2, 3),
(11, 'index', '默认动作', 1, '动作', 0, 5, 3),
(12, 'index', '分类列表', 1, '动作', 0, 3, 3),
(13, 'User', '用户管理', 1, '控制器', 0, 1, 2),
(14, 'index', '用户列表', 1, '动作', 0, 13, 3),
(15, 'add', '添加用户', 1, '动作', 0, 13, 3),
(16, 'edit', '编辑用户', 1, '动作', 0, 13, 3),
(17, 'delete', '删除用户', 1, '动作', 0, 13, 3),
(18, 'Role', '用户分组管理', 1, '控制器', 0, 1, 2),
(19, 'index', '用户分组列表', 1, '动作', 0, 18, 3),
(20, 'add', '用户分组添加', 1, '动作', 0, 18, 3),
(21, 'edit', '用户分组编辑', 1, '动作', 0, 18, 3),
(22, 'delete', '用户分组删除', 1, '动作', 0, 18, 3),
(23, 'add', '添加分类', 1, '动作', 0, 3, 3),
(24, 'edit', '编辑分类', 1, '动作', 0, 3, 3),
(25, 'delete', '删除分类', 1, '动作', 0, 3, 3),
(26, 'index', '文章列表', 1, '动作', 0, 4, 3),
(27, 'add', '添加文章', 1, '动作', 0, 4, 3),
(28, 'edit', '编辑文章', 1, '动作', 0, 4, 3),
(29, 'delete', '删除文章', 1, '动作', 0, 4, 3),
(30, 'Menu', '菜单管理', 1, '控制器', 0, 1, 2),
(31, 'index', '菜单列表', 1, '动作', 0, 30, 3),
(32, 'add', '添加菜单', 1, '动作', 0, 30, 3),
(33, 'edit', '编辑菜单', 1, '动作', 0, 30, 3),
(34, 'delete', '删除菜单', 1, '动作', 0, 30, 3),
(35, 'MenuItem', '菜单项管理', 1, '控制器', 0, 1, 2),
(36, 'component', '菜单项选择内容', 1, '动作', 0, 35, 3),
(37, 'add', '添加菜单项', 1, '动作', 0, 35, 3),
(38, 'edit', '编辑菜单项', 1, '动作', 0, 35, 3),
(39, 'index', '菜单项列表', 1, '动作', 0, 35, 3),
(40, 'Modules', '模块管理', 1, '控制器', 0, 1, 2),
(41, 'modules', '选择模块', 1, '动作', 0, 40, 3),
(42, 'add', '添加模块', 1, '动作', 0, 40, 3),
(43, 'edit', '编辑模块', 1, '动作', 0, 40, 3),
(44, 'index', '模块列表', 1, '动作', 0, 40, 3),
(45, 'delete', '删除模块', 1, '动作', 0, 40, 3),
(46, 'delete', '删除菜单项', 1, '动作', 0, 35, 3),
(47, 'Access', '权限管理', 1, '控制器', 10, 1, 2),
(48, 'index', '权限列表', 1, '方法', 10, 47, 3),
(49, 'add', '新增权限', 1, '方法', 10, 47, 3),
(50, 'edit', '编辑权限', 1, '方法', 10, 47, 3),
(51, 'Node', '节点管理', 1, '控制器', 10, 1, 2),
(52, 'index', '节点列表', 1, '方法', 10, 51, 3),
(53, 'add', '新增节点', 1, '方法', 10, 51, 3),
(54, 'edit', '编辑节点', 1, '方法', 10, 51, 3),
(55, 'Roleuser', '用户分组', 1, '控制器', 10, 1, 2),
(56, 'index', '用户分组列表', 1, '方法', 10, 55, 3),
(57, 'add', '添加用户分组', 1, '方法', 10, 55, 3),
(58, 'edit', '编辑用户分组', 1, '方法', 10, 55, 3);

-- --------------------------------------------------------

--
-- Table structure for table `think_role`
--

CREATE TABLE IF NOT EXISTS `think_role` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `think_role`
--

INSERT INTO `think_role` (`id`, `name`, `pid`, `status`, `remark`) VALUES
(1, '超级管理员', 0, 1, '超级管理员分组'),
(2, '普通管理员', 0, 1, '普通管理员分组'),
(3, '注册用户', 0, 1, '注册用户分组'),
(4, '注册商户', 0, 1, '注册商户分组');

-- --------------------------------------------------------

--
-- Table structure for table `think_role_user`
--

CREATE TABLE IF NOT EXISTS `think_role_user` (
  `role_id` mediumint(8) unsigned NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  KEY `role_id` (`role_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `think_role_user`
--

INSERT INTO `think_role_user` (`role_id`, `user_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `think_setting`
--

CREATE TABLE IF NOT EXISTS `think_setting` (
  `name` varchar(100) NOT NULL,
  `data` text NOT NULL,
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `think_setting`
--

INSERT INTO `think_setting` (`name`, `data`) VALUES
('site_name', 'MobileCms移动后台管理系统'),
('site_title', 'MobileCms移动后台管理系统'),
('site_keyword', 'MobileCms移动后台管理系统，phonegap100.com'),
('site_description', 'MobileCms是一款移动互联网软件后台管理系统，由phonegap100.com 提供'),
('site_status', '1'),
('site_icp', '京ICP备88888888号'),
('statistics_code', ''),
('closed_reason', '升级'),
('site_domain', 'http://localhost/wego25'),
('weibo_url', 'http://www.weibo.com'),
('qqzone_url', ''),
('douban_url', ''),
('attachment_size', '3145728'),
('template', 'default'),
('taobao_app_key', '12504724'),
('qq_app_key', ''),
('qq_app_Secret', ''),
('sina_app_key', '100308089'),
('sina_app_Secret', '25ee4d31ca98edea230885985e1cf2e1'),
('taobao_app_secret', '9d6877190386092d4288dcae32811081'),
('url_model', '0'),
('attachment_path', 'data/uploads'),
('client_hash', ''),
('attachment_type', 'jpg,gif,png,jpeg'),
('miao_appkey', '1003336'),
('miao_appsecret', '0847c5008f99150de65fad8e8ec342fa'),
('mail_smtp', 'smtp.163.com'),
('mail_username', ''),
('mail_password', 'PassWord01!'),
('mail_port', '25'),
('mail_fromname', 'MobileCms'),
('check_code', '1'),
('comment_time', '10'),
('site_share', '<meta property=\\"qc:admins\\" content=\\"271503564761116217636\\" />'),
('ban_sipder', 'youdaobot|bingbot'),
('ban_ip', '192.168.1.50'),
('site_logo', './data/setting/524a5cbde8499.jpg'),
('article_count', '10'),
('html_suffix', '.html'),
('mail_username', 'ho1000003@163.com\r\nho1000004@163.com\r\nho1000005@163.com\r\nhml100000@163.com'),
('mail_receive_username', ''),
('mail_content', '<body style=\\"margin: 10px;\\">\r\n<div align=\\"center\\"><img src=\\"http://www.phonegap100.com/static/image/common/logo.png\\"></div><br>\r\n<br>\r\n <h3>欢迎使用 树根cms 此系统由phonegap中文网 <a href=\\"http://www.phonegap100.com\\" target=\\"_blank\\">phonegap100.com</a>提供 </h3>\r\n<br>\r\n\r\n在使用中遇到任何问题，请到phonegap中文网提出，感谢大家对此程序的支持，我们的qq群：295402925\r\n\r\n</body>'),
('mail_title', '欢迎使用树根cms，这是一封感谢信');

-- --------------------------------------------------------

--
-- Table structure for table `think_user`
--

CREATE TABLE IF NOT EXISTS `think_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `reg_date` datetime NOT NULL,
  `last_login_date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `think_user`
--

INSERT INTO `think_user` (`id`, `username`, `password`, `name`, `email`, `reg_date`, `last_login_date`, `active`, `params`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'administrator', 'admin@admin.com', '2014-01-01 09:23:44', '2010-03-23 21:39:15', 1, ''),
(2, 'cugle', '', 'cugle', 'cugle@admin.com', '2014-01-01 09:23:44', '2010-03-23 21:39:15', 1, ''),
(3, 'yongfu', '', 'yongfu', 'yongfu@admin.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
