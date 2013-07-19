<?php
session_start();
require_once("init.php");
require_once("JSON.php");
$json = new Services_JSON();
$ret = array(
	"code" => 1,
	"message" => "Username or Password is not correct!"
);
if(isset($_POST['username']) && isset($_POST['password'])){
	$username = mysql_real_escape_string($_POST['username']);
	$password = sha1(SALT . $_POST['password']);
	$ret["message"] = $password;
	if($username == 'tiankonguse' && $password == 'cf60f0aae6f17dcf31d564fe04ddfe4aa8732da3' ){
		$_SESSION['share_admin'] = 'share_admin';
		$ret["code"] = 0;
		$ret["message"] = "";
	}

}
echo $json->encode($ret);
require_once("end.php");
?>
