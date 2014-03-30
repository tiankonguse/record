<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
session_start();
require("./inc/common.php");
require("./inc/function.php");

checkLogin();
initPage(16);

$nowPage = $_GET['nowPage'];
$allPageNum = $_GET['allPageNum'];
$pageSize = $_GET['pageSize'];
$baseurl = "index_grid.php?";

$tag = "";
$title = "tiankonguse' record";
require BASE_INC . 'head.inc.php';
?>
<script type="text/javascript">
TK.loader.loadCSS({url:"<?php echo MAIN_PATH;?>css/main.css"});
</script>
</head>
<body>
	<div class="outer-wrapper outer-color">
		<div class="inner-wrapper">
			<?php require './inc/head.php';?>
			<?php require './inc/nav.php';?>

			<section class="billboard clearfix">
            <?php require "./inc/tag.php";?>
				<div class="container">
					<ul class="unitList clearfix">
						<?php
						$sql = "select * from `record_record`  ORDER BY  `time` DESC LIMIT ".($nowPage-1)*$pageSize." , $pageSize";
						$result = mysql_query($sql ,$conn);

						while($row=@mysql_fetch_array($result)){
							$id = $row['id'];
							$time = $row['time'];
							$title = $row['title'];
							$title = preg_replace('/&nbsp;/i','',$title);

							$title = getDateFromMysql($title);
							$title = preg_replace('/&nbsp;/i','',$title);

							$title = htmlspecialchars($title);
							$title = preg_replace('/&nbsp;/i','',$title);

							$title = mb_substr($title,0,14,'utf8');

							$time = date("Y-m-d",$time);
							$alter = "";
							$delete = "";
							if(strcmp($admin,"record_admin") == 0){
								$alter .= "<a href='".MAIN_DOMAIN."alter.php?id=$id'>修改</a>";
								$delete .= "<a href='".MAIN_DOMAIN."alter.php?id=$id'>删除</a>";
							}
							$content = getDateFromMysql($row['content']);
							$content = preg_replace('/<[^>]*>/i','',$content);
							$content = preg_replace('/&nbsp;/i','',$content);
							$content=mb_substr($content,0,120,'utf8');

							$tags = getTags($id);
							echo "
							<li class=\"unit article handcursor\" rid=\"$id\" url=\"".MAIN_DOMAIN."record.php?id=$id\">
							<div class=\"mask\">
							<h4 class=\"article-h4\"><a href=\"".MAIN_DOMAIN."record.php?id=$id\">$title</a></h4>
							<div class=\"date\">$time</div>
							<div class=\"tags _tags\">
							";
							foreach($tags as $key=>$val){
								echo "<span><a title=\"$val\" href=\"".MAIN_DOMAIN."search.php?tag=$val\">$val</a></span>";
							}
							echo "
										</div>
										<div class=\"edit-tag-btn\" title=\"编辑\">
										<a href='".MAIN_DOMAIN."alter.php?id=$id'\" class=\"_editBtn\"><span>编辑</span></a>
										</div>
										<div class=\"del-btn\" title=\"删除\">
										<a href='".MAIN_DOMAIN."alter.php?id=$id'\" class=\"_delBtn\"><span>删除</span></a>
										</div>
										</div>
										<div class=\"unit-box\">
										<div class=\"unit-c\">
										<h4>
										<a href=\"".MAIN_DOMAIN."record.php?id=$id\">$title</a>
										</h4>
										<div class=\"desc\">$content</div>
										</div>
										</div>
										</li>";
						}
						?>
					</ul>
				</div>
                <?php require("./inc/aside.php");?>
			</section>
			<section class="billboard">
				<?php require('./inc/page.inc.php'); ?>
			</section>
		<footer>
			<?php  require BASE_INC . 'footer.inc.php'; ?>
		</footer>
		</div>
	</div>
	<?php
	if(isset($_GET['message'])){
    	echo "<script>$(function(){alterUrlAndShowMessage(\"$title\", \"".htmlspecialchars ( $_GET ['message'] )."\");});</script>";
    }
    ?>
	<script>
	TK.loader.loadJS({url:"<?php echo PATH_JS;?>main.js"});
	TK.loader.loadJS({url:"<?php echo MAIN_PATH;?>js/main.js"});
	</script>
	<?php require BASE_INC . "end.php";?>
</body>
</html>
