<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends Admin_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('myclass');
	}

	public function index ($page=1)
	{
		$data['title'] = '用户管理';
		//分页
		$limit = 10;
		$config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = '/admin/users';
		$config['total_rows'] = $this->db->count_all('users');
		$config['per_page'] = $limit;
		$config['first_link'] ='首页';
		$config['last_link'] ='尾页';
		$config['cur_tag_open'] = '<li class=\'active\'>';
		$config['cur_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = '&rarr;';
		$config['next_tag_open'] = '<li class=\'next\'>';
		$config['next_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class=\'last\'>';
		$config['last_tag_close'] = '</li>';
		$config['num_links'] = 10;
		
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		
		$start = ($page-1)*$limit;
		$data['pagination'] = $this->pagination->create_links();
		
		$data['users'] = $this->user_m->get_all_users($start, $limit);
		$this->load->view('users', $data);
		
	}
	public function index1()
	{
		$data['title'] = '站点设置';
		if($_POST){
			$str = array(
				array('value'=>$this->input->post('site_name'),'id'=>1),
				array('value'=>$this->input->post('welcome_tip'),'id'=>2),
				array('value'=>$this->input->post('short_intro'),'id'=>3),
				array('value'=>$this->input->post('show_captcha'),'id'=>4),
				array('value'=>$this->input->post('site_run'),'id'=>5),
				array('value'=>$this->input->post('site_stats'),'id'=>6),
				array('value'=>$this->input->post('site_keywords'),'id'=>7),
				array('value'=>$this->input->post('site_description'),'id'=>8),
				array('value'=>$this->input->post('reward_title'),'id'=>9),
				array('value'=>$this->input->post('per_page_num'),'id'=>10)
			);
			$this->db->update_batch('settings', $str, 'id');
			$this->myclass->notice('alert("网站设置更新成功");window.location.href="/admin/site_settings";');
			
		}
		$data['item'] = $this->db->get_where('settings',array('type'=>0))->result_array();		
		$this->load->view('users', $data);

	}
	public function edit($uid)
	{
		$data['title'] = '修改用户信息';
		if($_POST){
			$str = array(
				'username'=> $this->input->post('username'),
				'email'=> $this->input->post('email'),
				'password'=> md5($this->input->post('password')),
				'homepage'=> $this->input->post('homepage'),
				'location'=> $this->input->post('location'),
				'qq'=> $this->input->post('qq'),
				'signature'=> $this->input->post('signature'),
				'introduction'=> $this->input->post('introduction'),
				'money'=> $this->input->post('money')
			);
			if($this->user_m->update_user($uid, $str)){
				$this->myclass->notice('alert("修改用户成功");window.location.href="/admin/users";');
			}

		}
		$data['user'] = $this->user_m->get_user_by_id($uid);
		$this->load->view('user_edit', $data);
	}


	
}