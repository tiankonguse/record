<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
session_start ();
require ("./inc/common.php");
require ("./inc/function.php");
$title = "为 tiankonguse 捐赠 一些东西";
require BASE_INC . 'head.inc.php';
?>
<script type="text/javascript">
TK.loader.loadCSS({url:"<?php echo MAIN_PATH;?>css/main.css"});
</script>
</head>
<body>
	<div class="outer-wrapper">
		<div class="inner-wrapper">
			<?php require './inc/head.php';?>
			<?php require './inc/nav.php';?>

			<section class="billboardi clearfix">
				<div class="container about-me">
					<h1 class="entry-title">捐赠本站</h1>
					<div class="entry-content">
						<p>如果您觉得本站对您非常有用，您可以考虑通过捐赠来支持我们。</p>
						<p>您的捐赠将帮助我们应付日益增长的主机和带宽费用，使我们在未来能够提供更加丰富的内容。</p>
						<p>我们非常感谢您的捐赠与支持。捐赠后可以QQ告知。</p>
						<p>QQ:804345178</p>
						<p align="center">
							<a href="https://me.alipay.com/tiankonguse"> <img alt=""
								src="<?php echo DOMAIN_IMG?>donate.jpg">
							</a>
						</p>
					</div>
				</div>
			</section>
		    <footer>
			    <?php  require BASE_INC . 'footer.inc.php'; ?>
    		</footer>
		</div>
	</div>
	<script>
	TK.loader.loadJS({url:"<?php echo PATH_JS;?>main.js"});
	TK.loader.loadJS({url:"<?php echo MAIN_PATH;?>js/main.js"});
	</script>
</body>
</html>
