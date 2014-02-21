<ul id="dock" class="outer-color outer-menu-color">
	<li>菜单
		<ul class="free">
			<li class="header"><a href="#" class="dock-keleyi-com">固定</a><a
				href="#" class="undock">隐藏</a>菜单</li>
			<li><a href="<?php echo MAIN_DOMAIN;?>">主页</a></li>
			<li><a href="<?php echo MAIN_DOMAIN;?>index_gaid.php">方格</a></li>
			<li><a href="<?php echo MAIN_DOMAIN;?>write.php">记录</a></li>
			<li><a href="<?php echo DOMAIN_LAB;?>">实验室</a></li>
			<li><a href="<?php echo MAIN_DOMAIN;?>tag.php">标签</a></li>
			<li><a href="<?php echo MAIN_DOMAIN;?>record.php?id=513">链接</a></li>
			<li><a href="<?php echo MAIN_DOMAIN;?>feed/">订阅</a></li>
			<li><a href="<?php echo MAIN_DOMAIN;?>messageBoard.php">留言</a></li>
			<li><a href="<?php echo MAIN_DOMAIN;?>donate.php">捐赠</a></li>
			<?php if(strcmp($admin,"record_admin") != 0){ ?>
			<li><a href="<?php echo MAIN_DOMAIN;?>login.php">登录</a></li>
			<?php  }else{?>
			<li><a href="<?php echo MAIN_DOMAIN;?>logout.php">退出</a></li>
			<?php  } ?>
		</ul>
	</li>
	<li>分类
		<ul class="free">
			<li class="header"><a href="#" class="dock-keleyi-com">固定</a><a
				href="#" class="undock">隐藏</a>分类</li>
			<li><a href="<?php echo MAIN_DOMAIN;?>search.php?tag=acm">ACM</a></li>
			<li><a href="<?php echo MAIN_DOMAIN;?>search.php?tag=linux">linux</a></li>
			<li><a href="<?php echo MAIN_DOMAIN;?>search.php?tag=生活">生活</a></li>
			<li><a href="<?php echo MAIN_DOMAIN;?>search.php?tag=记录">记录</a></li>

		</ul>
	</li>
	<li>推荐
		<ul class="free">
			<li class="header"><a href="#" class="dock-keleyi-com">固定</a><a
				href="#" class="undock">隐藏</a>推荐</li>
		</ul>
	</li>
</ul>
