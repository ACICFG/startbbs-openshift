<?php
#doc
#	classname:	Comment_m
#	scope:		PUBLIC
#	StartBBS起点轻量开源社区系统
#	author :doudou QQ:858292510 startbbs@126.com
#	Copyright (c) 2013 http://www.startbbs.com All rights reserved.
#/doc

class Upload_m extends SB_Model {
	
	var $upload_path;
	var $upload_path_temp;
	var $upload_path_url;
	var $path;
	var $image_url;

	function __construct ()
	{
		parent::__construct();
		$this->upload_path_temp = realpath(APPPATH . '../uploads/files/temp');
		$this->upload_path = realpath(APPPATH . '../uploads/files/');
		$this->upload_path_url = base_url().'uploads/files/'.date('Ym').'/';
		$this->path = $this->upload_path.'/'.date('Ym').'/';//这里使用“年-月”格式，可根据需要改为“年-月-日”格式
		if(!file_exists($this->path)){
			mkdir($this->path,0777);
		}
		
	}
	
	function do_upload() {

		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->upload_path_temp,
			'encrypt_name' => true,
			'max_size' => 2000
		);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload();
		$image_data_temp = $this->upload->data();

		$config = array(
			'source_image' => $image_data_temp['full_path'],
			'new_image' => $this->path,
			'maintain_ration' => true,
			'width' => 150,
			'height' => 100
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		//删除原图
		unlink($config['source_image']);
		return json_encode($config);
		
	}
	function get_images() {
		
		
		//return $images;
	}
	
//	function get_images() {
//		
//		$files = scandir($this->path);
//		$files = array_diff($files, array('.', '..', 'thumbs'));
//		
//		$images = array();
//		
//		foreach ($files as $file) {
//			$images []= array (
//				'url' => $this->upload_path_url . $file,
//				'thumb_url' => $this->upload_path_url . 'thumbs/' . $file
//			);
//		}
//		
//		return $images;
//	}
	
}



