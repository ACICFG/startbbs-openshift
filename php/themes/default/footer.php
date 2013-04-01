<div id='footer'>
<div class='container' id='footer-main'>
<ul class='page-links'>
<?php if($page_links){?>
<?php foreach($page_links as $key=>$v){?>
<?php if($v['go_url']){?>
<li><a href="<?php echo $v['go_url'];?>" class="dark nav" target=_blank><?php echo $v['title'];?></a></li>
<?} else{?>
<li><a href="<?php echo site_url('page/index/'.$v['pid']);?>" class="dark nav"><?php echo $v['title'];?></a></li>
<?}?>
<?php if($key!=10){?>
<li class='snow'>·</li>
<?}?>
<?}?>
<?}?>
</ul>
<div class='copywrite'>
<div class="fr"> <!--<a href="" target="_blank"><img src="" border="0" alt="Linode" width="120"></a>--></div>
<p>&copy; 2013 StartBBS Inc, Some rights reserved.</p>
</div>
<small class='muted'>
Powered by
<a href="http://www.startbbs.com" class="muted" target="_blank"><?=$settings['site_name']?></a>
<?=$this->config->item('version');?>  <?=$settings['site_stats']?>-
<p>页面执行时间:  {elapsed_time}s</p>
</small>
</div>
</div>
</body></html>