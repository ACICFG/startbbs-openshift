<!DOCTYPE html><html><head>
<meta content='StartBBS 是新一代简洁社区软件，让论坛回归交流本质！技术先进，管理方便，深度定制。&#x000A;不喜欢传统论坛？试试StartBBS ！' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title><?=$settings['site_name']?> - 让论坛回归交流本质</title>
<?php $this->load->view('header-meta');?>
</head>
<body id="startbbs">
<?php $this->load->view('header');?>
<div id="wrap">
<div class="container" id="page-main">
<div class="row-fluid"><div class='span8'>

<div class='box' id='topics_index'>
<div align='left' class='cell'>
<div class='pull-right marketing'>
<span class='gray' style='font-size: 110%'>
<span class="snow"><?=$settings['site_keywords']?></span></span>
</div>
<div class='bigger welcome'><?=$settings['welcome_tip']?></div>
<div class='sep10'></div>
<div class="hero-unit"><h1>StartBBS</h1><p><?=$settings['short_intro']?></p></div>
</div>
<?php if($list){?>
<?php foreach ($list as $v){?>
<div class='cell topic'>
<div class='avatar pull-left'>
<a href="/user/info/<?=$v['uid']?>" class="profile_link" title="chenge">
<?php if($v['avatar']){?>
<img alt="chenge medium avatar" class="medium_avatar" src="<?=$v['avatar'];?>"/></a>
<?php } else{?>
<img alt="admin medium avatar" class="medium_avatar" src="/uploads/avatar/default.jpg" />
<?php }?>
</a>
</div>
<div class='item_title'>
<div class='pull-right'>
<div class='badge badge-info'><?=$v['comments']?></div>
</div>
<h2 class='topic_title'>
<a href="/forum/view/<?=$v['fid']?>" class="startbbs topic"><?=$v['title']?></a>
</h2>
<div class='topic-meta'>
<a href="/forum/flist/<?=$v['cid']?>" class="node"><?=$v['cname']?></a>
<span class='muted'>•</span>
<a href="/user/info/<?=$v['uid']?>" class="dark startbbs profile_link" title="chenge"><?=$v['username']?></a>
<span class='muted'>•</span>
<?=$this->myclass->friendly_date($v['updatetime'])?>
<span class='muted'>•</span>
<?php if($v['rname']){?>
最后回复来自
<a href="/user/info/<?=$v['ruid']?>" class="startbbs profile_link" title="daqing"><?=$v['rname']?></a>
<?} else {?>
暂无回复
<?}?>
</div>
</div>
</div>
<?php } ?>
<?php } else{?>
<div class='cell topic'>
暂无话题, 请发表话题！
</div>
<?php } ?>
<div class='inner'>
<div class='pull-right'><img align="absmiddle" alt="Rss" src="/static/images/rss.png" />
<a href="/" class="dark" target="_blank">RSS</a>
</div>
&nbsp;
<span class='chevron'>»</span>
<a href="/" class="startbbs">更多新主题</a>
</div>
</div>

<div class='box fix_cell' id='planes'>
<div class='box-header'>
<Strong><?=$settings['site_name']?></Strong>
/ 节点导航
</div>
<div class='cell'>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td style='line-height: 200%; padding-left: 15px;'>
<?php foreach ($catelist as $c){?>
<a href="/forum/flist/<?=$c['cid']?>" class="startbbs item_node"><?=$c['cname']?></a>
<?}?>
</td>
</tr>
</table>
</div>



</div>


</div>
<div class='span4' id='Rightbar'>
<?php $this->load->view('block/right_login');?>

<div class='box'>
<div class='box-header'>
社区运行状态
</div>
<div class='inner'>
<table border='0' cellpadding='3' cellspacing='0' width='100%'>
<tr>
<td align='right' width='50'>
<span class='gray'>最新会员</span>
</td>
<td align='left'>
<strong><?=$last_user['username']?></strong>
</td>
</tr>
<tr>
<td align='right' width='60'>
<span class='gray'>注册会员</span>
</td>
<td align='left'>
<strong><?=$total_users?></strong>
</td>
</tr>
<tr>
<td align='right' width='50'>
<span class='gray'>话题数</span>
</td>
<td align='left'>
<strong><?=$total_forums?></strong>
</td>
</tr>
<tr>
<td align='right' width='50'>
<span class='gray'>回复数</span>
</td>
<td align='left'>
<strong><?=$total_comments?></strong>
</td>
</tr>
</table>
</div>
</div>

<?php $this->load->view('block/right_ad');?>

<div class='box'>
<div class='box-header'>
友情链接
</div>
<div class='inner'>
<ul class="unstyled">
<li style="display:none"><a href="http://www.startbbs.com" target="_blank">StartBBS</a></li>
<?php if($links){?>
<?php foreach($links as $v){?>
<?php if($v['is_hidden']==0){?>
<li><a href="<?php echo $v['url'];?>" target="_blank"><?php echo $v['name'];?></a></li>
<?php } else {?>
<li>暂无链接</li>
<?php } ?>
<?php }?>
<?php } else {?>
<li>暂无链接</li>
<?php }?>
</ul>
</div>
</div>


</div>
</div></div></div>
<?php $this->load->view('footer');?>