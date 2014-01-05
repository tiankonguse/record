<?php
if (! isset ( $_GET ["id"] )) {
	header ( 'Location:index.php?message=非法操作' );
	die ();
}

session_start ();
require ("./inc/common.php");
require ("./inc/function.php");

checkLogin ();
if (strcmp ( $admin, "" ) == 0) {
	header ( 'Location:index.php?message=请先登录' );
	die ();
}

$id = intval ( $_GET ["id"] );
$sql = "select * from `record_record` where `id` = '$id'";
$result = mysql_query ( $sql, $conn );
if ($result && $row = mysql_fetch_array ( $result )) {
	$_title = htmlspecialchars ( getDateFromMysql ( $row ['title'] ), ENT_NOQUOTES );
	$time = date ( "m/d/Y H:i", $row ['time'] );
	$content = htmlspecialchars ( getDateFromMysql ( $row ['content'] ), ENT_NOQUOTES );
	$_SESSION ['record_id'] = $id;
	
	$tags = getTags ( $id );
	$allTags = getAllTags ();
} else {
	header ( 'Location:index.php?message=这篇文章不存在' );
	die ();
}
?>
<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
$title = "修改记录" . $_title;
require BASE_INC . 'head.inc.php';
?>

<link href="<?php echo DOMAIN_datepicker;?>css/jquery-ui.css"
	rel="stylesheet" />
<link href="<?php echo DOMAIN_kindeditor;?>/themes/default/default.css"
	rel="stylesheet" />
<link href="<?php echo MAIN_DOMAIN;?>css/main.css" rel="stylesheet">
</head>

<body>
<?php //require BASE_INC . 'rain.php';?>
    <div class="outer-wrapper">
		<div class="inner-wrapper">
			<header>
				<div class="title">
					<a href="<?php echo MAIN_DOMAIN;?>">tiankonguse'record</a>
				<span style="font-size: 25px; color: rgb(93, 75, 97);">牛奶会有的，面包会有的!</span>
				</div>
                <?php require './inc/nav.php';?>
            </header>

			<section class="billboard">
				<div class="title sub-title">
					<h1>
                    <?php echo $title; ?>
                    </h1>
				</div>
				<div class="container">
					<form method="post"
						action="<?php echo MAIN_DOMAIN;?>inc/control.php?state=3">
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
							<div class="plus-tag tagbtn clearfix" id="myTags">
                                <?php
																																foreach ( $tags as $key => $val ) {
																																	echo "<a title=\"$val\" href=\"javascript:void(0);\" class=\"handcursor\"><span>$val</span><em></em></a>";
																																}
																																?>
                            </div>
							<div class="plus-tag-add ">
								<span class="label">我的标签：</span> <input id="" name=""
									type="text" class="stext" maxlength="20">
								<button type="button" class="Button RedButton Button18"
									style="font-size: 22px;">添加标签</button>
								<a href="javascript:void(0);" class="">展开标签</a>
							</div>
							<div id="mycard-plus" style="display: none;">
								<div class="default-tag tagbtn clearfix">
                                <?php
																																foreach ( $allTags as $key => $val ) {
																																	echo "<a title=\"$val\" href=\"javascript:void(0);\" class=\"handcursor\"><span>$val</span><em></em></a>";
																																}
																																?>
                                </div>
							</div>
						</div>
						<div class="post-line">
							<button class="btn btn-large btn-info" id="submit">修改</button>
						</div>
					</form>
				</div>
			</section>
		</div>
		<script src="<?php echo DOMAIN_JS;?>jquery.js"></script>
		<footer>
        <?php  require BASE_INC . 'footer.inc.php'; ?>
        </footer>
	</div>

	<script src="<?php echo DOMAIN_JS;?>jquery-ui.js"></script>
	<script src="<?php echo DOMAIN_datepicker;?>js/jquery-ui-slide.min.js"></script>
	<script
		src="<?php echo DOMAIN_datepicker;?>js/jquery-ui-timepicker-addon.js"></script>
	<script src="<?php echo DOMAIN_kindeditor;?>/kindeditor-min.js"></script>
	<script src="<?php echo DOMAIN_kindeditor;?>/lang/zh_CN.js"></script>
	<script src="<?php echo MAIN_DOMAIN;?>js/write.js"  ></script>
	<script src="<?php echo MAIN_DOMAIN;?>js/tag.js" async ></script>
	<script src="<?php echo DOMAIN_JS;?>main.js" async ></script>
	<script src="<?php echo MAIN_DOMAIN;?>js/main.js" async ></script>
</body>
</html>
<?php require BASE_INC . "end.php";?>
