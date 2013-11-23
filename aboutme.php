<?php
session_start ();
require ("./inc/common.php");
require ("./inc/function.php");

checkLogin ();
initPage ( 15 );

$nowPage = $_GET ['nowPage'];
$allPageNum = $_GET ['allPageNum'];
$pageSize = $_GET ['pageSize'];
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
					<a href="<?php echo MAIN_DOMAIN;?>"><?php echo $title; ?>
                    </a>
				</div>
                <?php require './inc/nav.php';?>
            </header>

			<section class="billboard">
				<div class="container about-me">
					<h1 class="entry-title">关于本站</h1>
					<div class="entry-content">
						<h3>简介</h3>
						<p>本站以个人acm总结，acm算法，个人生活记录为主，以转载IT技术文章为辅，没有确定的对象，偏重于软件方面，通过那些独特的海外IT视野，关注IT世界，关切IT民生，锐评IT世事，涵盖Java、ACM，C/C++，
							PHP、敏捷和架构等。</p>
						<h3>给我来信</h3>
						<p>欢迎批评指导，您可以留言，或者发邮件给我。邮件地址：i@tiankonguse.com</p>
						<h3>关于转载</h3>
						<p>
							欢迎转载本站的所有内容，本站的所有文章使用<a rel="license" target="_blank"
								href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.zh"><strong>创作共用许可协议</strong>(Creative
								Commons Attribution Share-Alike License v3.0 or any later
								version)</a>，唯一的要求就是<strong>保留署名权</strong>，<strong>请在转载时注明出处</strong>。
						</p>
						<h3>转载来源</h3>
						<p>
							很多读者都来信问我了一个问题，想知道本站的这些有趣的文章原文是从哪里找到的。<br />在转载的时候，如果我知道转载出处，会在转载的文章底部或顶部声明出处，若不知道出处，我会声明出自互联网。
						</p>
						<h3>分享</h3>
						<p>最后补充一点，如果你喜欢本站的文章，请推荐给你的好友，谢谢！</p>
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
    <script src="<?php echo DOMAIN_JS;?>main.js"></script>

</body>
</html>
