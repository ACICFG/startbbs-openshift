<!DOCTYPE html><html><head><meta content='' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title><?=$title?> - 管理后台 - <?=$settings['site_name']?></title>
<?php $this->load->view ( 'header-meta' ); ?>
</head>
<body id="startbbs">
<?php $this->load->view ('header'); ?>
<div id="wrap"><div class="container" id="page-main">
<div class="row">
<?php $this->load->view ('leftbar');?>

<div class='span8'>

<div class='box'>
<div class='cell'>
<div class='fr'>
<form accept-charset="UTF-8" action="<?php echo site_url('admin/users');?>" class="form-search" method="get"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /></div>
<div class='input-append'>
<input class="span2 search-query" id="nickname" name="nickname" placeholder="用户昵称" type="text" />
<input class="btn" name="commit" type="submit" value="搜索" />
</div>
</form>
</div>
<a href="/" class="startbbs1">StartBBS</a> <span class="chevron">&nbsp;›&nbsp;</span> <a href="<?php echo site_url('admin/');?>">管理后台</a> <span class="chevron">&nbsp;›&nbsp;</span> 用户
</div>
<div class='cell'>
<table class='table'>
<thead>
<tr>
<th align='right'>ID</th>
<th align='left' class='w50'>昵称</th>
<th align='left' class='auto'>角色</th>
<th align='left' class='auto'>Email</th>
<th align='right' class='auto'>银币</th>
<th>操作</th>
</tr>
</thead>
<tbody>
<?php foreach($users as $v){?>
<tr class='highlight' id='user_<?=$v['uid']?>'>
<td align='right'><?=$v['uid']?></td>
<td align='left' class='auto'>
<strong>
<a href="<?php echo site_url('user/info/'.$v['uid']);?>" class="black startbbs profile_link" title="admin"><?=$v['username']?></a>
</strong>
</td>
<td align='left' class='w50'>
<strong class='green'><?=$v['gid']?></strong>
</td>
<td align='left' class='auto'><?=$v['email']?></td>
<td align='right' class='auto'>
<?=$v['money']?>
</td>
<td class='center'>
<a href="<?php echo site_url('admin/users/edit/'.$v['uid']);?>" class="btn btn-small">修改用户信息</a>
</td>
</tr>
<?}?>
</tbody>
</table>
</div>
<div align='center' class='inner'>
<div class='pagination pagination-centered pagination-small'>
<ul>
<?=$pagination?>
</ul>
</div>

</div>
</div>

</div>
</div></div></div>
<?php $this->load->view ( 'footer' ); ?>

</body></html>