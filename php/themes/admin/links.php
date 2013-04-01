<!DOCTYPE html><html><head><meta content='' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title><?=$title?> - 管理后台 - <?=$settings['site_name']?></title>
<?php $this->load->view('header-meta');?>
</head>
<body id="startbbs">
<?php $this->load->view('header');?>
<div id="wrap">
<div class="container" id="page-main">
<div class="row">
<?php $this->load->view('leftbar');?>
<div class='span8'>

<div class='box'>
<div class='cell'>
<div class='fr'>
<div class='btn-group'>
<a href="<?php echo site_url('admin/links/add');?>" class="btn btn-small" data-remote="true">添加链接</a>
</div>
</div>
<a href="/" class="startbbs1">StartBBS</a> <span class="chevron">&nbsp;›&nbsp;</span> <a href="<?php echo site_url('admin/');?>">管理后台</a> <span class="chevron">&nbsp;›&nbsp;</span> <?=$title?>
</div>
<div class='cell'>
<?php if($links){?>
<table class='topics table'>
<thead>
<tr>
<th class='w50'>ID</th>
<th align='left' class='auto'>链接名称</th>
<th align='left' class='auto'>网址</th>
<th align='right' class='auto'>显示</th>
<th class='w100'>操作</th>
</tr>
</thead>
<tbody>
<?php foreach($links as $v){ ?>
<tr class='highlight'>
<td class='w50'>
<strong class='green'>
<?=$v['id']?>
</strong>
</td>
<td class='auto'>
<a href="<?=$v['url']?>"><?=$v['name']?></a>
</td>
<td class='auto'>
<a href="<?=$v['url']?>" class="rabel profile_link" title="admin"><?=$v['url']?></a>
</td>
<td align='right' class='auto'>
<small class='fade1'><?php if($v['is_hidden']==0){?>显示<?} else {?>隐藏<?}?></small>
</td>
<td class='w100'>
<a href="<?php echo site_url('admin/links/edit/'.$v['id']);?>" class="btn btn-small">编辑</a>
<a href="<?php echo site_url('admin/links/del/'.$v['id']);?>" class="btn btn-small btn-danger" data-confirm="真的要删除吗？" data-method="delete" rel="nofollow">删除</a>
</td>
</tr>
<?php } ?>


</tbody>
</table>
<?php } else{?>
暂无贴子
<?php }?>
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
<?php $this->load->view ('footer');?>
</body></html>
