<!DOCTYPE html><html><head><meta content='' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title><?=$title?> - <?=$settings['site_name']?></title>
<?php echo $this->load->view('header-meta');?>
</head>
<body id="startbbs">

<?php echo $this->load->view('header');?>

<div id="wrap"><div class="container" id="page-main"><div class="row-fluid"><div class='span8' class="clearfix">

<div class='box'>
<div class='cell' style="border-bottom-style: none;">
<a href="/" class="startbbs"><?=$settings['site_name']?></a> <span class="chevron">&nbsp;›&nbsp;</span> 设置
    <ul class="nav nav-tabs" style="margin-top:10px;">
    <li>
    <a href="<?php echo site_url('user/settings');?>">个人信息</a>
    </li>
    <li class="active"><a href="#">头像</a></li>
    <li><a href="<?php echo site_url('user/setpwd');?>">修改密码</a></li>
    </ul>
</div>

<div class='inner'>
<div class="control-group">
<div class='control-label'>当前头像</div>
<div class="controls">
<?php echo $avatarhtml; ?>
<div><?php echo $avatarflash; ?></div>
</div></div>
<div class='form-actions'>
<span class='help-block'>推荐使用正方形的图片以获得最佳效果。</span>
</div>
</div>


</div>

</div>

<div class='span4' id='Rightbar'>
<?php $this->load->view('block/right_login')?>
<?php $this->load->view('block/right_ad');?>

</div>
</div></div></div>
<?php $this->load->view('footer');?>