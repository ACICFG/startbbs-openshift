<!DOCTYPE html><html><head><meta content='' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title>运行状态 - 管理后台 - Rabel</title>
<?php $this->load->view ( 'header-meta' ); ?>
</head>
<body id="rabel">
<div class="navbar navbar-inverse navbar-static-top">
<div class="navbar-inner">
<div class="container">
<a class="btn btn-navbar collapsed" data-target=".nav-collapse" data-toggle="collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><a href="/" class="brand">StartBBS</a>
<div class="nav-collapse collapse">
<form class="navbar-search pull-left">
<input class="search-query" data-domain="rabelapp.com" id="q" maxlength="40" name="q" placeholder="搜索话题" type="text" />
</form>
<ul class="nav pull-right">
<li class=""><a href="http://www.startbbs.com">Startbbs官方</a></li>
<li class=""><a href="http://www.startbbs.com">在线帮助</a></li>
</ul>
</div></div></div></div>


<div id="wrap">
<div class="container" id="page-main">
<div class="row">
<div class='span2'>
<div class='box fix_cell'>
<div class='cell'>
<strong class='gray'>安装步骤</strong>
</div>
<div class='cell'>
权限检测
</div>
<div class='cell'>
数据库配置
</div>
<div class='cell'>
管理员配置
</div>
<div class='cell'>
安装完成
</div>
</div>

</div>

<div class='span8'>

<div class='row'>
<div class='box span8'>
<div class='cell'>
欢迎使用起点startbbs轻量社区系统
</div>
<div class='inner'>
<span class="green">www.startbbs.com</span>

</div>
</div>
</div>

<div class='row'>
<div class='box span8'>
<div class='cell'>
安装最后一步
</div>
<div class='inner'>
<p class="green"><?=$msg1?></p>
<p class="green"><?=$msg2?></p>
<p class="green"><?=$msg3?></p>
<p class="green"><?=$msg4?></p>
<p class="red"><?=$msg5?></p>
<div class='form-actions'>
<a href="<?php echo site_url('/');?>" id="dataTest" class="left btn btn-white btn-primary"><span>进入首页</span></a>
</div>

</div>
</div>
</div>

</div>
</div></div></div>
<div id='footer'>
<div class='container' id='footer-main'>
<ul class='page-links'>
<!--<li><a href="/page/about" class="dark nav">StartBBS 简介</a></li>
<li class='snow'>·</li>
<li><a href="/page/support" class="dark nav">技术支持</a></li>-->
</ul>
<div class='copywrite'>
<div class="fr"> <!--<a href="" target="_blank"><img src="" border="0" alt="Linode" width="120"></a>--></div>
<p>&copy; 2013 Startbbs Inc, Some rights reserved.</p>
</div>
<small class='muted'>
Powered by
<a href="http://www.startbbs.com" class="muted" target="_blank">StartBBS</a>
1.0.0.alpha
</small>
</div>
</div>
</body></html>