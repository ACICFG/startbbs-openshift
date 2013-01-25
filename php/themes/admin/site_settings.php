<!DOCTYPE html><html><head><meta content='' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title>基本设置 - 管理后台 - <?=$settings['site_name']?></title>
<?php $this->load->view ( 'header-meta' ); ?>
</head>
<body id="starbbs">
<?php $this->load->view ( 'header' ); ?>

<div id="wrap"><div class="container" id="page-main">
<div class="row">
<?php $this->load->view ( 'leftbar' ); ?>

<div class='span8'>

<div class='box'>
<div class='cell'>
<a href="/" class="startbbs1">StartBBS</a> <span class="chevron">&nbsp;›&nbsp;</span> <a href="/admin">管理后台</a> <span class="chevron">&nbsp;›&nbsp;</span> 基本设置
</div>
<div class='inner'>
<form accept-charset="UTF-8" action="/admin/site_settings" class="form-horizontal" method="post">
<div style="margin:0;padding:0;display:inline">
<input name="utf8" type="hidden" value="&#x2713;" />
<input name="_method" type="hidden" value="put" />
<input name="authenticity_token" type="hidden" value="YNAXPQDviOJ/cf5OH/KrqdxOjGLCdka+kUCp+fa3J+A=" />
</div>
<div class='control-group'>
<label class="control-label" for="settings_site_name">网站名称</label>
<div class='controls'>
<input id="settings_site_name" name="site_name" type="text" value="<?=$item['0']['value'];?>" />
<small class='help-inline'>必填</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_welcome_tip">欢迎信息</label>
<div class='controls'>
<input class="span4" id="settings_welcome_tip" name="welcome_tip" type="text" value="<?=$item['1']['value'];?>" />
<small class='help-inline'>支持 HTML</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_short_intro">简短介绍</label>
<div class='controls'>
<input class="span4" id="settings_short_intro" name="short_intro" type="text" value="<?=$item['2']['value'];?>" />
<small class='help-inline'>网站简短介绍, 显示在右侧边栏</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_marketing_str">关键字</label>
<div class='controls'>
<input class="span4" id="settings_marketing_str" name="site_keywords" type="text" value="<?=$item['6']['value'];?>" />
<small class='help-inline'>用英文逗号(,)隔开</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_ga_id">Google Analytics ID</label>
<div class='controls'>
<input class="sls" id="settings_ga_id" name="settings[ga_id]" type="text" value="" />
<small class='help-inline'>例如: UA-12345678-01</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_show_captcha">注册验证码</label>
<div class='controls'>
<label class='radio inline'>
<input<?php if($item['3']['value'] =='on'){ ?> checked="checked"<?php } ?> id="settings_show_captcha_on" name="show_captcha" type="radio" value="on" />
开启
</label>
<label class='radio inline'>
<input<?php if($item['3']['value'] =='off'){ ?> checked="checked"<?php } ?> id="settings_show_captcha_off" name="show_captcha" type="radio" value="off" />
关闭
</label>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_show_community_stats">社区运行状态</label>
<div class='controls'>
<label class='radio inline'>
<input<?php if($item['4']['value'] =='on'){ ?> checked="checked"<?php } ?> id="settings_show_community_stats_on" name="site_run" type="radio" value="on" />
显示
</label>
<label class='radio inline'>
<input<?php if($item['4']['value'] =='off'){ ?> checked="checked"<?php } ?> id="settings_show_community_stats_off" name="site_run" type="radio" value="off" />
隐藏
</label>
</div>
</div>

<div class='control-group'>
<label class="control-label" for="settings_custom_head_tags">第三方统计代码</label>
<div class='controls'>
<textarea class="span6" id="settings_custom_head_tags" name="site_stats" rows="5"><?=$item['5']['value'];?>
</textarea>
<small class='help-inline'>支持HTML</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_seo_description">SEO 描述</label>
<div class='controls'>
<textarea class="span6" id="settings_seo_description" name="site_description">
<?=$item['7']['value'];?></textarea>
<small class='help-inline'>用于HTML meta标签</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_reward_title">奖励名称</label>
<div class='controls'>
<input id="settings_reward_title" name="reward_title" type="text" value="<?=$item['8']['value'];?>" />
<small class='help-inline'>例如: 银币，金币，积分，优惠券，代金券，蓝钻, Q币等</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_pagination_comments">列表每页条数</label>
<div class='controls'>
<div class='input-append'>
<input class="input-mini" id="settings_pagination_comments" name="per_page_num" type="text" value="<?=$item['9']['value'];?>" />
<span class='add-on'>/ 页</span>
</div>
</div>
</div>
<div class='form-actions'>
<input class="btn btn-small btn-primary" name="commit" type="submit" value="保存" />
</div>
</form>
</div>
</div>

</div>
</div></div></div>
<?php $this->load->view ( 'footer' ); ?>
</body></html>
