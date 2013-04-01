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
		//基本设置
		if($_POST && $_GET['a']=='basic'){
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
				array('value'=>$this->input->post('per_page_num'),'id'=>10),
				array('value'=>$this->input->post('is_rewrite'),'id'=>11),
				array('value'=>$this->input->post('show_editor'),'id'=>12),
				array('value'=>$this->input->post('comment_order'),'id'=>13),
			);
			$this->db->update_batch('settings', $str, 'id');
			//更新config文件
			if($this->input->post('is_rewrite')=='on'){
				$config['index_page']='';
			} else {
				$config['index_page']='index.php';
			}
			$config['show_captcha']=($this->input->post('show_captcha')=='on')?$config['show_captcha']='on':$config['show_captcha']='off';
			$config['show_editor']=($this->input->post('show_editor')=='on')?$config['show_editor']='on':$config['show_editor']='off';
			$config['comment_order']=($this->input->post('comment_order')=='asc')?$config['comment_order']='asc':$config['comment_order']='desc';
			$config['basic_folder']=$this->config->item('basic_folder');
			$config['version']=($this->config->item('version'))?$this->config->item('version'):'V1.0.5';
			$this->config->set_item('myconfig', $config);
			$this->config->save('myconfig',$config);
			$this->myclass->notice('alert("网站设置更新成功");window.location.href="'.site_url('admin/site_settings').'";');
	
		}
		//openid设定
		if($_POST && $_GET['a']=='openid'){
			$qq_callback = 'oauth/qqcallback';
			$this->config->update('openid','qq_appid', $this->input->post('qq_appid'));
			$this->config->update('openid','qq_appkey', $this->input->post('qq_appkey'));
			$this->config->update('openid','qq_callback', $qq_callback);
			$this->myclass->notice('alert("openid更新成功");window.location.href="'.site_url('admin/site_settings').'";');
		}
		
		$data['item'] = $this->db->get_where('settings',array('type'=>0))->result_array();

		$this->load->view('site_settings', $data);

	}

	
}