<!DOCTYPE html>
<head>

<meta charset="utf-8">
<title>提示</title>
<meta http-equiv="refresh" content="<?php echo $time?>;url=<?php echo $url?>">
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
				<div class="span12 center login-header"></div>
				<!--/span-->
			</div>
			<!--/row-->

			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">提示信息！</div>
					<div class="input-prepend" title="Username" data-rel="tooltip">
						<?php echo $msg;?>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

	</div>


</body>
</html>
