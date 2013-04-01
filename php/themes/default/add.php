<!DOCTYPE html>
<html>
<head>
<meta content='<?=$title?> - ' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title><?=$title?> - <?=$settings['site_name']?></title>
<?php $this->load->view('header-meta');?>
<script charset="utf-8" src="<?php echo base_url('plugins/kindeditor/kindeditor-min.js');?>"></script>
<script charset="utf-8" src="<?php echo base_url('plugins/kindeditor/lang/zh_CN.js');?>"></script>
<?php if($this->config->item('show_editor')=='on'){?>
<script charset="utf-8" src="<?php echo base_url('plugins/kindeditor/keset.js');?>"></script>
<?} else {?>
<link rel="stylesheet" href="<?php echo base_url('plugins/kindeditor/themes/default/default.css');?>" />
<script charset="utf-8" src="<?php echo base_url('plugins/kindeditor/keupload.js');?>"></script>
<?}?>
</head>
<body id="startbbs">
<?php $this->load->view('header');?>
<div id="wrap"><div class="container" id="page-main"><div class="row-fluid"><div class='span8'>

<div class='box'>
<div class='box-header'>
创建新话题
</div>
<div class='inner'>
<!--<div class='alert alert-info'>如果标题已经包含你想说的话，内容可以留空。</div>-->
<form accept-charset="UTF-8" action="<?php echo site_url('forum/add')?>" class="simple_form form-vertical" id="new_topic" method="post" novalidate="novalidate" name="add_new">
<div style="margin:0;padding:0;display:inline">
<input name="utf8" type="hidden" value="&#x2713;" />
<input name="uid" type="hidden" value="1" />
<input name="cid" type="hidden" value="1" />
</div>
<a name='new_topic'></a>
<div class="control-group string required">
<label for="topic_title">标题</label>
<div class="controls">
<input class="string required span5" id="topic_title" maxlength="100" name="title" size="60" type="text" value="<?php echo set_value('title'); ?>" />
<span class="help-inline red"><?php echo form_error('title');?></span>
</div>
</div>

<div class="control-group optional">
<label for="category">版块</label>
<div class="controls">
<select name="cid" id="cid">
<?php if(set_value('cid')){?>
<option selected="selected" value="<?php echo set_value('cid'); ?>"><?php echo $cate['cname']?></option>
<?php } else {?>
<option selected="selected" value="">请选择分类</option>
<?php } ?>
<?php foreach($category as $c) {?>
<option value="<?=$c['cid']?>"><?php if($c['pid']!=0){?>--<?}?><?=$c['cname']?></option>
<?php } ?>
</select>
<span class="help-inline red"><?php echo form_error('cid');?></span>
</div>
</div>
<?php if($this->config->item('show_editor')=='off'){?>
<div class='pull-right'>
<a class='fileupload-btn action_label'>
<span id='upload-tip'>上传图片</span>
</a>
</div>

<?}?>
<div id='preview-widget'>
<a href="javascript:void(0);" class="action_label cancel_preview current_label" data-ref="topic_content">编辑</a>
</div>

<div class="control-group text optional">
<div class="controls" id="textContain">
<textarea class="text optional" cols="40" id="topic_content" name="content" placeholder="话题内容" rows="10" style="width: 98%;"><?php echo set_value('content'); ?>
</textarea>
<span class="help-inline red"><?php echo form_error('content');?></span><span class="muted" style="float:right">可直接粘贴链接和图片地址/发代码用&lt;pre&gt;标签</span>
</div>
</div>

<input class="btn btn-primary" data-disable-with="正在提交" name="commit" type="submit" value="创建" />
<small class='gray'>(支持 Ctrl + Enter 快捷键)</small>
</form>
</div>
</div>

</div>
<div class='span4' id='Rightbar'>
<?php $this->load->view('block/right_login')?>
<?php $this->load->view('block/right_ad');?>

</div>
</div></div></div>
<?php $this->load->view ('footer'); ?>