<?php
session_start();
require("./inc/common.php");
require("./inc/function.php");


//echo '\" hello'."<br/>";
//echo str_replace('\"','"','\" hello');

$sql = "select * from `record_record`";
$result = mysql_query($sql ,$conn);


while($row = mysql_fetch_array($result)){
	$id = $row['id'];
	//echo "$id \n";
	$content = str_replace('\"','"',$row['content']);
	
	//var_dump($content);
	$content = mysql_real_escape_string($content);
	
	//var_dump($content);
	
	$sql = "UPDATE `record_record` SET `content`= '$content' WHERE `id` = '$id'";
	mysql_query($sql ,$conn);
	//break;
}
echo "finish \n";

