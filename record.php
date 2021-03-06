<?php
session_start();
if(isset($_GET["id"])){
    $id = intval($_GET["id"]);
    $strId = "$id";
    if(strcmp($strId, $_GET["id"])  || isset($_GET["rat"]) || isset($_GET["host"]) || isset($_GET["port"])){
        echo "403 ";
        header("HTTP/1.0 403 Forbidden");
        die();
    }
}
?>
<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
if (! isset ( $_GET ["id"] )) {
    header ( 'Location:index.php?message=非法操作' );
    die ();
}
require ("./inc/common.php");
require ("./inc/function.php");

checkLogin ();
$tag = "";

$id = intval ( $_GET ["id"] );
$sql = "select * from `record_record` where `id` = '$id'";
$result = mysql_query ( $sql, $conn );
if ($result && $row = mysql_fetch_array ( $result )) {
    $title = htmlspecialchars ( getDateFromMysql ( $row ['title'] ) );
    $time = date ( "Y-m-d H:i:s", $row ['time'] );
    $last_time = date ( "Y-m-d H:i:s", $row ['last_time'] );
    $t = $row ['last_time'];
    $content = getDateFromMysql ( $row ['content'] );
    $tags = getTags ( $id );
} else {
    header ( "Location:index.php?message=".urlencode("error,the post may be deleted.") );
    die ();
}


$sql = "select * from `record_record`  where `last_time` > '$t' ORDER BY  `last_time` ASC  limit 0,1";
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

$sql = "select * from `record_record` where `last_time` < '$t' ORDER BY  `last_time` DESC limit 0,1";
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

require BASE_INC . 'head.inc.php';
?>
<meta name="keywords" content="<?php echo implode(",",$tags);?>">
<script type="text/javascript">
TK.loader.loadCSS({url:"<?php echo MAIN_PATH;?>css/main.css"});
TK.loader.loadJS({url:"/common/mathjax/MathJax.js"});
TK.loader.loadCSS({url:"<?php echo PATH_kindeditor;?>plugins/code/prettify.css"});
</script>
</head>
<body>
    <div class="outer-wrapper outer-color">
        <div class="inner-wrapper">
            <?php require './inc/head.php';?>
            <?php require './inc/nav.php';?>
            <section class="billboard clearfix" itemscope
                itemtype="http://schema.org/Article">
            <?php require "./inc/tag.php";?>
                <div class="container">
                    <section class="title sub-title" itemprop="name">
                        <h1>
                            <a href="<?php echo MAIN_DOMAIN;?>record.php?id=<?php echo $id;?>">
                            <?php echo $title; ?>
                            </a>
                        </h1>
                    </section>
                    <article class="content">
                         <section class="meta clearfix">
                            <span class="author">作者 : tiankonguse</span>
                             <span class="time"> posted at <time
                                     datetime="<?php echo $time;?>" itemprop="datePublished"
                                    content="<?php echo $time;?>">
                                    <?php echo $time;?>
                                </time>
                            </span> <span class="time"> last alter at <time
                                     datetime="<?php echo $last_time;?>"
                                    content="<?php echo $last_time;?>">
                                    <?php echo $last_time;?>
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
                        <section>
                        <?php require BASE_INC . "bdShare.php";?>
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
                        </section>
                    </article>

                </div>
                <?php require("./inc/aside.php");?>
            </section>
        <footer>
            <?php  require BASE_INC . 'footer.inc.php'; ?>
        </footer>
        </div>
    </div>
<script>
TK.loader.loadJS({url:"<?php echo PATH_JS;?>main.js"});
TK.loader.loadJS({url:"<?php echo MAIN_PATH;?>js/main.js"});
TK.loader.loadJS({url:"<?php echo PATH_JS;?>showImg.js"});
TK.loader.loadJS({url:"<?php echo MAIN_PATH;?>js/showImg.js"});
</script>
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
</body>
</html>
<?php require BASE_INC . "end.php";?>
