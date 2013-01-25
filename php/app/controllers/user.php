<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#doc
#	classname:	User
#	scope:		PUBLIC
#
#/doc

class User extends SB_Controller
{

	function __construct ()
	{
		parent::__construct();
		$this->load->model ('user_m');
		$this->load->library('myclass');

	}
	public function info ($uid)
	{
		$data = $this->user_m->get_user_by_id($uid);
		//用户大头像
		$this->load->library('avatarlib');
		$data['big_avatar']='/uploads/avatar/'.$this->avatarlib->get_avatar($uid, 'big');
		//此用户发贴
		$this->load->model('forum_m');
		$data['user_posts'] = $this->forum_m->get_forums_by_uid($uid,5);
		//此用户回贴
		$this->load->model('comment_m');
		$data['user_comments'] = $this->comment_m->get_comments_by_uid($uid,5);
		$this->load->view('userinfo', $data);
		
	}
	public function reg ()
	{
		//加载form类，为调用错误函数,需view前加载
		$this->load->helper('form');
		
		$data['title'] = '注册新用户';
		if ($this->auth->is_login()) {
			$this->myclass->notice('alert("已登录，请退出再注册");history.back();');
		}
		if($_POST && $this->validate_reg_form()){
			$data = array(
				'username' => $this->input->post('username',true),
				'password' => md5($this->input->post('password',true)),
				'email' => $this->input->post('email',true),
				'ip' => $this->myclass->get_ip(),
				'gid' => 1,
				'regtime' => time(),
				'is_active' => 1
			);
			$check_reg = $this->user_m->check_reg($data['email']);
			$check_username = $this->user_m->check_username($data['username']);
			if(!empty($check_reg)){
				$this->myclass->notice('alert("邮箱已注册，请换一个邮箱！");history.back();');
			} elseif(!empty($check_username)){
				$this->myclass->notice('alert("用户名已存在!!");history.back();');
				} elseif(md5($this->input->post('password_c'))!=$data['password']){
					$this->myclass->notice('alert("密码输入不一致!!");history.back();');
				} else {
					if($this->user_m->reg($data)){
						$uid = $this->db->insert_id();
						$this->session->set_userdata(array ('uid' => $uid, 'username' => $data['username'], 'password' =>$data['password'], 'gid' => $data['gid']) );
					}
					Header( "Location: /");
					exit;
				}

		} else{
			$this->load->view('reg',$data);
		}
	}

