$(function() {

    var editor = null;

    // title
    var title_check = function() {
	var title = $("#title").val();
	return (title.length == 0);
    };

    function isNumber(str) {
	var reg = /^[0-9]+$/;
	return reg.test(str);
    }

    $("form").submit(function() {
	var I = this;
	var action = I.action, data = {};

	if (title_check()) {
	    showMessage("表单填写不完整");
	    return false;
	}

	editor.sync();
	data['content'] = $("#content").val();
	if (data['content'] == "") {
	    showMessage("内容不能为空");
	    return false;
	}
	data['title'] = $("#title").val();
	data['time'] = $("#time").val();

	$.post(action, data, function(d) {
	    if (d.code == 0) {
		showMessage(d.message, function() {
		    window.location = ".";
		}, 4000);
	    } else {
		showMessage(d.message);
	    }
	}, "json");
	return false;
    });

    KindEditor.ready(function(K) {
	editor = K.create('textarea[name="content"]', {
	    resizeType : 1,
	    allowPreviewEmoticons : true,
	    allowImageUpload : true,
	    minHeight : "300",
	    items : [ 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor',
		    'bold', 'italic', 'underline', 'removeformat', '|',
		    'justifyleft', 'justifycenter', 'justifyright',
		    'insertorderedlist', 'insertunorderedlist', '|',
		    'emoticons', 'image', 'link' ]
	});
    });

    $(document).ready(function() {
	$('#time').datetimepicker();
    });

});