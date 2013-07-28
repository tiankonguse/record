<?php
session_start();
if(isset($_SESSION['record_admin'])){
	$admin = $_SESSION['record_admin'];
}else{
	$admin = "";
}

if(strcmp($admin,"record_admin") != 0){
	header('Location:index.php?message=请先登录');
	die();
}
?>

<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php 
	$title = "write 新记录";
	require('inc/header.inc.php');
?>
<link rel="stylesheet" href="datepicker/css/jquery-ui.css" />
<script src="datepicker/js/jquery-ui-slide.min.js"></script>
<script src="datepicker/js/jquery-ui-timepicker-addon.js"></script>

<link rel="stylesheet" href="kindeditor/themes/default/default.css" />
<script src="kindeditor/kindeditor-min.js"></script>
<script src="kindeditor/lang/zh_CN.js"></script>
<script src="js/write.js"></script>
</head>
<body>

	<header>
	<?php
	require('inc/top.inc.php');
	?>
	</header>
	<section>
		<div class="container">
			<form method="post" action="inc/write.php">
				<div class="post-line">
					标&nbsp;&nbsp;题： <input id="title" type="text"
						placeholder="标 题">
				</div>
				<div class="post-line">
					时&nbsp;&nbsp;间： <input id="time" type="text" value="">
				</div>
				<div class="post-line">
					<div style="margin-bottom: 10px;">内容：</div>
					<textarea name="content" id="content" class="content"></textarea>
				</div>
				<div class="post-line">
					<button class="btn btn-large btn-info">提交</button>
				</div>
			</form>
		</div>
	</section>
	<footer>
	<?php  require('inc/footer.inc.php'); ?>
	</footer>
</body>
</html>
