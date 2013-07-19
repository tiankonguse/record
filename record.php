<?php
session_start();
require_once("inc/init.php");
require_once("inc/php_version.php");
$user = $_SESSION['share_admin'];
if(!isset($_GET["id"])){
	header('Location:index.php');
}

$id = mysql_real_escape_string($_GET["id"]);
$sql = "select * from `share_record` where `id` = '$id'";
$result = @mysql_query($sql ,$conn);
if($result && $row=@mysql_fetch_array($result)){
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
<?php require_once("inc/header.inc.php"); ?>
<title><?php echo $title;?></title>

</head>
<body>

<div class="container">
	<div class="page-header" style="text-align:center;">
		<h1><?php echo $title;?></h1>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
				<nav> 
					<?php require_once("inc/nav.php"); ?>
				</nav>
			</div>
			<div class="span10">
				<article class="content"> 
					<section class="meta">
						<span class="time">
						  posted at <time datetime="<?php echo $time;?>"><?php echo $time;?></time>
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
					<span class="time">
					  posted at <time datetime="<?php echo $time;?>"><?php echo $time;?></time>
					</span>
				</section>
				</article>
			</div>
		</div>
	</div>
</div>
<?php require_once("inc/footer.inc.php"); ?>
</body>
</html>
<?php require_once("inc/end.php"); ?>