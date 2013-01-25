<!DOCTYPE html><html><head><meta content='' name='description'>
<meta charset='UTF-8'>
<meta content='True' name='HandheldFriendly'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title>运行状态 - 管理后台 - Rabel</title>
<?php $this->load->view ( 'header-meta' ); ?>
		<script type="text/javascript">
			$(document).ready(function() {
				var url = location.href;
				var url = window.location.protocol+"//"+window.location.host;
				$("#dataTest").click(function(){
					var isok = checkDbContent();
					if(isok){
						var dbhost = $("#txtHost").val();
						var dbport = $("#txtPort").val();
						var dbname = $("#txtName").val();
						var dbuser = $("#txtUser").val();
						var dbpwd = $("#txtPassword").val();
						var dbprefix = $("#txtPrefix").val();
						$.ajax({
							url:"/install/check",
							data:{
								dbhost:dbhost,
								dbport:dbport,
								dbname:dbname,
								dbuser:dbuser,
								dbpwd:dbpwd,
								dbprefix:dbprefix
							},
							dataType:"json",
							success:function(res){
								if(res["code"]==1){
									$("#testInfo").html(res["msg"]).removeClass("red").addClass("green");
								}else{
									$("#testInfo").html(res["msg"]).removeClass("green").addClass("red");
								}
							}
						})
					}
				})
				
				$("#btnSubmit").click(function(){
					if(checkDbContent() && checkInfo()){
						$("#dbform").submit();
					}
				})
			})
			
			function checkDbContent(){
				var isok = true;
				var dbhost = $("#txtHost").val();
				if(dbhost==""){
					$("#infoHost").html("请填写数据库主机").addClass("red");
					isok = false;
				}else{
					$("#infoHost").html("").removeClass("red");
				}
				var dbport = $("#txtPort").val();
				if(dbport==""){
					$("#infoPort").html("请输入数据库端口号").addClass("red");
					isok = false;
				}else{
					$("#infoPort").html("").removeClass("red");
				}
				var dbname = $("#txtName").val();
				if(dbname==""){
					$("#infoName").html("请输入数据库名").addClass("red");
					isok = false;
				}else{
					$("#infoName").html("").removeClass("red");
				}
				var dbuser = $("#txtUser").val();
				if(dbuser==""){
					$("#infoUser").html("请输入数据库用户名").addClass("red");
					isok = false;
				}else{
					$("#infoUser").html("").removeClass("red");
				}
				var dbpwd = $("#txtPassword").val();
				if(dbpwd==""){
					$("#infoPassword").html("请输入数据库密码").addClass("red");
					isok = false;
				}else{
					$("#infoPassword").html("").removeClass("red");
				}
				var dbprefix = $("#txtPrefix").val();
				if(dbprefix==""){
					$("#infoPrefix").html("请输入数据库前缀").addClass("red");
					isok = false;
				}else{
					$("#infoPrefix").html("").removeClass("red");
				}
				return isok;
			}

			function checkInfo(){
				var isok = true;
				var admin = $("#txtAdmin").val();
				if(admin==""){
					$("#infoAdmin").html("请输入管理员登陆名").addClass("red");
					isok = false;
				}else{
					$("#infoAdmin").html("").removeClass("red");
				}
				var pwd = $("#txtPwd").val();
				if(pwd==""){
					$("#infoPwd").html("请输入管理员密码").addClass("red");
					isok = false;
				}else{
					$("#infoPwd").html("").removeClass("red");
				}
				var email = $("#txtEmail").val();
				if(email==""){
					$("#infoEmail").html("请输入邮箱地址").addClass("red");
					isok = false;
				}else{
					$("#infoEmail").html("").removeClass("red");
				}
				return isok;
			}
		</script>
</head>
<body id="rabel">
<div class="navbar navbar-inverse navbar-static-top">
<div class="navbar-inner">
<div class="container">
<a class="btn btn-navbar collapsed" data-target=".nav-collapse" data-toggle="collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><a href="/" class="brand">StartBBS</a>
<div class="nav-collapse collapse">
<form class="navbar-search pull-left">
<input class="search-query" data-domain="rabelapp.com" id="q" maxlength="40" name="q" placeholder="搜索话题" type="text" />
</form>
<ul class="nav pull-right">
<li class=""><a href="http://www.startbbs.com">Startbbs官方</a></li>

</ul>
</div></div></div></div>


