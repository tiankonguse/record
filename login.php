<?php
session_start();
if(isset($_SESSION['record_admin'])){
	$admin = $_SESSION['record_admin'];
}else{
	$admin = "";
}
if(strcmp($admin,"record_admin") == 0){
	header('Location:index.php?message=你已经登录');
}
?>

<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
$title = "Sign in to tiankonguse record";
require('inc/header.inc.php');
?>
</head>
<body>
	<header>
	<?php
	require('inc/top.inc.php');
	?>
	</header>
	<section>
		<div class="container">
			<form class="form-horizontal" action="inc/login.php" method="post">
				<div class="control-group">
					<label class="control-label" for="inputEmail">email</label>
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-envelope"></i> </span> <input
								class="span4" name="username" type="text" placeholder="Email"
								tabindex="1">
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Password</label>
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i> </span> <input
								type="password" name="password" placeholder="Password"
								class="span4" tabindex="2">
						</div>

					</div>
				</div>
				<div class="control-group">
					<label class="control-label">verify code</label>
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-question-sign"></i> </span> <input
								class="span3" name="verifyCode" type="text"
								placeholder="verifyCode" tabindex="3">
						</div>
						<img src="./inc/verifyCode.php" onclick="this.src=this.src;"
							class="handcursor"
							style="display: inline-block; margin-bottom: 0px; vertical-align: middle;" />
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-large btn-info" tabindex="4">Sign
							in</button>
					</div>
				</div>
			</form>
			<script>
			(function(){
				$("form").submit(function(){
					var I = this;
					if(this.username.value == "" || this.password.value == "" || this.verifyCode.value == ""){
						showMessage("You have not completed the form");
					}else{
						$.post(I.action,{
							username:I.username.value,
							password:I.password.value,
							verifyCode:I.verifyCode.value
						},function(d){
							if(d.code==0){
								window.location = ".";
							}else{
								showMessage(d.message);
							}
						},"json");
					}
					return false;
				});
			})();
			</script>
		</div>
	</section>
	<footer>
	<?php  require('inc/footer.inc.php'); ?>
	</footer>
</body>
</html>
