<nav class="menu-wrapper">
	<ul class="menu-list clearfix">
		<li><a href="<?php echo MAIN_DOMAIN;?>">主页</a></li>
		<li><a href="<?php echo MAIN_DOMAIN;?>index_gaid.php">方格</a></li>
		<li><a href="<?php echo MAIN_DOMAIN;?>write.php">记录</a></li>
		<li><a href="<?php echo DOMAIN_LAB;?>">实验室</a></li>
		<li><a href="<?php echo MAIN_DOMAIN;?>tag.php">标签</a></li>
		<li><a href="<?php echo MAIN_DOMAIN;?>record.php?id=513">链接</a></li>
		<li><a href="http://tiankonguse.com/record/feed/">订阅</a></li>
		<li><a href="http://tiankonguse.com/record/messageBoard.php">留言</a></li>
		<li><a href="http://tiankonguse.com/record/donate.php">捐赠</a></li>
        <?php if(strcmp($admin,"record_admin") != 0){ ?>
        	<li><a href="<?php echo MAIN_DOMAIN;?>login.php">登录</a></li>
       <?php  }else{?>
            <li><a href="<?php echo MAIN_DOMAIN;?>logout.php">退出</a></li>
       <?php  } ?>
        
    </ul>
</nav>
