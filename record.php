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
    <?php require BASE_INC . 'rain.php';?>
    <header>
        <div class="title">
            <a href="<?php echo MAIN_DOMAIN;?>">tiankonguse'record</a>
        </div>
    </header>
    <section>
        <div class="title sub-title">
        <?php echo $title; ?>
        </div>
        <div class="container">
            <article class="content">
                <section class="meta">
                    <span class="time"> posted at <time
                            datetime="<?php echo $time;?>">
                            <?php echo $time;?>
                        </time>
                    </span>
                </section>
                <section class="post">
                <?php echo $content; ?>
                </section>
            </article>
        </div>
    </section>
    <script src="<?php echo DOMAIN_JS;?>jquery.js"></script>
    <footer>
    <?php  require BASE_INC . 'footer.inc.php'; ?>
    </footer>

    <script src="<?php echo DOMAIN_JS;?>main.js"></script>
</body>
</html>

