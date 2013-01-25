<?php

#doc
#	classname:	User_m
#	scope:		PUBLIC
#
#/doc

class User_m extends SB_Model
{

	function __construct ()
	{
		parent::__construct();
	}

	function reg($data){
		return $this->db->insert('users',$data);
	}
	function check_reg($email){
		$query = $this->db->get_where('users',array('email'=>$email));
        return $query->row_array();
	}
	function check_username($username){
		$query = $this->db->get_where('users',array('username'=>$username));
        return $query->row_array();
	}
	function check_login($username,$password){
		$query = $this->db->get_where('users',array('username'=>$username, 'password'=>md5($password)));
		$result = $query->row_array();
		if(@$result['uid']){
			$this->db->where('uid', @$result['uid'])->update('users',array('lastlogin'=>time()));
		}
		return $result;
	}
	public function get_user_by_id($uid)
	{
		$query = $this->db->get_where('users', array('uid'=>$uid));
		return $query->row_array();
	}

	function update_user($uid, $data){
		$this->db->where('uid',$uid);
  		$this->db->update('users', $data); 
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	function update_pwd($data){
		$this->db->where('uid',$data['uid']);
		$this->db->where('password',$data['password']);
		$this->db->update('users', array('password'=>$data['newpassword']));
		return $this->db->affected_rows();
	}
	function update_avatar($avatar,$uid)
	{
		$this->db->where('uid',$uid);
		$this->db->update('users', array('avatar'=>$avatar));
	}
	public function get_all_users($page, $limit)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->order_by('uid','desc');
		$this->db->limit($limit,$page);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}
	}
	public function is_user($uid)
	{
		return ($this->auth->is_login() && $uid==$this->session->userdata('uid')) ? TRUE : FALSE;
	}
	function get_user_msg($uid,$username){
		if($uid){
		   $query = $this->db->select('username')->get_where('users',array('uid'=>$uid));
		}else{
		   $query = $this->db->select('uid')->get_where('users',array('username'=>$username));
		}
	   	   return $query->row_array();
	}
	

}
