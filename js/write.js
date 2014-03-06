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
    var $tag = jQuery(".plus-tag");

    function getTips() {
	var b = [];
	$("a", $tag).each(function() {
	    b.push($(this).attr("title"));
	});
	return b;
    }
    ;

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
//	console.log(data['content']);
	data['title'] = $("#title").val();
	data['time'] = $("#time").val();
	var tag = getTips();
	data['tags'] = tag.join(",");
	
	$.post(action, data, function(d) {
	    if (d.code == 0) {
		showMessage(d.message);
		setTimeout((function() {
		    window.location = "index.php";
		}), 2000);
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
	    allowFileManager : true,
	    minHeight : "300",
	    items : [ 'source', '|', 'undo', 'redo', '|', 'preview', 'code',
		    'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|',
		    'justifyleft', 'justifycenter', 'justifyright',
		    'justifyfull', 'insertorderedlist', 'insertunorderedlist',
		    'indent', 'outdent', 'subscript', 'superscript',
		    'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen',
		    '/', 'formatblock', 'fontname', 'fontsize', '|',
		    'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
		    'strikethrough', 'lineheight', 'removeformat', '|',
		    'image', 'insertfile', 'table', 'hr', 'emoticons',
		    'pagebreak', 'anchor', 'link', 'unlink' ],
    cssPath : ['/common/kindeditor/plugins/code/prettify.css']
	});
    });

    $(document).ready(function() {
	$('#time').datetimepicker();
    });

});
