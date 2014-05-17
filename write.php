<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
session_start();
require("./inc/common.php");
require("./inc/function.php");

checkLogin();
if(strcmp($admin,"") == 0){
    header('Location:index.php?message=请先登录');
    die();
}
$allTags = getAllTags();

// id, title, time, content, tag, 
$info = getWriteInfo($username);
$_title = htmlspecialchars ( getDateFromMysql ( $info ['title'] ), ENT_NOQUOTES );
$time = date ( "m/d/Y H:i", $info ['time'] );
$content = htmlspecialchars ( getDateFromMysql ( $info ['content'] ), ENT_NOQUOTES );
$id = $_SESSION ['record_id'] = $info["id"];
if(!$id){
    die();
}
$tags = getTags ( $id );

$title = "写新记录";
require BASE_INC . 'head.inc.php';
?>
<script type="text/javascript">
TK.loader.loadCSS({url:"<?php echo MAIN_PATH;?>css/main.css"});
TK.loader.loadCSS({url:"<?php echo PATH_datepicker;?>css/jquery-ui.css"});
TK.loader.loadCSS({url:"<?php echo PATH_kindeditor;?>themes/default/default.css"});
TK.loader.loadCSS({url:"<?php echo PATH_kindeditor;?>plugins/code/prettify.css"});
TK.isWrite = true;
TK.MAIN_DOMAIN = "<?php echo MAIN_DOMAIN;?>";
</script>
</head>
<body>
    <div class="outer-wrapper">
        <div class="inner-wrapper">
            <?php require './inc/head.php';?>
            <?php require './inc/nav.php';?>
            <section class="billboard clearfix">
                <div class="title sub-title">
                    <h1>
                        <?php echo $title; ?>
                    </h1>
                </div>
                <div class="container">
                    <form method="post"
                        action="<?php echo MAIN_DOMAIN;?>inc/control.php?state=2">
                        <div class="post-line">
                        标&nbsp;&nbsp;题： <input id="title" type="text" placeholder="标 题" 
								value="<?php echo $_title;?>" class="span5">

                        </div>
                        <div class="post-line">
                            时&nbsp;&nbsp;间： <input id="time" type="text"
								value="<?php echo $time;?>" class="span5">
                        </div>
                        <div class="post-line">
                            <div style="margin-bottom: 10px;">内容：</div>
                            <textarea name="content" id="content" class="content">
                                <?php echo $content;?>
</textarea>
                        </div>
                        <div class="post-line tag">
                            <div class="plus-tag tagbtn clearfix" id="myTags" >
								<?php
								foreach ( $tags as $key => $val ) {
									echo "<a title=\"$val\" href=\"javascript:void(0);\" class=\"handcursor\"><span>$val</span><em></em></a>";
								}
								?>

</div>
                            <div class="plus-tag-add">
                                <span class="label">我的标签：</span> <input id="" name=""
                                    type="text" class="stext" maxlength="20">
                                <button type="button" class="Button RedButton Button18"
                                    style="font-size: 22px;">添加标签</button>
                                <a href="javascript:void(0);" class="">展开标签</a>
                            </div>
                            <div id="mycard-plus" style="display: none;">
                                <div class="default-tag tagbtn clearfix">
<?php
foreach($allTags as $key=>$val){
    echo "<a title=\"$val\" href=\"javascript:void(0);\" class=\"handcursor\"><span>$val</span><em></em></a>";
}
?>
                                </div>
                            </div>
                        </div>
                        <div class="post-line">
                            <button class="btn btn-large ">提交</button>
                        </div>
                    </form>
                </div>
            </section>
            <footer>
                <?php  require BASE_INC . 'footer.inc.php'; ?>
            </footer>
        </div>
    </div>
<script>
TK.loader.loadJS({url:"<?php echo PATH_JS;?>jquery-ui.js"});
TK.loader.loadJS({url:"<?php echo PATH_datepicker;?>js/jquery-ui-slide.min.js"});
TK.loader.loadJS({url:"<?php echo PATH_datepicker;?>js/jquery-ui-timepicker-addon.js"});
TK.loader.loadJS({url:"<?php echo PATH_kindeditor;?>kindeditor.js"});
TK.loader.loadJS({url:"<?php echo PATH_kindeditor;?>lang/zh_CN.js"});
TK.loader.loadJS({url:"<?php echo MAIN_PATH;?>js/write.js"});
TK.loader.loadJS({url:"<?php echo MAIN_PATH;?>js/tag.js"});
TK.loader.loadJS({url:"<?php echo PATH_JS;?>main.js"});
TK.loader.loadJS({url:"<?php echo MAIN_PATH;?>js/main.js"});
</script>
    <?php require BASE_INC . "end.php";?>
</body>
</html>
