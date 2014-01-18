<?php
session_start();
require("./inc/common.php");
require("./inc/function.php");

if(0){
	$sql = "select * from `record_record`";
	$result = mysql_query($sql ,$conn);
	while($row = mysql_fetch_array($result)){
		$id = $row['id'];
		$last_time = $row["time"];
		$sql = "UPDATE `record_record` SET `last_time`= `time` WHERE `id` = '$id'";
		mysql_query($sql ,$conn);
	}

}else{
	mysql_query("UPDATE `record_record` SET `last_time`= `time`" ,$conn);
}
echo "finish \n";

