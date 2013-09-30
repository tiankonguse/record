<?php
session_start();
require("./inc/common.php");
require("./inc/function.php");

checkLogin();
initPage(15);

$nowPage = $_GET['nowPage'];
$allPageNum = $_GET['allPageNum'];
$pageSize = $_GET['pageSize'];
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
                    正在升级中
                </div>
            </section>
            <script src="<?php echo DOMAIN_JS;?>jquery.js"></script>
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
