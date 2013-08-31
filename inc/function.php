
<?php
function getRecordNum(){
	global $conn;
	//操作数据库
	$sql = "select count(*) num from `record_record`";
	$result = mysql_query($sql ,$conn);
	$row= mysql_fetch_array($result);
	return $row['num'];
}

function initPage($pageSize){
	$_GET['pageSize'] = $pageSize;

	$allPageNum = intval((getRecordNum() + $pageSize - 1) / $pageSize);
	$_GET['allPageNum'] = $allPageNum;

	$nowPage = 1;
	if(isset($_GET['nowPage'])){
		$nowPage = intval($_GET['nowPage']);
	}
	if($nowPage <= 0){
		$nowPage = 1;
	}else if($nowPage > $allPageNum){
		$nowPage = $allPageNum;
	}
	$_GET['nowPage'] = $nowPage;
}

function checkLogin(){
	global $admin;
	if(isset($_SESSION['record_admin'])){
		$admin = $_SESSION['record_admin'];
	}else{
		$admin = "";
	}
}

?>
