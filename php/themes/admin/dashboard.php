<!DOCTYPE html><html><head><meta content='' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title>运行状态 - 管理后台 - <?=$settings['site_name']?></title>
<?php $this->load->view ( 'header-meta' ); ?>
</head>
<body id="startbbs">
<?php $this->load->view ( 'header' ); ?>

<div id="wrap">
<div class="container" id="page-main">
<div class="row">
<?php $this->load->view ('leftbar'); ?>

<div class='span8'>

<div class='row'>
<div class='box span8'>
<div class='cell'>
欢迎进入后台管理
</div>
<div class='inner'>
StartBBS- 起点开源社区系统 <span class="red"><?=$this->config->item('version');?></span>
</div>
</div>
</div>
<div class='row'>
<div class='box span4'>
<div class='cell'>
社区运行状态
</div>
<div class='inner'>
<table border='0' cellpadding='3' cellspacing='0' width='100%'>
<tr>
<td align='right' width='40%'>
<span class='gray'>注册会员总数</span>
</td>
<td align='left'>
<strong><?=$total_users?></strong>
</td>
</tr>
<tr>
<td align='right' width='40%'>
<span class='gray'>主题总数</span>
</td>
<td align='left'>
<strong><?=$total_forums?></strong>
</td>
</tr>
<tr>
<td align='right' width='40%'>
<span class='gray'>回复总数</span>
</td>
<td align='left'>
<strong><?=$total_comments?></strong>
</td>
</tr>
</table>
</div>
</div>
<div class='box span4'>
<div class='cell'>
系统清理
</div>
<div class='inner'>
<table class='table table-bordered'>
<tr>
<td align='right' width='40%'>
<span class='gray'>可清理提醒</span>
</td>
<td align='left'>
<div class='pull-right'></div>
<strong>0</strong>
</td>
</tr>
</table>
</div>
</div>
</div>
<div class='row'>
<div class='box span8'>
<div class='cell'>
官方最新动态
</div>
<div class='inner'>
<iframe src="http://www.startbbs.com/home/latest" width="100%" height="100%" frameborder="0" scrolling="no">Startbbs使用了框架技术，但是您的浏览器不支持框架，请升级您的浏览器以便正常访问StartBBS。</iframe>
</div>
</div>
</div>

</div>
</div></div></div>
<?php $this->load->view ( 'footer' ); ?>

</body></html>
