<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#doc
#	classname:	Home
#	scope:		PUBLIC
#	StartBBS起点轻量开源社区系统
#	author :doudou QQ:858292510 startbbs@126.com
#	Copyright (c) 2013 http://www.startbbs.com All rights reserved.
#/doc

class Home extends SB_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('forum_m');
		$this->load->model('cate_m');
		$this->load->library('myclass');
		$this->load->model('link_m');
	}
	public function index ()
	{
		//获取列表
		$data['list'] = $this->forum_m->get_latest_forums(10);
		$data['catelist'] =$this->cate_m->get_all_cates();
		$this->db->cache_on();
		$data['total_forums']=$this->db->count_all('forums');
		$data['total_comments']=$this->db->count_all('comments');
		$this->db->cache_off();
		$data['total_users']=$this->db->count_all('users');
		$data['last_user']=$this->db->select('username',1)->order_by('uid','desc')->get('users')->row_array();

		//links
		$data['links']=$this->link_m->get_latest_links(10);
		$this->load->view('home',$data);
	}
	public function latest()
	{
		$data['list'] = $this->forum_m->get_latest_forums(5);
		$this->load->view('latest',$data);
	}
	public function search()
	{
		$data['q'] = $this->input->get('q', TRUE);
		$data['title'] = '搜索';
		$this->load->view('search',$data);
	}


}
