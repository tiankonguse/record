<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
session_start();

require("./inc/common.php");
require("./inc/function.php");

checkLogin();
if(strcmp($admin,"") != 0){
	header('Location:index.php?message=你已经登录');
	die();
}

$title = "Sign in to tiankonguse record";
require BASE_INC . 'head.inc.php';
?>
<script type="text/javascript">
TK.loader.loadCSS({url:"<?php echo MAIN_PATH;?>css/main.css"});
</script>
</head>
<body>
	<div class="outer-wrapper">
		<div class="inner-wrapper">
			<?php require './inc/head.php';?>
			<?php require './inc/nav.php';?>
			<section class="billboard">
				<div class="container">
					<form class="form-horizontal"
						action="<?php echo MAIN_DOMAIN;?>inc/control.php?state=1"
						method="post">
						<div class="control-group">
							<label class="control-label" for="inputEmail">email</label>
							<div class="controls">
								<div class="input-prepend">
									<input class="span4" name="username" type="text"
										placeholder="Email" tabindex="1">
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputPassword">Password</label>
							<div class="controls">
								<div class="input-prepend">
									<input type="password" name="password" placeholder="Password"
										class="span4" tabindex="2">
								</div>

							</div>
						</div>
						<div class="control-group">
							<label class="control-label">verify code</label>
							<div class="controls">
								<div class="input-prepend">
									<input class="span3" name="verifyCode" type="text"
										placeholder="verifyCode" tabindex="3">
								</div>
								<img class="handcursor" alt="刷新"
									src="<?php echo MAIN_DOMAIN;?>inc/verifyCode.php"
									onclick="this.src=this.src;"
									style="display: inline-block; margin-bottom: 0px; vertical-align: middle;" />


							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-large btn-info"
									tabindex="4">Sign in</button>
							</div>
						</div>
					</form>

				</div>
			</section>
		</div>
		<footer>
			<?php  require BASE_INC . 'footer.inc.php'; ?>
		</footer>
	</div>
	<script>
	TK.loader.loadJS({url:"<?php echo PATH_JS;?>main.js"});
	TK.loader.loadJS({url:"<?php echo MAIN_PATH;?>js/main.js"});
	</script>
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
</body>
</html>
