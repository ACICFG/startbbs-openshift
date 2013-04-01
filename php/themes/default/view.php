<!DOCTYPE html>
<html>
<head>
<meta content='<?=$content['title']?> - <?=$settings['site_name']?>' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title><?=$content['title']?> - <?=$settings['site_name']?></title>
<script charset="utf-8" src="<?php echo base_url('plugins/kindeditor/kindeditor-min.js');?>"></script>
<script charset="utf-8" src="<?php echo base_url('plugins/kindeditor/lang/zh_CN.js');?>"></script>
<?php $this->load->view ('header-meta');?>
<?php if($this->config->item('show_editor')=='on'){?>
<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('#reply_content', {
					width : '100%',
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : true,
					items : [
						'source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image','multiimage', 'link', '|','clearhtml','code'],

				    afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=add_new]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=add_new]')[0].submit();
					});
					}

				});
				$(".clickable").live('click',function(){
				var uname =$(this).attr('data-mention');
                editor.insertHtml('@'+uname+' ');
        		});
			});
</script>
<?} else {?>
<link rel="stylesheet" href="<?php echo base_url('plugins/kindeditor/themes/default/default.css');?>" />
<script charset="utf-8" src="<?php echo base_url('plugins/kindeditor/keupload.js');?>"></script>
<?}?>

</head>
<body id="startbbs">
<a id="top" name="top"></a>
<?php $this->load->view ('header'); ?>
<div id="wrap"><div class="container" id="page-main"><div class="row-fluid"><div class='span8'>

<div class='box'>
<article>
<div class='header'>
<div class='pull-right'>
<a href="<?php echo site_url('user/info/'.$content['uid']);?>" class="profile_link" title="<?=$content['username']?>">
<?php if($content['avatar']) {?>
<img alt="<?=$content['username']?> medium avatar" class="medium_avatar" src="<?php echo base_url($content['avatar']);?>" />
<?php } else {?>
<img alt="<?=$content['username']?> medium avatar" class="medium_avatar" src="<?php echo base_url('uploads/avatar/default.jpg');?>" />
<?php }?>
</a>
</div>
<h1 id='topic_title'>
<?=$content['title']?>
</h1>
<small class='topic-meta'>
By
<a href="<?php echo site_url('user/info/'.$content['uid']);?>" class="dark startbbs profile_link" title="<?=$content['username']?>"><?=$content['username']?></a>
at
<?php echo $this->myclass->friendly_date($content['addtime']);?>,
<?=$content['views']?>次浏览 • <?php echo $content['favorites'];?>人收藏
<?php if($this->session->userdata('uid')){?>
• <a href="#reply_content">回复</a> • 
<?php if($in_favorites){?>
<a href="<?php echo site_url('favorites/del/'.$content['fid']);?>" title="取消收藏">取消收藏</a>
<?} else {?>
<a href="<?php echo site_url('favorites/add/'.$content['fid']);?>" title="点击收藏">收藏</a>
<? } ?>
<? } ?>
</small>
</div>
<div class='inner'>
<div class='content topic_content'><?=$content['content']?></div>
</div>
<div class='inner'>
<div class='pull-left'>
<?php if($this->auth->is_user($content['uid']) || $this->auth->is_admin()){?>
<a href="<?php echo site_url('forum/edit/'.$content['fid']);?>" class="btn btn-mini unbookmark" data-method="edit" rel="nofollow">编辑此贴</a>
<a href="<?php echo site_url('forum/del/'.$content['fid'].'/'.$content['cid'].'/'.$content['uid']);?>" class="btn btn-mini btn-danger" data-method="edit" rel="nofollow">删除</a>
<?php }?>
</div>
<div align='right' class='fr'>
<!--<a href="/topics/187/bookmarks" class="btn btn-mini bookmark" data-method="post" rel="nofollow">加入收藏</a>-->
</div>
&nbsp;&nbsp;
</div>
</article>
</div>
<section>
<div class='box'>
<div class='box-header'>
<div class='fr'>
<a href="#reply" class="dark jump_to_comment">跳到回复</a>
</div>
<?=$content['comments']?> 回复
</div>
<div class='fix_cell' id='saywrap'>
<?php foreach ($comment as $key=>$v){?>
<article>
<div class='cell hoverable reply' id='comment_988'>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td valign='top' width='48'>
<a href="<?php echo site_url('user/info/'.$v['uid']);?>" class="profile_link" title="<?=$v['username']?>">
<?php if($v['avatar']) {?>
<img alt="<?=$v['username']?> medium avatar" class="medium_avatar" src="<?echo base_url($v['avatar']);?>" />
<?php } else {?>
<img alt="<?=$v['username']?> medium avatar" class="medium_avatar" src="<?echo base_url('uploads/avatar/default.jpg');?>" />
<?php }?>
</a>
</td>
<td width='10'></td>
<td valign='top' width='auto'>
<div class='fr'>
<small class='snow'>
#<?php echo $key+1;?> -
<?=$this->myclass->friendly_date($v['replytime'])?>

<a href="#comment" onclick="replyOne('<?=$v['username']?>');"><img align="absmiddle" alt="Reply_button" border="0" class="clickable mention_button" data-mention="<?=$v['username']?>" src="<?echo base_url('static/images/reply_button.png');?>" /></a>
</small>
</div>
<a href="<?php echo site_url('user/info/'.$v['uid']);?>" class="dark startbbs profile_link" title="<?=$v['username']?>"><?=$v['username']?></a>
<span class="snow">&nbsp;&nbsp;<?=$v['signature']?></span>
<div class='sep5'></div>
<div class='content reply_content'><?=$v['content']?></div>
</div>
</td>
</tr>
</table>
</div>
</article>
 <?php }?> 

