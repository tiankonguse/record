
<?php
function getRecordNum(){
	global $conn;
	//操作数据库
	$sql = "select count(*) num from `record_record`";
	$result = mysql_query($sql ,$conn);
	$row= mysql_fetch_array($result);
	return $row['num'];
}
?>
