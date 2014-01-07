<?php
if (! isset ( $_GET ["id"] )) {
	header ( 'Location:index.php?message=非法操作' );
	die ();
}

session_start ();

require ("./inc/common.php");
require ("./inc/function.php");

checkLogin ();

$id = intval ( $_GET ["id"] );
$sql = "select * from `record_record` where `id` = '$id'";
$result = mysql_query ( $sql, $conn );
if ($result && $row = mysql_fetch_array ( $result )) {
	$title = htmlspecialchars ( getDateFromMysql ( $row ['title'] ) );
	$time = date ( "Y-m-d", $row ['time'] );
	$t = $row ['time'];

	$content = getDateFromMysql ( $row ['content'] );
	//var_dump($content, $row ['content']);
	$tags = getTags ( $id );
} else {
	header ( 'Location:index.php?message=error,the post may be deleted.' );
	die ();
}

$sql = "select * from `record_record`  where `time` > '$t' ORDER BY  `time` ASC  limit 0,1";
$result = mysql_query ( $sql, $conn );
if ($result && $row = mysql_fetch_array ( $result )) {
	$preTitle = htmlspecialchars ( getDateFromMysql ( $row ['title'] ) );
	$preLink = MAIN_DOMAIN . "record.php?id=" . $row ['id'];
	$preText = "<a href=\"$preLink\" target=\"_blank\">$preTitle</a>";
} else {
	$preTitle = "前面没有了";
	$preLink = MAIN_DOMAIN;
	$preText = "<a href=\"$preLink\" target=\"_blank\">$preTitle</a>";
}

$sql = "select * from `record_record` where `time` < '$t' ORDER BY  `time` DESC limit 0,1";
$result = mysql_query ( $sql, $conn );
if ($result && $row = mysql_fetch_array ( $result )) {
	$nextTitle = htmlspecialchars ( getDateFromMysql ( $row ['title'] ) );
	$nextLink = MAIN_DOMAIN . "record.php?id=" . $row ['id'];
	$nextText = "<a href=\"$nextLink\" target=\"_blank\">$nextTitle</a>";
} else {
	$nextTitle = "后面没有了";
	$nextLink = MAIN_DOMAIN;
	$nextText = "<a href=\"$nextLink\" target=\"_blank\">$nextTitle</a>";
}

?>

<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
require BASE_INC . 'head.inc.php';
?>
<meta name="keywords" content="<?php echo implode(",",$tags);?>">
<script type="text/javascript">
TK.loader.loadCSS({url:"<?php echo MAIN_PATH;?>css/main.css"});
</script>
</head>
<body>
	<div class="outer-wrapper">
		<div class="inner-wrapper">
			<header>
				<div class="title">
					<a href="<?php echo MAIN_DOMAIN;?>">tiankonguse' record</a> <span
						style="font-size: 25px; color: rgb(93, 75, 97);">牛奶会有的，面包会有的!</span>
				</div>
				<?php require './inc/nav.php';?>
			</header>

			<section class="billboard" itemscope
				itemtype="http://schema.org/Article">
				<div class="title sub-title" itemprop="name">
					<h1>
						<a href="<?php echo MAIN_DOMAIN;?>record.php?id=<?php echo $id;?>">
							<?php echo $title; ?>
						</a>
					</h1>
				</div>
				<div class="container">
					<article class="content">
						<section class="meta clearfix">
							<span class="time"> posted at <time
									datetime="<?php echo $time;?>" itemprop="datePublished"
									content="<?php echo $time;?>">
									<?php echo $time;?>
								</time>
							</span>

							<?php

							if (strcmp ( $admin, "record_admin" ) == 0) {
								echo "<span class=\"right\"><a href='" . MAIN_DOMAIN . "alter.php?id=$id'>修改</a>	</span>";
							}
							?>

						</section>

						<section class="post" itemprop="articleBody">
							<?php echo $content; ?>
						</section>
						<section class="tag">
							<div style="margin-top: 10px;">标签：</div>
							<div class="plus-tag tagbtn clearfix">
								<?php
								foreach ( $tags as $key => $val ) {
	echo "<a title=\"$val\" href=\"" . MAIN_DOMAIN . "search.php?tag=$val\" class=\"handcursor\"><span>$val</span></a>";
}
?>
							</div>
						</section>
						<section>
							<div class="mod-detail-pager clearfix">
								<div class="detail-nav-pre left">
									上一篇：
									<?php echo $preText;?>
								</div>
								<div class="detail-nav-next right">
									下一篇：
									<?php echo $nextText;?>
								</div>
							</div>
						</section>
						<section>
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


					</article>

				</div>
			</section>
		</div>
		<script>
	TK.loader.loadJS({url:"<?php echo PATH_JS;?>main.js"});
	TK.loader.loadJS({url:"<?php echo MAIN_PATH;?>js/main.js"});
	TK.loader.loadJS({url:"<?php echo PATH_JS;?>showImg.js"});
		</script>
		<div id="append_parent"></div>
		<script type="text/javascript">
        addZoom(".content .post img");
        (function(){
            function getTop(){
            	var scrollTop = 0;
        		if (document.documentElement && document.documentElement.scrollTop) {
        			scrollTop = document.documentElement.scrollTop;
        		} else if (document.body) {
        			scrollTop = document.body.scrollTop;
        		}
        		return scrollTop;
            }
            
        	function _reachBottom() {
        		var scrollTop = 0, clientHeight = 0, scrollHeight = 0;
        		scrollTop = getTop();

        		if (document.body.clientHeight && document.documentElement.clientHeight) {
        			clientHeight = (document.body.clientHeight < document.documentElement.clientHeight) ? document.body.clientHeight
        					: document.documentElement.clientHeight;
        		} else {
        			clientHeight = (document.body.clientHeight > document.documentElement.clientHeight) ? document.body.clientHeight
        					: document.documentElement.clientHeight;
        		}
        		scrollHeight = Math.max(document.body.scrollHeight,
        				document.documentElement.scrollHeight);
        		return (scrollHeight - scrollTop - clientHeight);
        	}
        	// 双击滚屏
        	var currentpos, timer;
        	var step = 1;
        	function initialize() {
        		timer = setInterval(scrollwindow, 20);
        	}
        	function sc() {
        		clearInterval(timer);
        		step = 1;
        	}
        	function scrollwindow() {
        		window.scrollBy(0, step);
        		
        		if (step == 1 && _reachBottom() < 10) {
        			step = -1;
        		}else if(step == -1 && getTop() < 10){
        			step = 1;
        		}
        	}
        	document.onmousedown = sc;
        	document.ondblclick = initialize;
         })();
        </script>
		<footer>
			<?php  require BASE_INC . 'footer.inc.php'; ?>
		</footer>
	</div>
</body>
</html>
<?php require BASE_INC . "end.php";?>
