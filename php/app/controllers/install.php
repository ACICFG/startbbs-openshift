<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#doc
#	classname:	Install
#	scope:		PUBLIC
#
#/doc

class Install extends Other_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->library('myclass');
	}
	public function index ()
	{
		$file=$_SERVER['DOCUMENT_ROOT'].'/install.lock';
		if (file_exists($file)){
			$this->myclass->notice('alert("系统已安装过");window.location.href="/";');
		} else {
		$this->load->view('install');
		}

	}

	/**
	 * 检查数据库连接
	 */
	public function check(){
		$dbhost = $_REQUEST["dbhost"];
		$dbport = $_REQUEST["dbport"];
		$dbname = $_REQUEST["dbname"];
		$dbuser = $_REQUEST["dbuser"];
		$dbpwd = $_REQUEST["dbpwd"];
		$res = array("msg"=>"");		
		$conn = mysql_connect($dbhost.":".$dbport,$dbuser,$dbpwd);
		$db = mysql_select_db($dbname,$conn);
		if($db){
			$res["code"] = 1;
			$res["msg"] = "数据库连接成功！";
			mysql_close($conn);
		}else{
			$res["code"] = 0;
			$res["msg"] = "数据库连接失败";
		}
		echo json_encode($res);
	}
	
	public function step(){

		$dbhost = $this->input->post('dbhost');
		$dbport = $this->input->post('dbport');
		$dbname = $this->input->post('dbname');
		$dbuser = $this->input->post('dbuser');
		$dbpwd = $this->input->post('dbpwd');
		$dbprefix = $this->input->post('dbprefix');
		$userid = $this->input->post('admin');
		$pwd = md5($this->input->post('pwd'));
		$email = $this->input->post('email');
		$conn = mysql_connect($dbhost.':'.$dbport,$dbuser,$dbpwd);
		mysql_select_db($dbname,$conn);
		$sql = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/app/config/startbbs.sql');
		$sql = str_replace("sb_",$dbprefix,$sql);
		$explode = explode(";",$sql);
		$data['msg1']="创建表".$dbname."成功，请稍后……<br/>";
	 	foreach ($explode as $key=>$value){
	    	if(!empty($value)){
	    		if(trim($value)){
		    		mysql_query($value.";");
	    		}
	    	}
	  	}
	  	$ip=$this->myclass->get_ip();
	  	$insert= "INSERT INTO ".$dbprefix."users (gid,is_active,username,password,email,regtime,ip) VALUES ('0','1','".$userid."','".$pwd."','".$email."','".time()."','".$ip."')";
	  	mysql_query($insert);
		mysql_close($conn);
		$data['msg2']="安装完成，正在保存配置文件，请稍后……"; 
		$dbconfig = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');";
		$dbconfig .= '$active_group = \'default\';';
		$dbconfig .= '$active_record = TRUE;';
		$dbconfig .= '$db[\'default\'][\'hostname\'] = \''.$dbhost.'\';';
		$dbconfig .= '$db[\'default\'][\'username\'] = \''.$dbuser.'\';';
		$dbconfig .= '$db[\'default\'][\'password\'] = \''.$dbpwd.'\';';
		$dbconfig .= '$db[\'default\'][\'database\'] = \''.$dbname.'\';';
		$dbconfig .= '$db[\'default\'][\'dbdriver\'] = \'mysql\';';
		$dbconfig .= '$db[\'default\'][\'dbprefix\'] = \''.$dbprefix.'\';';
		$dbconfig .= '$db[\'default\'][\'pconnect\'] = TRUE;';
		$dbconfig .= '$db[\'default\'][\'db_debug\'] = TRUE;';
		$dbconfig .= '$db[\'default\'][\'cache_on\'] = FALSE;';
		$dbconfig .= '$db[\'default\'][\'cachedir\'] = \'\';';
		$dbconfig .= '$db[\'default\'][\'char_set\'] = \'utf8\';';
		$dbconfig .= '$db[\'default\'][\'dbcollat\'] = \'utf8_general_ci\';';
		$dbconfig .= '$db[\'default\'][\'swap_pre\'] = \'\';';
		$dbconfig .= '$db[\'default\'][\'autoinit\'] = TRUE;';
		$dbconfig .= '$db[\'default\'][\'stricton\'] = FALSE;';
		$file = $_SERVER['DOCUMENT_ROOT'].'/app/config/database.php';
		file_put_contents($file,$dbconfig);
		$data['msg3']="保存配置文件完成！";
		touch($_SERVER['DOCUMENT_ROOT'].'/install.lock'); 
		$data['msg4']="创建锁定安装文件install.lock成功";
		$data['msg5']="安装startbbs成功！";
		$this->load->view('install_step',$data);
	}


}
