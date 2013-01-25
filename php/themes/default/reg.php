<!DOCTYPE html><html><head><meta content='注册' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title><?=$title?>- <?=$settings['site_name']?></title>
<?php $this->load->view('header-meta');?>
</head>
<body id="startbbs">
<?php $this->load->view('header');?>

<div id="wrap"><div class="container" id="page-main"><div class="row-fluid"><div class='span8'>

<div class='box'>
<div class='cell'>
<a href="/" class="startbbs"><?=$settings['site_name']?></a> <span class="chevron">&nbsp;›&nbsp;</span> 注册
</div>
<div class='inner'>
<form accept-charset="UTF-8" action="/user/reg/" class="simple_form form-horizontal" id="new_user" method="post" novalidate="novalidate">
<div style="margin:0;padding:0;display:inline">
<input name="utf8" type="hidden" value="&#x2713;" />
<input name="authenticity_token" type="hidden" value="zHmHYEJbz9hP+SpTe153DJH8BobrJSJ63cDjsuZayGs=" /></div>
<div class="control-group string required">
<label class="string required control-label" for="user_nickname">用户名</label>
<div class="controls">
<input autofocus="autofocus" class="string required" id="user_nickname" name="username" size="50" type="text" value="<?php echo set_value('username'); ?>" /><span class="help-inline red"><?php echo form_error('username');?></span>
</div></div>
<div class="control-group email optional">
<label class="email optional control-label" for="user_email">电子邮件</label>
<div class="controls">
<input class="string email optional" id="user_email" name="email" size="50" type="email" value="<?php echo set_value('email'); ?>" />
<span class="help-inline red"><?php echo form_error('email');?></span>
</div></div>
<div class="control-group password optional">
<label class="password optional control-label" for="user_password">密码</label>
<div class="controls">
<input class="password optional" id="user_password" name="password" size="50" type="password" value="<?php echo set_value('password'); ?>" />
<span class="help-inline red"><?php echo form_error('password');?></span>
</div></div>
<div class="control-group password optional">
<label class="password optional control-label" for="user_password_confirmation">密码确认</label>
<div class="controls">
<input class="password optional" id="user_password_confirmation" name="password_c" size="50" type="password" value="<?php echo set_value('password_c'); ?>" /><span class="help-inline red"><?php echo form_error('password_c');?></span>
</div></div>
<div class='form-actions'>
<input class="btn btn-small btn-primary" name="commit" type="submit" value="注册" />
</div>
</form>

</div>
</div>

</div>
<div class='span4' id='Rightbar'>

<div class='box'>
<div class='box-header'>
Startbbs
简介
</div>
<div class='inner'>
<p>Startbbs 是一款简洁社区软件。</p><p>去掉传统论坛的繁杂功能，让社区交流变得简单。</p>
<p>
<a href="/page/about" class="btn btn-small btn-info">了解 Startbbs</a>
<a href="/page/support" class="btn btn-small">技术支持</a>
</p>
</div>
</div>


<?php $this->load->view('block/right_ad');?>

</div>
</div></div></div>
<?php $this->load->view('footer');?>