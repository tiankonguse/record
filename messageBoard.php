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
    <div class="outer-wrapper outer-color">
        <div class="inner-wrapper">
            <?php require './inc/head.php';?>
            <?php require './inc/nav.php';?>
            <section class="billboard clearfix"> 
            <?php require "./inc/tag.php";?>
                <div class="container">
                    <section class="title sub-title" itemprop="name">
                        <h1>
                       <a fref="javascript:void(0);"> 留言</a>
                        </h1>
                    </section>
                    <article class="content">
<!-- 

                        <section class="post" itemprop="articleBody">
                <a href="http://tiankonguse.com/lab/AKeyToSend/" style="color: red;">给我发短信</a>
                        </section>
-->
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
</script>
</body>
</html>
