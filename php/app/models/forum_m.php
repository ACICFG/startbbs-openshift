<?php

#doc
#	classname:	Forum_m
#	scope:		PUBLIC
#
#/doc

class Forum_m extends SB_Model
{

	function __construct ()
	{
		parent::__construct();
		$this->load->library('myclass');
	}

	/*
	获取栏目条目
	*/
	public function count_forums($cid)
	{
		$this->db->select('listnum');
		$data = array(
               'cid' => $cid
        );
		$query = $this->db->get_where('sb_categories',$data);
		foreach ($query->result() as $row)
		{
		    return $row->listnum;
		}

    }

	
	/**/
	public function get_forums_list ($page, $limit, $cid)
	{
		$this->db->select('forums.*,b.username, b.avatar, c.username as rname');
		$this->db->from('forums');
		$this->db->join('users b','b.uid = forums.uid','left');
		$this->db->join('users c','c.uid = forums.ruid','left');
		$this->db->where('cid',$cid);
		$this->db->order_by('updatetime','desc');
		$this->db->limit($limit,$page);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} 
    }

	/**/
	public function get_latest_forums ($limit)
	{
		$this->db->select('forums.*,b.username, b.avatar, c.username as rname, d.cname');
		$this->db->from('forums');
		$this->db->join('users b','b.uid = forums.uid','left');
		$this->db->join('users c','c.uid = forums.ruid','left');
		$this->db->join('categories d','d.cid = forums.cid','left');
		$this->db->order_by('lastreply','desc');
		$this->db->limit($limit);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}
    }

    public function get_forum_by_fid ($fid)
    {
		$this->db->select('forums.*,users.username, users.avatar');
		$this->db->join('users', 'users.uid = forums.uid');
    	$query = $this->db->where('fid',$fid)->get('forums');
    	return $query->row_array();
    }

    public function add($data)
    {
    	$this->db->insert('sb_forums',$data);
    	return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
	public function get_forums_by_uid($uid,$num)
	{
		$this->db->limit($num);
		$this->db->order_by('addtime','desc');
		$query = $this->db->get_where('forums',array('uid'=>$uid));
		return $query->result_array();
	}
	public function get_all_forums($page, $limit)
	{
		$this->db->select('forums.*, c.cname, c.cid, u.username');
		$this->db->from('forums');
		$this->db->join('categories c','c.cid = forums.cid');
		$this->db->join('users u', 'u.uid = forums.uid');
		$this->db->order_by('addtime','desc');
		$this->db->limit($limit,$page);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}
	}

	function del_forum($fid,$cid,$uid)
	{
		$this->db->where('fid', $fid)->delete('forums');
		//查询相关数据
		$listnum = $this->db->select('listnum')->get_where('categories', array('cid'=>$cid))->row_array();
		$forums = $this->db->select('forums')->get_where('users', array('uid'=>$uid))->row_array();
		//更新分类中的贴子数
		$this->db->where('cid',$cid)->update('categories',array('listnum'=>$listnum['listnum']-1));
		//更新用户中的贴子数
		$this->db->where('uid',$uid)->update('users',array('forums'=>$forums['forums']-1));
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}


	function update_forum($fid, $data){
		$this->db->where('fid',$fid);
  		$this->db->update('forums', $data); 
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
    
    
/*    	public function get_forums_list ($page, $per_page = 1, $cid)
	{
		$this->db->select('forums.*,users.username');
		$this->db->from('sb_forums');
		$this->db->join('sb_users','users.uid = forums.uid','left');
		$this->db->join('sb_users','users.uid = forums.ruid','left');
		$this->db->where('cid',$cid);
		$this->db->limit($per_page,$page);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return show_error('消息!!!!!!!');
		}
    }*/


}
