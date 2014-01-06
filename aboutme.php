<?php
session_start ();
require ("./inc/common.php");
require ("./inc/function.php");
?>

<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
$title = "tiankonguse' record";
require BASE_INC . 'head.inc.php';
?>
<script type="text/javascript">
TK.loader.loadCSS({url:"<?php echo MAIN_PATH;?>css/main.css"});
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
				<div class="container about-me">
					<h1 class="entry-title">关于本站</h1>
					<div class="entry-content">
						<h3>简介</h3>
						<p>本站是tiankonguse 的个人网站。</p>
					</div>
				</div>
			</section>
			<script src="<?php echo DOMAIN_JS;?>jquery.js"></script>
		</div>

		<footer>
			<?php  require BASE_INC . 'footer.inc.php'; ?>
		</footer>
	</div>
	<?php
	if (isset ( $_GET ['message'] )) {
					echo "
					<script>
					$(function(){
					var _state = {
					title:'',
					url:window.location.href.split('?')[0]
                    };
                    history.pushState(_state,'','?nowPage=$nowPage');
                    showMessage('" . htmlspecialchars ( $_GET ['message'] ) . "');
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
