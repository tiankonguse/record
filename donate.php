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
<link href="<?php echo MAIN_DOMAIN;?>css/main.css" rel="stylesheet">

</head>
<body>
<?php //require BASE_INC . 'rain.php';?>
    <div class="outer-wrapper">
		<div class="inner-wrapper">
			<header>
				<div class="title">
					<a href="<?php echo MAIN_DOMAIN;?>"><?php echo $title; ?> </a>
					<span style="font-size: 25px; color: rgb(93, 75, 97);">牛奶会有的，面包会有的!</span>
				</div>
                <?php require './inc/nav.php';?>
            </header>

			<section class="billboard">
				<div class="container about-me">
					<h1 class="entry-title">捐赠本站</h1>
					<div class="entry-content">
						<p>
						如果您觉得本站对您非常有用，您可以考虑通过捐赠来支持我们。	
						</p>
						<p>
						您的捐赠将帮助我们应付日益增长的主机和带宽费用，使我们在未来能够提供更加丰富的内容。
						</p>
						<p>
						我们非常感谢您的捐赠与支持。捐赠后可以QQ告知。
						</p>
						<p>
						QQ:804345178 
						</p>
						<p align="center">
							<a href="https://me.alipay.com/tiankonguse">
			                	<img alt="" src="<?php echo DOMAIN_IMG?>donate.jpg">
							</a>
						</p>
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
    <script src="<?php echo DOMAIN_JS;?>main.js" async ></script>
	<script src="<?php echo MAIN_DOMAIN;?>js/main.js" async ></script>
</body>
</html>
