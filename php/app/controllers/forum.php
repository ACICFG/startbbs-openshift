<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#doc
#	classname:	Forum
#	scope:		PUBLIC
#	StartBBS起点轻量开源社区系统
#	author :doudou QQ:858292510 startbbs@126.com
#	Copyright (c) 2013 http://www.startbbs.com All rights reserved.
#/doc

class Forum extends SB_controller
{

	function __construct ()
	{
		parent::__construct();
		$this->load->model('forum_m');
		$this->load->model('cate_m');
		$this->load->library('myclass');
	}
	public function flist ($cid=1, $page=1)
	{
		$config['total_rows'] = $this->forum_m->count_forums($cid);
		if(!$config['total_rows']){
			$this->myclass->notice('alert("分类不存在");window.location.href="'.site_url('/').'";');
			exit;
		}
		//分页
		$limit = 10;
		$config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = site_url('forum/flist/'.$cid);

		$config['per_page'] = $limit;
		$config['first_link'] ='首页';
		$config['last_link'] ='尾页';
		$config['num_links'] = 10;
		
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		
		$start = ($page-1)*$limit;
		$data['pagination'] = $this->pagination->create_links();

		//获取列表
		$data['list'] = $this->forum_m->get_forums_list($start, $limit, $cid);

		$data['category'] = $this->cate_m->get_category_by_cid($cid);

		$data['title'] = $data['category']['cname'];
		
		//加载form类，为调用错误函数,需view前加载
		$this->load->helper('form');

		$this->load->view('flist', $data);
	}

	public function view ($fid=1)
	{
		//$this->output->cache(1);
		$content = $this->forum_m->get_forum_by_fid($fid);
		$data['content'] = $content;
		
		if(!$content){
			$this->myclass->notice('alert("贴子不存在");window.location.href="'.site_url('/').'";');
			exit;
		}
		

		//更新浏览数
		$this->db->where('fid',$content['fid'])->update('forums',array('views'=>$content['views']+1));

		//获取评论
		$this->load->model ( 'comment_m' );
		$data['comment']= $this->comment_m->get_comment ($fid,$this->config->item('comment_order'));

		//获取当前分类
		$data['cate']=$this->db->get_where('categories',array('cid'=>$content['cid']))->row_array();

		// 判断是不是已被收藏
		$data['in_favorites'] = '';
		$uid = $this->session->userdata('uid');
		if($uid){
			$user_fav = $this->db->get_where('favorites',array('uid'=>$uid))->row_array();
		
			if($user_fav && $user_fav['content']){
				if(strpos(' ,'.$user_fav['content'].',', ','.$fid.',') ){
					$data['in_favorites'] = '1';
				}
			}
		}

		$this->load->view('view', $data);
	}

	public function add()
	{
		//加载form类，为调用错误函数,需view前加载
		$this->load->helper('form');
		//获取已选择过的分类名称
		$data['cate']=$this->db->get_where('categories',array('cid'=>$this->input->post ('cid')))->row_array();
		
		$data['title'] = '发表话题';
		$uid = $this->session->userdata('uid');
		if(!$this->auth->is_login()) {
			redirect('user/login/');
		} else {
			if($_POST && $this->validate_add_form()){
				$data = array(
					'title' => $this->input->post ('title'),
					'content' => $this->input->post ('content'),
					'cid' => $this->input->post ('cid'),
					'uid' => $uid,
					'addtime' => time(),
					'updatetime' => time(),
					'lastreply' => time(),
					'views' => 0
				);
				//无编辑器时的处理
				if($this->config->item('show_editor')=='off'){
					$data['content'] = $this->filter_check($data['content']);
					$this->load->helper('format_content');
					$data['content'] = format_content($data['content']);
					
				}
				if($this->forum_m->add($data)){
					//最新贴子id
					$new_fid = $this->db->insert_id();
					//更新贴子数
					$cid = $this->input->post ('cid');
					$category = $this->cate_m->get_category_by_cid($cid);
					$this->db->where('cid',$cid)->update('categories',array('listnum'=>$category['listnum']+1));

					//更新数据库缓存
					$this->db->cache_delete('/default', 'index');
					//更新发贴人的贴子数
					$forums = $this->user_m->get_user_by_id($uid);
					$this->db->where('uid',$uid)->update('users', array('forums'=>$forums['forums']+1));
					redirect('user/login/'.$new_fid);
					exit;
				}

			}
		}
		$data['category'] = $this->cate_m->get_all_cates();
		$this->load->view('add',$data);
		
	}
	//无编辑器的过滤
	private function filter_check ($data)
	{
		$pattern="/<pre>(.*?)<\/pre>/si";
		preg_match_all ($pattern, $data, $matches);
		foreach( $matches[1] as $val ){
			@$replace[] = htmlspecialchars($val);
		}
		$data = str_replace($matches[1], @$replace, $data); 
		$data = nl2br($data);
		$data = str_replace('</p><br />','</p>',$data);
		return $data = strip_tags($data,"<a> <p> <font> <img> <b> <strong> <br> <pre> <br /> <span>");
	}
	
