<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
session_start();
require("./inc/common.php");
require("./inc/function.php");
checkLogin();
if(!isset($_GET["tag"]) || $_GET["tag"] == "" || !preg_match('/^[^\'" <>]*$/',$_GET['tag']) ){
    header('Location:index.php?message=非法操作');
    die();
}

$tag = $_GET["tag"];



initTagPage($tag, 15);

$nowPage = $_GET['nowPage'];
$allPageNum = $_GET['allPageNum'];
$pageSize = $_GET['pageSize'];
$tagId = $_GET['tagId'];
$baseurl = "search.php?tag=$tag&";

$title = "tiankonguse' record ~ $tag";
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
                <div class="container">
                    <ul class="listing">
<?php
$sql = "select * from `record_record` where id in (select record_id from `record_tag_map` where tag_id = '$tagId') ORDER BY  `time` DESC LIMIT ".($nowPage-1)*$pageSize." , $pageSize";
$result = mysql_query($sql ,$conn);

$pre_year = "";
$pre_mon = "";

while($row=@mysql_fetch_array($result)){
    $id = $row['id'];
    $time = $row['time'];
    $title = getDateFromMysql($row['title']);
    $time = date("Y-m-d",$time);
    sscanf($time,"%d-%d-%d", $year, $month, $day);
    if($pre_year != $year || $pre_mon != $month){
        $pre_year = $year;
        $pre_mon  = $month;
        echo "<li class='listing-seperator'>$pre_year - $pre_mon</li>";
    }

    $alter = "";
    $len = 630;
    if(strcmp($admin,"record_admin") == 0){
        $alter .= "<a href='".MAIN_DOMAIN."alter.php?id=$id'>修改</a>";
        $alter .= "<a href='".MAIN_DOMAIN."alter.php?id=$id'>删除</a>";
        $len = 600;
    }
    echo "
        <li class=\"listing-item\">
        <div style=\"float: left; \"><time datetime='$time'>$time</time></div>
        <div style=\"overflow: hidden;display: inline-block; white-space: nowrap;width: {$len}px;\"><a href=\"".MAIN_DOMAIN."record.php?id=$id\" title=\"$title\">".htmlspecialchars($title)."</a></div>
        <div style=\"float: right;\">$alter</div>
        </li>";
}
?>
                    </ul>
                </div>
            </section>
            <section class="billboard">
                <?php require('./inc/page.inc.php'); ?>
            </section>
        </div>

        <footer>
            <?php  require BASE_INC . 'footer.inc.php'; ?>
        </footer>
    </div>
<script>
TK.loader.loadJS({url:"<?php echo PATH_JS;?>main.js"});
TK.loader.loadJS({url:"<?php echo MAIN_PATH;?>js/main.js"});
</script>
    <?php require BASE_INC . "end.php";?>
</body>
</html>
