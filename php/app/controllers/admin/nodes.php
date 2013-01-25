<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Nodes extends Admin_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('myclass');
		$this->load->model('cate_m');
	}

	public function index ()
	{
		$data['title'] = '节点分类管理';
		$pid=0;
		$data['cates'] = $this->cate_m->get_cates_by_pid($pid);
		$this->load->view('nodes', $data);
		
	}
	public function del($cid)
	{
		$data['title'] = '删除分类';
		$this->myclass->notice('alert("确定再删除吗！");');
		$this->cate_m->del_cate($cid);
		$this->myclass->notice('alert("删除分类成功！");window.location.href="/admin/nodes";');		

	}
	public function add()
	{
		$data['title'] = '添加分类';
		if($_POST){
			$str = array(
				'pid'=>$this->input->post('pid'),
				'cname'=>$this->input->post('cname'),
				'content'=>$this->input->post('content'),
				'keywords'=>$this->input->post('keywords')
			);
			$this->cate_m->add_cate($str);
			$this->myclass->notice('alert("添加分类成功");window.location.href="/admin/nodes";');
		}
		$pid=0;
		$data['cates']=$this->cate_m->get_cates_by_pid($pid);
		$this->load->view('nodes_add', $data);
	}

	public function move($cid)
	{
		$data['title'] = '移动分类';
		if($_POST){
			$pid = $this->input->post('pid');
			$this->cate_m->move_cate($cid,$pid);
			$this->myclass->notice('alert("移动分类成功");window.location.href="/admin/nodes";');
		}
		$pid=0;
		$data['cid']=$this->uri->segment(4);
		$data['cates']=$this->cate_m->get_cates_by_pid($pid);
		$this->load->view('nodes_move', $data);
	}

	public function edit($cid)
	{
		$data['title'] = '修改分类';
		if($_POST){
			$str = array(
				'pid'=>$this->input->post('pid'),
				'cname'=>$this->input->post('cname'),
				'content'=>$this->input->post('content'),
				'keywords'=>$this->input->post('keywords')
			);
			if($this->cate_m->update_cate($cid, $str)){
				$this->myclass->notice('alert("修改分类成功");window.location.href="/admin/nodes";');
			}

		}
		$pid=0;
		$data['cates']=$this->cate_m->get_cates_by_pid($pid);
		$data['cateinfo']=$this->cate_m->get_category_by_cid($cid);
		$this->load->view('nodes_edit', $data);
	}


	
}