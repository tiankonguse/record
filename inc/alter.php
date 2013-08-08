<?php
session_start();
require_once("init.php");
require_once("JSON.php");
$json = new Services_JSON();

if((!$conn || !$result) && $ret){
	// db error
	echo $json->encode($ret);
}else{
	echo $json->encode(alter());
}
require_once("end.php");



function alter(){
	global $conn;

	if(isset($_POST['title']) && isset($_POST['time']) && isset($_POST['content'])){
		//获得表单数据
		$title    = $_POST['title'];
		$time     = $_POST['time'];
		$content  = $_POST['content'];
		$id = $_SESSION['record_id'];
		
		//检查表单数据是否合法
		if(strcmp($title,"") == 0 || strcmp($content,"") == 0){
			return  output(OUTPUT_ERROR,"表单填写不完整");
		}

		
		if(strcmp($time,"") != 0){
			//06/11/2013 00:00
			sscanf($time,"%d/%d/%d %d:%d",$month, $day, $year, $hour, $minute);
			$second = 0;
			$time = mktime($hour, $minute, $second ,$month ,$day, $year);
		}else{
			$time = time();
			$year = date("Y",$time);;
		}
			
		//防止sql注入
		$title   = mysql_real_escape_string($title);
		$content = mysql_real_escape_string($content);
			
		//操作数据库
		$sql = "UPDATE `record_record` SET `title`= '$title',`content`= '$content',`time`= '$time' WHERE `id` = '$id'";

		$result = mysql_query($sql ,$conn);
		if($result){
			return output(OUTPUT_SUCCESS, "修改成功");
		}else{
			return output(OUTPUT_ERROR,"数据库操作失败，请联系管理员");
		}
			
	}else{
		return output(OUTPUT_ERROR,"非法操作");
	}
}

?>