<?php
session_start();
require("inc/init.php");
require("inc/php_version.php");
require("inc/function.php");
if(isset($_SESSION['record_admin'])){
	$admin = $_SESSION['record_admin'];
}else{
	$admin = "";
}

$pageSize = 30;
$nowPage = 1;

$allPageNum = intval((getRecordNum() + $pageSize - 1) / $pageSize);

if(isset($_GET['nowPage'])){
	$nowPage = intval($_GET['nowPage']);
}

$nowPage = $nowPage % $allPageNum;

if($nowPage == 0){
	$nowPage = $allPageNum;	
}



?>

<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
$title = "tiankonguse' record";
require('inc/header.inc.php');
?>
</head>

<body>

	<header>
	<?php
	$title = "";
	require('inc/top.inc.php');
	?>
	</header>

	<section>
	<?php
	require('inc/nav.inc.php');
	?>
	</section>
	<section>
		<div class="container">
			<ul class="listing">
			<?php

			$sql = "select * from `record_record` ORDER BY  `time` DESC LIMIT ".($nowPage-1)*$pageSize." , $pageSize";
			$result = mysql_query($sql ,$conn);

			$pre_year = "";
			$pre_mon = "";

			while($row=@mysql_fetch_array($result)){
				$id = $row['id'];
				$time = $row['time'];
				$title = getDateFromMysql($row['title']);
				$time = date("Y-m-d",$time);
				//2013-06-16 22:10:00
				sscanf($time,"%d-%d-%d", $year, $month, $day);
				if($pre_year != $year || $pre_mon != $month){
					$pre_year = $year;
					$pre_mon  = $month;
					echo "<li class='listing-seperator'>$pre_year - $pre_mon</li>";
				}

				$alter = "";
				if(strcmp($admin,"record_admin") == 0){
					$alter = "<div class=''><a href='alter.php?id=$id'>alter</a></div>";
				}
				echo "
					<li class='listing-item'>
						<div style='float: right;clear: both;'>$alter</div>
						<time datetime='$time'>$time</time>
						<a href='record.php?id=$id' title='$title'>$title</a>
					</li>";
			}
			?>
			</ul>
		</div>
	</section>
	<section>
	<?php
	require('inc/page.inc.php');
	?>
	</section>

	<footer>
	<?php  require('inc/footer.inc.php'); ?>
	</footer>

	<?php
	if(isset($_GET['message'])){
		echo "<script>$(function(){var _state = {title:'',url:window.location.href.split('?')[0]};history.pushState(_state,'','?');showMessage('" . htmlspecialchars($_GET['message']) . "');});</script>";
	}
	echo "<script>$(function(){var _state = {title:'',url:window.location.href.split('?')[0]};history.pushState(_state,'','?nowPage=$nowPage');</script>";
	
	?>
</body>
</html>
	<?php require("inc/end.php"); ?>
