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

function login(){
	global $conn;
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_SESSION['verifyCode'])){
		$username = mysql_real_escape_string($_POST['username']);
		$verifyCode = mysql_real_escape_string($_POST['verifyCode']);
		$password = sha1(SALT . $_POST['password']);

		$_verifyCode = $_SESSION['verifyCode'];
		if(strcmp($_verifyCode, $verifyCode) != 0){
			return output(OUTPUT_ERROR,"验证码不正确");        
		}else if($username == 'tiankonguse' && $password == 'dcd3eeb3b04e6d3fc4247bfec3a614ec86fe9db7' ){
			$_SESSION['record_admin'] = 'record_admin';
			return output(OUTPUT_SUCCESS,"");
		}else{
			return output(OUTPUT_ERROR,"你的用户名或密码不正确" );
		}
	}else{
		return output(OUTPUT_ERROR,"非法操作");
	}
}

function write(){
	global $conn;
	if(isset($_POST['title']) && isset($_POST['time']) && isset($_POST['content'])){
		//获得表单数据
		$title    = $_POST['title'];
		$time     = $_POST['time'];
		$content  = $_POST['content'];

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
			$year = date("Y",$time);
		}

		//防止sql注入
		$title   = mysql_real_escape_string($title);
		$content = mysql_real_escape_string($content);

		//操作数据库
		$sql = "insert into `record_record` (`title`,`time`,`content`) values('$title','$time','$content')";

		$result = mysql_query($sql ,$conn);
		if($result){
			return output(OUTPUT_SUCCESS,"添加成功");
		}else{
			return output(OUTPUT_ERROR,"数据库操作失败，请联系管理员");
		}
	}else{
		return output(OUTPUT_ERROR,"非法操作");
	}
}

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
