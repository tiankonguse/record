String.prototype.xss=function(){
	return this.replace(/<script>.*?<\/script>/g,'');
};

function manger_ajax_login(){
	$("form#manger_login").submit(function(){
		var I = this;
		if(this.manger_login_username.value == "" || this.manger_login_password.value == ""){
			showMessage("你有空缺的表单项目没有完成！");
		}else{
			$.post("inc/login.php",{
				username:I.manger_login_username.value,
				password:I.manger_login_password.value
			},function(d){
				if(d.code==0){
					showMessage(d.message,function(){window.location.reload();},4000);
				}else{
					showMessage(d.message);
				}
			},"json");
		}
		return false;
	});
}

function manger_ajax_logout(){

}

function manger_ajax_user(){
	$("table").tablesorter({sortLocaleCompare:true});
	$("th").attr("style","cursor:pointer;");	
}

function click_reset_password(id, username){

}

function click_delete_user(id, username){
	$("#reset_password").val("");
	$("#addevent .modal-header h3").html("删除用户"+username+"");
	$("#addevent .modal-body label.control-label[for='inputPassword']").html("新密码");
	$("#addevent .modal-footer button.btn-primary").attr("onclick","delete_user(" + id + ");");
	$('#addevent').modal();
	return false;
}
function delete_user(id){
		$.post("inc/manger.php?state=1",{
				id:$id
			},function(d){
				if(d.code==0){
					showMessage(d.message,function(){window.location = "manger_block.php?depart_id=<?php echo $depart_id; ?>";},4000);
				}else{
					showMessage(d.message);
				}
			},"json");
		
		return false;
}

var manger_url = [];
manger_url[0] = "ajax/login.php";
manger_url[1] = "ajax/logout.php";
manger_url[2] = "ajax/user.list.php";
var manger_array = [];
manger_array[0] = manger_ajax_login;
manger_array[1] = manger_ajax_logout;
manger_array[2] = manger_ajax_user;


function load_ajax(state){
	$.post(manger_url[state],function(d){
		if(d.code==0){
			$("#manger_right").html(d.message.xss());
			manger_array[state]();
		}else{
			showMessage(d.message);
		}
	},"json");
}


$("li.manger_nav_logout > a").click(function(){
	$.post("inc/logout.php",function(d){
		if(d.code==0){
			showMessage(d.message,function(){window.location.reload();},4000);
		}else{
			showMessage(d.message);
		}
	},"json");
	return false;
});

$("li.manger_nav_login > a").click(function(){
	load_ajax(state);
	return false;
});



