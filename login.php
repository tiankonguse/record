<?php
session_start();

require("./inc/common.php");
require("./inc/function.php");

checkLogin();
if(strcmp($admin,"") != 0){
	header('Location:index.php?message=你已经登录');
	die();
}
?>

<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<?php
$title = "Sign in to tiankonguse record";
require BASE_INC . 'head.inc.php';
?>
<link href="<?php echo MAIN_DOMAIN;?>css/main.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="title">
        <?php echo $title; ?>
        </div>
    </header>
    <section>
        <div class="container">
            <form class="form-horizontal" action="<?php echo MAIN_DOMAIN;?>inc/login.php"
                method="post">
                <div class="control-group">
                    <label class="control-label" for="inputEmail">email</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <input class="span4" name="username"
                                type="text" placeholder="Email"
                                tabindex="1">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPassword">Password</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <input type="password" name="password"
                                placeholder="Password" class="span4"
                                tabindex="2">
                        </div>

                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">verify code</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <input class="span3" name="verifyCode"
                                type="text" placeholder="verifyCode"
                                tabindex="3">
                        </div>
                        <img class="handcursor"
                            src="<?php echo MAIN_DOMAIN;?>inc/verifyCode.php"
                            onclick="this.src=this.src;"
                            style="display: inline-block; margin-bottom: 0px; vertical-align: middle;" />


                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit"
                            class="btn btn-large btn-info" tabindex="4">Sign
                            in</button>
                    </div>
                </div>
            </form>

        </div>
    </section>
    <footer>
    <?php  require BASE_INC . 'footer.inc.php'; ?>
    </footer>
    <script src="<?php echo DOMAIN_JS;?>jquery.js"></script>
    <div id="message" class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close">×</button>
            <h3 id="messageModalLabel">warnning</h3>
        </div>
        <div class="modal-body">
            <p></p>
        </div>
        <div class="modal-footer">
            <button class="btn ok">确定</button>
        </div>
    </div>
    <div class="modal-backdrop hide"></div>
    <script src="<?php echo DOMAIN_JS;?>main.js"></script>
    
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
