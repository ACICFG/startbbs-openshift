<?php

#doc
#	classname:	Link_m
#	scope:		PUBLIC
#
#/doc

class Link_m extends SB_Model
{

	function __construct ()
	{
		parent::__construct();
		$this->load->library('myclass');
	}

	/**/
	public function get_latest_links($limit)
	{
		$this->db->limit($limit);
		$query = $this->db->get_where('links',array('is_hidden'=>0));
		if($query->num_rows() > 0){
			return $query->result_array();
		}
    }
    
    public function get_link_by_id($id)
    {
    	$query = $this->db->get_where('links',array('id'=>$id));
    	return $query->row_array();
    }

    public function add_link($data)
    {
    	$this->db->insert('links',$data);
    	return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
//	public function get_forums_by_uid($uid,$num)
//	{
//		$this->db->limit($num);
//		$this->db->order_by('addtime','desc');
//		$query = $this->db->get_where('forums',array('uid'=>$uid));
//		return $query->result_array();
//	}
	public function get_all_links($page,$limit)
	{
		$this->db->select('id,name,url,is_hidden');
		$this->db->limit($limit,$page);
		$query = $this->db->get('links');
		if($query->num_rows() > 0){
			return $query->result_array();
		}
	}

	function del_link($id)
	{
		$this->db->where('id', $id)->delete('links');
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}


	function update_link($id, $data){
		$this->db->where('id',$id);
  		$this->db->update('links', $data); 
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
    
}
