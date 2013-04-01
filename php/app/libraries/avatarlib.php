<?php
class Avatarlib {
	function __construct() {
		$this->ci = & get_instance ();
		//$test =& get_config();
		//$this->base_folder=$test['base_folder'];
		$this->base_url = base_url();

		/**
		 *上传响应程序URL
		 */
		$this->doaction = $this->base_url.'user/doavatar';
		/**
		 *临时上传目录，上传成功后自动删除,777属性哦
		 *图片上传成功但没有保存请自行删除
		 */
		$this->tmppath = 'uploads/avatar/tmp/';
		/**
		 * 保存图片目录,777属性哦
		 */
		$this->avatarpath = 'uploads/avatar/';
		/**
		 * FCPATH CI你懂的 
		 */
		$this->systempath = FCPATH;
	}
	
	/**
	 * 修改头像 
	 * @param	int $uid 
	 * @return	boole $returnhtml
	 */
	function uc_avatar($uid, $returnhtml = TRUE) {
		$uid = intval ( $uid );
		$input = urlencode ( "uid=$uid" );
		$uc_avatarflash = $this->base_url . '/static/images/camera.swf?inajax=1&appid=1&input=' . $input . '&agent=' . md5 ( $_SERVER ['HTTP_USER_AGENT'] ) . '&ucapi=' . urlencode ( $this->doaction ) . '&avatartype=real';
		if ($returnhtml) {
			return '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="450" height="253" id="mycamera" align="middle">
			<param name="allowScriptAccess" value="always" />
			<param name="scale" value="exactfit" />
			<param name="wmode" value="transparent" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<param name="movie" value="'.$uc_avatarflash.'" />
			<param name="menu" value="false" />
			<embed src="'.$uc_avatarflash.'" quality="high" bgcolor="#ffffff" width="450" height="253" name="mycamera" align="middle" allowScriptAccess="always" allowFullScreen="false" scale="exactfit"  wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
		</object>';
		} else {
			return array (' #ffffff', 'wmode', 'transparent', 'menu', 'false', 'swLiveConnect', 'true', 'allowScriptAccess', 'always' );
		}
	}
	/**
	 * 设置目录
	 * @param int $uid
	 */
	function get_home($uid) {
		$uid = sprintf ( "%02d", $uid );
		$dir1 = substr ( $uid, -1, 1 );
		$dir2 = substr ( $uid, -2, 2 );
		return $dir1 . '/' . $dir2;
	}
	/**
	 * 获取目录
	 * @param int $uid
	 * @param string $dir
	 */
	function set_home($uid, $dir = '.') {
		$uid = sprintf ( "%09d", $uid );
		$dir1 = substr ( $uid, -1, 1 );
		$dir2 = substr ( $uid, -2, 2 );
		! is_dir ( $dir . '/' . $dir1 ) && mkdir ( $dir . '/' . $dir1, 0777, TRUE );
		! is_dir ( $dir . '/' . $dir1 . '/' . $dir2 ) && mkdir ( $dir . '/' . $dir1 . '/' . $dir2, 0777, TRUE );
	}
	/**
	 *应UC的相应,不变，上传时触发
	 *返回上传文件的地址
	 */
	function onuploadavatar() {
		@header ( "Expires: 0" );
		@header ( "Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE );
		@header ( "Pragma: no-cache" );
		$arr = array ();
		parse_str ( $_GET ['input'], $arr );
		$uid = intval ( $arr ['uid'] );
		if (empty ( $uid )) {
			return - 1;
		}
		if (empty ( $_FILES ['Filedata'] )) {
			return - 3;
		}
		$forder = $this->tmppath;
		$file_forder = $this->systempath . $forder;
		$config ['upload_path'] = $file_forder;
		$config ['allowed_types'] = 'jpg|jpeg|gif|png|bmp|jpe';
		$config ['max_size'] = '1024';
		$config ['file_name'] = 'useravatar' . $uid;
		$this->ci->load->library ( 'upload', $config );
		$field_name = 'Filedata';
		if ($this->ci->upload->do_upload ( $field_name )) {
			$data = $this->ci->upload->data ();
			return $this->base_url . $forder . $data ['file_name'];
		}
		return $this->ci->upload->display_errors () . $config ['upload_path'];
	}
	/**
	 * 保存图片时响应
	 */
	function onrectavatar() {
		@header ( "Expires: 0" );
		@header ( "Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE );
		@header ( "Pragma: no-cache" );
		header ( "Content-type: application/xml; charset=utf-8" );
		$arr = array ();
		parse_str ( $_GET ['input'], $arr );
		$uid = intval ( $arr ['uid'] );
		if (empty ( $uid )) {
			return '<root><message type="error" value="-1" /></root>';
		}
		$home = $this->get_home ( $uid );
		if (! is_dir ( $this->systempath . $this->avatarpath . $home )) {
			$this->set_home ( $uid, $this->systempath . $this->avatarpath );
		}
		$bigavatarfile = $this->systempath . $this->avatarpath . $this->get_avatar ( $uid, 'big' );
		$middleavatarfile = $this->systempath . $this->avatarpath . $this->get_avatar ( $uid, 'middle' );
		$smallavatarfile = $this->systempath . $this->avatarpath . $this->get_avatar ( $uid, 'small' );

		$bigavatar = $this->flashdata_decode ( $_POST ['avatar1'] );
		$middleavatar = $this->flashdata_decode ( $_POST ['avatar2'] );
		$smallavatar = $this->flashdata_decode ( $_POST ['avatar3'] );
		if (! $bigavatar || ! $middleavatar || ! $smallavatar) {
			return '<root><message type="error" value="-2" /></root>';
		}
		$success = 1;

		$fp = @fopen ( $bigavatarfile, 'wb' );
		@fwrite ( $fp, $bigavatar );
		@fclose ( $fp );
		
		$fp = @fopen ( $middleavatarfile, 'wb' );
		@fwrite ( $fp, $middleavatar );
		@fclose ( $fp );
		
		$fp = @fopen ( $smallavatarfile, 'wb' );
		@fwrite ( $fp, $smallavatar );
		@fclose ( $fp );

		//重修尺寸
		$this->resizeimg($bigavatarfile,100,100);
		$this->resizeimg($middleavatarfile,48,48);
		$this->resizeimg($smallavatarfile,24,24);
		
		$biginfo = @getimagesize ( $bigavatarfile );
		$middleinfo = @getimagesize ( $middleavatarfile );
		$smallinfo = @getimagesize ( $smallavatarfile );
		if (! $biginfo || ! $middleinfo || ! $smallinfo || $biginfo [2] == 4 || $middleinfo [2] == 4 || $smallinfo [2] == 4) {
			file_exists ( $bigavatarfile ) && unlink ( $bigavatarfile );
			file_exists ( $middleavatarfile ) && unlink ( $middleavatarfile );
			file_exists ( $smallavatarfile ) && unlink ( $smallavatarfile );
			$success = 0;
		}
		$filetype = '.jpg';
		@unlink ( $this->systempath . $this->tmppath . 'useravatar' . $uid . $filetype );
		if ($success) {
			return '<?xml version="1.0" ?><root><face success="1"/></root>';
		}
		return '<?xml version="1.0" ?><root><face success="0"/></root>';
	}
	
	function flashdata_decode($s) {
		$r = '';
		$l = strlen ( $s );
		for($i = 0; $i < $l; $i = $i + 2) {
			$k1 = ord ( $s [$i] ) - 48;
			$k1 -= $k1 > 9 ? 7 : 0;
			$k2 = ord ( $s [$i + 1] ) - 48;
			$k2 -= $k2 > 9 ? 7 : 0;
			$r .= chr ( $k1 << 4 | $k2 );
		}
		return $r;
	}
	function get_avatar($uid, $size = 'big') {
		$size = in_array ( $size, array ('big', 'middle', 'small' ) ) ? $size : 'big';
		$uid = abs ( intval ( $uid ) );
		$newuid = sprintf ( "%09d", $uid );
		$dir1 = substr ( $newuid, -1, 1 );
		$dir2 = substr ( $newuid, -2, 2 );
		return $dir1 . '/' . $dir2 . '/'.$uid. "_avatar_$size.jpg";
	}
	function avatar_show($uid, $size = 'small', $returnsrc = FALSE) {
		$size = in_array ( $size, array ('big', 'middle', 'small' ) ) ? $size : 'small';
		$avatarfile = $this->get_avatar ( $uid, $size );

		return $returnsrc ? $this->base_url . $this->avatarpath . $avatarfile : '<img class="'.$size.'_avatar" src="' . $this->base_url . $this->avatarpath . $avatarfile . '" onerror="this.onerror=null;this.src=\'' . $this->base_url . '/static/images/noavatar_' . $size . '.png\'">';
	}
	function resizeimg($source,$width,$height) {
		$this->ci->load->library('image_lib');
		$config['image_library'] = 'GD2';
		$config['source_image'] = $source;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;
		$this->ci->image_lib->initialize($config);
		$this->ci->image_lib->resize();
		$this->ci->image_lib->clear();
	}


}
?>