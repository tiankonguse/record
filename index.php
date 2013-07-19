<?php
session_start();
require_once("inc/init.php");
$user = $_SESSION['share_admin'];

?>

<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php require_once("inc/header.inc.php"); ?>
<title>tiankonguse'share</title>

</head>
<body>

<div class="container">
	<div class="page-header" style="text-align:center;">
		<h1>tiankonguse'share</h1>
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
					<section class="post">
					<ul class="listing">
<?php 			
	
	$sql = "select * from `share_record` ORDER BY  `time` DESC";
	$result = @mysql_query($sql ,$conn);
	$pre_year = date('Y') +1;
	$pre_mon = -1;
	
	while($row=@mysql_fetch_array($result)){
		$id = $row['id'];
		$time = $row['time'];
		$title = $row['title'];
		$time = date("Y-m-d",$time);
		//2013-06-16 22:10:00
		sscanf($time,"%d-%d-%d", $year, $month, $day);
		if($pre_year != $year || $pre_mon != $month){
			$pre_year = $year;
			$pre_mon  = $month;
			echo "<li class='listing-seperator'>$pre_year - $pre_mon</li>";
		}
		
		$alter = "";
		if(strcmp($user,"share_admin") == 0){
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