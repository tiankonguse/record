<?php

if(!isset($_GET["id"])){
	header('Location:index.php?message=非法操作');
	die();
}

session_start();

require("./inc/common.php");
require("./inc/function.php");

checkLogin();

$id = intval($_GET["id"]);
$sql = "select * from `record_record` where `id` = '$id'";
$result = mysql_query($sql ,$conn);
if($result && $row = mysql_fetch_array($result)){
	$title = htmlspecialchars(getDateFromMysql($row['title']));
	$time = date("Y-m-d",$row['time']);
	$content = getDateFromMysql($row['content']);

	$tags = getTags($id);

}else{
	header('Location:index.php?message=error,the post may be deleted.');
	die();
}

?>

<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
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
                    <a href="<?php echo MAIN_DOMAIN;?>">tiankonguse'record</a>
                </div>
                <?php require './inc/nav.php';?>
            </header>

            <section class="billboard" itemscope
                itemtype="http://schema.org/Article">
                <div class="title sub-title" itemprop="name">
                    <h1>
                        <a
                            href="<?php echo MAIN_DOMAIN;?>record.php?id=<?php echo $id;?>">
                            <?php echo $title; ?>
                        </a>
                    </h1>
                </div>
                <div class="container">
                    <article class="content">
                        <section class="meta">
                            <span class="time"> posted at <time
                                    datetime="<?php echo $time;?>"
                                    itemprop="datePublished"
                                    content="<?php echo $time;?>">
                                    <?php echo $time;?>
                                </time>
                            </span>
                        </section>
                        <section class="post" itemprop="articleBody">
                        <?php echo $content; ?>
                        </section>
                        <section class="tag">
                            <div style="margin-top: 10px;">标签：</div>
                            <div class="plus-tag tagbtn clearfix">
                            <?php
                            foreach($tags as $key=>$val){
                            	echo "<a title=\"$val\" href=\"".MAIN_DOMAIN."search.php?tag=$val\"><span>$val</span></a>";
                            }
                            ?>
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
	                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
	                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	                        })();
	                        </script>
                        </section>


                    </article>
                </div>
            </section>
        </div>
        <script src="<?php echo DOMAIN_JS;?>jquery.js"></script>
        <script src="<?php echo DOMAIN_JS;?>main.js"></script>
        <footer>
        <?php  require BASE_INC . 'footer.inc.php'; ?>
        </footer>
    </div>

</body>
</html>

