<?php
class Site_settings extends Admin_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('myclass');
	}

	public function index()
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
				array('value'=>$this->input->post('money_title'),'id'=>9),
				array('value'=>$this->input->post('per_page_num'),'id'=>10)
			);
			$this->db->update_batch('settings', $str, 'id');
			$this->myclass->notice('alert("网站设置更新成功");window.location.href="/admin/site_settings";');
			
		}
		$data['item'] = $this->db->get_where('settings',array('type'=>0))->result_array();		
		$this->load->view('site_settings', $data);

	}

	
}