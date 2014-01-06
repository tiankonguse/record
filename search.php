<?php
session_start();
require("./inc/common.php");
require("./inc/function.php");

checkLogin();


if(!isset($_GET["tag"]) || $_GET["tag"] == ""){
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
?>

<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
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
            <header>
                <div class="title">
                    <a href="<?php echo MAIN_DOMAIN;?>"><?php echo $title; ?>
                    </a>
					<span style="font-size: 25px; color: rgb(93, 75, 97);">牛奶会有的，面包会有的!</span>
                </div>
                <?php require './inc/nav.php';?>
            </header>

            <section class="billboard">
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
            <script src="<?php echo DOMAIN_JS;?>jquery.js"></script>

            <section class="billboard">
            <?php require('./inc/page.inc.php'); ?>
            </section>
        </div>

        <footer>
        <?php  require BASE_INC . 'footer.inc.php'; ?>
        </footer>
    </div>
    <?php
    if(isset($_GET['message'])){
        echo "
            <script>
                $(function(){
                    var _state = {
                        title:'',
                        url:window.location.href.split('?')[0]
                    };
                    history.pushState(_state,'','?nowPage=$nowPage');
                    showMessage('" . htmlspecialchars($_GET['message']) . "');
                });
            </script>";
    }

    ?>
	<script>
	TK.loader.loadJS({url:"<?php echo PATH_JS;?>main.js"});
	TK.loader.loadJS({url:"<?php echo MAIN_PATH;?>js/main.js"});
	</script>
</body>
</html>
<?php require BASE_INC . "end.php";?>