</div>
</div>
</section>
<a name='reply'></a>

<div class='box'>
<div class='box-header'>
<div class='fr'>
<a href="#top" class="dark back_to_top">回到顶部</a>
</div>
现在就添加一条回复
</div>
<div class='inner'>
<?php if($this->auth->is_login()){?>
<form id="myform" action="<?php echo site_url('forum/view/'.$content['fid']);?>" method="post" name="add_new">
<input name="utf8" type="hidden" value="&#x2713;" />
<input name="authenticity_token" type="hidden" value="b9p2+DhdHWTAHdRMrexpe7XxI2HxTaX7MaUKEaQiUsY=" />
<input name="fid" id="fid" type="hidden" value="<?=$content['fid']?>" />

<?php if($this->config->item('show_editor')=='off'){?>
<div class='pull-right'>
<a class='fileupload-btn action_label'>
<span id='upload-tip'>上传图片</span>
</a>
</div>
<?}?>

<div id='preview-widget'>
<a href="javascript:void(0);" class="action_label cancel_preview current_label" data-ref="comment_content">编辑</a>
<div id='preview'></div>
</div>
<div id="textContain">
<textarea cols="40" id="reply_content" name="comment" rows="5" style="width: 98%;">
</textarea>
</div>
<div class='sep10 muted' style="float:right">可直接粘贴链接和图片地址/发代码用&lt;pre&gt;标签</div>
<input class="btn" data-disable-with="正在提交" type="submit" id="comment-submit" value="发送" />
<small class='gray'>(支持 Ctrl + Enter 快捷键)</small>
 <span id="msg"></span>
 </form>
 <?php } else{?>
<div style="text-align: center;">
<p>欢迎来到Startbbs！这里是一个简单、温馨的小社区。</p>
<p><a class="btn btn-middle" href="<?php echo site_url('user/login');?>">登录发表</a></p>
<p><a href="<?php echo site_url('user/reg');?>">还没有账号？去注册</a></p>
</div>
 <?php }?>
</div>
</div>



</div>
<div class='span4' id='Rightbar'>
<?php $this->load->view('block/right_login');?>

<?php $this->load->view('block/right_cates');?>

<?php if($this->auth->is_admin() && isset($_COOKIE['username'])){ ?>
<!--<div class='box'>
<div class='box-header'>
话题管理
</div>
<div class='cell'>
<a href="/nodes/1/topics/26/edit_title" class="btn btn-mini" data-remote="true">修改标题</a>
<a href="/nodes/1/topics/26/edit" class="btn btn-mini">编辑全部</a>
</div>
<div class='cell'>
<a href="/nodes/1/topics/26/move" class="btn btn-mini" data-remote="true">移动到新节点</a>
</div>
<div class='cell'>
<a href="/topics/26/toggle_comments_closed" class="btn btn-mini" data-method="put" rel="nofollow">禁止回复</a>
<a href="/topics/26/toggle_sticky" class="btn btn-mini" data-method="put" rel="nofollow">置顶此话题</a>
</div>
<div class='inner'>
<a href="/nodes/1/topics/26" class="btn btn-mini btn-danger" data-confirm="真的要删除吗？" data-method="delete" rel="nofollow">删除此话题</a>
</div>
</div>-->
<?php }?>

<?php $this->load->view('block/right_ad');?>
</div>
</div></div></div>
<?php $this->load->view ('footer'); ?>