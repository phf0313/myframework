<!DOCTYPE html>
<head>

<meta charset="utf-8">
<title><?php echo $title;?></title>
<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
<link id="bs-css" href="<?php echo $_css?>bootstrap-cerulean.css" rel="stylesheet">
<link href="<?php echo $_css?>charisma-app.css" rel="stylesheet">
<style type="text/css">
body {
	padding-bottom: 40px;
}

.sidebar-nav {
	padding: 9px 0;
}
</style>

<script src="<?php echo $js?>jquery-min.js"></script>
<!-- The fav icon -->
<link rel="shortcut icon" href="<?php echo $_images;?>favicon.ico">

</head>

<body>
	<div class="container-fluid">
		<div class="row-fluid">

			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>后台管理登录</h2>
				</div>
				<!--/span-->
			</div>
			<!--/row-->

			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">请输入您的用户名与密码。</div>
					<form class="form-horizontal" method="post">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i> </span><input autofocus class="input-large span10" name="username" id="username" type="text" value="" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i> </span><input class="input-large span10" name="password" id="password" type="password" value="" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend">
								<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
								<button type="submit" class="btn btn-primary">Login</button>
							</p>
						</fieldset>
					</form>
				</div>
			</div>
		</div>

	</div>


</body>
</html>
