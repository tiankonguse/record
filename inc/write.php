<?php
session_start();
require_once("init.php");
require_once("JSON.php");
$json = new Services_JSON();

if((!$conn || !$result) && $ret){
	// db error
	echo $json->encode($ret);
}else{
	echo $json->encode(write());
}
require_once("end.php");



function write(){
	global $conn;

	if(isset($_POST['title']) && isset($_POST['time']) && isset($_POST['content'])){
		//获得表单数据
		$title    = $_POST['title'];
		$time     = $_POST['time'];
		$content  = $_POST['content'];
			
		//检查表单数据是否合法
		if(strcmp($title,"") == 0 || strcmp($content,"") == 0){
			return  output(1,"表单填写不完整");
		}
			
		if(strcmp($time,"") != 0){
			//06/11/2013 00:00
			sscanf($time,"%d/%d/%d %d:%d",$month, $day, $year, $hour, $minute);
			$second = 0;
			$time = mktime($hour, $minute, $second ,$month ,$day, $year);
		}else{
			$time = time();
			$year = date("Y",$time);
		}
			
		//防止sql注入
		$title   = mysql_real_escape_string($title);
		$content = mysql_real_escape_string($content);
			
		//操作数据库
		$sql = "insert into `record_record` (`title`,`time`,`content`) values('$title','$time','$content')";

		$result = mysql_query($sql ,$conn);
		if($result){
			$sql = "select * from `record_record` where title = '$title' and time = '$time'";
			$result = mysql_query($sql ,$conn);

			if($result && $row = mysql_fetch_array($result)){
				return output(0,"发表成功");
			}else{
				return output(1,"数据库操作失败，请联系管理员");
			}
		}else{
			return output(1,"数据库操作失败，请联系管理员");
		}
			
	}else{
		return output(1,"非法操作");
	}
}
?>