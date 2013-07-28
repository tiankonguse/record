<?php
session_start();
require_once("init.php");
require_once("JSON.php");
$json = new Services_JSON();
$ret = array(
	"code" => 1,
	"message" => "Username or Password is not correct!"
);
if(isset($_POST['username']) && isset($_POST['password']) && isset($_SESSION['verifyCode'])){
	$username = mysql_real_escape_string($_POST['username']);
	$verifyCode = mysql_real_escape_string($_POST['verifyCode']);
	$password = sha1(SALT . $_POST['password']);

	$_verifyCode = $_SESSION['verifyCode'];
	if(strcmp($_verifyCode, $verifyCode) != 0){
		$ret["message"] = "验证码不正确";        
	}else if($username == 'tiankonguse' && $password == 'c7c0c7b5d5cf523862722a069e24fd4db394edb2' ){
		$_SESSION['record_admin'] = 'record_admin';
		$ret["code"] = 0;
		$ret["message"] = "";
	}else{
		$ret["message"] = "你的用户名或密码不正确 $password";
	}

}else{
	$ret["message"] = "非法操作";
}
echo $json->encode($ret);
require_once("end.php");
?>
