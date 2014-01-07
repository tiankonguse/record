<?php
session_start();
require("./inc/common.php");
require("./inc/function.php");

checkLogin();
initPage(15);

$nowPage = $_GET['nowPage'];
$allPageNum = $_GET['allPageNum'];
$pageSize = $_GET['pageSize'];
$baseurl = ".?";

$allTags = getAllTags();
?>

<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
$title = "tiankonguse' tag";
require BASE_INC . 'head.inc.php';
?>
<script type="text/javascript">
TK.loader.loadCSS({url:"<?php echo MAIN_PATH;?>css/main.css"});
</script>
</head>
<body>
	<?php //require BASE_INC . 'rain.php';?>
	<div class="outer-wrapper">
		<div class="inner-wrapper">
			<header>
				<div class="title">
					<a href="<?php echo MAIN_DOMAIN;?>"><?php echo $title; ?> </a> <span
						style="font-size: 25px; color: rgb(93, 75, 97);">牛奶会有的，面包会有的!</span>
				</div>
				<?php require './inc/nav.php';?>
			</header>

			<section class="tag billboard">
				<div style="margin-top: 10px;">标签：</div>
				<div class="plus-tag tagbtn clearfix">
					<?php
					foreach($allTags as $key=>$val){
                	echo "<a title=\"$val\" href=\"".MAIN_DOMAIN."search.php?tag=$val\" style=\"".getColor().getFontSize()."\" ><span>$val</span></a>";
                }
                ?>
				</div>
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
<?php 

function getColor(){
	$str = "0123456789ABCDEF";
	$output = " color : #";
	for($i=0;$i<6;$i++){
		$output .= $str[mt_rand(0, strlen($str)-1)];
	}
	$output .= "; ";
	return $output;
}

function getFontSize(){
	$output = " font-size : ";
	$output .= mt_rand(8, 32);
	$output .= "px; ";
	return $output;
}

?>
<?php require BASE_INC . "end.php";?>
