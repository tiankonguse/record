<?php
session_start();
require("./inc/common.php");
require("./inc/function.php");

checkLogin();
if(strcmp($admin,"") == 0){
	header('Location:index.php?message=请先登录');
	die();
}

?>
<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
$title = "写新记录";
require BASE_INC . 'head.inc.php';
?>
<link href="<?php echo MAIN_DOMAIN;?>css/main.css" rel="stylesheet">
<link rel="stylesheet"
    href="<?php echo DOMAIN_datepicker;?>css/jquery-ui.css" />
<link rel="stylesheet"
    href="<?php echo DOMAIN_kindeditor;?>/themes/default/default.css" />
</head>

<body>
    <header>
        <div class="title">
            <a href="<?php echo MAIN_DOMAIN;?>">tiankonguse'record</a>
            <div class="sub-title">
            <?php echo $title; ?>
            </div>
        </div>
    </header>
    <section>
        <div class="container">
            <form method="post"
                action="<?php echo MAIN_DOMAIN;?>inc/write.php">
                <div class="post-line">
                    标&nbsp;&nbsp;题： <input id="title" type="text"
                        placeholder="标 题">
                </div>
                <div class="post-line">
                    时&nbsp;&nbsp;间： <input id="time" type="text"
                        value="">
                </div>
                <div class="post-line">
                    <div style="margin-bottom: 10px;">内容：</div>
                    <textarea name="content" id="content"
                        class="content"></textarea>
                </div>
                <div class="post-line">
                    <button class="btn btn-large ">提交</button>
                </div>
            </form>
        </div>
    </section>
    <script src="<?php echo DOMAIN_JS;?>jquery.js"></script>
    <footer>
    <?php  require BASE_INC . 'footer.inc.php'; ?>
    </footer>
    
    <script src="<?php echo DOMAIN_JS;?>jquery-ui.js"></script>
    <script
        src="<?php echo DOMAIN_datepicker;?>js/jquery-ui-slide.min.js"></script>
    <script
        src="<?php echo DOMAIN_datepicker;?>js/jquery-ui-timepicker-addon.js"></script>
    <script src="<?php echo DOMAIN_kindeditor;?>/kindeditor-min.js"></script>
    <script src="<?php echo DOMAIN_kindeditor;?>/lang/zh_CN.js"></script>
    <script src="<?php echo MAIN_DOMAIN;?>js/write.js"></script>
    <script src="<?php echo DOMAIN_JS;?>main.js"></script>
</body>
</html>
