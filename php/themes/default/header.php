<div class="navbar navbar-inverse navbar-static-top">
<div class="navbar-inner">
<div class="container">
<a class="btn btn-navbar collapsed" data-target=".nav-collapse" data-toggle="collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><a href="/" class="brand">Start<span class="green">BBS</span></a>
<div class="nav-collapse collapse">
<ul class="nav pull-left">
<li class=""><a href="/">首页</a></li>
<li class=""><a href="/forum/add">发表话题</a></li>
</ul>
<!--<form class="navbar-search pull-left" action="/home/search" method="get">
<input class="search-query" data-domain="" id="q" maxlength="40" name="q" placeholder="输入关键字并回车" type="text" />
</form>-->
<form class="navbar-search pull-left" action="http://www.google.com/search" method="get" target="_blank">
<input class="search-query" data-domain="" id="q" maxlength="40" name="q" placeholder="输入关键字并回车" type="text" />
<input type=hidden name=ie value=UTF-8>
<input type=hidden name=oe value=UTF-8>
<input type=hidden name=hl value=zh-CN>
<input type=hidden name=domains value="<?php echo $this->myclass->get_domain(site_url())?>">
<input type=hidden name=sitesearch value="<?php echo $this->myclass->get_domain(site_url())?>">
</form>
<ul class="nav pull-right">
<?php if($this->session->userdata('uid')){ ?>
<li class=""><a href="/user/info/<?php echo $this->session->userdata('uid');?>"><?php echo $this->session->userdata('username');?></a></li>
<li class=""><a href="/user/settings">个人设置</a></li>
<?php if($this->auth->is_admin()){ ?>
<li class=""><a href="/admin/login">管理后台</a></li>
<?php }?>
<li><a href="/user/logout" data-method="delete" rel="nofollow">退出</a></li>
<?php }else{?>
<li class=""><a href="/user/reg">注册</a></li>
<li class=""><a href="/user/login">登入</a></li>
<?php }?>
</ul>
</div></div></div></div>

