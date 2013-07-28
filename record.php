<?php
session_start();
if(isset($_SESSION['record_admin'])){
	$admin = $_SESSION['record_admin'];
}else{
	$admin = "";
}

if(!isset($_GET["id"])){
	header('Location:index.php?message=非法操作');
	die();
}

require("inc/init.php");
require("inc/php_version.php");

$id = intval($_GET["id"]);
$sql = "select * from `record_record` where `id` = '$id'";
$result = mysql_query($sql ,$conn);
if($result && $row = mysql_fetch_array($result)){
	$title = getDateFromMysql($row['title']);
	$time = date("Y-m-d",$row['time']);
	$content = getDateFromMysql($row['content']);
}else{
	$title = "error,the post may be deleted.";
	$time = 0;
}

?>
<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
require('inc/header.inc.php');
?>
</head>
<body>

	<header>
	<?php
	require('inc/top.inc.php');
	?>
	</header>
	<section>
		<div class="container">
			<article class="content">
				<section class="meta">
					<span class="time"> posted at <time datetime="<?php echo $time;?>">
					<?php echo $time;?>
						</time>
					</span>
				</section>
				<section class="post">
				<?php
				if($time == 0){
					echo "你查看的文章可能已经不存在";
				}else{
					echo $content;
				}
				?>
				</section>
				<section class="meta">
					<span class="time"> posted at <time datetime="<?php echo $time;?>">
					<?php echo $time;?>
						</time>
					</span>
				</section>
			</article>
		</div>
	</section>


	<footer>
	<?php  require('inc/footer.inc.php'); ?>
	</footer>
</body>
</html>
	<?php require("inc/end.php"); ?>