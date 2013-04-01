-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 03 月 13 日 15:19
-- 服务器版本: 5.1.50-community-log
-- PHP 版本: 5.3.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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

DROP TABLE IF EXISTS `sb_categories`;
CREATE TABLE IF NOT EXISTS `sb_categories` (
  `cid` smallint(5) NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) NOT NULL DEFAULT '0',
  `cname` varchar(30) DEFAULT NULL COMMENT '分类名称',
  `content` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `ico` varchar(128) DEFAULT NULL,
  `listnum` mediumint(8) DEFAULT NULL,
  `clevel` varchar(25) DEFAULT NULL,
  `cord` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`cid`,`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sb_comments`
--

DROP TABLE IF EXISTS `sb_comments`;
CREATE TABLE IF NOT EXISTS `sb_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL DEFAULT '0',
  `content` text,
  `replytime` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`,`fid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sb_favorites`
--

DROP TABLE IF EXISTS `sb_favorites`;
CREATE TABLE IF NOT EXISTS `sb_favorites` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `favorites` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`,`uid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sb_forums`
--

DROP TABLE IF EXISTS `sb_forums`;
CREATE TABLE IF NOT EXISTS `sb_forums` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` smallint(5) NOT NULL DEFAULT '0',
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `ruid` mediumint(8) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `content` text,
  `addtime` int(10) DEFAULT NULL,
  `updatetime` int(10) DEFAULT NULL,
  `lastreply` int(10) DEFAULT NULL,
  `views` int(10) DEFAULT '0',
  `comments` smallint(8) DEFAULT '0',
  `favorites` int(10) unsigned NOT NULL,
  `closecomment` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`fid`,`cid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sb_groups`
--

DROP TABLE IF EXISTS `sb_groups`;
CREATE TABLE IF NOT EXISTS `sb_groups` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `group_name` varchar(50) DEFAULT NULL,
  `usernum` int(11) NOT NULL,
  PRIMARY KEY (`gid`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sb_links`
--

DROP TABLE IF EXISTS `sb_links`;
CREATE TABLE IF NOT EXISTS `sb_links` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `logo` varchar(200) NOT NULL,
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sb_links`
--

INSERT INTO `sb_links` (`id`, `name`, `url`, `logo`, `is_hidden`) VALUES
(1, 'StartBBS', 'http://www.startbbs.com', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `sb_notifications`
--

DROP TABLE IF EXISTS `sb_notifications`;
CREATE TABLE IF NOT EXISTS `sb_notifications` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) DEFAULT NULL,
  `suid` int(11) DEFAULT NULL,
  `nuid` int(11) NOT NULL DEFAULT '0',
  `ntype` tinyint(1) DEFAULT NULL,
  `ntime` int(10) DEFAULT NULL,
  PRIMARY KEY (`nid`,`nuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sb_page`
--

DROP TABLE IF EXISTS `sb_page`;
CREATE TABLE IF NOT EXISTS `sb_page` (
  `pid` tinyint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `go_url` varchar(100) DEFAULT NULL,
  `add_time` int(10) DEFAULT NULL,
  `is_hidden` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sb_settings`
--

DROP TABLE IF EXISTS `sb_settings`;
CREATE TABLE IF NOT EXISTS `sb_settings` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `type` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`title`,`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `sb_settings`
--

INSERT INTO `sb_settings` (`id`, `title`, `value`, `type`) VALUES
(1, 'site_name', 'StartBBS- 起点开源论坛-烧饼bbs', 0),
(2, 'welcome_tip', '欢迎访问Startbbs起点开源社区', 0),
(3, 'short_intro', '新一代简洁社区软件', 0),
(4, 'show_captcha', 'on', 0),
(5, 'site_run', '0', 0),
(6, 'site_stats', '0', 0),
(7, 'site_keywords', '轻量 •  易用  •  社区系统', 0),
(8, 'site_description', '测试一下', 0),
(9, 'money_title', '0', 0),
(10, 'per_page_num', '0', 0),
(11, 'is_rewrite', 'off', 0),
(12, 'show_editor', 'off', 0),
(13, 'comment_order', 'desc', 0);

-- --------------------------------------------------------

--
-- 表的结构 `sb_tags`
--

DROP TABLE IF EXISTS `sb_tags`;
CREATE TABLE IF NOT EXISTS `sb_tags` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `fid` int(11) NOT NULL DEFAULT '0',
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`tid`,`uid`,`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sb_users`
--

DROP TABLE IF EXISTS `sb_users`;
CREATE TABLE IF NOT EXISTS `sb_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `openid` char(32) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `avatar` varchar(100) NOT NULL,
  `homepage` varchar(50) DEFAULT NULL,
  `money` int(11) DEFAULT '100',
  `signature` text,
  `forums` int(11) DEFAULT '0',
  `replies` int(11) DEFAULT '0',
  `notices` smallint(5) DEFAULT '0',
  `regtime` int(10) DEFAULT NULL,
  `lastlogin` int(10) NOT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `gid` tinyint(3) NOT NULL DEFAULT '0',
  `ip` char(15) DEFAULT NULL,
  `location` varchar(128) DEFAULT NULL,
  `token` varchar(40) DEFAULT NULL,
  `introduction` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`,`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
