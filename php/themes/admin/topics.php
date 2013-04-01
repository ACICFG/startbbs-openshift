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
<a href="/" class="startbbs1">StartBBS</a> <span class="chevron">&nbsp;›&nbsp;</span> <a href="<?php echo site_url('admin/');?>">管理后台</a> <span class="chevron">&nbsp;›&nbsp;</span> 讨论话题
</div>
<div class='cell'>
<?php if($topics){?>
<table class='topics table'>
<thead>
<tr>
<th class='w50'>ID</th>
<th align='left' class='auto'>节点</th>
<th align='left' class='auto'>标题</th>
<th align='left' class='auto'>作者</th>
<th align='right' class='auto'>回复数</th>
<th align='right' class='auto'>浏览量</th>
<th align='right' class='auto'>创建时间</th>
<th class='w100'>操作</th>
</tr>
</thead>
<tbody>
<?php foreach($topics as $v){ ?>
<tr class='highlight'>
<td class='w50'>
<strong class='green'>
<?=$v['fid']?>
</strong>
</td>
<td class='auto'>
<a href="<?php echo site_url('forum/flist/'.$v['cid']);?>"><?=$v['cname']?></a>
</td>
<td class='auto'>
<a href="<?php echo site_url('forum/view/'.$v['fid']);?>"><?=$v['title']?></a>
</td>
<td class='auto'>
<a href="<?php echo site_url('user/info/'.$v['uid']);?>" class="rabel profile_link" title="admin"><?=$v['username']?></a>
</td>
<td align='right' class='auto'>
<?=$v['comments']?>
</td>
<td align='right' class='auto'>
<?=$v['views']?>
</td>
<td align='right' class='auto'>
<small class='fade1'><?=date('Y-m-d',$v['addtime'])?></small>
</td>
<td class='w100'>
<a href="<?php echo site_url('forum/edit/'.$v['fid']);?>" class="btn btn-small">编辑</a>
<a href="<?php echo site_url('admin/topics/del/'.$v['fid'].'/'.$v['cid'].'/'.$v['uid']);?>" class="btn btn-small btn-danger" data-confirm="真的要删除吗？" data-method="delete" rel="nofollow">删除</a>
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
