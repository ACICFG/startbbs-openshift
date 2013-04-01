<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#doc
#	Classname:	Comment
#	Scope:		PUBLIC
#	StartBBS起点轻量开源社区系统
#	author :doudou QQ:858292510 startbbs@126.com
#	Copyright (c) 2013 http://www.startbbs.com All rights reserved.
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
			$this->myclass->notice('alert("请登录后再发表");window.location.href="'.site_url('user/login/').'";');
		} else {
		//数据提交
		$data = array(
			'content' => $this->input->post('comment',true),
			'fid' => $this->input->post('fid'),
			'uid' => $uid,
			'replytime' => time()
		);
		
		//@会员功能
		$comment= $data['content'];
		$pattern = "/@([^@^\\s^:]{1,})([\\s\\:\\,\\;]{0,1})/";
		preg_match_all ( $pattern, $comment, $matches );
		$matches [1] = array_unique($matches [1]);
		foreach ( $matches [1] as $u ) {
			if ($u) {
				//var_dump($u);
				$res =$this->user_m->get_user_msg('',$u) ;
				if ($res['uid']) {
					$search [] = '@'.$u;
					$replace [] = '<a target="_blank" href="'.site_url('user/info/'.$res['uid']).'" >@' . $u . '</a>';
					if($uid!=$res['uid']){
						//@提醒someone
						$this->load->model('notifications_m');
						$this->notifications_m->notice_insert($data['fid'],$uid,$res['uid'],1);
						//更新接收人的提醒数
						$this->db->set('notices','notices+1',FALSE)->where('uid', $res['uid'])->update('users');
					}
				}
			}
		}
		$data['content'] = str_replace( @$search, @$replace, $comment);
		
		//无编辑器时的处理
		if($this->config->item('show_editor')=='off'){
			$data['content'] = $this->filter_check($data['content']);
			$this->load->helper('format_content');
			$data['content'] = format_content($data['content']);
		}
		$this->load->model('comment_m');
		$this->comment_m->add_comment($data);
		//更新回复数,最后回复用户,最后回复时间,更新时间
		$this->load->model('forum_m');
		$forum = $this->forum_m->get_forum_by_fid($this->input->post('fid'));
		$this->db->where('fid',$this->input->post('fid'))->update('forums',array('ruid'=>$this->session->userdata('uid'), 'comments'=>$forum['comments']+1, 'lastreply'=>time(),'updatetime'=>time()));
		//更新用户的回复数
		$this->load->model('user_m');
		$replies = $this->user_m->get_user_by_id($uid);
		$this->db->where('uid',$uid)->update('users',array('replies'=>$replies['replies']+1));

		//回复提醒作者
		$user = $this->db->select('uid')->where('fid',$data['fid'])->get('forums')->row_array();
		if($uid!=$user['uid']){
			$this->load->model('notifications_m');
			$this->notifications_m->notice_insert($data['fid'],$uid,$user['uid'],0);
			//更新作者的提醒数
			$this->db->set('notices','notices+1',FALSE)->where('uid', $user['uid'])->update('users');
		}
		
		//更新数据库缓存
		$this->db->cache_delete('/default', 'index');
	}
		
//		$this->load->library('myclass');
//		$this->myclass->notice('window.history.go(-1);');
	}



		//无编辑器的过滤
	private function filter_check ($data)
	{
		$pattern="/<pre>(.*?)<\/pre>/si";
		preg_match_all ($pattern, $data, $matches);
		foreach( $matches[1] as $val ){
			$replace [] = htmlspecialchars($val);
		}
		$data = str_replace($matches[1], @$replace, $data);
		$data = nl2br($data);
		return $data = strip_tags($data,"<a> <p> <font> <img> <b> <strong> <br> <pre> <br />");
	}

	
}
