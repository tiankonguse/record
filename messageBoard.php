<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
session_start ();
require ("./inc/common.php");
require ("./inc/function.php");

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
			<?php require './inc/head.php';?>
			<?php require './inc/nav.php';?>

			<section>
				<h3>留言</h3>
				<a href="http://tiankonguse.com/lab/AKeyToSend/" style="color: red;">给我发短信</a>

				<div id="disqus_thread"></div>
				<script type="text/javascript">
	            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
	               var disqus_shortname = 'tiankonguse-record'; // required: replace example with your forum shortname
	   
	             /* * * DON'T EDIT BELOW THIS LINE * * */
	             (function() {
	               var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
	                 dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
	                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	              })();
	             </script>
			</section>
		</div>

		<footer>
			<?php  require BASE_INC . 'footer.inc.php'; ?>
		</footer>
	</div>

	<script>
	TK.loader.loadJS({url:"<?php echo PATH_JS;?>main.js"});
	TK.loader.loadJS({url:"<?php echo MAIN_PATH;?>js/main.js"});
	</script>
</body>
</html>
