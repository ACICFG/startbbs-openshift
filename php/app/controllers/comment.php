<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#doc
#	classname:	Comment
#	scope:		PUBLIC
#
#/doc

class Comment extends SB_Controller
{

	function __construct ()
	{
		parent::__construct();
		$this->load->library('myclass');
		
	}

	public function add_comment ()
	{
		$this->load->library('session');
		$uid = $this->session->userdata('uid');
		if(empty($uid)) {
			$this->myclass->notice('alert("请登录后再发表");window.location.href="/user/login/";');
		} else {
		//@会员功能
		$comment=$this->input->post('comment',true);
		$pattern = "/@([^@^\\s^:]{1,})([\\s\\:\\,\\;]{0,1})/";
		preg_match_all ( $pattern, $comment, $matches );
		foreach ( $matches [1] as $u ) {
			if ($u) {
				//var_dump($u);
				$res =$this->user_m->get_user_msg('',$u) ;
				if ($res['uid']) {
					$search [] = '@'.$u;
					$replace [] = '<a target="_blank" href="/user/info/' . $res['uid'] . '" >@' . $u . '</a>';
				}
			}
		}
		$comment=str_replace ( $search, $replace, $comment);

		//数据提交
		$data = array(
			'content' => nl2br($comment),
			'fid' => $this->input->post('fid'),
			'uid' => $this->session->userdata('uid'),
			'replytime' => time()
		);
		$this->load->model('comment_m');
		$this->comment_m->add_comment($data);
		//更新回复数,最后回复用户,最后回复时间
		$this->load->model('forum_m');
		$forum = $this->forum_m->get_forum_by_fid($this->input->post('fid'));
		$this->db->where('fid',$this->input->post('fid'))->update('forums',array('ruid'=>$this->session->userdata('uid'), 'comments'=>$forum['comments']+1, 'lastreply'=>time()));
		//更新用户的回复数
		$this->load->model('user_m');
		$replies = $this->user_m->get_user_by_id($uid);
		$this->db->where('uid',$uid)->update('users',array('replies'=>$replies['replies']+1));
	}
		
//		$this->load->library('myclass');
//		$this->myclass->notice('window.history.go(-1);');
	}
}
