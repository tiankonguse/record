<?php
session_start();
if(isset($_SESSION['record_admin'])){
	$admin = $_SESSION['record_admin'];
}else{
	$admin = "";
}

if(strcmp($admin,"record_admin") != 0 || !isset($_GET["id"])){
	header('Location:index.php?message=请先登录');
	die();
}

$id = intval($_GET["id"]);

if($id == 0){
	header('Location:index.php?message=非法操作');
	die();
}

require("inc/init.php");
require("inc/php_version.php");

$sql = "select * from `record_record` where `id` = '$id'";
$result = mysql_query($sql ,$conn);
if($result && $row = mysql_fetch_array($result)){
	$_title = getDateFromMysql($row['title']);
	$time = date("m/d/Y h:i",$row['time']);
	$content = getDateFromMysql($row['content']);
	$_SESSION['record_id'] = $id;
}else{
	header('Location:index.php?message=这篇文章不存在');
	die();
}
?>



<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
$title = "修改记录：".$_title;
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
			<form method="post" action="inc/alter.php">
				<div class="post-line">
					标&nbsp;&nbsp;题： <input id="title" type="text" placeholder="标 题"
						value="<?php echo $_title;?>">
				</div>
				<div class="post-line">
					时&nbsp;&nbsp;间： <input id="time" type="text"
						value="<?php echo $time;?>">
				</div>
				<div class="post-line">
					<div style="margin-bottom: 10px;">内容：</div>
					<textarea name="content" id="content" class="content">
					<?php echo $content;?>
					</textarea>
				</div>
				<div class="post-line">
					<button class="btn btn-large btn-info" id="submit">提交</button>
				</div>
			</form>
		</div>
	</section>
	<footer>
	<?php  require('inc/footer.inc.php'); ?>
	</footer>
</body>
</html>
	<?php require("inc/end.php"); ?>
