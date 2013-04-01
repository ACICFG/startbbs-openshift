<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#doc
#	classname:	upgrade
#	scope:		PUBLIC
#	StartBBS起点轻量开源社区系统
#	author :doudou QQ:858292510 startbbs@126.com
#	Copyright (c) 2013 http://www.startbbs.com All rights reserved.
#/doc

class Upgrade extends Other_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->library('myclass');

	}
	public function index ()
	{
		$data['old_version'] = $this->config->item('version');
		$data['new_version'] = 'V1.0.6';
		if($data['new_version']==$data['old_version']){
			$data['msg'] = '您的版本为最新版，无需升级';
		} else{
			$data['msg'] = '开始升级';
		}
		$data['log'] = '';
		$this->load->view('upgrade',$data);
	}

	public function do_upgrade ()
	{
		$sql1="CREATE TABLE IF NOT EXISTS `{$this->db->dbprefix}favorites` (
		  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
		  `favorites` mediumint(8) unsigned NOT NULL DEFAULT '0',
		  `content` mediumtext NOT NULL,
		  PRIMARY KEY (`id`,`uid`),
		  KEY `uid` (`uid`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

		if($this->db->query($sql1)){
			$data['msg1'] = '添加favorites表成功';
		}
		$sql2="CREATE TABLE IF NOT EXISTS `{$this->db->dbprefix}notifications` (
		  `nid` int(11) NOT NULL AUTO_INCREMENT,
		  `fid` int(11) DEFAULT NULL,
		  `suid` int(11) DEFAULT NULL,
		  `nuid` int(11) NOT NULL DEFAULT '0',
		  `ntype` tinyint(1) DEFAULT NULL,
		  `ntime` int(10) DEFAULT NULL,
		  PRIMARY KEY (`nid`,`nuid`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

		if($this->db->query($sql2)){
			$data['msg2'] = '添加notifications表成功';
		}
		$sql3="CREATE TABLE IF NOT EXISTS `{$this->db->dbprefix}page` (
		  `pid` tinyint(6) NOT NULL AUTO_INCREMENT,
		  `title` varchar(100) DEFAULT NULL,
		  `content` text,
		  `go_url` varchar(100) DEFAULT NULL,
		  `add_time` int(10) DEFAULT NULL,
		  `is_hidden` tinyint(1) DEFAULT '0',
		  PRIMARY KEY (`pid`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

		if($this->db->query($sql3)){
			$data['msg3'] = '添加page表成功';
		}
		
		$sql4="ALTER TABLE `{$this->db->dbprefix}forums` ADD `favorites` INT( 10 ) UNSIGNED NOT NULL AFTER `comments`";
		if($this->db->query($sql4)){
			$data['msg4'] = '修改page表成功';
		}

		$sql5="ALTER TABLE `{$this->db->dbprefix}users` CHANGE `notice` `notices` SMALLINT( 5 ) NULL DEFAULT '0'";
		if($this->db->query($sql5)){
			$data['msg5'] = '修改users表成功';
		}

		$sql6="INSERT INTO `{$this->db->dbprefix}settings` (`title`, `value`, `type`) VALUES('comment_order', 'desc', 0);";
		if($this->db->query($sql6)){
			$data['msg6'] = '插入settings记录成功';
		}

		if($this->config->update('myconfig','version','V1.0.6')){
			$data['msg_v'] = '版本号更新成功';
		}
		
		$data['finish'] = '升级完成...';
		$data['error'] = '升级失败';
		exit(json_encode($data));		
	}
}