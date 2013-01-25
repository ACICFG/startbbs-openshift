<!DOCTYPE html>
<html>
<head>
<meta content='建议与想法 - ' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title><?=$title?> - <?=$settings['site_name']?></title>
<?php $this->load->view('header-meta');?>
</head>
<body id="startbbs">
<?php $this->load->view('header');?>
<div id="wrap"><div class="container" id="page-main"><div class="row-fluid"><div class='span8'>

<div class='box'>
<div class='box-header'>
编辑话题 <?=$item['title']?>
</div>
<div class='inner'>
<!--<div class='alert alert-info'>如果标题已经包含你想说的话，内容可以留空。</div>-->
<form accept-charset="UTF-8" action="/forum/edit/<?=$item['fid']?>" class="simple_form form-vertical" id="new_topic" method="post" novalidate="novalidate">
<div style="margin:0;padding:0;display:inline">
<input name="utf8" type="hidden" value="&#x2713;" />
<input name="uid" type="hidden" value="1" />
<input name="cid" type="hidden" value="1" />
</div>
<a name='new_topic'>
<div class="control-group string required">
<label class="string required control-label" for="topic_title">标题</label>
<div class="controls">
<input class="string required span5" id="topic_title" maxlength="100" name="title" size="60" type="text" value="<?=$item['title']?>" />
<span class="help-inline red"><?php echo form_error('title');?></span>
</div>
</div>
<!--<div class='pull-right'>
<a class='fileupload-btn action_label'>
<span id='upload-tip'>上传图片</span>
<input id='fileupload' multiple name='upyun_image[asset][]' type='file'>
</a>
</div>-->

<div id='preview-widget'>
<a href="javascript:void(0);" class="action_label cancel_preview current_label" data-ref="topic_content">编辑</a>
</div>

<div class="control-group text optional">
<div class="controls">
<textarea class="text optional" cols="40" id="topic_content" name="content" placeholder="话题内容" rows="10" style="width: 98%;"><?=$item['content']?>
</textarea>
<span class="help-inline red"><?php echo form_error('content');?></span>
</div>
</div>
<input class="btn btn-primary btn-inverse" data-disable-with="正在提交" name="commit" type="submit" value="修改" />
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