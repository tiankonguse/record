<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php require_once("inc/header.inc.php"); ?>
<title>Sign in to tiankonguse share</title>
</head>
<body>
<div class="container">
	<div class="page-header">
		<h1>Sign in to tiankonguse'share</h1>
	</div>
	<form class="form-horizontal" action="inc/login.php" method="post" novalidate="">
		<div class="control-group">
			<label class="control-label"  for="inputEmail">email</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-envelope"></i></span>
					<input class="span4" name="username" type="text" placeholder="Email" autofocus="" tabindex="1">
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"  for="inputPassword">Password</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="password" name="password" placeholder="Password"  class="span4" tabindex="2">
				</div>
				
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-large btn-primary" tabindex="3">Sign in</button>
			</div>
		</div>
	</form>
	<script>
		$("form").submit(function(){
			var I = this;
			if(this.username.value == "" || this.password.value == ""){
				showMessage("You have not completed the form");
			}else{
				$.post(I.action,{
					username:I.username.value,
					password:I.password.value
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

	</script>
</div>
<?php require_once("inc/footer.inc.php"); ?>
</body>
</html>