<div class="page-style">
	<div class="clearfix">
		<div class="left">
			<div class="page-item-left">
				<a href="<?php echo $baseurl;?>nowPage=1">首页</a>
			</div>
			<div class="page-item-left">
				<a
					href="<?php echo $baseurl;?>nowPage=<?php echo $nowPage - 1 == 0 ? $allPageNum : $nowPage - 1 ;?>">上一页</a>
			</div>
			<div class="page-item-left">
				<a
					href="<?php echo $baseurl;?>nowPage=<?php echo $nowPage + 1 > $allPageNum ? 1 : $nowPage + 1;?>">下一页</a>
			</div>
			<div class="page-item-left">
				<a href="<?php echo $baseurl;?>nowPage=<?php echo $allPageNum;?>">尾页</a>
			</div>
			<div class="page-item-left">
				<form style="display: inline" action="index.php" method="get">
					第<input type="text" name="nowPage" />页
				</form>
				<a href="">穿越</a>
			</div>
		</div>
	</div>

</div>
<script>
		(function(){

			maxPage = <?php echo $allPageNum;?>
			
			function isNumber(str){
			       var reg = /^[0-9]+$/;
			       return reg.test(str);
			}	
			$(".page-style form ~ a").click(function(){
				$nowPage = $(".page-style form input").val();

				if(!isNumber($nowPage)){
					showMessage("页数只能是数字");
				}else if($nowPage > maxPage || $nowPage < 0){
					showMessage("请输入 1 ～ " + maxPage + "页");
				}else{
					$(".page-style form").submit();
				}
				
				return false;
			});
		})();

	</script>