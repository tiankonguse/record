<div id="message" class="modal hide fade" tabindex="-1" role="dialog"
	aria-labelledby="messageModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">×</button>
		<h3 id="messageModalLabel">warnning</h3>
	</div>
	<div class="modal-body">
		<p></p>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" data-dismiss="modal"
			aria-hidden="true">确定</button>
	</div>
</div>
<script>
function showMessage(message,cb,now){
	$message = $("#message");
	$message.find(".modal-body>p").text(message);
	$message.modal("show");
	$message.on("hide",cb);
	if(now > 0){
		setTimeout(cb,now);
	}
	setTimeout(function(){$message.modal('hide');},5500);
}
</script>
<div
	class="top-btn top-show top-hide"></div>
<div class="footer">
	<div class="copyright">
		Copyright © 2012 ~
		<script>document.write(new Date().getFullYear());</script>
		<a href="http://tiankonguse.com">tiankonguse.com</a>. All rights
		reserved.
	</div>
	<div class="copyright">联系邮箱：i@tiankonguse.com</div>
	<div class="copyright">QQ : 804345178</div>
	<div class="copyright">如果本站侵犯你的 bulabula，请联系本站站长，我们会做出相应的 bulabula.</div>
</div>
