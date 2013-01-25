<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#doc
#	classname:	Forum
#	scope:		PUBLIC
#
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
		//分页
		$limit = 10;
		$config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = '/forum/flist/'.$cid;
		$config['total_rows'] = $this->forum_m->count_forums($cid);
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
		$content = $this->forum_m->get_forum_by_fid($fid);

		$data['content'] = $content;

		//更新浏览数
		$this->db->where('fid',$content['fid'])->update('forums',array('views'=>$content['views']+1));

		//获取评论
		$this->load->model ( 'comment_m' );
		$data['comment']= $this->comment_m->get_comment ($fid);

		//获取当前分类
		$data['cate']=$this->db->get_where('categories',array('cid'=>$content['cid']))->row_array();
		
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
			$this->myclass->notice('alert("请登录后再发表");window.location.href="/user/login/";');
		} else {
			if($_POST && $this->validate_add_form()){
				$data = array(
					'title' => $this->input->post ('title',true),
					'content' => nl2br($this->input->post ('content',true)),
					'cid' => $this->input->post ('cid'),
					'uid' => $uid,
					'addtime' => time(),
					'updatetime' => time(),
					'lastreply' => time(),
					'views' => 0
				);
				if($this->forum_m->add($data)){
					//最新贴子id
					$new_fid = $this->db->insert_id();
					//更新贴子数
					$cid = $this->input->post ('cid');
					$category = $this->cate_m->get_category_by_cid($cid);
					$this->db->where('cid',$cid)->update('categories',array('listnum'=>$category['listnum']+1));
					//更新发贴人的贴子数
					$forums = $this->user_m->get_user_by_id($uid);
					$this->db->where('uid',$uid)->update('users', array('forums'=>$forums['forums']+1));
					header('location: /forum/view/'.$new_fid);
					exit;
				}

			}
		}
		$data['category'] = $this->cate_m->get_all_cates();
		$this->load->view('add',$data);
		
	}
	private function validate_add_form(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', '标题' , 'trim|required|min_length[4]|max_length[80]|xss_clean');
		$this->form_validation->set_rules('content', '内容' , 'trim|required|min_length[6]|max_length[2000]|xss_clean');
		$this->form_validation->set_rules('cid', '栏目' , 'trim|required');
		
		$this->form_validation->set_message('required', "%s 不能为空！");
		$this->form_validation->set_message('min_length', "%s 最小长度不少于 %s 个字符！");
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
			$this->myclass->notice('alert("请登录后再编辑");window.location.href="/user/login/";');
		} elseif($this->auth->is_user($data['item']['uid']) || $this->auth->is_admin()){
			//对内容进行br转换
			$this->load->helper('br2nl');
			$data['item']['content']=br2nl($data['item']['content']);

			if($_POST && $this->validate_add_form()){
				$str = array(
					'title' => $this->input->post ('title',true),
					'content' => nl2br($this->input->post ('content',true)),
					'cid' => $this->input->post ('cid'),
					'updatetime' => time(),
				);
				if($this->forum_m->update_forum($fid,$str)){
					$this->myclass->notice('alert("修改成功");window.location.href="/forum/view/'.$fid.'";');
				}
			}
		} else {
			$this->myclass->notice('alert("你无权修改此贴子");history.go(-1);');
		}
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
			$this->myclass->notice('alert("删除贴子成功！");window.location.href="/forum/flist/'.$cid.'";');
			}
		}else{
			$this->myclass->notice('alert("您无权删除此贴");window.location.href="/forum/view/'.$fid.'";');
			exit;
			}
		}

}