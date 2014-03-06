$(document).ready(
	function() {
	    var docked = 0;
	    $("#dock .dock-keleyi-com").click(
		    function() {
			$(this).parent().parent().addClass("docked")
				.removeClass("free");

			docked += 1;
			var dockH = ($(window).height()) / docked
			var dockT = 0;

			$("#dock li ul.docked").each(function() {
			    $(this).height(dockH).css("top", dockT + "px");
			    dockT += dockH;
			});
			$(this).parent().find(".undock").show();
			$(this).hide();

		    });

	    $("#dock .undock").click(
		    function() {
			$(this).parent().parent().addClass("free").removeClass(
				"docked").animate({
			    left : "-180px"
			}, 200).height($(window).height()).css("top", "0px");

			docked = docked - 1;
			var dockH = ($(window).height()) / docked
			var dockT = 0;

			$("#dock li ul.docked").each(function() {
			    $(this).height(dockH).css("top", dockT + "px");
			    dockT += dockH;
			});
			$(this).parent().find(".dock-keleyi-com").show();
			$(this).hide();

		    });

	    $("#dock li").hover(function() {
		var that = $(this);
		that.find("ul").animate({
		    left : that.width() + "px"
		}, 200);
	    }, function() {
		$(this).find("ul.free").animate({
		    left : "-180px"
		}, 200);
	    });
	});
/*
 *alter url (remove pammra message )and show message 
 */
function alterUrlAndShowMessage($title, $message) {
    $(function() {
	var url = window.location.href.split('?');
	url[1] = url[1].split("&");
	for ( var i in url[1]) {
	    url[1][i] = url[1][i].split("=");
	}
	for ( var i in url[1]) {
	    if (url[1][i][0] == "message") {
		url[1].splice(i, 1);
		break;
	    }
	}

	for ( var i in url[1]) {
	    url[1][i] = url[1][i].join("=");
	}

	url[1] = url[1].join("&");

	history.pushState({
	    title : $title,
	    url : url[0]
	}, '', url[1] == "" ? "?t=" + new Date().getTime() : ("?" + url[1]));
	showMessage($message);
    });
}

/*
 * gaid view 
 */
$(function() {
    $(".unitList .unit").mouseover(function() {
	$(this).addClass("mson-unit");
    });

    $(".unitList .unit").bind("click", function() {
	var id = $(this).attr("rid");
	window.location.href = "<?php echo MAIN_DOMAIN; ?>record.php?id=" + id;
    });

    $(".unitList .unit").mouseout(function() {
	$(this).removeClass("mson-unit");
    });

});




