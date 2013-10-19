<?php
session_start();
require("./inc/common.php");
require("./inc/function.php");

checkLogin();
initPage(15);

$nowPage = $_GET['nowPage'];
$allPageNum = $_GET['allPageNum'];
$pageSize = $_GET['pageSize'];
$baseurl = ".?";
?>

<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
$title = "tiankonguse' record";
require BASE_INC . 'head.inc.php';
?>
<link href="<?php echo MAIN_DOMAIN;?>css/main.css" rel="stylesheet">

</head>
<body>
<?php //require BASE_INC . 'rain.php';?>
    <div class="outer-wrapper">
        <div class="inner-wrapper">
            <header>
                <div class="title">
                    <a href="<?php echo MAIN_DOMAIN;?>"><?php echo $title; ?>
                    </a>
                </div>
                <?php require './inc/nav.php';?>
            </header>

            <section class="billboard">
                <div class="container">
                    <ul class="listing">
                    <?php
                    $sql = "select * from `record_record`  ORDER BY  `time` DESC LIMIT ".($nowPage-1)*$pageSize." , $pageSize";
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
                    	$len = 36;
                    	if(strcmp($admin,"record_admin") == 0){
                    		$alter .= "<a href='".MAIN_DOMAIN."alter.php?id=$id'>修改</a>";
                    		$alter .= "<a href='".MAIN_DOMAIN."alter.php?id=$id'>删除</a>";
                    		$len = 33;
                    	}
                    	$showTitle = htmlspecialchars($title);
                    	$showTitle = mb_substr($showTitle, 0, $len, 'utf-8');
                    	echo "
                    <li class=\"listing-item\">
                        <div class=\"left\"><time datetime='$time'>$time</time></div>
                        <div class=\"item-title\"><a href=\"".MAIN_DOMAIN."record.php?id=$id\" title=\"$title\">$showTitle</a></div>
                        <div class=\"right\">$alter</div>
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
    <script src="<?php echo DOMAIN_JS;?>main.js"></script>

</body>
</html>