	private function validate_add_form(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', '标题' , 'trim|required|min_length[4]|max_length[80]|strip_tags');
		$this->form_validation->set_rules('content', '内容' , 'trim|required|min_length[6]|max_length[2000]');
		$this->form_validation->set_rules('cid', '栏目' , 'trim|required');
		
		$this->form_validation->set_message('required', "%s 不能为空！");
		$this->form_validation->set_message('min_length', "%s 最小长度不少于 %s 个字符！");
		$this->form_validation->set_message('xss_clean', "%s 非法字符！");
		if ($this->form_validation->run() == FALSE){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	public function edit($fid)
	{
		//加载form类，为调用错误函数,需view前加载
		$this->load->helper('form');
		$data['title'] = '编辑话题';
		$data['item'] = $this->forum_m->get_forum_by_fid($fid);

		//权限修改判断
		if(!$this->auth->is_login()) {
			$this->myclass->notice('alert("请登录后再编辑");window.location.href="'.site_url('user/login').'";');
		} elseif($this->auth->is_user($data['item']['uid']) || $this->auth->is_admin()){
			//对内容进行br转换
			$this->load->helper('br2nl');
			$data['item']['content']=br2nl($data['item']['content']);

			if($_POST && $this->validate_add_form()){
				$str = array(
					'title' => $this->input->post ('title',true),
					'content' => $this->input->post ('content',true),
					'cid' => $this->input->post ('cid'),
					'updatetime' => time(),
				);
				//无编辑器时的处理
				if($this->config->item('show_editor')=='off'){
					$str['content'] = $this->filter_check($str['content']);
				}
				if($this->forum_m->update_forum($fid,$str)){
					$this->myclass->notice('alert("修改成功");window.location.href="'.site_url('forum/view/'.$fid).'";');
				}
			}
		} else {
			$this->myclass->notice('alert("你无权修改此贴子");history.go(-1);');
		}
		//获取所有分类
		$data['cates'] = $this->cate_m->get_all_cates();
		//获取当前分类(包括已选择)
		$cid = ($this->input->post ('cid'))?$this->input->post ('cid'):$data['item']['cid'];
		$data['cate']=$this->db->get_where('categories',array('cid'=>$cid))->row_array();
		//标题编辑(包括已输入)
		$data['item']['title'] = ($this->input->post ('title'))?$this->input->post ('title'):$data['item']['title'];
		//内容编辑(包括已输入)
		$data['item']['content'] = ($this->input->post ('content'))?$this->input->post ('content'):$data['item']['content'];
		$this->load->view('edit', $data);
	}
	public function del($fid,$cid,$uid)
	{
		$data['title'] = '删除贴子';
		//权限修改判断
		if($this->auth->is_login() && $this->auth->is_admin()){
			$this->myclass->notice('alert("确定要删除此话题吗！");');
			//删除贴子及它的回复
			if($this->forum_m->del_forum($fid,$cid,$uid)){
			$this->load->model('comment_m');
			$this->comment_m->del_comments_by_fid($fid,$uid);
			//更新数据库缓存
			$this->db->cache_delete('/default', 'index');

			$this->myclass->notice('alert("删除贴子成功！");window.location.href="'.site_url('/forum/flist/'.$cid).'";');
			}
		}else{
			$this->myclass->notice('alert("您无权删除此贴");window.location.href="'.site_url('/forum/view/'.$fid).'";');
			exit;
			}
		}

}