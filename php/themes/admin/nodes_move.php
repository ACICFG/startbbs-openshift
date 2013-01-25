<!DOCTYPE html><html><head><meta content='' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title><?=$title?> - 管理后台 - <?=$settings['site_name']?></title>
<?php $this->load->view ( 'header-meta' ); ?>
</head>
<body id="startbbs">
<?php $this->load->view ( 'header' ); ?>

<div id="wrap">
<div class="container" id="page-main">
<div class="row">

<?php $this->load->view ('leftbar');?>

<div class='span8'>

<div class='box'>
<div class='cell'>
<div class='pull-right'><a href="/admin/nodes" class="btn">返回分类列表</a></div>
<a href="/" class="startbbs1">StartBBS</a> <span class="chevron">&nbsp;›&nbsp;</span> <a href="/admin">管理后台</a> <span class="chevron">&nbsp;›&nbsp;</span> 移动分类
</div>
<div class='cell'>
<form accept-charset="UTF-8" action="/admin/nodes/move/<?=$cid?>" class="simple_form form-horizontal" id="edit_user_1" method="post" novalidate="novalidate">
<div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="_method" type="hidden" value="put" /><input name="authenticity_token" type="hidden" value="iM/k39XK4U+GmgVT7Ps8Ko3OhPrcTBqUSu4yKYPgAjk=" /></div>
<div class="control-group email optional">
<label class="email optional control-label" for="user_email">移动到</label>
<div class="controls">
<select name="pid" id="pid" class="string email optional">
<option selected="selected" value="0">根目录</option>
<?php foreach($cates as $v){?>
<option value="<?=$v['cid']?>"><?=$v['cname']?></option>
<?php } ?>
</select>
</div></div>
<div class='form-actions'>
<input class="btn btn-small btn-primary" name="commit" type="submit" value="开始移动" />
</div>
</form>
</div>
</div>

</div>
</div></div></div>
<?php $this->load->view ('footer');?>

</body></html>
