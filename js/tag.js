$(document)
		.ready(
				function() {
					(function() {

						var a = jQuery(".plus-tag");

						var linsten_tag = function() {
							jQuery("a em", a).click("click", function() {
								delTips($(this).parents("a").attr("title"))
							});
						};

						var hasTips = function(title) {
							var d = $("a", a), c = false;
							d.each(function() {
								if ($(this).attr("title") == title) {
									c = true;
									return false
								}
							});
							return c
						};

						var delTips = function(title) {
							if (!hasTips(title)) {
								return false
							}

							$("a", a).each(function() {
								var d = $(this);
								if (d.attr("title") == title) {
									d.remove();
									return false
								}
							});
							updateSelectTips();
							return true
						};

						var getTips = function() {
							var b = [];
							$("a", a).each(function() {
								b.push($(this).attr("title"))
							});
							return b;
						};

						var setTips = function(title) {

							if (hasTips(title)) {
								return false;
							}
							a.append($("<a  title=\"" + title
									+ "\" href=\"javascript:void(0);\" ><span>"
									+ title + "</span><em></em></a>"));
							updateSelectTips();
							return true
						};

						// 更新高亮显示
						var updateSelectTips = function() {
							linsten_tag();
							var arrName = getTips();
							if (arrName.length) {
								$('#myTags').show();
							} else {
								$('#myTags').hide();
							}
							$('.default-tag a').removeClass('selected');
							$.each(arrName, function(index, name) {
								$('.default-tag a').each(function() {
									var $this = $(this);
									if ($this.attr('title') == name) {
										$this.addClass('selected');
										return false;
									}
								});
							});
						};

						// 更新选中标签标签
						updateSelectTips();

						// 已存在的标签
						var str = [ '展开标签', '收起标签' ];
						$('.plus-tag-add a').click(function() {
							var $this = $(this), $con = $('#mycard-plus');
							if ($this.hasClass('plus')) {
								$this.removeClass('plus').text(str[0]);
								$con.hide();
							} else {
								$this.addClass('plus').text(str[1]);
								$con.show();
							}
						});

						$('.default-tag a').click('click', function() {
							var $this = $(this), title = $this.attr('title');
							setTips(title);
						});

						var $button = $('.plus-tag-add button'), $input = $('.plus-tag-add input');
						$input.keydown(function(e) {
							if (e.keyCode == 13) {
								$button.click();
								return false;
							}
						});
						$button.click(function() {
							var name = $input.val().toLowerCase();
							if (name != '')
								setTips(name);
							$input.val('');
							$input.select();
							return false;
						});

					})();
				});