<div id="wrap">
<div class="container" id="page-main">
<div class="row">
<div class='span2'>
<div class='box fix_cell'>
<div class='cell'>
<strong class='gray'>安装步骤</strong>
</div>
<div class='cell'>
权限检测
</div>
<div class='cell'>
数据库配置
</div>
<div class='cell'>
管理员配置
</div>
<div class='cell'>
安装完成
</div>
</div>

</div>

<div class='span8'>

<div class='row'>
<div class='box span8'>
<div class='cell'>
欢迎使用起点startbbs轻量社区系统
</div>
<div class='inner'>
<span class="green">www.startbbs.com</span>

</div>
</div>
</div>
<form action="/install/step" class="form-horizontal" method="post" id="dbform">
<div class='row'>
<div class='box span8'>
<div class='cell'>
数据库配置
</div>
<div class='inner'>
<div class='control-group'>
<label class="control-label" for="settings_site_name">数据库主机</label>
<div class='controls'>
<input id="txtHost" name="dbhost" type="text" value="localhost" />
<small class='help-inline' id="infoHost">一般为localhost</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_site_name">数据库端口</label>
<div class='controls'>
<input id="txtPort" name="dbport" type="text" value="3306" />
<small class='help-inline' id="infoPort">一般为3306</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_site_name">数据库用户</label>
<div class='controls'>
<input id="txtUser" name="dbuser" type="text" value="" />
<small class='help-inline' id="infoUser">必填</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_site_name">数据库密码</label>
<div class='controls'>
<input id="txtPassword" name="dbpwd" type="text" value="" />
<small class='help-inline' id="infoPassword">必填</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_site_name">数据库名称</label>
<div class='controls'>
<input id="txtName" name="dbname" type="text" value="startbbs" />
<small class='help-inline' id="infoName">必填</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_site_name">数据表前缀</label>
<div class='controls'>
<input id="txtPrefix" name="dbprefix" type="text" value="sb_" />
<small class='help-inline' id="infoPrefix">不建议修改</small>
</div>
</div>
<span id="testInfo"></span>
<div class='form-actions'>
<a href="javascript:void(0)" id="dataTest" class="left btn btn-white btn-primary"><span>测试连接</span></a>
<!--<input id="btnSubmit" class="btn btn-white btn-primary" name="commit" type="submit" value="下一步" />-->
</div>


</div>
</div>
</div>

<div class='row'>
<div class='box span8'>
<div class='cell'>
管理员信息配置
</div>
<div class='inner'>
<div class='control-group'>
<label class="control-label" for="settings_site_name">用户名</label>
<div class='controls'>
<input id="txtAdmin" name="admin" type="text" value="admin" />
<small class='help-inline' id="infoAdmin">只能用'0-9'、'a-z'、'A-Z'</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_site_name">密码</label>
<div class='controls'>
<input id="txtPwd" name="pwd" type="text" value="startbbs" />
<small class='help-inline' id="infoPwd">必填</small>
</div>
</div>
<div class='control-group'>
<label class="control-label" for="settings_site_name">管理员邮箱</label>
<div class='controls'>
<input id="txtEmail" name="email" type="text" value="startbbs@126.com" />
<small class='help-inline' id="infoEmail">必填</small>
</div>
</div>
<div class='form-actions'>
<!--<input id="btnSubmit" class="btn btn-white btn-primary" name="commit" type="submit" value="下一步" />-->
<a id="btnSubmit" href="javascript:void()" class="left btn btn-white btn-primary"><span>点此安装</span></a>
<span class="green">(务必记住管理员信息)</span>
</div>

</div>
</div>
</div>
</form>
</div>
</div></div></div>
<div id='footer'>
<div class='container' id='footer-main'>
<ul class='page-links'>
<!--<li><a href="/page/about" class="dark nav">StartBBS 简介</a></li>
<li class='snow'>·</li>
<li><a href="/page/support" class="dark nav">技术支持</a></li>-->
</ul>
<div class='copywrite'>
<div class="fr"> <!--<a href="" target="_blank"><img src="" border="0" alt="Linode" width="120"></a>--></div>
<p>&copy; 2013 Startbbs Inc, Some rights reserved.</p>
</div>
<small class='muted'>
Powered by
<a href="http://www.startbbs.com" class="muted" target="_blank">StartBBS</a>
1.0.0.alpha
</small>
</div>
</div>
</body></html>