	private function validate_reg_form(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email' , 'trim|required|min_length[3]|max_length[50]|valid_email');
		$this->form_validation->set_rules('username', '昵称' , 'trim|required|min_length[2]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('password', '用户密码' , 'trim|required|min_length[6]|max_length[40]|matches[password_c]');
		$this->form_validation->set_rules('password_c', '密码验证' , 'trim|required|min_length[6]|max_length[40]');
		$this->form_validation->set_message('required', "%s 不能为空！");
		$this->form_validation->set_message('min_length', "%s 最小长度不少于 %s 个字符！");
		$this->form_validation->set_message('matches', "两次密码不一致");
		$this->form_validation->set_message('valid_email', "邮箱格式不对");
		if ($this->form_validation->run() == FALSE){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	public function login ()
	{
		$data['title'] = '用户登录';
/*		$data['referer']=$this->input->get('referer');
		$data['referer']=$data['referer']?$data['referer']: $this->input->server('HTTP_REFERER');*/
		if($this->auth->is_login()){
			$this->myclass->notice('alert("此用户已登录");window.location.href="/";');
		}
		if($_POST){
			$username = $this->input->post('username',true);
			$password = $this->input->post('password',true);
			$user = $this->user_m->check_login($username, $password);
			if(count($user)){
				//更新session
				$this->session->set_userdata(array ('uid' => $user['uid'], 'username' => $user['username'], 'password' =>$user['password'], 'gid' => $user['gid']) );
				//设置cookie
				$cookie = array(
                   'name'   => 'uid',
                   'value'  => $user['uid'],
                   'expire' => '86400',
                   'domain' => '.'.$this->myclass->get_domain(site_url()),
                   'path'   => '/'
               );
               
	            $this->input->set_cookie($cookie);
	            $cookie = array(
	                'name'   => 'username',
	                'value'  => $user['username'],
	                'expire' => '86400',
	                'domain' => '.'.$this->myclass->get_domain(site_url()),
	                'path'   => '/'
	            );
            	$this->input->set_cookie($cookie);
	            $cookie = array(
	                'name'   => 'password',
	                'value'  => $user['password'],
	                'expire' => '86400',
	                'domain' => '.'.$this->myclass->get_domain(site_url()),
	                'path'   => '/'
	            );
            	$this->input->set_cookie($cookie);
	            $cookie = array(
	                'name'   => 'gid',
	                'value'  => $user['gid'],
	                'expire' => '86400',
	                'domain' => '.'.$this->myclass->get_domain(site_url()),
	                'path'   => '/'
	            );
            	$this->input->set_cookie($cookie);
				Header( "Location: /");
				exit;
			} else {
				$this->myclass->notice('alert("用户名或密码错误!!");history.back();');
			}
		} else {
			$this->load->view('login',$data);
		}
		
	}

	public function logout ()
	{
		$this->session->sess_destroy();
		
		$this->load->helper('cookie');
		delete_cookie('uid');
		delete_cookie('username');
		delete_cookie('password');
		delete_cookie('gid');
		
		Header("Location: ".site_url('user/login'));
		exit;
	}

	public function settings()
	{
		$data['title'] = '账户设置';
		if($this->auth->is_login ()){
			$uid = $this->session->userdata ('uid');
			$data = $this->user_m->get_user_by_id($uid);
			if($_POST){
				$data = array(
					'uid' => $uid,
					'email' => $this->input->post('email',true),
					'homepage' => $this->input->post('homepage',true),
					'location' => $this->input->post('location',true),
					'qq' => $this->input->post('qq',true),
					'signature' => $this->input->post('signature',true),
					'introduction' => $this->input->post('introduction',true)
				);
				$this->user_m->update_user($uid, $data);
				$data = $this->user_m->get_user_by_id($uid);
				//$this->myclass->notice('alert("更新账户成功");history.back();');
				
			}
		$this->load->view('settings', $data);
	}
	}
	function setpwd() {
	if($this->auth->is_login ()){
		$data ['title'] = '修改密码';
		$this->auth->is_login( $this->session->userdata ( 'uid' ), $this->session->userdata ( 'password' ) );
		if ($_POST) {
			$password = $this->input->post ('password',true);
			$newpassword = $this->input->post ('newpassword',true);
			$data = array ('uid' => $this->session->userdata ( 'uid' ), 'password' => md5 ( $password ), 'newpassword' => md5 ( $newpassword ) );
			if ($this->user_m->update_pwd ( $data )) {
				$data ['msg'] = '更新成功';
				$this->session->set_userdata ( 'password', $data ['newpassword'] );
			} else {
				$data ['msg'] = '修改失败';
			}
			$this->load->view ( 'setpwd', $data );
		} else {
			$this->load->view ( 'setpwd', $data );
		}
		}
	}

	public function upavatar()
	{
		if($this->auth->is_login()){
			$this->load->library('avatarlib');
			$uid = $this->session->userdata('uid');
			$data = $this->user_m->get_user_by_id($uid);
			$data ['avatarflash'] = $this->avatarlib->uc_avatar ($uid); 
			$data ['avatarhtml'] = $this->avatarlib->avatar_show($uid,'big').'&nbsp'.$this->avatarlib->avatar_show($uid,'middle').'&nbsp'.$this->avatarlib->avatar_show($uid,'small');
			//入库
			$middle_image = '/uploads/avatar/'.$this->avatarlib->get_avatar($uid, 'middle');
			$this->user_m->update_avatar($middle_image,$uid);
			//头像刷新
			$data ['avatarhtml'] .= '<script type="text/javascript">
				function updateavatar() {
					window.location.reload();
				}
				</script>';
			$data['title'] = '头像设置';
			echo $this->avatarlib->flashdata_decode ( @$_POST ['avatar1'] );
			$this->load->view ( 'upavatar', $data );
		}
	}

	function doavatar(){ 
		$action='on'.$_GET['a'];
		$this->load->library('avatarlib');
		$data = $this->avatarlib->$action(); 
		echo $data;
	}

}
