<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
session_start();
require("./inc/common.php");
require("./inc/function.php");

checkLogin();
initPage(15);

$nowPage = $_GET['nowPage'];
$allPageNum = $_GET['allPageNum'];
$pageSize = $_GET['pageSize'];
$baseurl = MAIN_DOMAIN."index.php?";

$title = "tiankonguse' record";
require BASE_INC . 'head.inc.php';
?>
<script type="text/javascript">
TK.loader.loadCSS({url:"<?php echo MAIN_PATH;?>css/main.css",v:"1.01" });
</script>
</head>
<body>
	<div class="outer-wrapper">
		<div class="inner-wrapper">
			<header>
				<div class="title">
					<a href="<?php echo MAIN_DOMAIN;?>"><?php echo $title; ?> </a> <span
						style="font-size: 25px; color: rgb(93, 75, 97);">牛奶会有的，面包会有的!</span>
				</div>
				<?php require './inc/nav.php';?>
			</header>



			<section class="billboard">
				<div class="container">
					<ul class="listing">
						<?php
						$sql = "select * from `record_record`  ORDER BY  `time` DESC LIMIT ".($nowPage-1)*$pageSize." , $pageSize";
						$result = mysql_query($sql ,$conn);

						$pre_year = "";
						$pre_mon = "";

						while($row=@mysql_fetch_array($result)){
							$id = $row['id'];
							$time = $row['time'];
							$title = getDateFromMysql($row['title']);
							$time = date("Y-m-d",$time);
							sscanf($time,"%d-%d-%d", $year, $month, $day);
							if($pre_year != $year || $pre_mon != $month){
								$pre_year = $year;
								$pre_mon  = $month;
								echo "<li class='listing-seperator'>$pre_year - $pre_mon</li>";
							}

							$alter = "";
							$len = 36;
							if(strcmp($admin,"record_admin") == 0){
                    		$alter .= "<a href='".MAIN_DOMAIN."alter.php?id=$id'>修改</a>";
                    		$alter .= "<a href='".MAIN_DOMAIN."alter.php?id=$id'>删除</a>";
                    		$len = 33;
                    	}
                    	$showTitle = htmlspecialchars($title);
                    	echo "
                    	<li class=\"listing-item\">
                    	<div class=\"left\"><time datetime='$time'>$time</time></div>
                    	<div class=\"item-title\"><a href=\"".MAIN_DOMAIN."record.php?id=$id\" title=\"$title\">$showTitle</a></div>
                    	<div class=\"right\">$alter</div>
                    	</li>";
						}
						?>
					</ul>
				</div>
			</section>
			<section class="billboard">
				<?php require('./inc/page.inc.php'); ?>
			</section>
		</div>

		<footer>
			<?php  require BASE_INC . 'footer.inc.php'; ?>
		</footer>
	</div>
	<?php
	if(isset($_GET['message'])){
    	echo "
    	<script>
    	$(function(){
    	var _state = {
    	title:'',
    	url:window.location.href.split('?')[0]
                    };
                    history.pushState(_state,'','?nowPage=$nowPage');
                    showMessage('" . htmlspecialchars($_GET['message']) . "');
                });
		</script>";
    }
    ?>
	<script>
	TK.loader.loadJS({url:"<?php echo PATH_JS;?>main.js"});
	TK.loader.loadJS({url:"<?php echo MAIN_PATH;?>js/main.js"});
	</script>

</body>
</html>
<?php require BASE_INC . "end.php";?>
