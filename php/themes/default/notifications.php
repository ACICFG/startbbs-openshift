<!DOCTYPE html><html><head><meta content='' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title><?=$title?> - <?=$settings['site_name']?></title>
<?php $this->load->view ('header-meta');?>
</head>

<body id="startbbs">
<a id="top" name="top"></a>
<?php $this->load->view ('header'); ?>

<div id="wrap">
<div class="container" id="page-main">
<div class="row-fluid">
<div class='span8'>

<div class='box'>
<div class='cell'>
<a href="/" class="startbbs"><?=$settings['site_name']?></a> <span class="chevron">&nbsp;›&nbsp;</span> 提醒系统(<?php echo $users['notices']?>)
</div>
<?php if($notices_list){?>
<?php foreach($notices_list as $v){?>
<div class='cell'>
<table width='100%'>
<tr>
<td align='left' valign='top' width='32'>
<a href="<?php echo site_url('user/info/'.$v['suid']);?>" class="profile_link" title="<?php echo $v['username'];?>">
<?php if($v['avatar']) {?>
<img alt="<?php echo $v['username'];?> mini avatar" class="mini_avatar" src="<?php echo base_url($v['avatar']);?>" />
<?php } else {?>
<img alt="<?php echo $v['username'];?> mini avatar" class="mini_avatar" src="<?echo base_url('uploads/avatar/default.jpg');?>" />
<?php }?>
</a>
</td>
<td valign='top'>
<span class='gray'>
<strong><a href="<?php echo site_url('user/info/'.$v['suid']);?>" class="startbbs profile_link" title="<?php echo $v['username'];?>"><?php echo $v['username'];?></a></strong>
<?php if($v['ntype']==0){?>
回复了你的贴子
<a href="<?php echo site_url('forum/view/'.$v['fid']);?>" class="startbbs"><?php echo $v['title'];?>...</a>
<?}?>
<?php if($v['ntype']==1){?>
在回复
<a href="<?php echo site_url('forum/view/'.$v['fid']);?>" class="startbbs"><?php echo $v['title'];?>...</a>
时提到了@你
<?}?>
</span>
<span class='snow'>
<?php echo $this->myclass->friendly_date($v['ntime']);?>
</span>
<!--<div class='sep5'></div>
<div class='payload'><p>@<a class="startbbs" href="">doudou</a>XXXXXXX</p></div>-->
</td>
</tr>
</table>
</div>
<?}?>
<?} else{?>
<div class='cell'>暂无提醒</div>
<?}?>
</div>
</div>
<div class='span4' id='Rightbar'>
<?php $this->load->view('block/right_login');?>

<?php $this->load->view('block/right_ad');?>




</div>
</div></div></div>
<?php $this->load->view ('footer'); ?>