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
	$title = getDateFromMysql($row['title']);
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
                <section class="meta">
                    <span class="time"> posted at <time
                            datetime="<?php echo $time;?>">
                            <?php echo $time;?>
                        </time>
                    </span>
                </section>
            </article>
        </div>
    </section>
    <footer>
    <?php  require BASE_INC . 'footer.inc.php'; ?>
    </footer>
</body>
</html>

