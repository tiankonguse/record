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

			<section>
				<h3>留言</h3><a href="http://tiankonguse.com/lab/AKeyToSend/" style="color: red;">给我发短信</a>
				
				<div id="disqus_thread"></div>
				<script type="text/javascript">
	            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
	               var disqus_shortname = 'tiankonguse-record'; // required: replace example with your forum shortname
	   
	             /* * * DON'T EDIT BELOW THIS LINE * * */
	             (function() {
	               var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
	                 dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
	                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	              })();
	             </script>
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
