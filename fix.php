<?php
session_start();
require("./inc/common.php");
require("./inc/function.php");


/* 
 * 为 record 添加了最后修改时间字段
 */
if(0){
	$sql = "select * from `record_record`";
	$result = mysql_query($sql ,$conn);
	while($row = mysql_fetch_array($result)){
		$id = $row['id'];
		$last_time = $row["time"];
		$sql = "UPDATE `record_record` SET `last_time`= `time` WHERE `id` = '$id'";
		mysql_query($sql ,$conn);
	}

	mysql_query("UPDATE `record_record` SET `last_time`= `time`" ,$conn);

}

/*
 * 由于为 tag 添加了一个数量的字段，所以写了一个自动更新的SQL 语句。
 */
if(0){
    $sql = "update record_tag t1 set number = (select count(*) num from record_tag_map  t2 where t2.tag_id = t1.id)";
}

echo "finish \n";

