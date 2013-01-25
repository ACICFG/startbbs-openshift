<?php

/**
 * The base controller which is used by the Front and the Admin controllers
 */
class Base_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
/*		// load the migrations class
		$this->load->library('migration');
	
		// Migrate to the latest migration file found
		if ( ! $this->migration->latest())
		{
			log_message('error', 'The migration failed');
		}*/
		
	}//end __construct()
	
}//end Base_Controller

class SB_Controller extends Base_Controller
{
	
	//we collect the categories automatically with each load rather than for each function
	//this just cuts the codebase down a bit
	var $categories	= '';
	
	//load all the pages into this variable so we can call it from all the methods
	var $pages = '';
	
	// determine whether to display gift card link on all cart pages
	//  This is Not the place to enable gift cards. It is a setting that is loaded during instantiation.
	var $gift_cards_enabled;
	
	function __construct(){
		
		parent::__construct();
		//载入前台模板
		$this->load->set_front_theme('default');
		//判断安装
		$file=$_SERVER['DOCUMENT_ROOT'].'/install.lock';
		if (!is_file($file)){
			redirect('/install');
		}
		$this->load->database();
	 	//网站设定
		$data['items']=$this->db->get('settings')->result_array();
		$data['settings']=array(
			'site_name'=>$data['items'][0]['value'],
			'welcome_tip'=>$data['items'][1]['value'],
			'short_intro'=>$data['items'][2]['value'],
			'show_captcha'=>$data['items'][3]['value'],
			'site_run'=>$data['items'][4]['value'],
			'site_stats'=>$data['items'][5]['value'],
			'site_keywords'=>$data['items'][6]['value'],
			'site_description'=>$data['items'][7]['value'],
			'money_title'=>$data['items'][8]['value'],
			'per_page_num'=>$data['items'][9]['value']
		 );
		 //取一个用户信息
		$data['user']=$this->db->select('uid,username,avatar')->where('uid',$this->session->userdata('uid'))->get('users')->row_array();
		//获取头像
		$this->load->library('avatarlib');
		$data['user']['big_avatar']='/uploads/avatar/'.$this->avatarlib->get_avatar($this->session->userdata('uid'), 'big');
		//全局输出
		$this->load->vars($data);

/*		//load GoCart library
		$this->load->library('Go_cart');

		//load needed models
		$this->load->model(array('Page_model', 'Product_model', 'Digital_Product_model', 'Gift_card_model', 'Option_model', 'Order_model', 'Settings_model'));
		
		//load helpers
		$this->load->helper(array('form_helper', 'formatting_helper'));
		
		//fill in our variables
		$this->categories	= $this->Category_model->get_categories_tierd(0);
		$this->pages		= $this->Page_model->get_pages();
		
		// check if giftcards are enabled
		$gc_setting = $this->Settings_model->get_settings('gift_cards');
		if(!empty($gc_setting['enabled']) && $gc_setting['enabled']==1)
		{
			$this->gift_cards_enabled = true;
		}			
		else
		{
			$this->gift_cards_enabled = false;
		}
		
		//load the theme package
		$this->load->add_package_path(APPPATH.'themes/'.$this->config->item('theme').'/');*/
	}
	
	/*
	This works exactly like the regular $this->load->view()
	The difference is it automatically pulls in a header and footer.
	*/
/*	function view($view, $vars = array(), $string=false)
	{
		if($string)
		{
			$result	 = $this->load->view('header', $vars, true);
			$result	.= $this->load->view($view, $vars, true);
			$result	.= $this->load->view('footer', $vars, true);
			
			return $result;
		}
		else
		{
			$this->load->view('header', $vars);
			$this->load->view($view, $vars);
			$this->load->view('footer', $vars);
		}
	}
	
	/*
	This function simple calls $this->load->view()
	*/
	/*
	function partial($view, $vars = array(), $string=false)
	{
		if($string)
		{
			return $this->load->view($view, $vars, true);
		}
		else
		{
			$this->load->view($view, $vars);
		}
	}*/


}

class Admin_Controller extends Base_Controller 
{
	function __construct()
	{
		
		parent::__construct();
		$this->load->database();
		//载入后台模板
		$this->load->set_admin_theme();
	 	//网站设定
		$data['items']=$this->db->get('settings')->result_array();
		$data['settings']=array(
			'site_name'=>$data['items'][0]['value'],
			'welcome_tip'=>$data['items'][1]['value'],
			'short_intro'=>$data['items'][2]['value'],
			'show_captcha'=>$data['items'][3]['value'],
			'site_run'=>$data['items'][4]['value'],
			'site_stats'=>$data['items'][5]['value'],
			'site_keywords'=>$data['items'][6]['value'],
			'site_description'=>$data['items'][7]['value'],
			'money_title'=>$data['items'][8]['value'],
			'per_page_num'=>$data['items'][9]['value']
		 );
		$this->load->vars($data);
		/** 加载验证库 */
		$this->load->library('auth');
		/** 检查登陆 */	
		$gid = $this->session->userdata('gid');
		if(!$this->auth->is_login())
		{
			echo "请登录";
			exit;
		}
		$this->load->library('myclass');
		if(!$this->auth->is_admin())
		{
			$this->myclass->notice('alert("无权访问此页");window.location.href="/";');
			exit;
		}
	}
}

class Other_Controller extends Base_Controller 
{
	function __construct()
	{
		
		parent::__construct();
		//载入前台模板
		$this->load->set_front_theme('default');

	}
}