<div class='box'>
<div class='box-header'>
分类节点
</div>
<div class='inner'>
<?php foreach ($catelist as $c){?>
<a href="<?php echo site_url('forum/flist/'.$c['cid']);?>" class="startbbs item_node"><?=$c['cname']?></a>
<?}?>
</div>
</div>