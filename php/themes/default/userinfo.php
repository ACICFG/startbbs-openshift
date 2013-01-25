<!DOCTYPE html>
<html>
<head>
<meta content='<?=$username?> - <?=$settings['site_name']?>' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title><?=$username?> - <?=$settings['site_name']?></title>
<?php echo $this->load->view('header-meta')?>
</head>
<body id="startbbs">
<?php echo $this->load->view('header')?>
<div id="wrap">
<div class="container" id="page-main">
<div class="row-fluid"><div class='span8'>
<div class='box'>
<div class='cell'>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td align='center' valign='top' width='73'>
<?php if($avatar){?>
<img alt="<?=$username?> large avatar" class="large_avatar" style="width:72px;" src="<?=$big_avatar?>"/>
<?php } else{?>
<img alt="<?=$username?> large avatar" class="large_avatar" style="width:72px;" src="/uploads/avatar/default.jpg"/>
<?php }?>
</td>
<td valign='top' width='10'></td>
<td align='left' valign='top' width='auto'>
<div class='fr'>
<div class='sep3'></div>
<!--<a href="/member/daqing/unfollow" class="btn btn-small btn-warning unfollow" data-method="post" rel="nofollow">取消特别关注</a>-->
</div>
<h2 style='padding: 0px; margin: 0px; font-size: 22px; line-height: 22px;'>
<?=$username?>
</h2>
<div class='sep5'></div>
<!--<span class='gray bigger'><?=$signature?></span>-->
<div class='sep5'></div>
<span class='snow'>
<?=$username?>
第
<?=$uid?>
号会员, 加入于
<?=$this->myclass->friendly_date($regtime)?>
</span>
<div class='sep10'></div>
<table border='0' cellpadding='2' cellspacing='0' width='100%'>
<tr>
<td width='50%'>
<span style='line-height: 16px;'>
签名:
&nbsp;
<?=$signature?>
</span>
</td>
</tr>
<tr>
<td width='50%'>
<span style='line-height: 16px;'>
个人主页
&nbsp;
<a href="<?=$homepage?>" class="startbbs" rel="nofollow external" target="_blank"><?=$homepage?></a>
</span>
</td>
</tr>
<tr>
<td width='50%'>
<span style='line-height: 16px;'>
所在地:
&nbsp;
<a href="http://www.google.com/maps?q=<?=$location?>" class="startbbs" rel="nofollow external" target="_blank"><?=$location?></a>
</span>
</td>
</tr>
</table>
</td>
</tr>
</table>
</div>
<div class='inner'><p><?=$introduction?></p><p>联系方式: <a href="mailto:<?=$email?>" class="external mail"><?=$email?></a></p></div>
</div>
<div class='box'>
<div class='box-header'>
<?=$username?>
最近创建的话题
</div>
<?php foreach($user_posts as $v){?>
<div class='admin cell topic'>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td valign='middle' width='auto'>
<span class='bigger'>
<a href="/forum/view/<?=$v['fid']?>" class="startbbs topic"><?=$v['title']?></a>
</span>
<div class='topic-meta'>
<a href="/go/noticeboard" class="node">公告栏</a>
&nbsp;&nbsp;•&nbsp;&nbsp;
<?=$this->myclass->friendly_date($v['addtime'])?>
&nbsp;&nbsp;•&nbsp;&nbsp;
最后回复来自
<a href="/member/marschris" class="startbbs profile_link" title="marschris">marschris</a>
</div>
</td>
<td align='right' valign='middle' width='40'>
<div class='badge badge-info'><?=$v['views']?></div>
</td>
</tr>
</table>
</div>
<? } ?>

<div class='inner'>
<span class='chevron'>»</span>
<small><a href="/member/daqing/topics" class="startbbs"><?=$username?> 创建的更多主题</a></small>
</div>
</div>
<div class='box'>
<div class='box-header'>
<?=$username?>
最近的回复
</div>
<?php foreach($user_comments as $v){?>
<div class='cell comment_header muted'>
<div class='pull-right timeago'>
<?=$this->myclass->friendly_date($v['replytime'])?>
</div>
回复了
<a href="/user/info/<?=$v['uid']?>" class="startbbs profile_link" title="<?=$v['username']?>"><?=$v['username']?></a>
<?=$this->myclass->friendly_date($v['addtime'])?>
<span class='chevron'>›</span>
<a href="/forum/view/<?=$v['fid']?>" class="startbbs"><?=$v['title']?></a>
</div>
<div class='inner'>
<div class='reply_content'>
<?=$v['content']?>
</div>
</div>
<div class='sep5'></div>
<? } ?>

</div>

</div>
<div class='span4' id='Rightbar'>
<?php $this->load->view('/block/right_login')?>

<!--<div class='box'>
<div class='box-header'>
关注daqing的人
<span class='gray'>(31)</span>
</div>
<div class='inner'>
<a href="/member/lihuanchun" class="profile_link" title="lihuanchun"><img alt="lihuanchun mini avatar" class="mini_avatar" src="/uploads/user_avatar/1/401/mini_8bec70c1f03.jpg" /></a>
<a href="/member/chopin" class="profile_link" title="chopin"><img alt="chopin mini avatar" class="mini_avatar" src="/avatar/mini_default.png" /></a>
<a href="/member/deeme" class="profile_link" title="deeme"><img alt="deeme mini avatar" class="mini_avatar" src="/avatar/mini_default.png" /></a>
<a href="/member/coon" class="profile_link" title="coon"><img alt="coon mini avatar" class="mini_avatar" src="/uploads/user_avatar/81/381/mini_310f8d895cf.png" /></a>
<a href="/member/leegang" class="profile_link" title="leegang"><img alt="leegang mini avatar" class="mini_avatar" src="/uploads/user_avatar/76/376/mini_06cc6e065ee.png" /></a>
<a href="/member/asdf01" class="profile_link" title="asdf01"><img alt="asdf01 mini avatar" class="mini_avatar" src="/uploads/user_avatar/78/278/mini_f9fb61a3196.jpg" /></a>
<a href="/member/doudou" class="profile_link" title="doudou"><img alt="doudou mini avatar" class="mini_avatar" src="/avatar/mini_default.png" /></a>
<a href="/member/4pple" class="profile_link" title="4pple"><img alt="4pple mini avatar" class="mini_avatar" src="/uploads/user_avatar/10/310/mini_6e3738054bc.jpg" /></a>
<a href="/member/xiao" class="profile_link" title="xiao"><img alt="xiao mini avatar" class="mini_avatar" src="/uploads/user_avatar/22/222/mini_0385535bc98.jpg" /></a>
<a href="/member/kandiyoki" class="profile_link" title="kandiyoki"><img alt="kandiyoki mini avatar" class="mini_avatar" src="/uploads/user_avatar/88/288/mini_267adc19f9e.jpg" /></a>
</div>
</div>-->


<?php $this->load->view('block/right_ad');?>

</div>
</div></div></div>
<?php $this->load->view('footer');?>