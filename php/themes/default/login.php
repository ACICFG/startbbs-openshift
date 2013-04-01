<!DOCTYPE html><html><head><meta content='登入' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title>登入 - <?=$settings['site_name']?></title>
<?php $this->load->view('header-meta');?>
</head>
<body id="startbbs">
<?php $this->load->view('header');?>

<div id="wrap"><div class="container" id="page-main"><div class="row-fluid"><div class='span8'>


<div class='box'>
<div class='cell'><a href="/" class="startbbs"><?=$settings['site_name']?></a> <span class="chevron">&nbsp;›&nbsp;</span> 登入</div>
<div class='inner'>
<form accept-charset="UTF-8" action="<?php echo site_url('user/login?referer='.$referer);?>" class="simple_form form-horizontal" id="new_user" method="post" novalidate="novalidate">
<div style="margin:0;padding:0;display:inline">
<input name="utf8" type="hidden" value="&#x2713;" />
<input name="authenticity_token" type="hidden" value="lr/g+0G/gLUzIhYpJwhtULW5aftcf8soZOHMznkxxT0=" />
</div>

<div class="control-group string required">
<label class="string required control-label" for="user_nickname">用户名</label>
<div class="controls">
<input autofocus="autofocus" class="string required" id="user_nickname" name="username" size="50" type="text" />
</div></div>
<div class="control-group password optional">
<label class="password optional control-label" for="user_password">密码</label>
<div class="controls">
<input class="password optional" id="user_password" name="password" size="50" type="password" />
</div></div>
<?php if($this->config->item('show_captcha')=='on'){?>
<div class="control-group captcha_code optional">
<label class="captcha_code optional control-label" for="captcha_code">验证码</label>
<div class="controls">
<input class="string captcha_code optional" id="captcha_code" name="captcha_code" size="50" type="text" value="" />
<span class="help-inline red"> <a href="javascript:reloadcode();" title="更换一张验证码图片"><img src="<?php echo site_url('captcha_code');?>" name="checkCodeImg" id="checkCodeImg" border="0" /></a> <a href="javascript:reloadcode();">换一张</a></span>
</div></div>
<script language="javascript">
//刷新图片
function reloadcode() {//刷新验证码函数
 var verify = document.getElementById('checkCodeImg');
 verify.setAttribute('src', '<?php echo site_url('captcha_code?');?>' + Math.random());
}
</script>
<?}?>
<div class='hide'>
<input name="user[remember_me]" type="hidden" value="0" />
<input checked="checked" id="user_remember_me" name="user[remember_me]" type="checkbox" value="1" /></div>
<div class='form-actions'>
<input class="btn btn-small btn-primary" name="commit" type="submit" value="登入" />
<div class='additional'>
<div class='gray'>登录后 cookie 会被记住一年</div>


  <a href="/users/password/new">找回登录密码</a>




</div>
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
<?php $this->load->view ('footer'); ?>