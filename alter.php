<?php 
session_start();
require_once("inc/init.php");
$user = $_SESSION['share_admin'];
if(strcmp($user,"share_admin") != 0 || !isset($_GET["id"])){
	header('Location:index.php');
}

$id = mysql_real_escape_string($_GET["id"]);
$sql = "select * from `share_record` where `id` = '$id'";
$result = @mysql_query($sql ,$conn);
if($result && $row=@mysql_fetch_array($result)){
	$title = $row['title'];
	$time = date("m/d/Y h:i",$row['time']);
	$content = $row['content'];
}else{
	header('Location:index.php');
}


?>

<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
	<?php require_once("inc/header.inc.php"); ?>
	<title>write share</title>
	
	<link rel="stylesheet" type="text/css" href="datepicker/css/jquery-ui.css" />
	<script type="text/javascript" src="datepicker/js/jquery-ui-slide.min.js"></script>
	<script type="text/javascript" src="datepicker/js/jquery-ui-timepicker-addon.js"></script>
	
	<link rel="stylesheet" href="kindeditor/themes/default/default.css" />
	<script charset="utf-8" src="kindeditor/kindeditor-min.js"></script>
	<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
	<script charset="utf-8" src="js/write.js"></script>
</head>
<body>

<div class="container">
	<div class="page-header" style="text-align:center;">
		<h1>write share</h1>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
				<nav> 
					<?php require_once("inc/nav.php"); ?>
				</nav>
			</div>
			<div class="span8 offset1">
				<form method="post" action="inc/alter.php?id=<?php echo $id;?>">
						<ul class="unstyled">
				            <li>
				                <p>
				                	  标&nbsp;&nbsp;题：
				                    <input id="title" name="title" type="text" value="<?php echo $title;?>" placeholder="标 题">
								</p>
							</li>				            
							<li>
								<p>
				                   	 时&nbsp;&nbsp;间：
									<input id="time" name="time" type="text" value="<?php echo $time;?>">
								</p>
				            </li>

							<li>
								<p>
									<div class="content-left">
										记录：
									</div>
									<div class="content-center">
										<textarea name="content" id="content" class="content" value=""><?php echo $content;?></textarea>
									</div>
								</p>
				            </li>
							<li>
								<p>
									<button class="btn btn-large" id="submit" >提交</button>
								</p>
				            </li>
						</ul>
						
				</form>
			</div>
		</div>
	</div>
</div>

<?php require_once("inc/footer.inc.php"); ?>
	</body>
</html>
