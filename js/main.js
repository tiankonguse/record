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
