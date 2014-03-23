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

            <section class="billboard clearfix">
                <div class="container about-me">
                    <h1 class="entry-title">关于本站</h1>
                    <div class="entry-content">
                        <p>本站是tiankonguse 的个人网站。</p>
                        <p>一篇文章在互联网上称为博客，但是，tiankonguse 把它称为一个记录。</p>
                        <p>tiankonguse 的记录通常会记录下 tiankonguse 的生活感想，学习过程，所见所闻和看到的好文章等。</p>
                        <p>这里的记录自 2014年起，列表按最近修改时间来排序。</p>
                        <p>下面的是 tiankonguse 的新浪微博。</p>
                        <p>
                            <iframe width="100%" height="550" class="share_self"
                                src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=550&fansRow=2&ptype=1&speed=0&skin=1&isTitle=1&noborder=1&isWeibo=1&isFans=1&uid=3379254290&verifier=dab824c3&dpc=1"></iframe>
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
