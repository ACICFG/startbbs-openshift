<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('format_content'))
{
	function format_content($text)
	{
		//pic
		//$imgurl = '/<img[^>]*src="(http://(.+)/(.+).(jpg|jpe|jpeg|gif|png))"/isU';
//		$img_url = '/(http[s]?:\/\/?('.$options['safe_imgdomain'].').+\.(jpg|jpe|jpeg|gif|png))\w*/';
		//$img_url="/^(http?:\/\/)(.*?)\/(.*?)\.(jpg|jpeg|gif|png)/i";
		//$img_url = '/(http|https):\/\/([^"]+(?:jpg|gif|png|jpeg))/isU';
		$img_url="/(http[s]?:\/\/(.+)\/(.+).(jpg|jpe|jpeg|gif|png))/isU";

   		if(preg_match($img_url, $text)){
			$text = preg_replace($img_url, '<img src="\1" alt="" />', $text);
	   	}
	   	//preg_match_all($img_url, $text,$arr);
   		
   		
   		//$text= $arr[0][0];

	   	//url
	    if(strpos(' '.$text, 'http')){
	        $text = ' '.$text;
	        $text = preg_replace(
	        	'`([^"=\'>])((http|https|ftp)://[^\s<]+[^\s<\.)])`i',
	        	'$1<a href="$2" target="_blank" rel="nofollow">$2</a>',
	        	$text
	        );
	        $text = substr($text, 1);
	    }
	   	
		return $text;
	}
}

/* End of file format_content_helper.php */
/* Location: ./system/helpers/format_content_helper.php */