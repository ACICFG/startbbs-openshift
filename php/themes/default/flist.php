<!DOCTYPE html>
<html>
<head>
<meta content='<?=$title?> - ' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title><?=$title?>- <?=$settings['site_name']?></title>
<?php $this->load->view ('header-meta');?>
</head>
<body id="startbbs">
<?php $this->load->view ('header');?>

<div id="wrap">
<div class="container" id="page-main">
<div class="row-fluid"><div class='span8'>


<div class='box'>
<div class='box-header'>
<div class='fr'>
话题总数
<div class='label'>
&nbsp;
<?=$category['listnum'];?>
&nbsp;
</div>
</div>
<a href="/" class="startbbs"><?=$settings['site_name']?></a> <span class="chevron">&nbsp;>&nbsp;</span> <?=$category['cname'];?>
<div class='sep10'></div>
<a href="#new_topic" class="btn btn-normal">快速发表到本版块</a>
<div class='sep5'></div>
</div>
<?php if($list){?>
<?php foreach ($list as $v) {?>
<div class='admin cell topic'>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td class='avatar' valign='top'>
<a href="/user/info/<?php echo $v['uid'];?>" class="profile_link" title="<?php echo $v['username'];?>">
<?php if($v['avatar']) {?>
<img alt="<?php echo $v['username'];?> medium avatar" class="medium_avatar" src="<?php echo $v['avatar'];?>" />
<?php } else {?>
<img alt="<?php echo $v['username'];?> medium avatar" class="medium_avatar" src="/uploads/avatar/default.jpg" />
<?php }?>
</a>
</td>
<td style='padding-left: 12px' valign='top'>
<div class='fr'>
<div class='badge badge-info'><?php echo $v['comments'];?></div>
</div>
<div class='sep3'></div>
<h2 class='topic_title'>
<a href="/forum/view/<?=$v['fid']?>" class="startbbs topic"><?php echo $v['title'];?></a>
</h2>
<div class='topic-meta'>
<a href="/forum/flist/<?=$v['cid']?>" class="node"><?=$category['cname'];?></a>
&nbsp;&nbsp;•&nbsp;&nbsp;
<a href="/user/info/<?php echo $v['uid'];?>" class="dark startbbs profile_link" title="<?php echo $v['username'];?>"><?php echo $v['username'];?></a>
&nbsp;&nbsp;•&nbsp;&nbsp;
<?php echo $this->myclass->friendly_date($v['addtime']);?>
&nbsp;&nbsp;•&nbsp;&nbsp;
最后回复来自
<a href="/user/info/<?php echo $v['ruid'];?>" class="startbbs profile_link" title="agred"><?php echo $v['rname'];?></a>
</div>
</td>
</tr>
</table>
</div>
<?php } ?>
<?php } else{?>
<div class='cell topic'>
暂无话题, 请发表话题！
</div>
<?php } ?>

<div class='inner'>
<ul class='pager'>
<li class='center'>
<?=$pagination?>
<!--<span class='gray'></span>-->
</li>
<li class='next'>
<a href="/go/noticeboard?p=2">下一页 →</a>
</li>
</ul>

</div>
</div>
<div class='box'>
<div class='box-header'>
创建新话题
</div>
<div class='inner'>
<div class='alert alert-info'>如果标题已经包含你想说的话，内容可以留空。</div>
<form accept-charset="UTF-8" action="/forum/add" class="simple_form form-vertical" id="new_topic" method="post" novalidate="novalidate"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="saf8/EK6n+k1mxuvmmf8KQNiSp64MfnXn4+xk26ccMA=" />
<input name="cid" type="hidden" value="<?=$category['cid'];?>" />
</div>
<a name='new_topic'>
<div class="control-group string required"><label class="string required control-label" for="topic_title">标题</label>
<div class="controls">
<input class="string required span4" id="topic_title" maxlength="150" name="title" size="50" type="text" />
<span class="help-inline red"><?php echo form_error('title');?></span>
</div></div>
<div class='pull-right'>
<a class='fileupload-btn action_label'>
<span id='upload-tip'>上传图片</span>
<input id='fileupload' multiple name='upyun_image[asset][]' type='file'>
</a>
</div>

<div id='preview-widget'>
<a href="javascript:void(0);" class="action_label cancel_preview current_label" data-ref="topic_content">编辑</a>
<div id='preview'></div>
</div>

<div class="control-group text optional"><div class="controls"><textarea class="text optional" cols="40" id="topic_content" name="content" placeholder="话题内容" rows="10" style="width: 98%;">
</textarea>
<span class="help-inline red"><?php echo form_error('content');?></span>
</div></div>
<input class="btn btn-primary btn-inverse" data-disable-with="正在提交" name="commit" type="submit" value="创建" />
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