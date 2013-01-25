<?php

#doc
#	classname:	Comment_m
#	scope:		PUBLIC
#
#/doc

class Comment_m extends SB_Model
{

	function __construct ()
	{
		parent::__construct();
	}

	public function add_comment ($data)
	{
		$this->db->insert('comments', $data);
	}
	function get_comment($fid){
		$this->db->select('comments.*, u.uid, u.username, u.avatar, u.signature');
		$query=$this->db->from('comments')->where('fid',$fid)->join ( 'users u', "u.uid=comments.uid" )->order_by('comments.replytime','desc')->get();
		return $query->result_array();
	}
	public function get_comments_by_uid($uid,$num)
	{
		$this->db->select('c.*, f.fid, f.title, f.addtime, u.uid, u.username');
		$this->db->from('comments c');
		$this->db->where('c.uid',$uid);
		$this->db->join('forums f', 'f.fid = c.fid','left');
		$this->db->join('users u', 'u.uid = f.uid');
		$this->db->limit($num);
		$this->db->order_by('replytime','desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	function del_comments_by_fid($fid,$uid)
	{
		$this->db->where('fid', $fid)->delete('comments');
		//更新用户中的回复数
		$rnum = mysql_affected_rows();
		$replies = $this->db->select('replies')->get_where('users', array('uid'=>$uid))->row_array();
		$this->db->where('uid',$uid)->update('users',array('replies'=>$replies['replies']-$rnum));
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}

	
