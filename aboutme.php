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
                    <p>这里是 <a href="<?php echo MAIN_PATH;?>" >tiankonguse </a> 的个人网站。</p>
                        <p>一篇文章在互联网上称为博客，但是，<a href="<?php echo MAIN_PATH;?>" >tiankonguse </a> 把它称为一个记录。</p>
                        <p><a href="<?php echo MAIN_PATH;?>" >tiankonguse </a> 的记录通常会记录下 <a href="<?php echo MAIN_PATH;?>" >tiankonguse </a> 的生活感想，学习过程，所见所闻和看到的好文章等。</p>
                        <P>关于这个网站的源代码，全部托管在 <a href="<?php echo MAIN_PATH;?>" >tiankonguse </a> 的 <a href="http://github.com/tiankonguse/record/">github</a>上  </p>
                        <p> <a href="<?php echo MAIN_PATH;?>" >tiankonguse </a> 的这个 <a href="<?php echo MAIN_PATH;?>" >record </a> 网站算是纯手工敲出来的，所以避免不了有漏洞,bug。从网站的外观也可以看出来，我是一个屌丝。屌丝的审美观和大众确实不太一样。<br> 所以你有什么好的想法可以告诉我，或者我们一起实现。</p>
                        <p>欢迎向我提交友情链接。</p>

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
