<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title> New Document </title>
<?php $this->load->view('header-meta')?>
 </head>

 <body>
 <?php foreach($list as $key=>$v){?>
 <?php if(($key%2)==0){?>
<div class='cell comment_header muted' style="margin: 5px 0;">
<?} else {?>
<div class='cell muted'>
<?}?>
<div class='pull-right timeago'>
<?php echo $v['addtime']?>
</div>
<?php echo $v['rname']?>
回复了
<a href="http://www.startbbs.com/user/info/<?php echo $v['uid']?>" class="startbbs profile_link" title="admin" target=_blank><?php echo $v['username']?></a>
创建的话题
<span class='chevron'>>></span>
<a href="http://www.startbbs.com/forum/view/<?php echo $v['fid']?>" class="startbbs" target=_blank><?php echo $v['title']?></a>
</div>
<?}?>
 </body>
</html>
