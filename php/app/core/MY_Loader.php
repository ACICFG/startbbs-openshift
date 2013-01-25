<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


class MY_Loader extends CI_Loader
{
	public function __construct()
	{
		parent::__construct();
		//ÅäÖÃÄ£°åÂ·¾¶
        $this->_ci_view_paths = array('themes/' => TRUE);
	}
	public function set_front_theme($theme='default')
	{
		$this->_ci_view_paths = array(FCPATH.'themes/'.$theme.'/'	=> TRUE);
	}
	public function set_admin_theme()
	{
		$this->_ci_view_paths = array(FCPATH.'themes/admin/'	=> TRUE);
	}
}