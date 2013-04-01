<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Myclass {

	function __construct() {
	$this->ci = & get_instance ();
	}

	// 一些常用的函数
	// 显示时间格式化
	function friendly_date($db_time){
	    $diftime = time() - $db_time;
	    if($diftime < 31536000){
	        // 小于1年如下显示
	        if($diftime>=86400){
	            return round($diftime/86400,1).'天前';
	        }else if($diftime>=3600){
	            return round($diftime/3600,1).'小时前';
	        }else if($diftime>=60){
	            return round($diftime/60,1).'分钟前';
	        }else{
	            return ($diftime+1).'秒钟前';
	        }
	    }else{
	        // 大于一年
	        return gmdate("Y-m-d H:i:s", $db_time);
	    }
	}

	function notice($str)
	{	
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><script>'.$str.'</script>';
	}

	/**
	 * 文件或目录权限检查函数
	 *
	 * @access          public
	 * @param           string  $file_path   文件路径
	 * @param           bool    $rename_prv  是否在检查修改权限时检查执行rename()函数的权限
	 *
	 * @return          int     返回值的取值范围为{0 <= x <= 15}，每个值表示的含义可由四位二进制数组合推出。
	 *                          返回值在二进制计数法中，四位由高到低分别代表
	 *                          可执行rename()函数权限、可对文件追加内容权限、可写入文件权限、可读取文件权限。
	 */
	function is_write($file_path)
	{
		/* 如果不存在，则不可读、不可写、不可改 */
		if (!file_exists($file_path))
		{
			return false;
		}
		$mark = 0;
		if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN')
		{
			/* 测试文件 */
			$test_file = $file_path . '/cf_test.txt';
			/* 如果是目录 */
			if (is_dir($file_path))
			{
				/* 检查目录是否可读 */
				$dir = @opendir($file_path);
				if ($dir === false)
				{
					return $mark; //如果目录打开失败，直接返回目录不可修改、不可写、不可读
				}
				if (@readdir($dir) !== false)
				{
					$mark ^= 1; //目录可读 001，目录不可读 000
				}
				@closedir($dir);
				/* 检查目录是否可写 */
				$fp = @fopen($test_file, 'wb');
				if ($fp === false)
				{
					return $mark; //如果目录中的文件创建失败，返回不可写。
				}
				if (@fwrite($fp, 'directory access testing.') !== false)
				{
					$mark ^= 2; //目录可写可读011，目录可写不可读 010
				}
				@fclose($fp);
				@unlink($test_file);
				/* 检查目录是否可修改 */
				$fp = @fopen($test_file, 'ab+');
				if ($fp === false)
				{
					return $mark;
				}
				if (@fwrite($fp, "modify test.\r\n") !== false)
				{
					$mark ^= 4;
				}
				@fclose($fp);
				/* 检查目录下是否有执行rename()函数的权限 */
				if (@rename($test_file, $test_file) !== false)
				{
					$mark ^= 8;
				}
				@unlink($test_file);
			}
			/* 如果是文件 */
			elseif (is_file($file_path))
			{
				/* 以读方式打开 */
				$fp = @fopen($file_path, 'rb');
				if ($fp)
				{
					$mark ^= 1; //可读 001
				}
				@fclose($fp);
				/* 试着修改文件 */
				$fp = @fopen($file_path, 'ab+');
				if ($fp && @fwrite($fp, '') !== false)
				{
					$mark ^= 6; //可修改可写可读 111，不可修改可写可读011...
				}
				@fclose($fp);
				/* 检查目录下是否有执行rename()函数的权限 */
				if (@rename($test_file, $test_file) !== false)
				{
					$mark ^= 8;
				}
			}
		}
		else
		{
			if (@is_readable($file_path))
			{
				$mark ^= 1;
			}
			if (@is_writable($file_path))
			{
				$mark ^= 14;
			}
		}
		return $mark;
	} 

	function get_ip() {
	$ch = curl_init('http://iframe.ip138.com/ic.asp');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$a = curl_exec($ch);
	preg_match('/\[(.*)\]/', $a, $ip);
	return @$ip[1];
	}
	function get_domain($url){
	 $pattern = "/[w-] .(com|net|org|gov|cc|biz|info|cn)(.(cn|hk))*/";
	 preg_match($pattern, $url, $matches);
	 if(count($matches) > 0) {
	 return $matches[0];
	 }else{
	 $rs = parse_url($url);
	 $main_url = $rs["host"];
	 if(!strcmp(long2ip(sprintf("%u",ip2long($main_url))),$main_url)) {
	 return $main_url;
	 }else{
	 $arr = explode(".",$main_url);
	 $count=count($arr);
	 $endArr = array("com","net","org","3322");//com.cn net.cn 等情况
	 if (in_array($arr[$count-2],$endArr)){
	 $domain = $arr[$count-3].".".$arr[$count-2].".".$arr[$count-1];
	 }else{
	 $domain = $arr[$count-2].".".$arr[$count-1];
	 }
	 return $domain;
	 }// end if(!strcmp...)
	 }// end if(count...)www.027eat.com
	 }// end function


	
}

/* End of file Myclass.php */