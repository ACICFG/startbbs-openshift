-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 01 月 18 日 07:03
-- 服务器版本: 5.0.90
-- PHP 版本: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `startbbs`
--

-- --------------------------------------------------------

--
-- 表的结构 `sb_categories`
--
-- 创建时间: 2013 年 01 月 18 日 15:02
-- 最后更新: 2013 年 01 月 18 日 15:02
--

DROP TABLE IF EXISTS `sb_categories`;
CREATE TABLE IF NOT EXISTS `sb_categories` (
  `cid` smallint(5) NOT NULL auto_increment,
  `pid` smallint(5) NOT NULL,
  `cname` varchar(30) character set utf8 default NULL COMMENT '分类名称',
  `content` varchar(255) character set utf8 default NULL,
  `keywords` varchar(255) character set utf8 default NULL,
  `ico` varchar(128) character set utf8 default NULL,
  `listnum` mediumint(8) default NULL,
  `clevel` varchar(25) character set utf8 default NULL,
  `cord` smallint(6) default NULL,
  PRIMARY KEY  (`cid`,`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `sb_categories`
--


-- --------------------------------------------------------

--
-- 表的结构 `sb_comments`
--
-- 创建时间: 2013 年 01 月 18 日 15:02
-- 最后更新: 2013 年 01 月 18 日 15:02
--

DROP TABLE IF EXISTS `sb_comments`;
CREATE TABLE IF NOT EXISTS `sb_comments` (
  `id` int(11) NOT NULL auto_increment,
  `fid` int(11) NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  `content` text,
  `replytime` char(10) default NULL,
  PRIMARY KEY  (`id`,`fid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `sb_comments`
--


-- --------------------------------------------------------

--
-- 表的结构 `sb_forums`
--
-- 创建时间: 2013 年 01 月 18 日 15:02
-- 最后更新: 2013 年 01 月 18 日 15:02
--

DROP TABLE IF EXISTS `sb_forums`;
CREATE TABLE IF NOT EXISTS `sb_forums` (
  `fid` int(11) NOT NULL auto_increment,
  `cid` smallint(5) NOT NULL default '0',
  `uid` mediumint(8) NOT NULL default '0',
  `ruid` mediumint(8) NOT NULL,
  `title` varchar(128) character set utf8 default NULL,
  `keywords` varchar(255) character set utf8 default NULL,
  `content` text character set utf8,
  `addtime` int(10) default NULL,
  `updatetime` int(10) default NULL,
  `lastreply` int(10) default NULL,
  `views` int(10) default '0',
  `comments` smallint(8) default '0',
  `closecomment` tinyint(1) default NULL,
  PRIMARY KEY  (`fid`,`cid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `sb_forums`
--


-- --------------------------------------------------------

--
-- 表的结构 `sb_groups`
--
-- 创建时间: 2013 年 01 月 09 日 17:21
-- 最后更新: 2013 年 01 月 09 日 17:21
--

DROP TABLE IF EXISTS `sb_groups`;
CREATE TABLE IF NOT EXISTS `sb_groups` (
  `gid` int(11) NOT NULL default '0',
  `type` tinyint(3) NOT NULL default '0',
  `group_name` varchar(50) character set utf8 default NULL,
  `usernum` int(11) NOT NULL,
  PRIMARY KEY  (`gid`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `sb_groups`
--


-- --------------------------------------------------------

--
-- 表的结构 `sb_links`
--
-- 创建时间: 2013 年 01 月 09 日 17:21
-- 最后更新: 2013 年 01 月 09 日 17:21
--

DROP TABLE IF EXISTS `sb_links`;
CREATE TABLE IF NOT EXISTS `sb_links` (
  `id` smallint(6) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `url` varchar(200) default NULL,
  `logo` varchar(200) NOT NULL,
  `is_hidden` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sb_links`
--

INSERT INTO `sb_links` (`id`, `name`, `url`, `logo`, `is_hidden`) VALUES
(1, 'StartBBS', 'http://www.startbbs.com', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `sb_settings`
--
-- 创建时间: 2013 年 01 月 09 日 17:21
-- 最后更新: 2013 年 01 月 09 日 17:21
--

DROP TABLE IF EXISTS `sb_settings`;
CREATE TABLE IF NOT EXISTS `sb_settings` (
  `id` tinyint(5) NOT NULL auto_increment,
  `title` varchar(255) character set utf8 NOT NULL default '',
  `value` text character set utf8 NOT NULL,
  `type` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id`,`title`,`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `sb_settings`
--

INSERT INTO `sb_settings` (`id`, `title`, `value`, `type`) VALUES
(1, 'site_name', 'StartBBS- 起点开源论坛', 0),
(2, 'welcome_tip', '欢迎访问Startbbs起点开源社区', 0),
(3, 'short_intro', '新一代简洁社区软件', 0),
(4, 'show_captcha', 'off', 0),
(5, 'site_run', 'on', 0),
(6, 'site_stats', '0', 0),
(7, 'site_keywords', '轻量 •  易用  •  社区系统', 0),
(8, 'site_description', '0', 0),
(9, 'money_title', '0', 0),
(10, 'per_page_num', '0', 0);

-- --------------------------------------------------------

--
-- 表的结构 `sb_tags`
--
-- 创建时间: 2013 年 01 月 09 日 17:21
-- 最后更新: 2013 年 01 月 09 日 17:21
--

DROP TABLE IF EXISTS `sb_tags`;
CREATE TABLE IF NOT EXISTS `sb_tags` (
  `tid` int(11) NOT NULL default '0',
  `content` varchar(255) character set utf8 default NULL,
  `uid` int(11) NOT NULL default '0',
  `fid` int(11) NOT NULL default '0',
  `addtime` datetime default NULL,
  PRIMARY KEY  (`tid`,`uid`,`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `sb_tags`
--


-- --------------------------------------------------------

--
-- 表的结构 `sb_users`
--
-- 创建时间: 2013 年 01 月 18 日 15:02
-- 最后更新: 2013 年 01 月 18 日 15:02
--

DROP TABLE IF EXISTS `sb_users`;
CREATE TABLE IF NOT EXISTS `sb_users` (
  `uid` int(11) NOT NULL auto_increment,
  `username` varchar(20) character set utf8 default NULL,
  `password` char(32) character set utf8 default NULL,
  `email` varchar(50) character set utf8 default NULL,
  `avatar` varchar(100) character set utf8 NOT NULL,
  `homepage` varchar(50) character set utf8 default NULL,
  `money` int(11) default '100',
  `signature` text character set utf8,
  `forums` int(11) default '0',
  `replies` int(11) default '0',
  `notice` smallint(5) default '0',
  `regtime` int(10) default NULL,
  `lastlogin` int(10) NOT NULL,
  `qq` varchar(20) character set utf8 default NULL,
  `gid` tinyint(3) NOT NULL default '0',
  `ip` char(15) character set utf8 default NULL,
  `location` varchar(128) character set utf8 default NULL,
  `token` varchar(40) character set utf8 default NULL,
  `introduction` text character set utf8,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`uid`,`avatar`,`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `sb_users`
--

