<?php if($this->session->userdata('uid')){ ?>
<div class='box'>
<div class='cell'>
<table>
<tr>
<td valign='top' width='100'>
<a href="/user/info/<?=$user['uid']?>" class="profile_link" title="admin">
<?php if($user['avatar']){?>
<img alt="admin large avatar" class="large_avatar" src="<?=$user['big_avatar']?>" />
<?php } else{?>
<img alt="admin medium avatar" class="medium_avatar" src="/uploads/avatar/default.jpg" />
<?php }?>
</a>
</td>
<td valign='top' width='10'></td>
<td valign='left' width='auto'>
<div class='profile-link'><a href="/user/info/<?=$user['uid']?>" class="startbbs profile_link" title="admin"><?=$user['username']?></a></div>
<div class='signature'></div>
</td>
</tr>
</table>
<div class='sep10'></div>
<table width='100%'>
<tr>
<td align='center' class='with_separator' width='34%'>
<a href="" class="dark" style="display: block;"><span class='bigger'>0</span>
<div class='sep3'></div>
<span class='gray'>话题收藏</span>
</a></td>
<td align='center' width='33%'>
<a href="" class="dark" style="display: block;"><span class='bigger'>0</span>
<div class='sep3'></div>
<span class='gray'>特别关注</span>
</a></td>
</tr>

</table>
</div>
<div class='cell'>
<div class='muted alert alert-warn' style='margin-bottom: 0;'>
头像不够个性？
<a class='startbbs' href='/user/upavatar'>立刻上传 →</a>
</div>
</div>
<div class='inner muted'>
暂无提醒
</div>
</div>
<?} else {?>
<div class='box'>
<div class='cell'>
<?=$settings['site_name']?> — <?=$settings['short_intro']?>
</div>
<div class='inner'>
<div class='sep5'></div>
<div class='center'>
<a href="/user/reg" class="btn btn-small">现在注册</a>
<div class='sep5'></div>
<div class='sep10'></div>
已注册用户请
<a href="/user/login" class="startbbs">登入</a>
</div>
</div>
</div>
<?}?>