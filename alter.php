<?php

if(!isset($_GET["id"])){
	header('Location:index.php?message=非法操作');
	die();
}

session_start();
require("./inc/common.php");
require("./inc/function.php");

checkLogin();
if(strcmp($admin,"") == 0){
	header('Location:index.php?message=请先登录');
	die();
}

$id = intval($_GET["id"]);
$sql = "select * from `record_record` where `id` = '$id'";
$result = mysql_query($sql ,$conn);
if($result && $row = mysql_fetch_array($result)){
	$_title = getDateFromMysql($row['title']);
	$time = date("m/d/Y H:i",$row['time']);
	$content = getDateFromMysql($row['content']);
	$_SESSION['record_id'] = $id;
}else{
	header('Location:index.php?message=这篇文章不存在');
	die();
}
?>
<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
$title = "修改记录".$_title;
require BASE_INC . 'head.inc.php';
?>

<link href="<?php echo DOMAIN_datepicker;?>css/jquery-ui.css"
    rel="stylesheet" />
<link href="<?php echo DOMAIN_kindeditor;?>/themes/default/default.css"
    rel="stylesheet" />
<link href="<?php echo MAIN_DOMAIN;?>css/main.css" rel="stylesheet">
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
                action="<?php echo MAIN_DOMAIN;?>inc/control.php?state=3">
                <div class="post-line">
                    标&nbsp;&nbsp;题： <input id="title" type="text"
                        placeholder="标 题" value="<?php echo $_title;?>">
                </div>
                <div class="post-line">
                    时&nbsp;&nbsp;间： <input id="time" type="text"
                        value="<?php echo $time;?>">
                </div>
                <div class="post-line">
                    <div style="margin-bottom: 10px;">内容：</div>
                    <textarea name="content" id="content"
                        class="content">
                        <?php echo $content;?>
					</textarea>
                </div>
                <div class="post-line">
                    <button class="btn btn-large btn-info" id="submit">修改</button>
                </div>
            </form>
        </div>
    </section>
    <footer>
    <?php  require BASE_INC . 'footer.inc.php'; ?>
    </footer>
    <script src="<?php echo DOMAIN_JS;?>jquery.js"></script>
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
    <?php require("inc/end.php"); ?>
